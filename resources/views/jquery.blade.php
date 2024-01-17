<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @vite(['resources/css/app.css'])
    <title>Anggaran Penerimaan Perorangan</title>
</head>
<body>
    <div class="h-screen flex items-center justify-center">
        <form class="flex flex-col place-content-center gap-4">
            <h1 class="font-bold text-3xl basis-full">Anggaran Penerimaan Perorangan</h1>
            <div class="flex flex-col">
                <span class="font-bold">Badan</span>
                <select id="badan">
                    <option disabled selected>Pilih Badan</option>
                    <option value="Khuddam">Khuddam</option>
                    <option value="Ansharullah">Ansharullah</option>
                    <option value="Lajnah">Lajnah Imailah</option>
                </select>
            </div>
            <div class="flex flex-col">
                <span class="font-bold">Status Wasiyat</span>
                <ul class="flex flex-row flex-wrap">
                    <li class="basis-1/3">
                        <input type="radio" name="isWasiyat" id="musiType1" value="0" class="peer" checked>
                        <label for="musiType1">Non-Musi</label>
                    </li>
                    <li class="basis-1/3">
                        <input type="radio" name="isWasiyat" id="musiType2" value="1" class="peer">
                        <label for="musiType2">Musi-Musiah</label>
                    </li>
                    <select id="wasiyatType" hidden>
                        <option value="1/10">Wasiyyat 1/10</option>
                        <option value="1/5">Wasiyyat 1/5</option>
                        <option value="1/3">Wasiyyat 1/3</option>
                    </select>
                </ul>
            </div>
            <div class="flex flex-col">
                <span class="font-bold m-4">Jumlah Penghasilan Satu Tahun</span>
                <div class="flex flex-row gap-4">
                    <h1 class="m-2 p-2">Rp.</h1>
                    <input id="penghasilan" placeholder="Masukkan Jumlah Penghasilan" class="basis-full">
                </div>
            </div>
            <div class="flex flex-col">
                <span class="font-bold">Candah Aam</span>
                <div class="flex flex-row gap-4">
                    <h1 class="m-2 p-2">Rp.</h1>
                    <span id="aam"></span>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="font-bold">Jalsah</span>
                <div class="flex flex-row gap-4">
                    <h1 class="m-2 p-2">Rp.</h1>
                    <span id="jalsah"></span>
                </div>
            </div>
            <div class="flex flex-col">
                <span id="iuranTitle" class="font-bold">Iuran Badan</span>
                <div class="flex flex-row gap-4">
                    <h1 class="m-2 p-2">Rp.</h1>
                    <span id="iuran"></span>
                </div>
            </div>
            <div class="flex flex-col">

                <span id="ijtimaTitle" class="font-bold">Ijtima Badan</span>
                <div class="flex flex-row gap-4">
                    <h1 class="m-2 p-2">Rp.</h1>
                    <span id="ijtima"></span>
                </div>
            </div>
            <div class="flex flex-col">
                {{-- <span id="penghasilanOutput"></span>
                <span id="wasiyatTypeOutput"></span>
                <span id="ijtimaOutput"></span>
                <span id="isWasiyatOutput"></span> --}}
            </div>
        </form>
    </div>
</body>

<script>
    function isWasiyat() {
        isMusi = $("input[name='isWasiyat']:checked").val();
        return isMusi;
    }

    const wasiyatType = {
        '1/3': 1/3,
        '1/5': 1/5,
        '1/10': 1/10,
    }

    const badanType = {
        'Khuddam': 0.025,
        'Ansharullah': 0.015,
        'Lajnah': 0.01
    }

    function calculate(number, wasiyatMult = 1/16, ijtimaMult = 0.025) {
        number = parseFloat($('#penghasilan').val()) || 0;
        wasiyatMult = wasiyatType[$('#wasiyatType').val()];
        isMusi = isWasiyat();
        if (isMusi == 0) {
            wasiyatMult = 1/16;
        }

        ijtimaMult = badanType[$('#badan').val()];

        // set number output
        $("#aam").text(number * wasiyatMult);
        $("#jalsah").text(Math.round(number / 120));
        $("#iuran").text(Math.max(number / 100, 7500));
        $("#ijtima").text(number * ijtimaMult);
        $("#iuranTitle").text('Iuran ' + $('#badan').val());
        $("#ijtimaTitle").text('Ijtima ' + $('#badan').val());
        // $("#penghasilanOutput").text(number);
        // $("#wasiyatTypeOutput").text(wasiyatMult);
        // $("#ijtimaOutput").text(ijtimaMult);
        // $("#isWasiyatOutput").text(isMusi);
    }
    
    $("input[name='isWasiyat']").on("change", function () {
        $("#wasiyatType").toggle();
        calculate();
    });
    $("#penghasilan").on("input", calculate);
    $("#wasiyatType").on("change", calculate);
    $("#badan").on("change", calculate);

    $(document).ready(function () {
        $("#aam").text(0);
        $("#jalsah").text(0);
        $("#iuran").text(0);
        $("#ijtima").text(0);
    });
</script>

</html>