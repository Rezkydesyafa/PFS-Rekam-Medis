<x-app-layout>
    <div class="mx-auto max-w-7xl flex flex-col gap-6" x-data="{ showDeleteModal: false }">
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary transition-colors" href="{{ route('dashboard') }}">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="{{ route('dokter.index') }}">Dokter</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-white">Detail Dokter</span>
        </div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Detail Dokter</h1>
                <p class="text-slate-500 dark:text-slate-400">Informasi lengkap profil dan kredensial dokter.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('dokter.index') }}" class="inline-flex h-10 items-center justify-center gap-2 whitespace-nowrap rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-200 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                    Kembali
                </a>
                <a href="{{ route('dokter.edit', $dokter->id_dokter) }}" class="inline-flex h-10 items-center justify-center gap-2 whitespace-nowrap rounded-lg bg-primary px-4 py-2 text-sm font-bold text-white shadow hover:bg-primary/90 transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring">
                    <span class="material-symbols-outlined text-[20px]">edit</span>
                    Edit Data
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 flex flex-col gap-6">
                <div class="bg-white dark:bg-background-dark rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6 flex flex-col items-center text-center">
                    <div class="h-28 w-28 rounded-full bg-slate-100 dark:bg-slate-800 p-1 mb-4">
                        <div class="h-full w-full rounded-full bg-primary/10 text-primary flex items-center justify-center text-3xl font-bold border border-primary/20">
                            {{ substr($dokter->nama_dokter, 0, 1) }}
                        </div>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">{{ $dokter->nama_dokter }}</h2>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mb-4 font-mono">{{ $dokter->no_sip }}</p>
                    
                    <div class="w-full flex justify-center gap-2 mb-6">
                        @php
                            $badgeColor = match($dokter->spesialisasi) {
                                'Umum' => 'bg-blue-100 text-blue-800 border-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800',
                                'Gigi' => 'bg-teal-100 text-teal-800 border-teal-200 dark:bg-teal-900/30 dark:text-teal-300 dark:border-teal-800',
                                'Anak' => 'bg-amber-100 text-amber-800 border-amber-200 dark:bg-amber-900/30 dark:text-amber-300 dark:border-amber-800',
                                'Jantung' => 'bg-rose-100 text-rose-800 border-rose-200 dark:bg-rose-900/30 dark:text-rose-300 dark:border-rose-800',
                                default => 'bg-slate-100 text-slate-800 border-slate-200 dark:bg-slate-700 dark:text-slate-300 dark:border-slate-600',
                            };
                        @endphp
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold border {{ $badgeColor }}">
                            {{ $dokter->spesialisasi }}
                        </span>
                    </div>

                    <div class="w-full grid grid-cols-1 gap-2 border-t border-slate-100 dark:border-slate-700 pt-4">
                        <div class="flex flex-col">
                            <span class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Bergabung Sejak</span>
                            <span class="font-semibold text-slate-900 dark:text-white">
                                {{ $dokter->created_at->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-background-dark rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6">
                    <h3 class="font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">contact_phone</span>
                        Kontak Cepat
                    </h3>
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-600 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]">call</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-slate-500 dark:text-slate-400">Nomor Telepon</span>
                                <span class="text-sm font-medium text-slate-900 dark:text-white">{{ $dokter->no_telepon }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 flex flex-col gap-6">
                <div class="bg-white dark:bg-background-dark rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/50">
                        <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">stethoscope</span>
                            Informasi Dokter
                        </h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Lengkap</span>
                            <span class="text-slate-900 dark:text-white font-medium">{{ $dokter->nama_dokter }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Spesialisasi</span>
                            <span class="text-slate-900 dark:text-white font-medium">{{ $dokter->spesialisasi }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nomor SIP</span>
                            <span class="text-slate-900 dark:text-white font-medium font-mono">{{ $dokter->no_sip }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Terdaftar Pada</span>
                            <span class="text-slate-900 dark:text-white font-medium">
                                {{ $dokter->created_at->format('d/m/Y H:i') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="bg-red-50 dark:bg-red-900/10 rounded-xl border border-red-100 dark:border-red-900/20 overflow-hidden">
                    <div class="px-6 py-4 flex items-center justify-between">
                        <div class="flex flex-col gap-1">
                            <h3 class="font-bold text-red-900 dark:text-red-400">Hapus Data Dokter</h3>
                            <p class="text-sm text-red-700 dark:text-red-300">Menghapus data dokter ini bersifat permanen.</p>
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
                                    <h3 class="text-xl font-bold leading-6 text-slate-900" id="modal-title">Hapus Data Dokter</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-slate-500">
                                            Apakah Anda yakin ingin menghapus data dokter <span class="font-bold text-slate-900">{{ $dokter->nama_dokter }}</span>? 
                                            Tindakan ini tidak dapat dibatalkan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                            <form action="{{ route('dokter.destroy', $dokter->id_dokter) }}" method="POST" class="inline-flex w-full sm:w-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:w-auto transition-colors">
                                    Hapus Dokter
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