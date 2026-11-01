
<?php

// 1. Array mata kuliah
$matkul = [
    ["nama" => "Basis Data", "sks" => 3, "nilai" => 90],
    ["nama" => "Pemrograman Web", "sks" => 3, "nilai" => 80],
    ["nama" => "Algoritma", "sks" => 3, "nilai" => 75],
    ["nama" => "Matematika Diskrit", "sks" => 2, "nilai" => 55],
    ["nama" => "Sistem Operasi", "sks" => 3, "nilai" => 40]
];

// 2. Fungsi menghitung nilai huruf dan bobot
function hitungBobot($nilai) {
    if ($nilai >= 85) {
        return ["A", 4.0];
    } elseif ($nilai >= 75) {
        return ["B", 3.0];
    } elseif ($nilai >= 65) {
        return ["C", 2.0];
    } elseif ($nilai >= 50) {
        return ["D", 1.0];
    } else {
        return ["E", 0.0];
    }
}

$totalSKS = 0;
$totalBobot = 0;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Perhitungan IPS</title>

    <style>
        body {
            font-family: Arial;
            margin: 30px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: lightblue;
        }

        .mengulang {
            background-color: #ffcccc;
        }
    </style>
</head>

<body>

<h2>Daftar Nilai Mata Kuliah</h2>

<table>
    <tr>
        <th>No</th>
        <th>Nama Mata Kuliah</th>
        <th>SKS</th>
        <th>Nilai</th>
        <th>Huruf</th>
        <th>Bobot</th>
        <th>Status</th>
    </tr>

    <?php foreach ($matkul as $i => $mk) {

        // Menghitung nilai huruf dan bobot
        $hasil = hitungBobot($mk["nilai"]);

        $huruf = $hasil[0];
        $bobot = $hasil[1];

        // Menentukan status
        $status = ($bobot >= 2) ? "LULUS" : "MENGULANG";

        // Menghitung total SKS dan bobot
        $totalSKS += $mk["sks"];
        $totalBobot += $mk["sks"] * $bobot;

    ?>

    <tr class="<?= $status == 'MENGULANG' ? 'mengulang' : '' ?>">
        <td><?= $i + 1 ?></td>
        <td><?= $mk["nama"] ?></td>
        <td><?= $mk["sks"] ?></td>
        <td><?= $mk["nilai"] ?></td>
        <td><?= $huruf ?></td>
        <td><?= $bobot ?></td>
        <td><?= $status ?></td>
    </tr>

    <?php } ?>

</table>

<?php

// 3. Menghitung IPS
$ips = $totalBobot / $totalSKS;

// 4. Menentukan maksimal SKS semester depan
if ($ips >= 3.00) {
    $maksSKS = 24;
} else {
    $maksSKS = 20;
}

?>

<h3>Ringkasan IPS</h3>

<p>Total SKS: <?= $totalSKS ?></p>

<p>Total Bobot: <?= $totalBobot ?></p>

<p>IPS: <?= number_format($ips, 2) ?></p>

<h3>Maksimal SKS Semester Depan: <?= $maksSKS ?> SKS</h3>

</body>
</html>
