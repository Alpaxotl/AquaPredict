<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - AquaPredict</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-obsidian min-h-screen flex items-center justify-center p-6 selection:bg-gold selection:text-obsidian">

    <div class="w-full max-w-md my-8">
        <!-- Logo/Title -->
        <div class="text-center mb-8">
            <a href="{{ route('landing') }}" class="text-gold text-3xl font-serif-heading font-semibold tracking-widest">AQUAPREDICT</a>
            <p class="text-gray-400 text-sm mt-2">Smart Fishing & Budidaya Air Tawar Cerdas</p>
        </div>

        <!-- Form Card -->
        <div class="glass-panel rounded-2xl p-8 border border-gold/10 shadow-2xl">
            <h2 class="text-2xl font-serif-heading text-white font-light mb-6">Pendaftaran Akun Baru</h2>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-gray-400 text-sm font-medium mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                        class="w-full bg-obsidian border @error('name') border-rose-500/50 @else border-gold/20 @enderror focus:border-gold rounded-lg px-4 py-2.5 text-white placeholder-gray-600 focus:outline-none transition-colors text-sm"
                        placeholder="Nama lengkap Anda" required>
                    @error('name')
                        <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-gray-400 text-sm font-medium mb-1">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                        class="w-full bg-obsidian border @error('email') border-rose-500/50 @else border-gold/20 @enderror focus:border-gold rounded-lg px-4 py-2.5 text-white placeholder-gray-600 focus:outline-none transition-colors text-sm"
                        placeholder="nama@email.com" required>
                    @error('email')
                        <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-gray-400 text-sm font-medium mb-1">Kata Sandi</label>
                    <input type="password" name="password" id="password" 
                        class="w-full bg-obsidian border @error('password') border-rose-500/50 @else border-gold/20 @enderror focus:border-gold rounded-lg px-4 py-2.5 text-white placeholder-gray-600 focus:outline-none transition-colors text-sm"
                        placeholder="Minimal 8 karakter" required>
                    @error('password')
                        <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-gray-400 text-sm font-medium mb-1">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                        class="w-full bg-obsidian border border-gold/20 focus:border-gold rounded-lg px-4 py-2.5 text-white placeholder-gray-600 focus:outline-none transition-colors text-sm"
                        placeholder="Ulangi kata sandi" required>
                </div>

                <button type="submit" class="w-full bg-gold hover:bg-gold-hover text-obsidian font-bold py-3 px-4 rounded-lg transition-all gold-glow mt-4 text-sm">
                    Daftar Akun
                </button>
            </form>

            <div class="border-t border-gold/5 mt-6 pt-6 text-center text-sm text-gray-400">
                Sudah memiliki akun? <a href="{{ route('login') }}" class="text-gold hover:underline">Masuk</a>
            </div>
        </div>
    </div>

</body>
</html>
