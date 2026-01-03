<x-app-layout>
    <div class="mx-auto max-w-7xl flex flex-col gap-6">
        <!-- Breadcrumb & Header -->
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary transition-colors" href="{{ route('dashboard') }}">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-white">Pasien</span>
        </div>

        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Daftar Pasien</h1>
                <p class="text-slate-500 dark:text-slate-400">Kelola data pasien, riwayat medis, dan informasi kontak.</p>
            </div>
            <button class="inline-flex h-10 items-center justify-center gap-2 whitespace-nowrap rounded-lg bg-primary px-4 py-2 text-sm font-bold text-white shadow hover:bg-primary/90 transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50">
                <span class="material-symbols-outlined text-lg">add</span>
                Tambah Pasien Baru
            </button>
        </div>

        <!-- Filters & Search -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center bg-white dark:bg-background-dark p-4 rounded-xl shadow-sm border border-slate-200/60 dark:border-slate-800">
            <div class="md:col-span-5 lg:col-span-4 relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">search</span>
                <input class="w-full h-10 pl-10 pr-4 rounded-lg bg-slate-50 dark:bg-slate-800 border-none focus:ring-2 focus:ring-primary/20 text-sm text-slate-900 dark:text-white placeholder:text-slate-400" placeholder="Cari nama, NIK, atau No. RM..." type="text"/>
            </div>
            <div class="md:col-span-7 lg:col-span-8 flex flex-wrap gap-2 items-center justify-start md:justify-end">
                <button class="inline-flex h-9 items-center justify-center gap-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-transparent px-3 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                    <span>Status: Semua</span>
                    <span class="material-symbols-outlined text-[18px]">expand_more</span>
                </button>
                <button class="inline-flex h-9 items-center justify-center gap-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-transparent px-3 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                    <span>Gender: Semua</span>
                    <span class="material-symbols-outlined text-[18px]">expand_more</span>
                </button>
                <button class="inline-flex h-9 items-center justify-center gap-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-transparent px-3 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors ml-auto md:ml-0">
                    <span class="material-symbols-outlined text-[18px]">filter_list</span>
                    <span>Filter Lainnya</span>
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark shadow-sm overflow-hidden flex flex-col">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/50">
                        <tr>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white min-w-[250px]">Nama Pasien</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">ID Medis</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">Tanggal Lahir</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">Kontak</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">Status</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        <!-- Example Row 1 -->
                        <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="p-4 align-middle">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 flex-shrink-0 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-500 font-bold overflow-hidden">
                                        <!-- Avatar Image or Initials -->
                                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random" alt="BS" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-900 dark:text-white">Budi Santoso</span>
                                        <span class="text-xs text-slate-500 dark:text-slate-400">Laki-laki</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 align-middle text-slate-600 dark:text-slate-300 font-medium">RM-2023-001</td>
                            <td class="p-4 align-middle text-slate-600 dark:text-slate-300">
                                12 Jan 1980 <span class="text-slate-400 dark:text-slate-500 text-xs ml-1">(44 th)</span>
                            </td>
                            <td class="p-4 align-middle text-slate-600 dark:text-slate-300">
                                <div class="flex flex-col gap-0.5">
                                    <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px] text-slate-400">call</span> 0812-3456-7890</span>
                                    <span class="text-xs text-slate-500 truncate max-w-[150px]">Jl. Merdeka No. 10</span>
                                </div>
                            </td>
                            <td class="p-4 align-middle">
                                <span class="inline-flex items-center rounded-full bg-emerald-100 dark:bg-emerald-900/30 px-2.5 py-0.5 text-xs font-semibold text-emerald-800 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                    Aktif
                                </span>
                            </td>
                            <td class="p-4 align-middle text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="h-8 w-8 inline-flex items-center justify-center rounded-lg text-primary hover:bg-primary/10 transition-colors" title="Edit Data">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </button>
                                    <button class="h-8 w-8 inline-flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors" title="Hapus Data">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Example Row 2 -->
                        <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="p-4 align-middle">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 flex-shrink-0 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-500 font-bold overflow-hidden">
                                        <div class="w-full h-full bg-indigo-100 text-indigo-600 flex items-center justify-center">SA</div>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-900 dark:text-white">Siti Aminah</span>
                                        <span class="text-xs text-slate-500 dark:text-slate-400">Perempuan</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 align-middle text-slate-600 dark:text-slate-300 font-medium">RM-2023-042</td>
                            <td class="p-4 align-middle text-slate-600 dark:text-slate-300">
                                05 Mei 1992 <span class="text-slate-400 dark:text-slate-500 text-xs ml-1">(31 th)</span>
                            </td>
                            <td class="p-4 align-middle text-slate-600 dark:text-slate-300">
                                <div class="flex flex-col gap-0.5">
                                    <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px] text-slate-400">call</span> 0819-8877-6655</span>
                                    <span class="text-xs text-slate-500 truncate max-w-[150px]">Komp. Griya Asri B2</span>
                                </div>
                            </td>
                            <td class="p-4 align-middle">
                                <span class="inline-flex items-center rounded-full bg-emerald-100 dark:bg-emerald-900/30 px-2.5 py-0.5 text-xs font-semibold text-emerald-800 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                    Aktif
                                </span>
                            </td>
                            <td class="p-4 align-middle text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="h-8 w-8 inline-flex items-center justify-center rounded-lg text-primary hover:bg-primary/10 transition-colors" title="Edit Data">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </button>
                                    <button class="h-8 w-8 inline-flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors" title="Hapus Data">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between p-4 border-t border-slate-200 dark:border-slate-800">
                <div class="text-sm text-slate-500 dark:text-slate-400">
                    Menampilkan <span class="font-medium text-slate-900 dark:text-white">1-2</span> dari <span class="font-medium text-slate-900 dark:text-white">50</span> pasien
                </div>
                <div class="flex gap-2">
                    <button class="inline-flex items-center justify-center h-9 px-3 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 disabled:opacity-50 disabled:pointer-events-none transition-colors" disabled>
                        <span class="material-symbols-outlined text-[20px]">chevron_left</span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="inline-flex items-center justify-center h-9 w-9 rounded-lg bg-primary text-white text-sm font-medium hover:bg-primary/90 transition-colors">
                        1
                    </button>
                    <button class="inline-flex items-center justify-center h-9 w-9 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                        2
                    </button>
                    <button class="inline-flex items-center justify-center h-9 px-3 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
