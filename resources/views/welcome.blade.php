<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Penilaian Mahasiswa Sederhana </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Roboto:wght@300;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="lawfirm\css\style.css" rel="stylesheet">
</head>

<body>


    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 pb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item position-relative active" style="height: 100vh; min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="lawfirm\img\ubk.jpg" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h3 class="display-2 text-capitalize text-white mb-4">Penilaian Mahasiswa Sederhana</h3>
                            <a class="btn btn-primary py-3 px-5 mt-2" href="{{ url('login') }}">Mulai</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary px-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- Template Javascript -->
    <script src="lawfirm\js\main.js"></script>
</body>

</html>