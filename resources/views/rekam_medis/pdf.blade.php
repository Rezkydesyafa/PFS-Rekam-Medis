<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Rekam Medis - {{ $rekamMedis->pasien->no_rm }}</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 40px;
        }
        
        /* Decorative Header Background */
        .header-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 150px;
            z-index: -1;
            overflow: hidden;
        }
        .header-bg svg {
            width: 100%;
            height: 100%;
        }

        .header-content {
            margin-bottom: 30px;
            position: relative;
        }
        .logo-container {
            width: 80px;
            float: left;
            margin-right: 15px;
        }
        .logo-container img {
            width: 100%;
            height: auto;
        }
        .hospital-info {
            float: left;
            padding-top: 5px;
        }
        .hospital-name {
            font-size: 24px;
            font-weight: bold;
            color: #1e3a8a; /* Dark Blue */
            text-transform: uppercase;
            margin: 0;
            line-height: 1;
        }
        .hospital-address {
            font-size: 10px;
            color: #555;
            margin-top: 5px;
        }
        .doc-title {
            float: right;
            text-align: right;
            padding-top: 10px;
        }
        .doc-title h2 {
            margin: 0;
            font-size: 18px;
            color: #333;
            text-transform: uppercase;
            border-bottom: 3px solid #3b82f6; /* Blue accent */
            display: inline-block;
            padding-bottom: 3px;
        }
        .doc-title p {
            margin: 5px 0 0;
            font-size: 10px;
            color: #666;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .section-header {
            background-color: #eff6ff; /* Light Blue */
            color: #1e40af; /* Dark Blue Text */
            font-size: 11px;
            font-weight: bold;
            padding: 6px 10px;
            margin: 15px 0 8px 0;
            border-left: 4px solid #3b82f6;
            text-transform: uppercase;
            border-radius: 0 4px 4px 0;
        }

        table.info-table {
            width: 100%;
            border-collapse: collapse;
        }
        table.info-table td {
            padding: 3px 0;
            vertical-align: top;
        }
        .label {
            font-weight: bold;
            color: #555;
            width: 120px;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            border-radius: 4px;
            overflow: hidden;
        }
        table.data-table th, table.data-table td {
            border-bottom: 1px solid #e2e8f0;
            padding: 8px 10px;
            text-align: left;
        }
        table.data-table th {
            background-color: #f1f5f9;
            color: #334155;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
            border-bottom: 2px solid #cbd5e1;
        }
        table.data-table tr:last-child td {
            border-bottom: none;
        }

        .row { width: 100%; clear: both; }
        .col-half { width: 48%; float: left; }
        
        .signature-box {
            margin-top: 40px;
            float: right;
            width: 200px;
            text-align: center;
        }
        .signature-line {
            border-bottom: 1px solid #333;
            margin-top: 50px;
            margin-bottom: 5px;
        }

        .footer {
            position: fixed;
            bottom: 20px;
            left: 40px;
            right: 40px;
            font-size: 8px;
            color: #94a3b8;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
        }
        
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
        }
        .badge-gray { background: #f1f5f9; color: #475569; }
    </style>
</head>
<body>

    <!-- SVG Background Accent -->
    <div class="header-bg">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none">
            <path d="M0,0 L500,0 L500,80 Q250,150 0,80 Z" fill="#eff6ff" opacity="0.5"/>
            <path d="M0,0 L200,0 Q300,100 0,100 Z" fill="#dbeafe" opacity="0.6"/>
        </svg>
    </div>

    <!-- Header Content -->
    <div class="header-content clearfix">
        <div class="logo-container">
            <!-- Using public_path helper for image -->
            <img src="{{ public_path('logo.png') }}" alt="Logo">
        </div>
        <div class="hospital-info">
            <h1 class="hospital-name">SIMRS APP</h1>
            <div class="hospital-address">
                Jl. Kesehatan Raya No. 123, Jakarta Pusat<br>
                Telp: (021) 555-0123 | Email: admin@simrs.com<br>
                Website: www.simrs-app.com
            </div>
        </div>
        <div class="doc-title">
            <h2>Rekam Medis</h2>
            <p>NO. RM: {{ $rekamMedis->pasien->no_rm }}</p>
        </div>
    </div>

    <!-- Info Section -->
    <div class="row clearfix" style="margin-bottom: 25px;">
        <div class="col-half">
            <div class="section-header">Identitas Pasien</div>
            <table class="info-table">
                <tr><td class="label">Nama Lengkap</td><td>: <strong>{{ $rekamMedis->pasien->name }}</strong></td></tr>
                <tr><td class="label">Tanggal Lahir</td><td>: {{ \Carbon\Carbon::parse($rekamMedis->pasien->tgl_lahir)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($rekamMedis->pasien->tgl_lahir)->age }} Th)</td></tr>
                <tr><td class="label">Jenis Kelamin</td><td>: {{ $rekamMedis->pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                <tr><td class="label">Alamat</td><td>: {{ $rekamMedis->pasien->alamat }}</td></tr>
            </table>
        </div>
        <div class="col-half" style="margin-left: 4%;">
            <div class="section-header">Data Kunjungan</div>
            <table class="info-table">
                <tr><td class="label">No. Registrasi</td><td>: #{{ $rekamMedis->id_rekam_medis }}</td></tr>
                <tr><td class="label">Tanggal Periksa</td><td>: {{ \Carbon\Carbon::parse($rekamMedis->tgl_kunjungan)->format('d F Y, H:i') }}</td></tr>
                <tr><td class="label">Dokter Pemeriksa</td><td>: {{ $rekamMedis->dokter->nama_dokter }}</td></tr>
                <tr><td class="label">Spesialisasi</td><td>: {{ $rekamMedis->dokter->spesialisasi }}</td></tr>
            </table>
        </div>
    </div>

    <!-- Clinical Data -->
    <div class="section-header">Pemeriksaan Klinis (SOAP)</div>
    <table class="data-table">
        <tr>
            <th width="25%">Subjective (Keluhan)</th>
            <td>{{ $rekamMedis->keluhan ?? '-' }}</td>
        </tr>
        <tr>
            <th>Objective (Tanda Vital)</th>
            <td>
                @if($rekamMedis->tekanan_darah) <span class="badge badge-gray">TD: {{ $rekamMedis->tekanan_darah }} mmHg</span> @endif
                @if($rekamMedis->suhu_tubuh) <span class="badge badge-gray">Suhu: {{ $rekamMedis->suhu_tubuh }} °C</span> @endif
                @if($rekamMedis->berat_badan) <span class="badge badge-gray">BB: {{ $rekamMedis->berat_badan }} kg</span> @endif
                @if($rekamMedis->tinggi_badan) <span class="badge badge-gray">TB: {{ $rekamMedis->tinggi_badan }} cm</span> @endif
            </td>
        </tr>
        <tr>
            <th>Assessment (Diagnosa)</th>
            <td><strong>{{ $rekamMedis->diagnosa }}</strong></td>
        </tr>
        <tr>
            <th>Planning (Catatan)</th>
            <td>{{ $rekamMedis->catatan ?? 'Tidak ada catatan khusus.' }}</td>
        </tr>
    </table>

    <!-- Actions & Drugs -->
    @if($rekamMedis->tindakans->count() > 0)
    <div class="section-header">Tindakan Medis</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%" style="text-align: center;">No</th>
                <th>Nama Tindakan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekamMedis->tindakans as $index => $tindakan)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $tindakan->nama_tindakan }}</td>
                <td>Dilakukan oleh Dokter</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    @if($rekamMedis->obats->count() > 0)
    <div class="section-header">Resep Obat</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%" style="text-align: center;">No</th>
                <th>Nama Obat</th>
                <th width="10%" style="text-align: center;">Jumlah</th>
                <th>Aturan Pakai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekamMedis->obats as $index => $obat)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $obat->nama_obat }}</td>
                <td style="text-align: center;">{{ $obat->pivot->jumlah }}</td>
                <td>{{ $obat->pivot->aturan_pakai ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Signature -->
    <div class="signature-box" style="page-break-inside: avoid;">
        <p>Jakarta, {{ now()->format('d F Y') }}</p>
        <p>Dokter Pemeriksa,</p>
        <div style="height: 60px;"></div> <!-- Space for wet signature -->
        <div class="signature-line"></div>
        <p><strong>{{ $rekamMedis->dokter->nama_dokter }}</strong></p>
        <p style="font-size: 9px;">SIP: {{ $rekamMedis->dokter->no_sip }}</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        Dokumen ini dibuat secara elektronik oleh Sistem Informasi Rekam Medis (SIMRS).<br>
        Tanda tangan basah tidak diperlukan jika dokumen ini telah diverifikasi secara digital.
        <br>
        <i>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }} oleh {{ auth()->user()->name ?? 'System' }}</i>
    </div>

</body>
</html>
