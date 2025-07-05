<style>
.indicator-box {
    display: inline-block;
    width: 20px;
    height: 20px;
    margin-left: 10px;
}

.legend {
    display: flex;
    align-items: center;
    margin-top: 10px;
}

.legend div {
    display: flex;
    align-items: center;
    margin-right: 20px;
}

.legend .box {
    width: 20px;
    height: 20px;
    margin-right: 5px;
}

.legend .green {
    background-color: green;
}

.legend .yellow {
    background-color: yellow;
}

.legend .red {
    background-color: red;
}

.table-bordered {
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 10px;

}

.thead-light {
    border-radius: 10px;
}

.weather-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

#weather-info div {
    border: 1px solid white;
    padding: 10px;
    border-radius: 10px;
}
</style>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"><?= $judul; ?></h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="member">
                            <i class="fas fa-solid fa-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Pages</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Starter Page</a>
                    </li>
                </ul>
            </div>
            <div class="page-category">
                <h3 style="font-weight: bold; margin-top: 30px;">Beranda</h3>
                <div id="weather-info">
                    <div>
                        Loading weather...
                    </div>
                </div>
                <table class="table table-bordered border-dark weather-card" style="background-color: #fff;">
                    <h3 style="font-weight: bold;">Pengumuman terbaru!</h3>
                    <thead class="card-header thead" style="border-radius: 10px;">
                        <tr>
                            <th scope="col" style="border-top-left-radius: 10px;">No</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col" style="border-top-right-radius: 10px;">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($menu)) : ?>
                        <tr>
                            <td colspan="4">Tidak ada pengumuman hari ini</td>
                        </tr>
                        <?php else : ?>
                        <?php $i = 1; ?>
                        <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['judul']; ?></td>
                            <td><?= $m['tanggal']; ?></td>
                            <td><?= $m['deskripsi']; ?></td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <h3 style="font-weight: bold;">Statistik Keanggotaan</h3>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card border border-dark" style="height: 250px; margin-bottom: 20px; color: aquamarine;">
                        <div class="card-header"
                            style="background-color: #fff; color: black; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                            Jumlah Member
                        </div>
                        <i class="fas fa-solid fa-users"
                            style="margin-top: 50px; text-align: center; font-size: 2.5em;"></i>
                        <h4 style="margin-top: 20px; text-align: center; font-size: 1.5em;">
                            <?= $jumlah_partisipan ?> Partisipan
                        </h4>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class=" card border border-dark" style=" height: 250px; margin-bottom: 20px; color: springgreen">
                        <div class="card-header"
                            style="background-color: #fff; color: black; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                            Jumlah Staff
                        </div>
                        <i class="fas fa-solid fa-users"
                            style="margin-top: 50px; text-align: center; font-size: 2.5em;"></i>
                        <h4 style="margin-top: 20px; text-align: center; font-size: 1.5em;">
                            <?= $jumlah_pegawai ?> Sukarelawan
                        </h4>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class=" card border border-dark" style=" height: 250px; margin-bottom: 20px; color: springgreen;">
                        <div class="card-header"
                            style="background-color: #fff; color: black; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                            Jumlah Admin
                        </div>
                        <i class="fas fa-solid fa-users"
                            style="margin-top: 50px; text-align: center; font-size: 2.5em;"></i>
                        <h4 style="margin-top: 20px; text-align: center; font-size: 1.5em;">
                            <?= $jumlah_admin ?> Administrator
                        </h4>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class=" card border border-dark" style="height: 250px; margin-bottom: 20px; color: crimson; ">
                        <div class="card-header"
                            style="background-color: #fff; color: black; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                            Jumlah Akun terblokir
                        </div>
                        <i class="fas fa-solid fa-users"
                            style="margin-top: 50px; text-align: center; font-size: 2.5em;"></i>
                        <h4 style="margin-top: 20px; text-align: center; font-size: 1.5em;">
                            <?= $jumlah_terblokir ?> Akun
                        </h4>
                    </div>
                </div>
            </div>
            <h3 style="font-weight: bold;">Statistik Keuangan</h3>
            <div class="row">
                <div class="col-lg-6">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="col-lg-6">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th style="border-top-left-radius: 10px;">ID</th>
                                <th style="border-top-right-radius: 10px;">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($finance as $row) : ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td>
                                    <?= "Rp " . number_format($row['saldo'], 0, ',', '.') ?>
                                    <?php
                                        if ($row['saldo'] > 100000) {
                                            $color = "green";
                                        } elseif ($row['saldo'] > 0) {
                                            $color = "yellow";
                                        } else {
                                            $color = "red";
                                        }
                                        ?>
                                    <div class="indicator-box" style="background-color: <?= $color ?>;"></div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="legend">
                        <div>
                            <div class="box green"></div>
                            <span>Saldo > 100,000</span>
                        </div>
                        <div>
                            <div class="box yellow"></div>
                            <span>0 < Saldo <=100,000</span>
                        </div>
                        <div>
                            <div class="box red"></div>
                            <span>Saldo <= 0</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr stle="border-color: white;">
            <h3 style="font-weight: bold; margin-top: 30px;">Statistik Limbah</h3>
            <div class="row">
                <div class="col-lg-12">
                    <canvas id="myBarChart"></canvas>
                    <p>Total Sampah di Gudang: <?= array_sum(json_decode($total_sampah)); ?></p>
                </div>
            </div>
            <h3 style="font-weight: bold; margin-top: 30px;">Penarikan tunai terakir</h3>
            <div class="col-lg-12">
                <table class="table table-borderless">
                    <thead class="thead-light">
                        <tr>
                            <th>Username</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Metode</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (array_slice($withdraw, -3) as $w) : ?>
                        <tr>
                            <td><?= $w['username']; ?></td>
                            <td><?= $w['tanggal']; ?></td>
                            <td><?= "Rp " . number_format($w['nominal'], 0, ',', '.'); ?></td>
                            <td><?= $w['metode']; ?></td>
                            <td><?= $w['lokasi']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <h3 style="font-weight: bold; margin-top: 30px;">Proses bisnis</h3>
            <div class="col-lg-12" style="text-align: center;">
                <div style="border: 1px solid white;">
                    <img src="assets/images/png/ProsesBisnis.png" alt="img" class="desktop-logo logo-dark"
                        style="width: 850px;">
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="card" style="width: 18rem;">
        <img src="<?= base_url('assets/images/user/profile/') .  $user['photo']; ?>" class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
        </div>
      </div> -->

