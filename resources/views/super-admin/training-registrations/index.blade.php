<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Registrasi Training
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm overflow-hidden">

                <table class="w-full">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left">Promotor</th>
                            <th class="px-4 py-3 text-left">Training</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($registrations as $registration)

                            <tr class="border-b">

                                <td class="px-4 py-4">
                                    {{ $registration->user->name }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $registration->training->title }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ ucfirst($registration->status->value) }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $registration->created_at->format('d M Y H:i') }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-500">
                                    Belum ada registrasi training
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-6">
                {{ $registrations->links() }}
            </div>

        </div>
    </div>

</x-app-layout>