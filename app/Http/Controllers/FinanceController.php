<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Journal;
use App\Models\JournalDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function dashboard()
    {
        // Simple dashboard stats
        $totalAssets = Account::where('type', 'asset')->count();
        $totalLiabilities = Account::where('type', 'liability')->count();
        $totalExpenses = JournalDetail::whereHas('account', function ($q) {
            $q->where('type', 'expense');
        })->sum('debit') - JournalDetail::whereHas('account', function ($q) {
            $q->where('type', 'expense');
        })->sum('credit');

        $totalRevenue = JournalDetail::whereHas('account', function ($q) {
            $q->where('type', 'revenue');
        })->sum('credit') - JournalDetail::whereHas('account', function ($q) {
            $q->where('type', 'revenue');
        })->sum('debit');

        $netIncome = $totalRevenue - $totalExpenses;

        return view('finance.dashboard', compact('totalAssets', 'totalLiabilities', 'totalRevenue', 'totalExpenses', 'netIncome'));
    }

    public function trialBalance(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-t'));

        $accounts = Account::with([
            'details' => function ($query) use ($startDate, $endDate) {
                $query->whereHas('journal', function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('date', [$startDate, $endDate]);
                });
            }
        ])->get();

        $trialBalance = $accounts->map(function ($account) {
            $debit = $account->details->sum('debit');
            $credit = $account->details->sum('credit');

            // Calculate ending balance based on account type
            // Asset/Expense: Debit - Credit
            // Liability/Equity/Revenue: Credit - Debit
            if (in_array($account->type, ['asset', 'expense'])) {
                $balance = $debit - $credit;
            } else {
                $balance = $credit - $debit;
            }

            return [
                'code' => $account->code,
                'name' => $account->name,
                'type' => $account->type,
                'debit' => $debit,
                'credit' => $credit,
                'balance' => $balance
            ];
        });

        return view('finance.reports.trial-balance', compact('trialBalance', 'startDate', 'endDate'));
    }

    public function generalLedger(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-t'));
        $accountId = $request->input('account_id');

        $accounts = Account::all();
        $ledgers = null;

        if ($accountId) {
            $account = Account::findOrFail($accountId);
            $ledgers = JournalDetail::where('account_id', $accountId)
                ->whereHas('journal', function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('date', [$startDate, $endDate]);
                })
                ->with('journal')
                ->get()
                ->sortBy('journal.date');
        }

        return view('finance.reports.general-ledger', compact('accounts', 'ledgers', 'startDate', 'endDate', 'accountId'));
    }

    public function profitAndLoss(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-t'));

        // Revenue
        $revenues = Account::where('type', 'revenue')->with([
            'details' => function ($query) use ($startDate, $endDate) {
                $query->whereHas('journal', function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('date', [$startDate, $endDate]);
                });
            }
        ])->get();

        // Expenses
        $expenses = Account::where('type', 'expense')->with([
            'details' => function ($query) use ($startDate, $endDate) {
                $query->whereHas('journal', function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('date', [$startDate, $endDate]);
                });
            }
        ])->get();

        $totalRevenue = $revenues->sum(function ($account) {
            return $account->details->sum('credit') - $account->details->sum('debit');
        });

        $totalExpenses = $expenses->sum(function ($account) {
            return $account->details->sum('debit') - $account->details->sum('credit');
        });

        $netIncome = $totalRevenue - $totalExpenses;

        return view('finance.reports.profit-loss', compact('revenues', 'expenses', 'totalRevenue', 'totalExpenses', 'netIncome', 'startDate', 'endDate'));
    }
    // Account CRUD
    public function indexAccounts()
    {
        $accounts = Account::orderBy('code')->get();
        return view('finance.accounts.index', compact('accounts'));
    }

    public function createAccount()
    {
        return view('finance.accounts.create');
    }

    public function storeAccount(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:accounts,code',
            'name' => 'required',
            'type' => 'required',
        ]);

        Account::create($request->all());

        return redirect()->route('finance.accounts.index')->with('success', 'Akun berhasil ditambahkan.');
    }

    public function editAccount(Account $account)
    {
        return view('finance.accounts.edit', compact('account'));
    }

    public function updateAccount(Request $request, Account $account)
    {
        $request->validate([
            'code' => 'required|unique:accounts,code,' . $account->id,
            'name' => 'required',
            'type' => 'required',
        ]);

        $account->update($request->all());

        return redirect()->route('finance.accounts.index')->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroyAccount(Account $account)
    {
        $account->delete();
        return redirect()->route('finance.accounts.index')->with('success', 'Akun berhasil dihapus.');
    }

    // Transaction (Journal) CRUD
    public function indexTransactions(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-t'));

        $journals = Journal::whereBetween('date', [$startDate, $endDate])
            ->latest()
            ->paginate(10);

        return view('finance.transactions.index', compact('journals', 'startDate', 'endDate'));
    }

    public function createTransaction()
    {
        $accounts = Account::orderBy('code')->get();
        return view('finance.transactions.create', compact('accounts'));
    }

    public function storeTransaction(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'description' => 'required',
            'details' => 'required|array|min:2',
            'details.*.account_id' => 'required|exists:accounts,id',
            'details.*.debit' => 'nullable|numeric|min:0',
            'details.*.credit' => 'nullable|numeric|min:0',
        ]);

        $details = $request->input('details');
        $totalDebit = collect($details)->sum('debit');
        $totalCredit = collect($details)->sum('credit');

        if ($totalDebit != $totalCredit) {
            return back()->withErrors(['message' => 'Total Debit dan Kredit harus seimbang (Balance).'])->withInput();
        }

        if ($totalDebit == 0) {
            return back()->withErrors(['message' => 'Total transaksi tidak boleh 0.'])->withInput();
        }

        DB::transaction(function () use ($request, $details, $totalDebit) {
            $journal = Journal::create([
                'date' => $request->date,
                'description' => $request->description,
                'reference' => $request->reference,
                'total_amount' => $totalDebit,
            ]);

            foreach ($details as $detail) {
                JournalDetail::create([
                    'journal_id' => $journal->id,
                    'account_id' => $detail['account_id'],
                    'debit' => $detail['debit'] ?? 0,
                    'credit' => $detail['credit'] ?? 0,
                    'description' => $request->description,
                ]);
            }
        });

        return redirect()->route('finance.transactions.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function destroyTransaction(Journal $journal)
    {
        $journal->delete();
        return redirect()->route('finance.transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
