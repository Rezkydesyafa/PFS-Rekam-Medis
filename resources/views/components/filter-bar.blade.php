@props([
    'action' => '#',
    'placeholder' => 'Cari data...',
    'sortOptions' => [
        'latest' => 'Terbaru',
        'oldest' => 'Terlama',
    ]
])

<form action="{{ $action }}" method="GET" class="mb-6">
    <div class="flex flex-col md:flex-row gap-4 items-end md:items-center bg-white dark:bg-slate-800 p-4 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm">
        
        {{-- Search Input --}}
        <div class="w-full md:flex-1 relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 material-symbols-outlined text-[20px]">search</span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ $placeholder }}" 
                   class="w-full pl-10 pr-4 py-2 rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-sm focus:ring-primary focus:border-primary placeholder:text-slate-400 dark:text-white transition shadow-sm">
        </div>

        {{-- Extra Filters Slot --}}
        @if($slot->isNotEmpty())
            <div class="w-full md:w-auto flex gap-2">
                {{ $slot }}
            </div>
        @endif

        {{-- Sorting --}}
        <div class="w-full md:w-48">
            <select name="sort" onchange="this.form.submit()" class="w-full py-2 pl-3 pr-8 rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-sm md:text-xs lg:text-sm focus:ring-primary focus:border-primary dark:text-white shadow-sm cursor-pointer">
                @foreach($sortOptions as $value => $label)
                    <option value="{{ $value }}" {{ request('sort') == $value ? 'selected' : '' }}>Urutan: {{ $label }}</option>
                @endforeach
            </select>
        </div>

        {{-- Submit / Reset --}}
        <div class="flex gap-2">
            <button type="submit" class="p-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition shadow-sm" title="Terapkan Filter">
                <span class="material-symbols-outlined text-[20px]">filter_list</span>
            </button>
            @if(request()->anyFilled(['search', 'sort', 'status', 'spesialisasi'])) 
                <a href="{{ $action }}" class="p-2 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 transition shadow-sm" title="Reset Filter">
                    <span class="material-symbols-outlined text-[20px]">refresh</span>
                </a>
            @endif
        </div>

    </div>
</form>
