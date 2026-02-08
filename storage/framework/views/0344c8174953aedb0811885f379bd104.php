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
            <h5 class="mb-0">Detail Peminjaman #<?php echo e($loan->id); ?></h5>
            <div>
                <a href="<?php echo e(route('loans.index')); ?>" class="btn btn-outline-secondary">Kembali</a>
                <?php if($loan->status == 'borrowed'): ?>
                    <form action="<?php echo e(route('loans.return', $loan)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-danger" onclick="return confirm('Return seluruh pinjaman?')">Return All</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Aset</dt>
                <dd class="col-sm-9"><?php echo e($loan->asset->name ?? '-'); ?></dd>

                <dt class="col-sm-3">Peminjam</dt>
                <dd class="col-sm-9"><?php echo e($loan->user->name ?? '-'); ?></dd>

                <dt class="col-sm-3">Jumlah Dipinjam</dt>
                <dd class="col-sm-9"><?php echo e($loan->original_quantity ?? $loan->quantity_borrowed); ?></dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9"><?php echo e(ucfirst($loan->status)); ?></dd>

                <dt class="col-sm-3">Tanggal Pinjam</dt>
                <dd class="col-sm-9"><?php echo e($loan->loan_date?->format('d M Y H:i') ?? '-'); ?></dd>

                <dt class="col-sm-3">Tanggal Kembali</dt>
                <dd class="col-sm-9"><?php echo e($loan->return_date?->format('d M Y H:i') ?? '-'); ?></dd>

                <dt class="col-sm-3">Units</dt>
                <dd class="col-sm-9">
                    <?php if($loan->units->count()): ?>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Identifier</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $loan->units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($i + 1); ?></td>
                                        <td><?php echo e($unit->unique_identifier ?? ('Unit #' . $unit->id)); ?></td>
                                        <td><?php echo e(ucfirst($unit->status)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </dd>

                <dt class="col-sm-3">Catatan</dt>
                <dd class="col-sm-9"><?php echo e($loan->notes ?? '-'); ?></dd>
            </dl>
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
<?php /**PATH C:\laragon\www\manajemenaset\resources\views/loans/show.blade.php ENDPATH**/ ?>