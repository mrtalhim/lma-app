@vite(['resources/scss/app.scss', 'resources/js/app.js'])

<div class="d-flex flex-column justify-content-center vh-100">

    <div class="card gap-2 d-flex flex-column p-4 m-4">
        <a href="{{ route('edit-app', auth()->user()->id) }}" class="btn btn-primary">Buka APP</a>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard Pengurus</a>
        <a href="{{ route('logout') }}" class="btn btn-secondary">Keluar</a>
    </div>
</div>