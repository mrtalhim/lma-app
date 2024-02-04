    @php
        $badanValues = [
            'Khuddam',
            'Lajnah',
            'Ansharullah',
            'Abna',
            'Banath',
            'Athfal',
            'Nasirat'
        ];
        $wasiyat_list = [
            "Wasiyat 1/10" => 1,
            "Wasiyat 1/5" => 2,
            "Wasiyat 1/3" => 3,
        ]
    @endphp

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
        <title>Anggaran Penerimaan Perorangan</title>
    </head>
    <body>
        <div class="container d-flex align-items-center justify-content-center">
            <form method="POST" action="{{ route('save-app', ['id'=>$data->id]) }}" class="d-flex flex-column mb-4">
                @csrf
                <h1>Anggaran Penerimaan Perorangan</h1>
                <h2>{{ $message ?? '' }}</h2>
                <span class="d-flex flex-row form-label">Nama</span>
                <input name="name" id="name" disabled value="{{ $data->name }}" class="form-control">
                <span class="d-flex flex-row form-label">Cabang</span>
                <input name="cabang" id="cabang" disabled value="{{ $data->cabang }}" class="form-control">
                <span class="d-flex flex-row form-label">Badan<span class="text-danger">*</span></span>
                <select name="badan" id="badan" class="form-select" disabled>
                    <option disabled selected>Pilih Badan </option>
                    @foreach ($badanValues as $value)
                        <option value="{{ $value }}" {{ $data->badan == $value ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
                <span class="d-flex flex-row form-label">Status Wasiyat<span class="text-danger">*</span></span>
                <ul class="d-flex flex-wrap list-unstyled gap-4">
                    <li>
                        <input type="radio" name="isWasiyat" id="musiType1" value="0" {{ $data->is_musi == 0 ? 'checked' : '' }}>
                        <label for="musiType1">Non-Musi</label>
                    </li>
                    <li>
                        <input type="radio" name="isWasiyat" id="musiType2" value="1" {{ $data->is_musi == 1 ? 'checked' : '' }}>
                        <label for="musiType2">Musi-Musiah</label>
                    </li>
                    <li>
                        
                        <select name="wasiyatType" id="wasiyatType" class="form-select">
                            @foreach ($wasiyat_list as $k=>$v)
                                <option value="{{ $v }}" {{ $data->wasiyat_type == $v ? "selected" : "" }}>{{ $k }}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>
                <div class="d-flex flex-column">
                    <span class="d-flex flex-row form-label">Jumlah Penghasilan Satu Tahun<span class="text-danger">*</span></span>
                    <div class="d-flex flex-row input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" name="penghasilan" id="penghasilan" placeholder="Masukkan Jumlah Penghasilan" class="form-control" value="{{ $data->pendapatan_value }}">
                    </div>
                </div>
                <div class="d-flex flex-column" id="div-aam">
                    <span class="form-label ">Candah Aam</span>
                    <div class="d-flex flex-row input-group">
                        <span class="input-group-text">Rp.</span>
                        <span id="aam" class="form-control">{{ $data->candah_value }}</span>
                    </div>
                </div>
                <div class="d-flex flex-column" id="div-jalsah">
                    <span class="font-bold">Jalsah</span>
                    <div class="flex flex-row input-group">
                        <span class="input-group-text">Rp.</span>
                        <span id="jalsah" class="form-control">{{ $data->jalsah_value }}</span>
                    </div>
                </div>
                <div class="d-flex flex-column" id="div-iuran">
                    <span id="iuranTitle" class="font-bold">Iuran Badan</span>
                    <div class="flex flex-row input-group">
                        <span class="input-group-text">Rp.</span>
                        <span id="iuran" class="form-control">{{ $data->iuran_badan_value }}</span>
                    </div>
                </div>
                <div class="d-flex flex-column" id="div-ijtima">
                    <span id="ijtimaTitle" class="font-bold">Ijtima Badan</span>
                    <div class="flex flex-row input-group">
                        <span class="input-group-text">Rp.</span>
                        <span id="ijtima" class="form-control" >{{ $data->ijtima_badan_value }}</span>
                    </div>
                </div>
                <div class="d-flex flex-row gap-4 justify-content-center p-8">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    @if (session('user_type') == 'admin')
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
                    @endif
                    <a href="{{ route('logout') }}" class="btn btn-secondary">Keluar</a>
                </div>
                </div>
            </form>
        </div>
    </body>

    <script>
        function isWasiyat() {
            isMusi = $("input[name='isWasiyat']:checked").val();
            if (isMusi == 0)
                return false;
            else if (isMusi == 1)
                return true;
        }

        const wasiyatType = {
            '1': 1/10,
            '2': 1/5,
            '3': 1/3,
        }

        const badanType = {
            'Khuddam': 0.025,
            'Ansharullah': 0.015,
            'Lajnah': 0.01,
            'Abna': 0.0,
            'Banath': 0.0,
            'Athfal': 0.0,
            'Nasirat': 0.0,
        }

        function calculate(number, wasiyatMult = 1/16, ijtimaMult = 0.025) {
            number = parseFloat($('#penghasilan').val()) || 0;
            wasiyatMult = wasiyatType[$('#wasiyatType').val()];
            isMusi = isWasiyat();
            if (!isMusi) {
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
        }
        
        $("input[name='isWasiyat']").on("change", function () {
            if (isWasiyat()) {
                $("#wasiyatType").show();
            } else {
                $("#wasiyatType").hide();
            }
            calculate();
        });
        $("#penghasilan").on("input", calculate);
        $("#wasiyatType, #badan").on("change", calculate);

        $(document).ready(function () {
            if (isWasiyat()) {
                $("#wasiyatType").show();
            } else {
                $("#wasiyatType").hide();
            }
        });
    </script>

    </html>