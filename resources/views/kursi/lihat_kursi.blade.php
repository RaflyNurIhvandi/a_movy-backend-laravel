@extends('layouts.app')

@section('menu-kursi')
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
@endsection
@section('content')
    <h2 class="mt-6 mb-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Edit Kursi
    </h2>
    @foreach($dt_kursi as $k)
        <form class="mb-6" action="/update-kursi/{{ $k->kode_kursi }}" method="POST">
            @csrf
            @method('PUT')
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Auditorium
                </span>
                <select id="auditorium" name="auditorium"
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option value="{{ $k->kode_auditorium }}" selected disabled>{{ $k->nama }}</option>
                    @foreach($dt_aud as $a)
                        <option value="{{ $a->kode_auditorium }}">{{ $a->nama }}</option>
                    @endforeach
                </select>
            </label>
            <div class="flex mb-4 mt-4 flex-row gap-4 justify-between">
                <label class="block w-full text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Ke-Samping</span>
                    <input type="number" id="ke_samping" name="ke_samping"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="0" value="{{ $k->ke_samping }}" />
                </label>
                <label class="block w-full text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Ke-Belakang</span>
                    <input type="number" id="ke_belakang" name="ke_belakang"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="0" value="{{ $k->ke_belakang }}" />
                </label>
            </div>
            <button type="button" onclick="kbl()"
                class="px-3 py-1 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-md dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                Kembali
            </button>
            <button type="button" @click="openHapusKursi"
                class="ml-1 px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Hapus
            </button>
            <button type="reset"
                class="ml-1 px-3 py-1 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-md dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                Reset
            </button>
            <button type="button" @click="openUpdateKursi"
                class="ml-1 px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Ubah
            </button>
            <button id="upkr" hidden type="submit"></button>
        </form>
        <a href="/hapus-kursi/{{ $k->kode_kursi }}" id="hpkr"></a>
    @endforeach
    <a href="/kursi" id="kr" hidden></a>
    <h4 class="mb-2 text-xl font-semibold text-gray-600 dark:text-gray-300">
        Jumlah Kursi : @foreach($dt_kursi as $dk){{ $dk->ke_samping * $dk->ke_belakang }}@endforeach
    </h4>
    <div class="mb-4 mt-1 min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
            Skema Kursi
        </h4>
        <div class="block overflow-x-auto">
            @foreach ($dt_kursi as $y)
                @for ($fy = 0; $fy < $y->ke_belakang; $fy++)
                    <div class="flex justify-center w-fit mx-auto">
                        @for ($fx = 0; $fx < $y->ke_samping; $fx++)
                            <div
                                class="mx-1 my-1 rounded-md text-xs h-8 w-10 pt-2 text-center text-white bg-purple-600 hover:bg-purple-700 cursor-pointer transition duration-300">
                                {{ $dt_kursi_detail[$y->ke_samping * $fy + $fx]->nomor_kursi }}
                            </div>
                        @endfor
                    </div>
                @endfor
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script>
        function kbl() {
            document.getElementById('kr').click()
        }
    </script>
@endsection

@section('modal')
    <!-- Modal backdrop. This what you want to place close to the closing body tag -->
    <div x-show="isHapusKursi" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
        <!-- Modal -->
        <div x-show="isHapusKursi" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeHapusKursi"
            @keydown.escape="closeHapusKursi"
            class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
            role="dialog" id="hapus-kursi">
            <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
            <header class="flex justify-end">
                <button
                    class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                    aria-label="close" @click="closeHapusKursi">
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
                    Anda yakin ingin menghapus data ini ?
                </p>
                <!-- Modal description -->
                <p class="text-sm text-gray-700 dark:text-gray-400">
                    Data yang dihapus tidak bisa dikembalikan !
                </p>
            </div>
            <footer
                class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                <button @click="closeHapusKursi"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                    Batal
                </button>
                <button onclick="event.preventDefault(); document.getElementById('hpkr').click();"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Hapus
                </button>
            </footer>
        </div>
    </div>
    <!-- End of modal backdrop -->

    <!-- Modal backdrop. This what you want to place close to the closing body tag -->
    <div x-show="isUpdateKursi" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
        <!-- Modal -->
        <div x-show="isUpdateKursi" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeUpdateKursi"
            @keydown.escape="closeUpdateKursi"
            class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
            role="dialog" id="update-kursi">
            <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
            <header class="flex justify-end">
                <button
                    class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                    aria-label="close" @click="closeUpdateKursi">
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
                    Anda yakin ingin mengubah data ini ?
                </p>
                <!-- Modal description -->
                <p class="text-sm text-gray-700 dark:text-gray-400">
                    Pastikan data yang diisi sudah benar !
                </p>
            </div>
            <footer
                class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                <button @click="closeUpdateKursi"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                    Batal
                </button>
                <button onclick="event.preventDefault(); document.getElementById('upkr').click();"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Ubah
                </button>
            </footer>
        </div>
    </div>
    <!-- End of modal backdrop -->
@endsection
