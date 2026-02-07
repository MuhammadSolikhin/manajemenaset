<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Buku Besar (General Ledger)</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('finance.general-ledger') }}" class="row align-items-end mb-4">
                <div class="col-md-3">
                    <label class="form-label">Akun</label>
                    <select name="account_id" class="form-select">
                        <option value="">Pilih Akun</option>
                        @foreach ($accounts as $acc)
                            <option value="{{ $acc->id }}" {{ isset($accountId) && $accountId == $acc->id ? 'selected' : '' }}>
                                {{ $acc->code }} - {{ $acc->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>

            @if ($ledgers)
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>No. Referensi</th>
                                <th>Keterangan</th>
                                <th class="text-end">Debit</th>
                                <th class="text-end">Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalDebit = 0;
                                $totalCredit = 0;
                            @endphp
                            @forelse ($ledgers as $ledger)
                                @php
                                    $totalDebit += $ledger->debit;
                                    $totalCredit += $ledger->credit;
                                @endphp
                                <tr>
                                    <td>{{ $ledger->journal->date->format('d/m/Y') }}</td>
                                    <td>{{ $ledger->journal->reference }}</td>
                                    <td>{{ $ledger->journal->description }}</td>
                                    <td class="text-end">{{ number_format($ledger->debit, 2, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($ledger->credit, 2, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada transaksi pada periode ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <td colspan="3" class="text-end fw-bold">TOTAL PERIODE INI</td>
                                <td class="text-end fw-bold">{{ number_format($totalDebit, 2, ',', '.') }}</td>
                                <td class="text-end fw-bold">{{ number_format($totalCredit, 2, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <p class="text-muted">Silakan pilih akun untuk melihat rincian buku besar.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>