<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <title>Padel | {{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/38b5f1d5c1.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&family=Rubik:wght@400;600;800&display=swap" rel="stylesheet">
</head>

<body class=" bg-background min-h-screen flex flex-col font-roboto">
    <x-client.navbar></x-client.navbar>
    <div class="relative my-[50px] px-[50px] md:mb-[100px] flex-1">
        {{ $slot }}
    </div>
    <x-client.footer></x-client.footer>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
