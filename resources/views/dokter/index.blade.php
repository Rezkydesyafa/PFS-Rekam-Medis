<x-app-layout>
    <div class="mx-auto max-w-7xl flex flex-col gap-6" x-data="{ showDeleteModal: false, deleteId: null, deleteName: '' }">
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary transition-colors" href="{{ route('dashboard') }}">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-white">Dokter</span>
        </div>

        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Daftar Dokter</h1>
                <p class="text-slate-500 dark:text-slate-400">Kelola data dokter, spesialisasi, tarif, dan jadwal praktik.</p>
            </div>
            <a href="{{ route('dokter.create') }}" class="inline-flex h-10 items-center justify-center gap-2 whitespace-nowrap rounded-lg bg-primary px-4 py-2 text-sm font-bold text-white shadow hover:bg-primary/90 transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50">
                <span class="material-symbols-outlined text-lg">add</span>
                Tambah Dokter Baru
            </a>
        </div>
        
        @if(session('success'))
        <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-lg relative flex items-center gap-2" role="alert">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

            {{-- Filter Bar --}}
            <x-filter-bar :action="route('dokter.index')" placeholder="Nama, SIP, Telepon...">
                <select name="spesialisasi" onchange="this.form.submit()" class="w-full md:w-48 py-2 pl-3 pr-8 rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-sm md:text-xs lg:text-sm focus:ring-primary focus:border-primary dark:text-white shadow-sm cursor-pointer">
                    <option value="all">Semua Spesialisasi</option>
                    <option value="Umum" {{ request('spesialisasi') == 'Umum' ? 'selected' : '' }}>Umum</option>
                    <option value="Gigi" {{ request('spesialisasi') == 'Gigi' ? 'selected' : '' }}>Gigi</option>
                    <option value="Anak" {{ request('spesialisasi') == 'Anak' ? 'selected' : '' }}>Anak</option>
                    <option value="Jantung" {{ request('spesialisasi') == 'Jantung' ? 'selected' : '' }}>Jantung</option>
                </select>
            </x-filter-bar>

        <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark shadow-sm overflow-hidden flex flex-col">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/50">
                        <tr>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white min-w-[250px]">Nama Dokter</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">Spesialisasi</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">Tarif Jasa</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">No. SIP</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">Kontak</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse($dokters as $dokter)
                        <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="p-4 align-middle">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 flex-shrink-0 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-500 font-bold overflow-hidden">
                                        <div class="w-full h-full bg-primary/10 text-primary flex items-center justify-center border border-primary/20">
                                            {{ substr($dokter->nama_dokter, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-900 dark:text-white">{{ $dokter->nama_dokter }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 align-middle">
                                @php
                                    $badgeColor = match($dokter->spesialisasi) {
                                        'Umum' => 'bg-blue-100 text-blue-800 border-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800',
                                        'Gigi' => 'bg-teal-100 text-teal-800 border-teal-200 dark:bg-teal-900/30 dark:text-teal-300 dark:border-teal-800',
                                        'Anak' => 'bg-amber-100 text-amber-800 border-amber-200 dark:bg-amber-900/30 dark:text-amber-300 dark:border-amber-800',
                                        'Jantung' => 'bg-rose-100 text-rose-800 border-rose-200 dark:bg-rose-900/30 dark:text-rose-300 dark:border-rose-800',
                                        default => 'bg-slate-100 text-slate-800 border-slate-200 dark:bg-slate-700 dark:text-slate-300 dark:border-slate-600',
                                    };
                                @endphp
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold border {{ $badgeColor }}">
                                    {{ $dokter->spesialisasi }}
                                </span>
                            </td>
                            <td class="p-4 align-middle text-emerald-600 dark:text-emerald-400 font-medium">
                                Rp {{ number_format($dokter->tarif, 0, ',', '.') }}
                            </td>
                            <td class="p-4 align-middle text-slate-600 dark:text-slate-300 font-mono text-xs">
                                {{ $dokter->no_sip }}
                            </td>
                            <td class="p-4 align-middle text-slate-600 dark:text-slate-300">
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-slate-400">call</span> 
                                    {{ $dokter->no_telepon }}
                                </div>
                            </td>
                            <td class="p-4 align-middle text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('dokter.show', $dokter->id_dokter) }}" class="h-8 w-8 inline-flex items-center justify-center rounded-lg text-slate-500 hover:text-primary hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors" title="Lihat Detail">
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </a>
                                    <a href="{{ route('dokter.edit', $dokter->id_dokter) }}" class="h-8 w-8 inline-flex items-center justify-center rounded-lg text-primary hover:bg-primary/10 transition-colors" title="Edit Data">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </a>
                                    <button 
                                        @click="showDeleteModal = true; deleteId = {{ $dokter->id_dokter }}; deleteName = '{{ $dokter->nama_dokter }}'"
                                        class="h-8 w-8 inline-flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors" 
                                        title="Hapus Data">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-500 text-sm">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="material-symbols-outlined text-4xl text-slate-300">medical_services</span>
                                    <p>Belum ada data dokter.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between p-4 border-t border-slate-200 dark:border-slate-800">
                <div class="text-sm text-slate-500 dark:text-slate-400">
                    Menampilkan <span class="font-medium text-slate-900 dark:text-white">{{ $dokters->firstItem() ?? 0 }} - {{ $dokters->lastItem() ?? 0 }}</span> dari <span class="font-medium text-slate-900 dark:text-white">{{ $dokters->total() }}</span> dokter
                </div>
                
                {{ $dokters->links() }} 
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
                                            Apakah Anda yakin ingin menghapus data dokter <span class="font-bold text-slate-900" x-text="deleteName"></span>? 
                                            Tindakan ini tidak dapat dibatalkan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                            <form :action="'/dokter/' + deleteId" method="POST" class="inline-flex w-full sm:w-auto">
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

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-app-layout>