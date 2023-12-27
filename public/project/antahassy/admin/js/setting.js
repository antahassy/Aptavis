$(document).ready(function(){
    function new_relationship(){
        const relationship = new Promise(function(resolve, reject){
            const reason = true;
            if(reason){
                resolve('my self');
            }else{
                reject('my job & my money');
            }
        });
        relationship.then(function(result){
            console.log(
                "do you want to know " + result + " ?"
            );
        }).catch(function(result){
            console.log(
                "don't know me if you're reason is " + result
            );
        });
        console.log(relationship);
    };
    new_relationship();
    update_setting();
    display_icon();
    display_icon_text();

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

    function update_setting(){
        $('#btn_process').on('click', function(){
            var form_data       = $('#form_data')[0];
            form_data           = new FormData(form_data);
            swal({
                showConfirmButton   : false,
                allowOutsideClick   : false,
                allowEscapeKey      : false,
                background          : 'transparent',
                onOpen  : function(){
                    swal.showLoading();
                    setTimeout(function(){
                        $.ajax({
                            type            : 'ajax',
                            method          : 'post',
                            data            : form_data,
                            url             : site + '/setting_admin',
                            dataType        : "json",
                            processData     : false,
                            contentType     : false,
                            cache           : false,
                            async           : true,
                            success: function(response){
                                if(response.success){
                                    swal({
                                        background  : 'transparent',
                                        html        : '<pre>Setting updated successfully</pre>',
                                        type        : "success"
                                    }).then(function(){
                                        location.reload(true);
                                    });
                                }else{
                                    for (var i = 0; i < response.inputerror.length; i++){
                                        $('[name="'+response.inputerror[i]+'"]').parent().addClass('has-error');
                                        $('[name="'+response.inputerror[i]+'"]').next().text(response.error_string[i]);
                                    }
                                }
                            },
                            error: function (){
                                swal({
                                    background  : 'transparent',
                                    html        : '<pre>Connection lost' + '<br>' + 
                                                  'Please try again</pre>',
                                    type        : "warning"
                                });
                            }
                        });
                    },500);
                }
            });
        });
    }
    function display_icon(){
        function preview(image){
            if(image.files[0].size > 3000000){
                swal({
                    background  : 'transparent',
                    html        : '<pre>Ukuran gambar maksimal' + '<br>' + 
                                  '3 mb</pre>',
                    type        : "warning"
                });
                $("#image").val('');
            }else{
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
        }
        $("#image").on('change', function(){
            preview(this);
            var names = $(this).val();
            var file_names = names.replace(/^.*\\/, "");
        });
        $('#delete_preview_items').on('click', function(){
            $('#delete_preview_items').css('display','none');
            $('#preview_items').attr('src', '');
            $('#image, #get_image').val('');
        });
    }
    function display_icon_text(){
        function preview(image2){
            if(image2.files[0].size > 3000000){
                swal({
                    background  : 'transparent',
                    html        : '<pre>Ukuran gambar maksimal' + '<br>' + 
                                  '3 mb</pre>',
                    type        : "warning"
                });
                $("#image2").val('');
            }else{
                if(image2.files && image2.files[0]){
                    var reader      = new FileReader();
                    reader.onload   = function(event){
                        $('#preview_items2').attr('src', event.target.result);
                        $('#preview_items2').attr('title', image2.files[0].name);
                        $('#delete_preview_items2').css('display','block');
                    }
                    reader.readAsDataURL(image2.files[0]);
                }
            }
        }
        $("#image2").on('change', function(){
            preview(this);
            var names = $(this).val();
            var file_names = names.replace(/^.*\\/, "");
        });
        $('#delete_preview_items2').on('click', function(){
            $('#delete_preview_items2').css('display','none');
            $('#preview_items2').attr('src', '');
            $('#image2, #get_image2').val('');
        });
    }
});