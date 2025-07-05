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
                        <a href="/recyloop/log/withdraw">
                            <i class="fa-solid fa-file-lines"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Log Tarik Tunai</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Index</a>
                    </li>
                </ul>
            </div>
            <div class="containers">
                <button id="printPdfButton" class="btn btn-light mb-3">
                    <b>
                        <div class="printicon">
                            <i class="fa-solid fa-print"></i>
                            Cetak PDF
                        </div>
                    </b>
                </button>
                <div class="filter-group" style="display: flex; gap: 10px;">
                    <div class="filter-item" style="display: flex; flex-direction: column;">
                        <label for="searchName">Cari berdasarkan User</label>
                        <input type="text" id="searchName" class="form-control" style="height: 38px; padding: 6px;"
                            placeholder="Cari berdasarkan user">
                    </div>
                    <div class="filter-item" style="display: flex; flex-direction: column;">
                        <label for="dateSearch">Cari berdasarkan Tanggal:</label>
                        <input type="date" id="dateSearch" class="form-control" style="height: 38px; padding: 5px;">
                    </div>
                </div>
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">Kode Member</th>
                            <th scope="col">User</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nominal</th>
                            <th scope="col">Metode</th>
                            <th scope="col">Status</th>
                            <th scope="col">Petugas</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($withdraw)) : ?>
                        <tr>
                            <td colspan="9" style="text-align: center;">Belum ada log tarik tunai.</td>
                        </tr>
                        <?php else : ?>
                        <?php foreach ($withdraw as $w) : ?>
                        <tr>
                            <td><?= $w['id_member']; ?></td>
                            <td><?= $w['username']; ?></td>
                            <td><?= $w['tanggal']; ?></td>
                            <td><?= $w['nominal']; ?></td>
                            <td><?= $w['metode']; ?></td>
                            <td><?= $w['status']; ?></td>
                            <td><?= $w['petugas']; ?></td>
                            <td>
                                <a href="<?= base_url('log/info_withdraw/' . $w['id']); ?>" class="btn btn-light btn-sm"
                                    style="width: 30px; height: 30px;"><i style="color: #000;"
                                        class="fa-solid fa-info"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                const searchNameInput = document.getElementById('searchName');
                const dateSearchInput = document.getElementById('dateSearch');
                const dataTable = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
                const rows = dataTable.getElementsByTagName('tr');
                const printPdfButton = document.getElementById('printPdfButton');

                searchNameInput.addEventListener('input', filterTable);
                dateSearchInput.addEventListener('input', filterTable);

                printPdfButton.addEventListener('click', function() {
                    const searchNameValue = searchNameInput.value.toLowerCase();
                    const dateSearchValue = dateSearchInput.value;
                    let url = "pdf_withdraw?";
                    if (dateSearchValue) {
                        url += "date=" + dateSearchValue;
                    }
                    if (searchNameValue) {
                        if (dateSearchValue) {
                            url += "&";
                        }
                        url += "user=" + searchNameValue;
                    }
                    window.location.href = url;
                });

                function filterTable() {
                    const searchNameValue = searchNameInput.value.toLowerCase();
                    const dateSearchValue = dateSearchInput.value;

                    for (let i = 0; i < rows.length; i++) {
                        const cells = rows[i].getElementsByTagName('td');
                        const userName = cells[1].textContent.toLowerCase();
                        const date = cells[2].textContent;

                        let nameMatch = !searchNameValue || userName.includes(searchNameValue);
                        let dateMatch = !dateSearchValue || date === dateSearchValue;

                        if (nameMatch && dateMatch) {
                            rows[i].style.display = '';
                        } else {
                            rows[i].style.display = 'none';
                        }
                    }
                }
            });
            </script>
        </div>
    </div>
</div>