</div>
</div>
<script>
const data = {
    labels: [
        'Akun Modal',
        'Akun Arus Kas'
    ],
    datasets: [{
        data: [
            <?= $finance[0]['saldo'] ?>,
            <?= $finance[1]['saldo'] ?>
        ],
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)'
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)'
        ],
        borderWidth: 2
    }]
};

const config = {
    type: 'pie',
    data: data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Perbandingan Saldo Akun'
            }
        }
    },
};

const myPieChart = new Chart(
    document.getElementById('myPieChart'),
    config
);
</script>
<script>
const barLabels = <?= $jenis_sampah ?>;
const barData = {
    labels: barLabels,
    datasets: [{
        label: 'Total Sampah',
        backgroundColor: 'rgba(255, 255, 255)',
        borderColor: 'rgba(255, 255, 255, 1)',
        borderWidth: 1,
        data: <?= $total_sampah ?>
    }]
};

const barConfig = {
    type: 'bar',
    data: barData,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    },
};

const myBarChart = new Chart(
    document.getElementById('myBarChart'),
    barConfig
);
</script>
<script>
//  function updateTime() {
//      const now = new Date();
//      const timeString = now.toLocaleTimeString();
//      const dateString = now.toLocaleDateString();
//      const fullDateTimeString = `${dateString} ${timeString}`;

