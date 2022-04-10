// let urut = 0;
$("[name='cari_varian']").on('keyup', function(){
    var value = $(this).val().toLowerCase();
    if(value == "") $("#listOfVarian").hide();
    else $("#listOfVarian").show();

    $("#listOfVarian li").each(function () {
        if ($(this).text().toLowerCase().search(value) > -1) {
            $(this).show();
            $(this).prev('.subjectName').last().show();
        } else {
            $(this).hide();
        }
    });
})

$(document).on("click", ".varian", function(){
    urut++;
    let id_varian = $(this).data("id");
    let result = ajax(url_base+"produk/get_varian", "POST", {id_varian : id_varian});
    // console.log(result)
    $(".listOfVarian").append(`
        <tr id="`+urut+`">
            <td>
                <input type="hidden" name="id_varian" value="`+result.id_varian+`">
                <span class="urut">`+urut+`</span>
            </td>
            <td><a href="javascript:void(0)" class="hapusVarian text-danger" data-id="`+urut+`" data-nama="`+result.nama_varian+`">`+result.nama_varian+`</a></td>
            <td class="text-right"><input type="number" name="qty" class="form form-control form-control-md required"></td>
        </tr>
    `)

    $("#btnSimpan").show();

    // $("[name='cari_varian']").val("");
    // $("#listOfVarian").hide();
})

$(document).on("click", ".hapusVarian", function(){
    let id = $(this).data("id");
    let nama = $(this).data("nama");

    Swal.fire({
        icon: 'question',
        text: 'Yakin menghapus '+nama+'?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            urut--;
            $("#"+id).remove();
            let index = 1;
            $.each($(".container-xl .urut"), function(){
                $(this).html(index)
                index++
            })

            if(urut == 0){
                $("#btnSimpan").hide();
            }
        }
    })
})

$("#formPenyetokan #btnSimpan").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menambahkan penyetokan baru?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#formPenyetokan";
            let formData = {};
            $(form+" .form").each(function(index){
                formData = Object.assign(formData, {[$(this).attr("name")]: $(this).val()})
            })

            id_varian = new Array();
            $.each($("input[name='id_varian']"), function(){
                id_varian.push($(this).val());
            });

            qty = new Array();
            $.each($("input[name='qty']"), function(){
                qty.push($(this).val());
            });

            formData = Object.assign(formData, {id_varian:id_varian});
            formData = Object.assign(formData, {qty:qty});

            let eror = required(form);

            if( eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'lengkapi isi form terlebih dahulu'
                })
            } else {
                let result = ajax(url_base+"penyetokan/add_penyetokan", "POST", formData);

                if(result == 1){
                    urut = 0;
                    $("#btnSimpan").hide();
                
                    $(form).trigger('reset');
                    $(".listOfVarian").html("");
                    listOfVarian();

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil menambahkan data penyetokan',
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
        }
    })
})

function listOfVarian(){
    let result = ajax(url_base+"produk/get_all_varian", "POST");
    let html = "";

    result.forEach(varian => {
        html += `
        <li class="list-group-item list-group-item-light text-dark">
            <div class="d-flex justify-content-between">
                `+ varian.kode_varian +` - `+ varian.nama_varian + ` (` + varian.stok + `)
                <a href="javascript:void(0)" class="varian text-success" data-id="`+varian.id_varian+`">
                    `+tablerIcon("square-plus", "me-1")+`
                </a>
            </div>
        </li>
        `
    })

    $("#listOfVarian").html(html);
}

listOfVarian();

$(document).on("click", ".arsipPenyetokan", function(){
    let id_penyetokan = $(this).data("id");

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengarsipkan data penyetokan ini?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            data = {id_penyetokan: id_penyetokan}
            let result = ajax(url_base+"penyetokan/arsip_penyetokan", "POST", data);

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil mengarsipkan data',
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

$(document).on("click", ".bukaArsipPenyetokan", function(){
    let id_penyetokan = $(this).data("id");

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan membuka arsip data penyetokan ini?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            data = {id_penyetokan: id_penyetokan}
            let result = ajax(url_base+"penyetokan/buka_arsip_penyetokan", "POST", data);

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil membuka arsip data',
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

$("#formPenyetokan #btnEdit").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengubah data penyetokan?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#formPenyetokan";
            let formData = {};
            $(form+" .form").each(function(index){
                formData = Object.assign(formData, {[$(this).attr("name")]: $(this).val()})
            })

            id_varian = new Array();
            $.each($("input[name='id_varian']"), function(){
                id_varian.push($(this).val());
            });

            qty = new Array();
            $.each($("input[name='qty']"), function(){
                qty.push($(this).val());
            });

            formData = Object.assign(formData, {id_varian:id_varian});
            formData = Object.assign(formData, {qty:qty});

            let eror = required(form);

            if( eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'lengkapi isi form terlebih dahulu'
                })
            } else {
                let result = ajax(url_base+"penyetokan/edit_penyetokan", "POST", formData);

                if(result == 1){
                    listOfVarian();

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil mengubah data penyetokan',
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
        }
    })
})