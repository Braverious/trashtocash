 <style>
     .filter-group {
         margin-bottom: 20px;
     }

     select,
     input[type="date"] {
         padding: 10px;
         border: 1px solid #ccc;
         border-radius: 5px;
         margin-right: 10px;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
         transition: all 0.3s ease;
     }

     select:focus,
     input[type="date"]:focus {
         border-color: #007bff;
         box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
         outline: none;
     }
 </style>
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
                         <a href="/recyloop/log/reports">
                             <i class="fa-solid fa-paste"></i>
                         </a>
                     </li>
                     <li class="separator">
                         <i class="flaticon-right-arrow"></i>
                     </li>
                     <li class="nav-item">
                         <a href="#"><?= $judul ?></a>
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
             <!-- <a href=" <?= base_url('reports/add_reports'); ?>" class="btn btn-secondary mb-3">Tambah Laporan Masalah</a> -->
             <div class="container">
                 <div class="filter-group" style="display: flex; gap: 10px;">
                     <div class="filter-item" style="display: flex; flex-direction: column;">
                         <label for="searchName">Cari berdasarkan User</label>
                         <input type="text" id="searchName" class="form-control" style="height: 38px; padding: 6px;" placeholder="Cari berdasarkan user">
                     </div>
                     <div class="filter-item" style="display: flex; flex-direction: column;">
                         <label for="searchJudul">Cari berdasarkan judul</label>
                         <input type="text" id="searchJudul" class="form-control" style="height: 38px; padding: 6px;" placeholder="Cari berdasarkan judul">
                     </div>
                     <div class="filter-item" style="display: flex; flex-direction: column;">
                         <label for="dateSearch">Cari berdasarkan Tanggal:</label>
                         <input type="date" id="dateSearch" class="form-control" style="height: 38px; padding: 5px;">
                     </div>
                 </div>
                 <table class="table table-hover table-bordered" id="dataTable">
                     <thead>
                         <tr style="background: #fff; color: black;">
                             <th scope="col">No</th>
                             <th scope="col">Petugas</th>
                             <th scope="col">Judul</th>
                             <th scope="col">Tanggal</th>
                             <th scope="col">Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php if (empty($menu)) : ?>
                             <tr>
                                 <td colspan="5" style="text-align: center;">
                                     <b>Belum ada laporan masalah yang masuk</b>
                                 </td>
                             </tr>
                         <?php else : ?>
                             <?php $i = 1; ?>
                             <?php foreach ($menu as $m) : ?>
                                 <tr>
                                     <th scope="row" style="width: 50px"><?= $i; ?></th>
                                     <td style="width: 290px"><?= $m['nama']; ?></td>
                                     <td><b><?= $m['judul']; ?></b></td>
                                     <td><?= $m['tanggal']; ?></td>
                                     <td style="text-align:center; vertical-align: middle;">
                                         <a href="<?= base_url('log/info_reports?id=' . $m['id']); ?>" class="btn btn-info"> <i class="fa-solid fa-eye"></i> </a>
                                     </td>
                                 </tr>
                                 <?php $i++; ?>
                             <?php endforeach; ?>
                         <?php endif; ?>
                     </tbody>
                 </table>
             </div>
             <script type="text/javascript">
                 window.setTimeout(function() {
                     $(".col-lg-6").fadeTo(500, 0).slideUp(500, function() {
                         $(this).remove();
                     });
                 }, 2000);
             </script>
             <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
             <script>
                 document.addEventListener('DOMContentLoaded', (event) => {
                     const searchNameInput = document.getElementById('searchName');
                     const searchJudulInput = document.getElementById('searchJudul');
                     const dateSearchInput = document.getElementById('dateSearch');
                     const dataTable = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
                     const rows = dataTable.getElementsByTagName('tr');

                     searchNameInput.addEventListener('input', filterTable);
                     searchJudulInput.addEventListener('input', filterTable);
                     dateSearchInput.addEventListener('input', filterTable);

                     function filterTable() {
                         const searchNameValue = searchNameInput.value.toLowerCase();
                         const searchJudulValue = searchJudulInput.value.toLowerCase();
                         const dateSearchValue = dateSearchInput.value;

                         for (let i = 0; i < rows.length; i++) {
                             const cells = rows[i].getElementsByTagName('td');
                             const userName = cells[0].textContent.toLowerCase();
                             const judul = cells[1].textContent.toLowerCase(); // Change variable name to lowercase
                             const date = cells[2].textContent;

                             let nameMatch = !searchNameValue || userName.includes(searchNameValue);
                             let judulMatch = !searchJudulValue || judul.includes(searchJudulValue); // Check for title match
                             let dateMatch = !dateSearchValue || date === dateSearchValue;

                             if (nameMatch && judulMatch && dateMatch) { // Adjust condition
                                 rows[i].style.display = '';
                             } else {
                                 rows[i].style.display = 'none';
                             }
                         }
                     }
                 });
             </script>