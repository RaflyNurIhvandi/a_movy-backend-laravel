@extends('layouts.app')

@section('menu-tiket')
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
@endsection
@section('content')
    <h2 class="mt-6 mb-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Detail Tiket
    </h2>
    @foreach($dt_tiket as $t)
        <div class="flex flex-row gap-6">
            <div class="flex flex-col gap-2">
                <h4 class="text-md font-medium text-gray-600 dark:text-gray-300">
                    Kode Tiket
                </h4>
                <h4 class="text-md font-medium text-gray-600 dark:text-gray-300">
                    Nama
                </h4>
                <h4 class="text-md font-medium text-gray-600 dark:text-gray-300">
                    Film
                </h4>
                <h4 class="text-md font-medium text-gray-600 dark:text-gray-300">
                    Auditorium
                </h4>
                <h4 class="text-md font-medium text-gray-600 dark:text-gray-300">
                    Kode Registrasi
                </h4>
                <h4 class="text-md font-medium text-gray-600 dark:text-gray-300">
                    Status Pembayaran
                </h4>
                <h4 class="text-md font-medium text-gray-600 dark:text-gray-300">
                    Cek In
                </h4>
            </div>
            <div class="flex flex-col gap-2">
                <h4 class="text-md font-semibold text-gray-600 dark:text-gray-300">
                    : {{ $t->kode_tiket }}
                </h4>
                <h4 class="text-md font-semibold text-gray-600 dark:text-gray-300">
                    : @foreach($dt_reg as $r){{ $r->name }}@endforeach
                </h4>
                <h4 class="text-md font-semibold text-gray-600 dark:text-gray-300">
                    : @foreach($dt_film as $f){{ $f->nama }}@endforeach
                </h4>
                <h4 class="text-md font-semibold text-gray-600 dark:text-gray-300">
                    : @foreach($dt_aud as $a){{ $a->nama }}@endforeach
                </h4>
                <h4 class="text-md font-semibold text-gray-600 dark:text-gray-300">
                    : @foreach($dt_reg as $r){{ $r->kode_registrasi }}@endforeach
                </h4>
                <h4 class="text-md font-semibold text-gray-600 dark:text-gray-300">
                    : @foreach($dt_reg as $r){{ $r->status_pembayaran }}@endforeach
                </h4>
                @if ($t->status_tiket == 'registrasi')
                    <h4 class="text-md flex flex-row font-semibold text-gray-600 dark:text-gray-300">
                        <span>:</span>
                        <a href="/cek-in/{{ $t->kode_tiket }}"
                            class="mt-[4px] px-1 text-sm font-medium text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </a>
                        <span class="mt-[1.5px] ml-[1px]">Cek in Sekarang</span>
                    </h4>
                @elseif ($t->status_tiket == 'cek_in')
                    <h4 class="text-md flex flex-row font-semibold text-gray-600 dark:text-gray-300">
                        <span>:</span>
                        <button type="button" disabled
                            class="mt-[3px] px-1 text-sm font-medium text-purple-600 rounded-lg dark:text-green-400 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                        <span class="mt-[1.2px] ml-[1px]">Cek in</span>
                    </h4>
                @elseif ($t->status_tiket == 'loss')
                    <h4 class="text-md flex flex-row font-semibold text-gray-600 dark:text-gray-300">
                        <span>:</span>
                        <button type="button" disabled
                            class="mt-[3px] px-1 text-sm font-medium text-purple-600 rounded-lg dark:text-red-500 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                        <span class="mt-[1.2px] ml-[1px]">Loss</span>
                    </h4>
                @endif
            </div>
        </div>
        <div class="flex flex-row gap-4">
            <a href="/tiket"
                class="mt-4 flex items-center w-24 justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Kembali</span>
            </a>
            @if ($t->status_tiket == 'registrasi' || $t->status_tiket == 'loss')
                <button type="button" disabled
                    class="mt-4 flex items-center w-24 justify-between px-4 py-2 text-sm font-medium leading-5 text-slate-400 transition-colors duration-150 bg-slate-600 border border-transparent rounded-lg active:bg-slate-600 hover:bg-slate-700 focus:outline-none focus:shadow-outline-purple">
                    <span>Cetak</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 ml-2 -mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                    </svg>
                </button>
            @else
                <a href="/cetak-tiket/{{ $t->kode_tiket }}" target="_blank"
                    class="mt-4 flex items-center w-24 justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <span>Cetak</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 ml-2 -mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                    </svg>
                </a>
            @endif
        </div>
    @endforeach
@endsection
