<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Aplikasi Transaksi')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f4f1ed; /* earth tone background */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>
<body class="min-h-screen text-gray-800">
    <nav class="bg-amber-100 shadow p-4 mb-6">
        <div class="container mx-auto flex justify-between">
           <h1 class="text-xl font-bold text-amber-900">TOKO SEMBAKO MAJI</h1>
            <div class="space-x-4">
                <a href="{{ route('barang.index') }}" class="text-amber-800 hover:underline">Barang</a>
                <a href="{{ route('transaksi.index') }}" class="text-amber-800 hover:underline">Transaksi</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold text-green-900 mb-4">@yield('title')</h2>
        <div class="bg-white p-6 rounded-xl shadow-lg">
            @yield('content')
        </div>
    </main>

    <footer class="mt-10 text-center text-sm text-gray-500">
    </footer>
    <script>
    @if(session('success'))
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    @elseif(session('error'))
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    @endif
</script>

</body>
</html>
