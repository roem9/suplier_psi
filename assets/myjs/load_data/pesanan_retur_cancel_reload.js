var datatable = $('#dataTable').DataTable({ 
    initComplete: function() {
        var api = this.api();
        $('#mytable_filter input')
            .off('.DT')
            .on('input.DT', function() {
                api.search(this.value).draw();
        });
    },
    oLanguage: {
    sProcessing: "loading..."
    },
    processing: true,
    serverSide: true,
    ajax: {"url": url_base+"app/load_pesanan_retur_cancel", "type": "POST"},
    columns: [
        {"data": "tgl_closing", render : function(row, data, iDisplayIndex){
            return iDisplayIndex.tgl_closing
        }},
        {"data": "nama_closing", className : "text-wrap", render : function(row, data, iDisplayIndex){
            return iDisplayIndex.nama_closing;
        }},
        {"data": "produk_closing", render : function(row, data, iDisplayIndex){
            return iDisplayIndex.produk_closing +`<br><span style="color: #118C4F"><b>`+ formatRupiah(iDisplayIndex.nominal_transaksi, "Rp.") +`</b></span>`
        }},
        {"data": "nama_cs"},
        {"data": "durasi", className:'text-nowrap'},
        {"data": "status_closing", className:'text-nowrap', render : function(row, data, iDisplayIndex){
            return iDisplayIndex.status_closing;
        }},
        {"data": "menu", render : function(row, data, iDisplayIndex){
            if(iDisplayIndex.status == "Canceled"){
                return "<center>-</center>"
            } else {
                if(iDisplayIndex.status_retur == "Sudah Diterima"){
                    return "Sudah Diterima"
                } else {
                    return iDisplayIndex.menu
                }
            }
        }},
    ],
    rowCallback: function(row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        $('td:eq(0)', row).html();
    },
    "columnDefs": [
    { "searchable": false, "targets": [""] },  // Disable search on first and last columns
    { "targets": [0, 1, 2, 3, 4, 5, 6], "orderable": false},
    ],
    "rowReorder": {
        "selector": 'td:nth-child(0)'
    },
    "responsive": true,
});