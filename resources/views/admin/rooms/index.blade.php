<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suite Management | The Stone Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: { 400: '#fbbf24', 500: '#f59e0b', 600: '#d97706' },
                        dark: { 900: '#0f1115', 800: '#1a1d23', 700: '#2d3139' }
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .luxury-title { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-dark-900 text-white min-h-screen pb-20">

    <nav class="bg-dark-800 border-b border-white/5 px-8 py-5 mb-10 sticky top-0 z-50 backdrop-blur-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="luxury-title tracking-[0.2em] uppercase italic text-lg">
                THE <span class="text-gold-500 not-italic font-bold">STONE</span>
            </div>

            <div class="flex items-center gap-8">
                <div class="hidden md:flex items-center gap-8 border-r border-white/10 pr-8">
                    <a href="{{ route('rooms.index') }}"
                       class="{{ request()->routeIs('rooms.*') ? 'text-gold-500' : 'text-zinc-500' }} hover:text-gold-400 transition-all text-[10px] uppercase font-black tracking-[0.2em]">
                        Inventory
                    </a>
                    <a href="{{ route('admin.reservations.index') }}"
                       class="{{ request()->routeIs('admin.reservations.*') ? 'text-gold-500' : 'text-zinc-500' }} hover:text-gold-400 transition-all text-[10px] uppercase font-black tracking-[0.2em]">
                        Reservations
                    </a>
                    <a href="{{ route('admin.report') }}"
                       class="{{ request()->routeIs('admin.report') ? 'text-gold-500' : 'text-zinc-500' }} hover:text-gold-400 transition-all text-[10px] uppercase font-black tracking-[0.2em]">
                        Financial Report
                    </a>
                </div>

                <div class="flex items-center gap-8">
                    <div class="text-right hidden sm:block">
                        <p class="text-[9px] text-zinc-500 uppercase tracking-widest font-black mb-0.5">Admin Profile</p>
                        <p class="text-white text-xs font-bold tracking-tight">{{ Auth::user()->name }}</p>
                    </div>

                    <div class="h-8 w-[1px] bg-zinc-700/50"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-zinc-500 hover:text-red-500 transition-all text-[10px] uppercase font-black tracking-widest flex items-center gap-2">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div>
                <h1 class="text-4xl luxury-title tracking-widest uppercase italic leading-tight">
                    Suite <span class="text-gold-500 not-italic font-bold">Inventory</span>
                </h1>
                <p class="text-zinc-500 text-[10px] uppercase tracking-[0.4em] mt-2">Manage your luxury rooms and assets</p>
            </div>

            <a href="{{ route('rooms.create') }}" class="group relative px-8 py-4 bg-gold-500 hover:bg-gold-400 text-black rounded-xl transition-all overflow-hidden shadow-[0_10px_30px_rgba(245,158,11,0.2)]">
                <span class="relative z-10 font-black uppercase text-[10px] tracking-widest">+ Add New Suite</span>
            </a>
        </div>

        @if(session('success'))
            <div class="mb-8 p-5 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl flex items-center gap-4">
                <div class="h-2 w-2 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_10px_#10b981]"></div>
                <p class="text-emerald-500 text-[10px] uppercase font-black tracking-widest">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-dark-800 rounded-[2.5rem] overflow-hidden border border-white/5 shadow-3xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-800/30 text-gold-500 text-[10px] uppercase tracking-[0.25em] border-b border-white/5">
                            <th class="p-8 font-black">Suite Details</th>
                            <th class="p-8 font-black">Category</th>
                            <th class="p-8 font-black">Price / Night</th>
                            <th class="p-8 font-black text-center">Status</th>
                            <th class="p-8 font-black text-center">Management</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50">
                        @forelse($rooms as $room)
                        <tr class="hover:bg-white/[0.02] transition-all group">
                            <td class="p-8">
                                <div class="flex items-center gap-4">
                                    <div class="h-12 w-12 rounded-xl bg-dark-900 border border-zinc-800 flex items-center justify-center text-gold-500 font-bold tracking-tighter shadow-inner">
                                        #{{ $room->room_number }}
                                    </div>
                                    <p class="text-white font-bold tracking-widest text-sm uppercase">Room {{ $room->room_number }}</p>
                                </div>
                            </td>
                            <td class="p-8">
                                <span class="text-zinc-400 luxury-title italic text-base">{{ $room->type }}</span>
                            </td>
                            <td class="p-8">
                                <span class="text-white font-bold tracking-tighter text-lg">Rp {{ number_format($room->price_per_night, 0, ',', '.') }}</span>
                            </td>
                            <td class="p-8 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full {{ $room->status == 'available' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-red-500/10 text-red-400' }} text-[9px] font-black uppercase tracking-tighter border border-white/5">
                                    {{ ucfirst($room->status) }}
                                </span>
                            </td>
                            <td class="p-8 text-center">
                                <div class="flex justify-center items-center gap-6">
                                    <a href="{{ route('rooms.edit', $room->id) }}" class="text-zinc-500 hover:text-gold-500 transition-colors text-[10px] uppercase font-black tracking-widest">Edit</a>
                                    <div class="h-4 w-[1px] bg-zinc-800"></div>
                                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Permanent removal of this suite?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-zinc-600 hover:text-red-500 transition-colors text-[10px] uppercase font-black tracking-widest">Remove</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-32 text-center text-zinc-600">No data found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
