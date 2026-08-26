<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    {{-- NAVBAR HANYA SAAT LOGIN --}}
    
    @auth
        @include('layouts.navbar')
    @endauth

    {{-- CONTENT --}}
    <div class="container mt-4">
        @yield('content')
    </div>

</body>
</html>