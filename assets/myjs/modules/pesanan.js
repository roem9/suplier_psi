$(document).on("click", ".terkirim", function(){
    let id_closing = $(this).data("id");
    let nama_closing = $(this).data("nama");

    Swal.fire({
        icon: 'question',
        text: 'Yakin pesanan atas nama '+nama_closing+' telah terkirim?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            data = {id_closing: id_closing, status_stok: "Terkirim"}
            let result = ajax(url_base+"app/pesanan_terkirim", "POST", data);

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Pesanan '+nama_closing+' terkirim',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                })
            }
        }
    })
})

$(document).on("click", ".komenClosing", function(){
    var id_closing = $(this).data("id");

    console.log(id_closing);
    loadKomen(id_closing);
})

function loadKomen(id_closing) {
    let result = ajax(url_base+"app/list_komen", "POST", {id_closing:id_closing});
    
    $("#komenClosing [name='id_closing'").val(result.closing.id_closing);
    $("#nama_closing").html("<b>"+result.closing.nama_closing+"</b>");
    $("#produk_closing").html("<b>"+result.closing.produk_closing+"</b>");

    html_komen = "";
    result.komen.forEach(komen => {
        html_komen += `<p>
            <b>`+komen.nama_user+` (`+komen.tgl_input+`)</b><br>
            `+komen.komen+`
        </p>`;
    });

    $("#list_komen").html(html_komen);
}

$("#btnKirimKomen").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menambahkan komen baru dan mengubah status pesanan menjadi stok kosong?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#komenClosing";
            
            let formData = {};
            $(form+" .form").each(function(index){
                formData = Object.assign(formData, {[$(this).attr("name")]: $(this).val()})
            })

            let eror = required(form);
            
            if( eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'lengkapi isi form terlebih dahulu'
                })
            } else {
                let result = ajax(url_base+"app/add_komen/status_stok", "POST", formData);

                if(result == 1){
                    loadData();
                    $("#komenClosing [name='komen']").val("");

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil menambahkan komen dan merubah status stok menjadi kosong',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    
                    var id_closing = $(form+" [name='id_closing']").val();
                    loadKomen(id_closing);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                    })
                }
            }
        }
    })
})

$(document).on("click", ".barangTelahDiterima", function(){
    let id_closing = $(this).data("id");
    let nama_closing = $(this).data("nama");

    Swal.fire({
        icon: 'question',
        text: 'Yakin telah menerima retur pesanan '+nama_closing+'?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            data = {id_closing: id_closing}
            let result = ajax(url_base+"app/pesanan_retur_diterima", "POST", data);

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Pesanan '+nama_closing+' telah diterima',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'terjadi kesalahan, silahkan mulai ulang halaman'
                })
            }
        }
    })
})