<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Training Management
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a
               href="{{ route('trainings.create') }}"
                class="inline-block mb-6 bg-indigo-600 text-white px-4 py-2 rounded-lg"
            >
                + Tambah Training
            </a>

            <div class="bg-white rounded-xl shadow-sm overflow-hidden">

                <table class="w-full">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left">Judul</th>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                            <th class="px-4 py-3 text-left">Lokasi</th>
                            <th class="px-4 py-3 text-left">Kuota</th>
                            <th class="px-4 py-3 text-left">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($trainings as $training)
                            <tr class="border-b">
                                <td class="px-4 py-3">
                                    {{ $training->title }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ \Carbon\Carbon::parse($training->training_date)->translatedFormat('d F Y H:i') }} WIB
                                </td>

                                <td class="px-4 py-3">
                                    {{ $training->location }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $training->quota }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $training->status }}
                                </td>

                                <td class="px-4 py-4 flex gap-2">

                                <a
                                    href="{{ route('trainings.edit', $training) }}"
                                    class="bg-yellow-500 text-white px-3 py-2 rounded-lg"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('trainings.destroy', $training) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus training ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="bg-red-600 text-white px-3 py-2 rounded-lg"
                                    >
                                        Hapus
                                    </button>
                                </form>

                            </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6">
                                    Belum ada training
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>