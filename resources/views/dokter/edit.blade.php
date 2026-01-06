<x-app-layout>
    <div class="mx-auto max-w-4xl flex flex-col gap-6">
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary transition-colors" href="{{ route('dashboard') }}">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="{{ route('dokter.index') }}">Dokter</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-white">Edit Dokter</span>
        </div>

        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Edit Data Dokter</h1>
            <p class="text-slate-500 dark:text-slate-400">Perbarui informasi dokter dengan data yang valid.</p>
        </div>

        <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark shadow-sm overflow-hidden p-6 md:p-8">
            
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dokter.update', $dokter->id_dokter) }}" method="POST" class="flex flex-col gap-6">
                @csrf
                @method('PUT')
                
                <div>
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">stethoscope</span>
                        Informasi Dokter
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="col-span-1 md:col-span-2 flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="nama_dokter">Nama Lengkap</label>
                            <input class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm placeholder:text-slate-400" 
                                   id="nama_dokter" name="nama_dokter" type="text" 
                                   value="{{ old('nama_dokter', $dokter->nama_dokter) }}" required/>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="spesialisasi">Spesialisasi</label>
                            <select class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm" 
                                    id="spesialisasi" name="spesialisasi" required>
                                <option value="" disabled>Pilih Spesialisasi</option>
                                <option value="Umum" {{ old('spesialisasi', $dokter->spesialisasi) == 'Umum' ? 'selected' : '' }}>Umum</option>
                                <option value="Gigi" {{ old('spesialisasi', $dokter->spesialisasi) == 'Gigi' ? 'selected' : '' }}>Gigi</option>
                                <option value="Anak" {{ old('spesialisasi', $dokter->spesialisasi) == 'Anak' ? 'selected' : '' }}>Anak</option>
                                <option value="Jantung" {{ old('spesialisasi', $dokter->spesialisasi) == 'Jantung' ? 'selected' : '' }}>Jantung</option>
                            </select>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="no_sip">Nomor SIP</label>
                            <input class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm placeholder:text-slate-400" 
                                   id="no_sip" name="no_sip" type="text" 
                                   value="{{ old('no_sip', $dokter->no_sip) }}" required/>
                        </div>

                    </div>
                </div>

                <div class="h-px bg-slate-200 dark:bg-slate-800 my-2"></div>

                <div>
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">contact_phone</span>
                        Kontak
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1 md:col-span-2 flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="no_telepon">Nomor Telepon</label>
                            <input class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm placeholder:text-slate-400" 
                                   id="no_telepon" name="no_telepon" type="tel" 
                                   value="{{ old('no_telepon', $dokter->no_telepon) }}" required/>
                        </div>
                    </div>
                </div>

                <div class="h-px bg-slate-200 dark:bg-slate-800 my-2"></div>

                <div class="flex items-center justify-end gap-3 mt-4 pt-4 border-t border-slate-200 dark:border-slate-800">
                    <a href="{{ route('dokter.index') }}" class="px-5 py-2.5 rounded-lg border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                        Batal
                    </a>
                    <button class="px-5 py-2.5 rounded-lg bg-primary text-white font-bold hover:bg-primary/90 shadow-sm hover:shadow-lg hover:shadow-primary/30 transition-all flex items-center gap-2" type="submit">
                        <span class="material-symbols-outlined text-xl">save</span>
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>