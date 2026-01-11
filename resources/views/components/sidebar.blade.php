<aside class="fixed left-0 top-0 z-40 h-screen bg-white border-r border-slate-100 flex flex-col transition-all duration-300 ease-in-out shadow-[4px_0_24px_rgba(0,0,0,0.02)] rounded-r-3xl"
       :class="sidebarExpanded ? 'w-72' : 'w-[5.5rem]'">

    <div class="h-24 flex items-center w-full transition-all duration-300" 
         :class="sidebarExpanded ? 'px-6 justify-between' : 'justify-center px-0'">
        
        <div class="flex items-center gap-3 overflow-hidden" x-show="sidebarExpanded">
             <div class="relative shrink-0 flex items-center justify-center">
                 <img src="{{ asset('logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
             </div>
             <div class="flex flex-col whitespace-nowrap">
                 <h1 class="text-slate-900 text-lg font-extrabold tracking-tight leading-none">SIRM</h1>
                 <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mt-0.5">Enterprise</p>
             </div>
        </div>

        <button @click="sidebarExpanded = !sidebarExpanded" 
                class="w-10 h-10 bg-white hover:bg-slate-50 border border-transparent hover:border-slate-100 rounded-xl flex items-center justify-center text-slate-500 hover:text-blue-600 transition-all duration-300"
                :class="sidebarExpanded ? '' : 'w-12 h-12 bg-transparent border-0 hover:bg-blue-50/50'">
            <span class="material-symbols-outlined text-[24px]">menu</span>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto overflow-x-hidden py-4 px-4 space-y-1.5 custom-scrollbar">
        
        <a href="{{ route('dashboard') }}" 
           class="flex items-center gap-3 px-3.5 py-3 rounded-2xl transition-all duration-200 group relative {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
           :class="sidebarExpanded ? 'justify-start' : 'justify-center'">
            
            <span class="material-symbols-outlined text-[22px] transition-colors {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}">dashboard</span>
            
            <span x-show="sidebarExpanded" 
                  class="text-sm font-bold whitespace-nowrap transition-colors {{ request()->routeIs('dashboard') ? 'text-blue-700' : 'text-slate-600 group-hover:text-slate-900' }}">
                  Dashboard
            </span>
            
            <div x-show="!sidebarExpanded" 
                 class="absolute left-full ml-3 px-2 py-1 bg-slate-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50 shadow-lg">
                Dashboard
            </div>
        </a>

        @if(auth()->user()->isSuperadmin())
        <div x-show="sidebarExpanded" class="px-4 mt-6 mb-2">
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Admin</p>
        </div>

        <a href="{{ route('admin.users.index') }}" 
           class="flex items-center gap-3 px-3.5 py-3 rounded-2xl transition-all duration-200 group relative {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
           :class="sidebarExpanded ? 'justify-start' : 'justify-center'">
            <span class="material-symbols-outlined text-[22px] transition-colors {{ request()->routeIs('admin.users.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}">manage_accounts</span>
            <span x-show="sidebarExpanded" class="text-sm font-bold whitespace-nowrap {{ request()->routeIs('admin.users.*') ? 'text-blue-700' : 'text-slate-600 group-hover:text-slate-900' }}">Manajemen User</span>
            <div x-show="!sidebarExpanded" class="absolute left-full ml-3 px-2 py-1 bg-slate-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">Manajemen User</div>
        </a>
        @endif

        @php
            $userRole = auth()->user()->role;
            $allRoles = ['superadmin', 'admin', 'petugas', 'petugas_rekam_medis', 'unit_pendaftaran', 'dokter', 'apoteker', 'kasir'];
            
            // Define access lists
            $accessPasien = ['superadmin', 'admin', 'petugas', 'petugas_rekam_medis', 'unit_pendaftaran', 'dokter', 'kasir'];
            $accessDokter = ['superadmin', 'admin', 'petugas', 'petugas_rekam_medis'];
            $accessRekamMedis = ['superadmin', 'admin', 'petugas', 'petugas_rekam_medis', 'dokter', 'kasir'];
            $accessTagihan = ['superadmin', 'admin', 'petugas', 'petugas_rekam_medis', 'kasir'];
            $accessObat = ['superadmin', 'admin', 'petugas', 'petugas_rekam_medis', 'dokter', 'apoteker'];
        @endphp

        <div x-show="sidebarExpanded" class="px-4 mt-6 mb-2">
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Layanan</p>
        </div>

        @if(in_array($userRole, $accessPasien))
        <a href="{{ route('pasien.index') }}" 
           class="flex items-center gap-3 px-3.5 py-3 rounded-2xl transition-all duration-200 group relative {{ request()->routeIs('pasien.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
           :class="sidebarExpanded ? 'justify-start' : 'justify-center'">
            <span class="material-symbols-outlined text-[22px] transition-colors {{ request()->routeIs('pasien.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}">group</span>
            <span x-show="sidebarExpanded" class="text-sm font-bold whitespace-nowrap {{ request()->routeIs('pasien.*') ? 'text-blue-700' : 'text-slate-600 group-hover:text-slate-900' }}">Data Pasien</span>
            <div x-show="!sidebarExpanded" class="absolute left-full ml-3 px-2 py-1 bg-slate-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">Pasien</div>
        </a>
        @endif

        @if(in_array($userRole, $accessDokter))
        <a href="{{ route('dokter.index') }}" 
           class="flex items-center gap-3 px-3.5 py-3 rounded-2xl transition-all duration-200 group relative {{ request()->routeIs('dokter.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
           :class="sidebarExpanded ? 'justify-start' : 'justify-center'">
            <span class="material-symbols-outlined text-[22px] transition-colors {{ request()->routeIs('dokter.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}">medical_services</span>
            <span x-show="sidebarExpanded" class="text-sm font-bold whitespace-nowrap {{ request()->routeIs('dokter.*') ? 'text-blue-700' : 'text-slate-600 group-hover:text-slate-900' }}">Data Dokter</span>
            <div x-show="!sidebarExpanded" class="absolute left-full ml-3 px-2 py-1 bg-slate-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">Dokter</div>
        </a>
        @endif

        @if(in_array($userRole, $accessRekamMedis))
        <a href="{{ route('rekam-medis.index') }}" 
           class="flex items-center gap-3 px-3.5 py-3 rounded-2xl transition-all duration-200 group relative {{ request()->routeIs('rekam-medis.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
           :class="sidebarExpanded ? 'justify-start' : 'justify-center'">
            <span class="material-symbols-outlined text-[22px] transition-colors {{ request()->routeIs('rekam-medis.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}">folder_shared</span>
            <span x-show="sidebarExpanded" class="text-sm font-bold whitespace-nowrap {{ request()->routeIs('rekam-medis.*') ? 'text-blue-700' : 'text-slate-600 group-hover:text-slate-900' }}">Rekam Medis</span>
            <div x-show="!sidebarExpanded" class="absolute left-full ml-3 px-2 py-1 bg-slate-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">Rekam Medis</div>
        </a>
        @endif

        @if(in_array($userRole, $accessTagihan))
        <a href="{{ route('tagihan.index') }}" 
           class="flex items-center gap-3 px-3.5 py-3 rounded-2xl transition-all duration-200 group relative {{ request()->routeIs('tagihan.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
           :class="sidebarExpanded ? 'justify-start' : 'justify-center'">
            
            <span class="material-symbols-outlined text-[22px] transition-colors {{ request()->routeIs('tagihan.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}">receipt_long</span>
            
            <span x-show="sidebarExpanded" class="text-sm font-bold whitespace-nowrap {{ request()->routeIs('tagihan.*') ? 'text-blue-700' : 'text-slate-600 group-hover:text-slate-900' }}">
                Kasir & Tagihan
            </span>

            {{-- Badge Notifikasi Tagihan Belum Lunas --}}
            @php
                $unpaidCount = \App\Models\Tagihan::where('status', 'Belum Lunas')->count();
            @endphp
            @if($unpaidCount > 0)
                <span x-show="sidebarExpanded" class="ml-auto bg-rose-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm">
                    {{ $unpaidCount }}
                </span>
                <span x-show="!sidebarExpanded" class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full border border-white"></span>
            @endif
            
            <div x-show="!sidebarExpanded" class="absolute left-full ml-3 px-2 py-1 bg-slate-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">Kasir & Tagihan</div>
        </a>
        @endif

        @if(in_array($userRole, $accessObat))
        <a href="{{ route('obat.index') }}" 
           class="flex items-center gap-3 px-3.5 py-3 rounded-2xl transition-all duration-200 group relative {{ request()->routeIs('obat.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
           :class="sidebarExpanded ? 'justify-start' : 'justify-center'">
            <span class="material-symbols-outlined text-[22px] transition-colors {{ request()->routeIs('obat.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}">medication</span>
            <span x-show="sidebarExpanded" class="text-sm font-bold whitespace-nowrap {{ request()->routeIs('obat.*') ? 'text-blue-700' : 'text-slate-600 group-hover:text-slate-900' }}">Obat & Apotek</span>
            <div x-show="!sidebarExpanded" class="absolute left-full ml-3 px-2 py-1 bg-slate-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">Obat</div>
        </a>
        @endif

        <div class="my-4 border-t border-slate-50"></div>

        <a href="{{ route('profile.edit') }}" 
           class="flex items-center gap-3 px-3.5 py-3 rounded-2xl transition-all duration-200 group relative {{ request()->routeIs('profile.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
           :class="sidebarExpanded ? 'justify-start' : 'justify-center'">
            <span class="material-symbols-outlined text-[22px] transition-colors {{ request()->routeIs('profile.*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}">settings</span>
            <span x-show="sidebarExpanded" class="text-sm font-bold whitespace-nowrap {{ request()->routeIs('profile.*') ? 'text-blue-700' : 'text-slate-600 group-hover:text-slate-900' }}">Pengaturan</span>
             <div x-show="!sidebarExpanded" class="absolute left-full ml-3 px-2 py-1 bg-slate-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">Pengaturan</div>
        </a>

    </nav>

    <div class="p-4 border-t border-slate-50">
        <div class="flex items-center gap-3 p-3 rounded-2xl bg-slate-50 border border-slate-100 transition-all duration-300 relative group"
             :class="sidebarExpanded ? 'justify-start' : 'justify-center p-2'">
            
            <div class="h-9 w-9 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 shadow-sm shrink-0">
                <span class="material-symbols-outlined text-[20px]">person</span>
            </div>
            
            <div class="flex flex-col min-w-0" x-show="sidebarExpanded">
                <p class="text-xs font-bold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-500 truncate">{{ Auth::user()->email }}</p>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="ml-auto" x-show="sidebarExpanded">
                @csrf
                <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors p-1.5 rounded-lg hover:bg-white" title="Keluar">
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                </button>
            </form>
             
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