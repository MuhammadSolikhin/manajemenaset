<x-app-layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Transaksi (Jurnal Umum)</h5>
            <a href="{{ route('finance.transactions.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Catat Transaksi
            </a>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('finance.transactions.index') }}" class="row align-items-end mb-4">
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No. Ref</th>
                            <th>Keterangan</th>
                            <th class="text-end">Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($journals as $journal)
                            <tr>
                                <td>{{ $journal->date->format('d/m/Y') }}</td>
                                <td><span class="badge bg-label-secondary">{{ $journal->reference }}</span></td>
                                <td>{{ Str::limit($journal->description, 50) }}</td>
                                <td class="text-end fw-bold">Rp {{ number_format($journal->total_amount, 0, ',', '.') }}
                                </td>
                                <td>
                                    {{-- Detail view can be added later --}}
                                    <form action="{{ route('finance.transactions.destroy', $journal->id) }}" method="POST"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada transaksi pada periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $journals->links() }}
            </div>
        </div>
    </div>
</x-app-layout>