<x-guest-layout>
    <div class="w-full flex justify-center px-4 py-6 sm:px-6 lg:px-8">
        <div class="w-full max-w-[420px] xl:max-w-[480px] bg-white dark:bg-background-dark border border-[#f0f2f4] dark:border-gray-800 shadow-2xl rounded-2xl px-8 py-8 sm:px-10">
            <div class="mx-auto w-full">
                <!-- Header Logo Section -->
                <div class="mb-6 text-center">
                    <div class="flex flex-col items-center justify-center gap-2 mb-1">
                        <div class="w-16 h-16 flex items-center justify-center">
                            <img src="{{ asset('logo.png') }}" alt="Logo Aplikasi" class="w-full h-full object-contain drop-shadow-md">
                        </div>
                        <h2 class="text-base font-bold text-gray-900 dark:text-white leading-tight tracking-tight uppercase">SIRM</h2>
                    </div>
                    <h2 class="mt-2 text-xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
                        Lupa Password?
                    </h2>
                    <p class="mt-1 text-xs leading-5 text-gray-500 dark:text-gray-400">
                        Kami akan mengirimkan link reset ke email Anda.
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="mt-6">
                    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                        @csrf

                        <!-- Email Input -->
                        <div>
                            <label class="block text-xs font-medium leading-5 text-gray-900 dark:text-gray-200" for="email">
                                Email Address
                            </label>
                            <div class="mt-1 relative rounded-lg shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="material-symbols-outlined text-gray-400 text-[18px]">mail</span>
                                </div>
                                <input class="block w-full rounded-lg border-0 py-2.5 pl-9 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 dark:bg-gray-800 dark:ring-gray-700 dark:text-white dark:placeholder:text-gray-500 transition-all duration-200" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}"
                                       placeholder="email@contoh.com" 
                                       type="email" 
                                       required autofocus autocomplete="username"/>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <a class="text-xs font-semibold text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors flex items-center gap-1" href="{{ route('login') }}">
                                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                                Kembali ke Login
                            </a>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button class="flex w-full justify-center rounded-lg bg-primary px-3 py-2.5 text-sm font-bold leading-6 text-white shadow-md shadow-primary/20 hover:bg-primary/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-all duration-200 transform active:scale-[0.98]" type="submit">
                                Kirim Link Reset
                            </button>
                        </div>
                    </form>
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
