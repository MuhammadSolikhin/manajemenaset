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
            <h5 class="mb-0">Riwayat Pengembalian</h5>
            <div class="d-flex">
                <form method="GET" action="<?php echo e(route('loans.returned')); ?>" class="d-flex me-2">
                    <input type="search" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm me-1" placeholder="Cari aset/peminjam/unit...">
                    <input type="date" name="date_from" class="form-control form-control-sm me-1" value="<?php echo e(request('date_from')); ?>">
                    <input type="date" name="date_to" class="form-control form-control-sm me-1" value="<?php echo e(request('date_to')); ?>">
                    <button class="btn btn-sm btn-outline-secondary" type="submit">Filter</button>
                </form>
                <a href="<?php echo e(route('loans.index')); ?>" class="btn btn-outline-primary">Kembali ke Peminjaman</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Aset</th>
                            <th>Peminjam</th>
                            <th>Unit</th>
                            <th>Catatan Pengembalian</th>
                            <th>Tanggal Kembali</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($batch->batch_id); ?></td>
                                <td><?php echo e($batch->loan->asset->name ?? '-'); ?></td>
                                <td><?php echo e($batch->user->name ?? '-'); ?></td>
                                <td>
                                    <?php $__currentLoopData = $batch->units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div><?php echo e($u->unit->unique_identifier ?? ('Unit #' . $u->unit->id)); ?></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td>
                                    <?php $__currentLoopData = $batch->units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div><?php echo e($u->notes ?? '-'); ?></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td><?php echo e($batch->returned_at?->format('d M Y H:i') ?? '-'); ?></td>
                                <td>
                                    <a href="<?php echo e(route('loans.show', $batch->loan)); ?>" class="btn btn-sm btn-outline-info">Detail Pinjaman</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <?php echo e($batches->appends(request()->query())->links()); ?>

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
<?php /**PATH C:\laragon\www\manajemenaset\resources\views/loans/returned.blade.php ENDPATH**/ ?>