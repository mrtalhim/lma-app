<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LMA APP</title>
</head>
<body>
    <h1>Hello</h1>
    <form action="submit" style="display: flex; flex-direction: column">
        <ul>
            <li>Non-Musi</li>
            <li>Musi-Musiah</li>
        </ul>
        <select>
            <option>Wasiyyat 1/3</option>
            <option>Wasiyyat 1/5</option>
            <option>Wasiyyat 1/10</option>
        </select>
        <label for="penghasilan">Jumlah Penghasilan Satu Tahun</label>
        <input id="penghasilan" type="number" placeholder="Masukkan Jumlah Penghasilan">
        <label for="aam">Candah Aam</label>
        <input id="aam" type="number" disabled>
        <label for="jalsah">Jalsah</label>
        <input id="jalsah" type="number" disabled>
        <label for="badan">Dana Badan</label>
        <input id="badan" type="number" disabled>
        <label for="ijtima">Ijtima Badan</label>
        <input id="ijtima" type="number" disabled>
    </form>
</body>
</html>