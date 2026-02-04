<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetLoan;
use App\Models\User;
use App\Services\AssetLoanService;
use Illuminate\Http\Request;

class AssetLoanController extends Controller
{
    protected $loanService;

    public function __construct(AssetLoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function create(Asset $asset)
    {
        $users = User::all();
        return view('loans.create', compact('asset', 'users'));
    }

    public function store(Request $request, Asset $asset)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'notes' => 'nullable|string',
        ]);

        try {
            $user = User::findOrFail($request->user_id);
            $this->loanService->checkout($asset, $user, $request->notes);
            return redirect()->route('assets.show', $asset)->with('success', 'Aset berhasil dipinjamkan.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function return(AssetLoan $loan)
    {
        try {
            $this->loanService->checkin($loan);
            return back()->with('success', 'Aset berhasil dikembalikan.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
