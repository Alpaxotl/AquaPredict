<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AquaPredict - Smart Fishing & Budidaya Air Tawar Cerdas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-obsidian min-h-screen flex flex-col justify-between selection:bg-gold selection:text-obsidian">

    <!-- Header / Nav -->
    <header class="border-b border-gold/10 bg-slate-card/50 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <span class="text-gold text-2xl font-serif-heading font-semibold tracking-wider">AQUAPREDICT</span>
            </div>
            <div>
                <a href="{{ route('login') }}" class="text-gold/90 hover:text-gold border border-gold/25 hover:border-gold px-5 py-2 rounded-lg font-medium transition-all text-sm">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="bg-gold hover:bg-gold-hover text-obsidian px-5 py-2 rounded-lg font-semibold ml-3 transition-all text-sm gold-glow">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="flex-grow flex items-center">
        <div class="max-w-7xl mx-auto px-6 py-12 md:py-24 grid md:grid-cols-2 gap-12 items-center w-full">
            <div>
                <span class="text-gold text-sm font-semibold tracking-widest uppercase">Sistem Monitoring Kualitas Air Cerdas</span>
                <h1 class="text-4xl md:text-6xl font-serif-heading text-white font-light mt-3 leading-tight">
                    Optimalkan Hasil Budidaya dengan <span class="text-gold font-normal">Analisis Presisi</span> Kualitas Air.
                </h1>
                <p class="text-gray-400 mt-6 leading-relaxed text-lg max-w-lg">
                    Sistem pemantauan kualitas air kolam masa depan yang mengintegrasikan monitoring sensor real-time dengan model keputusan biologis cerdas.
                </p>
                <div class="mt-8 flex space-x-4">
                    <a href="{{ route('login') }}" class="bg-gold hover:bg-gold-hover text-obsidian px-8 py-3.5 rounded-lg font-bold transition-all gold-glow">
                        Buka Dashboard
                    </a>
                    <a href="#fitur" class="text-gray-300 hover:text-white border border-gray-700 hover:border-gray-500 px-8 py-3.5 rounded-lg font-medium transition-all">
                        Pelajari Fitur
                    </a>
                </div>
            </div>
            <div class="relative flex justify-center">
                <!-- Visual Card Mockup -->
                <div class="glass-panel w-full max-w-md rounded-2xl p-6 shadow-2xl relative z-10 border border-gold/20">
                    <div class="flex justify-between items-center border-b border-gold/10 pb-4 mb-4">
                        <div>
                            <p class="text-xs text-gray-500">Live Status Kolam</p>
                            <h4 class="text-white font-medium text-lg">Kolam Nila Utama</h4>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Optimal</span>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center bg-obsidian/50 p-3 rounded-lg border border-gold/5">
                            <span class="text-gray-400 text-sm">Derajat Keasaman (pH)</span>
                            <span class="font-mono-data text-gold text-lg font-semibold">7.20 pH</span>
                        </div>
                        <div class="flex justify-between items-center bg-obsidian/50 p-3 rounded-lg border border-gold/5">
                            <span class="text-gray-400 text-sm">Suhu Air</span>
                            <span class="font-mono-data text-gold text-lg font-semibold">27.50 °C</span>
                        </div>
                        <div class="flex justify-between items-center bg-obsidian/50 p-3 rounded-lg border border-gold/5">
                            <span class="text-gray-400 text-sm">Oksigen Terlarut (DO)</span>
                            <span class="font-mono-data text-gold text-lg font-semibold">5.20 mg/L</span>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-4 leading-relaxed bg-gold/5 p-3 rounded border border-gold/10">
                        <strong>Mitigasi Nyata:</strong> Kondisi air kolam terpantau sangat baik dan optimal. Pertahankan pengelolaan pakan serta sirkulasi air rutin.
                    </p>
                </div>
                <!-- Background decoration glow -->
                <div class="absolute w-72 h-72 bg-gold/5 rounded-full blur-3xl -top-10 -right-10 z-0"></div>
            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section id="fitur" class="py-16 border-t border-gold/5 bg-slate-card/20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-gold text-xs font-semibold tracking-widest uppercase">Keunggulan Utama</span>
                <h2 class="text-3xl font-serif-heading text-white font-light mt-2">Didesain Khusus untuk Efisiensi Tambak Anda</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-slate-card/60 border border-gold/5 p-8 rounded-xl hover:border-gold/20 transition-all group">
                    <div class="w-12 h-12 rounded-lg bg-gold/10 flex items-center justify-center text-gold mb-6 group-hover:bg-gold group-hover:text-obsidian transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                    </div>
                    <h3 class="text-xl font-serif-heading text-white mb-3">Monitoring Telemetri</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Pencatatan data kualitas air harian (pH, Suhu, Oksigen Terlarut) dari setiap kolam budidaya secara rapi dan terorganisir.
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="bg-slate-card/60 border border-gold/5 p-8 rounded-xl hover:border-gold/20 transition-all group">
                    <div class="w-12 h-12 rounded-lg bg-gold/10 flex items-center justify-center text-gold mb-6 group-hover:bg-gold group-hover:text-obsidian transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 9.172V5L8 4z" /></svg>
                    </div>
                    <h3 class="text-xl font-serif-heading text-white mb-3">Analisis Kelayakan Air</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Analisis kelayakan otomatis yang disesuaikan dengan threshold biologis untuk menghasilkan saran mitigasi instan di lapangan.
                    </p>
                </div>
                <!-- Card 3 -->
                <div class="bg-slate-card/60 border border-gold/5 p-8 rounded-xl hover:border-gold/20 transition-all group">
                    <div class="w-12 h-12 rounded-lg bg-gold/10 flex items-center justify-center text-gold mb-6 group-hover:bg-gold group-hover:text-obsidian transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                    </div>
                    <h3 class="text-xl font-serif-heading text-white mb-3">Konsultasi Budidaya</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Layanan konsultasi luring berbasis pakar untuk menjawab kendala operasional kolam, alkalinitas, dosis dolomit, hingga sistem bioflok.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gold/10 bg-slate-card py-6 text-center text-gray-500 text-xs">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
            <p>&copy; 2026 AquaPredict. Proyek Akhir Pemrograman Web Framework. All rights reserved.</p>
            <p class="mt-2 md:mt-0">Sistem Pemantauan & Analisis Kualitas Air Kolam Budidaya</p>
        </div>
    </footer>

</body>
</html>
