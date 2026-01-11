<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-8" 
         x-data="{ showPaymentModal: false }">
        
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 mb-6 print:hidden">
            <div>
                <nav class="flex text-sm text-slate-500 dark:text-slate-400 mb-1">
                    <ol class="inline-flex items-center space-x-2">
                        <li><a href="{{ route('tagihan.index') }}" class="hover:text-primary">Daftar Tagihan</a></li>
                        <li><span class="mx-2">›</span></li>
                        <li>Invoice #{{ str_pad($tagihan->id_tagihan, 5, '0', STR_PAD_LEFT) }}</li>
                    </ol>
                </nav>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="material-symbols-outlined text-3xl text-primary">receipt_long</span>
                    Detail Tagihan
                </h1>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('tagihan.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-600 dark:text-slate-300 text-sm font-bold hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                    Kembali
                </a>
                
                <a href="{{ route('tagihan.print', $tagihan->id_tagihan) }}" target="_blank" class="px-4 py-2 bg-slate-800 dark:bg-slate-700 text-white rounded-lg text-sm font-bold hover:opacity-90 transition flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">print</span> Cetak Struk
                </a>

                @if($tagihan->status == 'Belum Lunas')
                <button @click="showPaymentModal = true" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-bold hover:bg-emerald-700 transition flex items-center gap-2 shadow-lg shadow-emerald-500/30">
                    <span class="material-symbols-outlined text-[18px]">payments</span> Proses Bayar
                </button>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                        <h3 class="font-bold text-slate-900 dark:text-white">Rincian Biaya</h3>
                        <span class="text-xs text-slate-500 font-mono">{{ $tagihan->created_at->format('d M Y H:i') }}</span>
                    </div>
                    
                    <div class="p-0">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 font-bold">
                                <tr>
                                    <th class="px-6 py-3 w-1/2">Deskripsi Item</th>
                                    <th class="px-6 py-3 text-center">Qty</th>
                                    <th class="px-6 py-3 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900 dark:text-white">Jasa Medis / Konsultasi</div>
                                        <div class="text-xs text-slate-500">{{ $tagihan->rekamMedis->dokter->nama_dokter }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-slate-600 dark:text-slate-400">1</td>
                                    <td class="px-6 py-4 text-right font-medium text-slate-900 dark:text-white">
                                        Rp {{ number_format($tagihan->biaya_dokter, 0, ',', '.') }}
                                    </td>
                                </tr>

                                @if($tagihan->biaya_tindakan > 0)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900 dark:text-white">Tindakan Medis</div>
                                        <div class="text-xs text-slate-500">
                                            @foreach($tagihan->rekamMedis->tindakans as $tindakan)
                                                {{ $tindakan->nama_tindakan }}@if(!$loop->last), @endif
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-slate-600 dark:text-slate-400">1</td>
                                    <td class="px-6 py-4 text-right font-medium text-slate-900 dark:text-white">
                                        Rp {{ number_format($tagihan->biaya_tindakan, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endif

                                @foreach($tagihan->rekamMedis->obats as $obat)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="text-slate-800 dark:text-slate-200">{{ $obat->nama_obat }}</div>
                                        <div class="text-xs text-slate-500 italic">{{ $obat->pivot->aturan_pakai }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-slate-600 dark:text-slate-400">
                                        {{ $obat->pivot->jumlah }}
                                    </td>
                                    <td class="px-6 py-4 text-right text-slate-600 dark:text-slate-400">
                                        Rp {{ number_format($obat->harga * $obat->pivot->jumlah, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-slate-50 dark:bg-slate-800 border-t border-slate-200 dark:border-slate-700">
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-right font-bold text-slate-600 dark:text-slate-400">Total Tagihan</td>
                                    <td class="px-6 py-4 text-right font-bold text-xl text-primary">
                                        Rp {{ number_format($tagihan->total_bayar, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">
                
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 text-center">
                    <p class="text-sm text-slate-500 font-bold uppercase mb-3">Status Pembayaran</p>
                    
                    @if($tagihan->status == 'Lunas')
                        <div class="inline-flex flex-col items-center">
                            <span class="material-symbols-outlined text-6xl text-emerald-500 mb-2">verified</span>
                            <span class="text-2xl font-bold text-emerald-600">LUNAS</span>
                            <span class="text-xs text-slate-400 mt-1">Terima kasih</span>
                        </div>
                    @else
                        <div class="inline-flex flex-col items-center">
                            <span class="material-symbols-outlined text-6xl text-amber-500 mb-2">pending</span>
                            <span class="text-2xl font-bold text-amber-600">BELUM LUNAS</span>
                            <span class="text-xs text-slate-400 mt-1">Harap segera diproses</span>
                        </div>
                    @endif
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <div class="p-4 bg-slate-50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-700 font-bold text-slate-800 dark:text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-slate-400">person</span> Informasi Pasien
                    </div>
                    <div class="p-4 space-y-4">
                        <div>
                            <label class="text-xs text-slate-500 block">Nama Pasien</label>
                            <p class="font-bold text-slate-900 dark:text-white">{{ $tagihan->rekamMedis->pasien->name }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-slate-500 block">Nomor Rekam Medis</label>
                            <p class="font-mono text-slate-700 dark:text-slate-300">{{ $tagihan->rekamMedis->pasien->no_rm }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-slate-500 block">Alamat</label>
                            <p class="text-sm text-slate-700 dark:text-slate-300">{{ $tagihan->rekamMedis->pasien->alamat }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-slate-500 block">Dokter Pemeriksa</label>
                            <p class="font-medium text-slate-700 dark:text-slate-300">{{ $tagihan->rekamMedis->dokter->nama_dokter }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div x-show="showPaymentModal" style="display: none;" 
             class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div @click.outside="showPaymentModal = false" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 sm:mx-0">
                                    <span class="material-symbols-outlined text-emerald-600">payments</span>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-xl font-bold text-slate-900">Konfirmasi Pembayaran</h3>
                                    <div class="mt-2 space-y-1">
                                        <p class="text-sm text-slate-500">Konfirmasi pembayaran untuk tagihan ini?</p>
                                        <div class="bg-slate-50 p-3 rounded-lg border border-slate-200 mt-2">
                                            <p class="text-sm font-bold text-slate-700">Total Tagihan:</p>
                                            <p class="text-2xl font-bold text-emerald-600">Rp {{ number_format($tagihan->total_bayar, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                            <form action="{{ route('tagihan.updateStatus', $tagihan->id_tagihan) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-emerald-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 sm:w-auto">
                                    Terima Pembayaran
                                </button>
                            </form>
                            <button @click="showPaymentModal = false" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-5 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>