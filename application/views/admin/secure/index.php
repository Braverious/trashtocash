<style>
    .small-btn {
        padding: 6px 8px;
        font-size: 10px;
    }

    .iframe-container iframe {
        pointer-events: none;
    }

    .iframe-container iframe:hover {
        cursor: default;
    }
</style>
<div class="main-panel" style="font-family: quicksand;">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"><?= $judul; ?></h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/recyloop/member">
                            <i class="fas fa-solid fa-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-home">
                        <a href="/recyloop/secure">
                            <i class="fa-solid fa-building-lock"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Manajemen Pengumuman</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Index</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <?= $this->session->flashdata('message') ?>
                </div>
            </div>
            <div class="container">
                <div class="text-center">
                    <a href="" data-toggle="modal" data-target="#newCameraModal" class="btn btn-secondary mb-3"><i class="fa-solid fa-folder-plus"></i> Kamera Baru</a>
                </div>
                <div class="row justify-content-center">
                    <?php foreach ($menu as $m) : ?>
                        <div class="col-lg-4">
                            <div class="card pricing-card border mb-lg-4">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center mb-4">
                                        <div id="iframeContainer_<?= $m['id']; ?>" class="iframe-container w-100 mb-3" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                                            <iframe id="youtubeFrame_<?= $m['id']; ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="<?= $m['address']; ?>?controls=0&modestbranding=1" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                        <div class="flex-grow-1 text-center text-light" style="font-weight: bold;">
                                            <h4 class="mb-0"><?= $m['tittle']; ?></h4>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-light mb-1" onclick="toggleFullscreen('iframeContainer_<?= $m['id']; ?>')">Fullscreen</button>
                                        <div class="small-btn">
                                            <div class="text-center">
                                                <a href="<?= base_url('secure/update/' . $m['id']); ?>" class="btn btn-light btn-sm small-btn" style="color: black;"><i class="fa-solid fa-pen" style="color: black;"></i></a>
                                                <a href="<?= base_url('secure/delete/' . $m['id']); ?>" class="btn btn-light btn-sm small-btn"><i class="fa-solid fa-trash" style="color: black;"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

            <!-- Modal Tambah Kamera -->
            <div class="modal fade" id="newCameraModal" tabindex="-1" aria-labelledby="newCameraModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="background-color: #1A2035; border-radius: 10px;">
                    <div class="modal-content" style="background-color: #1A2035;">
                        <div class="modal-header">
                            <h2 class="modal-title text-white" id="newCameraModalLabel"><b>Tambah Kamera Baru</b></h2>
                            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                                &times;
                            </button>
                        </div>
                        <form action="<?= base_url('secure') ?>" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label style="color: #01E7f4 !important;" for="formGroupExampleInput">Judul</label>
                                    <input type="text" class="form-control" id="tittle" name="tittle" placeholder="Masukan Judul Ringkas">
                                </div>
                                <div class="form-group">
                                    <label style="color: #01E7f4 !important;" for="formGroupExampleInput">IP Address</label>
                                    <input type="password" class="form-control" id="address" name="address" placeholder="Masukan Alamat IP">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                window.setTimeout(function() {
                    $(".col-lg-6").fadeTo(500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 2000);
            </script>
            <script>
                window.onload = function() {
                    var youtubeFrame = document.getElementById('youtubeFrame');
                    youtubeFrame.onload = function() {
                        youtubeFrame.src = youtubeFrame.src.replace('showinfo=0', 'showinfo=1');
                    };
                };

                function toggleFullscreen(containerId) {
                    var container = document.getElementById(containerId);
                    if (container.requestFullscreen) {
                        container.requestFullscreen();
                    } else if (container.mozRequestFullScreen) { // Firefox
                        container.mozRequestFullScreen();
                    } else if (container.webkitRequestFullscreen) { // Chrome, Safari, Opera
                        container.webkitRequestFullscreen();
                    } else if (container.msRequestFullscreen) { // IE/Edge
                        container.msRequestFullscreen();
                    }
                }
            </script>
        </div>