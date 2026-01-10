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
             <div class="bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-lg text-sm font-semibold shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px] text-slate-500">calendar_today</span>
                <span>{{ date('d M Y') }}</span>
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
                     <h3 class="text-2xl font-extrabold text-slate-900 mt-1">12,450</h3>
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
                     <h3 class="text-2xl font-extrabold text-slate-900 mt-1">142</h3>
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
                     <h3 class="text-2xl font-extrabold text-slate-900 mt-1">8,924</h3>
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
                     <h3 class="text-2xl font-extrabold text-slate-900 mt-1">1,205</h3>
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
                <button class="flex flex-col items-center justify-center p-4 rounded-lg bg-slate-50 border border-slate-100 hover:bg-blue-50 hover:border-blue-100 hover:text-blue-600 transition-all group">
                    <span class="material-symbols-outlined text-[28px] text-slate-400 mb-2 group-hover:text-blue-600 group-hover:scale-110 transition-all">person_add</span>
                    <span class="text-xs font-bold text-slate-600 group-hover:text-blue-600">Tambah Pasien</span>
                </button>
                 <button class="flex flex-col items-center justify-center p-4 rounded-lg bg-slate-50 border border-slate-100 hover:bg-blue-50 hover:border-blue-100 hover:text-blue-600 transition-all group">
                    <span class="material-symbols-outlined text-[28px] text-slate-400 mb-2 group-hover:text-blue-600 group-hover:scale-110 transition-all">post_add</span>
                    <span class="text-xs font-bold text-slate-600 group-hover:text-blue-600">Rekam Medis</span>
                </button>
                 <button class="flex flex-col items-center justify-center p-4 rounded-lg bg-slate-50 border border-slate-100 hover:bg-blue-50 hover:border-blue-100 hover:text-blue-600 transition-all group">
                    <span class="material-symbols-outlined text-[28px] text-slate-400 mb-2 group-hover:text-blue-600 group-hover:scale-110 transition-all">calendar_month</span>
                    <span class="text-xs font-bold text-slate-600 group-hover:text-blue-600">Jadwal Dokter</span>
                </button>
                 <button class="flex flex-col items-center justify-center p-4 rounded-lg bg-slate-50 border border-slate-100 hover:bg-blue-50 hover:border-blue-100 hover:text-blue-600 transition-all group">
                    <span class="material-symbols-outlined text-[28px] text-slate-400 mb-2 group-hover:text-blue-600 group-hover:scale-110 transition-all">print</span>
                    <span class="text-xs font-bold text-slate-600 group-hover:text-blue-600">Cetak RM</span>
                </button>
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
                     <div class="relative w-24 h-24 shrink-0">
                         <svg viewBox="0 0 36 36" class="w-full h-full transform -rotate-90">
                            <!-- Background -->
                            <path class="text-slate-100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4.5" />
                            
                            <!-- Segment 1: >55 (Emerald) 30% -->
                            <path class="text-emerald-400" stroke-dasharray="30, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4.5" />
                            
                            <!-- Segment 2: 36-55 (Indigo) 45% - Starts after 30% -->
                            <path class="text-indigo-500" stroke-dasharray="45, 100" stroke-dashoffset="-30" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4.5" />
                            
                            <!-- Segment 3: 18-35 (Blue) 25% - Starts after 75% -->
                            <path class="text-blue-600" stroke-dasharray="25, 100" stroke-dashoffset="-75" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4.5" />
                         </svg>
                         <div class="absolute inset-0 flex items-center justify-center flex-col">
                             <span class="text-xs font-bold text-slate-900">Usia</span>
                             <span class="text-[10px] text-slate-500">Rata2</span>
                         </div>
                     </div>
                     <div class="text-xs font-medium text-slate-500 space-y-1.5">
                         <p class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-blue-600"></span> 18-35 Th</p>
                         <p class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-indigo-500"></span> 36-55 Th</p>
                         <p class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-emerald-400"></span> >55 Th</p>
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
                        <!-- Item 1 -->
                        <tr class="hover:bg-slate-50 transition-colors border-b border-slate-50 last:border-0">
                            <td class="p-4 pr-2">
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold uppercase">AS</div>
                            </td>
                            <td class="py-4">
                                <p class="font-bold text-slate-900 text-xs text-ellipsis overflow-hidden whitespace-nowrap max-w-[120px]">Andi Saputra</p>
                                <p class="text-[10px] text-slate-400">#RM-00124</p>
                            </td>
                            <td class="p-4 text-right">
                                <span class="bg-green-50 text-green-600 text-[10px] font-bold px-2 py-1 rounded border border-green-100">Selesai</span>
                            </td>
                        </tr>
                        <!-- Item 2 -->
                         <tr class="hover:bg-slate-50 transition-colors border-b border-slate-50 last:border-0">
                            <td class="p-4 pr-2">
                                <div class="w-8 h-8 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-xs font-bold uppercase">MK</div>
                            </td>
                            <td class="py-4">
                                <p class="font-bold text-slate-900 text-xs text-ellipsis overflow-hidden whitespace-nowrap max-w-[120px]">Maya Kartika</p>
                                <p class="text-[10px] text-slate-400">#RM-00125</p>
                            </td>
                            <td class="p-4 text-right">
                                <span class="bg-blue-50 text-blue-600 text-[10px] font-bold px-2 py-1 rounded border border-blue-100">Periksa</span>
                            </td>
                        </tr>
                        <!-- Item 3 -->
                         <tr class="hover:bg-slate-50 transition-colors border-b border-slate-50 last:border-0">
                            <td class="p-4 pr-2">
                                <div class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xs font-bold uppercase">BP</div>
                            </td>
                            <td class="py-4">
                                <p class="font-bold text-slate-900 text-xs text-ellipsis overflow-hidden whitespace-nowrap max-w-[120px]">Bambang P.</p>
                                <p class="text-[10px] text-slate-400">#RM-00126</p>
                            </td>
                            <td class="p-4 text-right">
                                <span class="bg-slate-100 text-slate-500 text-[10px] font-bold px-2 py-1 rounded border border-slate-200">Menunggu</span>
                            </td>
                        </tr>
                         <!-- Item 4 -->
                         <tr class="hover:bg-slate-50 transition-colors border-b border-slate-50 last:border-0">
                            <td class="p-4 pr-2">
                                <div class="w-8 h-8 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center text-xs font-bold uppercase">SR</div>
                            </td>
                            <td class="py-4">
                                <p class="font-bold text-slate-900 text-xs text-ellipsis overflow-hidden whitespace-nowrap max-w-[120px]">Siti Rahayu</p>
                                <p class="text-[10px] text-slate-400">#RM-00127</p>
                            </td>
                            <td class="p-4 text-right">
                                <span class="bg-slate-100 text-slate-500 text-[10px] font-bold px-2 py-1 rounded border border-slate-200">Menunggu</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            series: [{
                name: 'Kunjungan',
                data: [42, 55, 48, 36, 45, 32, 28]
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
                categories: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
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
    </script>
</x-app-layout>
