<x-app-layout>
    <div class="mx-auto max-w-4xl px-4 py-8">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Detail Rekam Medis</h1>
            <a href="{{ route('rekam-medis.index') }}" class="text-slate-500 hover:text-primary text-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali
            </a>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 mb-6">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-xs text-slate-500 uppercase font-bold mb-1">Pasien</p>
                    <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $rm->pasien->name }}</p>
                    <p class="text-sm text-slate-500">{{ $rm->pasien->no_rm }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-slate-500 uppercase font-bold mb-1">Dokter</p>
                    <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $rm->dokter->nama_dokter }}</p>
                    <p class="text-sm text-slate-500">{{ $rm->dokter->spesialisasi }}</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-700 grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <span class="text-xs text-slate-500 block">Tanggal</span>
                    <span class="font-medium dark:text-white">{{ \Carbon\Carbon::parse($rm->tgl_kunjungan)->format('d M Y') }}</span>
                </div>
                <div>
                    <span class="text-xs text-slate-500 block">Tensi</span>
                    <span class="font-medium dark:text-white">{{ $rm->tensi ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-xs text-slate-500 block">Berat</span>
                    <span class="font-medium dark:text-white">{{ $rm->berat_badan ?? '-' }} Kg</span>
                </div>
                <div>
                    <span class="text-xs text-slate-500 block">Suhu</span>
                    <span class="font-medium dark:text-white">{{ $rm->suhu ?? '-' }} °C</span>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 mb-6">
            <h3 class="font-bold text-slate-900 dark:text-white mb-3">Diagnosa & Catatan</h3>
            <div class="space-y-3">
                <div class="bg-slate-50 dark:bg-slate-900 p-3 rounded-lg">
                    <span class="text-xs text-slate-500 block mb-1">Keluhan</span>
                    <p class="text-slate-800 dark:text-slate-200">{{ $rm->keluhan }}</p>
                </div>
                <div class="bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg border border-blue-100 dark:border-blue-800">
                    <span class="text-xs text-blue-500 block mb-1">Diagnosa Dokter</span>
                    <p class="text-blue-900 dark:text-blue-100 font-medium">{{ $rm->diagnosa }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 flex justify-between items-center">
                <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="material-symbols-outlined text-blue-500">medical_services</span> Tindakan Medis
                </h3>
            </div>
            <table class="w-full text-sm text-left">
                <thead class="text-slate-500 bg-slate-50 dark:bg-slate-900 dark:text-slate-400">
                    <tr>
                        <th class="px-6 py-3">Nama Tindakan</th>
                        <th class="px-6 py-3 text-right">Biaya</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @forelse($rm->tindakans as $tindakan)
                    <tr class="dark:text-slate-300">
                        <td class="px-6 py-3 font-medium">{{ $tindakan->nama_tindakan }}</td>
                        <td class="px-6 py-3 text-right font-mono">
                            Rp {{ number_format($tindakan->pivot->harga, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center text-slate-500">Tidak ada tindakan medis.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 flex justify-between items-center">
                <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="material-symbols-outlined text-emerald-500">medication</span> Resep Obat
                </h3>
            </div>
            <table class="w-full text-sm text-left">
                <thead class="text-slate-500 bg-slate-50 dark:bg-slate-900 dark:text-slate-400">
                    <tr>
                        <th class="px-6 py-3">Nama Obat</th>
                        <th class="px-6 py-3 text-center">Jumlah</th>
                        <th class="px-6 py-3">Aturan Pakai</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @forelse($rm->obats as $obat)
                    <tr class="dark:text-slate-300">
                        <td class="px-6 py-3 font-medium">{{ $obat->nama_obat }}</td>
                        <td class="px-6 py-3 text-center bg-slate-50 dark:bg-slate-700 font-bold">
                            {{ $obat->pivot->jumlah }}
                        </td>
                        <td class="px-6 py-3 italic text-slate-600 dark:text-slate-400">
                            {{ $obat->pivot->aturan_pakai }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-slate-500">Tidak ada obat yang diresepkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <button onclick="window.print()" class="px-4 py-2 bg-slate-800 text-white rounded-lg hover:bg-slate-700 flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">print</span> Cetak
            </button>
        </div>

    </div>
</x-app-layout>