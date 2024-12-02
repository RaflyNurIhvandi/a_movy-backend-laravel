@extends('layouts.app')

@section('menu-kursi')
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
@endsection
@section('content')
    <h2 class="mt-6 mb-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Kursi
    </h2>
    <div class="flex mb-5 gap-4 flex-wrap justify-between">
        <button type="button" onclick="tK()"
            class="w-36 flex items-center justify-between px-3 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-300 ease-in-out bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Tambah Kursi
            <span class="ml-2" aria-hidden="true">+</span>
        </button>
        <label class="block text-xs">
            <form action="/cari-kursi" method="GET">
                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                    <input id="cari" name="cari"
                        class="block pl-10 text-xs text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                        placeholder="Cari" />
                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </form>
        </label>
    </div>
    <a href="/tambah-kursi" id="tkk" hidden></a>
    <div class="w-full mb-4 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Auditorium</th>
                        <th class="px-4 py-3">Ke-Samping</th>
                        <th class="px-4 py-3">Ke-Belakang</th>
                        <th class="px-4 py-3">Jumlah Kursi</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($dt_kursi as $k => $i)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                {{ $k + 1 }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $i->nama }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $i->ke_samping }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $i->ke_belakang }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $i->ke_samping * $i->ke_belakang }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a href="/lihat-kursi/{{ $i->kode_kursi }}"
                                        class="items-center px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div
            class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">
                Showing {{ $dt_kursi->firstItem() }} - {{ $dt_kursi->lastItem() }} of {{ $dt_kursi->total() }}
            </span>
            <span class="col-span-2"></span>
            <!-- Pagination -->
            {{ $dt_kursi->links('layouts.pagination') }}
        </div>
    </div>
@endsection

@section('js')
    <script>
        function tK() {
            document.getElementById('tkk').click()
        }
    </script>
@endsection
