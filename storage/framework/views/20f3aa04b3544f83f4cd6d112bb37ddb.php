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
    <div class="row">
        <!-- Asset Details -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <?php if($asset->image): ?>
                        <img src="<?php echo e(asset('storage/' . $asset->image)); ?>" alt="Asset Image" class="img-fluid rounded mb-3"
                            style="max-height: 200px;">
                    <?php else: ?>
                        <div class="d-flex justify-content-center align-items-center bg-label-secondary rounded mb-3"
                            style="height: 200px;">
                            <i class="bx bx-image fs-1"></i>
                        </div>
                    <?php endif; ?>

                    <h4><?php echo e($asset->name); ?></h4>
                    <p class="text-muted"><?php echo e($asset->asset_code); ?></p>

                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <span
                            class="badge bg-label-<?php echo e($asset->status == 'available' ? 'success' : ($asset->status == 'deployed' ? 'primary' : 'warning')); ?>">
                            <?php echo e(strtoupper($asset->status)); ?>

                        </span>
                        <span class="badge bg-label-info"><?php echo e($asset->category->name); ?></span>
                    </div>

                    <div class="d-grid gap-2">
                        <?php
                            $activeLoans = \App\Models\AssetLoan::where('asset_id', $asset->id)
                                ->where('status', 'borrowed')
                                ->get();
                            $totalBorrowed = $activeLoans->sum('quantity_borrowed');
                            $availableStock = $asset->quantity - $totalBorrowed;
                        ?>

                        <?php if($availableStock > 0): ?>
                            <a href="<?php echo e(route('loans.create', $asset)); ?>" class="btn btn-primary">
                                <i class="bx bx-export me-1"></i> Checkout (Pinjam)
                            </a>
                        <?php else: ?>
                            <button type="button" class="btn btn-secondary" disabled>
                                <i class="bx bx-export me-1"></i> Stok Habis
                            </button>
                        <?php endif; ?>

                        <?php if($activeLoans->count() > 0 && in_array((Auth::user()->role ?? 'karyawan'), ['admin', 'super_admin'], true)): ?>
                            <div class="alert alert-warning mb-0">
                                <strong>Sedang Dipinjam:</strong>
                                <?php $__currentLoopData = $activeLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mt-2">
                                        <small>
                                            • <?php echo e($loan->user->name); ?> (<?php echo e($loan->quantity_borrowed); ?> unit) sejak <?php echo e($loan->loan_date->format('d M Y')); ?>

                                            <form action="<?php echo e(route('loans.return', $loan)); ?>" method="POST" class="d-inline ms-2">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-xs btn-success" 
                                                    onclick="return confirm('Return <?php echo e($loan->quantity_borrowed); ?> unit untuk <?php echo e($loan->user->name); ?>?')">
                                                    Return
                                                </button>
                                            </form>
                                        </small>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                        <?php if(in_array((Auth::user()->role ?? 'karyawan'), ['admin', 'super_admin'], true)): ?>
                            <a href="<?php echo e(route('assets.edit', $asset)); ?>" class="btn btn-outline-secondary">Edit Asset</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Tabs -->
        <div class="col-md-8">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-details">
                            Detail & Spesifikasi
                        </button>
                    </li>
                    <?php if(in_array((Auth::user()->role ?? 'karyawan'), ['admin', 'super_admin'], true)): ?>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-depreciation">
                                Depresiasi
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-history">
                                Riwayat (Log)
                            </button>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="tab-content">
                    <!-- Details Tabs -->
                    <div class="tab-content">
                        <!-- Detail Tab -->
                        <div class="tab-pane fade show active" id="navs-details" role="tabpanel">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th class="w-25">Jumlah Aset</th>
                                        <td><?php echo e($asset->quantity); ?> unit</td>
                                    </tr>
                                    <tr>
                                        <th>Harga Satuan</th>
                                        <td>Rp <?php echo e(number_format($asset->price, 2)); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Harga Total</th>
                                        <td><strong>Rp <?php echo e(number_format($asset->price * $asset->quantity, 2)); ?></strong></td>
                                    </tr>
                                    <?php
                                        $totalBorrowed = \App\Models\AssetLoan::where('asset_id', $asset->id)
                                            ->where('status', 'borrowed')
                                            ->sum('quantity_borrowed');
                                        $availableStock = $asset->quantity - $totalBorrowed;
                                    ?>
                                    <tr>
                                        <th>Stok Tersedia</th>
                                        <td>
                                            <span class="badge bg-label-<?php echo e($availableStock > 0 ? 'success' : 'danger'); ?>">
                                                <?php echo e($availableStock); ?> unit
                                            </span>
                                            (<?php echo e($totalBorrowed); ?> unit dipinjam)
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Beli</th>
                                        <td><?php echo e($asset->purchase_date->format('d F Y')); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Masa Manfaat</th>
                                        <td><?php echo e($asset->useful_life); ?> Tahun</td>
                                    </tr>
                                    <tr>
                                        <th>Nilai Sisa</th>
                                        <td>Rp <?php echo e(number_format($asset->residual_value, 2)); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Dibuat Pada</th>
                                        <td><?php echo e($asset->created_at->format('d M Y H:i')); ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php if($asset->units && $asset->units->count() > 0): ?>
                                <h5 class="mt-4">Unit Individu</h5>
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Identifier</th>
                                                <th>Status</th>
                                                <th>Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $asset->units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td><?php echo e($unit->unique_identifier ?? '-'); ?></td>
                                                    <td>
                                                        <span class="badge bg-label-<?php echo e($unit->status == 'available' ? 'success' : ($unit->status == 'borrowed' ? 'warning' : 'secondary')); ?>">
                                                            <?php echo e(ucfirst($unit->status)); ?>

                                                        </span>
                                                    </td>
                                                    <td><?php echo e($unit->notes ?? '-'); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if(in_array((Auth::user()->role ?? 'karyawan'), ['admin', 'super_admin'], true)): ?>
                        <!-- Depreciation Tab -->
                        <div class="tab-pane fade" id="navs-depreciation" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tahun Ke</th>
                                            <th>Tanggal</th>
                                            <th>Penyusutan</th>
                                            <th>Nilai Buku</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $depreciationSchedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($schedule['year']); ?></td>
                                                <td><?php echo e($schedule['date']); ?></td>
                                                <td>Rp <?php echo e(number_format($schedule['depreciation_amount'], 2)); ?></td>
                                                <td>Rp <?php echo e(number_format($schedule['book_value'], 2)); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- History Tab -->
                        <div class="tab-pane fade" id="navs-history" role="tabpanel">
                            <ul class="timeline">
                                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point timeline-point-primary"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0"><?php echo e($log->action); ?></h6>
                                                <small class="text-muted"><?php echo e($log->created_at->diffForHumans()); ?></small>
                                            </div>
                                            <p class="mb-2"><?php echo e($log->user->name ?? 'System'); ?> melakukan
                                                <?php echo e(strtolower($log->action)); ?>

                                            </p>
                                            <?php if($log->details && is_array($log->details)): ?>
                                                <div class="bg-label-secondary p-2 rounded">
                                                    <ul class="list-unstyled mb-0">
                                                        <?php $__currentLoopData = $log->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li>
                                                                <small><strong><?php echo e(ucfirst(str_replace('_', ' ', $key))); ?>:</strong> 
                                                                <?php echo e(is_array($value) ? json_encode($value) : $value); ?></small>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="text-center">Belum ada riwayat.</p>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
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
<?php endif; ?><?php /**PATH C:\laragon\www\manajemenaset\resources\views/assets/show.blade.php ENDPATH**/ ?>