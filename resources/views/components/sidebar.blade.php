<aside class="hidden w-64 flex-col border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark lg:flex h-screen fixed left-0 top-0 z-40">
    <div class="flex h-16 items-center gap-3 px-6 border-b border-slate-100 dark:border-slate-800/50">
        <div class="w-8 h-8 flex items-center justify-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="w-full h-full object-contain">
        </div>
        <div class="flex flex-col">
            <h1 class="text-slate-900 dark:text-white text-base font-bold leading-none uppercase">SIRM</h1>
            <p class="text-slate-500 dark:text-slate-400 text-[10px] font-medium mt-1">Sistem Rekam Medis</p>
        </div>
    </div>
    
    <nav class="flex-1 flex flex-col gap-1 p-4 overflow-y-auto">
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-primary/10 text-primary dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors group' }}" href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined text-[24px] {{ request()->routeIs('dashboard') ? 'fill-1' : 'group-hover:text-slate-900 dark:group-hover:text-white' }}">dashboard</span>
            <span class="text-sm {{ request()->routeIs('dashboard') ? 'font-bold' : 'font-medium' }}">Dashboard</span>
        </a>

        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('pasien.*') ? 'bg-primary/10 text-primary dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors group' }}" href="{{ route('pasien.index') }}">
            <span class="material-symbols-outlined text-[24px] {{ request()->routeIs('pasien.*') ? 'fill-1' : 'group-hover:text-slate-900 dark:group-hover:text-white' }}">group</span>
            <span class="text-sm {{ request()->routeIs('pasien.*') ? 'font-bold' : 'font-medium' }}">Pasien</span>
        </a>

        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('dokter.*') ? 'bg-primary/10 text-primary dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors group' }}" href="#">
            <span class="material-symbols-outlined text-[24px] {{ request()->routeIs('dokter.*') ? 'fill-1' : 'group-hover:text-slate-900 dark:group-hover:text-white' }}">medical_services</span>
            <span class="text-sm {{ request()->routeIs('dokter.*') ? 'font-bold' : 'font-medium' }}">Dokter</span>
        </a>

        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('rekam-medis.*') ? 'bg-primary/10 text-primary dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors group' }}" href="#">
            <span class="material-symbols-outlined text-[24px] {{ request()->routeIs('rekam-medis.*') ? 'fill-1' : 'group-hover:text-slate-900 dark:group-hover:text-white' }}">folder_shared</span>
            <span class="text-sm {{ request()->routeIs('rekam-medis.*') ? 'font-bold' : 'font-medium' }}">Rekam Medis</span>
        </a>

        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('obat.*') ? 'bg-primary/10 text-primary dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors group' }}" href="#">
            <span class="material-symbols-outlined text-[24px] {{ request()->routeIs('obat.*') ? 'fill-1' : 'group-hover:text-slate-900 dark:group-hover:text-white' }}">medication</span>
            <span class="text-sm {{ request()->routeIs('obat.*') ? 'font-bold' : 'font-medium' }}">Obat</span>
        </a>

        <div class="my-2 border-t border-slate-100 dark:border-slate-800"></div>

        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('profile.*') ? 'bg-primary/10 text-primary dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors group' }}" href="{{ route('profile.edit') }}">
            <span class="material-symbols-outlined text-[24px] {{ request()->routeIs('profile.*') ? 'fill-1' : 'group-hover:text-slate-900 dark:group-hover:text-white' }}">settings</span>
            <span class="text-sm {{ request()->routeIs('profile.*') ? 'font-bold' : 'font-medium' }}">Pengaturan</span>
        </a>
    </nav>
    
    <div class="p-4 border-t border-slate-200 dark:border-slate-800">
        <div class="flex items-center gap-3 p-2 rounded-lg bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700">
            <div class="h-10 w-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 overflow-hidden">
                <span class="material-symbols-outlined text-2xl">person</span>
            </div>
            <div class="flex flex-col min-w-0">
                <p class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ Auth::user()->email }}</p>
            </div>
            
            <!-- Log Out Button -->
            <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                @csrf
                <button type="submit" class="text-slate-400 hover:text-rose-500 transition-colors p-1" title="Log Out">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
