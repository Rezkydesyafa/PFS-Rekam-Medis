<x-guest-layout>
    <!-- Font Import (Plus Jakarta Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <div class="h-screen w-screen flex bg-white overflow-hidden selection:bg-blue-100 selection:text-blue-900">
        
        <!-- LEFT COLUMN: VISUAL VISUALIZATION -->
        <div class="hidden lg:flex lg:w-1/2 h-full p-6 relative">
            <div class="w-full h-full bg-[#1b5df2] rounded-[2.5rem] relative overflow-hidden flex flex-col items-center justify-center text-center text-white shadow-2xl shadow-blue-200/50 border-[6px] border-white ring-1 ring-slate-100">
                
                <!-- Background Ambient -->
                <div class="absolute inset-0 z-0">
                     <div class="absolute top-[-20%] left-[-20%] w-[600px] h-[600px] bg-blue-500 rounded-full blur-[100px] opacity-50"></div>
                     <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[100px] opacity-40"></div>
                     <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTEgMEwwIDBMMCA2MEwxIDYwIiBmaWxsPSJub25lIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==')] opacity-20"></div>
                </div>

                <!-- Abstract Dashboard Graphic -->
                <div class="relative z-10 w-full px-12 flex flex-col items-center justify-center h-full">
                    
                    <div class="w-full max-w-[420px] mb-12 relative group">
                        
                        <!-- Floating Card -->
                        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-2 rounded-2xl shadow-2xl transform transition-transform duration-700 hover:scale-[1.02]">
                             <div class="bg-slate-50 rounded-xl overflow-hidden shadow-inner p-5 min-h-[220px] flex flex-col relative">
                                 <!-- Decorative Header -->
                                 <div class="flex justify-between items-center mb-6">
                                     <div class="h-2 w-20 bg-slate-200 rounded"></div>
                                     <div class="flex gap-1">
                                         <div class="h-2 w-2 rounded-full bg-slate-300"></div>
                                         <div class="h-2 w-2 rounded-full bg-slate-300"></div>
                                     </div>
                                 </div>

                                 <!-- Abstract Charts -->
                                 <div class="flex gap-4 items-end h-[100px] mb-4 px-2">
                                     <div class="w-1/5 bg-blue-100/50 h-[40%] rounded-t-sm"></div>
                                     <div class="w-1/5 bg-blue-100/50 h-[60%] rounded-t-sm"></div>
                                     <div class="w-1/5 bg-blue-500 h-[85%] rounded-t-sm shadow-lg shadow-blue-500/20 relative">
                                         <!-- Pulse Dot -->
                                         <div class="absolute -top-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-white rounded-full"></div>
                                     </div>
                                     <div class="w-1/5 bg-blue-100/50 h-[55%] rounded-t-sm"></div>
                                     <div class="w-1/5 bg-blue-100/50 h-[70%] rounded-t-sm"></div>
                                 </div>

                                 <!-- Bottom Status Row -->
                                 <div class="mt-auto flex items-center gap-3 bg-white p-3 rounded-lg border border-slate-100 shadow-sm">
                                     <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center text-green-600">
                                         <span class="material-symbols-outlined text-lg">admin_panel_settings</span>
                                     </div>
                                     <div class="text-left">
                                         <div class="h-1.5 w-16 bg-slate-200 rounded mb-1.5"></div>
                                         <div class="h-1.5 w-10 bg-slate-100 rounded"></div>
                                     </div>
                                     <div class="ml-auto">
                                         <span class="material-symbols-outlined text-slate-300">check_circle</span>
                                     </div>
                                 </div>
                             </div>
                        </div>

                        <!-- Floating Badge -->
                        <div class="absolute -left-4 top-10 bg-white p-3 rounded-xl shadow-lg flex items-center gap-3 animate-bounce-slow border border-slate-50">
                             <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                                 <span class="material-symbols-outlined text-[18px]">lock_clock</span>
                             </div>
                             <div>
                                <p class="text-[9px] text-slate-400 font-bold uppercase">Pemulihan</p>
                                <p class="text-[11px] font-bold text-slate-800">Mode Aman</p>
                             </div>
                        </div>
                    </div>

                    <!-- Text Content -->
                    <div class="max-w-xs mx-auto space-y-3">
                        <h2 class="text-3xl font-bold tracking-tight leading-tight">Pemulihan Kata Sandi <br/> <span class="text-blue-200">Lebih Mudah.</span></h2>
                        <p class="text-blue-50 text-sm font-medium leading-relaxed opacity-90">
                            Pulihkan akses ke dashboard medis Anda dengan aman hanya dalam beberapa langkah.
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: FORM (50% Width) -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-12 lg:px-20 xl:px-24 h-full relative z-10 bg-white">
            
            <div class="w-full max-w-[440px] mx-auto flex flex-col h-full justify-center lg:h-auto">
                
                <!-- Back Button top -->
                <div class="absolute top-8 left-8 lg:left-20">
                    <a href="{{ route('login') }}" class="flex items-center gap-2 text-slate-500 hover:text-blue-600 transition-colors font-semibold text-sm group">
                        <span class="material-symbols-outlined text-[20px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
                        Kembali ke Login
                    </a>
                </div>

                <!-- Header -->
                <div class="mb-8 mt-12 lg:mt-0">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 mb-6">
                        <span class="material-symbols-outlined text-[28px]">key</span>
                    </div>
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-3">Lupa Kata Sandi?</h1>
                    <p class="text-slate-500 font-medium text-base leading-relaxed">
                        Jangan khawatir, kami akan mengirimkan instruksi reset ke email Anda.
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="text-xs font-bold text-slate-700 ml-1 mb-1.5 block uppercase tracking-wide">Alamat Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-slate-400 group-focus-within:text-blue-600 transition-colors text-[20px]">mail</span>
                            </div>
                            <input id="email" 
                                   type="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus 
                                   class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-slate-400 shadow-sm"
                                   placeholder="Masukkan email terdaftar Anda">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white h-14 rounded-xl font-bold text-sm shadow-xl shadow-blue-600/20 hover:shadow-blue-600/30 transition-all transform active:scale-[0.98] flex items-center justify-center gap-2">
                        <span>Kirim Tautan Reset</span>
                        <span class="material-symbols-outlined text-[20px]">send</span>
                    </button>
                    
                </form>

                <!-- Help Footer -->
                <div class="mt-10 text-center">
                    <p class="text-slate-400 text-sm font-medium">
                        Ingat kata sandi Anda? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Masuk</a>
                    </p>
                </div>
            </div>
        </div>
        
    </div>
</x-guest-layout>
