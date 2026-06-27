<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - AquaPredict</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-obsidian min-h-screen flex items-center justify-center p-6 selection:bg-gold selection:text-obsidian">

    <div class="w-full max-w-md">
        <!-- Logo/Title -->
        <div class="text-center mb-8">
            <a href="{{ route('landing') }}" class="text-gold text-3xl font-serif-heading font-semibold tracking-widest">AQUAPREDICT</a>
            <p class="text-gray-400 text-sm mt-2">Smart Fishing & Budidaya Air Tawar Cerdas</p>
        </div>

        <!-- Form Card -->
        <div class="glass-panel rounded-2xl p-8 border border-gold/10 shadow-2xl">
            <h2 class="text-2xl font-serif-heading text-white font-light mb-6">Masuk Ke Akun Anda</h2>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm rounded-lg p-4 mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Alert -->
            @if(session('error'))
                <div class="bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm rounded-lg p-4 mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-gray-400 text-sm font-medium mb-1.5">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                        class="w-full bg-obsidian border @error('email') border-rose-500/50 @else border-gold/20 @enderror focus:border-gold rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none transition-colors text-sm"
                        placeholder="nama@email.com" required>
                    @error('email')
                        <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between mb-1.5">
                        <label for="password" class="block text-gray-400 text-sm font-medium">Kata Sandi</label>
                    </div>
                    <input type="password" name="password" id="password" 
                        class="w-full bg-obsidian border @error('password') border-rose-500/50 @else border-gold/20 @enderror focus:border-gold rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none transition-colors text-sm"
                        placeholder="••••••••" required>
                    @error('password')
                        <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-gold hover:bg-gold-hover text-obsidian font-bold py-3.5 px-4 rounded-lg transition-all gold-glow mt-4">
                    Masuk
                </button>
            </form>

            <div class="border-t border-gold/5 mt-8 pt-6 text-center text-sm text-gray-400">
                Belum memiliki akun? <a href="{{ route('register') }}" class="text-gold hover:underline">Daftar sekarang</a>
            </div>

            <!-- Demo Credentials Helper -->
            <div class="mt-6 p-4 bg-gold/5 rounded-lg border border-gold/10 text-xs text-gray-400 space-y-1 leading-relaxed">
                <span class="font-semibold text-gold block mb-1">Akun Uji Coba (Demo):</span>
                <div>• Admin: <code class="font-mono-data text-white">admin@aquapredict.com</code> / <code class="font-mono-data text-white">password</code></div>
                <div>• Petani: <code class="font-mono-data text-white">petani@aquapredict.com</code> / <code class="font-mono-data text-white">password</code></div>
            </div>
        </div>
    </div>

</body>
</html>
