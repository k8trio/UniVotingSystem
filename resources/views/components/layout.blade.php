@props(['guest' => false, 'admin' => false])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PSU-LC SSC Elections 2026</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Lato:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
</head>
<body>

@if ($guest || $admin)
    <header class="navbar-ssc guest-header-only">
        <div class="container-fluid">
            <div class="d-flex align-items-center gap-2">
                <div class="brand-logo">SSC</div>

                <div>
                    <div class="brand-text">
                        PSU-Lingayen Campus
                    </div>

                    <div class="brand-sub">
                        SUPREME STUDENT COUNCIL ELECTIONS 2026
                    </div>
                </div>
            </div>
        </div>
    </header>

@else
    <nav class="navbar navbar-ssc navbar-expand-lg" id="mainNav">
        <div class="container-fluid">

            <a href="/ballot" class="d-flex align-items-center gap-2 text-decoration-none">
                <div class="brand-logo">SSC</div>

                <div>
                    <div class="brand-text">
                        PSU-Lingayen Campus
                    </div>

                    <div class="brand-sub">
                        SUPREME STUDENT COUNCIL ELECTIONS 2026
                    </div>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navMenu">
                <div class="d-flex flex-wrap">
                    <x-nav-link href="/ballot">Cast Vote</x-nav-link>
                    <x-nav-link href="/transparency">Transparency</x-nav-link>
                    <x-nav-link href="/"><i class="bi bi-box-arrow-right me-1"></i>Logout</x-nav-link>
                </div>
            </div>
        </div>
    </nav>

@endif

{{ $slot }}

<div class="ssc-footer">
    PSU-Lingayen Campus · Student Electoral Tribunal 2026
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/ssc.js') }}"></script>

</body>
</html>