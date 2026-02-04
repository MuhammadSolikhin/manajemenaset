<x-app-layout>
    <div class="row">
        <!-- Asset Details -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    @if($asset->image)
                        <img src="{{ asset('storage/' . $asset->image) }}" alt="Asset Image" class="img-fluid rounded mb-3"
                            style="max-height: 200px;">
                    @else
                        <div class="d-flex justify-content-center align-items-center bg-label-secondary rounded mb-3"
                            style="height: 200px;">
                            <i class="bx bx-image fs-1"></i>
                        </div>
                    @endif

                    <h4>{{ $asset->name }}</h4>
                    <p class="text-muted">{{ $asset->asset_code }}</p>

                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <span
                            class="badge bg-label-{{ $asset->status == 'available' ? 'success' : ($asset->status == 'deployed' ? 'primary' : 'warning') }}">
                            {{ strtoupper($asset->status) }}
                        </span>
                        <span class="badge bg-label-info">{{ $asset->category->name }}</span>
                    </div>

                    <!-- QR Code (Simulated with API) -->
                    <div class="mb-3 d-flex flex-column align-items-center">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $asset->asset_code }}"
                            alt="QR Code" class="img-thumbnail mb-1">
                        <div class="small text-muted">Scan to Identify</div>
                    </div>

                    <div class="d-grid gap-2">
                        @if($asset->status == 'available')
                            <a href="{{ route('loans.create', $asset) }}" class="btn btn-primary">
                                <i class="bx bx-export me-1"></i> Checkout (Pinjamkan)
                            </a>
                        @elseif($asset->status == 'deployed' && $asset->activeLoan)
                            <form action="{{ route('loans.return', $asset->activeLoan) }}" method="POST" class="d-block">
                                @csrf
                                <button type="submit" class="btn btn-warning w-100"
                                    onclick="return confirm('Konfirmasi pengembalian aset?')">
                                    <i class="bx bx-import me-1"></i> Return (Kembalikan)
                                </button>
                            </form>
                            <div class="alert alert-info mt-2 mb-0 text-start">
                                <small>Dipinjam oleh: <strong>{{ $asset->activeLoan->user->name }}</strong><br>
                                    Sejak: {{ $asset->activeLoan->loan_date->format('d M Y') }}</small>
                            </div>
                        @endif

                        <a href="{{ route('assets.edit', $asset) }}" class="btn btn-outline-secondary">Edit Asset</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Tabs -->
        <div class="col-md-8">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-details">
                            Detail & Spesifikasi
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-depreciation">
                            Depresiasi
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-history">
                            Riwayat (Log)
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- Detail Tab -->
                    <div class="tab-pane fade show active" id="navs-details" role="tabpanel">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th class="w-25">Harga Beli</th>
                                    <td>Rp {{ number_format($asset->price, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Beli</th>
                                    <td>{{ $asset->purchase_date->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Masa Manfaat</th>
                                    <td>{{ $asset->useful_life }} Tahun</td>
                                </tr>
                                <tr>
                                    <th>Nilai Sisa</th>
                                    <td>Rp {{ number_format($asset->residual_value, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Dibuat Pada</th>
                                    <td>{{ $asset->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Depreciation Tab -->
                    <div class="tab-pane fade" id="navs-depreciation" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tahun Ke</th>
                                        <th>Tanggal</th>
                                        <th>Penyusutan</th>
                                        <th>Nilai Buku</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($depreciationSchedule as $schedule)
                                        <tr>
                                            <td>{{ $schedule['year'] }}</td>
                                            <td>{{ $schedule['date'] }}</td>
                                            <td>Rp {{ number_format($schedule['depreciation_amount'], 2) }}</td>
                                            <td>Rp {{ number_format($schedule['book_value'], 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- History Tab -->
                    <div class="tab-pane fade" id="navs-history" role="tabpanel">
                        <ul class="timeline">
                            @forelse($logs as $log)
                                <li class="timeline-item timeline-item-transparent">
                                    <span class="timeline-point timeline-point-primary"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">{{ $log->action }}</h6>
                                            <small class="text-muted">{{ $log->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-2">{{ $log->user->name ?? 'System' }} melakukan
                                            {{ strtolower($log->action) }}
                                        </p>
                                        @if($log->details && is_array($log->details))
                                            <div class="bg-label-secondary p-2 rounded">
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($log->details as $key => $value)
                                                        <li>
                                                            <small><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> 
                                                            {{ is_array($value) ? json_encode($value) : $value }}</small>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @empty
                                <p class="text-center">Belum ada riwayat.</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>