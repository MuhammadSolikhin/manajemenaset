<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Laporan Laba Rugi (Profit & Loss)</h5>
            <small>Periode: {{ date('d M Y', strtotime($startDate)) }} -
                {{ date('d M Y', strtotime($endDate)) }}</small>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('finance.profit-loss') }}" class="row align-items-end mb-4">
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

            <div class="table-responsive">
                <table class="table table-borderless">
                    <!-- Revenue Section -->
                    <thead>
                        <tr class="table-light">
                            <th colspan="2">PENDAPATAN (REVENUE)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($revenues as $revenue)
                            @php
                                $amount = $revenue->details->sum('credit') - $revenue->details->sum('debit');
                            @endphp
                            @if ($amount != 0)
                                <tr>
                                    <td>{{ $revenue->code }} - {{ $revenue->name }}</td>
                                    <td class="text-end">{{ number_format($amount, 2, ',', '.') }}</td>
                                </tr>
                            @endif
                        @endforeach
                        <tr class="fw-bold border-top">
                            <td>TOTAL PENDAPATAN</td>
                            <td class="text-end">{{ number_format($totalRevenue, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>

                    <!-- Expense Section -->
                    <thead>
                        <tr class="table-light">
                            <th colspan="2" class="pt-4">BEBAN (EXPENSES)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                            @php
                                $amount = $expense->details->sum('debit') - $expense->details->sum('credit');
                            @endphp
                            @if ($amount != 0)
                                <tr>
                                    <td>{{ $expense->code }} - {{ $expense->name }}</td>
                                    <td class="text-end">({{ number_format($amount, 2, ',', '.') }})</td>
                                </tr>
                            @endif
                        @endforeach
                        <tr class="fw-bold border-top">
                            <td>TOTAL BEBAN</td>
                            <td class="text-end">({{ number_format($totalExpenses, 2, ',', '.') }})</td>
                        </tr>
                    </tbody>

                    <!-- Net Income -->
                    <tfoot>
                        <tr class="table-dark fs-5">
                            <td class="pt-3">LABA BERSIH (NET INCOME)</td>
                            <td class="text-end pt-3">{{ number_format($netIncome, 2, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>