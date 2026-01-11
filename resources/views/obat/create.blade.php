<x-app-layout>
    <div class="mx-auto max-w-7xl flex flex-col gap-6">
        
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary transition-colors" href="{{ route('dashboard') }}">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="{{ route('obat.index') }}">Obat</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-white">Tambah Obat</span>
        </div>

        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Tambah Data Obat</h1>
            <p class="text-slate-500 dark:text-slate-400">Masukkan informasi lengkap obat baru ke dalam sistem.</p>
        </div>

        <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm">
            <form method="POST" action="{{ route('obat.store') }}" class="p-6 md:p-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kode Obat -->
                    <div class="space-y-2">
                        <label for="kode_obat" class="text-sm font-semibold text-slate-900 dark:text-white">
                            Kode Obat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="kode_obat" id="kode_obat" value="{{ old('kode_obat') }}" 
                               class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all @error('kode_obat') border-red-500 @enderror" 
                               placeholder="Contoh: OBT-001" required>
                        @error('kode_obat')
                            <p class="text-red-500 text-xs flex items-center gap-1 mt-1">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Nama Obat -->
                    <div class="space-y-2">
                        <label for="nama_obat" class="text-sm font-semibold text-slate-900 dark:text-white">
                            Nama Obat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_obat" id="nama_obat" value="{{ old('nama_obat') }}" 
                               class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all @error('nama_obat') border-red-500 @enderror" 
                               placeholder="Contoh: Paracetamol 500mg" required>
                        @error('nama_obat')
                            <p class="text-red-500 text-xs flex items-center gap-1 mt-1">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Satuan -->
                    <div class="space-y-2">
                        <label for="satuan" class="text-sm font-semibold text-slate-900 dark:text-white">
                            Satuan <span class="text-red-500">*</span>
                        </label>
                        <select name="satuan" id="satuan" 
                                class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all cursor-pointer @error('satuan') border-red-500 @enderror" required>
                            <option value="">-- Pilih Satuan --</option>
                            <option value="Tablet" {{ old('satuan') == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                            <option value="Kapsul" {{ old('satuan') == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
                            <option value="Botol" {{ old('satuan') == 'Botol' ? 'selected' : '' }}>Botol</option>
                            <option value="Ampul" {{ old('satuan') == 'Ampul' ? 'selected' : '' }}>Ampul</option>
                            <option value="Strip" {{ old('satuan') == 'Strip' ? 'selected' : '' }}>Strip</option>
                            <option value="Box" {{ old('satuan') == 'Box' ? 'selected' : '' }}>Box</option>
                            <option value="Tube" {{ old('satuan') == 'Tube' ? 'selected' : '' }}>Tube</option>
                            <option value="Sachet" {{ old('satuan') == 'Sachet' ? 'selected' : '' }}>Sachet</option>
                        </select>
                        @error('satuan')
                            <p class="text-red-500 text-xs flex items-center gap-1 mt-1">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Stok -->
                    <div class="space-y-2">
                        <label for="stok" class="text-sm font-semibold text-slate-900 dark:text-white">
                            Stok Awal <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="stok" id="stok" value="{{ old('stok', 0) }}" min="0"
                               class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all @error('stok') border-red-500 @enderror" 
                               placeholder="0" required>
                        @error('stok')
                            <p class="text-red-500 text-xs flex items-center gap-1 mt-1">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div class="space-y-2">
                        <label for="harga" class="text-sm font-semibold text-slate-900 dark:text-white">
                            Harga (Rp) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500 font-medium">Rp</span>
                            <input type="number" name="harga" id="harga" value="{{ old('harga') }}" min="0" step="0.01"
                                   class="w-full pl-10 rounded-lg border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all @error('harga') border-red-500 @enderror" 
                                   placeholder="0" required>
                        </div>
                        @error('harga')
                            <p class="text-red-500 text-xs flex items-center gap-1 mt-1">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Tanggal Kadaluarsa -->
                    <div class="space-y-2">
                        <label for="tanggal_kadaluarsa" class="text-sm font-semibold text-slate-900 dark:text-white">
                            Tanggal Kadaluarsa <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa" value="{{ old('tanggal_kadaluarsa') }}"
                               class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all @error('tanggal_kadaluarsa') border-red-500 @enderror" 
                               required>
                        @error('tanggal_kadaluarsa')
                            <p class="text-red-500 text-xs flex items-center gap-1 mt-1">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-slate-200 dark:border-slate-800">
                    <a href="{{ route('obat.index') }}" 
                       class="px-5 py-2.5 rounded-lg border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-lg bg-primary text-white font-bold hover:bg-primary/90 shadow-lg shadow-primary/20 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">save</span>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>