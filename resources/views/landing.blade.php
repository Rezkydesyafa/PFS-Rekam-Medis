<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRM - Solusi Rekam Medis Digital</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes move {
            from { transform: translate(0, 0) scale(1); }
            to { transform: translate(20px, -20px) scale(1.1); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        .animate-bounce-slow {
            animation: float 4s ease-in-out infinite reverse;
        }
        .dashed-line {
            background-image: linear-gradient(to right, #bfdbfe 50%, rgba(255,255,255,0) 0%);
            background-position: bottom;
            background-size: 20px 2px;
            background-repeat: repeat-x;
            height: 2px;
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-600 bg-white">

    <!-- Header / Navbar -->
    <header class="fixed w-full z-50 bg-white/90 backdrop-blur-md transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                        <span class="material-symbols-outlined text-[20px]">folder_shared</span>
                    </div>
                    <span class="font-extrabold text-xl text-slate-900 tracking-tight">SIRM</span>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="#" class="text-sm font-semibold text-slate-900 hover:text-blue-600 transition-colors">Beranda</a>
                    <a href="#" class="text-sm font-medium text-slate-500 hover:text-blue-600 transition-colors">Fitur</a>
                    <a href="#" class="text-sm font-medium text-slate-500 hover:text-blue-600 transition-colors">Tentang Kami</a>
                    <a href="#" class="text-sm font-medium text-slate-500 hover:text-blue-600 transition-colors">Kontak</a>
                </nav>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center gap-4">
                    <a href="/login" class="text-sm font-semibold text-blue-600 hover:text-blue-700">Masuk</a>
                    <a href="/register" class="bg-blue-600 text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20">
                        Daftar Akun
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 text-slate-600">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden relative bg-white">
        <!-- Background Decor -->
        <div class="absolute right-0 top-0 w-1/2 h-full bg-blue-50/30 rounded-bl-[10rem] -z-10 hidden lg:block"></div>
        <div class="absolute bottom-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-blue-200 to-transparent dashed-line"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <!-- Text Content -->
                <div class="lg:w-1/2 space-y-8 relative z-10">
                    <h1 class="text-5xl lg:text-[4rem] font-bold text-slate-900 leading-[1.1] tracking-tight">
                        Mitra Terpercaya Anda dalam <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">Layanan Kesehatan Digital</span>.
                    </h1>
                    <p class="text-lg text-slate-500 leading-relaxed max-w-xl">
                        <span class="font-bold text-blue-600">Meningkatkan Kualitas Layanan Kesehatan.</span> Nikmati kemudahan pengelolaan data medis yang aman dan terintegrasi. Hubungkan dokter, pasien, dan farmasi dalam satu platform cerdas.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 pt-2">
                        <a href="/register" class="bg-gradient-to-r from-blue-400 to-blue-600 text-white px-8 py-4 rounded-xl font-bold hover:shadow-lg hover:shadow-blue-500/30 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2 text-lg">
                            Buat Janji Temu
                            <span class="material-symbols-outlined font-bold">arrow_forward_ios</span>
                        </a>
                    </div>

                    <!-- Trusted By -->
                    <div class="pt-8 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
                        <p class="text-sm text-slate-400 mb-4 font-medium">Dipercaya oleh fasilitas kesehatan terkemuka:</p>
                        <div class="flex items-center gap-8">
                            <span class="material-symbols-outlined text-[32px]">cruelty_free</span> <!-- Placeholder for Amazon -->
                            <span class="material-symbols-outlined text-[32px]">nutrition</span> <!-- Placeholder for Apple -->
                            <span class="material-symbols-outlined text-[32px]">water_drop</span> <!-- Placeholder for Google -->
                            <span class="material-symbols-outlined text-[32px]">spa</span> <!-- Placeholder for Notion -->
                            <span class="material-symbols-outlined text-[32px]">psychology</span> <!-- Placeholder for Spotify -->
                        </div>
                    </div>
                </div>

                <!-- Visual Content -->
                <div class="lg:w-1/2 relative flex justify-center lg:justify-end">
                    <!-- Main Blob/Circle Background -->
                    <div class="relative w-[400px] h-[400px] lg:w-[500px] lg:h-[500px]">
                        <div class="absolute inset-0 bg-blue-400 rounded-full opacity-100 transform translate-x-4"></div>
                        <img src="{{ asset('hero-photos.png') }}" alt="Doctor" class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[110%] max-w-none z-10 drop-shadow-2xl">
                        
                        <!-- Floating Card: Happy Customers -->
                        <div class="absolute top-20 -right-8 lg:-right-16 bg-white p-4 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] z-20 animate-bounce-slow">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="flex -space-x-2">
                                    <div class="w-8 h-8 rounded-full bg-slate-200 border-2 border-white bg-cover bg-center" style="background-image: url('https://i.pravatar.cc/100?img=1')"></div>
                                    <div class="w-8 h-8 rounded-full bg-slate-200 border-2 border-white bg-cover bg-center" style="background-image: url('https://i.pravatar.cc/100?img=5')"></div>
                                    <div class="w-8 h-8 rounded-full bg-slate-200 border-2 border-white bg-cover bg-center" style="background-image: url('https://i.pravatar.cc/100?img=8')"></div>
                                    <div class="w-8 h-8 rounded-full bg-slate-900 text-white text-[10px] flex items-center justify-center border-2 border-white font-bold">2400+</div>
                                </div>
                            </div>
                            <p class="text-blue-500 font-bold text-sm mb-1">Happy Customers</p>
                            <div class="flex text-yellow-400 text-[14px]">
                                <span class="material-symbols-outlined fill-1">star</span>
                                <span class="material-symbols-outlined fill-1">star</span>
                                <span class="material-symbols-outlined fill-1">star</span>
                                <span class="material-symbols-outlined fill-1">star</span>
                                <span class="material-symbols-outlined fill-1 text-slate-200">star</span>
                                <span class="text-slate-400 text-xs ml-1 font-medium text-black">(4.7 Stars)</span>
                            </div>
                        </div>

                        <!-- Floating Card: Easy Appointment -->
                        <div class="absolute bottom-32 -left-12 bg-white px-4 py-3 rounded-xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] z-20 flex items-center gap-3 animate-float">
                            <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600">
                                <span class="material-symbols-outlined text-[20px] fill-1">star</span>
                            </div>
                            <span class="font-bold text-slate-700 text-sm">Easy Appointment Booking</span>
                        </div>

                        <!-- Floating Card: Quote -->
                        <div class="absolute -bottom-8 right-0 lg:right-12 bg-white p-5 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.05)] z-20 max-w-[200px] border border-blue-50">
                            <div class="absolute -top-3 -left-3 bg-blue-500 rounded-lg p-1">
                                <span class="material-symbols-outlined text-white text-[20px]">format_quote</span>
                            </div>
                            <p class="text-xs text-slate-500 italic mt-2">
                                "Lorem ipsum dolor sit amet, ligula ego. consectetuer adipiscing elit."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  

    <!-- Services Section -->
    <section class="py-24 relative overflow-hidden">
        <!-- Decoration Wave Top Left -->
        <div class="absolute top-[100px] left-0 pointer-events-none opacity-40">
            <svg width="150" height="150" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 20 C 20 20, 20 40, 40 40 C 60 40, 60 20, 80 20" stroke="#3B82F6" stroke-width="2" fill="none"/>
                <path d="M0 40 C 20 40, 20 60, 40 60 C 60 60, 60 40, 80 40" stroke="#3B82F6" stroke-width="2" fill="none"/>
                <path d="M0 60 C 20 60, 20 80, 40 80 C 60 80, 60 60, 80 60" stroke="#3B82F6" stroke-width="2" fill="none"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-5xl font-bold text-slate-900 mb-6">
                    Top <span class="text-blue-500">services</span> we offer
                </h2>
                <p class="text-slate-500 max-w-2xl mx-auto leading-relaxed text-lg">
                    Di era digital yang serba cepat ini, kesehatan Anda layak mendapatkan perhatian maksimal. SIRM menawarkan rangkaian layanan terintegrasi yang dirancang untuk memenuhi kebutuhan medis Anda secara digital.
                </p>
            </div>

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-8">
                
                <!-- Card 1 (Large - Spans 3 cols) -->
                <div class="lg:col-span-3 p-8 lg:p-10 rounded-[2.5rem] bg-white border border-blue-100 shadow-xl shadow-blue-100/20 hover:shadow-2xl hover:shadow-blue-200/40 transition-all duration-300 hover:-translate-y-1 group">
                    <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform">
                         <span class="material-symbols-outlined text-[30px]">folder_shared</span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-blue-600 transition-colors">Manajemen Rekam Medis</h3>
                    <p class="text-slate-500 leading-relaxed mb-6">
                        Catat dan pantau seluruh riwayat kesehatan pasien secara digital dengan enkripsi tingkat tinggi. Akses data medis kapan saja dengan aman dan terorganisir.
                    </p>
                </div>

                <!-- Card 2 (Large - Spans 3 cols) -->
                <div class="lg:col-span-3 p-8 lg:p-10 rounded-[2.5rem] bg-white border border-blue-100 shadow-xl shadow-blue-100/20 hover:shadow-2xl hover:shadow-blue-200/40 transition-all duration-300 hover:-translate-y-1 group">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 mb-6 group-hover:scale-110 transition-transform">
                         <span class="material-symbols-outlined text-[30px]">calendar_month</span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-blue-600 transition-colors">Pendaftaran & Antrian</h3>
                    <p class="text-slate-500 leading-relaxed mb-6">
                        Sistem pendaftaran pasien online yang efisien. Kurangi waktu tunggu di fasilitas kesehatan dengan sistem antrian digital yang real-time.
                    </p>
                </div>

                <!-- Card 3 (Small - Spans 2 cols) -->
                <div class="lg:col-span-2 p-8 rounded-[2.5rem] bg-white border border-blue-100 shadow-lg shadow-blue-100/20 hover:shadow-xl hover:shadow-blue-200/30 transition-all duration-300 hover:-translate-y-1 group">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 mb-6 group-hover:rotate-12 transition-transform">
                         <span class="material-symbols-outlined text-[24px]">prescriptions</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-blue-600">E-Resep Digital</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Terima dan perbarui resep obat secara digital setelah konsultasi. Langsung terhubung ke apotek.
                    </p>
                </div>

                <!-- Card 4 (Small - Spans 2 cols) -->
                <div class="lg:col-span-2 p-8 rounded-[2.5rem] bg-white border border-blue-100 shadow-lg shadow-blue-100/20 hover:shadow-xl hover:shadow-blue-200/30 transition-all duration-300 hover:-translate-y-1 group">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 mb-6 group-hover:rotate-12 transition-transform">
                         <span class="material-symbols-outlined text-[24px]">clinical_notes</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-blue-600">Catatan Medis</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Dokumentasi lengkap catatan medis, diagnosa, dan tindakan dokter dalam satu klik tanpa kertas.
                    </p>
                </div>

                <!-- Card 5 (Small - Spans 2 cols) -->
                <div class="lg:col-span-2 p-8 rounded-[2.5rem] bg-white border border-blue-100 shadow-lg shadow-blue-100/20 hover:shadow-xl hover:shadow-blue-200/30 transition-all duration-300 hover:-translate-y-1 group">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white mb-6 group-hover:rotate-12 transition-transform">
                         <span class="material-symbols-outlined text-[24px]">medication</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-blue-600">Inventaris Obat</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Pantau stok obat secara real-time. Hindari kehabisan stok dan kelola kadaluarsa obat dengan mudah.
                    </p>
                </div>

            </div>
            
            <!-- Decoration Wave Bottom Right -->
             <div class="absolute -bottom-10 -right-10 pointer-events-none opacity-40">
                <svg width="200" height="100" viewBox="0 0 200 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 20 Q 25 40 50 20 T 100 20 T 150 20 T 200 20" stroke="#3B82F6" stroke-width="2" fill="none"/>
                     <path d="M0 40 Q 25 60 50 40 T 100 40 T 150 40 T 200 40" stroke="#3B82F6" stroke-width="2" fill="none"/>
                      <path d="M0 60 Q 25 80 50 60 T 100 60 T 150 60 T 200 60" stroke="#3B82F6" stroke-width="2" fill="none"/>
                </svg>
            </div>
        </div>
    </section>

    <!-- Story / About Section -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-[3rem] p-8 lg:p-16 border border-blue-100 shadow-2xl shadow-blue-100/50">
                <div class="text-center mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold text-slate-900">
                        <span class="text-blue-500">Tentang SIRM:</span> Mengenal Lebih Dekat
                    </h2>
                </div>

                <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">
                     <div class="lg:w-1/2">
                        <div class="relative group">
                            <div class="absolute inset-0 bg-blue-600 rounded-[2rem] rotate-3 opacity-20 group-hover:rotate-6 transition-transform duration-300"></div>
                            <img src="https://img.freepik.com/free-photo/medical-banner-with-doctor-working-laptop_23-2149611211.jpg" alt="Tim Medis SIRM" class="relative rounded-[2rem] shadow-lg w-full object-cover h-[400px] group-hover:-translate-y-2 transition-transform duration-300" onerror="this.src='https://placehold.co/600x400/png?text=Tentang+Kami'">
                        </div>
                    </div>
                    <div class="lg:w-1/2">
                        <p class="text-slate-500 leading-relaxed mb-6 text-lg">
                            SIRM adalah lebih dari sekadar sistem pencatatan; ini adalah revolusi dalam pelayanan kesehatan. Didirikan dengan visi untuk memangkas birokrasi dan meningkatkan fokus tenaga medis kepada pasien.
                        </p>
                        <p class="text-slate-500 leading-relaxed mb-8 text-lg">
                            Platform kami dibangun di atas pilar keamanan, efisiensi, dan kemudahan penggunaan. Kami menghubungkan setiap titik layanan dalam fasilitas kesehatan Anda menjadi satu kesatuan ekosistem digital yang harmonis.
                        </p>
                        <a href="#" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-8 py-4 rounded-xl font-bold transition-all shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 transform hover:-translate-y-1">
                            Pelajari Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact / Help Desk Section -->
    <section class="py-24 relative overflow-hidden bg-white">
        <!-- Decoration: Dashed Line Path -->
        <div class="absolute inset-0 pointer-events-none">
             <svg class="w-full h-full" viewBox="0 0 1440 400" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M-100 350 C 200 350, 400 100, 720 100 C 1040 100, 1240 350, 1540 350" stroke="#BFDBFE" stroke-width="2" stroke-dasharray="12 12" fill="none"/>
            </svg>
        </div>

        <!-- Decoration: Wavy Lines (Left) -->
        <div class="absolute top-20 left-10 opacity-60 hidden lg:block">
            <svg width="100" height="50" viewBox="0 0 100 50" fill="none">
                 <path d="M0 10 Q 25 30 50 10 T 100 10" stroke="#3B82F6" stroke-width="2" fill="none"/>
                 <path d="M0 25 Q 25 45 50 25 T 100 25" stroke="#3B82F6" stroke-width="2" fill="none"/>
                 <path d="M0 40 Q 25 60 50 40 T 100 40" stroke="#3B82F6" stroke-width="2" fill="none"/>
            </svg>
        </div>

        <!-- Decoration: Dot Grid (Right) -->
        <div class="absolute top-20 right-10 opacity-30 hidden lg:block text-blue-400">
             <svg width="100" height="100" viewBox="0 0 100 100" fill="currentColor">
                <pattern id="dots" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="2" cy="2" r="2" />
                </pattern>
                <rect width="100" height="100" fill="url(#dots)" />
            </svg>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl lg:text-5xl font-bold text-slate-900 mb-4">
                Hubungi <span class="text-blue-500">Help Desk</span> Kami
            </h2>
            <p class="text-slate-500 mb-12">
                Punya pertanyaan? Butuh bantuan? Tim support kami siap membantu setiap langkah Anda.
            </p>

            <form class="flex flex-col md:flex-row gap-4 justify-center">
                <!-- Name Input -->
                <div class="relative w-full md:w-64 group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-blue-500 group-focus-within:text-blue-600 transition-colors">person</span>
                    <input type="text" placeholder="Nama Lengkap" class="w-full pl-12 pr-4 py-4 rounded-xl border border-blue-100 bg-white focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-slate-400 text-sm font-medium shadow-lg shadow-blue-100/20">
                </div>

                <!-- Email Input -->
                <div class="relative w-full md:w-80 group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-blue-500 group-focus-within:text-blue-600 transition-colors">mail</span>
                    <input type="email" placeholder="Alamat Email" class="w-full pl-12 pr-4 py-4 rounded-xl border border-blue-100 bg-white focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-slate-400 text-sm font-medium shadow-lg shadow-blue-100/20">
                </div>

                <!-- Button -->
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-4 rounded-xl font-bold transition-all shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 flex items-center justify-center gap-2 text-sm whitespace-nowrap">
                    Hubungi Kami
                    <span class="material-symbols-outlined text-[18px]">arrow_circle_right</span>
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-50/30 pt-20 pb-10 border-t border-blue-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-20 mb-16">
                <!-- Brand -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                            <span class="material-symbols-outlined text-[20px]">folder_shared</span>
                        </div>
                        <span class="font-extrabold text-xl text-slate-900 tracking-tight">SIRM</span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Nikmati layanan kesehatan yang terpersonalisasi, aman, dan efisien langsung dari perangkat Anda.
                    </p>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="font-bold text-blue-600 mb-6">Bantuan</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-500 text-sm hover:text-blue-600 transition-colors">Panduan Pengguna</a></li>
                        <li><a href="#" class="text-slate-500 text-sm hover:text-blue-600 transition-colors">FAQ / Pertanyaan Umum</a></li>
                        <li><a href="#" class="text-slate-500 text-sm hover:text-blue-600 transition-colors">Artikel Bantuan</a></li>
                        <li><a href="#" class="text-slate-500 text-sm hover:text-blue-600 transition-colors">Laporkan Masalah</a></li>
                        <li><a href="#" class="text-slate-500 text-sm hover:text-blue-600 transition-colors">Kontak Support</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="font-bold text-blue-600 mb-6">Layanan</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-500 text-sm hover:text-blue-600 transition-colors">Booking Jadwal Dokter</a></li>
                        <li><a href="#" class="text-slate-500 text-sm hover:text-blue-600 transition-colors">Konsultasi Online</a></li>
                        <li><a href="#" class="text-slate-500 text-sm hover:text-blue-600 transition-colors">E-Resep Obat</a></li>
                        <li><a href="#" class="text-slate-500 text-sm hover:text-blue-600 transition-colors">Cek Stok Obat</a></li>
                        <li><a href="#" class="text-slate-500 text-sm hover:text-blue-600 transition-colors">Riwayat Medis</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h3 class="font-bold text-blue-600 mb-6">Legalitas</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-500 text-sm hover:text-blue-600 transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-slate-500 text-sm hover:text-blue-600 transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-slate-500 text-sm hover:text-blue-600 transition-colors">Kebijakan Cookie</a></li>
                        <li><a href="#" class="text-slate-500 text-sm hover:text-blue-600 transition-colors">Pusat Kepercayaan</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-blue-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex gap-4">
                    <a href="#" class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition-all">
                        <i class="fa-brands fa-facebook-f text-sm font-bold">f</i> <!-- Using simple text as fallback if fontawesome absent, or assume material-design logic -->
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition-all">
                         <span class="font-bold text-sm">in</span>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition-all">
                        <span class="font-bold text-sm">Ig</span>
                    </a>
                     <a href="#" class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition-all">
                        <span class="material-symbols-outlined text-[16px]">play_arrow</span>
                    </a>
                </div>
                <p class="text-slate-400 text-sm">&copy; 2026 SIRM. Seluruh Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

</body>
</html>
