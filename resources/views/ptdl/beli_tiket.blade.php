@extends('layouts.app')

@section('menu-ptdl')
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
@endsection
@section('content')
    <h2 class="mt-6 mb-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Beli Tiket
    </h2>
    <form class="mb-5" action="/simpan-pembelian" method="POST">
        @csrf
        <div class="flex gap-4 flex-row justify-between">
            <label class="block w-full text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Pilih Film
                </span>
                <select id="film" name="film" onchange="ambilPenayangan()"
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    <option selected disabled>Pilih Film</option>
                    @foreach($dt_pen as $pn)
                        <option value="{{ $pn->kode_penayangan }}">{{ $pn->nama }}</option>
                    @endforeach
                </select>
            </label>
            <div id="hr" class="mb-4 w-full">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Harga (otomatis)</span>
                    <input type="text" id="harga" name="harga"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Harga" />
                </label>
            </div>
        </div>
        <div class="mb-4 flex gap-4 flex-row justify-between">
            <div class="flex w-full flex-row gap-2">
                <label class="block w-full text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Nomor Kursi</span>
                    <input type="number" id="nomor_kursi" name="nomor_kursi"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Nomor Kursi" />
                </label>
                <button type="button" onclick="addKursi()"
                    class="px-3 h-9 relative mt-6 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    +
                </button>
            </div>
            <label class="block w-full text-sm">
                <span class="text-gray-700 dark:text-gray-400">List Kursi (otomatis)</span>
                <input type="text" id="list_kursi" name="list_kursi"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="List Kursi" />
            </label>
        </div>
        <label class="block w-1/2 mb-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Total Harga (otomatis)</span>
            <input type="text" id="ttl_harga" name="ttl_harga"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Total Harga" />
        </label>
        <div class="min-w-0 mb-4 p-4 w-1/2 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
              Status
            </h4>
            <div class="flex flex-row gap-5">
                <label class="flex items-center dark:text-gray-400">
                    <input type="checkbox" value="pembayaran_sukses" id="pembayaran_sukses" name="pembayaran_sukses"
                        class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                    <span class="ml-2">
                        Pembayaran Sukses
                    </span>
                </label>
                <label class="flex items-center dark:text-gray-400">
                    <input type="checkbox" value="cek_in" id="cek_in" name="cek_in"
                        class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                    <span class="ml-2">
                        Cek In
                    </span>
                </label>
            </div>
        </div>
        <input type="number" name="jumlah_kursi" id="jumlah_kursi" hidden>
        <button type="button" onclick="kbl()"
            class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Kembali
        </button>
        <button type="button" @click="openTiket"
            class="ml-1 px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Simpan
        </button>
        <button id="svt" hidden type="submit"></button>
    </form>
    <a href="/ptdl" id="pt" hidden></a>
@endsection

@section('js')
    <script>
        var harga_tiket = 0
        var tiket = []
        function addKursi(){
            var n_kur = document.getElementById('nomor_kursi').value
            var pus = tiket.push(n_kur)
            document.getElementById('list_kursi').value = tiket
            document.getElementById('nomor_kursi').value = ''
            document.getElementById('nomor_kursi').focus()
            var total_harga = harga_tiket*tiket.length
            document.getElementById('ttl_harga').value = total_harga
            document.getElementById('jumlah_kursi').value = tiket.length
            console.log(tiket.length);
            console.log(tiket);
        }
        function ambilPenayangan() {
            var url_p = "http://localhost:8000/ambil-penayangan"
            var set = { method : "Get"}
            var val_pen = document.getElementById('film').value
            fetch(url_p, set)
                .then(res => res.json())
                .then((json)=>{
                    var arr = json.data
                    var filterPen = arr.filter(function(i){
                        return i.kode_penayangan == val_pen
                    })
                    var idharga = document.getElementById('hr')
                    filterPen.forEach((obj)=>{
                        document.getElementById('harga').value = `${obj.harga}`
                        harga_tiket = `${obj.harga}`
                    })
                })
        }
        function kbl() {
            document.getElementById('pt').click()
        }
    </script>
@endsection

@section('modal')
    <!-- Modal backdrop. This what you want to place close to the closing body tag -->
    <div x-show="isTiket" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
        <!-- Modal -->
        <div x-show="isTiket" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeTiket"
            @keydown.escape="closeTiket"
            class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
            role="dialog" id="tiket">
            <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
            <header class="flex justify-end">
                <button
                    class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                    aria-label="close" @click="closeTiket">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                        <path
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                </button>
            </header>
            <!-- Modal body -->
            <div class="mt-4 mb-6">
                <!-- Modal title -->
                <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                    Anda Yakin ?
                </p>
                <!-- Modal description -->
                <p class="text-sm text-gray-700 dark:text-gray-400">
                    Pastikan data yang dimasukan sudah benar!
                </p>
            </div>
            <footer
                class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                <button @click="closeTiket"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                    Batal
                </button>
                <button onclick="event.preventDefault(); document.getElementById('svt').click();"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Simpan
                </button>
            </footer>
        </div>
    </div>
    <!-- End of modal backdrop -->
@endsection
