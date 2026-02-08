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
            <h5 class="mb-0">Daftar Unit Aset</h5>
            <div class="d-flex">
                <form method="GET" action="<?php echo e(route('units.index')); ?>" class="me-2">
                    <div class="input-group input-group-sm">
                        <input type="search" name="search" value="<?php echo e(request('search')); ?>" class="form-control" placeholder="Cari identifier, aset, atau catatan...">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </form>
                <a href="<?php echo e(route('units.create')); ?>" class="btn btn-primary btn-sm">Tambah Unit</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Aset</th>
                            <th>Identifier</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($unit->id); ?></td>
                                <td><?php echo e($unit->asset->name ?? '-'); ?></td>
                                <td><strong><?php echo e($unit->unique_identifier ?? '-'); ?></strong></td>
                                <td>
                                    <span class="badge bg-label-<?php echo e($unit->status == 'available' ? 'success' : ($unit->status == 'retired' ? 'danger' : ($unit->status == 'maintenance' ? 'warning' : 'secondary'))); ?>">
                                        <?php echo e(ucfirst($unit->status)); ?>

                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <?php if($unit->status !== 'available' && $unit->status !== 'borrowed'): ?>
                                            <form action="<?php echo e(route('units.available', $unit)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <button class="btn btn-outline-success btn-sm" title="Set Available">Available</button>
                                            </form>
                                        <?php endif; ?>
                                        <?php if($unit->status !== 'maintenance'): ?>
                                            <form action="<?php echo e(route('units.maintenance', $unit)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <button class="btn btn-outline-warning btn-sm" title="Set Maintenance">Maintenance</button>
                                            </form>
                                        <?php endif; ?>
                                        <?php if($unit->status !== 'retired'): ?>
                                            <form action="<?php echo e(route('units.retire', $unit)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <button class="btn btn-outline-danger btn-sm" title="Retire">Retire</button>
                                            </form>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('units.edit', $unit)); ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <?php echo e($units->appends(request()->query())->links()); ?>

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
<?php /**PATH C:\laragon\www\manajemenaset\resources\views/units/index.blade.php ENDPATH**/ ?>