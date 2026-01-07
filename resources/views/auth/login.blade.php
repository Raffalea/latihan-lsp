<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | The Stone Hotel Luxury</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: {
                            400: '#fbbf24',
                            500: '#f59e0b', // Warna Emas Utama
                            600: '#d97706',
                        },
                        dark: {
                            900: '#0f1115', // Background Hitam Pekat
                            800: '#1a1d23', // Warna Card
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

    <div class="max-w-md w-full bg-dark-800 rounded-[2rem] shadow-2xl overflow-hidden border border-white/5">

        <div class="relative bg-gradient-to-b from-zinc-800 to-dark-800 p-10 text-center border-b border-gold-600/20">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-24 h-1 bg-gold-500 rounded-b-full shadow-[0_0_15px_rgba(245,158,11,0.5)]"></div>

            <h1 class="text-white text-4xl luxury-title tracking-[0.1em] uppercase italic">
                STONE<span class="text-gold-500 not-italic">HOTEL</span>
            </h1>
            <p class="text-zinc-500 text-[10px] mt-3 tracking-[0.3em] uppercase font-light">The Pinnacle of Luxury</p>
        </div>

        <div class="p-8 sm:p-10">
            @if (session('status'))
                <div class="mb-6 font-medium text-sm text-gold-400 bg-gold-500/10 p-4 rounded-xl border border-gold-500/20">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-[10px] font-bold text-zinc-500 mb-2 uppercase tracking-[0.2em]">Alamat Email Premium</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-5 py-4 rounded-xl bg-dark-900/50 border border-zinc-800 text-white placeholder-zinc-700 focus:ring-1 focus:ring-gold-500 focus:border-gold-500 transition outline-none shadow-inner"
                        placeholder="guest@thestone.com">
                    @if($errors->has('email'))
                        <p class="text-red-400 text-xs mt-2">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <label for="password" class="block text-[10px] font-bold text-zinc-500 uppercase tracking-[0.2em]">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[10px] text-gold-500/70 hover:text-gold-500 transition uppercase tracking-widest">Lupa Password?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required
                        class="w-full px-5 py-4 rounded-xl bg-dark-900/50 border border-zinc-800 text-white placeholder-zinc-700 focus:ring-1 focus:ring-gold-500 focus:border-gold-500 transition outline-none shadow-inner"
                        placeholder="••••••••">
                    @if($errors->has('password'))
                        <p class="text-red-400 text-xs mt-2">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="w-4 h-4 rounded border-zinc-800 bg-zinc-900 text-gold-600 focus:ring-gold-500 focus:ring-offset-dark-900">
                    <label for="remember_me" class="ms-2 text-xs text-zinc-500 font-light">Biarkan saya tetap masuk</label>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-gold-600 to-gold-400 hover:from-gold-500 hover:to-gold-300 text-black font-extrabold py-4 rounded-xl shadow-[0_10px_20px_rgba(217,119,6,0.15)] transition-all transform active:scale-[0.97] uppercase tracking-[0.2em] text-xs">
                    Masuk Ke Lounge
                </button>

                <div class="pt-6 text-center">
                    <p class="text-xs text-zinc-600 font-light">
                        Belum menjadi member?
                        <a href="{{ route('register') }}" class="text-gold-500 font-bold hover:text-gold-400 transition ml-1 uppercase tracking-tighter">Daftar Sekarang</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
