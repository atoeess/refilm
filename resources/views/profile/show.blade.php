@extends('layouts.user')

@section('content')
<div class="min-h-screen bg-[#0e0e0e] flex justify-center py-16 px-4">

    <div class="w-full max-w-lg bg-[#1a1a1a] border border-gray-700 rounded-xl shadow-xl p-8">

        <!-- Header -->
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-14 h-14 bg-blue-500/20 rounded-full flex items-center justify-center border border-blue-400/40">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A8 8 0 1118.879 6.196 8.001 8.001 0 015.121 17.804z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>

            <div>
                <h2 class="text-3xl font-bold text-white">{{ $user->name }}</h2>
                <p class="text-gray-400 text-sm">Profil Pengguna</p>
            </div>
        </div>

        <!-- Info User -->
        <div class="space-y-4">
            <div class="bg-[#242424] border border-gray-700 p-4 rounded-lg">
                <p class="text-gray-400 text-sm">Nama Lengkap</p>
                <p class="text-xl text-white font-semibold">{{ $user->name }}</p>
            </div>

            <div class="bg-[#242424] border border-gray-700 p-4 rounded-lg">
                <p class="text-gray-400 text-sm">Email</p>
                <p class="text-xl text-white font-semibold">{{ $user->email }}</p>
            </div>
        </div>

        <!-- Button Kembali -->
        <div class="mt-8">
            <a href="{{ route('home') }}"
                class="block text-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-semibold transition-all">
                Kembali ke Beranda
            </a>
        </div>

    </div>
</div>
@endsection
