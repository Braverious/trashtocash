<div class="main-panel" style="font-family: quicksand;">
    <div class="content">
        <div class="page-inner" style="height: 90vh; display: flex; justify-content: center; align-items: center;">

            <div class="container-fluid col-md-8">

                <div class="card border border-secondary">
                    <div class="card-body">
                        <h5 style="text-align: center;" class="card-title mt-1"><?= $judul; ?></h5>
                        <hr>
                        <form action="<?= base_url('staff/blokirMember/') . $user['id']; ?>" method="POST">
                            <div class="row">
                                <div class="col-sm-12 mb-2">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="alasan" name="alasan"
                                            style="color: #FFF; height: 200px !important; resize: none;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12"
                                style="display: flex; justify-content: space-evenly; align-items: center; margin-top: 10px">
                                <button type="submit" class="btn btn-warning">Blokir</button>
                                <a style="width: 100px;" href="<?= base_url('member/listMember'); ?>"
                                    class="btn btn-secondary">
                                    Batal </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>