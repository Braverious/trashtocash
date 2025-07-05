<style>
.row {
    opacity: 0;
    filter: blur(5px);
    transform: translateX(-10%);
    transition: all 1s;
}

.show {
    opacity: 1;
    filter: blur(0);
    transform: translateX(0);
}

@media(prefers-reduced-motion) {
    .hidden {
        transition: none;
    }
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-control-user {
    height: calc(2.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    display: block;
    width: 100%;
}

.input-group {
    display: flex;
    width: 100%;
}

.input-group-prepend {
    margin-right: -1px;
}

input.form-control-user {
    flex: 1 1 auto;
    width: 1%;
    min-width: 0;
}

.text-danger {
    display: block;
    margin-top: .25rem;
    font-size: 80%;
    color: #e3342f;
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="container col-lg-8" style="margin-top: 7vh; margin-bottom: 7vh; opacity: 94%;">
            <div class="row">
                <div class="col-lg">
                    <div class="p-5"
                        style="background: #1D243C; border-radius: 10px; box-shadow: 0px 0px 15px 0px rgba(28,39,66,0.75);">
                        <div class="text-center">
                            <h1 style="color: #FFF;" class="h4 mb-4"> <?= $judul; ?> </h1>
                        </div>

                        <div class="flash_data">
                            <?= $this->session->flashdata('message'); ?>
                        </div>

                        <form class="user" method="post" action="<?= base_url('auth/register'); ?>" autocomplete="off">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group"
                                                    style="width: 50px; display: flex; justify-content: center; align-items: center; background: #2d3a67; border-radius: 6px 0px 0px 6px">
                                                    <i class="fas fa-solid fa-id-card" style="font-size: 18px;"></i>
                                                </span>
                                            </div>
                                            <input
                                                style="border-radius: 0px 5px 5px 0px; border: 0px; background: #262E49; color: #23C78D;"
                                                type="text" class="form-control form-control-user" id="nama" name="nama"
                                                placeholder="Masukkan Nama Lengkap" value="<?= set_value('nama') ?>">
                                        </div>
                                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group"
                                                    style="width: 50px; display: flex; justify-content: center; align-items: center; background: #2d3a67; border-radius: 6px 0px 0px 6px">
                                                    <i class="fas fa-solid fa-envelope" style="font-size: 18px;"></i>
                                                </span>
                                            </div>
                                            <input
                                                style="border-radius: 0px 5px 5px 0px; border: 0px; background: #262E49; color: #23C78D;"
                                                type="text" class="form-control form-control-user" id="email"
                                                name="email" placeholder="Masukkan Email"
                                                value="<?= set_value('email') ?>">
                                        </div>
                                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group"
                                                    style="width: 50px; display: flex; justify-content: center; align-items: center; background: #2d3a67; border-radius: 6px 0px 0px 6px">
                                                    <i class="fas fa-solid fa-signature" style="font-size: 18px;"></i>
                                                </span>
                                            </div>
                                            <input
                                                style="border-radius: 0px 5px 5px 0px; border: 0px; background: #262E49; color: #23C78D;"
                                                type="text" class="form-control form-control-user" id="username"
                                                name="username" placeholder="Masukkan Username"
                                                value="<?= set_value('username') ?>">
                                        </div>
                                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group"
                                                    style="width: 50px; display: flex; justify-content: center; align-items: center; background: #2d3a67; border-radius: 6px 0px 0px 6px">
                                                    <i class="fas fa-solid fa-key" style="font-size: 18px;"></i>
                                                </span>
                                            </div>
                                            <input
                                                style="border-radius: 0px 5px 5px 0px; border: 0px; background: #262E49; color: #23C78D;"
                                                type="password" class="form-control form-control-user" id="password"
                                                name="password" placeholder="Masukkan Password">
                                        </div>
                                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lahir">Tanggal Lahir</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group"
                                                    style="width: 50px; display: flex; justify-content: center; align-items: center; background: #2d3a67; border-radius: 6px 0px 0px 6px">
                                                    <i class="fas fa-solid fa-calendar" style="font-size: 18px;"></i>
                                                </span>
                                            </div>
                                            <input
                                                style="border-radius: 0px 5px 5px 0px; border: 0px; background: #262E49; color: #23C78D;"
                                                type="date" class="form-control form-control-user" id="lahir"
                                                name="lahir" placeholder="Masukkan Tanggal Lahir"
                                                value="<?= set_value('lahir') ?>">
                                        </div>
                                        <?= form_error('lahir', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="notelp">No. Telp</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group"
                                                    style="width: 50px; display: flex; justify-content: center; align-items: center; background: #2d3a67; border-radius: 6px 0px 0px 6px">
                                                    <i class="fas fa-solid fa-phone" style="font-size: 18px;"></i>
                                                </span>
                                            </div>
                                            <input
                                                style="border-radius: 0px 5px 5px 0px; border: 0px; background: #262E49; color: #23C78D;"
                                                type="text" class="form-control form-control-user" id="notelp"
                                                name="notelp" placeholder="Masukkan No. Telp"
                                                value="<?= set_value('notelp') ?>">
                                        </div>
                                        <?= form_error('notelp', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group"
                                            style="width: 50px; display: flex; justify-content: center; align-items: center; background: #2d3a67; border-radius: 6px 0px 0px 6px">
                                            <i class="fas fa-solid fa-address-book" style="font-size: 18px;"></i>
                                        </span>
                                    </div>
                                    <input
                                        style="border-radius: 0px 5px 5px 0px; border: 0px; background: #262E49; color: #23C78D;"
                                        type="text" class="form-control form-control-user" id="alamat" name="alamat"
                                        placeholder="Masukkan Alamat" value="<?= set_value('alamat') ?>">
                                </div>
                                <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-success btn-user mt-3 btn-block">
                                Register
                            </button>
                        </form>

                        <hr>
                        <div class="col-md-12" style="display: flex; justify-content: center">
                            <div class="text-center m-2">
                                <a style="text-decoration: none;" class="small" href="<?= base_url('auth'); ?>">
                                    Login </a>
                            </div>
                            <div class="text-center m-2">
                                <a style="text-decoration: none;" class="small" href="<?= base_url('home'); ?>">
                                    Kembali </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
window.setTimeout(function() {
    $(".flash_data").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 2000);
</script>

<script>
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        console.info(entry);
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        } else {
            entry.target.classList.remove('show');
        }
    });
});

const hiddenElements = document.querySelectorAll('.row');
hiddenElements.forEach((el) => observer.observe(el));
</script>