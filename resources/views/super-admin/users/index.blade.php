<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Kelola User
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-xl p-6">

                {{-- Filter --}}
                <div class="flex justify-between items-center mb-6">

                    <h3 class="text-lg font-bold">
                        Daftar User
                    </h3>

                    <form method="GET">

                        <select
                            name="role"
                            onchange="this.form.submit()"
                            class="border-gray-300 rounded-lg"
                        >

                            <option value="">
                                Semua Role
                            </option>

                            <option
                                value="admin"
                                @selected($selectedRole === 'admin')
                            >
                                Admin
                            </option>

                            <option
                                value="mitra"
                                @selected($selectedRole === 'mitra')
                            >
                                Mitra
                            </option>

                            <option
                                value="promotor"
                                @selected($selectedRole === 'promotor')
                            >
                                Promotor
                            </option>

                        </select>

                    </form>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="text-left px-4 py-3">
                                    No
                                </th>

                                <th class="text-left px-4 py-3">
                                    Nama
                                </th>

                                <th class="text-left px-4 py-3">
                                    Email
                                </th>

                                <th class="text-left px-4 py-3">
                                    Role
                                </th>

                                <th class="text-left px-4 py-3">
                                    Referral Code
                                </th>

                                <th class="text-left px-4 py-3">
                                    Upline
                                </th>

                                <th class="text-left px-4 py-3">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($users as $user)

                                <tr class="border-b hover:bg-gray-50">

                                    <td class="px-4 py-4">
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>

                                    <td class="px-4 py-4">
                                        {{ $user->name }}
                                    </td>

                                    <td class="px-4 py-4">
                                        {{ $user->email }}
                                    </td>

                                    <td class="px-4 py-4">

                                        @if($user->role->value === 'super_admin')

                                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                                Super Admin
                                            </span>

                                        @elseif($user->role->value === 'admin')

                                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
                                                Admin
                                            </span>

                                        @elseif($user->role->value === 'mitra')

                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                                Mitra
                                            </span>

                                        @else

                                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                                Promotor
                                            </span>

                                        @endif

                                    </td>

                                    <td class="px-4 py-4">
                                        {{ $user->referral_code ?? '-' }}
                                    </td>

                                    <td class="px-4 py-4">
                                        {{ $user->upline?->referrer?->name ?? '-' }}
                                    </td>

                                    <td class="px-4 py-4">

                                        @if($user->role->value !== 'super_admin')

                                            <form
                                                method="POST"
                                                action="{{ route('super-admin.users.role', $user) }}"
                                                class="flex items-center gap-2 flex-wrap"
                                            >

                                                @csrf
                                                @method('PATCH')

                                                <select
                                                    name="role"
                                                    class="border-gray-300 rounded-lg"
                                                >

                                                    <option
                                                        value="admin"
                                                        @selected($user->role->value === 'admin')
                                                    >
                                                        Admin
                                                    </option>

                                                    <option
                                                        value="mitra"
                                                        @selected($user->role->value === 'mitra')
                                                    >
                                                        Mitra
                                                    </option>

                                                    <option
                                                        value="promotor"
                                                        @selected($user->role->value === 'promotor')
                                                    >
                                                        Promotor
                                                    </option>

                                                </select>

                                                <button
                                                    type="submit"
                                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded-lg text-sm"
                                                >
                                                    Update
                                                </button>

                                                <a
                                                    href="{{ route('super-admin.network.show', $user->id) }}"
                                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm"
                                                >
                                                    Network
                                                </a>
                                            
                                                <a
                                                    href="{{ route('super-admin.user.points', $user->id) }}"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm"
                                                >
                                                    Point
                                                </a>

                                            </form>

                                        @else

                                            <span class="text-red-600 font-semibold">
                                                Protected
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="7"
                                        class="text-center py-6 text-gray-500"
                                    >
                                        Tidak ada data user
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $users->links() }}
                </div>

            </div>

        </div>

    </div>

</x-app-layout>