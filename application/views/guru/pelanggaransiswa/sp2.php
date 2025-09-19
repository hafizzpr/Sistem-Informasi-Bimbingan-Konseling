<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 10px;
            border-bottom: 2px solid black;
        }

        .header-container img {
            width: 80px; /* Sesuaikan ukuran logo */
            margin-right: 15px;
        }

        .header-container .header-text {
            text-align: center;
        }

        .header-container .header-text h4 {
            margin: 0;
            font-size: 14pt;
            font-weight: bold;
        }

        .header-container .header-text h6 {
            margin: 0;
            font-size: 10pt;
        }

        .table-container {
            width: 100%;
            margin-top: 20px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th, .table-container td {
            border: 1px solid;
            font-size: 10pt;
            padding: 5px;
            text-align: left;
        }

        .table-container th {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .mt-2 {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <div class="header-container">
        <div class="header-text">
            <img src="<?= base_url() ?>assets/image/kop_1.png" width="100%" alt="Logo">
        </div>
    </div>

    <div class="table-container">
        <p>Kepada Yth <br>
            <b><?= $detailSiswa->nama_lengkap ?></b> <br>
            Kelas <?= $detailSiswa->kelas ?></p>
        
        <p>Perihal: Surat Peringatan 1 (SP1)</p>

        <p align="justify">Sehubungan dengan pelanggaran tata tertib yang dilakukan oleh saudara/i <?= $detailSiswa->nama_lengkap ?>, yaitu pelanggaran : <b>
          <?php foreach ($pelanggaran as $key => $value) { ?> 
            <?= $value->nama_pelanggaran ?> dengan Poin (<?= $value->poin_pengurang?>),
          <?php } ?> </b> sehingga total poin pelanggaran <b><?= $totalPoin ?></b> poin, Dengan ini kami memberikan Surat Peringatan 1 (SP1)</p>

        <p align="justify">Pelanggaran ini merupakan pelanggaran pertama yang kami catat, dan kami berharap saudara/i dapat segera memperbaiki diri dan mengulangi pelanggaran yang sama.</p>
        
        <p align="justify">Demikian surat peringatan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih</p><br><br>
        <p>&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
           &emsp; &emsp; &emsp; Mengetahui, <br> 
           &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
           &emsp; &emsp; &emsp; Guru Bimbingan Konseling</p>
        <p> <br> <br> <br> &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
           &emsp; &emsp; &emsp; Ririn Indriani S.Pd</p><br><br>

        <p align="justify" style="font-size: 8pt;">
            <b>Catatan :</b> <br>
            1. Surat Peringatan 1 (SP1) biasanya diberikan sebagai peringatan awal untuk kesalahan atau pelanggaran yang relatif ringan. <br>
            2. Pelanggaran yang lebih berat bisa langsung mendapatkan SP2 atau bahkan SP3 tanpa melalui SP1. <br>
            3. Surat Peringatan 1 (SP1) juga bisa diberikan jika pelanggaran berulang dan tidak ada perbaikan dari siswa yang bersangkutan. <br>
        </p>
    </div>

</body>
</html>
