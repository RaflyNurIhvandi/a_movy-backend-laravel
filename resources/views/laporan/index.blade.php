@extends('layouts.app')

@section('menu-laporan')
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
@endsection
@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Laporan
    </h2>
    <div class="w-full mb-4 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Penayangan</th>
                        <th class="px-4 py-3">Jumlah Tiket Terjual</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($dt_tiket as $k => $i)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                {{ $k + 1 }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $i->kode_penayangan }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $i->ke_samping }}
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
