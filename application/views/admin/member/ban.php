<div class="main-panel" style="font-family: quicksand;">
    <div class="content">
        <div class="page-inner" style="height: 90vh; display: flex; justify-content: center; align-items: center;">
            <div class="container-fluid col-md-8">
                <div class="card border border-secondary">
                    <div class="card-body">
                        <h5 style="text-align: center;" class="card-title mt-1"><?= $judul; ?></h5>
                        <hr>
                        <form action="<?= base_url('admin/blokirMember/') . $user['id']; ?>" method="POST">
                            <div class="row">
                                <div class="col-sm-12 mb-2">
                                    <div class="form-floating">
                                        <label for="alasan">Alasan</label>
                                        <select class="form-control" id="alasan" name="alasan" style="color: #FFF; padding: 10px;">
                                            <option value="Akun tidak aktif">Akun tidak aktif</option>
                                            <option value="Akun terdeteksi spam">Akun terdeteksi spam</option>
                                            <option value="Akun dalam aktivitas mencurigakan">Akun dalam aktivitas mencurigakan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12" style="display: flex; justify-content: space-evenly; align-items: center; margin-top: 10px">
                                <button type="submit" class="btn btn-primary">Blokir</button>
                                <a style="width: 100px;" href="<?= base_url('admin/member'); ?>" class="btn btn-warning">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>