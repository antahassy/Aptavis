$(document).ready(function(){
    login_process();
    $.ajaxSetup({
        headers 	: {
            'X-CSRF-TOKEN' 	: $('meta[name="csrf-token"]').attr('content')
        }
    });
    function login_process(){
        $('#kt_login_signin_form').attr('method', 'post');
        $('#_method').val('post');
        $('#kt_login_signin_form').attr('action', site + '/admin/login');
        $('#kt_login_signin_submit').on('click', function(event){
            event.preventDefault();
            event.stopImmediatePropagation();
            var ajax_method		= $('#kt_login_signin_form').attr('method');
            var ajax_url   		= $('#kt_login_signin_form').attr('action');
            var form_data       = $('#kt_login_signin_form')[0];
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
});