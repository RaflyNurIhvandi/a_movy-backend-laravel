@extends('layouts.app')

@section('menu-penayangan')
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
@endsection
@section('content')
    <h2 class="mt-6 mb-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Penayangan
    </h2>
    <div class="flex mb-5 gap-4 flex-wrap justify-between">
        <button type="button" onclick="tP()"
            class="w-48 flex items-center justify-between px-3 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-300 ease-in-out bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Tambah Penayangan
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
    <a href="/tambah-penayangan" id="tpn" hidden></a>
    <div class="w-full mb-4 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Kode Penayangan</th>
                        <th class="px-4 py-3">Film</th>
                        <th class="px-4 py-3">Waktu Penayangan</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($dt_pen as $k => $i)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                {{ $k + 1 }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $i->kode_penayangan }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $i->nama }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $i->tanggal_penayangan }}, {{ $i->jam_mulai }} - {{ $i->jam_selesai }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $i->harga }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if ($i->status == 'belum_rilis')
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-amber-100 bg-amber-700 rounded-full">
                                        {{ $i->status }}
                                    </span>
                                @elseif ($i->status == 'rilis')
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-yellow-100 bg-yellow-500 rounded-full">
                                        {{ $i->status }}
                                    </span>
                                @elseif ($i->status == 'sedang_tayang')
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-green-100 bg-green-700 rounded-full">
                                        {{ $i->status }}
                                    </span>
                                @elseif ($i->status == 'sudah_tayang')
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-red-100 bg-red-600 rounded-full">
                                        {{ $i->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a href="/lihat-penayangan/{{ $i->kode_penayangan }}"
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
                Showing {{ $dt_pen->firstItem() }} - {{ $dt_pen->lastItem() }} of {{ $dt_pen->total() }}
            </span>
            <span class="col-span-2"></span>
            <!-- Pagination -->
            {{ $dt_pen->links('layouts.pagination') }}
        </div>
    </div>
@endsection

@section('js')
    <script>
        function tP() {
            document.getElementById('tpn').click()
        }
    </script>
@endsection
