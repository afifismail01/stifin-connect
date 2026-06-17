<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Mitra
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Referral Code --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold mb-2">
                    Referral Code
                </h3>

                <p class="text-2xl font-mono text-indigo-600">
                    {{ $user->referral_code }}
                </p>
            </div>

            {{-- Referral Link --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">
                    Referral Link
                </h3>

                <input
                    id="referralLink"
                    type="text"
                    readonly
                    value="{{ $referralLink }}"
                    class="w-full rounded-md border-gray-300 shadow-sm"
                >

                <button
                    onclick="copyReferralLink()"
                    class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700"
                >
                    Copy Link
                </button>
            </div>

            {{-- Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-gray-500 text-sm">
                        Total Downline
                    </h3>

                    <p class="text-4xl font-bold text-indigo-600 mt-2">
                        {{ $downlines->count() }}
                    </p>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-gray-500 text-sm">
                        Total Poin
                    </h3>

                    <p class="text-4xl font-bold text-green-600 mt-2">
                        {{ $totalPoint }}
                    </p>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-gray-500 text-sm">
                        Upline Admin
                    </h3>

                    <p class="text-xl font-semibold mt-2">
                        {{ $upline?->name ?? '-' }}
                    </p>
                </div>

            </div>

            {{-- Daftar Downline --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">
                    Daftar Downline
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-3 text-left">
                                    Nama
                                </th>

                                <th class="border p-3 text-left">
                                    Email
                                </th>

                                <th class="border p-3 text-left">
                                    Referral Code
                                </th>

                                <th class="border p-3 text-left">
                                    Tanggal Join
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($downlines as $downline)
                                <tr>
                                    <td class="border p-3">
                                        {{ $downline->referred->name }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $downline->referred->email }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $downline->referred->referral_code }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $downline->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="border p-4 text-center text-gray-500">
                                        Belum ada downline
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Riwayat Poin --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">
                    Riwayat Poin
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-3 text-left">
                                    Tanggal
                                </th>

                                <th class="border p-3 text-left">
                                    Dari Peserta
                                </th>

                                <th class="border p-3 text-left">
                                    Keterangan
                                </th>

                                <th class="border p-3 text-center">
                                    Poin
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pointHistories as $point)
                                <tr>
                                    <td class="border p-3">
                                        {{ $point->created_at->format('d M Y H:i') }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $point->sourceUser?->name ?? '-' }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $point->description }}
                                    </td>

                                    <td class="border p-3 text-center font-bold text-green-600">
                                        +{{ $point->points }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="border p-4 text-center text-gray-500">
                                        Belum ada riwayat poin
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        function copyReferralLink() {
            const link = document.getElementById('referralLink');

            navigator.clipboard.writeText(link.value);

            alert('Referral link berhasil disalin');
        }
    </script>
</x-app-layout>