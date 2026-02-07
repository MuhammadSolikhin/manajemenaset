<x-app-layout>
    <div class="row">
        <!-- Filter Card -->
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Filter Laporan Opname</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('opname.report') }}" method="GET" class="row align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bx bx-filter-alt me-1"></i> Tampilkan Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Report Summary -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Hasil Laporan</h5>
                    <small>Periode: {{ date('d M Y', strtotime($startDate)) }} -
                        {{ date('d M Y', strtotime($endDate)) }}</small>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="table-light">
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Petugas</th>
                                <th class="text-center">Total Aset</th>
                                <th class="text-center">Sesuai</th>
                                <th class="text-center">Selisih</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($opnames as $opname)
                                @php
                                    $totalAssets = $opname->details->count();
                                    $match = $opname->details->where('difference', 0)->count();
                                    $mismatch = $totalAssets - $match;
                                @endphp
                                <tr>
                                    <td>{{ $opname->date->format('d M Y') }}</td>
                                    <td>{{ $opname->location }}</td>
                                    <td>{{ $opname->user->name }}</td>
                                    <td class="text-center fw-bold">{{ $totalAssets }}</td>
                                    <td class="text-center text-success fw-bold">{{ $match }}</td>
                                    <td class="text-center text-danger fw-bold">{{ $mismatch }}</td>
                                    <td>
                                        <a href="{{ route('opname.show', $opname->id) }}" class="btn btn-sm btn-info">
                                            <i class="bx bx-show-alt"></i>
                                        </a>
                                        <a href="{{ route('opname.print', $opname->id) }}" target="_blank"
                                            class="btn btn-sm btn-secondary">
                                            <i class="bx bx-printer"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bx bx-search-alt fs-1 text-muted mb-2"></i>
                                            <span class="text-muted">Tidak ada data opname pada periode ini.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>