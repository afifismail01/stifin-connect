<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Network Report
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h3 class="text-2xl font-bold text-indigo-600">
                    {{ $admin->name }}
                </h3>

                <p class="text-gray-500 mt-1">
                    {{ $admin->email }}
                </p>
            </div>

            {{-- Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                    <p class="text-gray-500 text-sm">
                        Total Mitra
                    </p>

                    <h3 class="text-3xl font-bold text-blue-600 mt-2">
                        {{ $admin->direct_mitras_count }}
                    </h3>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
                    <p class="text-gray-500 text-sm">
                        Promotor Langsung
                    </p>

                    <h3 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $admin->direct_promotors_count }}
                    </h3>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
                    <p class="text-gray-500 text-sm">
                        Total Network
                    </p>

                    <h3 class="text-3xl font-bold text-purple-600 mt-2">
                        {{ $admin->totalNetworkCount() }}
                    </h3>
                </div>

            </div>

            {{-- Struktur Jaringan --}}
            <div class="bg-white rounded-xl shadow-sm mb-8">

                <div class="p-6 border-b">
                    <h3 class="text-lg font-bold">
                        Struktur Jaringan
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Hubungan Admin → Mitra → Promotor
                    </p>
                </div>

                <div class="p-6">

                    @forelse($admin->downlines as $referral)

                        @php
                            $member = $referral->referred;
                        @endphp

                        @if($member)

                            {{-- MITRA --}}
                            @if($member->role->value === 'mitra')

                                <div class="border rounded-xl p-4 mb-4 bg-blue-50">

                                    <div class="font-bold text-blue-700 text-lg">
                                        👤 {{ $member->name }}
                                    </div>

                                    <div class="text-sm text-gray-500 mb-3">
                                        Mitra
                                    </div>

                                    @forelse($member->downlines as $child)

                                        @if($child->referred)

                                            <div class="ml-6 py-1 text-gray-700">
                                                └── 👥 {{ $child->referred->name }}
                                            </div>

                                        @endif

                                    @empty

                                        <div class="ml-6 text-gray-400">
                                            Belum memiliki promotor
                                        </div>

                                    @endforelse

                                </div>

                            @else

                                {{-- PROMOTOR LANGSUNG ADMIN --}}
                                <div class="border rounded-xl p-4 mb-3 bg-green-50">

                                    <div class="font-semibold text-green-700">
                                        👥 {{ $member->name }}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        Promotor Langsung Admin
                                    </div>

                                </div>

                            @endif

                        @endif

                    @empty

                        <div class="text-center text-gray-500 py-8">
                            Belum ada jaringan.
                        </div>

                    @endforelse

                </div>

            </div>

            {{-- Rekap Data --}}
            <div class="bg-white rounded-xl shadow-sm">

                <div class="p-6 border-b">
                    <h3 class="text-lg font-bold">
                        Rekap Jaringan
                    </h3>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left">
                                    Nama
                                </th>

                                <th class="px-6 py-3 text-left">
                                    Role
                                </th>

                                <th class="px-6 py-3 text-left">
                                    Upline
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($admin->downlines as $referral)

                                @php
                                    $member = $referral->referred;
                                @endphp

                                @if($member)

                                    <tr class="border-b">

                                        <td class="px-6 py-4">
                                            {{ $member->name }}
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ ucfirst($member->role->value) }}
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $admin->name }}
                                        </td>

                                    </tr>

                                    @foreach($member->downlines as $child)

                                        @if($child->referred)

                                            <tr class="border-b bg-gray-50">

                                                <td class="px-6 py-4 pl-12">
                                                    ↳ {{ $child->referred->name }}
                                                </td>

                                                <td class="px-6 py-4">
                                                    {{ ucfirst($child->referred->role->value) }}
                                                </td>

                                                <td class="px-6 py-4">
                                                    {{ $member->name }}
                                                </td>

                                            </tr>

                                        @endif

                                    @endforeach

                                @endif

                            @empty

                                <tr>
                                    <td colspan="3" class="text-center py-8 text-gray-500">
                                        Belum ada data jaringan
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- Tombol Kembali --}}
            <div class="mt-6">

                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700"
                >
                    ← Kembali ke Dashboard
                </a>

            </div>

        </div>
    </div>

</x-app-layout>