//      document.getElementById('waktusekarang').textContent = fullDateTimeString;
//  }
function updateTime() {
    const now = new Date();
    const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    const months = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    const dayName = days[now.getDay()];
    const monthName = months[now.getMonth()];
    const day = now.getDate();
    const year = now.getFullYear();
    const timeString = now.toLocaleTimeString();

    const fullDateTimeString = `${dayName}, ${day} ${monthName} ${year} ${timeString}`;

    let waktuSekarang = new Date();
    let jam = waktuSekarang.getHours();

    let pesanSelamat = '';

    if (jam >= 5 && jam < 10.59) {
        pesanSelamat = 'Selamat Pagi!';
    } else if (jam >= 11 && jam < 14.59) {
        pesanSelamat = 'Selamat Siang!';
    } else if (jam >= 14.59 && jam < 18) {
        pesanSelamat = 'Selamat Sore!';
    } else {
        pesanSelamat = 'Selamat Malam!';
    }

    let pesanSelamatElement = document.getElementById("pesanSelamat");
    if (pesanSelamatElement) {
        pesanSelamatElement.textContent = pesanSelamat;
    }

    document.getElementById('waktusekarang').textContent = fullDateTimeString;
}
setInterval(updateTime, 1000); // Update every second
</script>
<script>
fetch('https://api.openweathermap.org/data/2.5/weather?q=Jakarta&appid=71aeca16726bc04ff24b206ff2b2e688&units=metric')
    .then(response => response.json())
    .then(data => {
        const weatherDiv = document.getElementById('weather-info');
        let weatherDescription = data.weather[0].description;
        const weatherTranslations = {
            'clear sky': 'langit cerah',
            'few clouds': 'sedikit awan',
            'scattered clouds': 'awan tersebar',
            'broken clouds': 'awan terputus',
            'shower rain': 'hujan ringan',
            'rain': 'hujan',
            'thunderstorm': 'badai petir',
            'snow': 'salju',
            'mist': 'kabut',
            'haze': 'kabut asap',
            'overcast clouds': 'awan mendung'
        };

        function ucfirst(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        weatherDescription = weatherTranslations[weatherDescription] || weatherDescription;
        weatherDescription = ucfirst(weatherDescription);
        const temperature = data.main.temp;
        weatherDiv.innerHTML = `
             <div class="card border border-dark weather-card" style="background-color: #fff;">
                <div class="card-header">
                    <h1 id="pesanSelamat" style="margin-bottom: -30px;"></h1><br>
                    <span>Kamu login sebagai <?= $user['username']; ?></span>
                    <table style="margin-top: -10px;">
                        <tbody>
                        <tr>
                            <td><i class="fa-solid fa-cloud"></i></td>
                            <td>&nbsp; </td>
                            <td>Cuaca: ${weatherDescription}</td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-temperature-low"></i></td>
                            <td>&nbsp; </td>
                            <td>Temperatur: ${temperature}°C</td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-clock"></i></i></td>
                            <td>&nbsp; </td>
                            <td>Waktu sekarang: <span id="waktusekarang"</td>
                        </tr>
                        </tbody>    
                <div class="weather-icon">
                </div>
            </div>`;
    })
    .catch(error => {
        console.error('Error fetching weather:', error);
        const weatherDiv = document.getElementById('weather-info');
        weatherDiv.innerHTML = 'Failed to fetch weather data.';
    });
</script>

<!-- <script>
     fetch('https://api.openweathermap.org/data/2.5/weather?q=Jakarta&appid=71aeca16726bc04ff24b206ff2b2e688&units=metric')
         .then(response => response.json())
         .then(data => {
             const weatherDiv = document.getElementById('weather-info');
             const weatherDescription = data.weather[0].description;
             weatherDescription = weatherDescription.replace('haze', 'Kabut asap');
             const temperature = data.main.temp;
             weatherDiv.innerHTML = `<p>Cuaca di Jakarta: ${weatherDescription}</p><p>Temperatur: ${temperature}°C</p>`;
         })
         .catch(error => {
             console.error('Error fetching weather:', error);
             const weatherDiv = document.getElementById('weather-info');
             weatherDiv.innerHTML = 'Failed to fetch weather data.';
         });
 </script>
 </body> -->

</html>