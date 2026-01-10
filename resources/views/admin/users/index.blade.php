<x-app-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col gap-2">
            <div class="flex items-center gap-2 text-sm text-slate-500">
                <span>Home</span>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span>Dashboard</span>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-primary font-medium">Manajemen User</span>
            </div>
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Manajemen User</h1>
                    <p class="text-slate-500 dark:text-slate-400 mt-1">Kelola akun pengguna, role, dan hak akses ke dalam sistem rekam medis.</p>
                </div>
                
                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg font-medium transition-colors">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    Tambah User Baru
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, atau username..." 
                        class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                </div>
                
                <div class="w-full md:w-48">
                    <select name="role" onchange="this.form.submit()" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                        <option value="all">Semua Role</option>
                        <option value="superadmin" {{ request('role') == 'superadmin' ? 'selected' : '' }}>Administrator</option>
                        <option value="petugas" {{ request('role') == 'petugas' ? 'selected' : '' }}>Petugas Rekam Medis</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">filter_list</span>
                        Filter
                    </button>
                    <!-- Export Button (Placeholder for UI) -->
                     <button type="button" class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">download</span>
                        Export
                    </button>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
                            <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs">User Profile</th>
                            <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs">Role Access</th>
                            <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs">Status</th>
                            <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs">Password</th>
                            <th class="px-6 py-4 font-semibold text-slate-500 uppercase tracking-wider text-xs text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($users as $user)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 font-bold overflow-hidden">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-slate-900 dark:text-white">{{ $user->name }}</span>
                                        <span class="text-xs text-slate-500">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $roleColors = [
                                        'superadmin' => 'bg-purple-100 text-purple-700 border-purple-200',
                                        'petugas' => 'bg-blue-100 text-blue-700 border-blue-200',
                                    ];
                                    $roleLabels = [
                                        'superadmin' => 'Administrator',
                                        'petugas' => 'Petugas Rekam Medis',
                                    ];
                                    $role = $user->role;
                                    $colorClass = $roleColors[$role] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                                    $label = $roleLabels[$role] ?? ucfirst($role);
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium border {{ $colorClass }}">
                                    @if($role == 'superadmin')
                                        <span class="material-symbols-outlined text-[14px]">shield_person</span>
                                    @elseif($role == 'petugas')
                                        <span class="material-symbols-outlined text-[14px]">medical_services</span>
                                    @else
                                        <span class="material-symbols-outlined text-[14px]">person</span>
                                    @endif
                                    {{ $label }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <!-- Dummy status for now -->
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                    <span class="text-sm text-slate-600 dark:text-slate-400">Active</span>
                                </div>
                            </td>
                             <td class="px-6 py-4">
                                <div class="flex gap-1">
                                    @for($i=0; $i<8; $i++)
                                        <div class="w-1.5 h-1.5 rounded-full bg-slate-300 dark:bg-slate-600"></div>
                                    @endfor
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="p-1 text-slate-400 hover:text-blue-600 transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 text-slate-400 hover:text-rose-600 transition-colors">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                <span class="material-symbols-outlined text-4xl mb-2 text-slate-300">search_off</span>
                                <p>Tidak ada user ditemukan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
