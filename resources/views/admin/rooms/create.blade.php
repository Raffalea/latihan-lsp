<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Suite | The Stone Hotel</title>
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
        /* Menghilangkan spin button pada number input */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    </style>
</head>
<body class="bg-dark-900 text-white min-h-screen pb-20">

    <nav class="bg-dark-800 border-b border-white/5 px-8 py-5 mb-10">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="luxury-title tracking-[0.2em] uppercase italic text-lg text-gold-500">
                THE STONE <span class="text-white not-italic text-xs tracking-widest ml-4">Registry</span>
            </div>
            <a href="{{ route('rooms.index') }}" class="text-zinc-500 hover:text-white transition text-[10px] uppercase font-black tracking-widest">
                ← Back to Inventory
            </a>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-6">
        <div class="bg-dark-800 rounded-[2.5rem] shadow-3xl border border-white/5 overflow-hidden">

            <div class="p-10 border-b border-gold-500/10 text-center bg-gradient-to-b from-zinc-800/50 to-transparent">
                <h1 class="text-3xl luxury-title tracking-widest uppercase italic text-white">
                    Add New <span class="text-gold-500 not-italic">Suite</span>
                </h1>
                <p class="text-zinc-500 text-[10px] uppercase tracking-[0.4em] mt-3">Expand the hotel collection</p>
            </div>

            <form action="{{ route('rooms.store') }}" method="POST" class="p-10 space-y-8">
                @csrf

                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black text-zinc-500 mb-3 uppercase tracking-[0.2em]">Room Number</label>
                        <input type="text" name="room_number" required placeholder="Ex: A-301"
                            class="w-full px-6 py-4 rounded-2xl bg-dark-900 border border-zinc-800 text-white placeholder-zinc-700 focus:ring-1 focus:ring-gold-500 outline-none transition shadow-inner">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-zinc-500 mb-3 uppercase tracking-[0.2em]">Suite Category</label>
                        <select name="type" required
                            class="w-full px-6 py-4 rounded-2xl bg-dark-900 border border-zinc-800 text-white focus:ring-1 focus:ring-gold-500 outline-none appearance-none cursor-pointer transition">
                            <option value="Superior">Superior Room</option>
                            <option value="Deluxe">Deluxe Room</option>
                            <option value="Signature Suite">Signature Suite</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-zinc-500 mb-3 uppercase tracking-[0.2em]">Rate per Night (IDR)</label>
                    <div class="relative">
                        <span class="absolute left-6 top-1/2 -translate-y-1/2 text-zinc-600 font-bold text-sm">Rp</span>

                        <input type="text" id="price_format" placeholder="1.500.000" required
                            class="w-full pl-14 pr-6 py-4 rounded-2xl bg-dark-900 border border-zinc-800 text-gold-500 font-bold text-lg focus:ring-1 focus:ring-gold-500 outline-none transition shadow-inner">

                        <input type="hidden" name="price_per_night" id="price_raw">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-zinc-500 mb-3 uppercase tracking-[0.2em]">Key Facilities</label>
                    <textarea name="facilities" rows="4" placeholder="King Size Bed, Ocean View, Smart Butler..."
                        class="w-full px-6 py-4 rounded-2xl bg-dark-900 border border-zinc-800 text-white placeholder-zinc-700 focus:ring-1 focus:ring-gold-500 outline-none transition shadow-inner"></textarea>
                </div>

                <div class="pt-4 flex items-center gap-6">
                    <button type="reset" class="flex-1 py-5 text-[10px] font-black text-zinc-600 uppercase tracking-widest hover:text-white transition border border-transparent hover:border-zinc-800 rounded-2xl">
                        Reset Form
                    </button>
                    <button type="submit" class="flex-[2] bg-gradient-to-r from-gold-600 to-gold-400 hover:from-gold-500 hover:to-gold-300 text-black font-black py-5 rounded-2xl transition-all transform active:scale-95 uppercase tracking-widest text-[10px] shadow-[0_15px_30px_rgba(217,119,6,0.2)]">
                        Confirm & Save Suite
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const inputFormat = document.getElementById('price_format');
        const inputRaw = document.getElementById('price_raw');

        inputFormat.addEventListener('keyup', function(e) {
            // Hilangkan semua karakter kecuali angka
            let number_string = this.value.replace(/[^,\d]/g, '').toString();
            let split = number_string.split(',');
            let sisa  = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

            // Tampilkan hasil format ke user
            this.value = rupiah;

            // Masukkan angka murni ke input hidden untuk dikirim ke database
            inputRaw.value = number_string.replace(/\./g, '');
        });

        // Pastikan saat reset, input hidden juga kosong
        document.querySelector('button[type="reset"]').addEventListener('click', () => {
            inputRaw.value = '';
        });
    </script>

</body>
</html>
