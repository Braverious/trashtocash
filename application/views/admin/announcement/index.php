<style>
    .btn-small {
        transform: scale(0.5);
        transform-origin: center;
    }

    .btn-cross {
        margin-bottom: -20px;
    }
</style>
<div class="main-panel" style="font-family: quicksand;">
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
                    <li class="nav-home">
                        <a href="#">
                            <i class="fa-solid fa-paste"></i>
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
            <a href="" data-toggle="modal" data-target="#newAnnouncementModal" class="btn btn-secondary mb-3">Tambah Announcement</a>
            <div class="row">
                <div class="col-lg-6">
                    <?= $this->session->flashdata('message') ?>
                </div>
            </div>
            <div class="container">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Tanggal dibuat</th>
                            <th scope="col">Isi pengumuman</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($menu)) : ?>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada pengumuman</td>
                            </tr>
                        <?php else : ?>
                            <?php $i = 1; ?>
                            <?php foreach ($menu as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $m['judul']; ?></td>
                                    <td><?= $m['tanggal']; ?></td>
                                    <td><?= $m['deskripsi']; ?></td>
                                    <td>
                                        <a href="<?= base_url('announcement/update/' . $m['id']); ?>" class="btn btn-success">
                                            <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                        </a>
                                        <a href="<?= base_url('announcement/delete/' . $m['id']); ?>" class="btn btn-danger">
                                            <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->

<!-- Modal Tambah Announcement -->
<div class="modal fade" id="newAnnouncementModal" tabindex="-1" aria-labelledby="newAnnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="newAnnouncementModalLabel">Tambah Announcement</h2>
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
            </div>
            <form action="<?= base_url('announcement') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukan Judul Ringkas" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukan Isi Pengumuman" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukan Isi Pengumuman" required>
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