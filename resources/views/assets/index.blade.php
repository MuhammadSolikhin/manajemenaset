<x-app-layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Aset</h5>
            <div class="d-flex gap-2">
                <form action="{{ route('assets.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari aset..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary"><i class="bx bx-search"></i></button>
                </form>
                <a href="{{ route('assets.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Tambah Aset
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible m-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Aset</th>
                        <th>Kode</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Harga</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($assets as $asset)
                        <tr>
                            <td>
                                <a href="{{ route('assets.show', $asset) }}" class="text-body">
                                    <i class="bx bx-cube fa-lg text-primary me-3"></i> <strong>{{ $asset->name }}</strong>
                                </a>
                            </td>
                            <td>{{ $asset->asset_code }}</td>
                            <td><span class="badge bg-label-info">{{ $asset->category->name ?? '-' }}</span></td>
                            <td>
                                @php
                                    $statusColors = [
                                        'available' => 'success',
                                        'deployed' => 'primary',
                                        'maintenance' => 'warning',
                                        'broken' => 'danger',
                                    ];
                                    $color = $statusColors[$asset->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-label-{{ $color }} me-1">{{ strtoupper($asset->status) }}</span>
                            </td>
                            <td>Rp {{ number_format($asset->price, 0, ',', '.') }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('assets.show', $asset) }}" class="btn btn-icon btn-outline-info"
                                        title="Detail">
                                        <i class="bx bx-show"></i>
                                    </a>
                                    <a href="{{ route('assets.edit', $asset) }}" class="btn btn-icon btn-outline-warning"
                                        title="Edit">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                    <form action="{{ route('assets.destroy', $asset) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-outline-danger" title="Delete">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data aset.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $assets->links() }}
        </div>
    </div>
</x-app-layout>