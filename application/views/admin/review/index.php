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
                            <a href="/recyloop/review">
                                <i class="fa-solid fa-comments"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Komentar</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Index</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <?= $this->session->flashdata('message') ?>
                </div>
                <div class="containers">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID Member</th>
                                <th scope="col">Nama</th>
                                <!-- <th scope="col">Foto</th> -->
                                <th scope="col">Tanggal</th>
                                <th scope="col">Komentar</th>
                                <th scope="col" style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $unconfirmedReview = array_filter($review, function ($r) {
                                return $r['is_active'] === '0';
                            });
                            ?>
                            <?php if (empty($unconfirmedReview)) : ?> 
                                <tr>
                                    <td colspan="9" style="text-align: center;">Belum ada komentar yang belum terkonfirmasi.</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($unconfirmedReview as $r) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $r['id_member']; ?></td>
                                        <td><?= $r['nama']; ?></td>
                                        <!-- <td><?= $r['photo']; ?></td> -->
                                        <td><?= $r['tanggal']; ?></td>
                                        <td><?= $r['review']; ?></td>
                                        <td>
                                            <a href="<?= base_url('review/updatereview/' . $r['id']); ?>" class="btn btn-light btn-sm" style="width: 30px; height: 30px;"><i style="color: #000;" class="fa-solid fa-check"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
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
            document.getElementById('id_member').addEventListener('input', function() {
                var idMember = this.value;

                if (idMember) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '<?= base_url("withdraw/getUserDataByIdMember"); ?>', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            document.getElementById('username').value = response.username;
                            document.getElementById('koin').value = response.koin;
                        }
                    };
                    xhr.send('id_member=' + idMember);
                } else {
                    document.getElementById('username').value = '';
                    document.getElementById('koin').value = '';
                }
            });
        </script>