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
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Peminjaman</h5>
            <form method="GET" action="<?php echo e(route('loans.index')); ?>" class="d-flex align-items-center">
                <input type="search" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm me-2" placeholder="Cari aset/peminjam/unit...">
                <div class="me-2">
                    <input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo e(request('date_from')); ?>" placeholder="From">
                </div>
                <div class="me-2">
                    <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo e(request('date_to')); ?>" placeholder="To">
                </div>
                <button class="btn btn-sm btn-outline-secondary" type="submit">Filter</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Aset</th>
                            <th>Peminjam</th>
                            <th>Jumlah</th>
                            <th>Units</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loan->id); ?></td>
                                <td><?php echo e($loan->asset->name ?? '-'); ?></td>
                                <td><?php echo e($loan->user->name ?? '-'); ?></td>
                                <td>
                                    <?php if($loan->status === 'returned'): ?>
                                        <?php echo e($loan->original_quantity ?? $loan->quantity_borrowed); ?>

                                    <?php else: ?>
                                        <?php echo e($loan->quantity_borrowed); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($loan->units->count()): ?>
                                        <?php echo e($loan->units->count()); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(ucfirst($loan->status)); ?></td>
                                <td><?php echo e($loan->loan_date->format('d M Y')); ?></td>
                                <td>
                                    <a href="<?php echo e(route('loans.show', $loan)); ?>" class="btn btn-sm btn-info">Detail</a>
                                    <?php if($loan->status == 'borrowed'): ?>
                                        <a href="<?php echo e(route('loans.return.units.form', $loan)); ?>" class="btn btn-sm btn-outline-primary ms-1">Return Units</a>
                                        <form action="<?php echo e(route('loans.return', $loan)); ?>" method="POST" class="d-inline ms-1">
                                            <?php echo csrf_field(); ?>
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Return seluruh pinjaman?')">Return All</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <?php echo e($loans->appends(request()->query())->links()); ?>

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
<?php /**PATH C:\laragon\www\manajemenaset\resources\views/loans/index.blade.php ENDPATH**/ ?>