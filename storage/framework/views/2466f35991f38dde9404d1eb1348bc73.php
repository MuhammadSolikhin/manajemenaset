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
            <h5 class="mb-0">Daftar Brand</h5>
            <div class="d-flex gap-2">
                <form action="<?php echo e(route('brands.index')); ?>" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari brand..." value="<?php echo e(request('search')); ?>">
                    <button type="submit" class="btn btn-outline-primary"><i class="bx bx-search"></i></button>
                </form>
                <a href="<?php echo e(route('brands.create')); ?>" class="btn btn-primary btn-sm">
                    <i class="bx bx-plus"></i> Tambah Brand
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Aset</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php if($brand->logo): ?>
                                    <img src="<?php echo e(asset('storage/' . $brand->logo)); ?>" alt="<?php echo e($brand->name); ?>" 
                                        class="rounded" style="max-height: 40px; max-width: 40px;">
                                <?php else: ?>
                                    <span class="text-muted small">Tidak ada</span>
                                <?php endif; ?>
                            </td>
                            <td><strong><a href="<?php echo e(route('brands.show', $brand)); ?>"><?php echo e($brand->name); ?></a></strong></td>
                            <td><?php echo e(Str::limit($brand->description, 50)); ?></td>
                            <td>
                                <span class="badge bg-primary"><?php echo e($brand->assets->count()); ?></span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('brands.edit', $brand)); ?>" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="<?php echo e(route('brands.destroy', $brand)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Tidak ada brand
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-body">
            <?php echo e($brands->links()); ?>

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
<?php /**PATH C:\laragon\www\manajemenaset\resources\views/brands/index.blade.php ENDPATH**/ ?>