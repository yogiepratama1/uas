<x-app-layout>
    <div class="container mx-auto w-1/2 mt-10">
        <h1 class="font-semibold mb-3 text-2xl">Daftar Nilai {{ $user->name }}</h1>
        <div class="bg-white rounded p-5">
            <div class="flex-col justify-center">
                <form action="{{ url('dashboard/ipk/store') }}" method="POST" class="mb-3">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <button type="submit" class="bg-green-500 hover:bg-green-800 p-2 text-white font-semibold rounded">
                        Hitung IPK
                    </button>
                </form>

                <form action="{{ url('dashboard/nilai/'.$user->id.'/tambah') }}" method="GET" class="mb-3">
                    @csrf
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-800 p-2 text-white font-semibold rounded">
                        Tambah Nilai
                    </button>
                </form>
                <table id="table_id" class="border border-collapse border-black">
                    <thead class="">
                        <tr>
                            <th class="text-center border ">Kode <br> Matakuliah</th>
                            <th class="text-center border ">Matakuliah</th>
                            <th class="text-center border ">SKS</th>
                            <th class="text-center border ">Nilai Tugas</th>
                            <th class="text-center border ">Nilai UTS</th>
                            <th class="text-center border ">Nilai UAS</th>
                            <th class="text-center border ">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->nilais as $nilai)
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
                            <td class="border text-center">
                                <a href="{{ url('dashboard/nilai/'.$nilai->id.'/edit') }}">
                                    <button class="bg-blue-500 hover:bg-blue-800 p-2 text-white font-semibold rounded">
                                        Edit
                                    </button>
                                </a>
                                <form action="{{ url('dashboard/nilai/'.$nilai->id.'/delete') }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="bg-red-500 hover:bg-red-800 p-2 text-white font-semibold rounded" onclick="if (!confirm('Yakin hapus nilai mahasiswa ini?')) { return false }">
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