<x-app-layout>
    <!-- Header -->
    <div class="mb-8 flex flex-col xl:flex-row xl:items-center justify-between gap-6">
        <div class="shrink-0">
            <h1 class="text-xl font-bold text-slate-900 tracking-tight">Dashboard Overview</h1>
            <p class="text-slate-500 text-sm">Sistem Informasi Rekam Medis (SIRM)</p>
        </div>

        <div class="flex-1 max-w-xl flex gap-3">
             <div class="relative flex-1 group">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-slate-400 text-[20px] group-focus-within:text-blue-600 transition-colors">search</span>
                </span>
                <input type="text" 
                       class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-1 focus:ring-blue-600 focus:border-blue-600 placeholder:text-slate-400 transition-all shadow-sm"
                       placeholder="Cari pasien berdasarkan nama, No. RM, atau NIK...">
            </div>
        </div>

        <div class="flex items-center gap-3 shrink-0">
             <div class="bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-lg text-sm font-semibold shadow-sm flex items-center gap-2 cursor-pointer hover:border-blue-400 transition-colors relative">
                <span class="material-symbols-outlined text-[18px] text-slate-500">calendar_today</span>
                <input type="text" id="dashboardCalendar" value="{{ $selectedDate->format('d M Y') }}" class="border-none p-0 text-sm font-semibold text-slate-700 focus:ring-0 w-24 cursor-pointer bg-transparent" readonly>
            </div>
             <button class="bg-blue-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors shadow-sm shadow-blue-600/20 flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">download</span>
                <span>Export Laporan</span>
            </button>
        </div>
    </div>

    <!-- Main Stats: Clean Enterprise Style -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
        
        <!-- Total Pasien -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:border-blue-200 transition-colors">
            <div class="flex justify-between items-start mb-4">
                <div>
                     <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wider">Total Pasien</p>
                     <h3 class="text-2xl font-extrabold text-slate-900 mt-1">{{ number_format($total_pasien) }}</h3>
                </div>
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center border border-blue-100">
                    <span class="material-symbols-outlined">group</span>
                </div>
            </div>
             <div class="flex items-center gap-2 text-xs">
                <span class="text-emerald-600 font-bold bg-emerald-50 px-1.5 py-0.5 rounded flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">trending_up</span> 12%
                </span>
                <span class="text-slate-400 font-medium">vs bulan lalu</span>
            </div>
        </div>

        <!-- Kunjungan -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:border-blue-200 transition-colors">
            <div class="flex justify-between items-start mb-4">
                <div>
                     <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wider">Kunjungan Hari Ini</p>
                     <h3 class="text-2xl font-extrabold text-slate-900 mt-1">{{ number_format($kunjungan_hari_ini) }}</h3>
                </div>
                 <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center border border-indigo-100">
                    <span class="material-symbols-outlined">stethoscope</span>
                </div>
            </div>
             <div class="flex items-center gap-2 text-xs">
                <span class="text-blue-600 font-bold bg-blue-50 px-1.5 py-0.5 rounded">
                    Update: 5m lalu
                </span>
            </div>
        </div>

        <!-- Rekam Medis -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:border-blue-200 transition-colors">
            <div class="flex justify-between items-start mb-4">
                <div>
                     <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wider">Data Rekam Medis</p>
                     <h3 class="text-2xl font-extrabold text-slate-900 mt-1">{{ number_format($total_rm) }}</h3>
                </div>
                 <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center border border-purple-100">
                    <span class="material-symbols-outlined">folder_shared</span>
                </div>
            </div>
             <div class="flex items-center gap-2 text-xs">
                <span class="text-slate-500 font-medium flex items-center gap-1">
                    <span class="bg-slate-100 text-slate-600 font-bold px-1.5 py-0.5 rounded">+24</span> dokumen baru
                </span>
            </div>
        </div>

        <!-- Tercetak -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:border-blue-200 transition-colors">
             <div class="flex justify-between items-start mb-4">
                <div>
                     <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wider">RM Tercetak</p>
                     <h3 class="text-2xl font-extrabold text-slate-900 mt-1">{{ number_format($rm_tercetak) }}</h3>
                </div>
                 <div class="w-10 h-10 bg-orange-50 text-orange-600 rounded-lg flex items-center justify-center border border-orange-100">
                    <span class="material-symbols-outlined">print</span>
                </div>
            </div>
             <div class="flex items-center gap-2 text-xs">
                <span class="text-slate-400 font-medium italic">Log aktivitas pencetakan</span>
            </div>
        </div>
    </div>

    <!-- Quick Access & Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Quick Access -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
             <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-blue-600">bolt</span> Quick Access
            </h3>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
                <a href="{{ route('pasien.create') }}" class="flex flex-col items-center justify-center p-4 rounded-lg bg-slate-50 border border-slate-100 hover:bg-blue-50 hover:border-blue-100 hover:text-blue-600 transition-all group">
                    <span class="material-symbols-outlined text-[28px] text-slate-400 mb-2 group-hover:text-blue-600 group-hover:scale-110 transition-all">person_add</span>
                    <span class="text-xs font-bold text-slate-600 group-hover:text-blue-600">Tambah Pasien</span>
                </a>
                 <a href="{{ route('rekam-medis.create') }}" class="flex flex-col items-center justify-center p-4 rounded-lg bg-slate-50 border border-slate-100 hover:bg-blue-50 hover:border-blue-100 hover:text-blue-600 transition-all group">
                    <span class="material-symbols-outlined text-[28px] text-slate-400 mb-2 group-hover:text-blue-600 group-hover:scale-110 transition-all">post_add</span>
                    <span class="text-xs font-bold text-slate-600 group-hover:text-blue-600">Rekam Medis</span>
                </a>
                 <a href="{{ route('dokter.index') }}" class="flex flex-col items-center justify-center p-4 rounded-lg bg-slate-50 border border-slate-100 hover:bg-blue-50 hover:border-blue-100 hover:text-blue-600 transition-all group">
                    <span class="material-symbols-outlined text-[28px] text-slate-400 mb-2 group-hover:text-blue-600 group-hover:scale-110 transition-all">calendar_month</span>
                    <span class="text-xs font-bold text-slate-600 group-hover:text-blue-600">Jadwal Dokter</span>
                </a>
                 <a href="{{ route('rekam-medis.index') }}" class="flex flex-col items-center justify-center p-4 rounded-lg bg-slate-50 border border-slate-100 hover:bg-blue-50 hover:border-blue-100 hover:text-blue-600 transition-all group">
                    <span class="material-symbols-outlined text-[28px] text-slate-400 mb-2 group-hover:text-blue-600 group-hover:scale-110 transition-all">print</span>
                    <span class="text-xs font-bold text-slate-600 group-hover:text-blue-600">Cetak RM</span>
                </a>
            </div>
        </div>

        <!-- Demografi Cards (Simplified Graphics) -->
        <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-center">
             <div class="flex items-center justify-between mb-4">
                 <h3 class="text-sm font-bold text-slate-900">Demografi Pasien</h3>
                 <span class="text-xs text-slate-500 font-medium">Berdasarkan Gender & Usia</span>
             </div>
             
             <div class="grid grid-cols-2 gap-8 items-center h-full">
                 <!-- Gender Distribution (Custom Bar) -->
                 <div class="space-y-4">
                     <div class="space-y-2">
                        <div class="flex justify-between text-xs font-bold text-slate-600">
                            <span class="flex items-center gap-1"><span class="w-2 h-2 bg-blue-500 rounded-full"></span> Laki-laki</span>
                            <span>45%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-blue-500 h-full rounded-full" style="width: 45%"></div>
                        </div>
                     </div>
                     <div class="space-y-2">
                        <div class="flex justify-between text-xs font-bold text-slate-600">
                            <span class="flex items-center gap-1"><span class="w-2 h-2 bg-pink-400 rounded-full"></span> Perempuan</span>
                            <span>55%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-pink-400 h-full rounded-full" style="width: 55%"></div>
                        </div>
                     </div>
                 </div>

                 <!-- Age Distribution (Donut) -->
                 <div class="flex items-center gap-6">
                     <!-- Donut placeholder, actual chart rendered via JS below -->
                     <div id="ageDonutChart" class="w-28 h-28"></div>
                     
                     <div class="text-xs font-medium text-slate-500 space-y-1.5">
                         <p class="flex items-center gap-2">
                             <span class="w-2 h-2 rounded-full bg-blue-600"></span> 
                             18-35 Th <span class="font-bold text-slate-800 ml-auto">{{ $age_stats['18_35'] }}%</span>
                         </p>
                         <p class="flex items-center gap-2">
                             <span class="w-2 h-2 rounded-full bg-indigo-500"></span> 
                             36-55 Th <span class="font-bold text-slate-800 ml-auto">{{ $age_stats['36_55'] }}%</span>
                         </p>
                         <p class="flex items-center gap-2">
                             <span class="w-2 h-2 rounded-full bg-emerald-400"></span> 
                             >55 Th <span class="font-bold text-slate-800 ml-auto">{{ $age_stats['gt_55'] }}%</span>
                         </p>
                     </div>
                 </div>
             </div>
        </div>
    </div>

    <!-- Charts & Tables Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pb-12">
        <!-- Visit Chart -->
        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm p-6 overflow-hidden relative">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-sm font-bold text-slate-900">Statistik Kunjungan</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Tren pasien mingguan</p>
                </div>
                 <!-- Toggle -->
                <div class="flex bg-slate-100 p-0.5 rounded-lg border border-slate-200" x-data="{ mode: 'weekly' }">
                    <button @click="mode = 'weekly'" class="px-3 py-1 text-[11px] font-bold rounded transition-all" :class="mode === 'weekly' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'">Minggu</button>
                    <button @click="mode = 'monthly'" class="px-3 py-1 text-[11px] font-bold rounded transition-all" :class="mode === 'monthly' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'">Bulan</button>
                </div>
            </div>
            <div id="visitChart" class="w-full h-[300px]"></div>
        </div>

        <!-- Recent Patients List -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col h-full">
            <div class="p-5 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-sm font-bold text-slate-900">Pasien Terbaru</h3>
                <a href="#" class="text-xs font-bold text-blue-600 hover:underline">Lihat Semua</a>
            </div>
            <div class="flex-1 overflow-y-auto max-h-[350px]">
                <table class="w-full text-left">
                    <tbody class="text-sm">
                        @forelse($latest_patients as $pasien)
                        <tr class="hover:bg-slate-50 transition-colors border-b border-slate-50 last:border-0 group">
                            <td class="p-4 pr-2">
                                <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-xs font-bold uppercase ring-2 ring-white">
                                    {{ substr($pasien->name, 0, 2) }}
                                </div>
                            </td>
                            <td class="py-4">
                                <p class="font-bold text-slate-900 text-xs text-ellipsis overflow-hidden whitespace-nowrap max-w-[120px] group-hover:text-blue-600 transition-colors">{{ $pasien->name }}</p>
                                <p class="text-[10px] text-slate-400">{{ $pasien->no_rm }}</p>
                            </td>
                            <td class="p-4 text-right">
                                <span class="bg-slate-100 text-slate-500 text-[10px] font-bold px-2 py-1 rounded border border-slate-200 uppercase">{{ $pasien->status ?? 'Active' }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="p-6 text-center text-slate-500 text-xs">Belum ada pasien terbaru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Plugins -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>

        flatpickr("#dashboardCalendar", {
            dateFormat: "d M Y",
            defaultDate: "{{ $selectedDate->format('d M Y') }}",
            disableMobile: "true",
            onChange: function(selectedDates, dateStr, instance) {
                // Konversi format ke Y-m-d untuk dikirim ke server/URL
                let dateObj = selectedDates[0];
                let year = dateObj.getFullYear();
                let month = String(dateObj.getMonth() + 1).padStart(2, '0');
                let day = String(dateObj.getDate()).padStart(2, '0');
                let isoDate = `${year}-${month}-${day}`;
                
                window.location.href = "{{ route('dashboard') }}?date=" + isoDate;
            }
        });
        // Visit Chart
        var options = {
            series: [{
                name: 'Kunjungan',
                data:  @json($chart_data)
            }],
            chart: {
                type: 'area',
                height: 300,
                toolbar: { show: false },
                fontFamily: 'Plus Jakarta Sans, sans-serif',
                animations: { enabled: true }
            },
            dataLabels: { enabled: false },
            stroke: {
                curve: 'smooth',
                width: 3,
                colors: ['#3b82f6'] // Blue-500
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.05,
                    stops: [0, 90, 100],
                    colorStops: [
                        { offset: 0, color: '#3b82f6', opacity: 0.15 },
                        { offset: 100, color: '#3b82f6', opacity: 0 }
                    ]
                }
            },
            grid: {
                show: true,
                borderColor: '#f1f5f9',
                strokeDashArray: 4,
                padding: { left: 10 }
            },
            xaxis: {
                categories: @json($categories),
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { colors: '#94a3b8', fontSize: '11px', fontFamily: 'Plus Jakarta Sans', fontWeight: 600} }
            },
            yaxis: { show: false },
            tooltip: {
                theme: 'light',
                style: { fontFamily: 'Plus Jakarta Sans', fontSize: '12px' },
                x: { show: false },
                marker: { show: false }
            },
            markers: { size: 0, hover: { size: 5, colors: ['#3b82f6'], strokeColors: '#fff', strokeWidth: 2 } }
        };

        var chart = new ApexCharts(document.querySelector("#visitChart"), options);
        chart.render();

        // Age Donut Chart
        var ageOptions = {
            series: @json($age_stats['counts']),
            labels: ['18-35 Th', '36-55 Th', '>55 Th'],
            chart: {
                type: 'donut',
                height: 120,
                fontFamily: 'Plus Jakarta Sans, sans-serif',
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: true,
                            name: { show: true, fontSize: '10px', color: '#64748b', offsetY: -2 },
                            value: { show: true, fontSize: '12px', fontWeight: 800, color: '#1e293b', offsetY: 2 },
                            total: {
                                show: true,
                                label: 'Usia',
                                color: '#64748b',
                                fontSize: '9px',
                                formatter: function (w) {
                                    return "Avg";
                                }
                            }
                        }
                    }
                }
            },
            dataLabels: { enabled: false },
            legend: { show: false },
            stroke: { show: false },
            colors: ['#2563eb', '#6366f1', '#34d399'], // blue-600, indigo-500, emerald-400
            tooltip: {
                enabled: true,
                theme: 'light',
                y: {
                    formatter: function(val) {
                        return val + " Pasien"
                    }
                }
            }
        };

        var ageChart = new ApexCharts(document.querySelector("#ageDonutChart"), ageOptions);
        ageChart.render();
    </script>
</x-app-layout>
