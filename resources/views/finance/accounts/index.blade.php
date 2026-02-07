<x-app-layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Akun (Chart of Accounts)</h5>
            <a href="{{ route('finance.accounts.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Tambah Akun
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Akun</th>
                        <th>Tipe</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($accounts as $account)
                        <tr>
                            <td><strong>{{ $account->code }}</strong></td>
                            <td>{{ $account->name }}</td>
                            <td>
                                <span class="badge bg-label-primary">{{ ucfirst($account->type) }}</span>
                            </td>
                            <td>{{ $account->description }}</td>
                            <td>
                                <a href="{{ route('finance.accounts.edit', $account->id) }}" class="btn btn-sm btn-info">
                                    <i class="bx bx-edit-alt"></i>
                                </a>
                                <form action="{{ route('finance.accounts.destroy', $account->id) }}" method="POST"
                                    class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus akun ini?')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data akun.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>