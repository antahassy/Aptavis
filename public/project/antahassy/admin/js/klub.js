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
                        $('#form_data').attr('action', site + '/admin_klub');
                        swal.close();
                        $('#modal_form').modal('show');
                        data_process();
                    },500);
                }
            });
        });
        $('#table_data').on('click', '.btn_edit', function(){
            var action_data = table_data.row($(this).parents('tr')).data();
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
                            method         : 'get',
                            url            : site + '/admin_klub/' + action_data.id + '/edit',
                            async          : true,
                            dataType       : 'json',
                            success        : function(data){
                                $('#form_data')[0].reset();
                                $('#nama').val(data.nama);
                                $('#id_kota').val(data.id_kota);
                                $('#kota').val(data.kota);

                                $('#modal_form').find('.modal-title').text('Edit');
                                $('#btn_process').text('Update');
                                $('#form_data').attr('method', 'post');
                                $('#_method').val('put');
                                $('#form_data').attr('action', site + '/admin_klub/' + data.id);
                                swal.close();
                                $('#modal_form').modal('show');
                                data_process();
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
        });
        $('#table_data').on('click', '.btn_sewa', function(){
            var data_mobil = table_data.row($(this).parents('tr')).data();
            $('#form_sewa')[0].reset();
            $('#id_mobil').val(data_mobil.id);
            $('#merek_sewa').val(data_mobil.merek);
            $('#model_sewa').val(data_mobil.model);
            $('#no_plat_sewa').val(data_mobil.no_plat);
            $('#tarif_sewa').val(data_mobil.tarif);
            $('#selesai_sewa').on('change', function(){
                if($('#mulai_sewa').val() != ''){
                    var sehari = 1000 * 60 * 60 * 24;
                    var start = new Date($('#mulai_sewa').val());
                    var end = new Date($('#selesai_sewa').val());;
                    const day_length = Math.round(Math.abs((start - end) / sehari));
                    var biaya_sewa = day_length * data_mobil.tarif.replace(".", "");
                    $('#biaya_sewa').val(Number(biaya_sewa).toLocaleString('de'));
                }
            });
            $('#mulai_sewa').on('change', function(){
                if($('#selesai_sewa').val() != ''){
                    var sehari = 1000 * 60 * 60 * 24;
                    var start = new Date($('#mulai_sewa').val());
                    var end = new Date($('#selesai_sewa').val());;
                    const day_length = Math.round(Math.abs((start - end) / sehari));
                    var biaya_sewa = day_length * data_mobil.tarif.replace(".", "");
                    $('#biaya_sewa').val(Number(biaya_sewa).toLocaleString('de'));
                }
            });
            $('#modal_sewa').find('.modal-title').text('Sewa Mobil');
            $('#btn_process_sewa').text('Proses');
            $('#form_sewa').attr('method', 'post');
            $('#_method_sewa').val('post');
            $('#form_sewa').attr('action', site + '/admin_klub/sewa');
            $('#modal_sewa').modal('show');
            sewa_process();
        });
        $('#table_data').on('click', '.btn_delete', function(){
            var action_data = table_data.row($(this).parents('tr')).data();
            swal({
                html                : '<pre>Hapus data ini ?</pre>',
                type                : "question",
                background          : 'transparent',
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
                                    type        : 'ajax',
                                    method      : 'post',
                                    data        : {id : action_data.id},
                                    url         : site + '/admin_klub/hapus',
                                    dataType    : "json",
                                    async       : true,
                                    success   : function(response){
                                        if(response.success){
                                            swal({
                                                html                : '<pre>Data berhasil dihapus</pre>',
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
                                    },
                                    error          : function(){
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
        });
    }
    function sewa_process(){
        $('#btn_process_sewa').on('click', function(event){
            event.preventDefault();
            event.stopImmediatePropagation();
            var ajax_method     = $('#form_sewa').attr('method');
            var ajax_url        = $('#form_sewa').attr('action');
            var form_data       = $('#form_sewa')[0];
            form_data           = new FormData(form_data);
            var errormessage    = '';
            if(! $('#id_mobil').val()){
                errormessage += 'Kendaraan dibutuhkan \n';
           }
            if(! $('#merek_sewa').val()){
                 errormessage += 'Merek dibutuhkan \n';
            }
            if(! $('#model_sewa').val()){
                errormessage += 'Model dibutuhkan \n';
            }
            if(! $('#no_plat_sewa').val()){
                errormessage += 'No. plat dibutuhkan \n';
            }
            if(! $('#tarif_sewa').val()){
                errormessage += 'Tarif harian dibutuhkan \n';
            }
            if(! $('#mulai_sewa').val()){
                errormessage += 'Tanggal mulai dibutuhkan \n';
            }
            if(! $('#selesai_sewa').val()){
                errormessage += 'Tanggal selesai dibutuhkan \n';
            }
            if(! $('#biaya_sewa').val()){
                errormessage += 'Biaya sewa dibutuhkan \n';
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
                                                $('#modal_sewa').modal('hide');
                                                $('#form_sewa')[0].reset();
                                                swal({
                                                    html                : '<pre>Kendaraan berhasil ' + response.type + '<br>' + 
                                                                          'Silahkan cek menu daftar sewa</pre>',
                                                    type                : "success",
                                                    background          : 'transparent'
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
                url         : site + '/admin_klub',
                method      : 'get'
            },
            columns             : [
                {data   : 'DT_RowIndex'},
                {data   : 'nama'},
                {data   : 'kota'},
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
                {data 	: 'created_at',
                       render: function(data, type, row){
                        var time = row.created_at.split(' ');
                        return time[0].split('-')[2] + '/' + nama_bulan[Number(time[0].split('-')[1])] + '/' + time[0].split('-')[0] + '<br>' + time[1] + '<br>' + row.created; 
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