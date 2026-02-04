<x-app-layout>
    <div class="row mb-4">
        <div class="col-lg-4 col-md-4 order-1">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-cube"></i></span>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Aset</span>
                    <h3 class="card-title mb-2">{{ $totalAssets }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-2">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-check-circle"></i></span>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Available</span>
                    <h3 class="card-title mb-2">{{ $availableAssets }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-user"></i></span>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Deployed</span>
                    <h3 class="card-title mb-2">{{ $deployedAssets }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Welcome Back, {{ Auth::user()->name }}! 🎉</h5>
                            <p class="mb-4">
                                You have successfully logged in as <span class="fw-bold">Admin</span>. Check your asset
                                status below.
                            </p>

                            <a href="{{ route('assets.index') }}" class="btn btn-sm btn-outline-primary">View Assets</a>
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
    </div>
</x-app-layout>