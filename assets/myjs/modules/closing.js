// detail cs 
$(document).on("click",".statusClosing", function(){
    let form = "#statusClosing";
    let id_closing = $(this).data("id");

    let data = {id_closing: id_closing};
    let result = ajax(url_base+"closing/get_closing", "POST", data);
    
    $.each(result, function(key, value){
        $(form+" [name='"+key+"']").val(value)
    })

    if(result.status == "Delivered"){
        $("#tgl_delivery").show();
        $("[name='tgl_delivery']").addClass("required");
        $("#catatan").hide();
        $("[name='catatan']").removeClass("required");
        $("#tgl_retur_cancel").hide();
        $("[name='tgl_retur_cancel']").removeClass("required");
    } else if(result.status == "Returned" || result.status == "Canceled"){
        $("#tgl_delivery").hide();
        $("[name='tgl_delivery']").removeClass("required");
        $("#catatan").show();
        $("[name='catatan']").addClass("required");
        $("#tgl_retur_cancel").show();
        $("[name='tgl_retur_cancel']").addClass("required");
    } else {
        $("#tgl_delivery").hide();
        $("[name='tgl_delivery']").removeClass("required");
        $("#catatan").hide();
        $("[name='catatan']").removeClass("required");
        $("#tgl_retur_cancel").hide();
        $("[name='tgl_retur_cancel']").removeClass("required");
    }
})

$("#statusClosing [name='status']").on("change", function(){
    let status = $(this).val();

    if(status == "Delivered"){
        $("#tgl_delivery").show();
        $("[name='tgl_delivery']").addClass("required");
        $("#catatan").hide();
        $("[name='catatan']").removeClass("required");
        $("#tgl_retur_cancel").hide();
        $("[name='tgl_retur_cancel']").removeClass("required");
    } else if(status == "Returned" || status == "Canceled"){
        $("#tgl_delivery").hide();
        $("[name='tgl_delivery']").removeClass("required");
        $("#catatan").show();
        $("[name='catatan']").addClass("required");
        $("#tgl_retur_cancel").show();
        $("[name='tgl_retur_cancel']").addClass("required");
    } else {
        $("#tgl_delivery").hide();
        $("[name='tgl_delivery']").removeClass("required");
        $("#catatan").hide();
        $("[name='catatan']").removeClass("required");
        $("#tgl_retur_cancel").hide();
        $("[name='tgl_retur_cancel']").removeClass("required");
    }
})

$("#statusClosing .btnEdit").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan merubah status closing?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#statusClosing";
            
            let formData = {};
            $(form+" .form").each(function(){
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
                let result = ajax(url_base+"closing/edit_status_closing", "POST", formData);

                if(result == 1){
                    loadData();

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil merubah status closing',
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

$("[name='cari_varian']").on('keyup', function(){
    var value = $(this).val().toLowerCase();
    if(value == "") $("#listOfClosing").hide();
    else $("#listOfClosing").show();

    $("#listOfClosing li").each(function () {
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
    index++;
    let id_varian = $(this).data("id");
    let result = ajax(url_base+"produk/get_varian", "POST", {id_varian : id_varian});
    // console.log(result)
    $(".listOfClosing").append(`
        <tr id="`+urut+`">
            <td>
                <a href="javascript:void(0)" class="hapusClosing text-danger" data-id="`+index+`" data-nama="`+result.nama_varian+`">`+result.nama_varian+`</a> <br>
            </td>
            <td class="text-right"><input type="number" name="qty" id="qty-`+index+`" class="form form-control form-control-md required number" data-id="`+index+`" style="padding-left: 5px; padding-right: 5px">
                <input type="hidden" name="id_varian" value="`+result.id_varian+`">
                <input type="hidden" name="harga" value="`+result.harga+`" id="harga-`+index+`">
            </td>
        </tr>
    `)
    $("#btnSimpan").show();
    
    $("[name='cari_varian']").val("");
    $("#listOfClosing").hide();
})

$(document).on("click", ".hapusClosing", function(){
    let form = "#formClosing";
    let id = $(this).data("id");
    let nama = $(this).data("nama");
    // console.log(id, nama);

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
            index--;
            $("#"+id).remove();
            let no = 1;
            $.each($(".container-xl .urut"), function(){
                $(this).html(no)
                no++
            })

            if(urut == 0){
                $("#btnSimpan").hide();
            }
        }
    })
})

$("#formClosing #btnSimpan").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menambahkan data closing baru?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#formClosing";
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

            harga = new Array();
            $.each($("input[name='harga']"), function(){
                harga.push($(this).val());
            });

            formData = Object.assign(formData, {id_varian:id_varian, qty:qty, harga:harga});
            // console.log(formData);

            let eror = required(form);

            if( eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'lengkapi isi form terlebih dahulu'
                })
            } else {
                let result = ajax(url_base+"closing/add_closing", "POST", formData);

                if(result == 1){
                    urut = 0;
                    $("#btnSimpan").hide();
                
                    $(form).trigger('reset');
                    $(".listOfClosing").html("");
                    listOfClosing();

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil menambahkan data closing',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    urut = 0;
                    $("#btnSimpan").hide();
                
                    $(form).trigger('reset');
                    $(".listOfClosing").html("");
                    listOfClosing();

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data Duplikat. Gagal menginputkan data closing'
                    })
                }
            }
        }
    })
})

