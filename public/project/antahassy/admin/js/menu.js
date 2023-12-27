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
    function rel_menu(rel_val){
        $.ajax({
            type        : 'ajax',
            method      : 'post',
            url         : site + '/menu_admin/rel_menu',
            dataType    : "json",
            async       : true,
            success: function(rel_data){
                console.log(rel_data)
                if(rel_data.empty){
                    swal({
                        background  : 'transparent',
                        html        : '<pre>Menu belum tersedia</pre>',
                        type        : "warning"
                    });
                }else{
                    var s_rel = '<option value="">Pilih Rel Menu</option>';
                    for(i = 0; i < rel_data.length; i ++){
                        s_rel += '<option value="' + rel_data[i].id + '">' + rel_data[i].menu + '</option>';
                    }
                    $('#s_rel').html(s_rel);
                    if(rel_val != ''){
                        $('#s_rel').val(rel_val);
                    }else{
                        $('#s_rel').val('');
                    }
                    swal.close();
                }
                $('#modal_form').modal('show');
                data_process();
            },
            error: function (){
                swal({
                    background  : 'transparent',
                    html        : '<pre>Koneksi terputus' + '<br>' + 
                                  'Cobalah beberapa saat lagi</pre>',
                    type        : "warning"
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
                        $('#form_data')[0].reset();
                        $('#url').attr('readonly', false).css({'background':'transparent','color':'#3F4254'});
                        $('#modal_form').find('.modal-title').text('Tambah');
                        $('#btn_process').text('Simpan');
                        $('#form_data').attr('method', 'post');
                        $('#_method').val('post');
                        $('#form_data').attr('action', site + '/menu_admin');
                        var rel_val = '';
                        rel_menu(rel_val);
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
                            url            : site + '/menu_admin/' + action_data.id + '/edit',
                            async          : true,
                            dataType       : 'json',
                            success        : function(data){
                                $('#form_data')[0].reset();
                                $('#menu').val(data.menu);
                                $('#url').val(data.url).attr('readonly', true).css({'background':'#3F4254','color':'#fff'});
                                $('#urutan').val(data.urutan);

                                $('#modal_form').find('.modal-title').text('Edit');
                                $('#btn_process').text('Update');
                                $('#form_data').attr('method', 'post');
                                $('#_method').val('put');
                                $('#form_data').attr('action', site + '/menu_admin/' + data.id);

                                var rel_val = '';
                                if(data.rel != '0'){
                                    rel_val = data.rel;
                                }
                                rel_menu(rel_val);
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
        $('#table_data').on('click', '.btn_delete', function(){
            var action_data = table_data.row($(this).parents('tr')).data();
            swal({
                html                : '<pre>Beberapa user akan kehilangan' + '<br>' + 
                                      'Akses menu ini' + '<br>' + 
                                      'Hapus data ini ?</pre>',
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
                                    url         : site + '/menu_admin/hapus',
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
    function data_process(){
        $('#btn_process').on('click', function(event){
            event.preventDefault();
            event.stopImmediatePropagation();
            var ajax_method     = $('#form_data').attr('method');
            var ajax_url        = $('#form_data').attr('action');
            var form_data       = $('#form_data')[0];
            form_data           = new FormData(form_data);
            var errormessage    = '';
            if(! $('#menu').val()){
                 errormessage += 'Nama menu dibutuhkan \n';
            }
            if(! $('#url').val()){
                errormessage += 'Url menu dibutuhkan \n';
            }
            if(! $('#urutan').val()){
                errormessage += 'Urutan menu dibutuhkan \n';
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
                                            if(response.url){
                                                swal({
                                                    background  : 'transparent',
                                                    html        : '<pre>Url sudah ada ' + '<br>' + 
                                                                  'Harap gunakan url lain</pre>',
                                                    type        : "warning"
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
                url         : site + '/menu_admin',
                method      : 'get'
            },
            columns             : [
                {data   : 'DT_RowIndex',
                    render         : (data, type, row) => {
                        if(row.rel == '0'){
                            return row.urutan;
                        }else{
                            return '';
                        }
                    }
                },
                {data   : 'menu'},
                {data   : 'urutan',
                    render         : (data, type, row) => {
                        if(row.rel == '0'){
                            return '';
                        }else{
                            return row.urutan;
                        }
                    }
                },
                {data   : 'url',
                    render         : (data, type, row) => {
                        return '<a href="' + site + '/' + row.url + '" target="_blank">' + row.url + '</a>';
                    }
                },
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