@extends('admin_layout/index')
@section('content')
<style>
    .thead-dark tr th{
        color: #fff !important;
    }
    form label{
        margin-top: 5px;
        font-weight: 600 !important;
    }
</style>
<?php
    $meta = DB::table('tb_admin_setting')->get();
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <?php
					if(in_array('2', $akses_menu)){
						echo '<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">' . $active_menu . '</h5>';
						echo '<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>';
						echo '<a href="#" class="btn btn-light-success font-weight-bolder btn-sm" id="btn_add">Tambah Data</a>';
					}else{
						echo '<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">' . $active_menu . '</h5>';
					}
				?>
            </div>
            <div class="d-flex align-items-center">
                <!-- <a href="#" id="d_daily" class="btn btn-clean btn-sm font-weight-bold font-size-base mr-1">Daily</a>
                <a href="#" id="d_monthly" class="btn btn-clean btn-sm font-weight-bold font-size-base mr-1">Monthly</a>
                <a href="#" id="d_yearly" class="btn btn-clean btn-sm font-weight-bold font-size-base mr-1">Yearly</a>
                <a href="#" class="btn btn-sm btn-light font-weight-bold mr-2" id="kt_dashboard_daterangepicker" data-toggle="tooltip" title="Select Daterange" data-placement="left">
                    <span class="text-muted font-size-base font-weight-bold mr-2" id="kt_dashboard_daterangepicker_title"></span>
                    <span class="text-primary font-size-base font-weight-bolder" id="kt_dashboard_daterangepicker_date"></span>
                </a> -->
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row" style="min-height: 68vh;">
                <div class="col-lg-12 col-xxl-4 order-1 order-xxl-2">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-dark">Daftar {{ $active_menu }}</h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="card-body pt-0">
                                <form id="form_data">
                                    <input type="hidden" name="_method" id="_method">
                                    <div id="list_form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php echo $meta[0]->meta_data ?></label>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom: 5px;">
                                                <input name="<?php echo $meta[0]->meta_data ?>" type="text" class="form-control" id="<?php echo $meta[0]->meta_data ?>" value="<?php echo $meta[0]->value ?>">
                                                <span class="help-block"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label><?php echo $meta[1]->meta_data ?></label>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom: 5px;">
                                                <input name="<?php echo $meta[1]->meta_data ?>" type="text" class="form-control" id="<?php echo $meta[1]->meta_data ?>" value="<?php echo $meta[1]->value ?>">
                                                <span class="help-block"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label><?php echo $meta[2]->meta_data ?></label>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom: 5px;">
                                                <textarea name="<?php echo $meta[2]->meta_data ?>" id="<?php echo $meta[2]->meta_data ?>" class="form-control" cols="30" rows="5"><?php echo $meta[2]->value ?></textarea>
                                                <span class="help-block"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label><?php echo $meta[5]->meta_data ?></label>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom: 5px;">
                                                <input name="<?php echo $meta[5]->meta_data ?>" type="text" class="form-control" id="<?php echo $meta[5]->meta_data ?>" value="<?php echo $meta[5]->value ?>">
                                                <span class="help-block"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label><?php echo $meta[3]->meta_data ?></label>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom: 5px;">
                                                <input type="hidden" name="delete_image" id="delete_image" value="<?php echo $meta[3]->value ?>">
                                                <input type="hidden" name="get_image" id="get_image" value="<?php echo $meta[3]->value ?>">
                                                <input type="file" name="image" id="image" accept="image/*" style="width: 100%;">
                                                <div>
                                                    <div id="delete_preview_items" style="display: block;">Hapus Icon</div>
                                                    <?php
                                                        if($meta[3]->value == ''){
                                                            $src_1 = "blank.png";
                                                        }else{
                                                            $src_1 = $meta[3]->value;
                                                        }
                                                    ?>
                                                    <img id="preview_items" src={{ asset("project/image/" . $src_1 . "?t=").mt_rand() }}>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label><?php echo $meta[4]->meta_data ?></label>
                                            </div>
                                            <div class="col-md-6" style="margin-bottom: 5px;">
                                                <input type="hidden" name="delete_image2" id="delete_image2" value="<?php echo $meta[4]->value ?>">
                                                <input type="hidden" name="get_image2" id="get_image2" value="<?php echo $meta[4]->value ?>">
                                                <input type="file" name="image2" id="image2" accept="image/*" style="width: 100%;">
                                                <div>
                                                    <div id="delete_preview_items2" style="display: block;">Hapus Icon</div>
                                                    <?php
                                                        if($meta[4]->value == ''){
                                                            $src_2 = "blank.png";
                                                        }else{
                                                            $src_2 = $meta[4]->value;
                                                        }
                                                    ?>
                                                    <img id="preview_items2" src={{ asset("project/image/" . $src_2 . "?t=").mt_rand() }}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center" style="margin-top: 25px;">
                                        <?php 
                                            if(in_array('3', $akses_menu)){
                                                echo '<button type="button" id="btn_process" class="btn btn-light-success font-weight-bolder btn-sm">Update</button>';
                                            }
                                        ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var hak_akses = {{ json_encode($akses_menu) }};
</script>
<script src="{{ asset('project/antahassy/admin/js/setting.js?t=').mt_rand() }}"></script>
@endsection