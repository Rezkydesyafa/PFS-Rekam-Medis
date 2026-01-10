<x-guest-layout>
    <!-- Font Import (Plus Jakarta Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <div class="min-h-screen w-full flex bg-white selection:bg-blue-100 selection:text-blue-900 overflow-hidden">
        
        <!-- LEFT COLUMN: LOGIN FORM -->
        <!-- Clean, no card, rigorous spacing -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center p-8 sm:p-12 lg:p-20 xl:p-24 bg-white relative z-10">
            
            <div class="w-full max-w-[420px] mx-auto flex flex-col h-full justify-between lg:h-auto">
                <!-- Top: Logo -->
                <div class="mb-10 lg:mb-16">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-600/20">
                            <span class="material-symbols-outlined text-[24px]">local_hospital</span>
                        </div>
                        <span class="font-extrabold text-2xl text-slate-900 tracking-tight">SIRM</span>
                    </div>
                </div>

                <!-- Middle: Form -->
                <div>
                    <div class="mb-10">
                        <h1 class="text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight mb-3">Welcome Back</h1>
                        <p class="text-slate-500 font-medium text-base">Enter your access credentials to proceed.</p>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email -->
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-bold text-slate-700 ml-1">Email Address</label>
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
                                       class="w-full pl-11 pr-4 py-4 bg-white border border-slate-200 rounded-xl text-slate-900 text-sm font-semibold focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-slate-400 placeholder:font-normal shadow-sm group-hover:border-slate-300"
                                       placeholder="doctor@hospital.com">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <!-- Password -->
                        <div class="space-y-2" x-data="{ show: false }">
                            <div class="flex items-center justify-between ml-1">
                                <label for="password" class="text-sm font-bold text-slate-700">Password</label>
                                @if (Route::has('password.request'))
                                    <a class="text-sm font-bold text-blue-600 hover:text-blue-700 hover:underline" href="{{ route('password.request') }}">
                                        Forgot Password?
                                    </a>
                                @endif
                            </div>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-slate-400 group-focus-within:text-blue-600 transition-colors text-[20px]">lock_open</span>
                                </div>
                                <input id="password" 
                                       :type="show ? 'text' : 'password'"
                                       name="password"
                                       required 
                                       autocomplete="current-password"
                                       class="w-full pl-11 pr-12 py-4 bg-white border border-slate-200 rounded-xl text-slate-900 text-sm font-semibold focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-slate-400 placeholder:font-normal shadow-sm group-hover:border-slate-300"
                                       placeholder="••••••••">
                                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors p-1">
                                    <span class="material-symbols-outlined text-[20px]" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block">
                            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                                <input id="remember_me" type="checkbox" class="rounded-[4px] border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 w-4 h-4 cursor-pointer" name="remember">
                                <span class="ml-2 text-sm text-slate-600 font-semibold group-hover:text-slate-800 transition-colors select-none">Keep me logged in</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white h-14 rounded-xl font-bold text-[15px] shadow-xl shadow-blue-600/20 hover:shadow-blue-600/30 transition-all transform hover:-translate-y-0.5 active:scale-[0.98] flex items-center justify-center gap-2">
                            <span>Sign In to Dashboard</span>
                            <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                        </button>
                    </form>
                </div>

                <!-- Bottom: Copyright -->
                <div class="mt-10 lg:mt-16 text-center lg:text-left">
                    <p class="text-slate-400 text-xs font-semibold">
                        &copy; {{ date('Y') }} SIRM Healthcare. Secure Encrypted Connection.
                    </p>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: VISUAL FEATURE -->
        <!-- Floating Card Design -->
        <div class="hidden lg:flex lg:w-1/2 h-screen p-6 sticky top-0 bg-white items-center justify-center">
            <div class="w-full h-full bg-[#1b5df2] rounded-[2.5rem] relative overflow-hidden flex flex-col shadow-2xl shadow-blue-200/50">
                
                <!-- Background: Abstract & Medical Context -->
                <div class="absolute inset-0 z-0">
                    <div class="absolute -top-[100px] -right-[100px] w-[500px] h-[500px] bg-blue-500 rounded-full blur-[120px] opacity-50"></div>
                    <div class="absolute bottom-[-50px] left-[-50px] w-[400px] h-[400px] bg-indigo-600 rounded-full blur-[100px] opacity-40"></div>
                    <!-- Subtle Grid Lines -->
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTEgMEwwIDBMMCA2MEwxIDYwIiBmaWxsPSJub25lIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==')] opacity-30"></div>
                </div>

                <!-- Feature Content -->
                <div class="relative z-10 flex-1 flex flex-col items-center justify-center p-12 text-center text-white">
                    
                    <!-- Floating Dashboard UI -->
                    <div class="w-full max-w-[500px] relative mb-14 group">
                        <!-- Glow Effect -->
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-300 to-indigo-300 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
                        
                        <!-- Main Card -->
                        <div class="relative bg-white rounded-2xl p-2 shadow-2xl transform transition-all duration-500 ease-in-out group-hover:scale-[1.02] group-hover:-translate-y-2">
                            <div class="bg-slate-50 rounded-xl overflow-hidden border border-slate-100 relative h-[320px]">
                                <!-- UI Image -->
                                <img src="{{ asset('hero-photos.png') }}" class="w-full h-full object-cover object-top" alt="SIRM Dashboard">
                                
                                <!-- Floating Stats Widget -->
                                <div class="absolute bottom-5 left-5 right-5 bg-white/90 backdrop-blur-md p-4 rounded-xl shadow-lg border border-white/50 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                            <span class="material-symbols-outlined">vital_signs</span>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider">System Status</p>
                                            <p class="text-sm font-extrabold text-slate-800">99.9% Uptime</p>
                                        </div>
                                    </div>
                                    <div class="flex -space-x-2">
                                        <div class="w-8 h-8 rounded-full border-2 border-white bg-slate-200" style="background-image: url('https://i.pravatar.cc/100?img=11'); background-size: cover;"></div>
                                        <div class="w-8 h-8 rounded-full border-2 border-white bg-slate-200" style="background-image: url('https://i.pravatar.cc/100?img=12'); background-size: cover;"></div>
                                         <div class="w-8 h-8 rounded-full border-2 border-white bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-600">+5</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Marketing Text -->
                    <div class="max-w-md mx-auto space-y-4">
                        <h2 class="text-[2rem] font-bold leading-tight tracking-tight">
                            Smart Healthcare, <br/> 
                            <span class="text-blue-200">Simplified.</span>
                        </h2>
                        <p class="text-blue-100 text-lg font-medium leading-relaxed opacity-90">
                            Experience the next generation of medical record keeping. Fast, secure, and intuitive.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
