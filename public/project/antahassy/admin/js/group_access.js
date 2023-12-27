$(document).ready(function(){
    var arr_akses = [];
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
                akses_menu();
            },500);
        }
    });
    function akses_menu(){
        $.ajax({
            type        : 'ajax',
            method      : 'get',
            url         : site + '/group_admin/akses/' + id_group,
            dataType    : "json",
            async       : false,
            success: function(data){
                for(i = 0; i < data.length; i ++){
                    var tbody_data =
                    '<tr>' +
                        '<td style="text-align: center;">' + data[i].urutan + '</td>' +
                        '<td>' + data[i].menu + '</td>' +
                        '<td style="text-align: center;">' +
                            '<label class="checkbox checkbox-success">' +
                            '<input type="checkbox" class="input_checkbox" name="' + data[i].id + '_1" id="' + data[i].id + '_1" />' +
                            '<span style="border: 2px solid #1bc5bd; border-radius: 0;"></span></label>' +
                        '</td>' +
                        '<td style="text-align: center;">' +
                            '<label class="checkbox checkbox-success">' +
                            '<input type="checkbox" class="input_checkbox" name="' + data[i].id + '_2" id="' + data[i].id + '_2" />' +
                            '<span style="border: 2px solid #1bc5bd; border-radius: 0;"></span></label>' +
                        '</td>' +
                        '<td style="text-align: center;">' +
                            '<label class="checkbox checkbox-success">' +
                            '<input type="checkbox" class="input_checkbox" name="' + data[i].id + '_3" id="' + data[i].id + '_3" />' +
                            '<span style="border: 2px solid #1bc5bd; border-radius: 0;"></span></label>' +
                        '</td>' +
                        '<td style="text-align: center;">' +
                            '<label class="checkbox checkbox-success">' +
                            '<input type="checkbox" class="input_checkbox" name="' + data[i].id + '_4" id="' + data[i].id + '_4" />' +
                            '<span style="border: 2px solid #1bc5bd; border-radius: 0;"></span></label>' +
                        '</td>';
                    '</tr>';
                    $('#tbody_data').append(tbody_data);
                    var list_akses = [];
                    for(x = 0; x < data[i].akses.length; x ++){
                        if(data[i].akses[x] == 0){
                            $('#' + data[i].id + '_' + (x + 1)).prop('checked', false);
                        }else{
                            $('#' + data[i].id + '_' + (x + 1)).prop('checked', true);
                        }
                        list_akses.push(data[i].akses[x]);
                    }
                    arr_akses.push({
                        id_menu : data[i].id,
                        akses   : list_akses
                    });
                    $.ajax({
                        type        : 'ajax',
                        method      : 'get',
                        url         : site + '/group_admin/sub_akses/' + id_group + '/' + data[i].id,
                        dataType    : "json",
                        async       : false,
                        success: function(sub_data){
                            if(sub_data.length != 0){
                                for(j = 0; j < sub_data.length; j ++){
                                    var sub_tbody_data =
                                    '<tr>' +
                                        '<td style="text-align: center;"></td>' +
                                        '<td style="padding-left: 50px;">' + sub_data[j].menu + '</td>' +
                                        '<td style="text-align: center;">' +
                                            '<label class="checkbox checkbox-success">' +
                                            '<input type="checkbox" class="input_checkbox" name="' + sub_data[j].id + '_1" id="' + sub_data[j].id + '_1" />' +
                                            '<span style="border: 2px solid #1bc5bd; border-radius: 0;"></span></label>' +
                                        '</td>' +
                                        '<td style="text-align: center;">' +
                                            '<label class="checkbox checkbox-success">' +
                                            '<input type="checkbox" class="input_checkbox" name="' + sub_data[j].id + '_2" id="' + sub_data[j].id + '_2" />' +
                                            '<span style="border: 2px solid #1bc5bd; border-radius: 0;"></span></label>' +
                                        '</td>' +
                                        '<td style="text-align: center;">' +
                                            '<label class="checkbox checkbox-success">' +
                                            '<input type="checkbox" class="input_checkbox" name="' + sub_data[j].id + '_3" id="' + sub_data[j].id + '_3" />' +
                                            '<span style="border: 2px solid #1bc5bd; border-radius: 0;"></span></label>' +
                                        '</td>' +
                                        '<td style="text-align: center;">' +
                                            '<label class="checkbox checkbox-success">' +
                                            '<input type="checkbox" class="input_checkbox" name="' + sub_data[j].id + '_4" id="' + sub_data[j].id + '_4" />' +
                                            '<span style="border: 2px solid #1bc5bd; border-radius: 0;"></span></label>' +
                                        '</td>';
                                    '</tr>';
                                    $('#tbody_data').append(sub_tbody_data);
                                    var sub_list_akses = [];
                                    for(k = 0; k < sub_data[j].akses.length; k ++){
                                        if(sub_data[j].akses[k] == 0){
                                            $('#' + sub_data[j].id + '_' + (k + 1)).prop('checked', false);
                                        }else{
                                            $('#' + sub_data[j].id + '_' + (k + 1)).prop('checked', true);
                                        }
                                        sub_list_akses.push(sub_data[j].akses[k]);
                                    }
                                    arr_akses.push({
                                        id_menu : sub_data[j].id,
                                        akses   : sub_list_akses
                                    });
                                }
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
                }
                setTimeout(function(){
                    table_data = $('#table_data').DataTable({
                        lengthMenu          : [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
                        destroy             : true,
                        scrollX             : true,
                        scrollCollapse      : true,
                        fixedColumns        : true,
                        paging              : false,
                        info                : false,
                        ordering            : false
                    });
                    swal.close();
                    $('#btn_process').show();
                    update_akses();
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
    function update_akses(){
        $('#tbody_data').on('click', '.input_checkbox', function(){
            var id_menu = $(this).attr('id').split('_')[0];
            var id_akses = Number($(this).attr('id').split('_')[1]);
            if($(this).is(':checked')){
                arr_akses.filter(function(item){
                    if(item.id_menu == Number(id_menu)){
                        item.akses[id_akses - 1] = id_akses;
                    } 
                });
            }else{
                arr_akses.filter(function(item){
                    if(item.id_menu == Number(id_menu)){
                        item.akses[id_akses - 1] = 0;
                    } 
                });
            }
        });
        $('#btn_process').on('click', function(){
            swal({
                html                : '<pre>Update ' + active_menu + ' ?</pre>',
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
                                    data        : {
                                        data        : arr_akses,
                                        id_group    : id_group
                                    },
                                    url         : site + '/group_admin/update_akses',
                                    dataType    : "json",
                                    async       : true,
                                    success: function(response){
                                        if(response.success){
                                            swal({
                                                background  : 'transparent',
                                                html        : '<pre>' + active_menu + ' berhasil diupdate</pre>',
                                                type        : "success"
                                            }).then(function(){
                                                location.reload(true);
                                            });
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
    }
});