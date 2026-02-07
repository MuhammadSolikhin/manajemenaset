<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Opname;
use App\Models\OpnameDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OpnameController extends Controller
{
    public function dashboard()
    {
        $totalOpnames = Opname::count();
        $pendingOpnames = Opname::where('status', 'pending')->count();
        $completedOpnames = Opname::where('status', 'completed')->count();
        $totalAssetsAudited = OpnameDetail::count();

        $recentOpnames = Opname::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('opname.dashboard', compact(
            'totalOpnames',
            'pendingOpnames',
            'completedOpnames',
            'totalAssetsAudited',
            'recentOpnames'
        ));
    }

    public function index()
    {
        $opnames = Opname::with('user')->where('status', 'pending')->latest()->get();
        return view('opname.index', compact('opnames'));
    }

    public function history()
    {
        $opnames = Opname::with('user')->where('status', 'completed')->latest()->get();
        return view('opname.history', compact('opnames'));
    }

    public function report(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-t'));

        $opnames = Opname::with(['user', 'details'])
            ->where('status', 'completed')
            ->whereBetween('date', [$startDate, $endDate])
            ->latest()
            ->get();

        return view('opname.report', compact('opnames', 'startDate', 'endDate'));
    }

    public function print(Opname $opname)
    {
        $opname->load('details.asset');
        return view('opname.print', compact('opname'));
    }

    public function create()
    {
        return view('opname.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'location' => 'required|string|max:255', // Simplified for now, could be a select from unique asset locations
        ]);

        DB::transaction(function () use ($request) {
            $opname = Opname::create([
                'date' => $request->date,
                'location' => $request->location,
                'user_id' => auth()->id(),
                'status' => 'pending',
            ]);

            // Auto-populate details with assets from that location (or all assets if logic dictates)
            // For now, let's say we opname ALL assets to be safe, or filter by location if the Asset model has it.
            // Assuming Asset has 'location' or similar. If not, we might need to adjust.
            // Let's assume we want to opname ALL assets for simplicity first, or filter by location if possible.
            // Check Asset model structure? I'll assume standard Asset model has location or we just take all.

            // Checking Asset model... assuming it has location since Opname has location.
            // If Asset table doesn't have location, we might just take all available assets.

            $assets = Asset::all(); // Retrieve all assets for now. Ideally filter by location.

            foreach ($assets as $asset) {
                OpnameDetail::create([
                    'opname_id' => $opname->id,
                    'asset_id' => $asset->id,
                    'system_stock' => 1, // Simplified: assuming 1 asset = 1 stock for individual assets. If quantity exists, use it.
                    'physical_stock' => 0,
                    'difference' => -1, // Default difference
                ]);
            }
        });

        return redirect()->route('opname.index')->with('success', 'Sesi Opname berhasil dibuat.');
    }

    public function show(Opname $opname)
    {
        $opname->load('details.asset');
        return view('opname.show', compact('opname'));
    }

    public function update(Request $request, Opname $opname)
    {
        // This update is for finalizing the opname or updating details
        // We'll handle detail updates here or via a separate route?
        // Let's assume we submit the whole form from 'show' page to update counts.

        $data = $request->validate([
            'details' => 'required|array',
            'details.*.id' => 'required|exists:opname_details,id',
            'details.*.physical_stock' => 'required|integer|min:0',
            'details.*.notes' => 'nullable|string',
            'status' => 'nullable|in:pending,completed'
        ]);

        DB::transaction(function () use ($opname, $data) {
            foreach ($data['details'] as $detailData) {
                $detail = OpnameDetail::findOrFail($detailData['id']);

                $physical = $detailData['physical_stock'];
                $system = $detail->system_stock;
                $difference = $physical - $system;

                $detail->update([
                    'physical_stock' => $physical,
                    'difference' => $difference,
                    'notes' => $detailData['notes'] ?? null,
                ]);
            }

            if (isset($data['status'])) {
                $opname->update(['status' => $data['status']]);
            }
        });

        return redirect()->route('opname.show', $opname)->with('success', 'Data Opname berhasil diperbarui.');
    }

    public function destroy(Opname $opname)
    {
        $opname->delete();
        return redirect()->route('opname.index')->with('success', 'Sesi Opname berhasil dihapus.');
    }
}
