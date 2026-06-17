<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Referral Link --}}
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold mb-4">
                    Referral Link Admin
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
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

                <div class="bg-white shadow rounded-xl p-6 border-l-4 border-blue-500">
                    <p class="text-gray-500 text-sm">Total Mitra</p>
                    <h3 class="text-3xl font-bold text-blue-600 mt-2">
                        {{ $totalMitra }}
                    </h3>
                </div>

                <div class="bg-white shadow rounded-xl p-6 border-l-4 border-green-500">
                    <p class="text-gray-500 text-sm">Total Peserta</p>
                    <h3 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $totalPeserta }}
                    </h3>
                </div>

                <div class="bg-white shadow rounded-xl p-6 border-l-4 border-yellow-500">
                    <p class="text-gray-500 text-sm">Total Referral</p>
                    <h3 class="text-3xl font-bold text-yellow-600 mt-2">
                        {{ $totalReferral }}
                    </h3>
                </div>

                <div class="bg-white shadow rounded-xl p-6 border-l-4 border-purple-500">
                    <p class="text-gray-500 text-sm">Total Poin Saya</p>
                    <h3 class="text-3xl font-bold text-purple-600 mt-2">
                        {{ $totalPoint }}
                    </h3>
                </div>

            </div>

            {{-- Daftar Mitra --}}
            <div class="bg-white shadow rounded-xl p-6 mb-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">
                        Daftar Mitra
                    </h3>

                    <span class="text-sm text-gray-500">
                        Total: {{ $mitras->count() }}
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">

                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-3 border text-left">Nama</th>
                                <th class="p-3 border text-left">Email</th>
                                <th class="p-3 border text-left">Referral Code</th>
                                <th class="p-3 border text-center">Downline</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($mitras as $mitra)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 border">
                                        {{ $mitra->name }}
                                    </td>

                                    <td class="p-3 border">
                                        {{ $mitra->email }}
                                    </td>

                                    <td class="p-3 border font-mono">
                                        {{ $mitra->referral_code }}
                                    </td>

                                    <td class="p-3 border text-center font-bold">
                                        {{ $mitra->downlines_count }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-4 border text-center text-gray-500">
                                        Belum ada data mitra
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>

            {{-- Daftar Peserta --}}
            <div class="bg-white shadow rounded-xl p-6 mb-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">
                        Daftar Peserta
                    </h3>

                    <span class="text-sm text-gray-500">
                        Total: {{ $pesertas->count() }}
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">

                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-3 border text-left">Nama</th>
                                <th class="p-3 border text-left">Email</th>
                                <th class="p-3 border text-left">Referral Code</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pesertas as $peserta)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 border">
                                        {{ $peserta->name }}
                                    </td>

                                    <td class="p-3 border">
                                        {{ $peserta->email }}
                                    </td>

                                    <td class="p-3 border font-mono">
                                        {{ $peserta->referral_code }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-4 border text-center text-gray-500">
                                        Belum ada data peserta
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>

            {{-- Riwayat Poin --}}
            <div class="bg-white shadow rounded-xl p-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">
                        Riwayat Poin Terakhir
                    </h3>

                    <span class="text-sm text-gray-500">
                        {{ $pointHistories->count() }} Data
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">

                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-3 border text-left">
                                    Tanggal
                                </th>

                                <th class="p-3 border text-left">
                                    Sumber
                                </th>

                                <th class="p-3 border text-left">
                                    Keterangan
                                </th>

                                <th class="p-3 border text-center">
                                    Poin
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pointHistories as $point)
                                <tr class="hover:bg-gray-50">

                                    <td class="p-3 border">
                                        {{ $point->created_at->format('d M Y H:i') }}
                                    </td>

                                    <td class="p-3 border">
                                        {{ $point->sourceUser?->name ?? '-' }}
                                    </td>

                                    <td class="p-3 border">
                                        {{ $point->description }}
                                    </td>

                                    <td class="p-3 border text-center font-bold text-green-600">
                                        +{{ $point->points }}
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-4 border text-center text-gray-500">
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
        const link =
            document.getElementById('referralLink');

        navigator.clipboard.writeText(
            link.value
        );

        alert('Referral link berhasil disalin');
    }
</script>
</x-app-layout>