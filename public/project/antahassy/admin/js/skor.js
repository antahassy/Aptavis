$(document).ready(function(){
    $.ajaxSetup({
        headers     : {
            'X-CSRF-TOKEN'  : $('meta[name="csrf-token"]').attr('content')
        }
    });
    var nama_bulan = new Array();
    nama_bulan[1] = 'Januari';
    nama_bulan[2] = 'Februari';
    nama_bulan[3] = 'Maret';
    nama_bulan[4] = 'April';
    nama_bulan[5] = 'Mei';
    nama_bulan[6] = 'Juni';
    nama_bulan[7] = 'Juli';
    nama_bulan[8] = 'Agustus'; 
    nama_bulan[9] = 'September'; 
    nama_bulan[10] = 'Oktober';
    nama_bulan[11] = 'November'; 
    nama_bulan[12] = 'Desember';
    var table_data = '';
    swal({
        showConfirmButton   : false,
        allowOutsideClick   : false,
        allowEscapeKey      : false,
        background          : 'transparent',
        onOpen  : function(){
            swal.showLoading();
            setTimeout(function(){
                data_table();
            },500);
        }
    });
    function main(){
        $('#kota').autocomplete({
            delay   : 1500,
            source: function(request, response) {
                $.ajax({
                    url: site + '/autocomplete_kota',
                    type: 'get',
                    dataType: "json",
                    data: {
                        keyword: request.term
                    },
                    success: function(data) {
                        response(data);
                    },
                    error       : function(){
                        $('#id_kota').val('');
                        swal({
                            background  : 'transparent',
                            html        : '<pre>Data tidak ditemukan</pre>'
                        });
                    }
                });
            },
            select: function (event, ui) {
                var value = ui.item.value;
                $('#kota').val(value);
                swal({
                    showConfirmButton   : false,
                    allowOutsideClick   : false,
                    allowEscapeKey      : false,
                    background          : 'transparent', 
                    onOpen  : function(){
                        swal.showLoading();
                        setTimeout(function(){
                            $.ajax({
                                type        : 'ajax',
                                method      : 'post',
                                url         : site + '/autocomplete_kota_id',
                                data        : {value : value},
                                async       : true,
                                dataType    : 'json',
                                success     : function(id_data){
                                    $('#id_kota').val(id_data);
                                    swal.close();
                                },
                                error       : function(){
                                    swal({
                                        background  : 'transparent',
                                        html        : '<pre>Koneksi terputus' + '<br>' + 
                                                      'Cobalah beberapa saat lagi</pre>',
                                        type        : "warning"
                                    });
                                }
                            });
                        },500);
                    }
                });
            }
        });
        var modal_form;
        $('#modal_form').on('show.bs.modal', function(){
            $(this).addClass('zoomIn');
            modal_form = true;
        });
        $('#modal_form').on('hide.bs.modal', function(){
            if(modal_form){
                $(this).removeClass('zoomIn').addClass('zoomOut');
                modal_form = false;
                setTimeout(function(){
                    $('#modal_form').modal('hide');
                },350);
                return false;
            }
            $(this).removeClass('zoomOut');
        });
        $('#btn_add').on('click', function(){
            swal({
                showConfirmButton   : false,
                allowOutsideClick   : false,
                allowEscapeKey      : false,
                background          : 'transparent',
                onOpen  : function(){
                    swal.showLoading();
                    setTimeout(function(){
                        $('#form_data')[0].reset();
                        $('#modal_form').find('.modal-title').text('Tambah');
                        $('#btn_process').text('Simpan');
                        $('#form_data').attr('method', 'post');
                        $('#_method').val('post');
                        $('#form_data').attr('action', site + '/admin_skor');
                        swal.close();
                        $('#modal_form').modal('show');
                        data_process();
                    },500);
                }
            });
        });
    }
    function data_process(){
        $('#btn_process').on('click', function(event){
            event.preventDefault();
            event.stopImmediatePropagation();
            var ajax_method     = $('#form_data').attr('method');
            var ajax_url        = $('#form_data').attr('action');
            var form_data       = $('#form_data')[0];
            form_data           = new FormData(form_data);
            var errormessage    = '';
            if(! $('#nama').val()){
                 errormessage += 'Nama klub dibutuhkan \n';
            }
            if(! $('#kota').val()){
                errormessage += 'Kota dibutuhkan \n';
            }else{
                if(! $('#id_kota').val()){
                    errormessage += 'Nama kota tidak lengkap \n';
                }
            }
            if(errormessage !== ''){
                swal({
                    background  : 'transparent',
                    html        : '<pre>' + errormessage + '</pre>'
                });
            }else{
                swal({
                    background          : 'transparent',
                    html                : '<pre>Apakah data sudah benar ?</pre>',
                    type                : 'question',
                    showCancelButton    : true,
                    cancelButtonText    : 'Tidak',
                    confirmButtonText   : 'Ya'
                }).then((result) => {
                    if(result.value){
                        swal({
                            showConfirmButton   : false,
                            allowOutsideClick   : false,
                            allowEscapeKey      : false,
                            background          : 'transparent',
                            onOpen  : function(){
                                swal.showLoading();
                                setTimeout(function(){
                                    $.ajax({
                                        type           : 'ajax',
                                        method         : ajax_method,
                                        url            : ajax_url,
                                        data           : form_data,
                                        async          : true,
                                        processData    : false,
                                        contentType    : false,
                                        cache          : false,
                                        dataType       : 'json',
                                        success        : function(response){
                                            if(response.success){
                                                $('#modal_form').modal('hide');
                                                $('#form_data')[0].reset();
                                                swal({
                                                    html                : '<pre>Data berhasil ' + response.type + '</pre>',
                                                    type                : "success",
                                                    background          : 'transparent',
                                                    allowOutsideClick   : false,
                                                    allowEscapeKey      : false, 
                                                    showConfirmButton   : false,
                                                    timer               : 1000
                                                }).then(function(){
                                                    setTimeout(function(){
                                                        table_data.ajax.reload();
                                                    },500);
                                                });
                                            }
                                            if(response.duplicate){
                                                swal({
                                                    background  : 'transparent',
                                                    html        : '<pre>Duplikat data' + '<br>' + 
                                                                  'Nama klub sudah ada</pre>'
                                                });
                                            }
                                        },
                                        error   : function(){
                                            swal({
                                                background  : 'transparent',
                                                html        : '<pre>Koneksi terputus' + '<br>' + 
                                                              'Cobalah beberapa saat lagi</pre>',
                                                type        : "warning"
                                            });
                                        }
                                    });
                                },500);
                            }
                        });     
                    }
                });
            }
            return false;
        });
    }
    function data_table(){
        table_data = $('#table_data').DataTable({
            lengthMenu          : [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
            processing          : true, 
            destroy             : true,
            serverSide          : true, 
            scrollX             : true,
            scrollCollapse      : true,
            fixedColumns        : true, 
            initComplete: function(){
                swal.close();
                main();
            },
            ajax            : {
                url         : site + '/admin_skor',
                method      : 'get'
            },
            columns             : [
                {data   : 'DT_RowIndex'},
                {data   : 'klub'},
                {data   : 'main'},
                {data   : 'menang'},
                {data   : 'seri'},
                {data   : 'kalah'},
                {data   : 'goal_menang'},
                {data   : 'goal_kalah'},
                {data   : 'point'},
                {defaultContent: '',
                        render: function(data, type, row){
                            if(hak_akses.includes(3) && hak_akses.includes(4)){
                                return '<button class="btn btn-sm btn-outline-success btn_edit" style="margin: 2.5px;">Edit</button>' + '<button class="btn btn-sm btn-outline-danger btn_delete" style="margin: 2.5px;">Hapus</button>';
                            }
                            if(! hak_akses.includes(3) && hak_akses.includes(4)){
                                return '<button class="btn btn-sm btn-outline-danger btn_delete" style="margin: 2.5px;">Hapus</button>';
                            }
                            if(hak_akses.includes(3) && ! hak_akses.includes(4)){
                                return '<button class="btn btn-sm btn-outline-success btn_edit" style="margin: 2.5px;">Edit</button>';
                            }else{
                                return '';
                            }
                        }
                },
                {data 	: 'updated_at',
                    render: function(data, type, row){
                        if(row.updated_at != null){
                            var time = row.updated_at.split(' ');
                            return time[0].split('-')[2] + '/' + nama_bulan[Number(time[0].split('-')[1])] + '/' + time[0].split('-')[0] + '<br>' + time[1] + '<br>' + row.updated; 
                        }else{
                            return '';
                        }
                    }
                }
            ]
        });
    }
});