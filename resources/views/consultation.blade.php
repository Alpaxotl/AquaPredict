@extends('layouts.app')

@section('title', 'Panduan Budidaya')
@section('header_title', 'Panduan & Referensi Budidaya Air Tawar')

@section('content')
<div class="space-y-8 max-w-5xl">

    <!-- Intro Card -->
    <div class="bg-slate-card border border-gold/10 rounded-2xl p-7 flex gap-5 items-start">
        <div class="w-12 h-12 rounded-xl bg-gold/10 border border-gold/20 flex items-center justify-center text-gold shrink-0 mt-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
        </div>
        <div>
            <h2 class="text-xl font-serif-heading text-white mb-1">Referensi Operasional Budidaya Air Tawar</h2>
            <p class="text-sm text-gray-400 leading-relaxed">
                Kumpulan panduan teknis seputar pengelolaan kualitas air, penanganan kondisi kritis, dan praktik terbaik secara umum untuk budidaya air tawar intensif.
                Gunakan navigasi topik di bawah untuk menemukan panduan yang Anda butuhkan.
            </p>
        </div>
    </div>

    <!-- Quick Nav Chips -->
    <div class="flex flex-wrap gap-2">
        @php
        $navs = [
            ['id' => 'standar-parameter', 'label' => 'Standar Parameter Air'],
            ['id' => 'ph-alkalinitas', 'label' => 'pH & Alkalinitas'],
            ['id' => 'oksigen-aerasi', 'label' => 'Oksigen & Aerasi'],
            ['id' => 'suhu', 'label' => 'Pengelolaan Suhu'],
            ['id' => 'bioflok', 'label' => 'Sistem Bioflok'],
            ['id' => 'penyakit', 'label' => 'Deteksi & Penanganan Awal'],
            ['id' => 'pakan', 'label' => 'Manajemen Pakan'],
        ];
        @endphp
        @foreach($navs as $nav)
            <a href="#{{ $nav['id'] }}" class="text-xs text-gold border border-gold/25 hover:bg-gold hover:text-obsidian px-4 py-2 rounded-full transition-all font-medium">
                {{ $nav['label'] }}
            </a>
        @endforeach
    </div>

    <!-- ===================== SECTION 1: STANDAR PARAMETER ===================== -->
    <section id="standar-parameter">
        <div class="flex items-center gap-3 mb-5">
            <span class="w-1 h-6 bg-gold rounded-full"></span>
            <h3 class="text-lg font-serif-heading text-white">Standar Parameter Kualitas Air Umum</h3>
        </div>

        <div class="bg-slate-card border border-gold/10 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-obsidian/40 border-b border-gold/10">
                        <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-widest text-gray-400">Parameter</th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-widest text-gray-400">Rentang Optimal</th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-widest text-gray-400">Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gold/5">
                    @php $params = [
                        ['Derajat Keasaman (pH)', '6.5 – 8.5', 'Stabilkan agar tidak fluktuatif'],
                        ['Suhu Air', '25 – 32 °C', 'Hindari perubahan mendadak'],
                        ['Oksigen Terlarut (DO)', '≥ 3.0 – 4.0 mg/L', 'Wajib aerasi intensif'],
                        ['Amonia (NH₃)', '< 0.02 mg/L', 'Toksik jika melebihi batas'],
                        ['Alkalinitas', '75 – 150 mg/L', 'Sebagai buffer pH harian']
                    ]; @endphp
                    @foreach($params as $p)
                        <tr class="hover:bg-gold/[0.02] transition-colors">
                            <td class="px-5 py-4 text-gray-300 font-medium">{{ $p[0] }}</td>
                            <td class="px-5 py-4 font-mono-data text-gold font-bold">{{ $p[1] }}</td>
                            <td class="px-5 py-4 text-gray-500 text-xs">{{ $p[2] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- ===================== SECTION 2: pH ===================== -->
    <section id="ph-alkalinitas">
        <div class="flex items-center gap-3 mb-5">
            <span class="w-1 h-6 bg-gold rounded-full"></span>
            <h3 class="text-lg font-serif-heading text-white">Panduan Pengelolaan pH & Alkalinitas</h3>
        </div>
        <div class="space-y-3">
            @php
            $phFaqs = [
                ['q' => 'Apa yang terjadi jika pH air kolam terlalu asam (< 6.5)?', 'a' => 'Air asam menyebabkan stres fisiologis pada ikan karena ion hidrogen berlebih mengganggu keseimbangan osmotik. Gejala: ikan berenang tidak beraturan di permukaan, nafsu makan menurun drastis, dan insang berlendir berlebih. Kondisi ekstrem (pH < 5.5) dapat memicu kematian massal dalam 24–48 jam.', 'tag' => 'Kritis'],
                ['q' => 'Bagaimana cara menaikkan pH air kolam yang terlalu asam?', 'a' => 'Tambahkan kapur pertanian (kalsit/dolomit). Dosis rekomendasi: 10–20 gram/m³ untuk kenaikan pH sebesar 0.2–0.5 unit. Taburkan merata di seluruh permukaan kolam di pagi hari dan ukur ulang pH setelah 6–8 jam. Jangan menaikkan pH lebih dari 0.5 unit per hari agar ikan tidak syok osmotik.', 'tag' => 'Tindakan'],
                ['q' => 'Mengapa pH fluktuatif antara pagi dan sore hari?', 'a' => 'Ini adalah fenomena normal akibat fotosintesis fitoplankton. Pada siang hari, fitoplankton menyerap CO₂ sehingga pH naik (bisa hingga 9.5 saat puncak). Pada malam hari, respirasi menghasilkan CO₂ kembali sehingga pH turun. Fluktuasi > 1.0 unit per hari menandakan kepadatan plankton yang berlebih — lakukan pergantian air 10–20%.', 'tag' => 'Normal'],
                ['q' => 'Apa fungsi alkalinitas dan mengapa perlu dijaga di 75–150 mg/L?', 'a' => 'Alkalinitas adalah kapasitas air untuk menetralkan asam (kemampuan buffer). Air dengan alkalinitas rendah (< 50 mg/L) sangat rentan terhadap perubahan pH mendadak akibat hujan atau aktivitas biologis. Kapur dolomit (MgCO₃·CaCO₃) adalah cara efektif meningkatkan alkalinitas sekaligus menyediakan kalsium dan magnesium untuk biota air.', 'tag' => 'Info'],
            ];
            @endphp
            @foreach($phFaqs as $faq)
                <div x-data="{ open: false }" class="bg-slate-card border border-gold/10 rounded-xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-gold/[0.03] transition-colors">
                        <div class="flex items-start gap-3">
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded mt-0.5 shrink-0
                                {{ $faq['tag'] === 'Kritis' ? 'bg-rose-500/10 text-rose-400 border border-rose-500/20' : '' }}
                                {{ $faq['tag'] === 'Tindakan' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : '' }}
                                {{ $faq['tag'] === 'Normal' ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20' : '' }}
                                {{ $faq['tag'] === 'Info' ? 'bg-gold/10 text-gold border border-gold/20' : '' }}">
                                {{ $faq['tag'] }}
                            </span>
                            <span class="text-sm font-medium text-gray-200">{{ $faq['q'] }}</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gold shrink-0 ml-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="px-5 pb-5 border-t border-gold/5">
                        <p class="text-sm text-gray-400 leading-relaxed mt-4">{{ $faq['a'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ===================== SECTION 3: OKSIGEN ===================== -->
    <section id="oksigen-aerasi">
        <div class="flex items-center gap-3 mb-5">
            <span class="w-1 h-6 bg-gold rounded-full"></span>
            <h3 class="text-lg font-serif-heading text-white">Panduan Pengelolaan Oksigen Terlarut & Aerasi</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @php
            $doCards = [
                ['icon' => '🫧', 'title' => 'Mengapa DO < 3 mg/L Berbahaya?', 'color' => 'rose', 'body' => 'Di bawah 3 mg/L, ikan mengalami hipoksia akuatik. Gejala klinis: ikan mengumpul di permukaan dan berkumpul di sekitar inlet aerator (menghirup udara langsung). Aktivitas enzim metabolisme melambat drastis, konversi pakan (FCR) memburuk, dan imunitas ikan turun sehingga rentan penyakit. Kematian massal dimulai saat DO < 1.5 mg/L.'],
                ['icon' => '⚡', 'title' => 'Tindakan Darurat Saat DO Kritis', 'color' => 'amber', 'body' => 'Nyalakan seluruh aerator cadangan segera. Hentikan pemberian pakan agar beban organik tidak bertambah. Jika memungkinkan, tambahkan air bersih segar dari sumber yang memiliki DO tinggi. Sebagai pertolongan pertama, tuangkan air dengan ember dari ketinggian untuk memasukkan oksigen secara mekanik. Kurangi kepadatan tebar jika terjadi berulang.'],
                ['icon' => '🌙', 'title' => 'Kenapa DO Rendah di Malam Hari?', 'color' => 'blue', 'body' => 'Pada malam hari, seluruh organisme hidup di kolam (ikan, plankton, bakteri) mengonsumsi oksigen melalui respirasi, tetapi tidak ada fotosintesis yang menghasilkan O₂. Titik DO terendah terjadi sekitar pukul 04.00–06.00 pagi. Pastikan aerator berjalan dengan kapasitas penuh di malam hari, terutama saat cuaca mendung atau hujan.'],
                ['icon' => '📐', 'title' => 'Berapa Kapasitas Aerator yang Dibutuhkan?', 'color' => 'emerald', 'body' => 'Aturan umum: 1 unit kincir air dengan daya 1 HP mampu menghasilkan oksigen setara kebutuhan 200–300 kg biomassa ikan. Untuk kolam bioflok intensif, pasang aerator dengan daya minimal 2–3 HP per 100 m² kolam. Selalu sediakan aerator cadangan (minimal 50% kapasitas total) untuk situasi darurat pemadaman listrik.'],
            ];
            @endphp
            @foreach($doCards as $card)
                <div class="bg-slate-card border border-gold/10 rounded-xl p-5">
                    <div class="flex items-start gap-3 mb-3">
                        <span class="text-2xl">{{ $card['icon'] }}</span>
                        <h4 class="font-semibold text-sm text-white leading-tight">{{ $card['title'] }}</h4>
                    </div>
                    <p class="text-xs text-gray-400 leading-relaxed">{{ $card['body'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ===================== SECTION 4: SUHU ===================== -->
    <section id="suhu">
        <div class="flex items-center gap-3 mb-5">
            <span class="w-1 h-6 bg-gold rounded-full"></span>
            <h3 class="text-lg font-serif-heading text-white">Pengelolaan Suhu Air Kolam</h3>
        </div>
        <div class="bg-slate-card border border-gold/10 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-obsidian/40 border-b border-gold/10">
                        <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-widest text-gray-400">Kondisi Suhu</th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-widest text-gray-400">Dampak pada Ikan</th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-widest text-gray-400">Tindakan yang Disarankan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gold/5">
                    @php $suhuRows = [
                        ['< 22°C', 'Metabolisme sangat lambat, nafsu makan hilang, rentan penyakit jamur (terutama Gurame)', 'Pasang jaring penutup kolam (terpal), kurangi volume pakan 50%, tunda penebaran benih baru'],
                        ['22–25°C', 'Pertumbuhan di bawah optimal, konversi pakan (FCR) memburuk', 'Minimalkan pergantian air, manfaatkan sinar matahari (buka tutup kolam di siang hari)'],
                        ['25–32°C', 'Zona optimal mayoritas komoditas — pertumbuhan dan konversi pakan terbaik', 'Pertahankan kondisi ini, pantau DO secara rutin karena air hangat menyimpan lebih sedikit oksigen'],
                        ['> 32°C', 'Stres termal, konsumsi oksigen melonjak tajam, resiko hipoksia massal', 'Tambahkan air bersih dingin secara bertahap, pasang paranet/shading net 50–60%, tingkatkan aerasi'],
                        ['> 35°C', 'Zona letal untuk semua komoditas — kematian massal sangat mungkin terjadi', 'Tindakan darurat: pompa air tanah, panen dini sebagian populasi untuk kurangi kepadatan'],
                    ]; @endphp
                    @foreach($suhuRows as $row)
                        <tr class="hover:bg-gold/[0.02] transition-colors">
                            <td class="px-5 py-4 font-mono-data text-gold text-sm font-bold">{{ $row[0] }}</td>
                            <td class="px-5 py-4 text-xs text-gray-400 leading-relaxed">{{ $row[1] }}</td>
                            <td class="px-5 py-4 text-xs text-gray-300 leading-relaxed">{{ $row[2] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- ===================== SECTION 5: BIOFLOK ===================== -->
    <section id="bioflok">
        <div class="flex items-center gap-3 mb-5">
            <span class="w-1 h-6 bg-gold rounded-full"></span>
            <h3 class="text-lg font-serif-heading text-white">Panduan Sistem Bioflok</h3>
        </div>
        <div class="space-y-3">
            @php
            $bioflokFaqs = [
                ['q' => 'Apa itu teknologi Bioflok dan bagaimana cara kerjanya?', 'a' => 'Bioflok adalah teknologi budidaya intensif berbasis komunitas mikrobial (bakteri heterotrof, alga, protozoa) yang mengolah limbah nitrogen dari sisa pakan dan kotoran ikan menjadi biomassa protein yang dapat dimakan kembali oleh ikan. Bakteri mengonsumsi amonia dengan memanfaatkan karbon dari sumber tambahan (molase, tepung terigu), menghasilkan agregat flok berukuran 0.1–1.0 mm yang kaya protein (25–40%).', 'tag' => 'Dasar'],
                ['q' => 'Mengapa rasio C:N (Karbon:Nitrogen) sangat penting dalam sistem Bioflok?', 'a' => 'Bakteri heterotrof membutuhkan rasio C:N sekitar 20:1 untuk tumbuh optimal. Pakan ikan memiliki rasio C:N sekitar 5:1, sehingga perlu penambahan sumber karbon eksternal. Cara menghitung kebutuhan karbon tambahan: (N dari pakan × 20 - C dari pakan) = karbon yang perlu ditambahkan. Sumber karbon yang umum digunakan: molase (karbon ~30%), tepung terigu (~40%), atau tapioka (~35%).', 'tag' => 'Teknis'],
                ['q' => 'Bagaimana cara mengelola Volume Flok (FVI) agar tetap optimal?', 'a' => 'Volume Flok Ideal (FVI) untuk Lele Bioflok adalah 5–15 mL/L. Cara pengukuran: ambil 1 liter air kolam, masukkan ke Imhoff cone, diamkan 15–30 menit, baca volume endapan. Jika FVI > 15 mL/L: hentikan penambahan karbon selama 2–3 hari, lakukan pergantian air 20–30%, kurangi pakan 30%. Jika FVI < 5 mL/L: tambah dosis karbon harian.', 'tag' => 'Manajemen'],
                ['q' => 'Kenapa aerasi sangat intensif wajib dalam sistem Bioflok?', 'a' => 'Dalam kolam bioflok, komunitas bakteri membutuhkan oksigen sangat besar untuk proses nitrifikasi dan pertumbuhan. Kepadatan bakteri yang tinggi bersama kepadatan ikan yang intensif menciptakan konsumsi oksigen yang jauh lebih besar dari kolam konvensional. DO di bawah 3 mg/L akan mematikan komunitas bakteri bioflok dalam beberapa jam — aerasi tidak boleh mati sekalipun.', 'tag' => 'Kritis'],
            ];
            @endphp
            @foreach($bioflokFaqs as $faq)
                <div x-data="{ open: false }" class="bg-slate-card border border-gold/10 rounded-xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-gold/[0.03] transition-colors">
                        <div class="flex items-start gap-3">
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded mt-0.5 shrink-0
                                {{ $faq['tag'] === 'Kritis' ? 'bg-rose-500/10 text-rose-400 border border-rose-500/20' : '' }}
                                {{ $faq['tag'] === 'Teknis' ? 'bg-purple-500/10 text-purple-400 border border-purple-500/20' : '' }}
                                {{ $faq['tag'] === 'Dasar' ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20' : '' }}
                                {{ $faq['tag'] === 'Manajemen' ? 'bg-gold/10 text-gold border border-gold/20' : '' }}">
                                {{ $faq['tag'] }}
                            </span>
                            <span class="text-sm font-medium text-gray-200">{{ $faq['q'] }}</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gold shrink-0 ml-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="px-5 pb-5 border-t border-gold/5">
                        <p class="text-sm text-gray-400 leading-relaxed mt-4">{{ $faq['a'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ===================== SECTION 6: PENYAKIT ===================== -->
    <section id="penyakit">
        <div class="flex items-center gap-3 mb-5">
            <span class="w-1 h-6 bg-gold rounded-full"></span>
            <h3 class="text-lg font-serif-heading text-white">Deteksi Dini & Penanganan Awal Gangguan Kolam</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @php
            $alerts = [
                ['title' => 'Ikan Berkumpul di Permukaan', 'level' => 'Kritis', 'color' => 'rose', 'cause' => 'Kekurangan Oksigen Terlarut (DO rendah)', 'action' => 'Nyalakan semua aerator. Hentikan pemberian pakan. Alirkan air segar. Ukur DO segera.'],
                ['title' => 'Ikan Berenang Tidak Beraturan', 'level' => 'Kritis', 'color' => 'rose', 'cause' => 'pH ekstrem (terlalu asam atau basa) atau keracunan amonia', 'action' => 'Ukur pH dan amonia segera. Lakukan pergantian air 20–30%. Berikan kapur dolomit jika asam.'],
                ['title' => 'Warna Air Hijau Pekat', 'level' => 'Atensi', 'color' => 'amber', 'cause' => 'Ledakan populasi fitoplankton (algae bloom)', 'action' => 'Ganti air 20–30%. Pasang aerator tambahan. Kurangi pakan. Pantau pH di sore hari (bisa > 9.5).'],
                ['title' => 'Air Berbau Busuk / H₂S', 'level' => 'Kritis', 'color' => 'rose', 'cause' => 'Akumulasi sisa pakan dan kotoran di dasar kolam — anaerob', 'action' => 'Siphon dasar kolam. Ganti air 30%. Tambahkan probiotik Bacillus sp. Tingkatkan aerasi dasar.'],
                ['title' => 'Nafsu Makan Menurun Tiba-tiba', 'level' => 'Atensi', 'color' => 'amber', 'cause' => 'Perubahan suhu mendadak, DO rendah, atau awal infeksi penyakit', 'action' => 'Ukur semua parameter. Kurangi pakan 50%. Amati perilaku ikan 24 jam ke depan.'],
                ['title' => 'Busa di Permukaan Kolam', 'level' => 'Info', 'color' => 'blue', 'cause' => 'Protein organik tinggi dari sisa pakan atau lendir ikan (umum di bioflok)', 'action' => 'Normalnya tidak berbahaya. Jika berlebih: kurangi pakan, tambah aerasi, cek DO dan amonia.'],
            ];
            @endphp
            @foreach($alerts as $alert)
                <div class="bg-slate-card border border-gold/10 rounded-xl p-5">
                    <div class="flex items-start justify-between mb-3">
                        <h4 class="font-semibold text-sm text-white leading-tight pr-2">{{ $alert['title'] }}</h4>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded shrink-0
                            {{ $alert['color'] === 'rose' ? 'bg-rose-500/10 text-rose-400 border border-rose-500/20' : '' }}
                            {{ $alert['color'] === 'amber' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : '' }}
                            {{ $alert['color'] === 'blue' ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20' : '' }}">
                            {{ $alert['level'] }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 mb-2"><span class="text-gold">Kemungkinan:</span> {{ $alert['cause'] }}</p>
                    <p class="text-xs text-gray-300 bg-obsidian/50 rounded-lg p-3 border border-gold/5 leading-relaxed"><span class="text-gold font-semibold">Tindakan:</span> {{ $alert['action'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ===================== SECTION 7: PAKAN ===================== -->
    <section id="pakan">
        <div class="flex items-center gap-3 mb-5">
            <span class="w-1 h-6 bg-gold rounded-full"></span>
            <h3 class="text-lg font-serif-heading text-white">Manajemen Pakan yang Efisien</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-slate-card border border-gold/10 rounded-xl p-6 space-y-4">
                <h4 class="font-semibold text-white text-sm">Prinsip Pemberian Pakan yang Baik</h4>
                @php $tips = [
                    ['Frekuensi 3–4x sehari', 'Lebih sering dengan porsi kecil lebih baik dari 1–2x besar. Mencegah sisa pakan mengendap.'],
                    ['Metode At Satiation', 'Beri makan hingga ikan tidak merespons lagi (kenyang) untuk menghindari overfeeding sistematis.'],
                    ['Hentikan saat DO < 3 mg/L', 'Pakan yang tidak termakan akan meningkatkan beban organik dan memperburuk kekurangan oksigen.'],
                    ['Pagi & Sore Lebih Aktif', 'Nafsu makan ikan tertinggi pada pukul 07.00–09.00 dan 16.00–18.00. Hindari pemberian malam hari.'],
                ]; @endphp
                @foreach($tips as $tip)
                    <div class="flex gap-3 border-b border-gold/5 pb-3 last:border-0 last:pb-0">
                        <span class="w-1.5 h-1.5 rounded-full bg-gold mt-1.5 shrink-0"></span>
                        <div>
                            <p class="text-xs font-semibold text-white">{{ $tip[0] }}</p>
                            <p class="text-xs text-gray-500 leading-relaxed mt-0.5">{{ $tip[1] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="bg-slate-card border border-gold/10 rounded-xl p-6">
                <h4 class="font-semibold text-white text-sm mb-4">Interpretasi Feed Conversion Ratio (FCR)</h4>
                <div class="space-y-3">
                    @php $fcr = [
                        ['< 1.0', 'emerald', 'Sangat Efisien', 'Pertumbuhan sangat cepat. Biasanya hanya dicapai saat kondisi air dan pakan sempurna.'],
                        ['1.0 – 1.5', 'emerald', 'Baik', 'Target FCR ideal untuk Lele dan Nila pada sistem intensif yang dikelola dengan baik.'],
                        ['1.5 – 2.0', 'amber', 'Cukup', 'Masih bisa diterima. Evaluasi kualitas pakan, suhu air, dan kepadatan tebar.'],
                        ['> 2.0', 'rose', 'Buruk', 'Indikasi masalah serius: kualitas air buruk, pakan kadaluarsa, atau penyakit subklinis.'],
                    ]; @endphp
                    @foreach($fcr as $f)
                        <div class="flex items-start gap-3">
                            <span class="font-mono-data text-sm font-bold w-16 shrink-0
                                {{ $f[1] === 'emerald' ? 'text-emerald-400' : '' }}
                                {{ $f[1] === 'amber' ? 'text-amber-400' : '' }}
                                {{ $f[1] === 'rose' ? 'text-rose-400' : '' }}">{{ $f[0] }}</span>
                            <div>
                                <p class="text-xs font-semibold text-white">{{ $f[2] }}</p>
                                <p class="text-xs text-gray-500">{{ $f[3] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Back to top -->
    <div class="text-center pt-4 pb-2">
        <a href="#" class="text-xs text-gold/60 hover:text-gold transition-colors">↑ Kembali ke atas</a>
    </div>

</div>

<script src="//unpkg.com/alpinejs" defer></script>
@endsection
