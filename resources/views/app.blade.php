<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />

    <link rel="shortcut icon" href="storage/images/logos/logo-yayasan-nurul-iman-sindangkerta-favicon.png"
        type="image/x-icon">

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Swiper --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script> --}}

    @vite('resources/js/app.js')

    @inertiaHead
    @routes
</head>

<body class="font-cairo overflow-x-hidden relative">
    @inertia
</body>

</html>
