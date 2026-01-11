<x-guest-layout>
    <!-- Font Import (Plus Jakarta Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <!-- Main Container: Full Screen, 50:50 Split, No Scroll -->
    <div class="h-screen w-screen flex bg-white overflow-hidden selection:bg-blue-100 selection:text-blue-900">
        
        <!-- LEFT COLUMN: LOGIN FORM (50% Width) -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-12 lg:px-20 xl:px-24 h-full relative z-10 bg-white">
            
            <div class="w-full max-w-[440px] mx-auto flex flex-col h-full justify-center lg:h-auto">
                <!-- Logo -->
                <div class="mb-10 flex items-center gap-3">
                    <img src="{{ asset('logo.png') }}" alt="SIRM Logo" class="w-12 h-12 object-contain drop-shadow-md">
                    <div>
                        <span class="block font-extrabold text-2xl text-slate-900 tracking-tight leading-none">SIRM</span>
                        <span class="text-[10px] font-bold text-slate-400 tracking-wider uppercase">Rekan Medis</span>
                    </div>
                </div>

                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight mb-3">Selamat Datang</h1>
                    <p class="text-slate-500 font-medium text-base leading-relaxed">
                        Silakan masuk ke akun terverifikasi Anda untuk mengakses sistem rekam medis.
                    </p>
                </div>

                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
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
                                   autocomplete="username"
                                   class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-slate-400 shadow-sm"
                                   placeholder="dokter@sirm.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Password -->
                    <div x-data="{ show: false }">
                        <div class="flex items-center justify-between ml-1 mb-1.5">
                            <label for="password" class="text-xs font-bold text-slate-700 uppercase tracking-wide">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs font-bold text-blue-600 hover:text-blue-700 hover:underline" href="{{ route('password.request') }}">
                                    Lupa Kata Sandi?
                                </a>
                            @endif
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-slate-400 group-focus-within:text-blue-600 transition-colors text-[20px]">lock</span>
                            </div>
                            <input id="password" 
                                   :type="show ? 'text' : 'password'"
                                   name="password"
                                   required 
                                   autocomplete="current-password"
                                   class="w-full pl-11 pr-11 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-slate-400 shadow-sm"
                                   placeholder="••••••••">
                            <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
                                <span class="material-symbols-outlined text-[20px]" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center py-1">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group select-none">
                            <input id="remember_me" type="checkbox" class="rounded-[4px] border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 w-4 h-4 cursor-pointer" name="remember">
                            <span class="ml-2.5 text-xs text-slate-600 font-bold group-hover:text-slate-900 transition-colors">Ingat perangkat ini</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white h-14 rounded-xl font-bold text-sm shadow-xl shadow-blue-600/20 hover:shadow-blue-600/30 transition-all transform active:scale-[0.98] flex items-center justify-center gap-2 mt-2">
                        <span>Masuk Dashboard</span>
                        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                    </button>
                </form>

                <!-- Footer -->
                <div class="mt-10 pt-6 border-t border-slate-100 text-center lg:text-left">
                    <p class="text-slate-400 text-[11px] font-semibold leading-relaxed">
                        &copy; {{ date('Y') }} SIRM Enterprise. <br class="lg:hidden"/> Protokol Keamanan Terverifikasi.
                    </p>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: VISUAL FEATURE (50% Width) -->
        <div class="hidden lg:flex lg:w-1/2 h-full p-6 relative">
            <div class="w-full h-full bg-[#1b5df2] rounded-[2.5rem] relative overflow-hidden flex flex-col items-center justify-center text-center text-white shadow-2xl shadow-blue-200/50 border-[6px] border-white ring-1 ring-slate-100">
                
                <!-- Background Ambient -->
                <div class="absolute inset-0 z-0">
                     <div class="absolute top-[-20%] right-[-20%] w-[600px] h-[600px] bg-blue-500 rounded-full blur-[100px] opacity-50"></div>
                     <div class="absolute bottom-[-10%] left-[-10%] w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[100px] opacity-40"></div>
                     <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTEgMEwwIDBMMCA2MEwxIDYwIiBmaWxsPSJub25lIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==')] opacity-20"></div>
                </div>

                <!-- Content Container -->
                <div class="relative z-10 w-full px-12 flex flex-col items-center justify-center h-full">
                    
                    <!-- DYNAMIC DASHBOARD MOCKUP -->
                    <div class="w-full max-w-[500px] relative mb-12 group">
                        
                        <!-- Floating Glass Card -->
                        <div class="bg-white/10 backdrop-blur-sm border border-white/20 p-2 rounded-2xl shadow-2xl transform transition-transform duration-700 hover:scale-[1.02] hover:-translate-y-1">
                             <!-- Inner App Window -->
                             <div class="bg-slate-50 rounded-xl overflow-hidden shadow-inner">
                                 <!-- Fake Browser Header -->
                                 <div class="h-8 bg-white border-b border-slate-200 flex items-center px-3 gap-1.5">
                                     <div class="w-2.5 h-2.5 rounded-full bg-slate-300"></div>
                                     <div class="w-2.5 h-2.5 rounded-full bg-slate-300"></div>
                                 </div>

                                 <!-- App Body -->
                                 <div class="p-5 flex flex-col gap-4">
                                     <!-- Stats Row -->
                                     <div class="flex gap-4">
                                         <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm flex-1 text-left">
                                             <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600 mb-2">
                                                 <span class="material-symbols-outlined text-sm">monitor_heart</span>
                                             </div>
                                             <div class="text-[10px] uppercase font-bold text-slate-400">Total Kunjungan</div>
                                             <div class="text-lg font-extrabold text-slate-800">8,245</div>
                                         </div>
                                         <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm flex-1 text-left">
                                             <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center text-green-600 mb-2">
                                                 <span class="material-symbols-outlined text-sm">medication</span>
                                             </div>
                                             <div class="text-[10px] uppercase font-bold text-slate-400">Resep Obat</div>
                                             <div class="text-lg font-extrabold text-slate-800">1,402</div>
                                         </div>
                                     </div>
                                     
                                     <!-- Chart Row -->
                                     <div class="bg-white rounded-xl border border-slate-100 shadow-sm p-4 h-32 flex items-end justify-between gap-2 relative overflow-hidden">
                                         <div class="absolute top-3 left-3 text-[10px] font-bold text-slate-400 uppercase">Tren Mingguan</div>
                                         <!-- Pillars -->
                                         <div class="w-full bg-blue-100/60 rounded-t-sm h-[40%] hover:bg-blue-400 transition-colors"></div>
                                         <div class="w-full bg-blue-100/60 rounded-t-sm h-[60%] hover:bg-blue-400 transition-colors"></div>
                                         <div class="w-full bg-blue-200    rounded-t-sm h-[80%] hover:bg-blue-500 transition-colors shadow-lg shadow-blue-200"></div>
                                         <div class="w-full bg-blue-100/60 rounded-t-sm h-[50%] hover:bg-blue-400 transition-colors"></div>
                                         <div class="w-full bg-blue-100/60 rounded-t-sm h-[70%] hover:bg-blue-400 transition-colors"></div>
                                     </div>
                                 </div>
                             </div>
                        </div>

                        <!-- Floating Verified Badge -->
                         <div class="absolute -right-5 bottom-8 bg-white py-2 px-3 rounded-lg shadow-[0_8px_30px_rgb(0,0,0,0.12)] flex items-center gap-2 animate-bounce-slow border border-slate-100">
                             <div class="w-5 h-5 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                 <span class="material-symbols-outlined text-[14px]">shield</span>
                             </div>
                             <div class="text-left">
                                 <p class="text-[8px] text-slate-400 font-bold uppercase tracking-wider">Keamanan</p>
                                 <p class="text-[10px] font-bold text-slate-800">Terverifikasi</p>
                             </div>
                        </div>
                    </div>

                    <!-- Text -->
                    <div class="max-w-md mx-auto space-y-3">
                        <h2 class="text-3xl font-bold tracking-tight">Sistem Rekam Medis. <br/> <span class="text-blue-200">Berbasis Data.</span></h2>
                        <p class="text-blue-50 text-base font-medium leading-relaxed opacity-90">
                            Sistem terintegrasi untuk manajemen rekam medis dan pemantauan pasien yang mulus.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
