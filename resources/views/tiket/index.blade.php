@extends('layouts.app')

@section('menu-tiket')
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
@endsection
@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Tiket
    </h2>
    <div class="w-full mb-4 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Kode Tiket</th>
                        <th class="px-4 py-3">Nomor Kursi</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($dt_tiket as $k => $i)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                {{ $k + 1 }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $i->kode_tiket }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $i->nomor_kursi }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $i->harga }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if ($i->status_tiket == 'registrasi')
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-yellow-100 bg-yellow-500 rounded-full">
                                        {{ $i->status_tiket }}
                                    </span>
                                @elseif ($i->status_tiket == 'cek_in')
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-green-100 bg-green-700 rounded-full">
                                        {{ $i->status_tiket }}
                                    </span>
                                @elseif ($i->status_tiket == 'loss')
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-red-100 bg-red-600 rounded-full">
                                        {{ $i->status_tiket }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a href="/lihat-tiket/{{ $i->kode_tiket }}"
                                        class="items-center px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
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
                Showing {{ $dt_tiket->firstItem() }} - {{ $dt_tiket->lastItem() }} of {{ $dt_tiket->total() }}
            </span>
            <span class="col-span-2"></span>
            <!-- Pagination -->
            {{ $dt_tiket->links('layouts.pagination') }}
        </div>
    </div>
@endsection
