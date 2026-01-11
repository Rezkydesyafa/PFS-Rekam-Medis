<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8" x-data="medicalHandler()">
        
        <div class="mb-6 flex flex-col md:flex-row justify-between md:items-center gap-4">
            <div>
                <nav class="flex text-sm text-slate-500 dark:text-slate-400 mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2">
                        <li><a href="{{ route('dashboard') }}" class="hover:text-primary transition-colors">Beranda</a></li>
                        <li><span class="mx-2">›</span></li>
                        <li><a href="{{ route('rekam-medis.index') }}" class="hover:text-primary transition-colors">Rekam Medis</a></li>
                        <li><span class="mx-2">›</span></li>
                        <li class="font-medium text-slate-900 dark:text-white">Buat Baru</li>
                    </ol>
                </nav>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Input Pemeriksaan</h1>
                <p class="text-slate-500 text-sm mt-1">Formulir pemeriksaan klinis dan resep obat.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="bg-blue-50 text-blue-700 px-4 py-2 rounded-lg border border-blue-100 font-mono text-sm font-bold">
                    NO. REG: {{ $newRegNumber ?? 'AUTO' }}
                </div>
            </div>
        </div>

        <form action="{{ route('rekam-medis.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-1 space-y-6">
                    
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-5 shadow-sm">
                        <h3 class="font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2 border-b border-slate-100 dark:border-slate-700 pb-3">
                            <span class="material-symbols-outlined text-primary">badge</span> Identitas
                        </h3>
                        
                        <div class="mb-4">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Tanggal Periksa</label>
                            <input type="date" name="tgl_kunjungan" value="{{ date('Y-m-d') }}" 
                                   class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-primary focus:border-primary">
                        </div>

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Dokter Pemeriksa</label>
                            <select name="dokter_id" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-primary focus:border-primary" required>
                                <option value="">Pilih Dokter...</option>
                                @foreach($dokters as $dokter)
                                    <option value="{{ $dokter->id_dokter }}">{{ $dokter->nama_dokter }} ({{ $dokter->spesialisasi }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Pasien</label>
                            <select name="pasien_id" x-model="selectedPasien" @change="fetchPatientDetails()" 
                                    class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-primary focus:border-primary" required>
                                <option value="">Cari Nama / No. RM...</option>
                                @foreach($pasiens as $pasien)
                                    <option value="{{ $pasien->id_pasien }}" 
                                        data-rm="{{ $pasien->no_rm }}"
                                        data-nik="{{ $pasien->nik }}"
                                        data-tgl="{{ $pasien->tgl_lahir }}">
                                        {{ $pasien->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="bg-slate-100 dark:bg-slate-900/50 p-3 rounded-lg border border-slate-200 dark:border-slate-700 text-xs space-y-2 text-slate-600 dark:text-slate-400" 
                             x-show="selectedPasien" x-transition>
                            <div class="flex justify-between">
                                <span class="font-semibold">No. RM:</span>
                                <span x-text="patientData.rm"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold">NIK:</span>
                                <span x-text="patientData.nik"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold">Tgl Lahir:</span>
                                <span x-text="patientData.tgl"></span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-5 shadow-sm">
                        <h3 class="font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2 border-b border-slate-100 dark:border-slate-700 pb-3">
                            <span class="material-symbols-outlined text-rose-500">vital_signs</span> Tanda Vital
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-slate-500 font-bold mb-1 block">Tensi (mmHg)</label>
                                <input type="text" name="tensi" placeholder="120/80" class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-sm">
                            </div>
                            <div>
                                <label class="text-xs text-slate-500 font-bold mb-1 block">Suhu (°C)</label>
                                <input type="number" step="0.1" name="suhu" placeholder="36.5" class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-sm">
                            </div>
                            <div>
                                <label class="text-xs text-slate-500 font-bold mb-1 block">Berat (Kg)</label>
                                <input type="number" name="berat_badan" placeholder="60" class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-sm">
                            </div>
                            <div>
                                <label class="text-xs text-slate-500 font-bold mb-1 block">Tinggi (cm)</label>
                                <input type="number" name="tinggi_badan" placeholder="170" class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-6 shadow-sm">
                        <h3 class="font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2 border-b border-slate-100 dark:border-slate-700 pb-3">
                            <span class="material-symbols-outlined text-amber-500">clinical_notes</span> Pemeriksaan Medis
                        </h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1">Keluhan Utama (Anamnesa) <span class="text-red-500">*</span></label>
                                <textarea name="keluhan" rows="2" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-primary focus:border-primary" placeholder="Jelaskan keluhan yang dirasakan pasien..." required></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1">Diagnosa Dokter <span class="text-red-500">*</span></label>
                                <textarea name="diagnosa" rows="2" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-primary focus:border-primary" placeholder="Kesimpulan medis / ICD-10..." required></textarea>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1">Catatan Tambahan (Opsional)</label>
                                <input type="text" name="catatan_tambahan" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm" placeholder="Contoh: Alergi obat, instruksi khusus...">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-6 shadow-sm">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-500">pill</span> Resep Obat
                            </h3>
                            <button type="button" @click="addObatRow()" class="text-xs bg-emerald-100 text-emerald-700 border border-emerald-200 px-3 py-1.5 rounded-lg font-bold hover:bg-emerald-200 transition flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">add</span> Tambah Obat
                            </button>
                        </div>

                        <div class="overflow-hidden border border-slate-200 dark:border-slate-700 rounded-lg">
                            <table class="w-full text-sm text-left">
                                <thead class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 font-bold uppercase text-xs">
                                    <tr>
                                        <th class="p-3">Nama Obat</th>
                                        <th class="p-3 w-24 text-center">Jumlah</th>
                                        <th class="p-3 w-1/3">Aturan Pakai</th>
                                        <th class="p-3 w-10 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                                    <template x-for="(row, index) in obatRows" :key="index">
                                        <tr class="bg-white dark:bg-slate-800">
                                            <td class="p-2">
                                                <select :name="'resep['+index+'][obat_id]'" class="w-full rounded border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white text-sm" required>
                                                    <option value="">-- Pilih Obat --</option>
                                                    @foreach($obats as $obat)
                                                        <option value="{{ $obat->id_obat }}">{{ $obat->nama_obat }} (Stok: {{ $obat->stok }})</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="p-2">
                                                <input type="number" :name="'resep['+index+'][jumlah]'" class="w-full rounded border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white text-sm text-center" value="1" min="1" required>
                                            </td>
                                            <td class="p-2">
                                                <input type="text" :name="'resep['+index+'][aturan_pakai]'" class="w-full rounded border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white text-sm" placeholder="Contoh: 3x1 Sesudah makan" required>
                                            </td>
                                            <td class="p-2 text-center">
                                                <button type="button" @click="removeObatRow(index)" class="text-slate-400 hover:text-red-500 transition p-1">
                                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                        
                        <div x-show="obatRows.length === 0" class="text-center py-4 text-xs text-slate-400 italic">
                            Belum ada obat yang ditambahkan.
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                        <a href="{{ route('rekam-medis.index') }}" class="px-6 py-2.5 rounded-lg border border-slate-300 dark:border-slate-600 text-slate-600 dark:text-slate-300 font-bold hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">save</span> Simpan Data
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <script>
        function medicalHandler() {
            return {
                selectedPasien: '',
                patientData: { rm: '-', nik: '-', tgl: '-' },
                obatRows: [{ obat_id: '', jumlah: 1, aturan_pakai: '' }], // Mulai dengan 1 baris kosong

                fetchPatientDetails() {
                    const select = document.querySelector('select[name="pasien_id"]');
                    const option = select.options[select.selectedIndex];
                    this.patientData = {
                        rm: option.getAttribute('data-rm') || '-',
                        nik: option.getAttribute('data-nik') || '-',
                        tgl: option.getAttribute('data-tgl') || '-'
                    };
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