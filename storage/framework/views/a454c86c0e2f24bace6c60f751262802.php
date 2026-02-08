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
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Laporan Aset</h5>
                <small class="text-muted">Periode: <?php echo e($periodLabel); ?></small>
            </div>
            <div class="d-flex gap-2">
                <a href="<?php echo e(route('reports.export.excel', request()->query())); ?>" class="btn btn-outline-success btn-sm">Export Excel</a>
                <a href="<?php echo e(route('reports.export.pdf', request()->query())); ?>" class="btn btn-outline-danger btn-sm">Export PDF</a>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('reports.index')); ?>" class="row g-2 mb-3">
                <div class="col-md-4">
                    <input type="date" name="date_from" class="form-control" value="<?php echo e($filterDateFrom); ?>" placeholder="Dari tanggal">
                </div>
                <div class="col-md-4">
                    <input type="date" name="date_to" class="form-control" value="<?php echo e($filterDateTo); ?>" placeholder="Sampai tanggal">
                </div>
                <div class="col-md-4">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                        <a href="<?php echo e(route('reports.index')); ?>" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </form>
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="fw-semibold">Total Aset (types)</div>
                            <div class="fs-4"><?php echo e($totalAssetTypes); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="fw-semibold">Total Units</div>
                            <div class="fs-4"><?php echo e($totalUnits); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="fw-semibold">Total Harga Aset</div>
                            <div class="fs-4">Rp <?php echo e(number_format($totalAssetValue, 0, ',', '.')); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="fw-semibold">Total Dipinjam (Unit)</div>
                            <div class="fs-4"><?php echo e($borrowedUnits); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="fw-semibold">Total Pernah Dipinjam (Unit)</div>
                            <div class="fs-4"><?php echo e($returnedUnits); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="fw-semibold">Kerugian (Unit Tidak Bisa Dipakai)</div>
                            <div class="fs-4"><?php echo e($notUsableUnits); ?> unit</div>
                            <div class="text-muted">Rp <?php echo e(number_format($notUsableValue, 0, ',', '.')); ?></div>
                            <div class="small text-muted">Status dihitung: <?php echo e(implode(', ', $notUsableStatuses)); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Status Unit</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $unitStatusCounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(ucfirst($status)); ?></td>
                                    <td><?php echo e($count); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Status Aset</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $assetStatusCounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(ucfirst($status)); ?></td>
                                    <td><?php echo e($count); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h6 class="mb-0">Detail Aset Sedang Dipinjam</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Aset</th>
                            <th>Peminjam</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $borrowedLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($loan->asset->name ?? '-'); ?></td>
                                <td><?php echo e($loan->user->name ?? '-'); ?></td>
                                <td><?php echo e($loan->quantity_borrowed); ?></td>
                                <td><?php echo e(optional($loan->loan_date)->format('d M Y')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada peminjaman aktif.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h6 class="mb-0">Detail Aset Pernah Dipinjam</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Aset</th>
                            <th>Peminjam</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $returnedLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($loan->asset->name ?? '-'); ?></td>
                                <td><?php echo e($loan->user->name ?? '-'); ?></td>
                                <td><?php echo e($loan->original_quantity ?? $loan->quantity_borrowed); ?></td>
                                <td><?php echo e(optional($loan->loan_date)->format('d M Y')); ?></td>
                                <td><?php echo e(optional($loan->return_date)->format('d M Y')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada riwayat peminjaman.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\manajemenaset\resources\views/reports/index.blade.php ENDPATH**/ ?>