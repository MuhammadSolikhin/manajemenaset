<x-app-layout>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Detail Opname</h5>
                        <small class="text-muted">
                            {{ $opname->date->format('d M Y') }} | {{ $opname->location }} |
                            <span
                                class="badge {{ $opname->status == 'completed' ? 'bg-label-success' : 'bg-label-warning' }}">
                                {{ ucfirst($opname->status) }}
                            </span>
                        </small>
                    </div>
                    <div>
                        <a href="{{ route('opname.index') }}" class="btn btn-outline-secondary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('opname.update', $opname->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Aset</th>
                                        <th>Kode Aset</th>
                                        <th style="width: 120px;">Stok Sistem</th>
                                        <th style="width: 150px;">Stok Fisik</th>
                                        <th style="width: 120px;">Selisih</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($opname->details as $index => $detail)
                                        <input type="hidden" name="details[{{ $index }}][id]" value="{{ $detail->id }}">
                                        <tr>
                                            <td>
                                                <strong>{{ $detail->asset->name }}</strong>
                                                <br>
                                                <small
                                                    class="text-muted">{{ $detail->asset->category->name ?? '-' }}</small>
                                            </td>
                                            <td>{{ $detail->asset->asset_code }}</td>
                                            <td class="text-center">{{ $detail->system_stock }}</td>
                                            <td>
                                                @if ($opname->status == 'pending')
                                                    <input type="number" name="details[{{ $index }}][physical_stock]"
                                                        class="form-control" value="{{ $detail->physical_stock }}" min="0"
                                                        required>
                                                @else
                                                    {{ $detail->physical_stock }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $diff = $detail->physical_stock - $detail->system_stock;
                                                    $class = $diff == 0 ? 'text-success' : ($diff < 0 ? 'text-danger' : 'text-warning');
                                                    $icon = $diff == 0 ? 'bx-check' : ($diff < 0 ? 'bx-down-arrow-alt' : 'bx-up-arrow-alt');
                                                @endphp
                                                <span class="{{ $class }} fw-bold">
                                                    {{ $detail->difference }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($opname->status == 'pending')
                                                    <input type="text" name="details[{{ $index }}][notes]" class="form-control"
                                                        value="{{ $detail->notes }}">
                                                @else
                                                    {{ $detail->notes }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($opname->status == 'pending')
                            <div class="mt-4 d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary" name="action" value="save">
                                    <i class="bx bx-save me-1"></i> Simpan Perubahan
                                </button>
                                <button type="submit" class="btn btn-success" name="status" value="completed"
                                    onclick="return confirm('Apakah Anda yakin ingin menyelesaikan sesi opname ini? Data tidak dapat diubah setelah selesai.')">
                                    <i class="bx bx-check-circle me-1"></i> Selesaikan Opname
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>