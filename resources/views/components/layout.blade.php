@props(['guest' => false])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSC Elections 2025</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@if (!$guest)
    <nav class="navbar navbar-expand-lg navbar-ssc">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/home">
                <div class="brand-logo">SSC</div>
                <div>
                    <div class="brand-title">PSU-Lingayen Campus</div>
                    <div class="brand-subtitle">Supreme Student Council Elections 2026</div>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <div class="navbar-nav ms-auto">
                    <x-nav-link href="/ballot">Cast Vote</x-nav-link>
                    <x-nav-link href="/transparency">Transparency</x-nav-link>
                    <x-nav-link href="/">Logout</x-nav-link>
                </div>
            </div>
        </div>
    </nav>
@endif

{{ $slot }}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>