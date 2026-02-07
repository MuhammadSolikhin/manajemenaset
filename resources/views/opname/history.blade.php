<x-app-layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Riwayat Opname</h5>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Penanggung Jawab</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($opnames as $opname)
                        <tr>
                            <td>{{ $opname->date->format('d M Y') }}</td>
                            <td>{{ $opname->location }}</td>
                            <td>
                                <span class="badge bg-label-success">
                                    {{ ucfirst($opname->status) }}
                                </span>
                            </td>
                            <td>{{ $opname->user->name }}</td>
                            <td>
                                <a href="{{ route('opname.show', $opname->id) }}" class="btn btn-sm btn-info">
                                    <i class="bx bx-show-alt me-1"></i> Detail
                                </a>
                                <a href="{{ route('opname.print', $opname->id) }}" target="_blank"
                                    class="btn btn-sm btn-secondary">
                                    <i class="bx bx-printer me-1"></i> Cetak
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada riwayat opname yang selesai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>