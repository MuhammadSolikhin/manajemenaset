<x-app-layout>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Checkout Aset (Peminjaman)</h5>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <h6>Detail Aset</h6>
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-md me-3">
                        <span class="avatar-initial rounded-circle bg-label-primary"><i class='bx bx-cube'></i></span>
                    </div>
                    <div>
                        <h6 class="mb-0">{{ $asset->name }}</h6>
                        <small>{{ $asset->asset_code }}</small>
                    </div>
                </div>
            </div>

            <form action="{{ route('loans.store', $asset) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="user_id">Peminjam (Karyawan)</label>
                    <select id="user_id" name="user_id" class="form-select" required>
                        <option value="">Pilih Karyawan</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="notes">Catatan / Keperluan</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3"
                        placeholder="Contoh: Untuk keperluan proyek A"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Proses Peminjaman</button>
                <a href="{{ route('assets.show', $asset) }}" class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
</x-app-layout>