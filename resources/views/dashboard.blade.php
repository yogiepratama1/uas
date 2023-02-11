<x-app-layout>
    @if (auth()->user()->role == 'user')
    <div class="container mx-auto w-1/2 mt-10">
        <h1 class="font-semibold mb-3 text-2xl">Daftar Nilai</h1>
        @if (count($nilais) == 0)
        <a href="{{ url('dashboard/pilih/matakuliah') }}">
            <button class="bg-green-500 hover:bg-green-800 p-2 text-white font-semibold rounded">
                Pilih Matakuliah
            </button>
        </a>
        @endif

        <div class="bg-white rounded p-5">
            <div class="flex-col justify-center">
                @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
                @endif
                <h1 class="font-semibold mb-3 text-2xl">IPK = {{ $user->ipk }} </h1>
                <table id="table_id" class="border border-collapse border-black">
                    <thead class="">
                        <tr>
                            <th class="text-center border ">Kode <br> Matakuliah</th>
                            <th class="text-center border ">Matakuliah</th>
                            <th class="text-center border ">SKS</th>
                            <th class="text-center border ">Nilai Tugas</th>
                            <th class="text-center border ">Nilai UTS</th>
                            <th class="text-center border ">Nilai UAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilais as $nilai)
                        <tr>
                            <td class="text-center border ">{{ $nilai->matakuliah->id }} </td>
                            <td class="border "> {{ $nilai->matakuliah->nama }} </td>
                            <td class="border text-center"> {{ $nilai->matakuliah->sks }} </td>
                            <td class="border text-center">
                                @if (!$nilai->nilai_tugas)
                                0
                                @else
                                {{ $nilai->nilai_tugas }}
                                @endif
                            </td>
                            <td class="border text-center">
                                @if (!$nilai->nilai_uts)
                                0
                                @else
                                {{ $nilai->nilai_uts }}
                                @endif
                            </td>
                            <td class="border text-center">
                                @if (!$nilai->nilai_uas)
                                0
                                @else
                                {{ $nilai->nilai_uas }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="container mx-auto w-1/2 mt-10">
        <h1 class="font-semibold mb-3 text-2xl">Daftar Mahasiswa</h1>
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
                            <th class="text-center border ">NIM</th>
                            <th class="text-center border ">Nama</th>
                            <th class="text-center border ">Jenis Kelamin</th>
                            <th class="text-center border ">IPK</th>
                            <th class="text-center border ">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="text-center border ">{{ $user->nim }} </td>
                            <td class="border "> {{ $user->name }} </td>
                            <td class="border text-center">
                                @if ($user->jenis_kelamin == 'l')
                                Laki-laki
                                @else
                                Perempuan
                                @endif
                            </td>
                            <td class="border text-center"> {{ number_format($user->ipk, 2, '.', '') }} </td>
                            <td class="border flex justify-center space-x-3">
                                <a href="{{ url('dashboard/nilai/'.$user->id.'') }}">
                                    <button class="bg-yellow-500 hover:bg-yellow-800 p-2 text-white font-semibold rounded">
                                        Nilai
                                    </button>
                                </a>
                                <a href="{{ url('dashboard/'.$user->id.'') }}">
                                    <button class="bg-blue-500 hover:bg-blue-800 p-2 text-white font-semibold rounded">
                                        Edit
                                    </button>
                                </a>
                                <form action="{{ url('dashboard/'.$user->id.'/delete') }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="bg-red-500 hover:bg-red-800 p-2 text-white font-semibold rounded" onclick="if (!confirm('Yakin hapus mahasiswa ini?')) { return false }">
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
    @endif
    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
    @endpush
</x-app-layout>