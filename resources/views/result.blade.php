@vite(['resources/scss/app.scss', 'resources/js/app.js'])

<center>
    <a href="{{ route('edit-app', $id) }}" class="btn btn-primary">Buka APP</a>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard Pengurus</a>
    <a href="{{ route('logout') }}" class="btn btn-secondary">Keluar</a>
</center>