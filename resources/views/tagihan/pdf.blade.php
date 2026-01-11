<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ str_pad($tagihan->id_tagihan, 5, '0', STR_PAD_LEFT) }}</title>
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
        
        /* Total Box */
        .total-box {
            float: right;
            width: 40%;
            margin-top: 10px;
        }
        .total-row {
            padding: 5px 0;
            border-bottom: 1px solid #eee;
            font-size: 12px;
        }
        .grand-total {
            font-size: 16px;
            font-weight: bold;
            color: #1e3a8a;
            border-top: 2px solid #3b82f6;
            padding-top: 10px;
            margin-top: 5px;
        }

        .signature-box {
            margin-top: 60px;
            float: right;
            width: 200px;
            text-align: center;
            clear: both;
        }
        .signature-line {
            border-bottom: 1px solid #333;
            margin-top: 60px;
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

        /* Watermark */
        .watermark {
            position: fixed;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 100px;
            font-weight: bold;
            z-index: -1;
            opacity: 0.15;
            border: 5px solid;
            padding: 10px 40px;
            border-radius: 20px;
        }
        .wm-lunas { color: #166534; border-color: #166534; }
        .wm-belum { color: #991b1b; border-color: #991b1b; }
    </style>
</head>
<body>

    @if($tagihan->status == 'Lunas')
        <div class="watermark wm-lunas">LUNAS</div>
    @else
        <div class="watermark wm-belum">BELUM LUNAS</div>
    @endif

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
                Telp: (021) 555-0123 | Email: finance@simrs.com<br>
                Website: www.simrs-app.com
            </div>
        </div>
        <div class="doc-title">
            <h2>INVOICE</h2>
            <p>NO: INV-{{ str_pad($tagihan->id_tagihan, 5, '0', STR_PAD_LEFT) }}</p>
            <div style="margin-top: 5px;">
                @if($tagihan->status == 'Lunas')
                    <span class="badge badge-lunas">LUNAS</span>
                @else
                    <span class="badge badge-belum">BELUM LUNAS</span>
                @endif
            </div>
        </div>
    </div>

    <div class="row" style="margin-bottom: 25px;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 50%; vertical-align: top; padding-right: 15px;">
                    <div class="section-header">Info Pasien</div>
                    <table class="info-table">
                        <tr><td class="label">Nama Pasien</td><td>: <strong>{{ $tagihan->rekamMedis->pasien->name }}</strong></td></tr>
                        <tr><td class="label">No. Rekam Medis</td><td>: {{ $tagihan->rekamMedis->pasien->no_rm }}</td></tr>
                        <tr><td class="label">Alamat</td><td>: {{ \Illuminate\Support\Str::limit($tagihan->rekamMedis->pasien->alamat, 60) }}</td></tr>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top; padding-left: 15px;">
                    <div class="section-header">Info Tagihan</div>
                    <table class="info-table">
                        <tr><td class="label">Tanggal</td><td>: {{ $tagihan->created_at->format('d/m/Y') }}</td></tr>
                        <tr><td class="label">Jam Cetak</td><td>: {{ now()->format('H:i') }}</td></tr>
                        <tr><td class="label">Kasir</td><td>: {{ auth()->user()->name ?? 'Administrator' }}</td></tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="section-header">Rincian Transaksi</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="50%">Keterangan</th>
                <th width="10%" class="text-center">Qty</th>
                <th width="15%" class="text-right">Harga (Rp)</th>
                <th width="20%" class="text-right">Subtotal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp

            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>
                    <strong>Jasa Medis / Konsultasi</strong><br>
                    <small style="color: #666;">Dr. {{ $tagihan->rekamMedis->dokter->nama_dokter }}</small>
                </td>
                <td class="text-center">1</td>
                <td class="text-right">{{ number_format($tagihan->biaya_dokter, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($tagihan->biaya_dokter, 0, ',', '.') }}</td>
            </tr>

            @foreach($tagihan->rekamMedis->tindakans as $tindakan)
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>
                    Tindakan: {{ $tindakan->nama_tindakan }}
                </td>
                <td class="text-center">1</td>
                
                {{-- PERBAIKAN: Menggunakan pivot->harga atau fallback ke tarif --}}
                <td class="text-right">
                    {{ number_format($tindakan->pivot->harga ?? $tindakan->tarif, 0, ',', '.') }}
                </td>
                <td class="text-right">
                    {{ number_format($tindakan->pivot->harga ?? $tindakan->tarif, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach

            @foreach($tagihan->rekamMedis->obats as $obat)
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>
                    Obat: {{ $obat->nama_obat }}
                </td>
                <td class="text-center">{{ $obat->pivot->jumlah }}</td>
                <td class="text-right">{{ number_format($obat->harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($obat->harga * $obat->pivot->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Calculate Subtotals for Display Consistency --}}
    @php
        $totalTindakan = 0;
        foreach($tagihan->rekamMedis->tindakans as $t) {
                $harga = $t->pivot->harga ?? $t->tarif;
                $totalTindakan += $harga;
        }
    @endphp

    {{-- Layout for Totals and Signature --}}
    <table style="width: 100%; margin-top: 20px;">
        <tr>
            {{-- Left Side: Empty or Notes --}}
            <td style="width: 50%; vertical-align: top;">
                {{-- Optional: Notes section --}}
            </td>

            {{-- Right Side: Totals --}}
            <td style="width: 50%; vertical-align: top;">
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                    <tr>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee; color: #555;">Jasa Medis (Dokter)</td>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee; text-align: right; font-weight: bold;">{{ number_format($tagihan->biaya_dokter, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee; color: #555;">Total Tindakan</td>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee; text-align: right; font-weight: bold;">{{ number_format($tagihan->biaya_tindakan, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee; color: #555;">Total Obat</td>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee; text-align: right; font-weight: bold;">{{ number_format($tagihan->biaya_obat, 0, ',', '.') }}</td>
                    </tr>
                    
                    {{-- Grand Total Box --}}
                    <tr>
                        <td style="padding: 10px 0 0 0; vertical-align: middle;">
                            <div style="font-size: 11px; font-weight: bold; color: #1e3a8a; text-transform: uppercase;">Total Bayar</div>
                        </td>
                        <td style="padding: 10px 0 0 0; text-align: right;">
                            <div style="font-size: 16px; font-weight: bold; color: #1e3a8a;">Rp {{ number_format($tagihan->total_bayar ?? ($tagihan->biaya_dokter + $tagihan->biaya_tindakan + $tagihan->biaya_obat), 0, ',', '.') }}</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- Signature Section --}}
    <table style="width: 100%; margin-top: 30px;">
        <tr>
            <td style="width: 60%;"></td>
            <td style="width: 40%; text-align: center;">
                <p style="margin-bottom: 5px; color: #555;">Jakarta, {{ now()->format('d F Y') }}</p>
                <p style="margin-top: 0; color: #555; font-size: 10px;">Kasir / Bag. Keuangan,</p>
                
                <div style="height: 60px;"></div> {{-- Space for signature --}}
                
                <div style="border-bottom: 1px solid #333; width: 80%; margin: 0 auto;"></div>
                <p style="margin-top: 5px; font-weight: bold; color: #333;">{{ auth()->user()->name ?? 'Petugas' }}</p>
            </td>
        </tr>
    </table>

    <div class="footer">
        Bukti pembayaran ini sah dan diterbitkan otomatis oleh sistem.<br>
        Simpan struk ini sebagai bukti pembayaran yang sah.
        <br>
        <i>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</i>
    </div>

</body>
</html>