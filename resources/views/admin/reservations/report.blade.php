<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Report | The Stone Hotel</title>
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

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-zinc-500 hover:text-red-500 transition-all text-[10px] uppercase font-black tracking-widest flex items-center gap-2">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div>
                <h1 class="text-4xl luxury-title tracking-widest uppercase italic leading-tight">
                    Revenue <span class="text-gold-500 not-italic font-bold">Analytics</span>
                </h1>
                <p class="text-zinc-500 text-[10px] uppercase tracking-[0.4em] mt-2">Financial performance & guest stay data</p>
            </div>

            <form action="{{ route('admin.report') }}" method="GET" class="flex items-center gap-4 bg-dark-800 p-3 rounded-2xl border border-white/5">
                <div class="flex flex-col px-2">
                    <label class="text-[8px] uppercase text-zinc-500 font-bold tracking-widest mb-1">Start Date</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" class="bg-transparent border-none text-xs text-zinc-300 focus:ring-0 cursor-pointer">
                </div>
                <div class="h-8 w-[1px] bg-white/10"></div>
                <div class="flex flex-col px-2">
                    <label class="text-[8px] uppercase text-zinc-500 font-bold tracking-widest mb-1">End Date</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" class="bg-transparent border-none text-xs text-zinc-300 focus:ring-0 cursor-pointer">
                </div>
                <button type="submit" class="bg-gold-500 hover:bg-gold-400 text-black px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                    Generate
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-dark-800 p-8 rounded-[2.5rem] border border-white/5 relative overflow-hidden group shadow-2xl">
                <div class="absolute -right-4 -bottom-4 text-gold-500/5 group-hover:scale-110 transition-transform duration-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.407 2.67 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.407-2.67-1M12 16V15" />
                    </svg>
                </div>
                <p class="text-zinc-500 text-[10px] uppercase tracking-widest font-black mb-2">Total Revenue (Confirmed)</p>
                <h2 class="text-3xl font-bold text-gold-500 italic luxury-title tracking-tighter">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
            </div>

            <div class="bg-dark-800 p-8 rounded-[2.5rem] border border-white/5 shadow-2xl">
                <p class="text-zinc-500 text-[10px] uppercase tracking-widest font-black mb-2">Total Transactions</p>
                <h2 class="text-3xl font-bold text-white tracking-tighter">{{ $reservations->count() }} <span class="text-xs text-zinc-600 font-normal uppercase italic">Bookings</span></h2>
            </div>

            <div class="bg-dark-800 p-8 rounded-[2.5rem] border border-white/5 shadow-2xl">
                <p class="text-zinc-500 text-[10px] uppercase tracking-widest font-black mb-2">Average Booking Value</p>
                <h2 class="text-3xl font-bold text-white tracking-tighter">
                    Rp {{ $reservations->count() > 0 ? number_format($totalRevenue / $reservations->count(), 0, ',', '.') : '0' }}
                </h2>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-1 bg-dark-800 rounded-[2.5rem] p-8 border border-white/5 shadow-3xl">
                <h3 class="luxury-title italic text-xl mb-8">Room <span class="text-gold-500 not-italic">Popularity</span></h3>
                <div class="space-y-6">
                    @foreach($roomsReport as $room)
                    <div class="flex justify-between items-center border-b border-white/5 pb-4 group">
                        <div>
                            <p class="text-sm font-bold uppercase tracking-widest text-zinc-200 group-hover:text-gold-400 transition-colors">Room {{ $room->room_number }}</p>
                            <p class="text-[9px] text-zinc-600 italic tracking-widest uppercase">{{ $room->type }}</p>
                        </div>
                        <div class="bg-dark-900 px-4 py-2 rounded-xl border border-white/5 text-right">
                            <span class="text-gold-500 font-black text-sm">{{ $room->reservations_count }}</span>
                            <p class="text-[8px] text-zinc-600 uppercase font-bold tracking-tighter">Stays</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-2 bg-dark-800 rounded-[2.5rem] overflow-hidden border border-white/5 shadow-3xl">
                <div class="p-8 pb-4">
                    <h3 class="luxury-title italic text-xl">Booking <span class="text-gold-500 not-italic font-bold">Ledger</span></h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-zinc-800/30 text-gold-500 text-[9px] uppercase tracking-[0.25em] border-b border-white/5">
                                <th class="p-6 font-black">Guest & Contact</th>
                                <th class="p-6 font-black">Suite</th>
                                <th class="p-6 font-black">Checkout Date</th>
                                <th class="p-6 font-black text-right">Total Paid</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-800/50">
                            @forelse($reservations as $res)
                            <tr class="hover:bg-white/[0.02] transition-all">
                                <td class="p-6">
                                    <p class="text-white font-bold tracking-widest text-xs uppercase">{{ $res->user->name }}</p>
                                    <p class="text-[9px] text-zinc-500 mt-1 italic tracking-widest">{{ $res->user->email }}</p>
                                </td>
                                <td class="p-6">
                                    <span class="text-zinc-400 font-medium text-xs">Room {{ $res->room->room_number }}</span>
                                </td>
                                <td class="p-6 text-xs text-zinc-500">
                                    {{ \Carbon\Carbon::parse($res->check_out)->format('d M Y') }}
                                </td>
                                <td class="p-6 text-right">
                                    <span class="text-gold-500 font-bold tracking-tighter text-sm italic luxury-title">Rp {{ number_format($res->total_price, 0, ',', '.') }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-20 text-center">
                                    <p class="luxury-title italic text-xl tracking-[0.2em] opacity-20 uppercase">No Data Found for this Period</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
