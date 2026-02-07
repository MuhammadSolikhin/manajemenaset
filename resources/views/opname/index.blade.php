<x-app-layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Opname</h5>
            <a href="{{ route('opname.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Mulai Opname Baru
            </a>
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
                                <span
                                    class="badge {{ $opname->status == 'completed' ? 'bg-label-success' : 'bg-label-warning' }}">
                                    {{ ucfirst($opname->status) }}
                                </span>
                            </td>
                            <td>{{ $opname->user->name }}</td>
                            <td>
                                <a href="{{ route('opname.show', $opname->id) }}" class="btn btn-sm btn-info">
                                    <i class="bx bx-show-alt me-1"></i> Detail
                                </a>
                                <form action="{{ route('opname.destroy', $opname->id) }}" method="POST"
                                    class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bx bx-trash me-1"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data opname.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>