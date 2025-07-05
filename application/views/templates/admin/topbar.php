<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark2">

        <a href="<?= base_url('admin'); ?>" class="logo">
            <img style="margin-left: 15px; max-width: 135px; max-height: 360px;" src="
                <?= base_url('assets/') ?>images/logo/branding-logo.png" alt="navbar brand" class="navbar-brand">
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
            data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark2">

        <div class="container-fluid">
            <!-- INI FITUR SEARCH -->
            <!-- <div class="collapse" id="search-nav">
                        <form class="navbar-left navbar-form nav-search mr-md-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pr-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input type="text" placeholder="Search ..." class="form-control">
                            </div>
                        </form>
                    </div> -->
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item toggle-nav-search hidden-caret">
                    <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false"
                        aria-controls="search-nav">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
                <!-- <li class="nav-item dropdown hidden-caret">

                        </li> -->

                <!-- Photo Profile User -->
 <div style="display: flex; justify-content: center; margin-right: 20px;">
                            <span class="badge rounded-pill bg-secondary text-light">
                                <?php
                                if ($user['role_id'] == 1) {
                                    echo 'ADMIN';
                                } else if ($user['role_id'] == 2) {
                                    echo 'STAFF';
                                } else {
                                    echo 'MEMBER';
                                }
                                ?>
                            </span>
                        </div>
                        
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="<?= base_url('assets/images/user/profile/') . $user['photo']; ?>" alt="user"
                                class="avatar-img rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img src="<?= base_url('assets/images/user/profile/') . $user['photo']; ?>"
                                            alt="user" class="avatar-img rounded">
                                    </div>
                                    <div class="u-text">
                                        <h4><?= $user['nama']; ?></h4>
                                        <p class="text-muted"><?= $user['email']; ?></p><a
                                            href="<?= base_url('user/my_profile'); ?>"
                                            class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('user/ubah_password'); ?>">Ubah Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a>
                            </li>
                        </div>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
<script>
fetch('https://api.openweathermap.org/data/2.5/weather?q=Jakarta&appid=71aeca16726bc04ff24b206ff2b2e688&units=metric')
    .then(response => response.json())
    .then(data => {
        const weatherDiv = document.getElementById('weather-info');
        let weatherDescription = data.weather[0].description;
        weatherDescription = weatherDescription.replace('haze', 'kabut asap');
        const temperature = data.main.temp;
        weatherDiv.innerHTML = `<p>Cuaca di Jakarta: ${weatherDescription}</p><p>Temperatur: ${temperature}°C</p>`;
    })
    .catch(error => {
        console.error('Error fetching weather:', error);
        const weatherDiv = document.getElementById('weather-info');
        weatherDiv.innerHTML = 'Failed to fetch weather data.';
    });
</script>