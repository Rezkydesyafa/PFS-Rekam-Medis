<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Tagihan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('tagihan.store') }}">
                        @csrf

                        <!-- Pilih Rekam Medis -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Pilih Rekam Medis <span class="text-red-500">*</span>
                            </label>
                            <select name="rekam_medis_id" id="rekam_medis_id" 
                                    class="w-full rounded-md border-gray-300 @error('rekam_medis_id') border-red-500 @enderror"
                                    required>
                                <option value="">-- Pilih Rekam Medis --</option>
                                @foreach($rekamMedis as $rm)
                                    <option value="{{ $rm->id_rm }}" 
                                            data-dokter="{{ $rm->dokter->tarif }}"
                                            data-obat="0"
                                            data-tindakan="0">
                                        RM #{{ $rm->id_rekam_medis }} - {{ $rm->pasien->name }} ({{ $rm->pasien->no_rm }})
                                    </option>
                                @endforeach
                            </select>
                            @error('rekam_medis_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Biaya Dokter -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Biaya Dokter <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="biaya_dokter" id="biaya_dokter" 
                                   value="{{ old('biaya_dokter', 0) }}"
                                   class="w-full rounded-md border-gray-300 @error('biaya_dokter') border-red-500 @enderror"
                                   min="0" step="0.01" required readonly>
                            @error('biaya_dokter')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Biaya Obat -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Biaya Obat <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="biaya_obat" id="biaya_obat" 
                                   value="{{ old('biaya_obat', 0) }}"
                                   class="w-full rounded-md border-gray-300 @error('biaya_obat') border-red-500 @enderror"
                                   min="0" step="0.01" required>
                            @error('biaya_obat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Biaya Tindakan -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Biaya Tindakan <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="biaya_tindakan" id="biaya_tindakan" 
                                   value="{{ old('biaya_tindakan', 0) }}"
                                   class="w-full rounded-md border-gray-300 @error('biaya_tindakan') border-red-500 @enderror"
                                   min="0" step="0.01" required>
                            @error('biaya_tindakan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Total Bayar (Auto Calculate) -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Total Bayar
                            </label>
                            <div class="text-2xl font-bold text-blue-600" id="total_display">
                                Rp 0
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Status Pembayaran <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status" 
                                    class="w-full rounded-md border-gray-300 @error('status') border-red-500 @enderror"
                                    required>
                                <option value="Belum Lunas">Belum Lunas</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="mb-4" id="metode_pembayaran_container" style="display:none;">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Metode Pembayaran
                            </label>
                            <select name="metode_pembayaran" id="metode_pembayaran" 
                                    class="w-full rounded-md border-gray-300">
                                <option value="">-- Pilih Metode --</option>
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                                <option value="Debit">Debit</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('tagihan.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan Tagihan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Auto calculate total
        function calculateTotal() {
            const dokter = parseFloat(document.getElementById('biaya_dokter').value) || 0;
            const obat = parseFloat(document.getElementById('biaya_obat').value) || 0;
            const tindakan = parseFloat(document.getElementById('biaya_tindakan').value) || 0;
            
            const total = dokter + obat + tindakan;
            document.getElementById('total_display').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Load biaya dokter when rekam medis selected
        document.getElementById('rekam_medis_id').addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            document.getElementById('biaya_dokter').value = selected.dataset.dokter || 0;
            calculateTotal();
        });

        // Calculate on input change
        ['biaya_dokter', 'biaya_obat', 'biaya_tindakan'].forEach(id => {
            document.getElementById(id).addEventListener('input', calculateTotal);
        });

        // Show/hide metode pembayaran based on status
        document.getElementById('status').addEventListener('change', function() {
            const container = document.getElementById('metode_pembayaran_container');
            if (this.value === 'Lunas') {
                container.style.display = 'block';
                document.getElementById('metode_pembayaran').required = true;
            } else {
                container.style.display = 'none';
                document.getElementById('metode_pembayaran').required = false;
            }
        });
    </script>
    @endpush
</x-app-layout>
