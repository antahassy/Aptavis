$(document).ready(function(){
    $('#form_data')[0].reset();
    register_process();
    $.ajaxSetup({
        headers 	: {
            'X-CSRF-TOKEN' 	: $('meta[name="csrf-token"]').attr('content')
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
    $('#btn_login').on('click', function(){
        $('#form_login')[0].reset();
        $('#modal_form').find('.modal-title').text('Login');
        $('#btn_process').text('Login');
        $('#modal_form').modal('show');
        login_process();
    });
    function login_process(){
        $('#form_login').attr('method', 'post');
        $('#_method').val('post');
        $('#form_login').attr('action', site + '/admin/login');
        $('#btn_process').on('click', function(event){
            event.preventDefault();
            event.stopImmediatePropagation();
            var ajax_method		= $('#form_login').attr('method');
            var ajax_url   		= $('#form_login').attr('action');
            var form_data       = $('#form_login')[0];
            form_data       	= new FormData(form_data);
            var errormessage    = '';
            if(! $('#login_username').val()){
                 errormessage += 'Username dibutuhkan \n';
            }
            if(! $('#login_password').val()){
                 errormessage += 'Password dibutuhkan \n';
            }
            if(errormessage !== ''){
                swal({
                    background  : 'transparent',
                    html        : '<pre>' + errormessage + '</pre>'
                });
            }else{
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
                                    if(response.username){
                                        swal({
                                            background  : 'transparent',
                                            html        : '<pre>Akun tidak terdaftar</pre>'
                                        });
                                    }
                                    if(response.pass){
                                        swal({
                                            background  : 'transparent',
                                            html        : '<pre>Password tidak cocok</pre>'
                                        });
                                    }
                                    if(response.banned){
                                        swal({
                                            background  : 'transparent',
                                            html        : '<pre>Akun dinonaktifkan' + '<br>' + 'Harap hubungi administrator</pre>'
                                        });
                                    }
                                    if(response.success){
                                        setTimeout(function(){
                                            location.reload(true);
                                        },500);
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
            return false;
        });
    }
    function register_process(){
        $('#form_data').attr('method', 'post');
        $('#_method').val('post');
        $('#form_data').attr('action', site + '/');
        $('#form_data_submit').on('click', function(event){
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
            if(! $('#password').val()){
                errormessage += 'Password dibutuhkan \n';
            }
            if(! $('#nama').val()){
                 errormessage += 'Nama dibutuhkan \n';
            }
            if(! $('#alamat').val()){
                 errormessage += 'Alamat dibutuhkan \n';
            }
            if(! $('#telepon').val()){
                errormessage += 'No. Handphone dibutuhkan \n';
            }
            if(! $('#sim').val()){
                errormessage += 'No. SIM dibutuhkan \n';
            }
            if(errormessage !== ''){
                swal({
                    background  : 'transparent',
                    html        : '<pre>' + errormessage + '</pre>'
                });
            }else{
                swal({
                    html                : '<pre>Apakah data sudah benar ?</pre>',
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
                                            if(response.account){
                                                swal({
                                                    background  : 'transparent',
                                                    html        : '<pre>Username sudah ada' + '<br>' + 'Gunakan username lain</pre>'
                                                });
                                            }
                                            if(response.success){
                                                swal({
                                                    html                : '<pre>Pendaftaran berhasil</pre>',
                                                    type                : "success",
                                                    background          : 'transparent'
                                                }).then(function(){
                                                    setTimeout(function(){
                                                        location.reload(true);
                                                    },500);
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
});