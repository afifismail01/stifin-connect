<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Dashboard Super Admin
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
                    <p class="text-gray-500 text-sm">
                        Total Admin
                    </p>

                    <h3 class="text-3xl font-bold text-purple-600 mt-2">
                        {{ $totalAdmin }}
                    </h3>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                    <p class="text-gray-500 text-sm">
                        Total Mitra
                    </p>

                    <h3 class="text-3xl font-bold text-blue-600 mt-2">
                        {{ $totalMitra }}
                    </h3>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
                    <p class="text-gray-500 text-sm">
                        Total Peserta
                    </p>

                    <h3 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $totalPeserta }}
                    </h3>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-orange-500">
                    <p class="text-gray-500 text-sm">
                        Total Referral
                    </p>

                    <h3 class="text-3xl font-bold text-orange-600 mt-2">
                        {{ $totalReferral }}
                    </h3>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-red-500">
                    <p class="text-gray-500 text-sm">
                        Total Point
                    </p>

                    <h3 class="text-3xl font-bold text-red-600 mt-2">
                        {{ $totalPoint }}
                    </h3>
                </div>

            </div>

            {{-- Menu Cepat --}}
            <div class="grid md:grid-cols-3 gap-6 mb-8">

                <a
                    href="{{ route('super-admin.users') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 transition text-white rounded-xl p-6 shadow"
                >
                    <h3 class="font-bold text-lg">
                        Kelola User
                    </h3>

                    <p class="mt-2 text-sm opacity-90">
                        Kelola role Admin, Mitra, dan Peserta.
                    </p>
                </a>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-semibold text-gray-700">
                        Sistem Status
                    </h3>

                    <p class="mt-3 text-green-600 font-semibold">
                        ✓ Online
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-semibold text-gray-700">
                        Total User
                    </h3>

                    <p class="text-3xl font-bold mt-2">
                        {{ $totalAdmin + $totalMitra + $totalPeserta }}
                    </p>
                </div>

            </div>

            {{-- User Terbaru --}}
            <div class="bg-white rounded-xl shadow-sm">

                <div class="p-6 border-b">
                    <h3 class="text-lg font-bold">
                        User Terbaru
                    </h3>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="text-left px-6 py-3">
                                    Nama
                                </th>

                                <th class="text-left px-6 py-3">
                                    Email
                                </th>

                                <th class="text-left px-6 py-3">
                                    Role
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($latestUsers as $user)

                                <tr class="border-b hover:bg-gray-50">

                                    <td class="px-6 py-4">
                                        {{ $user->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $user->email }}
                                    </td>

                                    <td class="px-6 py-4">

                                        @if($user->role->value === 'super_admin')
                                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs">
                                                Super Admin
                                            </span>

                                        @elseif($user->role->value === 'admin')
                                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs">
                                                Admin
                                            </span>

                                        @elseif($user->role->value === 'mitra')
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">
                                                Mitra
                                            </span>

                                        @else
                                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                                                Peserta
                                            </span>
                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>