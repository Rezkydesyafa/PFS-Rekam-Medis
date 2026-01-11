<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Dashboard - SIRM</title>
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
            font-size: 22px;
            color: #333;
            text-transform: uppercase;
            border-bottom: 3px solid #3b82f6;
            display: inline-block;
            padding-bottom: 3px;
        }
        .doc-title p {
            margin: 5px 0 0;
            font-size: 12px;
            color: #666;
            font-weight: bold;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .section-header {
            background-color: #eff6ff;
            color: #1e40af;
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

        /* Invoice Table */
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
        .text-right { text-align: right !important; }
        .text-center { text-align: center !important; }

        .row { width: 100%; clear: both; }
        .col-half { width: 48%; float: left; }
        
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
        
        /* Badge Status */
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-lunas { background: #dcfce7; color: #166534; border: 1px solid #166534; }
        .badge-belum { background: #fee2e2; color: #991b1b; border: 1px solid #991b1b; }
        
        /* Summary Card Style for Report */
        .summary-box {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
        }
        .summary-label {
            font-size: 10px;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .summary-value {
            font-size: 24px;
            font-weight: bold;
            color: #1e3a8a;
        }
        .summary-sub {
            font-size: 9px;
            color: #10b981;
            margin-top: 4px;
        }

        .summary-grid {
            width: 100%;
            border-spacing: 15px;
            border-collapse: separate; 
            margin: 0 -15px 15px -15px; /* Offset spacing */
        }
        .summary-grid td {
            width: 25%;
            padding: 0;
            vertical-align: top;
        }

    </style>
</head>
<body>

    <div class="header-bg">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none">
            <path d="M0,0 L500,0 L500,80 Q250,150 0,80 Z" fill="#eff6ff" opacity="0.5"/>
            <path d="M0,0 L200,0 Q300,100 0,100 Z" fill="#dbeafe" opacity="0.6"/>
        </svg>
    </div>

    <div class="header-content clearfix">
        <div class="logo-container">
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
            <h2>LAPORAN</h2>
            <p>PERIODE: {{ $selectedDate->isoFormat('D MMMM Y') }}</p>
        </div>
    </div>

    <!-- Summary Statistics Grid -->
    <table class="summary-grid">
        <tr>
            <td>
                <div class="summary-box">
                    <div class="summary-label">Total Pasien</div>
                    <div class="summary-value">{{ number_format($total_pasien) }}</div>
                    <div class="summary-sub">Terdaftar</div>
                </div>
            </td>
            <td>
                <div class="summary-box">
                    <div class="summary-label">Kunjungan Hari Ini</div>
                    <div class="summary-value">{{ number_format($kunjungan_hari_ini) }}</div>
                    <div class="summary-sub">{{ $selectedDate->format('d/m/Y') }}</div>
                </div>
            </td>
            <td>
                <div class="summary-box">
                    <div class="summary-label">Total Rekam Medis</div>
                    <div class="summary-value">{{ number_format($total_rm) }}</div>
                    <div class="summary-sub">Akumulasi</div>
                </div>
            </td>
            <td>
                <div class="summary-box">
                    <div class="summary-label">RM Tercetak</div>
                    <div class="summary-value">{{ number_format($rm_tercetak) }}</div>
                    <div class="summary-sub">Status: Sudah</div>
                </div>
            </td>
        </tr>
    </table>

    <div class="section-header">10 Pasien Terbaru Terdaftar</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="15%" class="text-center">Tgl Daftar</th>
                <th width="35%">Nama Pasien</th>
                <th width="25%">No. Rekam Medis</th>
                <th width="20%" class="text-center">Jenis Kelamin</th>
            </tr>
        </thead>
        <tbody>
            @forelse($latest_patients as $index => $pasien)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $pasien->created_at->format('d/m/Y') }}</td>
                <td><strong>{{ $pasien->name }}</strong></td>
                <td style="font-family: monospace; color: #555;">{{ $pasien->no_rm }}</td>
                <td class="text-center">
                    {{ $pasien->jenis_kelamin }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="padding: 20px; color: #999;">Tidak ada data pasien terbaru.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Signature Section --}}
    <table style="width: 100%; margin-top: 40px;">
        <tr>
            <td style="width: 60%;"></td>
            <td style="width: 40%; text-align: center;">
                <p style="margin-bottom: 5px; color: #555;">Jakarta, {{ now()->format('d F Y') }}</p>
                <p style="margin-top: 0; color: #555; font-size: 10px;">Mengetahui,</p>
                
                <div style="height: 60px;"></div> {{-- Space for signature --}}
                
                <div style="border-bottom: 1px solid #333; width: 80%; margin: 0 auto;"></div>
                <p style="margin-top: 5px; font-weight: bold; color: #333;">{{ auth()->user()->name ?? 'Administrator' }}</p>
            </td>
        </tr>
    </table>

    <div class="footer">
        Dokumen ini dihasilkan otomatis oleh Sistem Informasi Rekam Medis (SIRM).<br>
        <i>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }} oleh {{ auth()->user()->name }}</i>
    </div>

</body>
</html>
