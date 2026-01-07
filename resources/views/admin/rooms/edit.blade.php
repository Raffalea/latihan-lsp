<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Suite | The Stone Hotel</title>
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

    <nav class="bg-dark-800 border-b border-white/5 px-8 py-5 mb-10">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="luxury-title tracking-[0.2em] uppercase italic text-lg text-gold-500">
                THE STONE <span class="text-white not-italic text-xs tracking-widest ml-4">Editor</span>
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
                    Edit <span class="text-gold-500 not-italic">Suite</span>
                </h1>
                <p class="text-zinc-500 text-[10px] uppercase tracking-[0.4em] mt-3">Modifying Room #{{ $room->room_number }}</p>
            </div>

            <form action="{{ route('rooms.update', $room->id) }}" method="POST" class="p-10 space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black text-zinc-500 mb-3 uppercase tracking-[0.2em]">Room Number</label>
                        <input type="text" name="room_number" value="{{ old('room_number', $room->room_number) }}" required
                            class="w-full px-6 py-4 rounded-2xl bg-dark-900 border border-zinc-800 text-white focus:ring-1 focus:ring-gold-500 outline-none transition shadow-inner">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-zinc-500 mb-3 uppercase tracking-[0.2em]">Suite Category</label>
                        <select name="type" required
                            class="w-full px-6 py-4 rounded-2xl bg-dark-900 border border-zinc-800 text-white focus:ring-1 focus:ring-gold-500 outline-none appearance-none cursor-pointer">
                            <option value="Superior" {{ $room->type == 'Superior' ? 'selected' : '' }}>Superior Room</option>
                            <option value="Deluxe" {{ $room->type == 'Deluxe' ? 'selected' : '' }}>Deluxe Room</option>
                            <option value="Signature Suite" {{ $room->type == 'Signature Suite' ? 'selected' : '' }}>Signature Suite</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black text-zinc-500 mb-3 uppercase tracking-[0.2em]">Rate per Night</label>
                        <input type="number" name="price_per_night" value="{{ old('price_per_night', $room->price_per_night) }}" required
                            class="w-full px-6 py-4 rounded-2xl bg-dark-900 border border-zinc-800 text-gold-500 font-bold focus:ring-1 focus:ring-gold-500 outline-none transition shadow-inner">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-zinc-500 mb-3 uppercase tracking-[0.2em]">Availability</label>
                        <select name="status" required
                            class="w-full px-6 py-4 rounded-2xl bg-dark-900 border border-zinc-800 text-white focus:ring-1 focus:ring-gold-500 outline-none appearance-none cursor-pointer">
                            <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="booked" {{ $room->status == 'booked' ? 'selected' : '' }}>Booked</option>
                            <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-zinc-500 mb-3 uppercase tracking-[0.2em]">Facilities</label>
                    <textarea name="facilities" rows="4"
                        class="w-full px-6 py-4 rounded-2xl bg-dark-900 border border-zinc-800 text-white focus:ring-1 focus:ring-gold-500 outline-none transition shadow-inner">{{ old('facilities', $room->facilities) }}</textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-gradient-to-r from-gold-600 to-gold-400 hover:from-gold-500 hover:to-gold-300 text-black font-black py-5 rounded-2xl transition-all transform active:scale-95 uppercase tracking-widest text-[10px] shadow-[0_15px_30px_rgba(217,119,6,0.2)]">
                        Update Suite Information
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
