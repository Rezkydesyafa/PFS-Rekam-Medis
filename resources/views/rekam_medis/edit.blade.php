<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8" x-data="medicalHandler()">
        
        <div class="mb-6 flex flex-col md:flex-row justify-between md:items-center gap-4">
            <div>
                <nav class="flex text-sm text-slate-500 dark:text-slate-400 mb-2">
                    <ol class="inline-flex items-center space-x-2">
                        <li><a href="{{ route('rekam-medis.index') }}" class="hover:text-primary">Rekam Medis</a></li>
                        <li><span class="mx-2">›</span></li>
                        <li class="font-medium text-slate-900 dark:text-white">Edit Data</li>
                    </ol>
                </nav>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Edit Pemeriksaan</h1>
            </div>
        </div>

        <form action="{{ route('rekam-medis.update', $rm->id_rm) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-1 space-y-6">
                    
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-5 shadow-sm">
                        <h3 class="font-bold text-slate-900 dark:text-white mb-4 border-b border-slate-100 dark:border-slate-700 pb-3">
                            Identitas
                        </h3>
                        
                        <div class="mb-4">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Tanggal</label>
                            <input type="date" name="tgl_kunjungan" value="{{ old('tgl_kunjungan', $rm->tgl_kunjungan) }}" 
                                   class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-sm @error('tgl_kunjungan') border-red-500 @enderror">
                            @error('tgl_kunjungan')
                                <p class="text-sm text-red-500 flex items-center gap-1 mt-1">
                                    <span class="material-symbols-outlined text-[16px]">error</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Dokter</label>
                            <select name="dokter_id" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm @error('dokter_id') border-red-500 @enderror">
                                @foreach($dokters as $dokter)
                                    <option value="{{ $dokter->id_dokter }}" {{ $rm->dokter_id == $dokter->id_dokter ? 'selected' : '' }}>
                                        {{ $dokter->nama_dokter }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dokter_id')
                                <p class="text-sm text-red-500 flex items-center gap-1 mt-1">
                                    <span class="material-symbols-outlined text-[16px]">error</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Pasien</label>
                            <input type="text" value="{{ $rm->pasien->name }} ({{ $rm->pasien->no_rm }})" 
                                   class="w-full rounded-lg border-slate-300 bg-slate-100 text-slate-500 text-sm cursor-not-allowed" disabled>
                            <input type="hidden" name="pasien_id" value="{{ $rm->pasien_id }}">
                        </div>
                    </div>

                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-5 shadow-sm">
                        <h3 class="font-bold text-slate-900 dark:text-white mb-4 border-b border-slate-100 dark:border-slate-700 pb-3">
                            Tanda Vital
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-slate-500 font-bold mb-1 block">Tensi</label>
                                <input type="text" name="tensi" value="{{ old('tensi', $rm->tensi) }}" class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-sm">
                            </div>
                            <div>
                                <label class="text-xs text-slate-500 font-bold mb-1 block">Suhu (°C)</label>
                                <input type="number" step="0.1" name="suhu" value="{{ old('suhu', $rm->suhu) }}" class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-sm">
                            </div>
                            <div>
                                <label class="text-xs text-slate-500 font-bold mb-1 block">Berat (Kg)</label>
                                <input type="number" name="berat_badan" value="{{ old('berat_badan', $rm->berat_badan) }}" class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-sm">
                            </div>
                            <div>
                                <label class="text-xs text-slate-500 font-bold mb-1 block">Tinggi (cm)</label>
                                <input type="number" name="tinggi_badan" value="{{ old('tinggi_badan', $rm->tinggi_badan) }}" class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-6 shadow-sm">
                        <h3 class="font-bold text-slate-900 dark:text-white mb-4 border-b border-slate-100 dark:border-slate-700 pb-3">
                            Pemeriksaan Medis
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1">Keluhan Utama</label>
                                <textarea name="keluhan" rows="2" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm @error('keluhan') border-red-500 @enderror">{{ old('keluhan', $rm->keluhan) }}</textarea>
                                @error('keluhan')
                                    <p class="text-sm text-red-500 flex items-center gap-1 mt-1">
                                        <span class="material-symbols-outlined text-[16px]">error</span>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1">Diagnosa</label>
                                <textarea name="diagnosa" rows="2" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm @error('diagnosa') border-red-500 @enderror">{{ old('diagnosa', $rm->diagnosa) }}</textarea>
                                @error('diagnosa')
                                    <p class="text-sm text-red-500 flex items-center gap-1 mt-1">
                                        <span class="material-symbols-outlined text-[16px]">error</span>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1">Catatan Tambahan</label>
                                <input type="text" name="catatan_tambahan" value="{{ old('catatan_tambahan', $rm->catatan_tambahan) }}" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-6 shadow-sm">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-blue-500">medical_services</span> Tindakan Medis
                            </h3>
                            <button type="button" @click="addActionRow()" class="text-xs bg-blue-100 text-blue-700 border border-blue-200 px-3 py-1.5 rounded-lg font-bold hover:bg-blue-200 transition flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">add</span> Tambah Tindakan
                            </button>
                        </div>

                        <div class="overflow-hidden border border-slate-200 dark:border-slate-700 rounded-lg">
                            <table class="w-full text-sm text-left">
                                <thead class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 font-bold uppercase text-xs">
                                    <tr>
                                        <th class="p-3">Nama Tindakan</th>
                                        <th class="p-3 w-10 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                                    <template x-for="(row, index) in actionRows" :key="index">
                                        <tr class="bg-white dark:bg-slate-800">
                                            <td class="p-2">
                                                <select :name="'actions['+index+']'" x-model="row.tindakan_id" class="w-full rounded border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white text-sm" required>
                                                    <option value="">-- Pilih Tindakan --</option>
                                                    @foreach($tindakans as $tindakan)
                                                        <option value="{{ $tindakan->id_tindakan }}">
                                                            {{ $tindakan->nama_tindakan }} - Rp {{ number_format($tindakan->tarif, 0, ',', '.') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="p-2 text-center">
                                                <button type="button" @click="removeActionRow(index)" class="text-slate-400 hover:text-red-500 transition p-1">
                                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                        
                        <div x-show="actionRows.length === 0" class="text-center py-4 text-xs text-slate-400 italic">
                            Belum ada tindakan yang ditambahkan.
                        </div>
                    </div>

                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-6 shadow-sm">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-500">pill</span> Resep Obat
                            </h3>
                            <button type="button" @click="addObatRow()" class="text-xs bg-emerald-100 text-emerald-700 px-3 py-1.5 rounded-lg font-bold hover:bg-emerald-200 transition">
                                + Tambah Obat
                            </button>
                        </div>

                        <div class="overflow-hidden border border-slate-200 dark:border-slate-700 rounded-lg">
                            <table class="w-full text-sm text-left">
                                <thead class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 font-bold uppercase text-xs">
                                    <tr>
                                        <th class="p-3">Nama Obat</th>
                                        <th class="p-3 w-24 text-center">Jumlah</th>
                                        <th class="p-3 w-1/3">Aturan Pakai</th>
                                        <th class="p-3 w-10"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                                    <template x-for="(row, index) in obatRows" :key="index">
                                        <tr class="bg-white dark:bg-slate-800">
                                            <td class="p-2">
                                                <select :name="'resep['+index+'][obat_id]'" x-model="row.obat_id" class="w-full rounded border-slate-300 dark:border-slate-600 dark:bg-slate-900 text-sm">
                                                    <option value="">-- Pilih Obat --</option>
                                                    @foreach($obats as $obat)
                                                        <option value="{{ $obat->id_obat }}">{{ $obat->nama_obat }} (Stok: {{ $obat->stok }})</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="p-2">
                                                <input type="number" :name="'resep['+index+'][jumlah]'" x-model="row.jumlah" class="w-full rounded border-slate-300 dark:border-slate-600 dark:bg-slate-900 text-sm text-center">
                                            </td>
                                            <td class="p-2">
                                                <input type="text" :name="'resep['+index+'][aturan_pakai]'" x-model="row.aturan_pakai" class="w-full rounded border-slate-300 dark:border-slate-600 dark:bg-slate-900 text-sm">
                                            </td>
                                            <td class="p-2 text-center">
                                                <button type="button" @click="removeObatRow(index)" class="text-slate-400 hover:text-red-500">
                                                    <span class="material-symbols-outlined">delete</span>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                        <a href="{{ route('rekam-medis.index') }}" class="px-6 py-2.5 rounded-lg border border-slate-300 text-slate-600 font-bold hover:bg-slate-50 transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg transition flex items-center gap-2">
                            <span class="material-symbols-outlined">save</span> Update Data
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <script>
        function medicalHandler() {
            return {
                actionRows: @json($rm->tindakans->map(fn($t) => ['tindakan_id' => (string) $t->id_tindakan])), 
                obatRows: @json($rm->obats->map(fn($o) => ['obat_id' => $o->id_obat, 'jumlah' => $o->pivot->jumlah, 'aturan_pakai' => $o->pivot->aturan_pakai])),
                
                init() {
                    // Jika kosong, inisialisasi array kosong
                    if (!this.actionRows) this.actionRows = [];
                    if (!this.obatRows) this.obatRows = [];
                },

                addActionRow() {
                    this.actionRows.push({ tindakan_id: '' });
                },
                removeActionRow(index) {
                    this.actionRows.splice(index, 1);
                },
                addObatRow() {
                    this.obatRows.push({ obat_id: '', jumlah: 1, aturan_pakai: '' });
                },
                removeObatRow(index) {
                    this.obatRows.splice(index, 1);
                }
            }
        }
    </script>
</x-app-layout>