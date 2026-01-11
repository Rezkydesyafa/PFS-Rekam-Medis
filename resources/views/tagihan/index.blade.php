<x-app-layout>
    <div class="mx-auto max-w-7xl flex flex-col gap-6" 
         x-data="{ 
            showDeleteModal: false, 
            deleteId: null, 
            showPaymentModal: false, 
            paymentId: null, 
            paymentName: '', 
            paymentAmount: '' 
         }">
        
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary transition-colors" href="{{ route('dashboard') }}">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-white">Kasir & Tagihan</span>
        </div>

        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Daftar Tagihan</h1>
                <p class="text-slate-500 dark:text-slate-400">Kelola pembayaran dan cetak struk pasien.</p>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-lg flex items-center gap-2">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
            {{ session('success') }}
        </div>
        @endif

        {{-- Pastikan component x-filter-bar Anda sudah ada --}}
        <div class="flex flex-col md:flex-row gap-4">
            <form method="GET" action="{{ route('tagihan.index') }}" class="flex-1 relative">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama Pasien..." 
                       class="w-full pl-10 h-10 rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-sm focus:ring-primary focus:border-primary">
            </form>

            <div class="flex items-center p-1 bg-slate-100 dark:bg-slate-800 rounded-lg h-10">
                <a href="{{ route('tagihan.index', ['status' => '', 'search' => request('search')]) }}" 
                   class="px-4 py-1.5 text-sm font-medium rounded-md transition-all {{ request('status') == '' ? 'bg-white dark:bg-slate-700 text-slate-900 dark:text-white shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200' }}">
                   Semua
                </a>
                <a href="{{ route('tagihan.index', ['status' => 'Lunas', 'search' => request('search')]) }}" 
                   class="px-4 py-1.5 text-sm font-medium rounded-md transition-all {{ request('status') == 'Lunas' ? 'bg-white dark:bg-slate-700 text-emerald-600 dark:text-emerald-400 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200' }}">
                   Lunas
                </a>
                <a href="{{ route('tagihan.index', ['status' => 'Belum Lunas', 'search' => request('search')]) }}" 
                   class="px-4 py-1.5 text-sm font-medium rounded-md transition-all {{ request('status') == 'Belum Lunas' ? 'bg-white dark:bg-slate-700 text-amber-600 dark:text-amber-400 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200' }}">
                   Belum Lunas
                </a>
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark shadow-sm overflow-hidden flex flex-col">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/50">
                        <tr>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">No. Tagihan</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">Pasien</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">Total Tagihan</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white text-center">Status</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">Tanggal</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse($tagihans as $tagihan)
                        <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="p-4 align-middle font-mono text-slate-600 dark:text-slate-300">
                                #INV-{{ str_pad($tagihan->id_tagihan, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            
                            <td class="p-4 align-middle">
                                <div class="font-bold text-slate-900 dark:text-white">
                                    {{ $tagihan->rekamMedis->pasien->name ?? 'Pasien Umum' }}
                                </div>
                                <div class="text-xs text-slate-500 font-mono">
                                    RM: {{ $tagihan->rekamMedis->pasien->no_rm ?? '-' }}
                                </div>
                            </td>

                            <td class="p-4 align-middle font-bold text-slate-700 dark:text-slate-200">
                                Rp {{ number_format($tagihan->total_bayar, 0, ',', '.') }}
                            </td>

                            <td class="p-4 align-middle text-center">
                                @if($tagihan->status == 'Lunas')
                                    <span class="inline-flex items-center rounded-full bg-emerald-100 dark:bg-emerald-900/30 px-2.5 py-0.5 text-xs font-bold text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                        LUNAS
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-amber-100 dark:bg-amber-900/30 px-2.5 py-0.5 text-xs font-bold text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                        BELUM LUNAS
                                    </span>
                                @endif
                            </td>

                            <td class="p-4 align-middle text-slate-600 dark:text-slate-300 text-xs">
                                {{ \Carbon\Carbon::parse($tagihan->created_at)->locale('id')->translatedFormat('d F Y H:i') }}
                            </td>

                            <td class="p-4 align-middle text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('tagihan.print', $tagihan->id_tagihan) }}" target="_blank" class="h-8 w-8 inline-flex items-center justify-center rounded-lg text-slate-500 hover:text-primary hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors" title="Cetak Struk">
                                        <span class="material-symbols-outlined text-[20px]">receipt_long</span>
                                    </a>

                                    @if($tagihan->status == 'Belum Lunas')
                                    <button 
                                        @click="showPaymentModal = true; 
                                                paymentId = {{ $tagihan->id_tagihan }}; 
                                                paymentName = '{{ $tagihan->rekamMedis->pasien->name ?? 'Pasien' }}';
                                                paymentAmount = 'Rp {{ number_format($tagihan->total_bayar, 0, ',', '.') }}'"
                                        class="h-8 w-8 inline-flex items-center justify-center rounded-lg text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-colors" title="Proses Pembayaran">
                                        <span class="material-symbols-outlined text-[20px]">payments</span>
                                    </button>
                                    @endif
                                    
                                    <button @click="showDeleteModal = true; deleteId = {{ $tagihan->id_tagihan }}" class="h-8 w-8 inline-flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-500">
                                Belum ada data tagihan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                {{ $tagihans->links() }}
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
                                        <p class="text-sm text-slate-500">Apakah Anda yakin ingin memproses pembayaran ini?</p>
                                        <div class="bg-slate-50 p-3 rounded-lg border border-slate-200 mt-2">
                                            <p class="text-sm font-bold text-slate-700">Pasien: <span x-text="paymentName"></span></p>
                                            <p class="text-lg font-bold text-emerald-600 mt-1">Total: <span x-text="paymentAmount"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                            <form :action="'/tagihan/' + paymentId + '/status'" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-emerald-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 sm:w-auto">
                                    Tandai Lunas
                                </button>
                            </form>
                            <button @click="showPaymentModal = false" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-5 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="showDeleteModal" style="display: none;" 
             class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div @click.outside="showDeleteModal = false" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 sm:mx-0">
                                    <span class="material-symbols-outlined text-red-600">warning</span>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-xl font-bold text-slate-900">Hapus Tagihan</h3>
                                    <div class="mt-2"><p class="text-sm text-slate-500">Yakin ingin menghapus tagihan ini secara permanen?</p></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                            <form :action="'/tagihan/' + deleteId" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:w-auto">Hapus</button>
                            </form>
                            <button @click="showDeleteModal = false" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-5 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>