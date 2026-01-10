<x-app-layout>
    <div class="mx-auto max-w-7xl flex flex-col gap-6" x-data="{ showDeleteModal: false }">
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary transition-colors" href="{{ route('dashboard') }}">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="{{ route('obat.index') }}">Obat</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-white">Detail Obat</span>
        </div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Detail Obat</h1>
                <p class="text-slate-500 dark:text-slate-400">Informasi lengkap stok, harga, dan masa berlaku obat.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('obat.index') }}" class="inline-flex h-10 items-center justify-center gap-2 whitespace-nowrap rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-200 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                    Kembali
                </a>
                <a href="{{ route('obat.edit', $obat->id_obat) }}" class="inline-flex h-10 items-center justify-center gap-2 whitespace-nowrap rounded-lg bg-primary px-4 py-2 text-sm font-bold text-white shadow hover:bg-primary/90 transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring">
                    <span class="material-symbols-outlined text-[20px]">edit</span>
                    Edit Data
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 flex flex-col gap-6">
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 flex flex-col items-center text-center">
                    <div class="h-28 w-28 rounded-full bg-slate-100 dark:bg-slate-700 p-1 mb-4">
                        <div class="h-full w-full rounded-full bg-primary/10 text-primary flex items-center justify-center border border-primary/20">
                            <span class="material-symbols-outlined text-5xl">medication</span>
                        </div>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">{{ $obat->nama_obat }}</h2>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mb-4 font-mono tracking-wide">{{ $obat->kode_obat }}</p>
                    
                    <div class="w-full flex justify-center gap-2 mb-6">
                        @if($obat->stok == 0)
                            <span class="inline-flex items-center rounded-full bg-rose-100 dark:bg-rose-900/30 px-3 py-1 text-sm font-semibold text-rose-800 dark:text-rose-400 border border-rose-200 dark:border-rose-800 gap-1">
                                <span class="material-symbols-outlined text-[16px]">block</span> Stok Habis
                            </span>
                        @elseif($obat->stok < 10)
                            <span class="inline-flex items-center rounded-full bg-amber-100 dark:bg-amber-900/30 px-3 py-1 text-sm font-semibold text-amber-800 dark:text-amber-400 border border-amber-200 dark:border-amber-800 gap-1">
                                <span class="material-symbols-outlined text-[16px]">warning</span> Stok Menipis
                            </span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-emerald-100 dark:bg-emerald-900/30 px-3 py-1 text-sm font-semibold text-emerald-800 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 gap-1">
                                <span class="material-symbols-outlined text-[16px]">check_circle</span> Stok Aman
                            </span>
                        @endif
                    </div>

                    <div class="w-full grid grid-cols-1 gap-2 border-t border-slate-100 dark:border-slate-700 pt-4">
                        <div class="flex flex-col">
                            <span class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Nilai Aset</span>
                            <span class="font-bold text-slate-900 dark:text-white text-lg">
                                Rp {{ number_format($obat->harga * $obat->stok, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
                    <h3 class="font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">analytics</span>
                        Statistik Cepat
                    </h3>
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-500 dark:text-slate-400">Harga Satuan</span>
                            <span class="text-sm font-medium text-slate-900 dark:text-white">Rp {{ number_format($obat->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-500 dark:text-slate-400">Jumlah Stok</span>
                            <span class="text-sm font-medium text-slate-900 dark:text-white">{{ $obat->stok }} {{ $obat->satuan }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 flex flex-col gap-6">
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/50">
                        <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">description</span>
                            Informasi Detail Obat
                        </h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kode Obat</span>
                            <span class="text-slate-900 dark:text-white font-medium font-mono">{{ $obat->kode_obat }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Obat</span>
                            <span class="text-slate-900 dark:text-white font-medium">{{ $obat->nama_obat }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Satuan</span>
                            <span class="text-slate-900 dark:text-white font-medium">{{ $obat->satuan }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tanggal Kadaluarsa</span>
                            <div class="flex flex-col">
                                <span class="text-slate-900 dark:text-white font-medium">
                                    {{ $obat->tanggal_kadaluarsa->format('d F Y') }}
                                </span>
                                @php
                                    $daysLeft = \Carbon\Carbon::now()->diffInDays($obat->tanggal_kadaluarsa, false);
                                @endphp
                                @if($daysLeft < 0)
                                    <span class="text-xs text-rose-500 font-bold mt-1">Sudah Kadaluarsa ({{ abs($daysLeft) }} hari lalu)</span>
                                @elseif($daysLeft < 90)
                                    <span class="text-xs text-amber-500 font-bold mt-1">Kadaluarsa dalam {{ $daysLeft }} hari</span>
                                @else
                                    <span class="text-xs text-emerald-500 mt-1">Masih Aman ({{ $daysLeft }} hari lagi)</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Diinput Pada</span>
                            <span class="text-slate-900 dark:text-white font-medium">
                                {{ $obat->created_at->format('d/m/Y H:i') }}
                            </span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Terakhir Diupdate</span>
                            <span class="text-slate-900 dark:text-white font-medium">
                                {{ $obat->updated_at->format('d/m/Y H:i') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="bg-red-50 dark:bg-red-900/10 rounded-xl border border-red-100 dark:border-red-900/20 overflow-hidden">
                    <div class="px-6 py-4 flex items-center justify-between">
                        <div class="flex flex-col gap-1">
                            <h3 class="font-bold text-red-900 dark:text-red-400">Hapus Data Obat</h3>
                            <p class="text-sm text-red-700 dark:text-red-300">Menghapus data obat ini bersifat permanen.</p>
                        </div>
                        <button @click="showDeleteModal = true" class="px-4 py-2 bg-white dark:bg-transparent border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 rounded-lg text-sm font-medium hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            Hapus Data
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div 
            x-show="showDeleteModal" 
            style="display: none;"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="relative z-50"
            aria-labelledby="modal-title" 
            role="dialog" 
            aria-modal="true">
            
            <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div 
                        x-show="showDeleteModal"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        @click.outside="showDeleteModal = false"
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <span class="material-symbols-outlined text-red-600">warning</span>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-xl font-bold leading-6 text-slate-900" id="modal-title">Hapus Data Obat</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-slate-500">
                                            Apakah Anda yakin ingin menghapus data obat <span class="font-bold text-slate-900">{{ $obat->nama_obat }}</span>? 
                                            Tindakan ini tidak dapat dibatalkan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                            <form action="{{ route('obat.destroy', $obat->id_obat) }}" method="POST" class="inline-flex w-full sm:w-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:w-auto transition-colors">
                                    Hapus Obat
                                </button>
                            </form>
                            <button type="button" @click="showDeleteModal = false" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-5 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto transition-colors">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>