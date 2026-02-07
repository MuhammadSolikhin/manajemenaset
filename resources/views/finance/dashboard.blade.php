<x-app-layout>
    <div class="row">
        <!-- Welcome Card -->
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Dashboard Keuangan 💰</h5>
                            <p class="mb-4">
                                Ringkasan posisi keuangan anda saat ini. Cek neraca saldo dan laba rugi secara berkala.
                            </p>
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
                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-building"></i></span>
                        </div>
                    </div>
                    <span>Total Aset</span>
                    <h3 class="card-title text-nowrap mb-1">{{ $totalAssets }} Akun</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-detail"></i></span>
                        </div>
                    </div>
                    <span>Liabilitas</span>
                    <h3 class="card-title text-nowrap mb-1">{{ $totalLiabilities }} Akun</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-dollar"></i></span>
                        </div>
                    </div>
                    <span>Pendapatan</span>
                    <h3 class="card-title text-nowrap mb-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-warning"><i
                                    class="bx bx-trending-up"></i></span>
                        </div>
                    </div>
                    <span>Laba Bersih</span>
                    <h3 class="card-title text-nowrap mb-1">Rp {{ number_format($netIncome, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>