<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css'])
    <title>Anggaran Penerimaan Perorangan</title>
</head>
<body>
    <div class="h-screen flex items-center justify-center m-16 rounded-2xl">
        <form method="POST" action={{ url('/') }} x-data="{ isWasiyat: 0, wasiyatType: 1/16, anggaran: 0}" class="flex flex-col gap-4 place-content-center">
            @csrf
            <h1 class="font-bold text-3xl basis-full">Anggaran Penerimaan Perorangan</h1>
            <ul x-model="isWasiyat" x-init=$watch class="flex flex-row flex-wrap">
                <li class="basis-1/3">
                    <input type="radio" name="isWasiyat" id="musiType1" value="0" x-model="isWasiyat" @click="wasiyatType = 1/16" class="peer">
                    <label for="musiType1">Non-Musi</label>
                </li>
                <li class="basis-1/3">
                    <input type="radio" name="isWasiyat" id="musiType2" value="1" x-model="isWasiyat" @click="wasiyatType = 1/3" class="peer">
                    <label for="musiType2">Musi-Musiah</label>
                </li>
            </ul>
            <select id="wasiyatType" :disabled="isWasiyat == 0" x-model.number="wasiyatType">
                <option :value="1/16" :selected="isWasiyat == 0" disabled>Non-Musi</option>
                <option :value="1/3">Wasiyyat 1/3</option>
                <option :value="1/5">Wasiyyat 1/5</option>
                <option :value="1/10">Wasiyyat 1/10</option>
            </select>
            <div class="flex flex-col">
                {{-- <span x-text="isWasiyat"></span>
                <span x-text="wasiyatType"></span> --}}
                <span class="font-bold">Jumlah Penghasilan Satu Tahun</span>
                <div class="flex flex-row">
                    <input id="penghasilan" placeholder="Masukkan Jumlah Penghasilan"  x-mask:dynamic="$money($input, ',', '.')" class="basis-11/12">
                    <button class="basis-1/12">Hitung</button>
                </div>
                {{-- <span class="font-bold">Candah Aam</span>
                <span x-text="anggaran * wasiyatType"></span>
                <span class="font-bold">Jalsah</span>
                <span x-text="anggaran / 120"></span>
                <span class="font-bold">Iuran Badan</span>
                <span x-text="Math.max(anggaran / 100, 7500)"></span>
                <span class="font-bold">Ijtima Badan</span>
                <span x-text="anggaran / 480"></span> --}}
                {{-- <h1>{{ $penghasilan }}</h1> --}}
                @if (!empty($penghasilan) && !empty($wasiyatType))
                    <span class="font-bold">Candah Aam</span>
                    <span x-mask:dynamic="$money($input, ',', '.')">{{ $penghasilan * $wasiyatType }}</span>
                    <span class="font-bold">Jalsah</span>
                    <span x-mask:dynamic="$money($input, ',', '.')">{{ $penghasilan * $wasiyatType }}</span>
                    <span class="font-bold">Iuran Badan</span>
                    <span x-mask:dynamic="$money($input, ',', '.')">{{ $penghasilan * $wasiyatType }}</span>
                    <span class="font-bold">Ijtima Badan</span>
                    <span x-mask:dynamic="$money($input, ',', '.')">{{ $penghasilan * $wasiyatType }}</span>
                @endif
            </div>
        </form>
    </div>
</body>
</html>