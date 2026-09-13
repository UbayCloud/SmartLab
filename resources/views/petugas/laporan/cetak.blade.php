<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman Alat</title>

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            margin:32px;
            color:#222;
        }

        .header{
            display:flex;
            align-items:center;
            border-bottom:3px solid #1e40af;
            padding-bottom:14px;
            margin-bottom:22px;
        }

        .logo{
            width:78px;
            height:78px;
            margin-right:18px;
        }

        .title{
            flex:1;
            text-align:center;
        }

        .title h2{
            margin:0;
            font-size:20px;
        }

        .title h3{
            margin:4px 0;
            font-size:16px;
            color:#1e40af;
        }

        .title p{
            margin:0;
            font-size:12px;
        }

        .info{
            margin-bottom:16px;
            font-size:13px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            font-size:12px;
        }

        th{
            background:#1e40af;
            color:white;
            padding:8px;
            border:1px solid #999;
        }

        td{
            border:1px solid #bbb;
            padding:7px;
        }

        tr:nth-child(even){
            background:#f7f7f7;
        }

        .text-center{
            text-align:center;
        }

        .footer{
            margin-top:50px;
            width:100%;
        }

        .ttd{
            width:260px;
            float:right;
            text-align:center;
        }

        @media print{
            body{
                margin:18px;
            }
        }
    </style>
</head>

<body onload="window.print()">

    {{-- HEADER --}}
    <div class="header">

        {{-- Ganti logo sesuai punyamu --}}
        <img src="{{ public_path('image/logo-smkn1.png') }}" class="logo">

        <div class="title">
            <h2>SMK NEGERI 1 SUMENEP</h2>
            <h3>LAPORAN PEMINJAMAN ALAT</h3>
            <p>Jl. Trunojoyo No. 298 Sumenep, Jawa Timur</p>
        </div>

    </div>

    {{-- INFO FILTER --}}
    <div class="info">
        <strong>Tanggal Cetak :</strong>
        {{ now()->format('d F Y H:i') }}
        <br>

        <strong>Status :</strong>
        {{ request('status') ?: 'Semua' }}

        <br>

        <strong>Peminjam :</strong>
        {{ optional($users->firstWhere('id', request('user_id')))->name ?? 'Semua' }}
    </div>

    {{-- TABEL --}}
    <table>
        <thead>
            <tr>
                <th width="40">No</th>
                <th>Peminjam</th>
                <th>Alat</th>
                <th width="55">Jumlah</th>
                <th width="90">Pinjam</th>
                <th width="90">Kembali</th>
                <th width="90">Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($laporan as $i => $l)
            <tr>
                <td class="text-center">{{ $i+1 }}</td>
                <td>{{ $l->user->name ?? '-' }}</td>
                <td>{{ $l->alat->nama_alat ?? '-' }}</td>
                <td class="text-center">{{ $l->jumlah }}</td>
                <td class="text-center">
                    {{ \Carbon\Carbon::parse($l->tanggal_pinjam)->format('d/m/Y') }}
                </td>
                <td class="text-center">
                    {{ \Carbon\Carbon::parse($l->tanggal_kembali_rencana)->format('d/m/Y') }}
                </td>
                <td class="text-center">
                    {{ ucfirst($l->status) }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">
                    Tidak ada data laporan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- FOOTER --}}
    <div class="footer">
        <div class="ttd">
            <p>Sumenep, {{ now()->format('d F Y') }}</p>
            <p><strong>Petugas Laboratorium</strong></p>

            <br><br><br>

            <p>
                <strong>(_____________________)</strong>
            </p>
        </div>
    </div>

</body>
</html>