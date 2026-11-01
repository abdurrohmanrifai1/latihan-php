
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Individu</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f8fa;
            margin: 30px;
            color: #333;
        }

        h1, h2 {
            color: #263849;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #258fbd;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f0f4f6;
        }

        .mengulang {
            background-color: #ffcccc !important;
            color: #b30000;
        }

        .ringkasan {
            background-color: white;
            padding: 20px;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .ringkasan p {
            margin: 10px 0;
        }

        .hasil {
            font-weight: bold;
            color: #258fbd;
        }
    </style>
</head>

<body>

    <h1>Perhitungan Nilai dan IPS Mahasiswa</h1>
    <h2>Daftar Hasil Studi Semester 2025/2026 Genap</h2>

    <?php
    $matkul = [
        ["nama" => "Aljabar Linier", "sks" => 2, "nilai" => 81.4],
        ["nama" => "Probabilitas dan Statistika", "sks" => 3, "nilai" => 44.05],
        ["nama" => "Struktur Data", "sks" => 3, "nilai" => 85],
        ["nama" => "Arsitektur dan Organisasi Komputer", "sks" => 3, "nilai" => 94.2],
        ["nama" => "Komunikasi Data", "sks" => 2, "nilai" => 45.75],
        ["nama" => "Moderasi Beragama", "sks" => 2, "nilai" => 90.9],
        ["nama" => "Pengantar Teknologi Internet", "sks" => 3, "nilai" => 85.25],
        ["nama" => "Bahasa Pemrograman II", "sks" => 2, "nilai" => 90]
    ];

    function hitungBobot($nilai) {
        if ($nilai >= 80) {
            return ["huruf" => "A", "bobot" => 4.0];
        } elseif ($nilai >= 70) {
            return ["huruf" => "B", "bobot" => 3.0];
        } elseif ($nilai >= 60) {
            return ["huruf" => "C", "bobot" => 2.0];
        } elseif ($nilai >= 50) {
            return ["huruf" => "D", "bobot" => 1.0];
        } else {
            return ["huruf" => "E", "bobot" => 0.0];
        }
    }

    $totalSKS = 0;
    $totalBobot = 0;
    $jumlahLulus = 0;
    $jumlahMengulang = 0;
    ?>

    <h2>Daftar Nilai Mata Kuliah</h2>

    <table>
        <tr>
            <th>No.</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Angka</th>
            <th>Nilai Huruf</th>
            <th>Bobot</th>
            <th>Status</th>
        </tr>

        <?php
        foreach ($matkul as $index => $data) {
            $hasil = hitungBobot($data["nilai"]);

            $status = $hasil["bobot"] >= 2.0 ? "LULUS" : "MENGULANG";

            $totalSKS += $data["sks"];
            $totalBobot += $data["sks"] * $hasil["bobot"];

            if ($status == "LULUS") {
                $jumlahLulus++;
            } else {
                $jumlahMengulang++;
            }

            $class = $status == "MENGULANG" ? "mengulang" : "";

            echo "<tr class='$class'>";
            echo "<td>" . ($index + 1) . "</td>";
            echo "<td>" . htmlspecialchars($data["nama"]) . "</td>";
            echo "<td>" . $data["sks"] . "</td>";
            echo "<td>" . $data["nilai"] . "</td>";
            echo "<td>" . $hasil["huruf"] . "</td>";
            echo "<td>" . number_format($hasil["bobot"], 1) . "</td>";
            echo "<td>" . $status . "</td>";
            echo "</tr>";
        }

        $ips = $totalSKS > 0 ? $totalBobot / $totalSKS : 0;

        if ($ips >= 3.00) {
            $maksimalSKS = 24;
        } else {
            $maksimalSKS = 20;
        }
        ?>

    </table>

    <div class="ringkasan">
        <h2>Ringkasan Hasil Perhitungan</h2>

        <p>Total Mata Kuliah: <strong><?php echo count($matkul); ?></strong></p>

        <p>Total SKS: <strong><?php echo $totalSKS; ?> SKS</strong></p>

        <p>Jumlah Mata Kuliah Lulus: <strong><?php echo $jumlahLulus; ?></strong></p>

        <p>Jumlah Mata Kuliah Mengulang: <strong><?php echo $jumlahMengulang; ?></strong></p>

        <p>Total Bobot Nilai: <strong><?php echo number_format($totalBobot, 2); ?></strong></p>

        <p>Indeks Prestasi Semester (IPS):
            <strong class="hasil"><?php echo number_format($ips, 2); ?></strong>
        </p>

        <p>Batas Maksimal SKS Semester Depan:
            <strong class="hasil"><?php echo $maksimalSKS; ?> SKS</strong>
        </p>
    </div>

</body>
</html>
