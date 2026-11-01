
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Individu</title>
</head>
<body>

    <h1>Perhitungan Nilai dan IPS Mahasiswa</h1>

    <?php
    $matkul = [
        ["nama" => "Matematika Diskrit", "sks" => 3, "nilai" => 66.9],
        ["nama" => "Teknologi dan Transformasi Digital", "sks" => 2, "nilai" => 89.85],
        ["nama" => "Kalkulus", "sks" => 3, "nilai" => 92],
        ["nama" => "Dasar Dasar Pemrograman", "sks" => 2, "nilai" => 87],
        ["nama" => "Algoritma dan Pemrograman", "sks" => 4, "nilai" => 87.5],
        ["nama" => "Pendidikan Agama", "sks" => 2, "nilai" => 88.45],
        ["nama" => "Bahasa Pemrograman I", "sks" => 2, "nilai" => 88],
        ["nama" => "Sistem Digital", "sks" => 2, "nilai" => 96.25]
    ];

    function hitungBobot($nilai) {
        if ($nilai >= 80) {
            return ["huruf" => "A", "bobot" => 4];
        } elseif ($nilai >= 70) {
            return ["huruf" => "B", "bobot" => 3];
        } elseif ($nilai >= 60) {
            return ["huruf" => "C", "bobot" => 2];
        } elseif ($nilai >= 50) {
            return ["huruf" => "D", "bobot" => 1];
        } else {
            return ["huruf" => "E", "bobot" => 0];
        }
    }

    $totalSKS = 0;
    $totalBobot = 0;
    $jumlahLulus = 0;
    $jumlahMengulang = 0;
    ?>

    <h2>Data Nilai Mata Kuliah</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>No</th>
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

            $status = $hasil["bobot"] >= 2 ? "LULUS" : "MENGULANG";

            $totalSKS += $data["sks"];
            $totalBobot += $data["sks"] * $hasil["bobot"];

            if ($status == "LULUS") {
                $jumlahLulus++;
            } else {
                $jumlahMengulang++;
            }

            echo "<tr>";
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
        $maksimalSKS = $ips >= 3.00 ? 24 : 20;
        ?>
    </table>

    <h2>Ringkasan Hasil Perhitungan</h2>

    <?php
    echo "Total Mata Kuliah: " . count($matkul) . "<br>";
    echo "Total SKS: " . $totalSKS . "<br>";
    echo "Jumlah Mata Kuliah Lulus: " . $jumlahLulus . "<br>";
    echo "Jumlah Mata Kuliah Mengulang: " . $jumlahMengulang . "<br>";
    echo "Total Bobot Nilai: " . number_format($totalBobot, 2) . "<br>";
    echo "Indeks Prestasi Semester (IPS): " . number_format($ips, 2) . "<br>";
    echo "Batas Maksimal SKS Semester Depan: " . $maksimalSKS . " SKS";
    ?>

<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>
