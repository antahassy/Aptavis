$(document).ready(function(){
    logout_process();
    function logout_process(){
        $('#logout_btn').on('click', function(event){
            event.preventDefault();
            event.stopImmediatePropagation();
            swal({
                showConfirmButton   : false,
                allowOutsideClick   : false,
                allowEscapeKey      : false,
                background          : 'transparent',
                onOpen  : function(){
                    swal.showLoading();
                    setTimeout(function(){
                        location.href = site + '/admin_logout';
                    },500);
                }
            });
            return false;
        });
    }
});