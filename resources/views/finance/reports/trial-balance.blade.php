<x-app-layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Neraca Saldo (Trial Balance)</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('finance.trial-balance') }}" class="row align-items-end mb-4">
                <div class="col-md-4">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>

            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Kode Akun</th>
                            <th>Nama Akun</th>
                            <th>Tipe</th>
                            <th class="text-end">Debit</th>
                            <th class="text-end">Kredit</th>
                            <th class="text-end">Saldo Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalDebit = 0;
                            $totalCredit = 0;
                        @endphp
                        @forelse ($trialBalance as $account)
                            @php
                                $totalDebit += $account['debit'];
                                $totalCredit += $account['credit'];
                            @endphp
                            <tr>
                                <td>{{ $account['code'] }}</td>
                                <td>{{ $account['name'] }}</td>
                                <td>{{ ucfirst($account['type']) }}</td>
                                <td class="text-end">{{ number_format($account['debit'], 2, ',', '.') }}</td>
                                <td class="text-end">{{ number_format($account['credit'], 2, ',', '.') }}</td>
                                <td class="text-end fw-bold">{{ number_format($account['balance'], 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="table-dark">
                            <td colspan="3" class="text-end fw-bold">TOTAL</td>
                            <td class="text-end fw-bold">{{ number_format($totalDebit, 2, ',', '.') }}</td>
                            <td class="text-end fw-bold">{{ number_format($totalCredit, 2, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>