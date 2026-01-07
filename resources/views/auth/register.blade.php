<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership | The Stone Hotel Luxury</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                        },
                        dark: {
                            900: '#0f1115',
                            800: '#1a1d23',
                            700: '#2d3139',
                        }
                    },
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .luxury-title { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-dark-900 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full bg-dark-800 rounded-[2rem] shadow-2xl overflow-hidden border border-white/5 my-10">

        <div class="relative bg-gradient-to-b from-zinc-800 to-dark-800 p-10 text-center border-b border-gold-600/20">
            <h1 class="text-white text-3xl luxury-title tracking-[0.1em] uppercase italic">
                STONE<span class="text-gold-500 not-italic">MEMBERS</span>
            </h1>
            <p class="text-zinc-500 text-[10px] mt-3 tracking-[0.3em] uppercase font-light">Create Your Prestige Account</p>
        </div>

        <div class="p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-[10px] font-bold text-zinc-500 mb-2 uppercase tracking-[0.2em]">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-5 py-3 rounded-xl bg-dark-900/50 border border-zinc-800 text-white placeholder-zinc-700 focus:ring-1 focus:ring-gold-500 focus:border-gold-500 transition outline-none shadow-inner"
                        placeholder="Nama sesuai identitas">
                    @error('name')
                        <p class="text-red-400 text-[10px] mt-2 uppercase tracking-widest font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-[10px] font-bold text-zinc-500 mb-2 uppercase tracking-[0.2em]">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-5 py-3 rounded-xl bg-dark-900/50 border border-zinc-800 text-white placeholder-zinc-700 focus:ring-1 focus:ring-gold-500 focus:border-gold-500 transition outline-none shadow-inner"
                        placeholder="your@email.com">
                    @error('email')
                        <p class="text-red-400 text-[10px] mt-2 uppercase tracking-widest font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-[10px] font-bold text-zinc-500 mb-2 uppercase tracking-[0.2em]">Nomor Telepon</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required
                        class="w-full px-5 py-3 rounded-xl bg-dark-900/50 border border-zinc-800 text-white placeholder-zinc-700 focus:ring-1 focus:ring-gold-500 focus:border-gold-500 transition outline-none shadow-inner"
                        placeholder="0812xxxxxx">
                    @error('phone')
                        <p class="text-red-400 text-[10px] mt-2 uppercase tracking-widest font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-[10px] font-bold text-zinc-500 mb-2 uppercase tracking-[0.2em]">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                class="w-full px-5 py-3 rounded-xl bg-dark-900/50 border border-zinc-800 text-white placeholder-zinc-700 focus:ring-1 focus:ring-gold-500 focus:border-gold-500 transition outline-none shadow-inner"
                                placeholder="••••••••">
                            <button type="button" onclick="toggleVisibility('password', 'eye-pass')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-zinc-600 hover:text-gold-500 transition">
                                <svg id="eye-pass" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-[10px] font-bold text-zinc-500 mb-2 uppercase tracking-[0.2em]">Confirm</label>
                        <div class="relative">
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="w-full px-5 py-3 rounded-xl bg-dark-900/50 border border-zinc-800 text-white placeholder-zinc-700 focus:ring-1 focus:ring-gold-500 focus:border-gold-500 transition outline-none shadow-inner"
                                placeholder="••••••••">
                            <button type="button" onclick="toggleVisibility('password_confirmation', 'eye-conf')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-zinc-600 hover:text-gold-500 transition">
                                <svg id="eye-conf" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                @error('password')
                    <p class="text-red-400 text-[10px] mt-1 uppercase tracking-widest font-bold">{{ $message }}</p>
                @enderror

                <button type="submit"
                    class="w-full bg-gradient-to-r from-gold-600 to-gold-400 hover:from-gold-500 hover:to-gold-300 text-black font-extrabold py-4 rounded-xl shadow-[0_10px_20px_rgba(217,119,6,0.15)] transition-all transform active:scale-[0.97] uppercase tracking-[0.2em] text-xs mt-4">
                    Register Member
                </button>

                <div class="pt-6 text-center">
                    <p class="text-xs text-zinc-600 font-light italic">
                        Already a prestige member?
                        <a href="{{ route('login') }}" class="text-gold-500 font-bold hover:text-gold-400 transition ml-1 uppercase tracking-tighter not-italic underline decoration-gold-500/30">Login Here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.244 4.244M9.878 9.878L5.136 5.136m13.728 13.728L18.825 13.875M18.825 13.875A10.05 10.05 0 0012 5c-4.478 0-8.268 2.943-9.542 7a10.025 10.025 0 004.132 5.411m12.793-1.036L21 21m-2.175-2.175L5.136 5.136" />';
            } else {
                input.type = "password";
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }
    </script>

</body>
</html>
