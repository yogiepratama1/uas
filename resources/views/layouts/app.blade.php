<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Penilaian Mahasiswa Sederha</title>


    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" integrity="sha512-YFENbnqHbCRmJt5d+9lHimyEMt8LKSNTMLSaHjvsclnZGICeY/0KYEeiHwD1Ux4Tcao0h60tdcMv+0GljvWyHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('buttons.dataTables.min.css') }}">
    <script src="{{ asset('jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="{{ asset('app.css') }}" />

    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>

<body class="font-sans antialiased">
    @include('layouts.navigation-home')
    <div class="min-h-screen bg-gray-100 bg">

        <!-- Page Heading -->
        <header class="bg-red-500 text-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <h1 class="font-bold text-xl"> Selamat Datang, {{ Auth::user()->name }}</h1>
                    <ul class="flex items-center mb-0 pl-6">
                        <a href="{{ url('dashboard') }}" class="mr-4 hover:bg-green-700 hover:rounded hover:text-white hover:p-2">
                            Home
                        </a>
                        @if (auth()->user()->role == 'admin')
                        <li class="ml-3 nav-item dropdown">
                            <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Admin </a>
                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                <li><a href="{{ url('dashboard') }}" class="dropdown-item"> <i class="bi bi-people-fill"></i> Daftar Mahasiswa</a></li>
                                <li><a href="{{ url('dashboard/tambah') }}" class="dropdown-item"> <i class="bi bi-person-add"></i> Tambah Mahasiswa</a></li>
                                <li><a href="{{ url('dashboard/matakuliah') }}" class="dropdown-item"> <i class="bi bi-book"></i></i> Daftar Matakuliah</a></li>
                                <li><a href="{{ url('dashboard/tambah/matakuliah') }}" class="dropdown-item"> <i class="bi bi-plus-square"></i></i> Tambah Matakuliah</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    @stack('scripts')
    <script src="{{ asset('app.js') }}"></script>

</body>

</html>