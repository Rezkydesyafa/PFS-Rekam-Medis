<x-app-layout>
    <div class="mx-auto max-w-4xl flex flex-col gap-6">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary transition-colors" href="{{ route('dashboard') }}">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="{{ route('pasien.index') }}">Pasien</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-white">Tambah Pasien</span>
        </div>

        <!-- Header -->
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Tambah Pasien Baru</h1>
            <p class="text-slate-500 dark:text-slate-400">Masukkan informasi pasien baru dengan data yang valid.</p>
        </div>

        <!-- Form Card -->
        <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark shadow-sm overflow-hidden p-6 md:p-8">
            <form action="{{ route('pasien.store') }}" method="POST" class="flex flex-col gap-6">
                @csrf
                
                <!-- Personal Info -->
                <div>
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">person</span>
                        Informasi Pribadi
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1 md:col-span-2 flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="name">Nama Lengkap</label>
                            <input class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm placeholder:text-slate-400 @error('name') border-red-500 @enderror" 
                                   id="name" name="name" type="text" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required/>
                            @error('name')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="nik">NIK (Nomor Induk Kependudukan)</label>
                            <input class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm placeholder:text-slate-400 @error('nik') border-red-500 @enderror" 
                                   id="nik" name="nik" type="number" placeholder="16 digit NIK" value="{{ old('nik') }}" required/>
                            @error('nik')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="medicalId">No. Rekam Medis</label>
                            <input class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-slate-100 dark:bg-slate-900 text-slate-500 dark:text-slate-400 cursor-not-allowed" 
                                   id="medicalId" name="no_rm" readonly type="text" value="AUTO-GENERATE" title="Akan digenerate otomatis"/>
                            <p class="text-[10px] text-slate-500">Nomor Rekam Medis akan digenerate otomatis.</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="birthDate">Tanggal Lahir</label>
                            <input class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm @error('tgl_lahir') border-red-500 @enderror" 
                                   id="birthDate" name="tgl_lahir" type="date" value="{{ old('tgl_lahir') }}" required/>
                            @error('tgl_lahir')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="gender">Jenis Kelamin</label>
                            <select class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm @error('jenis_kelamin') border-red-500 @enderror" 
                                    id="gender" name="jenis_kelamin" required>
                                <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="bloodType">Golongan Darah</label>
                            <select class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm" 
                                    id="bloodType" name="gol_darah">
                                <option value="" selected>Tidak Tahu / Belum Diisi</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="maritalStatus">Status Pernikahan</label>
                            <select class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm" 
                                    id="maritalStatus" name="status_nikah">
                                <option value="Belum Menikah">Belum Menikah</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Cerai Hidup">Cerai Hidup</option>
                                <option value="Cerai Mati">Cerai Mati</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="h-px bg-slate-200 dark:bg-slate-800 my-2"></div>

                <!-- Contact & Address -->
                <div>
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">contact_phone</span>
                        Kontak & Alamat
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="phone">Nomor Telepon</label>
                            <input class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm placeholder:text-slate-400 @error('no_hp') border-red-500 @enderror" 
                                   id="phone" name="no_hp" type="tel" placeholder="08xxxxxxxxxx" value="{{ old('no_hp') }}" required/>
                            @error('no_hp')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="email">Email (Opsional)</label>
                            <input class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm placeholder:text-slate-400 @error('email') border-red-500 @enderror" 
                                   id="email" name="email" type="email" placeholder="email@contoh.com" value="{{ old('email') }}"/>
                            @error('email')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-1 md:col-span-2 flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="address">Alamat Lengkap</label>
                            <textarea class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary shadow-sm placeholder:text-slate-400 @error('alamat') border-red-500 @enderror" 
                                      id="address" name="alamat" rows="3" placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan..." required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="h-px bg-slate-200 dark:bg-slate-800 my-2"></div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-3 mt-4 pt-4 border-t border-slate-200 dark:border-slate-800">
                    <a href="{{ route('pasien.index') }}" class="px-5 py-2.5 rounded-lg border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                        Batal
                    </a>
                    <button class="px-5 py-2.5 rounded-lg bg-primary text-white font-bold hover:bg-primary/90 shadow-sm hover:shadow-lg hover:shadow-primary/30 transition-all flex items-center gap-2" type="submit">
                        <span class="material-symbols-outlined text-xl">save</span>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
