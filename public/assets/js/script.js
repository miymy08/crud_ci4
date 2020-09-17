$(document).on('click', '#btn-edit', function () {
    $('.modal-body #id-pelajar').val($(this).data('id'));
    $('.modal-body #matric_no').val($(this).data('matric_no'));
    $('.modal-body #nama').val($(this).data('nama'));

})


// Sweet Alert 2
const swal = $('.swal').data('swal');
if(swal){
    Swal.fire({
        title: 'Berjaya',
        text: swal,
        icon: 'success'
    })
}

$(document).on('click', '.btn-hapus', function(e){
    //stop deafult acrtion
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
    title: 'Anda Pasti?',
    text: "Data yang telah dibuang tidak dapat dikembalikan",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Buang!'
    }).then((result) => {
    if (result.isConfirmed) {
        document.location.href = href;
    }
    })

})

//dropify (image preview)
$(document).ready(function (){
    $('.dropify').dropify();
});
