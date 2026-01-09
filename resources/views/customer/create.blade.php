<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details | The Stone Hotel</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: { 500: '#f59e0b' },
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
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0.5;
        }
    </style>
</head>

<body class="bg-dark-950 text-white min-h-screen flex items-center justify-center p-6">

<div class="max-w-5xl w-full grid grid-cols-1 lg:grid-cols-12 bg-dark-800 rounded-[3rem] overflow-hidden shadow-2xl border border-white/5">

    <div class="lg:col-span-5 bg-dark-900 p-12 border-r border-white/5">
        <a href="{{ route('katalog') }}"
           class="text-zinc-500 hover:text-white transition text-[10px] uppercase font-bold tracking-widest block mb-10">
            ← Back to Catalog
        </a>

        <h2 class="text-4xl luxury-title italic">
            Room {{ $room->room_number }}
        </h2>
        <p class="text-gold-500 text-xs uppercase tracking-widest mt-2">
            {{ $room->type }} Collection
        </p>

        <div class="mt-10 space-y-4 text-sm text-zinc-400">
            <div class="flex justify-between border-b border-white/5 pb-4">
                <span>Price per night</span>
                <span class="text-white font-bold">
                    Rp {{ number_format($room->price_per_night, 0, ',', '.') }}
                </span>
            </div>
            <p class="italic text-xs leading-relaxed text-justify">
                {{ $room->facilities }}
            </p>
        </div>

        <div class="mt-10 p-6 bg-dark-800 rounded-2xl border border-gold-500/10">
            <div class="flex justify-between text-[10px] uppercase text-zinc-500 font-bold mb-2">
                <span>Total Stay</span>
                <span id="night-count">0 Nights</span>
            </div>
            <div class="flex justify-between items-end">
                <span class="text-[10px] uppercase text-zinc-500 font-bold">Total Price</span>
                <span id="total-preview"
                      class="text-2xl font-bold text-gold-500 tracking-tighter">
                    Rp 0
                </span>
            </div>
        </div>
    </div>

    <div class="lg:col-span-7 p-12">
        <h3 class="text-2xl luxury-title italic mb-8">
            Reservation <span class="text-gold-500 not-italic">Details</span>
        </h3>

        @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/50 text-red-500 p-4 rounded-xl mb-6 text-sm flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('reservasi.store') }}" method="POST" class="space-y-6">
            @csrf

            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <input type="hidden" id="price_per_night" value="{{ $room->price_per_night }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-[10px] uppercase tracking-widest text-zinc-500 mb-2">
                        Full Name
                    </label>
                    <input type="text" name="name" value="{{ Auth::user()->name ?? '' }}" required
                           placeholder="Your full name"
                           class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-gold-500 transition">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-zinc-500 mb-2">
                        Email Address
                    </label>
                    <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}" required
                           placeholder="you@email.com"
                           class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-gold-500 transition">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-zinc-500 mb-2">
                        Phone Number
                    </label>
                    <input type="tel" name="phone" required
                           placeholder="+62 8xxx xxxx"
                           class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-gold-500 transition">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-zinc-500 mb-2">
                        Check-In
                    </label>
                    <input type="date" name="check_in" id="check_in" required
                           min="{{ date('Y-m-d') }}"
                           class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-gold-500 transition">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-zinc-500 mb-2">
                        Check-Out
                    </label>
                    <input type="date" name="check_out" id="check_out" required
                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                           class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-gold-500 transition">
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-white hover:bg-gold-500 hover:text-white text-black font-black py-4 rounded-xl transition-all uppercase tracking-widest text-[11px] mt-4 shadow-lg shadow-white/5">
                Confirm Booking
            </button>
        </form>
    </div>
</div>

<script>
    const checkIn = document.getElementById('check_in');
    const checkOut = document.getElementById('check_out');
    const price = {{ $room->price_per_night }};

    function updatePrice() {
        // 1. Validasi: Tanggal check-out minimal H+1 dari check-in
        if (checkIn.value) {
            let selectedCheckIn = new Date(checkIn.value);
            let minCheckOut = new Date(selectedCheckIn);
            minCheckOut.setDate(minCheckOut.getDate() + 1);

            // Format ke YYYY-MM-DD untuk atribut min
            const minStr = minCheckOut.toISOString().split("T")[0];
            checkOut.min = minStr;

            // Jika check_out yang sudah dipilih ternyata lebih awal dari min baru, reset check_out
            if (checkOut.value && checkOut.value < minStr) {
                checkOut.value = minStr;
            }
        }

        // 2. Hitung Durasi & Total Harga
        if (checkIn.value && checkOut.value) {
            const start = new Date(checkIn.value);
            const end = new Date(checkOut.value);

            const diffTime = end - start;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (diffDays > 0) {
                document.getElementById('night-count').innerText = diffDays + ' Nights';
                document.getElementById('total-preview').innerText =
                    'Rp ' + (diffDays * price).toLocaleString('id-ID');
            } else {
                document.getElementById('night-count').innerText = '0 Nights';
                document.getElementById('total-preview').innerText = 'Rp 0';
            }
        }
    }

    checkIn.addEventListener('change', updatePrice);
    checkOut.addEventListener('change', updatePrice);
</script>

</body>
</html>
