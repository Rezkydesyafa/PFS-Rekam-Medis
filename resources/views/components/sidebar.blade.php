<aside class="fixed left-0 top-0 z-40 h-screen bg-white border-r border-slate-100 flex flex-col transition-all duration-300 ease-in-out shadow-[4px_0_24px_rgba(0,0,0,0.02)]"
       :class="sidebarExpanded ? 'w-72' : 'w-[5.5rem]'">

    <!-- Header & Toggle -->
    <div class="h-24 flex items-center relative transition-all duration-300"
         :class="sidebarExpanded ? 'px-8 justify-start' : 'justify-center px-0'">
        
        <!-- Logo -->
        <div class="flex items-center gap-3">
             <div class="relative shrink-0 flex items-center justify-center">
                 <img src="{{ asset('logo.png') }}" alt="Logo" class="w-10 h-10 object-contain drop-shadow-sm transition-all duration-300" :class="sidebarExpanded ? 'scale-100' : 'scale-110'">
             </div>
             
             <div x-show="sidebarExpanded"
                  x-transition:enter="transition-opacity ease-out duration-300 delay-100"
                  x-transition:enter-start="opacity-0"
                  x-transition:enter-end="opacity-100"
                  class="flex flex-col overflow-hidden whitespace-nowrap">
                 <h1 class="text-slate-900 text-lg font-extrabold tracking-tight leading-none">SIRM</h1>
                 <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mt-0.5">Enterprise</p>
             </div>
        </div>

        <!-- Collapse Toggle Button -->
        <button @click="sidebarExpanded = !sidebarExpanded" 
                class="absolute -right-4 top-1/2 -translate-y-1/2 w-8 h-8 bg-white border border-slate-100 rounded-full flex items-center justify-center text-slate-400 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-200 shadow-[0_4px_12px_rgba(0,0,0,0.05)] transition-all duration-300 transform hover:scale-110 z-50 group">
            <span class="material-symbols-outlined text-[18px] transition-transform duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)]" 
                  :class="sidebarExpanded ? 'rotate-0' : 'rotate-180'">chevron_left</span>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 overflow-y-auto overflow-x-hidden py-4 px-4 space-y-1.5 custom-scrollbar">
        
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all duration-200 group relative {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
           :class="sidebarExpanded ? 'justify-start' : 'justify-center'">
            
            <span class="material-symbols-outlined text-[22px] transition-colors {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}">dashboard</span>
            
            <span x-show="sidebarExpanded" 
                  class="text-sm font-bold whitespace-nowrap transition-colors {{ request()->routeIs('dashboard') ? 'text-blue-700' : 'text-slate-600 group-hover:text-slate-900' }}">
                  Dashboard
            </span>
            
            <!-- Tooltip for Collapsed State -->
            <div x-show="!sidebarExpanded" 
                 class="absolute left-full ml-3 px-2 py-1 bg-slate-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50 shadow-lg">
                Dashboard
            </div>
        </a>

        @if(auth()->user()->isSuperadmin())
        <!-- Label -->
        <div x-show="sidebarExpanded" class="px-4 mt-6 mb-2">
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Admin</p>
        </div>

        <a href="{{ route('admin.users.index') }}" 
           class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all duration-200 group relative {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
           :class="sidebarExpanded ? 'justify-start' : 'justify-center'">
            <span class="material-symbols-outlined text-[22px] transition-colors {{ request()->routeIs('admin.users.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}">manage_accounts</span>
            <span x-show="sidebarExpanded" class="text-sm font-bold whitespace-nowrap {{ request()->routeIs('admin.users.*') ? 'text-blue-700' : 'text-slate-600 group-hover:text-slate-900' }}">Manajemen User</span>
            <div x-show="!sidebarExpanded" class="absolute left-full ml-3 px-2 py-1 bg-slate-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">Manajemen User</div>
        </a>
        @endif

        @if(auth()->user()->isPetugas())
        <!-- Label -->
        <div x-show="sidebarExpanded" class="px-4 mt-6 mb-2">
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Layanan</p>
        </div>

        <a href="{{ route('pasien.index') }}" 
           class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all duration-200 group relative {{ request()->routeIs('pasien.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
           :class="sidebarExpanded ? 'justify-start' : 'justify-center'">
            <span class="material-symbols-outlined text-[22px] transition-colors {{ request()->routeIs('pasien.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}">group</span>
            <span x-show="sidebarExpanded" class="text-sm font-bold whitespace-nowrap {{ request()->routeIs('pasien.*') ? 'text-blue-700' : 'text-slate-600 group-hover:text-slate-900' }}">Data Pasien</span>
            <div x-show="!sidebarExpanded" class="absolute left-full ml-3 px-2 py-1 bg-slate-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">Pasien</div>
        </a>

        <a href="{{ route('dokter.index') }}" 
           class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all duration-200 group relative {{ request()->routeIs('dokter.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
           :class="sidebarExpanded ? 'justify-start' : 'justify-center'">
            <span class="material-symbols-outlined text-[22px] transition-colors {{ request()->routeIs('dokter.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}">medical_services</span>
            <span x-show="sidebarExpanded" class="text-sm font-bold whitespace-nowrap {{ request()->routeIs('dokter.*') ? 'text-blue-700' : 'text-slate-600 group-hover:text-slate-900' }}">Data Dokter</span>
            <div x-show="!sidebarExpanded" class="absolute left-full ml-3 px-2 py-1 bg-slate-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">Dokter</div>
        </a>

        <a href="#" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all duration-200 group relative text-slate-500 hover:bg-slate-50 hover:text-slate-900"
           :class="sidebarExpanded ? 'justify-start' : 'justify-center'">
            <span class="material-symbols-outlined text-[22px] text-slate-400 group-hover:text-slate-600">folder_shared</span>
            <span x-show="sidebarExpanded" class="text-sm font-bold whitespace-nowrap text-slate-600 group-hover:text-slate-900">Rekam Medis</span>
            <div x-show="!sidebarExpanded" class="absolute left-full ml-3 px-2 py-1 bg-slate-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">Rekam Medis</div>
        </a>

        <a href="#" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all duration-200 group relative text-slate-500 hover:bg-slate-50 hover:text-slate-900"
           :class="sidebarExpanded ? 'justify-start' : 'justify-center'">
            <span class="material-symbols-outlined text-[22px] text-slate-400 group-hover:text-slate-600">medication</span>
            <span x-show="sidebarExpanded" class="text-sm font-bold whitespace-nowrap text-slate-600 group-hover:text-slate-900">Obat & Apotek</span>
            <div x-show="!sidebarExpanded" class="absolute left-full ml-3 px-2 py-1 bg-slate-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">Obat</div>
        </a>
        @endif

        <div class="my-4 border-t border-slate-50"></div>

        <a href="{{ route('profile.edit') }}" 
           class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all duration-200 group relative {{ request()->routeIs('profile.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
           :class="sidebarExpanded ? 'justify-start' : 'justify-center'">
            <span class="material-symbols-outlined text-[22px] transition-colors {{ request()->routeIs('profile.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}">settings</span>
            <span x-show="sidebarExpanded" class="text-sm font-bold whitespace-nowrap {{ request()->routeIs('profile.*') ? 'text-blue-700' : 'text-slate-600 group-hover:text-slate-900' }}">Pengaturan</span>
             <div x-show="!sidebarExpanded" class="absolute left-full ml-3 px-2 py-1 bg-slate-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">Pengaturan</div>
        </a>

    </nav>

    <!-- Footer Profile -->
    <div class="p-4 border-t border-slate-50">
        <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100 transition-all duration-300 relative group"
             :class="sidebarExpanded ? 'justify-start' : 'justify-center p-2'">
            
            <div class="h-9 w-9 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 shadow-sm shrink-0">
                <span class="material-symbols-outlined text-[20px]">person</span>
            </div>
            
            <div class="flex flex-col min-w-0" x-show="sidebarExpanded">
                <p class="text-xs font-bold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-500 truncate">{{ Auth::user()->email }}</p>
            </div>

            <!-- Logout Button -->
             <form method="POST" action="{{ route('logout') }}" class="ml-auto" x-show="sidebarExpanded">
                @csrf
                <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors p-1.5 rounded-lg hover:bg-white" title="Keluar">
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                </button>
            </form>
             
             <!-- Tooltip for collapsed profile -->
              <div x-show="!sidebarExpanded" 
                 class="absolute left-full ml-3 px-3 py-2 bg-white border border-slate-100 text-slate-600 text-xs rounded-xl shadow-xl opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-50">
                <div class="font-bold mb-1">{{ Auth::user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">logout</span> Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</aside>
