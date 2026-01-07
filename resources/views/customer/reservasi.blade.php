<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Stone Hotel | Exclusive Collection</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
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

        <div class="flex items-center gap-8">
            <div class="hidden md:flex items-center gap-6 border-r border-white/10 pr-8">
                <a href="{{ route('katalog') }}"
                   class="{{ request()->routeIs('katalog') ? 'text-gold-500' : 'text-zinc-400' }} hover:text-gold-500 transition text-[10px] uppercase font-black tracking-widest">
                    Suites
                </a>
                <a href="{{ route('customer.history') }}"
                   class="{{ request()->routeIs('customer.history') ? 'text-gold-500' : 'text-zinc-400' }} hover:text-gold-500 transition text-[10px] uppercase font-black tracking-widest">
                    My Bookings
                </a>
            </div>

            <div class="flex items-center gap-8">
                <div class="text-right">
                    <p class="text-[9px] text-zinc-500 uppercase tracking-widest font-black">Guest</p>
                    <p class="text-white text-xs font-bold">{{ Auth::user()->name }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-white hover:text-gold-500 transition text-[10px] uppercase font-black tracking-widest border border-white/10 px-4 py-2 rounded-full">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <header class="py-24 text-center bg-dark-900 border-b border-white/5 relative">
        <div class="relative z-10">
            <h1 class="text-5xl md:text-7xl luxury-title tracking-tighter italic">Our Exclusive <span class="text-gold-500 not-italic">Suites</span></h1>
            <p class="text-zinc-400 mt-6 uppercase tracking-[0.5em] text-[10px]">Your sanctuary of comfort and elegance</p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-20">
        @if(session('success'))
            <div class="mb-10 p-5 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl text-emerald-500 text-[10px] uppercase font-black tracking-widest text-center animate-pulse">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($rooms as $room)
                <div class="bg-dark-800 rounded-[2.5rem] overflow-hidden border border-white/5 group hover:border-gold-500/30 transition-all duration-500 shadow-2xl">

                    <div class="h-64 bg-zinc-900 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark-800 via-transparent to-transparent opacity-80"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-zinc-800 group-hover:text-gold-500/20 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="absolute top-6 right-6">
                            <span class="bg-dark-950/80 backdrop-blur-md text-gold-500 px-4 py-2 rounded-full text-[9px] font-black uppercase tracking-widest border border-gold-500/20">
                                {{ $room->type }}
                            </span>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="flex justify-between items-end mb-6">
                            <div>
                                <h3 class="luxury-title text-2xl italic tracking-wide">Room {{ $room->room_number }}</h3>
                                <p class="text-zinc-500 text-[10px] uppercase tracking-widest mt-1">Collection {{ $room->type }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gold-500 font-bold text-xl tracking-tighter">Rp {{ number_format($room->price_per_night, 0, ',', '.') }}</p>
                                <p class="text-[9px] text-zinc-500 uppercase tracking-widest">per night</p>
                            </div>
                        </div>

                        <div class="border-t border-white/5 pt-6 mb-8">
                            <p class="text-[9px] text-zinc-600 uppercase tracking-[0.2em] font-bold mb-3">Included Services</p>
                            <p class="text-zinc-400 text-xs italic leading-relaxed h-12 overflow-hidden">
                                {{ $room->facilities }}
                            </p>
                        </div>

                        <a href="{{ route('reservasi.create', $room->id) }}" class="block w-full bg-white hover:bg-gold-500 text-black text-center py-5 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] transition-all transform active:scale-95">
                            Book This Suite
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 border border-dashed border-white/10 rounded-[3rem]">
                    <p class="luxury-title italic text-2xl text-zinc-600">No suites available at the moment.</p>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="py-12 text-center border-t border-white/5">
        <p class="text-[9px] text-zinc-600 uppercase tracking-[0.5em]">&copy; 2026 The Stone Hotel Signature</p>
    </footer>

</body>
</html>
