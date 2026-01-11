<x-app-layout>
    <div class="mx-auto max-w-7xl flex flex-col gap-6" x-data="{ showDeleteModal: false, deleteId: null }">
        
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary transition-colors" href="{{ route('dashboard') }}">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-white">Rekam Medis</span>
        </div>

        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Riwayat Pemeriksaan</h1>
                <p class="text-slate-500 dark:text-slate-400">Data rekam medis pasien dan status pembayaran.</p>
            </div>
            <a href="{{ route('rekam-medis.create') }}" class="inline-flex h-10 items-center justify-center gap-2 whitespace-nowrap rounded-lg bg-primary px-4 py-2 text-sm font-bold text-white shadow hover:bg-primary/90 transition-colors">
                <span class="material-symbols-outlined text-lg">add_circle</span>
                Input Pemeriksaan Baru
            </a>
        </div>

        @if(session('success'))
        <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-lg flex items-center gap-2">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
            {{ session('success') }}
        </div>
        @endif

        <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark shadow-sm overflow-hidden flex flex-col">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/50">
                        <tr>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">Tanggal</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">Pasien</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">Diagnosa</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white">Dokter</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white text-center">Status Bayar</th>
                            <th class="h-12 px-4 py-3 font-semibold text-slate-900 dark:text-white text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse($rekamMedis as $rm)
                        <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="p-4 align-middle text-slate-600 dark:text-slate-300">
                                {{ \Carbon\Carbon::parse($rm->tgl_kunjungan)->format('d M Y') }}
                            </td>
                            <td class="p-4 align-middle">
                                <div class="font-bold text-slate-900 dark:text-white">{{ $rm->pasien->name }}</div>
                                <div class="text-xs text-slate-500 font-mono">{{ $rm->pasien->no_rm }}</div>
                            </td>
                            <td class="p-4 align-middle text-slate-600 dark:text-slate-300 truncate max-w-[200px]" title="{{ $rm->diagnosa }}">
                                {{ Str::limit($rm->diagnosa, 40) }}
                            </td>
                            <td class="p-4 align-middle text-slate-600 dark:text-slate-300">
                                {{ $rm->dokter->nama_dokter }}
                            </td>
                            <td class="p-4 align-middle text-center">
                                @if($rm->tagihan && $rm->tagihan->status == 'Lunas')
                                    <span class="inline-flex items-center rounded-full bg-emerald-100 dark:bg-emerald-900/30 px-2.5 py-0.5 text-xs font-bold text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                        LUNAS
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-amber-100 dark:bg-amber-900/30 px-2.5 py-0.5 text-xs font-bold text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                        BELUM LUNAS
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 align-middle text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('rekam-medis.show', $rm->id_rm) }}" class="h-8 w-8 inline-flex items-center justify-center rounded-lg text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors" title="Lihat Detail">
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </a>
                                    
                                    <a href="{{ route('rekam-medis.edit', $rm->id_rm) }}" class="h-8 w-8 inline-flex ... text-amber-500 ...">
    <span class="material-symbols-outlined text-[20px]">edit</span>
</a>

                                    <button @click="showDeleteModal = true; deleteId = {{ $rm->id_rm }}" class="h-8 w-8 inline-flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-500">
                                Belum ada data rekam medis.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                {{ $rekamMedis->links() }}
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
                                    <h3 class="text-xl font-bold text-slate-900">Hapus Rekam Medis</h3>
                                    <div class="mt-2"><p class="text-sm text-slate-500">Yakin ingin menghapus data ini? Data tagihan terkait juga akan terhapus.</p></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                            <form :action="'/rekam-medis/' + deleteId" method="POST">
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