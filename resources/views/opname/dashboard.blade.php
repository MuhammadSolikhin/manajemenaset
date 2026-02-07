<x-app-layout>
    <div class="row">
        <!-- Welcome Card -->
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Datang di Dashboard Opname! 🎉</h5>
                            <p class="mb-4">
                                Anda memiliki <span class="fw-bold">{{ $pendingOpnames }}</span> sesi opname yang sedang
                                berjalan.
                                Segera selesaikan untuk memperbarui stok aset.
                            </p>
                            <a href="{{ route('opname.create') }}" class="btn btn-sm btn-outline-primary">Mulai Opname
                                Baru</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-calendar"></i></span>
                        </div>
                    </div>
                    <span>Total Sesi</span>
                    <h3 class="card-title text-nowrap mb-1">{{ $totalOpnames }}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-time-five"></i></span>
                        </div>
                    </div>
                    <span>Berjalan</span>
                    <h3 class="card-title text-nowrap mb-1">{{ $pendingOpnames }}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-success"><i
                                    class="bx bx-check-circle"></i></span>
                        </div>
                    </div>
                    <span>Selesai</span>
                    <h3 class="card-title text-nowrap mb-1">{{ $completedOpnames }}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-box"></i></span>
                        </div>
                    </div>
                    <span>Total Aset Diaudit</span>
                    <h3 class="card-title text-nowrap mb-1">{{ number_format($totalAssetsAudited) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Aktivitas Opname Terbaru</h5>
                    <a href="{{ route('opname.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
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
                        <tbody>
                            @forelse ($recentOpnames as $opname)
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
                                        <a href="{{ route('opname.show', $opname->id) }}"
                                            class="btn btn-sm btn-icon btn-outline-info">
                                            <i class="bx bx-show-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada aktivitas opname.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>