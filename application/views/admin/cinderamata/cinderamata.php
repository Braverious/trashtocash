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
                        <a href="#">
                            <i class="fa-solid fa-gift"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Manajemen Cinderamata</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Index</a>
                    </li>
                </ul>
            </div>
            <a href=" <?= base_url('admin/tambah_gift'); ?>" class="btn btn-secondary mb-3">
                Tambah Cinderamata
            </a>
            <div class="row">
                <div class="col-lg-6">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <div class="containers">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($cinderamata as $c) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $c['nama_gift']; ?></td>
                                <td><?= $c['harga']; ?> poin</td>
                                <td><?= $c['deskripsi']; ?></td>
                                <td>
                                    <img class="mb-2 mt-2" style="border: 1px solid #FFF; border-radius: 5px;" src="<?= base_url('assets/images/cinderamata/' . $c['photo']); ?>" alt="Gambar" width="85" height="85">
                                </td>
                                <td><?= $c['stok']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/ubah_gift/'   . $c['id']); ?>" class="btn btn-success btn-sm"><i style="color: #000;" class="fa-solid fa-pencil"></i></a>

                                    <a href="<?= base_url('admin/hapus_gift/' . $c['id']); ?>" class="btn btn-danger btn-sm"><i style="color: #000;" class="fa-solid fa-trash"></i></a>

                                    <a href="<?= base_url('admin/tambah_stok/' . $c['id']); ?>" class="btn btn-success btn-sm"><i style="color: #000;" class="fa-solid fa-plus"></i></a>

                                    <a href="#" data-gift-id="<?= $c['id']; ?>" data-toggle="modal" data-target="#giveGiftModal" class="btn btn-success btn-sm giveGiftBtn">
                                        <i style="color: #000;" class="fa-solid fa-gift"></i>
                                    </a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- Modal Pengurangan Stok untuk ID Member -->
    <div class="modal fade" id="giveGiftModal" tabindex="-1" aria-labelledby="giveGiftModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="background-color: #1A2035; border-radius: 10px;">
            <div class="modal-content" style="background-color: #1A2035;">
                <div class="modal-header">
                    <h2 class="modal-title text-white" id="giveGiftModalLabel"><b>Pengambilan Kupon</b></h2>
                    <button type="button" class="btn btn-close btn-small btn-cross" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <form action="<?= base_url('admin/cinderamata') ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="color: #01E7f4 !important;" for="formGroupExampleInput">ID Member</label>
                            <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="text" class="form-control" id="id_member" name="id_member" placeholder="Ketik ID milik member">
                            <?= form_error('id_member', '<small class="text-light">', '</small>'); ?>
                        </div>
                        <input type="hidden" id="id_gift" name="id_gift" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addGiftModal" tabindex="-1" aria-labelledby="addGiftModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="background-color: #1A2035; border-radius: 10px;">
            <div class="modal-content" style="background-color: #1A2035;">
                <div class="modal-header">
                    <h2 class="modal-title text-white" id="addGiftModalLabel"><b>Tambah Stok Cinderamata</b></h2>
                    <button type="button" class="btn btn-close btn-small btn-cross" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <form action="<?= base_url('admin/cinderamata/tambah_stok') ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="color: #01E7f4 !important;" for="formGroupExampleInput">Stok Tersedia</label>
                            <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="text" class="form-control" id="stok_tersedia" name="stok_tersedia" placeholder="Stok Tersedia">
                            <?= form_error('stok_tersedia', '<small class="text-light">', '</small>'); ?>
                        </div>
                        <input type="hidden" id="id_gift" name="id_gift" value="">
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
        $(document).ready(function() {
            $('.giveGiftBtn').on('click', function() {
                const giftId = $(this).data('gift-id');
                $('#id_gift').val(giftId);
            });
        });
    </script>