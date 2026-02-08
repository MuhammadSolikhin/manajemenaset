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
            <h5 class="mb-0">Daftar Aset</h5>
            <?php if(in_array((Auth::user()->role ?? 'karyawan'), ['admin', 'super_admin'], true)): ?>
                <a href="<?php echo e(route('assets.create')); ?>" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Tambah Aset
                </a>
            <?php endif; ?>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible m-3" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Filter Section -->
        <div class="card-body border-bottom">
            <form action="<?php echo e(route('assets.index')); ?>" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Cari Nama/Kode</label>
                    <input type="text" name="search" class="form-control" placeholder="Cari aset..."
                        value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select">
                        <option value="">Semua Kategori</option>
                        <?php $__currentLoopData = $categories->where('parent_category_id', '!=', null); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>>
                                <?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Brand</label>
                    <select name="brand_id" class="form-select">
                        <option value="">Semua Brand</option>
                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($brand->id); ?>" <?php echo e(request('brand_id') == $brand->id ? 'selected' : ''); ?>>
                                <?php echo e($brand->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bx bx-search"></i> Filter
                        </button>
                        <a href="<?php echo e(route('assets.index')); ?>" class="btn btn-outline-secondary">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Aset</th>
                        <th>Kode</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Harga Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php $__empty_1 = true; $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(route('assets.show', $asset)); ?>" class="text-body">
                                    <i class="bx bx-cube fa-lg text-primary me-3"></i> <strong><?php echo e($asset->name); ?></strong>
                                </a>
                            </td>
                            <td><?php echo e($asset->asset_code); ?></td>
                            <td><span class="badge bg-label-info"><?php echo e($asset->category->name ?? '-'); ?></span></td>
                            <td>
                                <?php
                                    $statusColors = [
                                        'available' => 'success',
                                        'deployed' => 'primary',
                                        'maintenance' => 'warning',
                                        'broken' => 'danger',
                                    ];
                                    $color = $statusColors[$asset->status] ?? 'secondary';
                                ?>
                                <span class="badge bg-label-<?php echo e($color); ?> me-1"><?php echo e(strtoupper($asset->status)); ?></span>
                            </td>
                            <td>
                                <?php
                                    $totalBorrowed = \App\Models\AssetLoan::where('asset_id', $asset->id)
                                        ->where('status', 'borrowed')
                                        ->sum('quantity_borrowed');
                                    $availableStock = $asset->quantity - $totalBorrowed;
                                ?>
                                <span class="badge bg-label-<?php echo e($availableStock > 0 ? 'success' : 'danger'); ?>">
                                    <?php echo e($availableStock); ?>/<?php echo e($asset->quantity); ?>

                                </span>
                            </td>
                            <td>Rp <?php echo e(number_format($asset->price, 0, ',', '.')); ?></td>
                            <td><strong>Rp <?php echo e(number_format($asset->price * $asset->quantity, 0, ',', '.')); ?></strong></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo e(route('assets.show', $asset)); ?>" class="btn btn-icon btn-outline-info"
                                        title="Detail">
                                        <i class="bx bx-show"></i>
                                    </a>
                                    <?php if(in_array((Auth::user()->role ?? 'karyawan'), ['admin', 'super_admin'], true)): ?>
                                        <a href="<?php echo e(route('assets.edit', $asset)); ?>" class="btn btn-icon btn-outline-warning"
                                            title="Edit">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <form action="<?php echo e(route('assets.destroy', $asset)); ?>" method="POST" class="delete-form">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-icon btn-outline-danger" title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data aset.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <?php echo e($assets->links()); ?>

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
<?php endif; ?><?php /**PATH C:\laragon\www\manajemenaset\resources\views/assets/index.blade.php ENDPATH**/ ?>