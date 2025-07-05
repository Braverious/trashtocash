<div class="main-panel" style="font-family: quicksand;">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"><?= $judul; ?></h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="fa-solid fa-users"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Manajemen Member</a>
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

            <div class="containers">
                <input type="text" id="searchInput" class="form-control mb-3 col-sm-4" placeholder="Cari nama anggota">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope=" col" style="width: 80px;">Kode Member</th>
                            <th scope="col" style="width: 140px;">Nama</th>
                            <th scope="col" style="width: 130px;">Email</th>
                            <th scope="col" style="width: 130px;">Foto</th>
                            <th scope="col" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($members as $u) : ?>
                        <tr>
                            <th scope="row"><?= $u['id_member']; ?></th>
                            <td><?= $u['nama']; ?></td>
                            <td><?= $u['email']; ?></td>
                            <td>
                                <img class="mb-2 mt-2" style="border: 1px solid #FFF; border-radius: 5px;"
                                    src="<?= base_url('assets/images/user/profile/' . $u['photo']); ?>" alt="Gambar"
                                    width="85" height="85">
                            </td>
                            <td>
                                <a href="<?= base_url('staff/memberInfo/'   . $u['id_member']); ?>"
                                    class="btn btn-primary btn-sm"><i style="color: #000;"
                                        class="fa-solid fa-circle-info"></i></a>
                                <?php if ($u['is_active'] == 1) : ?>
                                <a href="<?= base_url('staff/blokirMember/' . $u['id_member']); ?>"
                                    class="btn btn-warning btn-sm"><i style="color: #000;"
                                        class="fa-solid fa-ban"></i></a>
                                <?php else : ?>
                                <a href="<?= base_url('staff/lepasBlokirMember/' . $u['id_member']); ?>"
                                    class="btn btn-secondary btn-sm"><i style="color: #000;"
                                        class="fa-solid fa-ban"></i></a>
                                <?php endif; ?>
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