@extends('layouts.app')

@section('menu-penayangan')
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
@endsection
@section('content')
    <h2 class="mt-6 mb-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Tambah Penayangan
    </h2>
    <form class="mb-5" action="/simpan-penayangan" method="POST">
        @csrf
        <div class="flex mb-4 flex-row gap-4 justify-between">
            <label class="block w-full text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Film
                </span>
                <select id="film" name="film"
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    <option selected disabled>Pilih Film</option>
                    @foreach($dt_film as $f)
                        <option value="{{ $f->kode_film }}">{{ $f->nama }}</option>
                    @endforeach
                </select>
            </label>
            <label class="block w-full text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Auditorium
                </span>
                <select id="auditorium" name="auditorium"
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    <option selected disabled>Pilih Auditorium</option>
                    @foreach($dt_aud as $f)
                        <option value="{{ $f->kode_auditorium }}">{{ $f->nama }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <label class="block w-full text-sm">
            <span class="text-gray-700 dark:text-gray-400">Tanggal Penayangan</span>
            <input type="date" id="tanggal_penayangan" name="tanggal_penayangan"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
        </label>
        <div class="flex mb-4 mt-4 flex-row gap-4 justify-between">
            <label class="block w-full text-sm">
                <span class="text-gray-700 dark:text-gray-400">Jam Mulai</span>
                <input type="time" id="jam_mulai" name="jam_mulai"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
            </label>
            <label class="block w-full text-sm">
                <span class="text-gray-700 dark:text-gray-400">Jam Selesai</span>
                <input type="time" id="jam_selesai" name="jam_selesai"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
            </label>
        </div>
        <label class="block mb-4 w-full text-sm">
            <span class="text-gray-700 dark:text-gray-400">Harga</span>
            <input type="number" id="harga" name="harga"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="0" />
        </label>
        <label class="block mb-4 w-full text-sm">
            <span class="text-gray-700 dark:text-gray-400">
                Status Penayangan
            </span>
            <select id="status" name="status"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option selected disabled>Tentukan Status Penayangan</option>
                <option value="belum_rilis">Belum Rilis</option>
                <option value="rilis">Rilis</option>
                <option value="sedang_tayang">Sedang Tayang</option>
                <option value="sudah_tayang">Sudah Tayang</option>
            </select>
        </label>
        <button type="button" onclick="kbl()"
            class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Kembali
        </button>
        <button type="reset"
            class="ml-1 px-3 py-1 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-md dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
            Reset
        </button>
        <button type="button" @click="openPenayangan"
            class="ml-1 px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Simpan
        </button>
        <button id="svpn" hidden type="submit"></button>
    </form>
    <a href="/penayangan" id="pn" hidden></a>
@endsection

@section('js')
    <script>
        function kbl() {
            document.getElementById('pn').click()
        }
    </script>
@endsection

@section('modal')
    <!-- Modal backdrop. This what you want to place close to the closing body tag -->
    <div x-show="isPenayangan" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
        <!-- Modal -->
        <div x-show="isPenayangan" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closePenayangan"
            @keydown.escape="closePenayangan"
            class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
            role="dialog" id="penayangan">
            <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
            <header class="flex justify-end">
                <button
                    class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                    aria-label="close" @click="closePenayangan">
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
                <button @click="closePenayangan"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                    Batal
                </button>
                <button onclick="event.preventDefault(); document.getElementById('svpn').click();"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Simpan
                </button>
            </footer>
        </div>
    </div>
    <!-- End of modal backdrop -->
@endsection
