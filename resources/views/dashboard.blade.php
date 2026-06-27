@extends('layouts.app')

@section('title', 'Dashboard Utama')
@section('header_title', 'Ringkasan Telemetri Kolam')

@push('head')
<style>
.stat-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(197,160,89,0.08); }
</style>
@endpush

@section('content')
<div class="space-y-8">

    <!-- Overview Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
        <!-- Stat Card 1 -->
        <div class="stat-card bg-slate-card border border-gold/10 p-6 rounded-2xl relative overflow-hidden border-t-2 border-t-gold/30">
            <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold">Total Kolam Aktif</p>
            <h3 class="text-4xl font-serif-heading text-white mt-3 font-semibold leading-none">{{ $totalPonds }}</h3>
            <span class="text-[10px] text-gold mt-2 block">Data telemetri kolam</span>
        </div>
        <!-- Stat Card 2 -->
        <div class="stat-card bg-slate-card border border-gold/10 p-6 rounded-2xl relative overflow-hidden border-t-2 border-t-gold/30">
            <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold">Rerata pH Air</p>
            <h3 class="text-4xl font-mono-data text-gold mt-3 font-semibold leading-none">{{ number_format($avgPh, 2) }}</h3>
            <span class="text-[10px] text-gray-500 mt-2 block">Nilai tengah seluruh kolam</span>
        </div>
        <!-- Stat Card 3 -->
        <div class="stat-card bg-slate-card border border-gold/10 p-6 rounded-2xl relative overflow-hidden border-t-2 border-t-gold/30">
            <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold">Rerata Suhu</p>
            <h3 class="text-4xl font-mono-data text-gold mt-3 font-semibold leading-none">{{ number_format($avgTemp, 1) }}<span class="text-xl text-gold/60 ml-1">°C</span></h3>
            <span class="text-[10px] text-gray-500 mt-2 block">Target suhu ideal biota air</span>
        </div>
        <!-- Stat Card 4 -->
        <div class="stat-card bg-slate-card border border-gold/10 p-6 rounded-2xl relative overflow-hidden border-t-2 border-t-gold/30">
            <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold">Rerata DO</p>
            <h3 class="text-4xl font-mono-data text-gold mt-3 font-semibold leading-none">{{ number_format($avgDo, 2) }}<span class="text-xl text-gold/60 ml-1">mg/L</span></h3>
            <span class="text-[10px] text-gray-500 mt-2 block">Batas kelayakan respirasi</span>
        </div>
    </div>

    <!-- Status & Simulation Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Status Distribution -->
        <div class="bg-slate-card border border-gold/5 p-6 rounded-xl md:col-span-1">
            <h3 class="text-lg font-serif-heading text-white mb-6">Status Kelayakan Kolam</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-400 flex items-center"><span class="w-3 h-3 rounded-full bg-emerald-500 mr-2.5"></span>Optimal</span>
                    <span class="font-mono-data font-bold text-emerald-400 bg-emerald-500/5 border border-emerald-500/20 px-3 py-1 rounded">{{ $optimalCount }} Kolam</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-400 flex items-center"><span class="w-3 h-3 rounded-full bg-amber-500 mr-2.5"></span>Atensi</span>
                    <span class="font-mono-data font-bold text-amber-400 bg-amber-500/5 border border-amber-500/20 px-3 py-1 rounded">{{ $atensiCount }} Kolam</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-400 flex items-center"><span class="w-3 h-3 rounded-full bg-rose-500 mr-2.5"></span>Kritis</span>
                    <span class="font-mono-data font-bold text-rose-400 bg-rose-500/5 border border-rose-500/20 px-3 py-1 rounded">{{ $kritisCount }} Kolam</span>
                </div>
            </div>
            <div class="border-t border-gold/5 mt-6 pt-5">
                <p class="text-xs text-gray-500 leading-relaxed">
                    Sistem otomatis menandai status kolam berdasarkan ambang parameter aman.
                </p>
            </div>
        </div>

        <!-- Telemetry Simulator Controls -->
        <div class="bg-slate-card border border-gold/5 p-6 rounded-xl md:col-span-2">
            <h3 class="text-lg font-serif-heading text-white mb-4">Telemetry Stream Simulator</h3>
            <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                Gunakan simulator sensor untuk mengirimkan atau menguji riak data kualitas air harian ke sistem log secara langsung.
            </p>
            <div class="grid grid-cols-3 gap-4">
                <button onclick="fillSimulator({ph: 7.2, temp: 28.0, do: 5.5, turbidity: 20.0, bod: 2.0, co2: 5.0, alkalinity: 100.0, hardness: 100.0, calcium: 50.0, ammonia: 0.05, nitrite: 0.01, phosphorus: 0.01, h2s: 0.001, plankton: 5000.0})" class="border border-emerald-500/20 hover:border-emerald-500/50 bg-emerald-500/5 p-4 rounded-xl text-center transition-all group">
                    <span class="text-xs text-emerald-400 font-bold block mb-1">SKENARIO IDEAL</span>
                    <span class="text-[10px] text-gray-500 font-mono-data">pH 7.2 | 28°C | DO 5.5</span>
                </button>
                <button onclick="fillSimulator({ph: 5.5, temp: 26.0, do: 4.2, turbidity: 50.0, bod: 8.0, co2: 20.0, alkalinity: 50.0, hardness: 80.0, calcium: 40.0, ammonia: 0.2, nitrite: 0.05, phosphorus: 0.1, h2s: 0.01, plankton: 2000.0})" class="border border-amber-500/20 hover:border-amber-500/50 bg-amber-500/5 p-4 rounded-xl text-center transition-all group">
                    <span class="text-xs text-amber-400 font-bold block mb-1">SKENARIO ASAM</span>
                    <span class="text-[10px] text-gray-500 font-mono-data">pH 5.5 | 26°C | DO 4.2</span>
                </button>
                <button onclick="fillSimulator({ph: 7.5, temp: 34.0, do: 2.0, turbidity: 150.0, bod: 15.0, co2: 35.0, alkalinity: 30.0, hardness: 50.0, calcium: 20.0, ammonia: 2.0, nitrite: 0.5, phosphorus: 2.0, h2s: 0.1, plankton: 8000.0})" class="border border-rose-500/20 hover:border-rose-500/50 bg-rose-500/5 p-4 rounded-xl text-center transition-all group">
                    <span class="text-xs text-rose-400 font-bold block mb-1">SKENARIO KRITIS</span>
                    <span class="text-[10px] text-gray-500 font-mono-data">pH 7.5 | 34°C | DO 2.0</span>
                </button>
            </div>
            <div class="mt-6 flex justify-end">
                <a href="{{ route('water-logs.index') }}" class="text-xs text-gold border border-gold/20 hover:bg-gold hover:text-obsidian px-4 py-2.5 rounded-lg transition-all font-semibold">
                    Input Data Kolam &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Logs Table -->
    <div class="bg-slate-card border border-gold/5 rounded-xl p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-serif-heading text-white">Log Parameter Terbaru</h3>
            <a href="{{ route('water-logs.index') }}" class="text-xs text-gold hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="border-b border-gold/10 text-gray-400">
                        <th class="pb-3 font-medium">Kolam</th>
                        <th class="pb-3 font-medium">pH</th>
                        <th class="pb-3 font-medium">Suhu</th>
                        <th class="pb-3 font-medium">Oksigen (DO)</th>
                        <th class="pb-3 font-medium">Status</th>
                        <th class="pb-3 font-medium">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gold/5">
                    @forelse($recentLogs as $log)
                        <tr>
                            <td class="py-4">
                                <div class="font-semibold text-white">{{ $log->pond->name }}</div>
                            </td>
                            <td class="py-4 font-mono-data">{{ number_format($log->ph, 2) }}</td>
                            <td class="py-4 font-mono-data">{{ number_format($log->temperature, 1) }} °C</td>
                            <td class="py-4 font-mono-data">{{ number_format($log->dissolved_oxygen, 2) }} mg/L</td>
                            <td class="py-4">
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold 
                                    {{ $log->status === 'Optimal' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : '' }}
                                    {{ $log->status === 'Atensi' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : '' }}
                                    {{ $log->status === 'Kritis' ? 'bg-rose-500/10 text-rose-400 border border-rose-500/20' : '' }}">
                                    {{ $log->status }}
                                </span>
                            </td>
                            <td class="py-4 text-xs text-gray-500">{{ $log->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-gray-500">Belum ada data parameter terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    function fillSimulator(data) {
        // Redirect user to water-logs index and prefill form via URL params
        const params = new URLSearchParams({
            sim_ph: data.ph,
            sim_temp: data.temp,
            sim_do: data.do,
            sim_turbidity: data.turbidity,
            sim_bod: data.bod,
            sim_co2: data.co2,
            sim_alkalinity: data.alkalinity,
            sim_hardness: data.hardness,
            sim_calcium: data.calcium,
            sim_ammonia: data.ammonia,
            sim_nitrite: data.nitrite,
            sim_phosphorus: data.phosphorus,
            sim_h2s: data.h2s,
            sim_plankton: data.plankton
        });
        window.location.href = "{{ route('water-logs.index') }}?" + params.toString();
    }
</script>
@endsection
