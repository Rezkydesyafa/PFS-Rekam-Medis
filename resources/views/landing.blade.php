<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis Kita - Solusi Kesehatan Digital</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-mesh {
            background-color: #ffffff;
            background-image: radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%), radial-gradient(at 100% 0%, hsla(339,49%,30%,1) 0, transparent 50%);
        }
        .blob {
            position: absolute;
            filter: blur(40px);
            z-index: -1;
            opacity: 0.4;
            animation: move 10s infinite alternate;
        }
        @keyframes move {
            from { transform: translate(0, 0) scale(1); }
            to { transform: translate(20px, -20px) scale(1.1); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-600 bg-white selection:bg-blue-100 selection:text-blue-700">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-xl border-b border-white/20 transition-all duration-300 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2 cursor-pointer hover:opacity-80 transition-opacity">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-xl shadow-lg shadow-blue-600/20 flex items-center justify-center">
                         <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                        </svg>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-slate-900">SehatSentosa</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="#" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:text-blue-600 rounded-full hover:bg-blue-50 transition-all">Beranda</a>
                    <a href="#" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:text-blue-600 rounded-full hover:bg-blue-50 transition-all">Layanan</a>
                    <a href="#" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:text-blue-600 rounded-full hover:bg-blue-50 transition-all">Kontak</a>
                </div>

                <!-- CTA Button -->
                <div class="hidden md:flex">
                    <a href="#" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-full font-bold shadow-lg shadow-blue-500/30 transition-all hover:shadow-blue-600/40 hover:-translate-y-0.5 text-sm">
                        Masuk / Daftar
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button class="text-slate-600 hover:text-blue-600 focus:outline-none p-2 bg-slate-50 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-gradient-to-b from-blue-50/50 to-white">
        <!-- Background Shapes -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[500px] h-[500px] bg-gradient-to-br from-blue-200/40 to-cyan-200/40 rounded-full blur-3xl opacity-50 blob"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-[600px] h-[600px] bg-gradient-to-tr from-purple-200/40 to-pink-200/40 rounded-full blur-3xl opacity-50 blob animation-delay-2000"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <!-- Text Content -->
                <div class="lg:w-1/2 text-center lg:text-left space-y-8">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 border border-blue-100 rounded-full text-blue-700 text-sm font-semibold mb-4 mx-auto lg:mx-0">
                        <span class="flex h-2 w-2 relative">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                        </span>
                        Solusi Kesehatan Masa Depan
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-extrabold text-slate-900 leading-[1.1] tracking-tight">
                        Sehat Lebih Mudah, <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Hidup Lebih Baik.</span>
                    </h1>
                    <p class="text-lg lg:text-xl text-slate-500 leading-relaxed max-w-2xl mx-auto lg:mx-0 font-medium">
                        Platform rekam medis terintegrasi yang menghubungkan pasien, dokter, dan farmasi dalam satu ekosistem digital yang aman.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-4">
                        <a href="#" class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-bold shadow-xl shadow-blue-600/20 transition-all hover:shadow-blue-600/40 hover:-translate-y-1 flex items-center justify-center gap-2 group">
                            Mulai Konsultasi
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                        <a href="#" class="bg-white text-slate-700 border border-slate-200 px-8 py-4 rounded-2xl font-bold transition-all hover:bg-slate-50 hover:border-slate-300 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Demo Aplikasi
                        </a>
                    </div>
                    
                    <div class="pt-8 flex items-center justify-center lg:justify-start gap-6 text-sm text-slate-400 font-medium">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Terverifikasi Kemenkes
                        </div>
                         <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            Data Terenkripsi
                        </div>
                    </div>
                </div>

                <!-- Visual -->
                <div class="lg:w-1/2 relative lg:translate-x-10">
                    <div class="relative bg-white rounded-[2rem] shadow-2xl shadow-slate-200/50 p-3 border border-slate-100 rotate-1 hover:rotate-0 transition-all duration-500">
                         <div class="rounded-[1.5rem] overflow-hidden bg-slate-50 h-[400px] lg:h-[500px] relative">
                             <!-- Dashboard Mockup Abstract -->
                             <div class="absolute top-0 left-0 w-full h-full bg-slate-50 p-6 flex flex-col gap-6">
                                 <!-- Header Mock -->
                                 <div class="flex justify-between items-center bg-white p-4 rounded-xl shadow-sm border border-slate-100/50">
                                     <div class="h-8 w-24 bg-slate-100 rounded-lg"></div>
                                     <div class="h-10 w-10 bg-blue-100 rounded-full"></div>
                                 </div>
                                 <!-- Content Grid Mock -->
                                 <div class="grid grid-cols-2 gap-6 h-full">
                                     <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100/50 col-span-2 lg:col-span-1 space-y-4">
                                         <div class="h-10 w-10 bg-blue-50 rounded-xl text-blue-600 flex items-center justify-center">
                                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                         </div>
                                         <div class="h-4 w-20 bg-slate-100 rounded"></div>
                                         <div class="h-8 w-32 bg-slate-800 rounded"></div>
                                     </div>
                                     <div class="bg-gradient-to-br from-blue-600 to-indigo-600 p-6 rounded-2xl shadow-lg shadow-blue-500/20 text-white col-span-2 lg:col-span-1 space-y-2">
                                         <div class="h-4 w-20 bg-white/20 rounded"></div>
                                         <div class="h-8 w-16 bg-white rounded"></div>
                                         <div class="pt-4 flex gap-2">
                                             <div class="h-8 w-full bg-white/20 rounded-lg"></div>
                                         </div>
                                     </div>
                                      <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100/50 col-span-2 space-y-4">
                                          <div class="flex gap-4 mb-4">
                                              <div class="h-10 w-24 bg-blue-50 rounded-lg"></div>
                                              <div class="h-10 w-24 bg-white border border-slate-200 rounded-lg"></div>
                                          </div>
                                         <div class="space-y-3">
                                             <div class="h-12 w-full bg-slate-50 rounded-xl flex items-center px-4 gap-4">
                                                 <div class="h-6 w-6 bg-slate-200 rounded-full"></div>
                                                 <div class="h-3 w-32 bg-slate-200 rounded"></div>
                                             </div>
                                              <div class="h-12 w-full bg-slate-50 rounded-xl flex items-center px-4 gap-4">
                                                 <div class="h-6 w-6 bg-slate-200 rounded-full"></div>
                                                 <div class="h-3 w-40 bg-slate-200 rounded"></div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20  mb-24">
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 p-8 lg:p-12 border border-slate-100 flex flex-col md:flex-row justify-between items-center gap-8 divide-y md:divide-y-0 md:divide-x divide-slate-100">
             <div class="flex-1 text-center group cursor-default">
                 <p class="text-4xl lg:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 mb-2 group-hover:scale-110 transition-transform">24/7</p>
                 <p class="text-slate-500 font-medium">Layanan Siaga</p>
             </div>
             <div class="flex-1 text-center group cursor-default pt-8 md:pt-0">
                 <p class="text-4xl lg:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 mb-2 group-hover:scale-110 transition-transform">50+</p>
                 <p class="text-slate-500 font-medium">Dokter Spesialis</p>
             </div>
             <div class="flex-1 text-center group cursor-default pt-8 md:pt-0">
                 <p class="text-4xl lg:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 mb-2 group-hover:scale-110 transition-transform">100%</p>
                 <p class="text-slate-500 font-medium">Aman & Terpercaya</p>
             </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-32 relative overflow-hidden -mt-16 z-10">
        <!-- Curved Background with Gradient -->
        <div class="absolute inset-x-0 h-full bg-slate-100 rounded-t-[50%_100px] md:rounded-t-[50%_150px] z-0"></div>
        

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 pt-16">
            <div class="text-center max-w-3xl mx-auto mb-20 animate-fade-in-up" style="animation-delay: 0.1s;">
                <span class="inline-block px-4 py-1.5 rounded-full bg-white border border-blue-100 text-blue-600 font-bold tracking-wide uppercase text-xs shadow-sm mb-6">Kenapa Memilih Kami</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-6">
                    Teknologi Kesehatan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Tanpa Batas</span>
                </h2>
                <p class="text-lg text-slate-600 leading-relaxed font-medium max-w-2xl mx-auto">
                    Kami menggabungkan kenyamanan dan teknologi untuk memberikan pengalaman berobat yang belum pernah Anda rasakan sebelumnya.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 lg:gap-10">
                <!-- Card 1 -->
                <div class="group bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-500 hover:-translate-y-2 border border-slate-100 relative overflow-hidden animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-blue-50 to-transparent rounded-bl-[2.5rem] -mr-8 -mt-8 transition-transform group-hover:scale-150 duration-500"></div>
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-8 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 relative z-10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-blue-600 transition-colors">Antrian Cerdas</h3>
                    <p class="text-slate-500 leading-relaxed group-hover:text-slate-600">Sistem antrian real-time yang memungkinkan Anda datang tepat waktu. Ucapkan selamat tinggal pada ruang tunggu yang sesak.</p>
                </div>

                <!-- Card 2 -->
                <div class="group bg-blue-600 p-10 rounded-[2.5rem] shadow-xl shadow-blue-600/30 hover:shadow-2xl hover:shadow-blue-600/40 transition-all duration-500 hover:-translate-y-2 border border-blue-500 relative overflow-hidden animate-fade-in-up" style="animation-delay: 0.3s;">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 opacity-100 transition-opacity"></div>
                    <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all duration-500"></div>
                    
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-white mb-8 border border-white/20 relative z-10 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 relative z-10">Rekam Medis Satu Pintu</h3>
                    <p class="text-blue-100 leading-relaxed relative z-10">Semua riwayat kesehatan Anda tersimpan aman dengan enkripsi tingkat tinggi. Akses kapan saja saat dibutuhkan.</p>
                </div>

                <!-- Card 3 -->
                <div class="group bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-500 hover:-translate-y-2 border border-slate-100 relative overflow-hidden animate-fade-in-up" style="animation-delay: 0.4s;">
                     <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-blue-50 to-transparent rounded-bl-[2.5rem] -mr-8 -mt-8 transition-transform group-hover:scale-150 duration-500"></div>
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-8 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 relative z-10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-blue-600 transition-colors">Farmasi Kilat</h3>
                    <p class="text-slate-500 leading-relaxed group-hover:text-slate-600">Integrasi langsung dengan apotek. Resep dikirim otomatis, Anda tinggal menunggu obat siap diambil atau diantar.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Modern Blue -->
    <footer class="bg-[#2D8CEA] text-white pt-20 pb-10 relative overflow-hidden">
        <!-- Background Shapes (Abstract Blobs) -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-white/10 rounded-full blur-3xl pointer-events-none z-0"></div>
        <div class="absolute -bottom-32 -right-32 w-[600px] h-[600px] bg-white/5 rounded-full blur-3xl pointer-events-none z-0"></div>
        <div class="absolute bottom-10 right-10 w-48 h-48 bg-white/10 rounded-full blur-2xl pointer-events-none z-0 opacity-50"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                 <!-- Brand Section -->
                 <div class="space-y-6 animate-fade-in-up" style="animation-delay: 0.1s;">
                     <div class="flex items-center gap-2">
                        <span class="font-bold text-3xl tracking-tight">SehatSentosa</span>
                        <div class="w-2 h-2 bg-white rounded-full mt-2"></div>
                    </div>
                    <p class="text-blue-50 leading-relaxed text-sm max-w-sm">
                        SehatSentosa dikembangkan untuk dapat mempermudah proses layanan kesehatan pada Klinik dan Rumah Sakit.
                    </p>
                 </div>
                 
                 <!-- Menu Section -->
                 <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
                     <h4 class="font-bold text-lg mb-6">Menu</h4>
                     <ul class="space-y-4 text-blue-50 text-sm">
                         <li><a href="#" class="hover:text-white hover:underline transition-all">Beranda</a></li>
                         <li><a href="#" class="hover:text-white hover:underline transition-all">Layanan</a></li>
                         <li><a href="#" class="hover:text-white hover:underline transition-all">Kontak</a></li>
                     </ul>
                 </div>

                 <!-- Best Services Section -->
                 <div class="animate-fade-in-up" style="animation-delay: 0.3s;">
                     <h4 class="font-bold text-lg mb-6">Best Services</h4>
                     <ul class="space-y-4 text-blue-50 text-sm">
                         <li><a href="#" class="hover:text-white hover:underline transition-all">Sistem Antrian Terintegrasi</a></li>
                         <li><a href="#" class="hover:text-white hover:underline transition-all">Rekam Medis Elektronik</a></li>
                         <li><a href="#" class="hover:text-white hover:underline transition-all">Unlimited Support</a></li>
                         <li><a href="#" class="hover:text-white hover:underline transition-all">Integrasi BPJS</a></li>
                         <li><a href="#" class="hover:text-white hover:underline transition-all">Manajemen Obat</a></li>
                     </ul>
                 </div>

                 <!-- Contact Us Section -->
                 <div class="animate-fade-in-up" style="animation-delay: 0.4s;">
                     <h4 class="font-bold text-lg mb-6">Contact Us</h4>
                     <ul class="space-y-6 text-blue-50 text-sm">
                         <li class="flex items-start gap-3">
                             <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                             <span>Jl. Jendral Sudirman No. 123, Jakarta Selatan, DKI Jakarta 12190</span>
                         </li>
                         <li class="flex items-center gap-3">
                             <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                             <span>info@sehatsentosa.com</span>
                         </li>
                         <li class="flex items-center gap-3">
                             <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56-.35-.12-.74-.03-1.01.24l-1.57 1.97c-2.83-1.43-5.15-3.75-6.57-6.57l1.97-1.57c.27-.27.35-.66.24-1.01-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.75c0 9.39 7.61 17.01 17.01 17.01.51 0 .75-.65.75-1.19v-3.2c0-.54-.45-.99-.99-.99z"/></svg>
                             <span>021-1234-5678</span>
                         </li>
                     </ul>
                 </div>
            </div>

            <div class="border-t border-white/20 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-blue-100">
                <p>&copy; Copyright 2025 SehatSentosa. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="bg-white/10 p-2 rounded-full hover:bg-white/20 transition-all">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="bg-white/10 p-2 rounded-full hover:bg-white/20 transition-all">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="#" class="bg-white/10 p-2 rounded-full hover:bg-white/20 transition-all">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll Top Button -->
        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="fixed bottom-8 left-8 p-3 bg-blue-500 text-white rounded-lg shadow-lg hover:bg-blue-600 transition-all z-40 hidden md:block">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
        </button>

        <!-- WhatsApp Floating Button -->
        <a href="https://wa.me/" target="_blank" class="fixed bottom-8 right-8 z-50 animate-bounce hover:animate-none">
             <div class="w-14 h-14 bg-[#25D366] rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform">
                 <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.198-.198.346-.769.967-.943 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
             </div>
        </a>
    </footer>

</body>
</html>
