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
                <span class="font-bold flex flex-row">Badan<h1 class="text-red-700">*</h1></span>
                <select id="badan">
                    <option disabled selected>Pilih Badan </option>
                    <option value="Khuddam">Khuddam</option>
                    <option value="Ansharullah">Ansharullah</option>
                    <option value="Lajnah">Lajnah Imailah</option>
                </select>
            </div>
            <div class="flex flex-wrap">
                <span class="font-bold basis-full flex flex-row">Status Wasiyat<h1 class="text-red-700">*</h1></span>
                <ul class="flex flex-wrap basis-full *:basis-1/3">
                    <li>
                        <input type="radio" name="isWasiyat" id="musiType1" value="0" class="peer" checked>
                        <label for="musiType1">Non-Musi</label>
                    </li>
                    <li>
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
                <span class="font-bold flex flex-row">Jumlah Penghasilan Satu Tahun<h1 class="text-red-700">*</h1></span>
                <div class="flex flex-row gap-4 mt-2 rounded-xl ring-2 ring-gray-400 has-[:focus]:ring-blue-400">
                    <h1 class="p-2">Rp.</h1>
                    <input type="number" id="penghasilan" placeholder="Masukkan Jumlah Penghasilan" class="basis-full mr-2 focus:outline-0">
                </div>
            </div>
            <div class="flex flex-col" id="div-aam">
                <span class="font-bold">Candah Aam</span>
                <div class="flex flex-row gap-4">
                        <h1>Rp.</h1>
                        <span id="aam"></span>
                    </div>
                </div>
                <div class="flex flex-col" id="div-jalsah">
                    <span class="font-bold">Jalsah</span>
                    <div class="flex flex-row gap-4">
                        <h1>Rp.</h1>
                        <span id="jalsah"></span>
                    </div>
                </div>
                <div class="flex flex-col" id="div-iuran">
                    <span id="iuranTitle" class="font-bold">Iuran Badan</span>
                    <div class="flex flex-row gap-4">
                        <h1>Rp.</h1>
                        <span id="iuran"></span>
                    </div>
                </div>
                <div class="flex flex-col" id="div-ijtima">
                    <span id="ijtimaTitle" class="font-bold">Ijtima Badan</span>
                    <div class="flex flex-row gap-4">
                        <h1>Rp.</h1>
                        <span id="ijtima"></span>
                    </div>
                </div>
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

        badanTitle = $('#badan').val() || "Badan";
        ijtimaMult = badanType[badanTitle] || 0;

        // check if all is filled
        if ((ijtimaMult != 0) && (number != 0)) {
            $("#div-aam, #div-jalsah, #div-iuran, #div-ijtima").show();
        }

        // set number output
        $("#aam").text(number * wasiyatMult);
        $("#jalsah").text(Math.round(number / 120));
        $("#iuran").text(Math.max(number / 100, 7500));
        $("#ijtima").text(number * ijtimaMult);
        $("#iuranTitle").text('Iuran ' + badanTitle);
        $("#ijtimaTitle").text('Ijtima ' + badanTitle);
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
    $("#wasiyatType, #badan").on("change", calculate);

    $(document).ready(function () {
        // $("#div-aam, #div-jalsah, #div-iuran, #div-ijtima").hide();
        $("#aam, #jalsah, #iuran, #ijtima").text(0);
    });
</script>

</html>