function listOfClosing(){
    let result = ajax(url_base+"produk/get_all_varian", "POST");
    let html = "";

    result.forEach(varian => {
        html += `
        <li class="list-group-item list-group-item-light text-dark">
            <div class="d-flex justify-content-between">
                `+ varian.kode_varian + ` - `+ varian.nama_varian + ` (` + varian.stok + `)
                <a href="javascript:void(0)" class="varian text-success" data-id="`+varian.id_varian+`">
                    `+tablerIcon("square-plus", "me-1")+`
                </a>
            </div>
        </li>
        `
    })

    $("#listOfClosing").html(html);
}

listOfClosing();

$(document).on("click", ".arsipClosing", function(){
    let id_closing = $(this).data("id");

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengarsipkan data closing ini?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            data = {id_closing: id_closing}
            let result = ajax(url_base+"closing/arsip_closing", "POST", data);

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

$(document).on("click", ".bukaArsipClosing", function(){
    let id_closing = $(this).data("id");

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan membuka arsip data closing ini?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            data = {id_closing: id_closing}
            let result = ajax(url_base+"closing/buka_arsip_closing", "POST", data);

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

$("#formClosing #btnEdit").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengubah data closing?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#formClosing";
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

            harga = new Array();
            $.each($("input[name='harga']"), function(){
                harga.push($(this).val());
            });

            formData = Object.assign(formData, {id_varian:id_varian, qty:qty, harga:harga});
            // console.log(formData);

            let eror = required(form);

            if( eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'lengkapi isi form terlebih dahulu'
                })
            } else {
                let result = ajax(url_base+"closing/edit_closing", "POST", formData);

                if(result == 1){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil mengubah data closing',
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

$("#kode_pos").change(function(){
    let data = $(this).val();
    data = data.split("|");

    $("[name='provinsi']").val(data[0]);
    $("[name='kota_kabupaten']").val(data[1]);
    $("[name='kecamatan']").val(data[2]);
    $("[name='kelurahan']").val(data[3]);
    $("[name='kode_pos']").val(data[4]);
})

$("[name='kelurahan']").on("change", function(){
    let kelurahan = $("[name='kelurahan']").val();
    let kecamatan = $("[name='kecamatan']").val();

    $("[name='kode_pos']").val("");

    let choice = `<option value="">Pilih Rekomendasi Kode Pos</option>`;
    result = ajax(url_base+"closing/get_rekomendasi_kode_pos", "POST", {kelurahan:kelurahan, kecamatan:kecamatan});
    result.forEach(data => {
        choice += `<option value="`+data.provinsi+`|`+data.kota_kabupaten+`|`+data.kecamatan+`|`+data.kelurahan+`|`+data.kode_pos+`">`+data.kecamatan+` `+data.kelurahan+` `+data.kode_pos+`</option>`
    });

    $("#kode_pos").html(choice)
})

$("[name='kecamatan']").on("change", function(){
    let kelurahan = $("[name='kelurahan']").val();
    let kecamatan = $("[name='kecamatan']").val();

    $("[name='kode_pos']").val("");

    let choice = `<option value="">Pilih Rekomendasi Kode Pos</option>`;
    result = ajax(url_base+"closing/get_rekomendasi_kode_pos", "POST", {kelurahan:kelurahan, kecamatan:kecamatan});
    result.forEach(data => {
        choice += `<option value="`+data.provinsi+`|`+data.kota_kabupaten+`|`+data.kecamatan+`|`+data.kelurahan+`|`+data.kode_pos+`">`+data.kecamatan+` `+data.kelurahan+` `+data.kode_pos+`</option>`
    });

    $("#kode_pos").html(choice)
})

var v_nama_closing = "";
var v_no_hp = "";
var v_nama_jalan = "";
var v_kelurahan = "";
var v_rt_rw = "";
var v_kecamatan = "";
var v_kota_kabupaten = "";
var v_data_pesanan = "";
var v_kode_pos = "";
var v_produk = "";
var v_warna = "";
var v_ukuran = "";
var v_jumlah = "";
var v_nominal = "";
var v_metode_pembayaran = "";
var v_perhatian = "";

$(".btnGenerate").click(function(){
    $("#formClosing").trigger("reset");

    $("#nama_closing").html();
    $("#alamat").html();
    $("#no_hp").html();
    $("#kode_pos").html();
    $("#transfer").html();
    $("#cod").html();
    $("#produk").html();
    $("#kelurahan").html();
    $("#jumlah").html();
    $("#ukuran").html();
    $("#warna").html();
    $("#kecamatan").html();
    $("#nama_cs").html();

    let teks = $("[name='teks']").val();
    v_nama_closing = teks.search("Nama Lengkap :");
    v_no_hp = teks.search("No.WA :");
    v_nama_jalan = teks.search("Nama Jalan :");
    v_rt_rw = teks.search("RT/RW :");
    v_kelurahan = teks.search("Kelurahan/Desa :");
    v_kecamatan = teks.search("Kecamatan :");
    // v_kota_kabupaten = teks.search("Kota/Kabupaten :");

    v_data_pesanan = teks.search("DATA PESANAN");

    // v_kode_pos = teks.search("Kode Pos :");
    v_produk = teks.search("Produk :");

    v_warna = teks.search("Warna :");
    v_ukuran = teks.search("Ukuran :");

    v_jumlah = teks.search("Jumlah :");
    v_nominal = teks.search("Nominal :");
    v_metode_pembayaran = teks.search("Pembayaran COD / Transfer :");
    v_perhatian = teks.search("Perhatian :");

    nama_closing = teks.substring(v_nama_closing + 14, v_no_hp)
    no_hp = teks.substring(v_no_hp + 7, v_nama_jalan)
    nama_jalan = teks.substring(v_nama_jalan + 12, v_rt_rw)
    rt_rw = teks.substring(v_rt_rw + 7, v_kelurahan)
    kelurahan = teks.substring(v_kelurahan + 16, v_kecamatan)
    kecamatan = teks.substring(v_kecamatan + 11, v_data_pesanan)
    // kota_kabupaten = teks.substring(v_kota_kabupaten + 16, v_data_pesanan)
    produk = teks.substring(v_produk + 8, v_jumlah)
    jumlah = teks.substring(v_jumlah + 9, v_nominal)
    nominal = teks.substring(v_nominal + 9, v_metode_pembayaran)
    metode_pembayaran = teks.substring(v_metode_pembayaran + 27, v_perhatian)

    $("[name='nama_closing']").val(nama_closing.trim());
    $("[name='no_hp']").val(no_hp.trim());
    $("[name='nama_jalan']").val(nama_jalan.trim());
    $("[name='kelurahan']").val(kelurahan.trim());
    $("[name='rt_rw']").val(rt_rw.trim());
    $("[name='kecamatan']").val(kecamatan.trim());
    // $("[name='kota_kabupaten']").val(kota_kabupaten.trim());
    // $("[name='kode_pos']").val(kode_pos.trim());

    $("[name='produk']").val(produk.trim());

    $("[name='jumlah']").val(jumlah.trim());
    $("[name='nominal_transaksi']").val(nominal.trim());
    $("[name='metode_pembayaran']").val(metode_pembayaran.trim().toLowerCase());

    $("[name='kode_pos']").val("");
    
    let choice = `<option value="">Pilih Rekomendasi Kode Pos</option>`;
    result = ajax(url_base+"closing/get_rekomendasi_kode_pos", "POST", {kelurahan:kelurahan.trim(), kecamatan:kecamatan.trim()});
    result.forEach(data => {
        choice += `<option value="`+data.provinsi+`|`+data.kota_kabupaten+`|`+data.kecamatan+`|`+data.kelurahan+`|`+data.kode_pos+`">`+data.kecamatan+` `+data.kelurahan+` `+data.kode_pos+`</option>`
    });

    $("#kode_pos").html(choice)

    Swal.fire({
        position: 'center',
        icon: 'success',
        text: 'Berhasil mengenerate data pemesanan',
        showConfirmButton: false,
        timer: 1500
    })
})