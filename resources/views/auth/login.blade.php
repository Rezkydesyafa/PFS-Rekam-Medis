<x-guest-layout>
    <div class="w-full flex justify-center px-4 py-6 sm:px-6 lg:px-8">
        <div class="w-full max-w-[420px] xl:max-w-[480px] bg-white dark:bg-background-dark border border-[#f0f2f4] dark:border-gray-800 shadow-2xl rounded-2xl px-8 py-8 sm:px-10 relative">
            


            <div class="mx-auto w-full">
                <!-- Header Logo Section -->
                <div class="mb-6 text-center">
                    <a href="/" class="flex flex-col items-center justify-center gap-2 mb-1 group">
                        <!-- Logo (Clickable) -->
                        <div class="w-16 h-16 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                            <img src="{{ asset('logo.png') }}" alt="Logo Aplikasi" class="w-full h-full object-contain drop-shadow-md">
                        </div>
                        <h2 class="text-base font-bold text-gray-900 dark:text-white leading-tight tracking-tight uppercase group-hover:text-primary transition-colors">SIRM</h2>
                    </a>
                    <h2 class="mt-2 text-xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
                        Sistem Informasi Rekam Medis
                    </h2>
                    <p class="mt-1 text-xs leading-5 text-gray-500 dark:text-gray-400">
                        Masuk dengan akun petugas Anda.
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="mt-6">
                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf

                        <!-- Username / NIP Input -->
                        <div>
                            <label class="block text-xs font-medium leading-5 text-gray-900 dark:text-gray-200" for="username">
                                Username / NIP
                            </label>
                            <div class="mt-1 relative rounded-lg shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="material-symbols-outlined text-gray-400 text-[18px]">person</span>
                                </div>
                                <input class="block w-full rounded-lg border-0 py-2.5 pl-9 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 dark:bg-gray-800 dark:ring-gray-700 dark:text-white dark:placeholder:text-gray-500 transition-all duration-200" 
                                       id="username" 
                                       name="email" 
                                       value="{{ old('email') }}"
                                       placeholder="Contoh: 19820312..." 
                                       type="text" 
                                       required autofocus autocomplete="username"/>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <!-- Password Input -->
                        <div x-data="{ show: false }">
                            <label class="block text-xs font-medium leading-5 text-gray-900 dark:text-gray-200" for="password">
                                Password
                            </label>
                            <div class="mt-1 relative rounded-lg shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="material-symbols-outlined text-gray-400 text-[18px]">lock</span>
                                </div>
                                <input class="block w-full rounded-lg border-0 py-2.5 pl-9 pr-9 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 dark:bg-gray-800 dark:ring-gray-700 dark:text-white dark:placeholder:text-gray-500 transition-all duration-200" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Masukkan kata sandi" 
                                       :type="show ? 'text' : 'password'" 
                                       required autocomplete="current-password"/>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer hover:text-gray-600 dark:hover:text-gray-300"
                                     @click="show = !show">
                                    <span class="material-symbols-outlined text-gray-400 text-[18px] select-none" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between pt-1">
                            <div class="flex items-center">
                                <input class="h-3.5 w-3.5 rounded border-gray-300 text-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700" 
                                       id="remember_me" 
                                       name="remember" 
                                       type="checkbox"/>
                                <label class="ml-2 block text-xs text-gray-900 dark:text-gray-300" for="remember_me">
                                    Ingat saya
                                </label>
                            </div>
                            <div class="text-xs leading-5">
                                @if (Route::has('password.request'))
                                <a class="font-semibold text-primary hover:text-primary/80 transition-colors" href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                                @endif
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button class="flex w-full justify-center rounded-lg bg-primary px-3 py-2.5 text-sm font-bold leading-6 text-white shadow-md shadow-primary/20 hover:bg-primary/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-all duration-200 transform active:scale-[0.98]" type="submit">
                                Masuk
                            </button>
                        </div>
                    </form>

                    <!-- Footer Links -->
                    <div class="mt-6">
                        <div class="relative">
                            <div aria-hidden="true" class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                            </div>
                            <div class="relative flex justify-center text-xs font-medium leading-5">
                                <span class="bg-white px-4 text-gray-400 dark:bg-background-dark dark:text-gray-500">Butuh bantuan?</span>
                            </div>
                        </div>
                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <a class="flex w-full items-center justify-center gap-2 rounded-lg bg-[#f0f2f4] dark:bg-gray-800 px-3 py-2 text-xs font-semibold text-[#111418] dark:text-gray-200 shadow-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#f0f2f4]" href="#">
                                <span class="material-symbols-outlined text-[16px]">support_agent</span>
                                <span>Hubungi IT</span>
                            </a>
                            <a class="flex w-full items-center justify-center gap-2 rounded-lg bg-[#f0f2f4] dark:bg-gray-800 px-3 py-2 text-xs font-semibold text-[#111418] dark:text-gray-200 shadow-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#f0f2f4]" href="#">
                                <span class="material-symbols-outlined text-[16px]">menu_book</span>
                                <span>Panduan</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="mt-6 border-t border-gray-100 dark:border-gray-800 pt-4">
                    <p class="text-center text-[10px] text-gray-400 dark:text-gray-500 leading-tight">
                        © {{ date('Y') }} Rumah Sakit Sehat. <br/> Protected by Enterprise Security.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
