<x-app-layout>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit Akun</h5>
            <small class="text-muted float-end">Chart of Accounts</small>
        </div>
        <div class="card-body">
            <form action="{{ route('finance.accounts.update', $account->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label" for="code">Kode Akun</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ $account->code }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="name">Nama Akun</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $account->name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="type">Tipe Akun</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="asset" {{ $account->type == 'asset' ? 'selected' : '' }}>Asset (Harta)</option>
                        <option value="liability" {{ $account->type == 'liability' ? 'selected' : '' }}>Liability (Utang)
                        </option>
                        <option value="equity" {{ $account->type == 'equity' ? 'selected' : '' }}>Equity (Modal)</option>
                        <option value="revenue" {{ $account->type == 'revenue' ? 'selected' : '' }}>Revenue (Pendapatan)
                        </option>
                        <option value="expense" {{ $account->type == 'expense' ? 'selected' : '' }}>Expense (Beban)
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="description">Keterangan</label>
                    <textarea class="form-control" id="description" name="description"
                        rows="3">{{ $account->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('finance.accounts.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</x-app-layout>