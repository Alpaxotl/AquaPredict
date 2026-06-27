@extends('layouts.app')

@section('title', 'Edit Log Kualitas Air')
@section('header_title', 'Edit Catatan Kualitas Air')

@section('content')
<div class="bg-slate-card border border-gold/10 p-6 rounded-2xl shadow-lg">
    <form action="{{ route('water-logs.update', $waterLog->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="pond_id" class="block text-gray-400 text-xs font-semibold mb-1.5 uppercase tracking-wider">Kolam</label>
            <select name="pond_id" id="pond_id" required
                class="w-full md:w-1/3 bg-obsidian border border-gold/20 focus:border-gold rounded-lg px-4 py-3 text-white focus:outline-none transition-colors text-sm">
                @foreach($ponds as $p)
                    <option value="{{ $p->id }}" {{ $waterLog->pond_id == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3">
            @foreach(['ph' => 'pH', 'temperature' => 'Suhu', 'dissolved_oxygen' => 'DO', 'turbidity' => 'Turbidity', 'bod' => 'BOD', 'co2' => 'CO2', 'alkalinity' => 'Alkalinity', 'hardness' => 'Hardness', 'calcium' => 'Calcium', 'ammonia' => 'Ammonia', 'nitrite' => 'Nitrite', 'phosphorus' => 'Phosphorus', 'h2s' => 'H2S', 'plankton' => 'Plankton'] as $field => $label)
                <div>
                    <label class="block text-gray-400 text-xs font-semibold mb-1.5 uppercase tracking-wider">{{ $label }}</label>
                    <input type="number" step="0.001" name="{{ $field }}" required value="{{ $waterLog->$field }}"
                        class="w-full bg-obsidian border border-gold/20 focus:border-gold rounded-lg px-3 py-3 text-white focus:outline-none transition-colors text-sm font-mono-data text-center">
                </div>
            @endforeach
        </div>

        <div class="flex gap-3 mt-5">
            <a href="{{ route('water-logs.index') }}" class="border border-gold/20 text-gray-400 hover:text-white px-6 py-3 rounded-lg text-sm transition-all">Batal</a>
            <button type="submit" class="bg-gold hover:bg-gold-hover text-obsidian font-bold py-3 px-8 rounded-lg transition-all text-sm shadow-lg">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
