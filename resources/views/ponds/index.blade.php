@extends('layouts.app')

@section('title', 'Kelola Kolam')
@section('header_title', 'Manajemen Kolam Budidaya')

@section('content')
<div class="space-y-8">

    <!-- Add Pond & Alert Area -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-serif-heading text-white font-semibold">Manajemen Kolam</h2>
        <form action="{{ route('ponds.index') }}" method="GET" class="flex space-x-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kolam..."
                class="bg-obsidian border border-gold/25 focus:border-gold rounded-lg px-4 py-2 text-white placeholder-gray-600 focus:outline-none transition-colors text-sm w-64">
            <button type="submit" class="bg-slate-card border border-gold/25 hover:border-gold text-gold px-4 py-2 rounded-lg text-sm transition-all">
                Cari
            </button>
        </form>
    </div>

    <div class="flex flex-col md:flex-row md:items-start gap-8">
        
        <!-- Form Add Pond (Admin Only) -->
        @if(Auth::user()->role === 'admin')
            <div class="w-full md:w-1/3 bg-slate-card border border-gold/10 p-6 rounded-xl shrink-0">
                <h3 class="text-lg font-serif-heading text-white mb-4">Tambah Kolam Baru</h3>
                <form action="{{ route('ponds.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-gray-400 text-sm font-medium mb-1.5">Nama Kolam</label>
                        <input type="text" name="name" id="name" required placeholder="Contoh: Kolam Bioflok A5"
                            class="w-full bg-obsidian border border-gold/25 focus:border-gold rounded-lg px-4 py-2 text-white placeholder-gray-600 focus:outline-none transition-colors text-sm">
                    </div>
                    <div>
                        <label for="location" class="block text-gray-400 text-sm font-medium mb-1.5">Lokasi / Sektor</label>
                        <input type="text" name="location" id="location" placeholder="Contoh: Sektor Timur"
                            class="w-full bg-obsidian border border-gold/25 focus:border-gold rounded-lg px-4 py-2 text-white placeholder-gray-600 focus:outline-none transition-colors text-sm">
                    </div>
                    <button type="submit" class="w-full bg-gold hover:bg-gold-hover text-obsidian font-bold py-2.5 px-4 rounded-lg transition-all gold-glow text-sm">
                        Simpan Kolam
                    </button>
                </form>
            </div>
        @else
            <div class="w-full md:w-1/3 bg-slate-card/45 border border-gold/5 p-6 rounded-xl shrink-0 text-sm text-gray-400 leading-relaxed">
                <span class="text-gold font-bold block mb-1">Informasi Peran:</span>
                Anda terdaftar sebagai <strong class="text-white">Petani Ikan</strong>. Penambahan, pengubahan, dan penghapusan kolam baru hanya dapat dilakukan oleh **Administrator**. Anda diperkenankan melakukan pencatatan harian parameter kolam yang tersedia.
            </div>
        @endif

        <!-- Ponds Grid List -->
        <div class="flex-grow grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($ponds as $pond)
                <div class="bg-slate-card border border-gold/5 p-6 rounded-xl flex flex-col justify-between hover:border-gold/25 transition-all">
                    <div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-lg font-serif-heading text-white font-semibold">{{ $pond->name }}</h4>
                                <span class="text-xs text-gold/80 block mt-1">{{ $pond->location ?? 'Tidak ada sektor' }}</span>
                            </div>
                        </div>
                        <div class="mt-6 flex space-x-6 text-sm text-gray-400 font-mono-data">
                            <div>
                                <span class="text-gray-500 block text-xs uppercase tracking-wider">Histori Log</span>
                                <span class="text-white text-lg font-semibold">{{ $pond->water_logs_count }} Catatan</span>
                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->role === 'admin')
                        <!-- Actions -->
                        <div class="border-t border-gold/5 mt-6 pt-4 flex justify-end space-x-2">
                            <!-- Simple Form Edit Toggle (Visual simulation or direct inline edit) -->
                            <button onclick="toggleEdit({{ $pond->id }}, '{{ addslashes($pond->name) }}', '{{ addslashes($pond->location) }}')" 
                                class="text-xs text-gray-400 hover:text-white px-3 py-1.5 rounded border border-gray-800 hover:border-gray-600 transition-all">
                                Ubah
                            </button>
                            <form action="{{ route('ponds.destroy', $pond->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kolam ini beserta seluruh catatan log airnya secara permanen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-rose-400 hover:text-rose-300 px-3 py-1.5 rounded border border-rose-500/10 hover:border-rose-500/30 transition-all bg-rose-500/5">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-2 bg-slate-card border border-gold/5 p-12 text-center rounded-xl text-gray-500">
                    Belum ada kolam budidaya yang ditambahkan.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Edit Pond Modal Overlay -->
    <div id="editModal" class="fixed inset-0 bg-obsidian/80 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-slate-card border border-gold/20 p-6 rounded-xl w-full max-w-md">
            <h3 class="text-lg font-serif-heading text-white mb-4">Ubah Data Kolam</h3>
            <form id="editForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_name" class="block text-gray-400 text-sm font-medium mb-1.5">Nama Kolam</label>
                    <input type="text" name="name" id="edit_name" required
                        class="w-full bg-obsidian border border-gold/25 focus:border-gold rounded-lg px-4 py-2 text-white focus:outline-none transition-colors text-sm">
                </div>
                <div>
                    <label for="edit_location" class="block text-gray-400 text-sm font-medium mb-1.5">Lokasi</label>
                    <input type="text" name="location" id="edit_location"
                        class="w-full bg-obsidian border border-gold/25 focus:border-gold rounded-lg px-4 py-2 text-white focus:outline-none transition-colors text-sm">
                </div>
                <div class="flex justify-end space-x-2 pt-2">
                    <button type="button" onclick="closeEditModal()" class="text-sm text-gray-400 hover:text-white px-4 py-2 rounded">
                        Batal
                    </button>
                    <button type="submit" class="bg-gold hover:bg-gold-hover text-obsidian font-bold px-4 py-2 rounded transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function toggleEdit(id, name, location) {
        document.getElementById('editForm').action = "/ponds/" + id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_location').value = location;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
@endsection
