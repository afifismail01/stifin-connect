<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            {{ isset($training) ? 'Edit Training' : 'Tambah Training' }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm p-6">

                <form
                    method="POST"
                    action="{{ isset($training)
                        ? route('trainings.update', $training)
                        : route('trainings.store') }}"
                >
                    @csrf

                    @if(isset($training))
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label class="block font-medium mb-1">
                            Judul
                        </label>

                        <input
                            type="text"
                            name="title"
                            class="w-full border rounded-lg"
                            value="{{ old('title', $training->title ?? '') }}"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">
                            Deskripsi
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="w-full border rounded-lg"
                        >{{ old('description', $training->description ?? '') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">
                            Harga
                        </label>

                        <input
                            type="number"
                            name="price"
                            class="w-full border rounded-lg"
                            value="{{ old('price', $training->price ?? '') }}"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">
                            Lokasi
                        </label>

                        <input
                            type="text"
                            name="location"
                            class="w-full border rounded-lg"
                            value="{{ old('location', $training->location ?? '') }}"
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">
                            Tanggal Training
                        </label>

                        <input
                            type="datetime-local"
                            name="training_date"
                            class="w-full border rounded-lg"
                            value="{{ old(
                                'training_date',
                                isset($training) && $training->training_date
                                    ? \Carbon\Carbon::parse($training->training_date)->format('Y-m-d\TH:i')
                                    : ''
                            ) }}"
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">
                            Kuota
                        </label>

                        <input
                            type="number"
                            name="quota"
                            min="0"
                            class="w-full border rounded-lg"
                            value="{{ old('quota', $training->quota ?? 0) }}"
                        >
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-1">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border rounded-lg"
                        >
                            <option
                                value="draft"
                                @selected(old('status', $training->status ?? 'draft') === 'draft')
                            >
                                Draft
                            </option>

                            <option
                                value="published"
                                @selected(old('status', $training->status ?? '') === 'published')
                            >
                                Published
                            </option>

                            <option
                                value="closed"
                                @selected(old('status', $training->status ?? '') === 'closed')
                            >
                                Closed
                            </option>
                        </select>
                    </div>

                    <button
                        type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg"
                    >
                        {{ isset($training)
                            ? 'Update Training'
                            : 'Simpan Training' }}
                    </button>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>