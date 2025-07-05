const flashData = $('.flash-data').data('flashdata');

if (flashData) {
    Swal.fire({
        title: 'Data Staff',
        text: 'Berhasil ' + flashData,
        icon: 'success'
    });
}
