<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibAdmin - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f8f9fa; }
        #sidebar { min-width: 250px; min-height: 100vh; background: #2c3e50; color: #fff; }
        #sidebar .nav-link { color: #bdc3c7; margin: 5px 15px; }
        #sidebar .nav-link.active { background: #34495e; color: #fff; }
        .navbar { background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="d-flex">
    @include('layouts.partials.sidebar')

    <div class="flex-grow-1 d-flex flex-column">
        @include('layouts.partials.navbar')

        <main class="container-fluid p-4">
            @yield('content')
        </main>

        @include('layouts.partials.footer')
    </div>
</div>

</body>
</html>