$(document).ready(function(){
    $.ajaxSetup({
        headers 	: {
            'X-CSRF-TOKEN' 	: $('meta[name="csrf-token"]').attr('content')
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
                level_grup();
            },500);
        }
    });
    function level_grup(){
        $.ajax({
            type        : 'ajax',
            method      : 'get',
            url         : site + '/group_admin',
            dataType    : "json",
            async       : true,
            success: function(data){
                var s_level = '<option value="">Pilih Level</option>';
                for(i = 0; i < data.length; i ++){
                    s_level += '<option value="' + data[i].id + '">' + data[i].description + '</option>';
                }
                $('#s_level').html(s_level);
                setTimeout(function(){
                    data_table();
                },500);
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
            $('#form_data')[0].reset();
            $('#modal_form').find('.modal-title').text('Tambah');
            $('#btn_process').text('Simpan');
            $('#form_data').attr('method', 'post');
            $('#_method').val('post');
            $('#form_data').attr('action', site + '/list_admin');
            $('#username').attr('readonly', false).css({'background':'transparent','color':'#3F4254'});
            $('#password').attr('placeholder', '');
            $('#delete_preview_items').css('display','none');
            $('#preview_items').attr('src', '');
            $('#berkas, #get_berkas, #delete_berkas').val('');
            $('#l_password span').show();
            $('#modal_form').modal('show');
            display_image();
            data_process();
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
                            url            : site + '/list_admin/' + action_data.id + '/edit',
                            async          : true,
                            dataType       : 'json',
                            success        : function(data){
                                $('#form_data')[0].reset();
                                $('#username').val(data.username).attr('readonly', true).css({'background':'#3F4254','color':'#fff'});
                                $('#password').attr('placeholder', 'Kosongkan Jika Tidak Diganti');
                                $('#nama').val(data.nama);
                                $('#telepon').val(data.phone);
                                $('#email').val(data.email);
                                $('#s_level').val(data.level);

                                if(! data.image){
                                    $('#get_berkas, #delete_berkas').val('');
                                    $('#preview_items').attr('src', site + '/metronic/media/users/blank.png');
                                    $('#delete_preview_items').hide();
                                }else{
                                    $('#get_berkas, #delete_berkas').val(data.image);
                                    $('#preview_items').attr('src', site + '/project/admin/image/' + data.image);
                                    $('#delete_preview_items').show();
                                }
                                $('#berkas').val('');
                                display_image(); 
                                $('#l_password span').hide();

                                $('#modal_form').find('.modal-title').text('Edit');
                                $('#btn_process').text('Update');
                                $('#form_data').attr('method', 'post');
                                $('#_method').val('put');
                                $('#form_data').attr('action', site + '/list_admin/' + data.id);
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
        $('#table_data').on('click', '#btn_activated', function(){
            var id = $(this).attr('data');
            var activ = $(this).attr('alt');
            var question = '', link_url = '';
            if(activ == 0){
                question = 'Aktifkan ?';
                link_url = site + '/list_admin/aktifkan';
            }else{
                question = 'Non Aktifkan ?';
                link_url = site + '/list_admin/non_aktifkan';
            }
            swal({
                html                : '<pre>' + question + '</pre>',
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
                                    data        : {id : id},
                                    url         : link_url,
                                    dataType    : "json",
                                    async       : true,
                                    success: function(response){
                                        if(response.success){
                                            swal.close();
                                            setTimeout(function(){
                                                table_data.ajax.reload();
                                            },500);
                                        }
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
                            },500);
                        }
                    });
                }
            });
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
                                    url         : site + '/list_admin/hapus',
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
    function display_image(){
        function preview(image){
            if(image.files && image.files[0]){
                var reader      = new FileReader();
                reader.onload   = function(event){
                    $('#preview_items').attr('src', event.target.result);
                    $('#preview_items').attr('title', image.files[0].name);
                    $('#delete_preview_items').css('display','block');
                }
                reader.readAsDataURL(image.files[0]);
            }
        }
        $("#berkas").on('change', function(){
            preview(this);
            var names = $(this).val();
            var file_names = names.replace(/^.*\\/, "");
        });
        $('#delete_preview_items').on('click', function(){
            $('#delete_preview_items').css('display','none');
            $('#preview_items').attr('src', '');
            $('#berkas, #get_berkas').val('');
        });
    }
    function data_process(){
        $('#btn_process').on('click', function(event){
            event.preventDefault();
            event.stopImmediatePropagation();
            var ajax_method		= $('#form_data').attr('method');
            var ajax_url   		= $('#form_data').attr('action');
            var form_data       = $('#form_data')[0];
            form_data       	= new FormData(form_data);
            var errormessage    = '';
            if(! $('#username').val()){
                 errormessage += 'Username dibutuhkan \n';
            }
            if(ajax_url == site + '/list_admin'){
                if(! $('#password').val()){
                    errormessage += 'Password dibutuhkan \n';
                }
            }
            if(! $('#nama').val()){
                errormessage += 'Nama dibutuhkan \n';
            }
            if(! $('#s_level').val()){
                errormessage += 'Level dibutuhkan \n';
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
                                            if(response.account){
                                                swal({
                                                    background  : 'transparent',
                                                    html        : '<pre>Username sudah ada ' + '<br>' + 
                                                                  'Harap gunakan username lain</pre>',
                                                    type        : "warning"
                                                });
                                            }
                                            if(response.size){
                                                swal({
                                                    html                : '<pre>Ukuran file terlalu tinggi' + '<br>' + 
                                                                          'Maks 5 mb</pre>',
                                                    type                : "warning",
                                                    background          : 'transparent'
                                                });
                                            }
                                            if(response.extension){
                                                swal({
                                                    html                : '<pre>Ekstensi file tidak sesuai</pre>',
                                                    type                : "warning",
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
    function data_table(){
        table_data = $('#table_data').DataTable({
            lengthMenu      	: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
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
                   url         : site + '/list_admin',
                   method      : 'get'
               },
               columns 			: [
                   {data   : 'DT_RowIndex'},
                   {data 	: 'username'},
                   {data 	: 'level'},
                   {data 	: 'nama'},
                   {
                       data           : 'active',
                        render         : (data, type, row) => {
                            if(row.active == '0'){
                                if(hak_akses.includes(3)){
                                    return '<button id="btn_activated" data="' + row.id + '" alt="' + row.active + '" class="btn btn-sm btn-rounded btn-outline-danger">Non Aktif</button>';
                                }else{
                                    return 'Non Aktif';
                                }
                            }else{
                                if(hak_akses.includes(3)){
                                    return '<button id="btn_activated" data="' + row.id + '" alt="' + row.active + '" class="btn btn-sm btn-rounded btn-outline-primary">Aktif</button>';
                                }else{
                                    return 'Aktif';
                                }
                                
                            }
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