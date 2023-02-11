<x-app-layout>
    <div class="container mx-auto mt-10">
        <div class="w-full bg-grey-lightest">

            <div class="container mx-auto p-5">
                <h1 class="font-semibold mb-3 text-2xl">Tambah Nilai {{ $user->name }}</h1>

                <form action="{{ url('dashboard/store/matakuliah') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pilih_admin" value="1">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Matakuliah</label>
                                    <select name="matakuliah_id" id="">
                                        @foreach ($matakuliahs as $matakuliah)
                                        <option value="{{ $matakuliah->id }}">{{ $matakuliah->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Nilai Tugas</label>
                                    <input type="number" name="nilai_tugas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Nilai UTS</label>
                                    <input type="number" name="nilai_uts" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Nilai UAS</label>
                                    <input type="number" name="nilai_uas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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