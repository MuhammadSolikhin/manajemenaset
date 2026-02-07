<x-app-layout>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tambah Akun Baru</h5>
            <small class="text-muted float-end">Chart of Accounts</small>
        </div>
        <div class="card-body">
            <form action="{{ route('finance.accounts.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="code">Kode Akun</label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="Contoh: 1001" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="name">Nama Akun</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Contoh: Kas Kecil"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="type">Tipe Akun</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="asset">Asset (Harta)</option>
                        <option value="liability">Liability (Utang)</option>
                        <option value="equity">Equity (Modal)</option>
                        <option value="revenue">Revenue (Pendapatan)</option>
                        <option value="expense">Expense (Beban)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="description">Keterangan</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('finance.accounts.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</x-app-layout>