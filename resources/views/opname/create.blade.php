<x-app-layout>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Mulai Opname Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('opname.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="date">Tanggal Opname</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="location">Lokasi</label>
                            <input type="text" class="form-control" id="location" name="location"
                                placeholder="Misal: Gudang Utama, Lantai 1" required />
                            <div class="form-text">Masukkan lokasi aset yang akan diopname.</div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('opname.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Mulai Sesi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>