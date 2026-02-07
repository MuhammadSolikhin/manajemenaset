<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Opname - {{ $opname->location }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info table {
            width: 100%;
        }

        .info td {
            padding: 5px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
        }

        .content th,
        .content td {
            border: 1px solid #000;
            padding: 5px;
        }

        .content th {
            background-color: #f0f0f0;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="header">
        <h2>BERITA ACARA STOCK OPNAME</h2>
        <p>Manajemen Aset & Inventaris</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td width="150">Tanggal Opname</td>
                <td>: {{ $opname->date->format('d F Y') }}</td>
            </tr>
            <tr>
                <td>Lokasi</td>
                <td>: {{ $opname->location }}</td>
            </tr>
            <tr>
                <td>Penanggung Jawab</td>
                <td>: {{ $opname->user->name }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: {{ ucfirst($opname->status) }}</td>
            </tr>
        </table>
    </div>

    <div class="content">
        <table>
            <thead>
                <tr>
                    <th width="30">No</th>
                    <th>Kode Aset</th>
                    <th>Nama Aset</th>
                    <th>Stok Sistem</th>
                    <th>Stok Fisik</th>
                    <th>Selisih</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($opname->details as $index => $detail)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $detail->asset->asset_code }}</td>
                        <td>{{ $detail->asset->name }}</td>
                        <td class="text-center">{{ $detail->system_stock }}</td>
                        <td class="text-center">{{ $detail->physical_stock }}</td>
                        <td class="text-center" style="{{ $detail->difference != 0 ? 'font-weight:bold;' : '' }}">
                            {{ $detail->difference }}
                        </td>
                        <td>{{ $detail->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 50px;">
        <table style="width: 100%; text-align: center;">
            <tr>
                <td>Dibuat Oleh,</td>
                <td>Mengetahui,</td>
            </tr>
            <tr>
                <td style="height: 80px;"></td>
                <td></td>
            </tr>
            <tr>
                <td>( {{ $opname->user->name }} )</td>
                <td>( ........................... )</td>
            </tr>
        </table>
    </div>
</body>

</html>