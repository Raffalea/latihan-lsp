<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Management | The Stone Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: { 400: '#fbbf24', 500: '#f59e0b', 600: '#d97706' },
                        dark: { 950: '#0a0b0d', 900: '#0f1115', 800: '#1a1d23', 700: '#2d3139' }
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
        <div class="mb-12">
            <h1 class="text-4xl luxury-title tracking-widest uppercase italic leading-tight">
                Guest <span class="text-gold-500 not-italic font-bold">Reservations</span>
            </h1>
            <p class="text-zinc-500 text-[10px] uppercase tracking-[0.4em] mt-2">Monitor and manage all incoming bookings</p>
        </div>

        @if(session('success'))
            <div class="mb-8 p-5 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl flex items-center gap-4">
                <div class="h-2 w-2 bg-emerald-500 rounded-full animate-pulse"></div>
                <p class="text-emerald-500 text-[10px] uppercase font-black tracking-widest">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-dark-800 rounded-[2.5rem] overflow-hidden border border-white/5 shadow-3xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-800/30 text-gold-500 text-[10px] uppercase tracking-[0.25em] border-b border-white/5">
                            <th class="p-8 font-black">Guest Details</th>
                            <th class="p-8 font-black">Suite Details</th>
                            <th class="p-8 font-black">Stay Period</th>
                            <th class="p-8 font-black">Grand Total</th>
                            <th class="p-8 font-black text-center">Status</th>
                            <th class="p-8 font-black text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50">
                        @forelse($reservations as $res)
                        <tr class="hover:bg-white/[0.02] transition-all group">
                            <td class="p-8">
                                <p class="text-white font-bold tracking-widest text-sm uppercase">{{ $res->user->name }}</p>
                                <p class="text-[10px] text-zinc-500 mt-1">{{ $res->user->phone ?? 'No Phone' }}</p>
                            </td>
                            <td class="p-8">
                                <p class="text-zinc-300 font-medium">Room {{ $res->room->room_number }}</p>
                                <p class="text-[10px] text-gold-600 uppercase font-bold">{{ $res->room->type }}</p>
                            </td>
                            <td class="p-8 text-sm">
                                <div class="flex items-center gap-2">
                                    <span class="text-zinc-400 font-light">{{ $res->check_in }}</span>
                                    <span class="text-gold-500">→</span>
                                    <span class="text-zinc-400 font-light">{{ $res->check_out }}</span>
                                </div>
                            </td>
                            <td class="p-8">
                                <span class="text-white font-bold tracking-tighter text-lg">Rp {{ number_format($res->total_price, 0, ',', '.') }}</span>
                            </td>
                            <td class="p-8 text-center">
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border border-white/5
                                    {{ $res->status == 'pending' ? 'bg-amber-500/10 text-amber-500 shadow-[0_0_10px_rgba(245,158,11,0.1)]' : '' }}
                                    {{ $res->status == 'confirmed' ? 'bg-emerald-500/10 text-emerald-400 shadow-[0_0_10px_rgba(16,185,129,0.1)]' : '' }}
                                    {{ $res->status == 'cancelled' ? 'bg-red-500/10 text-red-400' : '' }}">
                                    {{ $res->status }}
                                </span>
                            </td>
                            <td class="p-8">
                                <div class="flex justify-center items-center gap-4">
                                    @if($res->status == 'pending')
                                        <form action="{{ route('admin.reservations.approve', $res->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button class="bg-gold-500 hover:bg-gold-400 text-black px-4 py-2 rounded-lg text-[9px] font-black uppercase tracking-widest transition-all">Confirm</button>
                                        </form>
                                        <form action="{{ route('admin.reservations.reject', $res->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button class="text-zinc-500 hover:text-red-500 text-[9px] font-black uppercase tracking-widest transition-all">Reject</button>
                                        </form>
                                    @else
                                        <span class="text-[9px] text-zinc-700 uppercase font-black tracking-widest italic">No Action</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-32 text-center">
                                <p class="luxury-title italic text-xl tracking-[0.2em] opacity-20">No incoming reservations yet</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
