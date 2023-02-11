<x-app-layout>
    <div class="container mx-auto mt-10">
        <div class="w-full bg-grey-lightest">

            <div class="container mx-auto p-5">
                <h1 class="font-semibold mb-3 text-2xl">Edit mahasiswa</h1>

                <form action="{{ url('dashboard/store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="update" value="1">
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">NIM mahasiswa</label>
                                    <input type="number" name="nim" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $user->nim }}">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Email mahasiswa</label>
                                    <input type="text" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $user->email }}">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap mahasiswa</label>
                                    <input type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $user->name }}">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="country" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                    <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                        <option value="l" @if ($user->jenis_kelamin == "laki-laki" ) {{ 'selected' }} @endif>Laki-laki</option>
                                        <option value="p" @if ($user->jenis_kelamin == "perempuan" ) {{ 'selected' }} @endif>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @push('scripts')
    @endpush
</x-app-layout>