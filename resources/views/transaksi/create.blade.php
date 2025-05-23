@extends('layouts.app')

@section('title', 'Buat Transaksi')

@section('content')
<form action="{{ route('transaksi.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label>Barang</label>
        <select id="barang-select" name="barang_ids[]" class="w-full p-2 border rounded" multiple>
            @foreach($barangs as $barang)
                <option value="{{ $barang->id }}" data-nama="{{ $barang->nama_barang }}" data-stok="{{ $barang->stock }}">
                    {{ $barang->nama_barang }} (Stok: {{ $barang->stock }})
                </option>
                
            @endforeach
        </select>
        <small class="text-gray-500">Gunakan Ctrl (atau Cmd di Mac) untuk memilih lebih dari satu barang.</small>
    </div>

    <div id="barang-terpilih" class="space-y-2">
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan Transaksi</button>
</form>

<script>
    const barangSelect = document.getElementById('barang-select');
    const container = document.getElementById('barang-terpilih');

    barangSelect.addEventListener('change', () => {
        container.innerHTML = '';

        Array.from(barangSelect.selectedOptions).forEach((option, index) => {
            const id = option.value;
            const nama = option.dataset.nama;
            const stok = parseInt(option.dataset.stok);

            const div = document.createElement('div');
            div.innerHTML = `
                <input type="hidden" name="barangs[${index}][id]" value="${id}">
                <label class="block mb-1 font-semibold">${nama} (Stok: ${stok})</label>
                <input type="number" name="barangs[${index}][jumlah]" class="w-full p-2 border rounded jumlah-input" min="1" max="${stok}" required placeholder="Jumlah" data-stok="${stok}">
            `;
            container.appendChild(div);
        });

        attachJumlahValidation();
    });

    function attachJumlahValidation() {
        const inputs = document.querySelectorAll('.jumlah-input');
        inputs.forEach(input => {
            input.addEventListener('input', (e) => {
                const stok = parseInt(e.target.dataset.stok);
                const value = parseInt(e.target.value);

                if (value > stok) {
                    alert(`Jumlah stok (${stok})`);
                    e.target.value = stok; 
                }

                if (stok === 0) {
                    alert('Stok barang ini sudah habis!');
                    e.target.value = 0;
                }

                if (value < 1) {
                    e.target.value = 1; 
                }
            });
        });
    }
</script>

@endsection
