 <style>
.hidden {
    display: none;
}
 </style>
 <div class="main-panel" style="font-family: quicksand;">
     <div class="content">
         <div class="page-inner">
             <div class="page-header">
                 <h4 class="page-title"><?= $judul; ?></h4>
             </div>
             <div class="container-fluid col-md-8">
                 <div class="card border border-secondary">
                     <div class="card-body">
                         <h5 style="text-align: center;" class="card-title mt-1"><?= $judul; ?></h5>
                         <hr>
                         <div class="alert alert-info" role="alert"
                             style="background: white; color: #1A2035; border-radius: 5px;">
                             <span>Pastikan Driver telah menunjukan bukti transfer atau cek pembayaran sebelum
                                 mengangkut barang.</span>
                         </div>
                         <form action="<?= base_url('admin/tambah_distribusi') ?>" method="POST">
                             <div class="row">
                                 <div class="col-sm-6">
                                     <div class="form-group">
                                         <label for="pengepul">Pengepul</label>
                                         <select class="form-control" id="pengepul" name="pengepul">
                                             <option value="" disabled selected>Pilih pengepul</option>
                                             <option value="TLP">PT. Tangerang Lestari Pratama</option>
                                             <option value="KSA">PT. Krakatau Steel Alumunium</option>
                                             <option value="DPR">CV. Dunia Produk Raya</option>
                                         </select>
                                         <?= form_error('pengepul', '<small class="text-danger">', '</small>'); ?>
                                     </div>
                                     <div class="form-group hidden" id="form-bp">
                                         <label for="bp">Sampah Botol</label>
                                         <input type="number" class="form-control" id="bp" name="bp" autocomplete="off"
                                             min="0" value="0">
                                     </div>
                                     <div class="form-group hidden" id="form-ka">
                                         <label for="ka">Kaleng Alumunium</label>
                                         <input type="number" class="form-control" id="ka" name="ka" autocomplete="off"
                                             min="0" value="0">
                                     </div>
                                     <div class="form-group hidden" id="form-kk">
                                         <label for="kk">Kertas Kardus</label>
                                         <input type="number" class="form-control" id="kk" name="kk" autocomplete="off"
                                             min="0" value="0">
                                     </div>
                                     <input type="hidden" id="petugas" name="petugas">
                                 </div>
                                 <div class="col-sm-6">
                                     <div class="form-group">
                                         <label for="nama">Driver</label>
                                         <input type="text" class="form-control" id="driver" name="driver"
                                             autocomplete="off">
                                         <?= form_error('driver', '<small class="text-danger">', '</small>'); ?>
                                     </div>
                                     <div class="form-group">
                                         <label for="nama">Harga yang harus dibayar pengepul</label>
                                         <input
                                             style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035; font-weight: bold;"
                                             type="text" class="form-control" id="nilai_tukar" value="" readonly>
                                     </div>
                                 </div>
                                 <div class="col-sm-12"
                                     style="display: flex; justify-content: space-evenly; align-items: center; margin-top: 10px">
                                     <button type="submit" class="btn btn-primary">Tambah</button>
                                     <a style="width: 100px;" href="<?= base_url('admin/sampah'); ?>"
                                         class="btn btn-warning">
                                         Batal
                                     </a>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script>
$(document).ready(function() {
    $('#pengepul').change(function() {
        // Hide all forms initially
        $('#form-bp, #form-ka, #form-kk').addClass('hidden');

        // Get the selected value
        var selectedValue = $(this).val();

        // Show the appropriate form based on the selected value
        if (selectedValue === 'TLP') {
            $('#form-bp').removeClass('hidden');
        } else if (selectedValue === 'KSA') {
            $('#form-ka').removeClass('hidden');
        } else if (selectedValue === 'DPR') {
            $('#form-bp').removeClass('hidden');
            $('#form-ka').removeClass('hidden');
            $('#form-kk').removeClass('hidden');
        }
    });
});
 </script>
 <script>
document.addEventListener('DOMContentLoaded', function() {
    const harga_bp = <?= $harga_bp; ?>;
    const harga_ka = <?= $harga_ka; ?>;
    const harga_kk = <?= $harga_kk; ?>;

    const bpInput = document.getElementById('bp');
    const kaInput = document.getElementById('ka');
    const kkInput = document.getElementById('kk');
    const nilaiTukarInput = document.getElementById('nilai_tukar');

    function calculateTotal() {
        const bp = parseFloat(bpInput.value) || 0;
        const ka = parseFloat(kaInput.value) || 0;
        const kk = parseFloat(kkInput.value) || 0;

        const total = (bp * harga_bp) + (ka * harga_ka) + (kk * harga_kk);
        nilaiTukarInput.value = total.toFixed(2);
    }

    bpInput.addEventListener('input', calculateTotal);
    kaInput.addEventListener('input', calculateTotal);
    kkInput.addEventListener('input', calculateTotal);
});
 </script>