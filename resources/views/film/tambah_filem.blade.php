@extends('layouts.app')

@section('menu-film')
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
@endsection

@section('content')
    <h2 class="mt-6 mb-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Tambah Film
    </h2>
    <form class="mb-5" action="/simpan-filem" method="POST" enctype="multipart/form-data">
        @csrf
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Nama</span>
            <input type="text" id="nama" name="nama"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Nama film" />
        </label>
        <div class="mt-4 flex flex-row justify-between gap-4">
            <label class="block w-full text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Jenis Film
                </span>
                <select name="jenis_film" id="jenis_film"
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    <option selected disabled>Pilih Jenis Filem</option>
                    <option value="drama">Drama</option>
                    <option value="romantis">Romantis</option>
                    <option value="animasi">Animasi</option>
                    <option value="komedi">Komedi</option>
                    <option value="aksi">Aksi</option>
                    <option value="dokumenter">Dokumenter</option>
                    <option value="horor">Horor</option>
                    <option value="thriller">Thriller</option>
                </select>
            </label>
            <label class="block w-full text-sm">
                <span class="text-gray-700 dark:text-gray-400">Produser</span>
                <input type="text" id="produser" name="produser"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Produser" />
            </label>
        </div>
        <div class="mt-4 flex flex-row justify-between gap-4">
            <label class="block w-full text-sm">
                <span class="text-gray-700 dark:text-gray-400">Sutradara</span>
                <input type="text" id="sutradara" name="sutradara"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Sutradara" />
            </label>
            <label class="block w-full text-sm">
                <span class="text-gray-700 dark:text-gray-400">Penulis</span>
                <input type="text" id="penulis" name="penulis"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Penulis" />
            </label>
        </div>
        <div class="mt-4 flex flex-row justify-between gap-4">
            <label class="block w-full text-sm">
                <span class="text-gray-700 dark:text-gray-400">Pemroduksi</span>
                <input type="text" id="pemroduksi" name="pemroduksi"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Pemroduksi" />
            </label>
            <label class="block w-full text-sm">
                <span class="text-gray-700 dark:text-gray-400">Pemeran</span>
                <input type="text" id="pemeran" name="pemeran"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Pemeran" />
            </label>
        </div>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Sinopsis</span>
            <textarea id="sinopsis" name="sinopsis"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                rows="3" placeholder="Sinopsis"></textarea>
        </label>
        <div class="flex">
            <button onclick="event.preventDefault(); document.getElementById('thumbnail').click();"
                class="mt-4 flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Gambar Thumbnail</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ml-2">
                    <path
                        d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                </svg>
            </button>
            <button onclick="event.preventDefault(); document.getElementById('video-chn').click();"
                class="ml-3 mt-4 flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Video Trailer</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ml-2">
                    <path
                        d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                </svg>
            </button>
        </div>
        <input type="file" id="thumbnail" name="thumbnail" hidden onchange="changeGambar()">
        <input type="file" name="video" id="video-chn" hidden onchange="changeVideo()">
        <div class="mt-4 grid gap-6 mb-8 md:grid-cols-2">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                    Gambar Thumbnail
                </h4>
                <img src="" alt="Gambar Preview" id="gambar-prev" class="w-full" style="display: none;">
            </div>
            <div class="min-w-0 p-4 text-white bg-purple-600 rounded-lg shadow-xs">
                <h4 class="mb-4 font-semibold">
                    Video Trailer
                </h4>
                <video src="" id="video-prev" class="w-full" style="display: none;" controls></video>
            </div>
        </div>
        <button type="button" onclick="kbl()"
            class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Kembali
        </button>
        <button onclick="resetAll()" type="reset"
            class="ml-1 px-3 py-1 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-md dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
            Reset
        </button>
        <button type="button" @click="openSimpan"
            class="ml-1 px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Simpan
        </button>
        <button id="sv" hidden type="submit"></button>
    </form>
    <a href="/film" id="kb" hidden></a>
@endsection

@section('js')
    <script>
        function kbl() {
            document.getElementById('kb').click()
        }
        function resetAll() {
            document.querySelector("video").src = ""
            document.getElementById('gambar-prev').src = ""
            document.getElementById('video-prev').style.display = "none"
            document.getElementById('gambar-prev').style.display = "none"
        }

        function changeGambar() {
            document.getElementById("gambar-prev").style.display = "block";
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("thumbnail").files[0]);

            oFReader.onload = function(oFREvent) {
                document.getElementById("gambar-prev").src = oFREvent.target.result;
            };
        };
        document.getElementById("video-chn").onchange = function(event) {
            document.getElementById("video-prev").style.display = "block";
            let file = event.target.files[0];
            let blobURL = URL.createObjectURL(file);
            document.querySelector("video").src = blobURL;
        }
    </script>
@endsection

@section('modal')
    <!-- Modal backdrop. This what you want to place close to the closing body tag -->
    <div x-show="isSimpan" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
        <!-- Modal -->
        <div x-show="isSimpan" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeSimpan"
            @keydown.escape="closeSimpan"
            class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
            role="dialog" id="simpan-filem">
            <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
            <header class="flex justify-end">
                <button
                    class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                    aria-label="close" @click="closeSimpan">
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
                <button @click="closeSimpan"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                    Batal
                </button>
                <button onclick="event.preventDefault(); document.getElementById('sv').click();"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Simpan
                </button>
            </footer>
        </div>
    </div>
    <!-- End of modal backdrop -->
@endsection
