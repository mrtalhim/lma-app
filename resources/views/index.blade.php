@php
    $aims = 0;
    $badan = '';
    $cabang = '';
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <title>Login Anggota</title>
</head>
<body class="bg-dark-subtle">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <form method="POST" action="{{ route('login') }}" class="card d-flex flex-column p-4">
            @csrf
            <h1>Login Anggota</h1>
            <span class="d-flex flex-row form-label">No. AIMS<span class="text-danger">*</span></span>
            <input type="number" name="aims" id="aims" placeholder="Masukkan No. AIMS" class="form-control flex-grow-1" required>
            <span class="d-flex flex-row form-label">Badan<span class="text-danger">*</span></span>
            <select name="badan" id="badan" class="form-select" required>
                <option disabled selected>Pilih Badan </option>
                <option value="Khuddam">Khuddam</option>
                <option value="Ansharullah">Ansharullah</option>
                <option value="Lajnah">Lajnah Imailah</option>
            </select>
            <span class="d-flex flex-row form-label">Cabang<span class="text-danger">*</span></span>
            <select name="cabang" id="cabang" class="form-select" required>
                <option disabled selected>Pilih Cabang</option>
                <option value="Kawalu">Kawalu</option>
                <option value="Tangerang">Tangerang</option>
            </select>
            @session('message')
                <div class="alert alert-primary mt-2 mb-0">
                    {{ $value }}
                </div>
            @endsession
            <button type="submit" class="btn btn-primary my-2">Masuk</button>
        </form>
    </div>
</body>

</html>