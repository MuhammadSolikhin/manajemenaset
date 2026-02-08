<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if(in_array((Auth::user()->role ?? 'karyawan'), ['admin', 'super_admin'], true)): ?>
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 order-1">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-cube"></i></span>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Aset (types)</span>
                    <h3 class="card-title mb-2"><?php echo e($totalAssets); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 order-2">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-cube"></i></span>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Units</span>
                    <h3 class="card-title mb-2"><?php echo e($totalUnits ?? 0); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 order-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-check-circle"></i></span>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Available Units</span>
                    <h3 class="card-title mb-2"><?php echo e($availableUnits ?? 0); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 order-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-user"></i></span>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Units In Use</span>
                    <h3 class="card-title mb-2"><?php echo e($borrowedUnits ?? 0); ?></h3>
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
                            <h5 class="card-title text-primary">Welcome Back, <?php echo e(Auth::user()->name); ?>! </h5>
                            <p class="mb-4">
                                You have successfully logged in as <span class="fw-bold"><?php echo e(ucfirst(Auth::user()->role ?? 'karyawan')); ?></span>. Check your asset
                                status below.
                            </p>

                            <a href="<?php echo e(route('assets.index')); ?>" class="btn btn-sm btn-outline-primary">View Assets</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="<?php echo e(asset('assets/img/illustrations/man-with-laptop-light.png')); ?>" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Peminjaman Aktif</span>
                    <h3 class="card-title mb-2"><?php echo e($myBorrowed ?? 0); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Total Unit Dipinjam</span>
                    <h3 class="card-title mb-2"><?php echo e($myBorrowedUnits ?? 0); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Riwayat Pengembalian</span>
                    <h3 class="card-title mb-2"><?php echo e($myReturned ?? 0); ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-primary">Welcome Back, <?php echo e(Auth::user()->name); ?>! </h5>
                    <p class="mb-4">Silakan kelola peminjaman dan pengembalian aset Anda.</p>
                    <a href="<?php echo e(route('loans.index')); ?>" class="btn btn-sm btn-outline-primary me-2">Peminjaman Saya</a>
                    <a href="<?php echo e(route('loans.returned')); ?>" class="btn btn-sm btn-outline-secondary">Riwayat Pengembalian</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\manajemenaset\resources\views/dashboard.blade.php ENDPATH**/ ?>