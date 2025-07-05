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
                         <a href="reports">
                             <i class="fa-solid fa-paste"></i> </a>
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
             <div class="container">
                 <div class="row">
                     <div class="col">
                         <?= $this->session->flashdata('message') ?>
                         <form action="<?= base_url('reports') ?>" method="POST">
                             <div class="form-group row">
                                 <label for="name" class="col-sm-3 col-form-label">ID Akun</label>
                                 <div class="col-sm-12">
                                     <?php
                                        if ($user['role_id'] == 1) {
                                            $value = $user['id_admin'];
                                        } elseif ($user['role_id'] == 2) {
                                            $value = $user['id_staff'];
                                        } else {
                                            $value = $user['id_member'];
                                        }
                                        ?>
                                     <input type="text" class="form-control" id="id_account" name="id_account" value="<?= $value ?>" placeholder="Masukkan Nama Lengkap" style="color: #1A2035; font-weight: bold; background: #fff !important;" readonly>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="name" class="col-sm-3 col-form-label">Nama lengkap</label>
                                 <div class="col-sm-12">
                                     <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['username']; ?>" placeholder="Masukkan Nama Lengkap" style="color: #1A2035; font-weight: bold;" readonly>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="judul" class="col-sm-3 col-form-label"><b>Judul</b></label>
                                 <div class="col-sm-12">
                                     <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul Laporan">
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="tanggal" class="col-sm-4 col-form-label"><b>Tanggal</b></label>
                                 <div class="col-sm-12">
                                     <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan Tanggal">
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="myTextarea" class="col-sm-3 col-form-label"><b>Keterangan</b></label>
                                 <div class="col-sm-12">
                                     <textarea class="form-control" id="myTextarea" name="deskripsi" placeholder="Ketik keterangan laporan secara lengkap"></textarea>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <div class="col-sm-4">
                                     <button type="submit" class="btn btn-primary">Kirim</button>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>