<x-app-layout>
    <div class="w-full max-w-4xl mx-auto">
        <nav class="flex mb-6 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-slate-500 hover:text-slate-300">Beranda</a>
                </li>
                <li><span class="text-slate-400 mx-2">›</span></li>
                <li class="inline-flex items-center">
                    <a href="{{ route('obat.index') }}" class="text-slate-500 hover:text-slate-300">Obat</a>
                </li>
                <li><span class="text-slate-400 mx-2">›</span></li>
                <li class="text-slate-300 font-medium">Edit Obat</li>
            </ol>
        </nav>

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Edit Data Obat</h1>
            <p class="text-slate-400">Perbarui informasi obat <span class="text-white font-semibold">{{ $obat->nama_obat }}</span>.</p>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl shadow-xl overflow-hidden">
            <form method="POST" action="{{ route('obat.update', $obat->id_obat) }}" class="p-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="kode_obat" class="block text-sm font-medium text-slate-300 mb-2">
                            Kode Obat <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="kode_obat" id="kode_obat" value="{{ old('kode_obat', $obat->kode_obat) }}" 
                               class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('kode_obat') border-red-500 @enderror" 
                               placeholder="OBT-001" required>
                        @error('kode_obat')
                            <p class="text-red-400 text-xs mt-1 flex items-center">
                                <span class="material-symbols-outlined text-[14px] mr-1">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="nama_obat" class="block text-sm font-medium text-slate-300 mb-2">
                            Nama Obat <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="nama_obat" id="nama_obat" value="{{ old('nama_obat', $obat->nama_obat) }}" 
                               class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('nama_obat') border-red-500 @enderror" 
                               placeholder="Paracetamol 500mg" required>
                        @error('nama_obat')
                            <p class="text-red-400 text-xs mt-1 flex items-center">
                                <span class="material-symbols-outlined text-[14px] mr-1">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="satuan" class="block text-sm font-medium text-slate-300 mb-2">
                            Satuan <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <select name="satuan" id="satuan" 
                                    class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none @error('satuan') border-red-500 @enderror" required>
                                <option value="">-- Pilih Satuan --</option>
                                <option value="Tablet" {{ old('satuan', $obat->satuan) == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                                <option value="Kapsul" {{ old('satuan', $obat->satuan) == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
                                <option value="Botol" {{ old('satuan', $obat->satuan) == 'Botol' ? 'selected' : '' }}>Botol</option>
                                <option value="Ampul" {{ old('satuan', $obat->satuan) == 'Ampul' ? 'selected' : '' }}>Ampul</option>
                                <option value="Strip" {{ old('satuan', $obat->satuan) == 'Strip' ? 'selected' : '' }}>Strip</option>
                                <option value="Box" {{ old('satuan', $obat->satuan) == 'Box' ? 'selected' : '' }}>Box</option>
                                <option value="Tube" {{ old('satuan', $obat->satuan) == 'Tube' ? 'selected' : '' }}>Tube</option>
                                <option value="Sachet" {{ old('satuan', $obat->satuan) == 'Sachet' ? 'selected' : '' }}>Sachet</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        @error('satuan')
                            <p class="text-red-400 text-xs mt-1 flex items-center">
                                <span class="material-symbols-outlined text-[14px] mr-1">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="stok" class="block text-sm font-medium text-slate-300 mb-2">
                            Stok <span class="text-red-400">*</span>
                        </label>
                        <input type="number" name="stok" id="stok" value="{{ old('stok', $obat->stok) }}" min="0"
                               class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('stok') border-red-500 @enderror" 
                               placeholder="0" required>
                        @error('stok')
                            <p class="text-red-400 text-xs mt-1 flex items-center">
                                <span class="material-symbols-outlined text-[14px] mr-1">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="harga" class="block text-sm font-medium text-slate-300 mb-2">
                            Harga (Rp) <span class="text-red-400">*</span>
                        </label>
                        <input type="number" name="harga" id="harga" value="{{ old('harga', $obat->harga) }}" min="0" step="0.01"
                               class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('harga') border-red-500 @enderror" 
                               placeholder="5000" required>
                        @error('harga')
                            <p class="text-red-400 text-xs mt-1 flex items-center">
                                <span class="material-symbols-outlined text-[14px] mr-1">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_kadaluarsa" class="block text-sm font-medium text-slate-300 mb-2">
                            Tanggal Kadaluarsa <span class="text-red-400">*</span>
                        </label>
                        <input type="date" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa" 
                               value="{{ old('tanggal_kadaluarsa', $obat->tanggal_kadaluarsa->format('Y-m-d')) }}"
                               class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all [color-scheme:dark] @error('tanggal_kadaluarsa') border-red-500 @enderror" 
                               required>
                        @error('tanggal_kadaluarsa')
                            <p class="text-red-400 text-xs mt-1 flex items-center">
                                <span class="material-symbols-outlined text-[14px] mr-1">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-slate-700/50">
                    <a href="{{ route('obat.index') }}" 
                       class="px-6 py-2.5 rounded-lg border border-slate-600 text-slate-300 font-medium hover:bg-slate-700 hover:text-white transition-all duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-2.5 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-500 shadow-lg shadow-blue-500/30 transition-all duration-200 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">save</span>
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>