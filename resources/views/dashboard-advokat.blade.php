<x-app-layout>
    <div class="container mx-auto mt-10">
        <h1 class="font-semibold mb-3 text-2xl">Daftar konsultasi</h1>
        <div class="bg-white rounded p-5">
            <div class="flex-col justify-center">
                @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
                @endif
                <table id="table_id" class="border border-collapse border-black">
                    <thead class="">
                        <tr>
                            <th class="text-center border ">Id</th>
                            <th class="text-center border ">Nama Advokat</th>
                            <th class="text-center border ">Alamat Advokat</th>
                            <th class="text-center border ">No Telp</th>
                            <th class="text-center border ">Jenis Kelamin</th>
                            <th class="text-center border ">Bidang Hukum</th>
                            <th class="text-center border ">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="text-center border "> {{ $user->id }} </td>
                            <td class="border "> {{ $user->advokat->nama_advokat }} </td>
                            <td class="border "> {{ $user->advokat->alamat_advokat }} </td>
                            <td class="border "> {{ $user->advokat->no_telp }} </td>
                            <td class="border text-center">
                                @if ($user->advokat->jenis_kelamin == 'l')
                                Laki-laki
                                @else
                                Perempuan
                                @endif
                            </td>
                            <td class="border "> {{ $user->advokat->bidang_hukum }} </td>
                            <td class="border flex justify-center space-x-3">
                                <a href="{{ url('dashboard/konsultasi/'.$user->id.'/advokat') }}">
                                    <button class="bg-blue-500 hover:bg-blue-800 p-2 text-white font-semibold rounded">
                                        Edit
                                    </button>
                                </a>
                                <form action="{{ url('dashboard/konsultasi/'.$user->id.'/advokat/delete') }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="bg-red-500 hover:bg-red-800 p-2 text-white font-semibold rounded" onclick="if (!confirm('Yakin hapus advokat ini?')) { return false }">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
    @endpush
</x-app-layout>