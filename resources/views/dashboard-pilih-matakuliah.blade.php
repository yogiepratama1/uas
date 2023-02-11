<x-app-layout>
    <div class="container mx-auto mt-10">
        <div class="w-full bg-grey-lightest">

            <div class="container mx-auto p-5">
                <h1 class="font-semibold mb-3 text-2xl">Pilih Matakuliah</h1>

                <form action="{{ url('dashboard/store/matakuliah') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pilih" value="1">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            @foreach ($matakuliahs as $matakuliah)
                            <div class="flex items-start space-x-3 py-6">
                                <input type="checkbox" name="matakuliah_id[]" value="{{ $matakuliah->id }}" class="border-gray-300 rounded h-5 w-5" />
                                <div class="flex flex-col">
                                    <h1 class="text-gray-700 font-medium leading-none">{{ $matakuliah->nama }}</h1>
                                </div>
                            </div>
                            @endforeach
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