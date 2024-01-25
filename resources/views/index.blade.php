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
<body>
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <form method="POST" class="d-flex flex-column mb-4">
            @csrf
            <h1>Login Anggota</h1>
            <div class="d-flex flex-column">
                <span class="d-flex flex-row form-label">No. AIMS<span class="text-danger">*</span></span>
                <input type="number" id="aims" placeholder="Masukkan No. AIMS" class="form-control flex-grow-1" required>
                <span class="flex flex-row form-label">Badan<span class="text-danger">*</span></span>
                <select id="badan" class="form-select" required>
                    <option disabled selected>Pilih Badan </option>
                    <option value="Khuddam">Khuddam</option>
                    <option value="Ansharullah">Ansharullah</option>
                    <option value="Lajnah">Lajnah Imailah</option>
                </select>
                <span class="d-flex flex-row form-label">Cabang<span class="text-danger">*</span></span>
                <select id="cabang" class="form-select" required>
                    <option disabled selected>Pilih Cabang</option>
                    <option value="KWU">Kawalu</option>
                    <option value="TGR">Tangerang</option>
                </select>
                <button type="submit" class="btn btn-primary mt-4">Masuk</button>
            </div>
        </form>
    </div>
</body>

</html>