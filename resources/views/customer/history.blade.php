<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Experience | The Stone Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: { 400: '#fbbf24', 500: '#f59e0b', 600: '#d97706' },
                        dark: { 950: '#0a0b0d', 900: '#0f1115', 800: '#1a1d23' }
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
<body class="bg-dark-950 text-white min-h-screen">

    <nav class="bg-transparent border-b border-white/5 px-8 py-6 flex justify-between items-center backdrop-blur-md sticky top-0 z-50">
        <div class="luxury-title tracking-[0.3em] uppercase italic text-xl">
            THE <span class="text-gold-500 not-italic font-bold">STONE</span>
        </div>
        <div class="flex items-center gap-6">
            <a href="{{ route('katalog') }}" class="text-[10px] uppercase font-black tracking-widest text-zinc-400 hover:text-gold-500 transition">Back to Katalog</a>
            <div class="h-4 w-[1px] bg-white/10"></div>
            <p class="text-white text-xs font-bold">{{ Auth::user()->name }}</p>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-20">
        <header class="mb-16 text-center">
            <h1 class="text-5xl luxury-title italic">My <span class="text-gold-500 not-italic">Journey</span></h1>
            <p class="text-zinc-500 mt-4 uppercase tracking-[0.5em] text-[10px]">Track your exclusive reservations</p>
        </header>

        <div class="space-y-6">
            @forelse($myReservations as $res)
                <div class="bg-dark-900 border border-white/5 rounded-[2rem] p-8 flex flex-col md:flex-row justify-between items-center group hover:border-gold-500/30 transition-all duration-500">

                    <div class="flex items-center gap-8">
                        <div class="h-16 w-16 rounded-2xl bg-dark-800 border border-zinc-800 flex items-center justify-center relative">
                             @if($res->status == 'confirmed')
                                <div class="absolute -top-1 -right-1 h-3 w-3 bg-emerald-500 rounded-full animate-ping"></div>
                                <div class="absolute -top-1 -right-1 h-3 w-3 bg-emerald-500 rounded-full"></div>
                             @endif
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gold-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                             </svg>
                        </div>

                        <div>
                            <h3 class="luxury-title text-2xl italic">Room {{ $res->room->room_number }}</h3>
                            <p class="text-[10px] text-zinc-500 uppercase tracking-widest mt-1">{{ $res->room->type }}</p>
                            <div class="flex items-center gap-3 mt-4 text-xs text-zinc-400 font-light">
                                <span>{{ date('d M Y', strtotime($res->check_in)) }}</span>
                                <span class="text-gold-500">/</span>
                                <span>{{ date('d M Y', strtotime($res->check_out)) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 md:mt-0 text-right flex flex-col items-center md:items-end gap-3">
                        <div class="px-6 py-2 rounded-full border border-white/10 text-[9px] uppercase font-black tracking-widest
                            {{ $res->status == 'pending' ? 'bg-amber-500/10 text-amber-500 border-amber-500/20' : '' }}
                            {{ $res->status == 'confirmed' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : '' }}
                            {{ $res->status == 'cancelled' ? 'bg-red-500/10 text-red-500 border-red-500/20' : '' }}">
                            {{ $res->status }}
                        </div>
                        <p class="text-white font-bold text-lg tracking-tighter">Rp {{ number_format($res->total_price, 0, ',', '.') }}</p>
                        @if($res->status == 'confirmed')
                            <p class="text-[9px] text-emerald-500 uppercase font-black tracking-tighter italic">Ready for Check-in</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-20 border border-dashed border-white/10 rounded-[3rem]">
                    <p class="luxury-title italic text-xl text-zinc-600">No journeys recorded yet.</p>
                    <a href="{{ route('katalog') }}" class="inline-block mt-6 text-gold-500 text-[10px] uppercase font-black tracking-widest hover:underline">Start Exploring</a>
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>
