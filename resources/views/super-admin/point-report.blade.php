<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Laporan Point
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white rounded-xl shadow">

                <div class="p-6 border-b">
                    <h3 class="font-bold">
                        Riwayat Point
                    </h3>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left">
                                    User
                                </th>

                                <th class="px-6 py-3 text-left">
                                    Sumber
                                </th>

                                <th class="px-6 py-3 text-left">
                                    Point
                                </th>

                                <th class="px-6 py-3 text-left">
                                    Tanggal
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($points as $point)

                                <tr class="border-b">

                                    <td class="px-6 py-4">
                                        {{ $point->user->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $point->sourceUser?->name ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4 text-green-600 font-bold">
                                        +{{ $point->points }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $point->created_at->format('d M Y') }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="p-6">
                    {{ $points->links() }}
                </div>

            </div>

        </div>
    </div>

</x-app-layout>