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
                        <a href="perusahaan">
                            <i class="fa-solid fa-id-badge"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Informasi Perusahaan</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Index</a>
                    </li>
                </ul>
            </div>
            <a href=" <?= base_url('perusahaan/tambahInformasi'); ?>" class="btn btn-secondary mb-3">Tambah
                Informasi</a>
            <div class="row">
                <div class="col-lg-6">
                    <?= $this->session->flashdata('message') ?>
                </div>
            </div>
            <div class="containers">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50px;">No</th>
                            <th scope="col" style="width: 50px;">Judul</th>
                            <th scope="col" style="width: 350px;">Deskripsi</th>
                            <th scope="col" style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($infoPerusahaan as $ip) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $ip['judul']; ?></td>
                                <td><?= $ip['deskripsi']; ?></td>
                                <td>
                                    <a href="<?= base_url('perusahaan/ubahInformasi/' . $ip['id']); ?>" class="btn btn-success btn-sm"><i style="color: #000;" class="fa-solid fa-pencil"></i></a>
                                    <a href="<?= base_url('perusahaan/hapusInformasi/' . $ip['id']); ?>" class="btn btn-danger btn-sm"><i style="color: #000;" class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
        document.addEventListener("DOMContentLoaded", function() {
            let searchInput = document.getElementById("searchInput");
            searchInput.addEventListener("input", function() {
                let filter = searchInput.value.toLowerCase();

                let rows = document.querySelectorAll("tbody tr");

                rows.forEach(function(row) {
                    let nameColumn = row.querySelector(
                        "td:nth-child(2)");
                    let name = nameColumn.textContent.toLowerCase();

                    if (name.includes(filter)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
    </script>