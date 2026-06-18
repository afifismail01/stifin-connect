<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Detail Point User
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow p-6 mb-6">

                <h3 class="text-xl font-bold">
                    {{ $user->name }}
                </h3>

                <p class="text-gray-500">
                    {{ $user->email }}
                </p>

                <div class="mt-4">
                    <span class="text-gray-500">
                        Total Point
                    </span>

                    <h2 class="text-4xl font-bold text-green-600">
                        {{ $totalPoint }}
                    </h2>
                </div>

            </div>

            <div class="bg-white rounded-xl shadow">

                <div class="p-6 border-b">
                    Riwayat Point
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">

                            <tr>
                                <th class="px-6 py-3 text-left">
                                    Sumber
                                </th>

                                <th class="px-6 py-3 text-center">
                                    Point
                                </th>

                                <th class="px-6 py-3 text-center">
                                    Tanggal
                                </th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($points as $point)

                                <tr class="border-b">

                                    <td class="px-6 py-4">
                                        {{ $point->sourceUser?->name ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4 text-center font-bold text-green-600">
                                        {{ $point->points }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ $point->created_at->format('d M Y H:i') }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="3" class="text-center py-8">
                                        Belum ada data point
                                    </td>
                                </tr>

                            @endforelse

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