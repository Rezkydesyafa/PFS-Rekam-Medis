<x-app-layout>
    <div class="mx-auto max-w-7xl flex flex-col gap-6" x-data="{ showDeleteModal: false }">
        <!-- Breadcrumb & Header -->
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary transition-colors" href="{{ route('dashboard') }}">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="{{ route('pasien.index') }}">Pasien</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-white">Detail Pasien</span>
        </div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Detail Pasien</h1>
                <p class="text-slate-500 dark:text-slate-400">Informasi lengkap dan rekam data pasien.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('pasien.index') }}" class="inline-flex h-10 items-center justify-center gap-2 whitespace-nowrap rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-200 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                    Kembali
                </a>
                <a href="{{ route('pasien.edit', $pasien->id_pasien) }}" class="inline-flex h-10 items-center justify-center gap-2 whitespace-nowrap rounded-lg bg-primary px-4 py-2 text-sm font-bold text-white shadow hover:bg-primary/90 transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring">
                    <span class="material-symbols-outlined text-[20px]">edit</span>
                    Edit Data
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Card (Left Column) -->
            <div class="lg:col-span-1 flex flex-col gap-6">
                <div class="bg-white dark:bg-background-dark rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6 flex flex-col items-center text-center">
                    <div class="h-28 w-28 rounded-full bg-slate-100 dark:bg-slate-800 p-1 mb-4">
                        <div class="h-full w-full rounded-full bg-primary/10 text-primary flex items-center justify-center text-3xl font-bold border border-primary/20">
                            {{ substr($pasien->name, 0, 2) }}
                        </div>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">{{ $pasien->name }}</h2>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mb-4">{{ $pasien->no_rm }}</p>
                    
                    <div class="w-full flex justify-center gap-2 mb-6">
                        @if($pasien->status == 'active')
                            <span class="inline-flex items-center rounded-full bg-emerald-100 dark:bg-emerald-900/30 px-3 py-1 text-sm font-semibold text-emerald-800 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                Aktif
                            </span>
                        @elseif($pasien->status == 'pending')
                            <span class="inline-flex items-center rounded-full bg-amber-100 dark:bg-amber-900/30 px-3 py-1 text-sm font-semibold text-amber-800 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                Pending
                            </span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-slate-100 dark:bg-slate-700 px-3 py-1 text-sm font-semibold text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-600">
                                Non-Aktif
                            </span>
                        @endif
                    </div>

                    <div class="w-full grid grid-cols-2 gap-2 border-t border-slate-100 dark:border-slate-700 pt-4">
                        <div class="flex flex-col">
                            <span class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Usia</span>
                            <span class="font-semibold text-slate-900 dark:text-white">{{ \Carbon\Carbon::parse($pasien->tgl_lahir)->age }} Tahun</span>
                        </div>
                        <div class="flex flex-col border-l border-slate-100 dark:border-slate-700">
                            <span class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Gol. Darah</span>
                            <span class="font-semibold text-slate-900 dark:text-white">{{ $pasien->gol_darah ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Info Small -->
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
                                <span class="text-sm font-medium text-slate-900 dark:text-white">{{ $pasien->no_hp }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded-lg bg-orange-50 dark:bg-orange-900/20 text-orange-600 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]">mail</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-slate-500 dark:text-slate-400">Email</span>
                                <span class="text-sm font-medium text-slate-900 dark:text-white">{{ $pasien->email ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Info (Right Column) -->
            <div class="lg:col-span-2 flex flex-col gap-6">
                <!-- General Information -->
                <div class="bg-white dark:bg-background-dark rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/50">
                        <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">badge</span>
                            Informasi Pribadi
                        </h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nomor Induk Kependudukan (NIK)</span>
                            <span class="text-slate-900 dark:text-white font-medium">{{ $pasien->nik }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">No. Rekam Medis (RM)</span>
                            <span class="text-slate-900 dark:text-white font-medium">{{ $pasien->no_rm }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tempat, Tanggal Lahir</span>
                            <span class="text-slate-900 dark:text-white font-medium">
                                {{ \Carbon\Carbon::parse($pasien->tgl_lahir)->format('d F Y') }}
                            </span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Jenis Kelamin</span>
                            <span class="text-slate-900 dark:text-white font-medium">
                                {{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status Pernikahan</span>
                            <span class="text-slate-900 dark:text-white font-medium">{{ $pasien->status_nikah ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Terdaftar Sejak</span>
                            <span class="text-slate-900 dark:text-white font-medium">
                                {{ $pasien->created_at->format('d F Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="bg-white dark:bg-background-dark rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
                        <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">location_on</span>
                            Alamat Lengkap
                        </h3>
                    </div>
                    <div class="p-6">
                        <p class="text-slate-700 dark:text-slate-300 leading-relaxed max-w-2xl">
                            {{ $pasien->alamat }}
                        </p>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="bg-red-50 dark:bg-red-900/10 rounded-xl border border-red-100 dark:border-red-900/20 overflow-hidden">
                    <div class="px-6 py-4 flex items-center justify-between">
                        <div class="flex flex-col gap-1">
                            <h3 class="font-bold text-red-900 dark:text-red-400">Hapus Data Pasien</h3>
                            <p class="text-sm text-red-700 dark:text-red-300">Menghapus data pasien ini akan menghapus semua riwayat medis terkait.</p>
                        </div>
                        <button @click="showDeleteModal = true" class="px-4 py-2 bg-white dark:bg-transparent border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 rounded-lg text-sm font-medium hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            Hapus Data
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
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
                                    <h3 class="text-xl font-bold leading-6 text-slate-900" id="modal-title">Hapus Data Pasien</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-slate-500">
                                            Apakah Anda yakin ingin menghapus data pasien <span class="font-bold text-slate-900">{{ $pasien->name }}</span>? 
                                            Tindakan ini tidak dapat dibatalkan dan semua riwayat medis akan dihapus permanen.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                            <form action="{{ route('pasien.destroy', $pasien->id_pasien) }}" method="POST" class="inline-flex w-full sm:w-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:w-auto transition-colors">
                                    Hapus Pasien
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
