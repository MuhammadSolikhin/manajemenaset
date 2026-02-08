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
            <h5 class="mb-0">Daftar Kategori</h5>
            <div class="d-flex gap-2">
                <form action="<?php echo e(route('categories.index')); ?>" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari kategori..."
                        value="<?php echo e(request('search')); ?>">
                    <button type="submit" class="btn btn-outline-primary"><i class="bx bx-search"></i></button>
                </form>
                <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Tambah Kategori
                </a>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible m-3" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible m-3" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Tipe</th>
                        <th>Jumlah Aset</th>
                        <th>Tanggal Dibuat</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><strong><?php echo e($category->name); ?></strong></td>
                            <td><span class="badge bg-label-info">Parent</span></td>
                            <td><span class="badge bg-label-primary"><?php echo e($category->getTotalAssetCount()); ?> Aset</span></td>
                            <td><?php echo e($category->created_at->format('d M Y')); ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo e(route('categories.edit', $category)); ?>"
                                        class="btn btn-icon btn-outline-warning" title="Edit">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                    <form action="<?php echo e(route('categories.destroy', $category)); ?>" method="POST"
                                        class="delete-form" style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-icon btn-outline-danger" title="Delete">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php if($category->children->count() > 0): ?>
                            <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="table-light">
                                    <td style="padding-left: 3rem;">└─ <?php echo e($subcategory->name); ?></td>
                                    <td><span class="badge bg-label-secondary">Sub</span></td>
                                    <td><span class="badge bg-label-primary"><?php echo e($subcategory->getTotalAssetCount()); ?> Aset</span></td>
                                    <td><?php echo e($subcategory->created_at->format('d M Y')); ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="<?php echo e(route('categories.edit', $subcategory)); ?>"
                                                class="btn btn-icon btn-outline-warning" title="Edit">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>
                                            <form action="<?php echo e(route('categories.destroy', $subcategory)); ?>" method="POST"
                                                class="delete-form" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-icon btn-outline-danger" title="Delete">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data kategori.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <?php echo e($categories->links()); ?>

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
<?php endif; ?><?php /**PATH C:\laragon\www\manajemenaset\resources\views/categories/index.blade.php ENDPATH**/ ?>