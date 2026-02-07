<x-app-layout>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Catat Transaksi Baru</h5>
            <small class="text-muted float-end">Jurnal Umum</small>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('finance.transactions.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="date" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">No. Referensi</label>
                        <input type="text" class="form-control" name="reference" placeholder="Contoh: BKK-001">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan Transaksi</label>
                    <textarea class="form-control" name="description" rows="2"
                        placeholder="Contoh: Pembayaran Listrik Bulan Januari" required></textarea>
                </div>

                <hr class="my-4">
                <h6>Rincian Jurnal (Debit & Kredit)</h6>

                <div id="journal-entries">
                    <div class="row mb-2 entry-row">
                        <div class="col-md-5">
                            <select name="details[0][account_id]" class="form-select" required>
                                <option value="">Pilih Akun</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->code }} - {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="details[0][debit]" class="form-control debit-input"
                                placeholder="Debit" value="0">
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="details[0][credit]" class="form-control credit-input"
                                placeholder="Kredit" value="0">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm remove-row" disabled><i
                                    class="bx bx-trash"></i></button>
                        </div>
                    </div>

                    {{-- Default 2nd row for Credit --}}
                    <div class="row mb-2 entry-row">
                        <div class="col-md-5">
                            <select name="details[1][account_id]" class="form-select" required>
                                <option value="">Pilih Akun</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->code }} - {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="details[1][debit]" class="form-control debit-input"
                                placeholder="Debit" value="0">
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="details[1][credit]" class="form-control credit-input"
                                placeholder="Kredit" value="0">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm remove-row"><i
                                    class="bx bx-trash"></i></button>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-outline-primary btn-sm" id="add-row">
                        <i class="bx bx-plus"></i> Tambah Baris
                    </button>
                </div>

                <div class="alert alert-info d-flex justify-content-between">
                    <span>Total Debit: <strong>Rp <span id="total-debit">0</span></strong></span>
                    <span>Total Kredit: <strong>Rp <span id="total-credit">0</span></strong></span>
                    <span id="balance-status" class="badge bg-success">Seimbang</span>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                <a href="{{ route('finance.transactions.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('journal-entries');
            const addBtn = document.getElementById('add-row');
            let rowCount = 2;

            function updateTotals() {
                let totalDebit = 0;
                let totalCredit = 0;

                document.querySelectorAll('.debit-input').forEach(input => totalDebit += parseFloat(input.value) || 0);
                document.querySelectorAll('.credit-input').forEach(input => totalCredit += parseFloat(input.value) || 0);

                document.getElementById('total-debit').innerText = new Intl.NumberFormat('id-ID').format(totalDebit);
                document.getElementById('total-credit').innerText = new Intl.NumberFormat('id-ID').format(totalCredit);

                const status = document.getElementById('balance-status');
                if (totalDebit === totalCredit && totalDebit > 0) {
                    status.className = 'badge bg-success';
                    status.innerText = 'Seimbang';
                } else {
                    status.className = 'badge bg-danger';
                    status.innerText = 'Tidak Seimbang';
                }
            }

            container.addEventListener('input', function (e) {
                if (e.target.classList.contains('debit-input') || e.target.classList.contains('credit-input')) {
                    updateTotals();
                }
            });

            container.addEventListener('click', function (e) {
                if (e.target.closest('.remove-row')) {
                    e.target.closest('.entry-row').remove();
                    updateTotals();
                }
            });

            addBtn.addEventListener('click', function () {
                const template = `
                    <div class="row mb-2 entry-row">
                        <div class="col-md-5">
                            <select name="details[${rowCount}][account_id]" class="form-select" required>
                                <option value="">Pilih Akun</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->code }} - {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="details[${rowCount}][debit]" class="form-control debit-input" placeholder="Debit" value="0">
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="details[${rowCount}][credit]" class="form-control credit-input" placeholder="Kredit" value="0">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm remove-row"><i class="bx bx-trash"></i></button>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', template);
                rowCount++;
            });
        });
    </script>
</x-app-layout>