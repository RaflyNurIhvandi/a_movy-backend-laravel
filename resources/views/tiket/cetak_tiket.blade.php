<!doctype html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/logo_s.png" type="image">
    <title>A Movy</title>
    @vite('resources/css/app.css')
    @vite('resources/css/output.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="/js/init-alpine.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="/js/charts-lines.js" defer></script>
    <script src="/js/charts-pie.js" defer></script>
</head>
<body>
    @foreach($dt_tiket as $t)
        <div class="flex flex-col gap-2 px-20">
            <img src="/img/logo.png" class="mx-auto" width="200" />
            <div class="border mt-2 border-b-2 border-slate-700"></div>
            <div class="flex flex-row justify-between mt-1">
                <h2 class="w-full text-xl font-semibold text-black">
                    ID TIKET
                </h2>
                <h2 class="w-full text-xl font-semibold text-black">
                    : {{ $t->kode_tiket }}
                </h2>
            </div>
            <div class="flex flex-row justify-between mt-1">
                <h2 class="w-full text-xl font-semibold text-black">
                    NAMA
                </h2>
                <h2 class="w-full text-xl font-semibold text-black">
                    : @foreach($dt_reg as $r){{ $r->name }}@endforeach
                </h2>
            </div>
            <div class="flex flex-row justify-between mt-1">
                <h2 class="w-full text-xl font-semibold text-black">
                    FILM
                </h2>
                <h2 class="w-full text-xl font-semibold text-black">
                    : @foreach($dt_film as $f){{ $f->nama }}@endforeach
                </h2>
            </div>
            <div class="flex flex-row justify-between mt-1">
                <h2 class="w-full text-xl font-semibold text-black">
                    AUDITORIUM
                </h2>
                <h2 class="w-full text-xl font-semibold text-black">
                    : @foreach($dt_aud as $a){{ $a->nama }}@endforeach
                </h2>
            </div>
            <div class="flex flex-row justify-between mt-1">
                <h2 class="w-full text-xl font-semibold text-black">
                    HARGA
                </h2>
                <h2 class="w-full text-xl font-semibold text-black">
                    : IDR {{ $t->harga }}
                </h2>
            </div>
            <div class="flex flex-row justify-between mt-1">
                <h2 class="w-full text-xl font-semibold text-black">
                    STATUS PEMBAYARAN
                </h2>
                <h2 class="w-full text-xl font-semibold text-black">
                    : @foreach($dt_reg as $r){{ $r->status_pembayaran }}@endforeach
                </h2>
            </div>
            <div class="flex flex-row justify-between mt-1">
                <h2 class="w-full text-xl font-semibold text-black">
                    KODE REGISTRASI
                </h2>
                <h2 class="w-full text-xl font-semibold text-black">
                    : @foreach($dt_reg as $r){{ $r->kode_registrasi }}@endforeach
                </h2>
            </div>
            <h2 class="w-full text-center mt-4 text-2xl font-semibold text-black">
                TERIMAKASIH
            </h2>
        </div>
    @endforeach
    <script>
        window.print()
    </script>
</body>
</html>
