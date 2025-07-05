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
                        <a href="/recyloop/admin/staff">
                            <i class="fa-solid fa-id-badge"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Manajemen Staff</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Index</a>
                    </li>
                </ul>
            </div>
            <a href=" <?= base_url('admin/add_staff'); ?>" class="btn btn-secondary mb-3">Tambah Staff</a>
            <div class="row">
                <div class="col-lg-6">
                    <?= $this->session->flashdata('message') ?>
                </div>
            </div>
            <div class="containers">
                <input type="text" id="searchInput" class="form-control mb-3 col-sm-4" placeholder="Cari nama anggota">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50px;">Kode Staff</th>
                            <th scope="col" style="width: 100px;">Nama</th>
                            <th scope="col" style="width: 50px;">Foto</th>
                            <th scope="col" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($staff as $u) : ?>
                            <tr>
                                <th scope="row"><?= $u['id_staff']; ?></th>
                                <td><?= $u['nama']; ?></td>
                                <td>
                                    <img class="mb-2 mt-2" style="border: 1px solid #FFF; border-radius: 5px;" src="<?= base_url('assets/images/user/profile/' . $u['photo']); ?>" alt="Gambar" width="85" height="85">
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/staff_info/' . $u['id_staff']); ?>" class="btn btn-primary btn-sm"><i style="color: #000;" class="fa-solid fa-circle-info"></i></a>
                                    <a href="<?= base_url('admin/staff_edit/' . $u['id_staff']); ?>" class="btn btn-success btn-sm"><i style="color: #000;" class="fa-solid fa-pencil"></i></a>
                                    <?php if ($u['is_active'] == 1) : ?>
                                        <a href="<?= base_url('admin/blokir/' . $u['id_staff']); ?>" class="btn btn-warning btn-sm"><i style="color: #000;" class="fa-solid fa-ban"></i></a>
                                    <?php else : ?>
                                        <a href="<?= base_url('admin/lepas_blokir/' . $u['id_staff']); ?>" class="btn btn-secondary btn-sm"><i style="color: #000;" class="fa-solid fa-ban"></i></a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('admin/staff_delete/' . $u['id_staff']); ?>" class="btn btn-danger btn-sm"><i style="color: #000;" class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?= $this->pagination->create_links(); ?>

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