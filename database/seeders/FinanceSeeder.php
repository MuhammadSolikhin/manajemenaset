<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Journal;
use App\Models\JournalDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class FinanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Chart of Accounts
        $accounts = [
            // Assets
            ['code' => '1001', 'name' => 'Kas Besar', 'type' => 'asset'],
            ['code' => '1002', 'name' => 'Bank BCA', 'type' => 'asset'],
            ['code' => '1003', 'name' => 'Piutang Usaha', 'type' => 'asset'],
            ['code' => '1201', 'name' => 'Peralatan Kantor', 'type' => 'asset'],
            ['code' => '1202', 'name' => 'Akumulasi Penyusutan Peralatan', 'type' => 'asset'],

            // Liabilities
            ['code' => '2001', 'name' => 'Utang Usaha', 'type' => 'liability'],
            ['code' => '2002', 'name' => 'Utang Gaji', 'type' => 'liability'],

            // Equity
            ['code' => '3001', 'name' => 'Modal Disetor', 'type' => 'equity'],
            ['code' => '3002', 'name' => 'Laba Ditahan', 'type' => 'equity'],

            // Revenue
            ['code' => '4001', 'name' => 'Pendapatan Jasa', 'type' => 'revenue'],
            ['code' => '4002', 'name' => 'Pendapatan Lain-lain', 'type' => 'revenue'],

            // Expenses
            ['code' => '5001', 'name' => 'Beban Gaji', 'type' => 'expense'],
            ['code' => '5002', 'name' => 'Beban Sewa', 'type' => 'expense'],
            ['code' => '5003', 'name' => 'Beban Listrik & Air', 'type' => 'expense'],
            ['code' => '5004', 'name' => 'Beban Penyusutan', 'type' => 'expense'],
            ['code' => '5005', 'name' => 'Beban Perlengkapan', 'type' => 'expense'],
        ];

        foreach ($accounts as $acc) {
            Account::firstOrCreate(['code' => $acc['code']], $acc);
        }

        // 2. Create Dummy Journals (Transactions)
        $this->createTransaction(
            '2026-02-01',
            'Setoran Modal Awal',
            'J-001',
            100000000,
            '1002', // Debit Bank BCA
            '3001'  // Credit Modal Disetor
        );

        $this->createTransaction(
            '2026-02-02',
            'Bayar Sewa Kantor Februari',
            'J-002',
            5000000,
            '5002', // Debit Beban Sewa
            '1002'  // Credit Bank BCA
        );

        $this->createTransaction(
            '2026-02-05',
            'Pendapatan Jasa Konsultasi',
            'J-003',
            15000000,
            '1002', // Debit Bank BCA
            '4001'  // Credit Pendapatan Jasa
        );

        $this->createTransaction(
            '2026-02-10',
            'Beli Perlengkapan Kantor',
            'J-004',
            2500000,
            '5005', // Debit Beban Perlengkapan
            '1001'  // Credit Kas Besar
        );

        $this->createTransaction(
            '2026-02-25',
            'Bayar Gaji Karyawan',
            'J-005',
            12000000,
            '5001', // Debit Beban Gaji
            '1002'  // Credit Bank BCA
        );

        $this->createTransaction(
            '2026-02-28',
            'Tagihan Listrik Februari',
            'J-006',
            1500000,
            '5003', // Debit Beban Listrik
            '2001'  // Credit Utang Usaha (accrued)
        );
    }

    private function createTransaction($date, $desc, $ref, $amount, $debitCode, $creditCode)
    {
        $journal = Journal::create([
            'date' => $date,
            'description' => $desc,
            'reference' => $ref,
            'total_amount' => $amount,
        ]);

        $debitAcc = Account::where('code', $debitCode)->first();
        $creditAcc = Account::where('code', $creditCode)->first();

        // Debit Entry
        JournalDetail::create([
            'journal_id' => $journal->id,
            'account_id' => $debitAcc->id,
            'debit' => $amount,
            'credit' => 0,
            'description' => $desc
        ]);

        // Credit Entry
        JournalDetail::create([
            'journal_id' => $journal->id,
            'account_id' => $creditAcc->id,
            'debit' => 0,
            'credit' => $amount,
            'description' => $desc
        ]);
    }
}
