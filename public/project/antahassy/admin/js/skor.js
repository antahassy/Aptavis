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
    var klub_elemen = '';
    var skor_elemen = '';
    var arr_skor = [{
        klub_1  : '',
        klub_2  : '',
        skor_1  : '',
        skor_2  : ''
    }];
    $('#tbody_skor').on('keyup', '.input_klub_1, .input_klub_2', function(){
        klub_elemen = $(this);
        if(klub_elemen.val() == ''){
            if(klub_elemen.attr('title').slice(-1) == '1'){
                arr_skor[arr_skor.length - 1].klub_1 = '';
            }else{
                arr_skor[arr_skor.length - 1].klub_2 = '';
            }
        }
    });
    $('#tbody_skor').on('keyup', '.input_skor_1, .input_skor_2', function(){
        skor_elemen = $(this);
        skor_elemen.val(function(index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
        var key_skor = skor_elemen.attr('title').slice(-1);
        if(key_skor == '1'){
            arr_skor[arr_skor.length - 1].skor_1 = skor_elemen.val();
        }else{
            arr_skor[arr_skor.length - 1].skor_2 = skor_elemen.val();
        }
    });
    $('#tbody_skor').on('click', '.btn_del_row', function(){
        $(this).parent().parent().remove();
        arr_skor.pop();
    });
    function klub_autocomplete(){
        $('.input_klub_1, .input_klub_2').autocomplete({
            delay   : 1000,
            source: function(request, response) {
                $.ajax({
                    url: site + '/autocomplete_klub',
                    type: 'get',
                    dataType: "json",
                    data: {
                        keyword: request.term
                    },
                    success: function(data) {
                        response(data);
                    },
                    error       : function(){
                        if(klub_elemen.attr('title').slice(-1) == '1'){
                            arr_skor[arr_skor.length - 1].klub_1 = '';
                        }else{
                            arr_skor[arr_skor.length - 1].klub_2 = '';
                        }
                        swal({
                            background  : 'transparent',
                            html        : '<pre>Data tidak ditemukan</pre>'
                        });
                    }
                });
            },
            select: function (event, ui) {
                var value = ui.item.value;
                $(this).val(value);
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
                                url         : site + '/autocomplete_klub_id',
                                data        : {value : value},
                                async       : true,
                                dataType    : 'json',
                                success     : function(id_data){
                                    var key_klub = klub_elemen.attr('title').slice(-1);
                                    if(key_klub == '1'){
                                        arr_skor[arr_skor.length - 1].klub_1 = id_data;
                                    }else{
                                        arr_skor[arr_skor.length - 1].klub_2 = id_data;
                                    }

                                    if(arr_skor.length > 1 && arr_skor[arr_skor.length - 1].klub_1 != '' && arr_skor[arr_skor.length - 1].klub_2 != ''){
                                        for(i = 0; i < arr_skor.length; i++) {
                                            if(i == arr_skor.length - 1){
                                                swal.close()
                                            }else{
                                                if (arr_skor[i].klub_1 == arr_skor[arr_skor.length - 1].klub_1 && 
                                                    arr_skor[i].klub_2 == arr_skor[arr_skor.length - 1].klub_2
                                                ){
                                                    if(key_klub == '1'){
                                                        arr_skor[arr_skor.length - 1].klub_1 = '';
                                                    }else{
                                                        arr_skor[arr_skor.length - 1].klub_2 = '';
                                                    }
                                                    swal({
                                                        background  : 'transparent',
                                                        html        : '<pre>Data pertandingan sudah ada' + '<br>' + 
                                                                      'Data pertandingan tidak boleh sama</pre>'
                                                    }).then(function(){
                                                        klub_elemen.val('');
                                                    });
                                                    break;
                                                }
                                                if (arr_skor[i].klub_1 == arr_skor[arr_skor.length - 1].klub_2 && 
                                                    arr_skor[i].klub_2 == arr_skor[arr_skor.length - 1].klub_1
                                                ){
                                                    if(key_klub == '1'){
                                                        arr_skor[arr_skor.length - 1].klub_1 = '';
                                                    }else{
                                                        arr_skor[arr_skor.length - 1].klub_2 = '';
                                                    }
                                                    swal({
                                                        background  : 'transparent',
                                                        html        : '<pre>Data pertandingan sudah ada' + '<br>' + 
                                                                      'Data pertandingan tidak boleh sama</pre>'
                                                    }).then(function(){
                                                        klub_elemen.val('');
                                                    });
                                                    break;
                                                }
                                            }
                                        }
                                    }else{
                                        swal.close();
                                    }
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
    }
    function main(){
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
                        arr_skor = [{
                            klub_1  : '',
                            klub_2  : '',
                            skor_1  : '',
                            skor_2  : ''
                        }];
                        $('#form_data')[0].reset();
                        $('#modal_form').find('.modal-title').text('Tambah');
                        $('#btn_process').text('Simpan');
                        $('#form_data').attr('method', 'post');
                        $('#_method').val('post');
                        $('#form_data').attr('action', site + '/admin_skor');
                        var tbody_row = 1;
                        var table_row = 
                        '<tr>' +
                            '<td><input class="input_klub_1 table_row_' + tbody_row + '" type="text" title="klub_1" data="" placeholder="autosearch"></td>' +
                            '<td><input class="input_klub_2 table_row_' + tbody_row + '" type="text" title="klub_2" data="" placeholder="autosearch"></td>' +
                            '<td><input class="input_skor_1 table_row_' + tbody_row + '" type="text" title="skor_1"></td>' +
                            '<td><input class="input_skor_2 table_row_' + tbody_row + '" type="text" title="skor_2"></td>' +
                            '<td></td>' +
                        '</tr>';
                        $('#tbody_skor').html(table_row);
                        klub_autocomplete();
                        swal.close();
                        $('#modal_form').modal('show');
                        data_process(tbody_row);
                    },500);
                }
            });
        });
    }
    function data_process(tbody_row){
        $('#btn_add_row').on('click', function(){
            var last_empty_object = Object.values(arr_skor[arr_skor.length - 1]).some(v => v === '');
            if(last_empty_object == true){
                swal({
                    background  : 'transparent',
                    html        : '<pre>Data tidak sesuai/kurang lengkap</pre>'
                });
            }else{
                $('.table_row_' + tbody_row).attr('readonly', true).css('background','lime');
                $('.btn_del_row').remove();
                arr_skor.push({
                    klub_1  : '',
                    klub_2  : '',
                    skor_1  : '',
                    skor_2  : ''
                });
                tbody_row = tbody_row + 1;
                var table_row = 
                '<tr>' +
                    '<td><input class="input_klub_1 table_row_' + tbody_row + '" type="text" title="klub_1" data="" placeholder="autosearch"></td>' +
                    '<td><input class="input_klub_2 table_row_' + tbody_row + '" type="text" title="klub_2" data="" placeholder="autosearch"></td>' +
                    '<td><input class="input_skor_1 table_row_' + tbody_row + '" type="text" title="skor_1"></td>' +
                    '<td><input class="input_skor_2 table_row_' + tbody_row + '" type="text" title="skor_2"></td>' +
                    '<td><button type="button" class="btn btn-danger btn_del_row" style="padding: 5px; font-size: 12px;">Hapus</button></td>' +
                '</tr>';
                $('#tbody_skor').append(table_row);
                klub_autocomplete();
            }
        });
        $('#btn_process').on('click', function(event){
            event.preventDefault();
            event.stopImmediatePropagation();
            var ajax_method     = $('#form_data').attr('method');
            var ajax_url        = $('#form_data').attr('action');
            var form_data       = $('#form_data')[0];
            form_data           = new FormData(form_data);
            var errormessage    = '';
            var last_empty_object = Object.values(arr_skor[arr_skor.length - 1]).some(v => v === '');
            if(last_empty_object == true){
                errormessage += 'Data tidak sesuai/kurang lengkap \n Hapus/lengkapi data \n';
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
                                        data           : {arr_skor : arr_skor},
                                        async          : true,
                                        dataType       : 'json',
                                        success        : function(response){
                                            if(response.success){
                                                $('#modal_form').modal('hide');
                                                swal({
                                                    html                : '<pre>Data berhasil ' + response.type + '</pre>',
                                                    type                : "success",
                                                    background          : 'transparent'
                                                }).then(function(){
                                                    setTimeout(function(){
                                                        table_data.ajax.reload();
                                                    },500);
                                                });
                                            }
                                            // if(response.duplicate){
                                            //     swal({
                                            //         background  : 'transparent',
                                            //         html        : '<pre>Duplikat data' + '<br>' + 
                                            //                       'Nama klub sudah ada</pre>'
                                            //     });
                                            // }
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
                {data   : 'poin'}
            ]
        });
    }
});