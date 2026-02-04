<x-app-layout>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tambah Aset Baru</h5>
            <small class="text-muted float-end">Input data aset dengan lengkap</small>
        </div>
        <div class="card-body">
            <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Nama Aset</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Laptop Dell XPS 15"
                        value="{{ old('name') }}" required />
                    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="asset_code">Kode Aset</label>
                        <input type="text" class="form-control" id="asset_code" name="asset_code" placeholder="AST-001"
                            value="{{ old('asset_code') }}" required />
                        @error('asset_code') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="category_id">Kategori</label>
                        <select id="category_id" name="category_id" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="status">Status</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available
                            </option>
                            <option value="deployed" {{ old('status') == 'deployed' ? 'selected' : '' }}>Deployed</option>
                            <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance
                            </option>
                            <option value="broken" {{ old('status') == 'broken' ? 'selected' : '' }}>Broken</option>
                        </select>
                        @error('status') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="purchase_date">Tanggal Pembelian</label>
                        <input type="date" class="form-control" id="purchase_date" name="purchase_date"
                            value="{{ old('purchase_date') }}" required />
                        @error('purchase_date') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="price">Harga (Rp)</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control" id="price" name="price" placeholder="15000000"
                            value="{{ old('price') }}" required />
                        <span class="input-group-text">.00</span>
                    </div>
                    @error('price') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="image">Gambar Aset (Opsional)</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" />
                    @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Aset</button>
                <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
</x-app-layout>