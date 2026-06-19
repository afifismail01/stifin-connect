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
                        Total Promotor
                    </p>

                    <h3 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $totalPromotor }}
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
                        Total Point Sistem
                    </p>

                    <h3 class="text-3xl font-bold text-red-600 mt-2">
                        {{ $totalPoint }}
                    </h3>
                </div>

            {{-- Referral Link --}}

            </div>

            {{-- Menu Cepat --}}
            <div class="grid md:grid-cols-4 gap-6 mb-8">

                <a
                    href="{{ route('super-admin.users') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 transition text-white rounded-xl p-6 shadow"
                >
                    <h3 class="font-bold text-lg">
                        Kelola User
                    </h3>

                    <p class="mt-2 text-sm opacity-90">
                        Kelola role Admin, Mitra, dan Promotor.
                    </p>
                </a>

                <a
                    href="{{ route('super-admin.point-report') }}"
                    class="bg-green-600 hover:bg-green-700 transition text-white rounded-xl p-6 shadow"
                >
                    <h3 class="font-bold text-lg">
                        Laporan Point
                    </h3>

                    <p class="mt-2 text-sm opacity-90">
                        Monitoring seluruh point sistem
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
                        {{ $totalAdmin + $totalMitra + $totalPromotor }}
                    </p>
                </div>

            </div>

            {{-- Laporan Jaringan Admin --}}
            <div class="bg-white rounded-xl shadow-sm mb-8">

                <div class="p-6 border-b">
                    <h3 class="text-lg font-bold">
                        Laporan Jaringan Admin
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Monitoring hubungan Admin → Mitra → Promotor
                    </p>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left">
                                    Admin
                                </th>

                                <th class="px-6 py-3 text-left">
                                    Email
                                </th>

                                <th class="px-6 py-3 text-center">
                                    Total Mitra
                                </th>

                                <th class="px-6 py-3 text-center">
                                    Promotor Langsung
                                </th>

                                <th class="px-6 py-3 text-center">
                                    Total Network
                                </th>

                                <th class="px-6 py-3 text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($admins as $admin)

                                <tr class="border-b hover:bg-gray-50">

                                    <td class="px-6 py-4">
                                        {{ $admin->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $admin->email }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ $admin->direct_mitras_count }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ $admin->direct_promotors_count }}
                                    </td>

                                    <td class="px-6 py-4 text-center font-semibold">
                                        {{ $admin->totalNetworkCount() }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                      <a
                                        href="{{ route('super-admin.network.show', $admin->id) }}"
                                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg"
                                    >
                                        Detail
                                    </a>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="5"
                                        class="px-6 py-8 text-center text-gray-500"
                                    >
                                        Belum ada data admin
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

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
                                        {{ ucfirst(str_replace('_', ' ', $user->role->value)) }}
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