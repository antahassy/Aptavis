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
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ $active_menu }}</h5>
                <!-- <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <span class="text-muted font-weight-bold mr-4">#XRS-45670</span>
                <button class="btn btn-light-success font-weight-bolder btn-sm" id="btn_add">Tambah Data</button> -->
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
                            <h3 class="card-title font-weight-bolder text-dark">Menu {{ $active_menu }}</h3>
                        </div>
                        <div class="card-body pt-0">
                            <a href="{{ url('/group_admin') }}" class="btn btn-light-primary btn-sm btn-rounded"></i> Kembali</a>
                            <div></div>
                            <br>
                            <table id="table_data" class="table table-striped table-vcenter" style="width: 100%;">
                                <thead class="thead-dark">
                                    <tr> 
                                        <th width="7.5%" rowspan="2" style="vertical-align: middle; text-align: center;">No</th>
                                        <th rowspan="2" style="vertical-align: middle;">Menu</th>
                                        <th colspan="4" style="text-align: center;">Akses</th>
                                    </tr>
                                    <tr>
                                        <th width="7.5%">Lihat</th>
                                        <th width="7.5%">Tambah</th>
                                        <th width="7.5%">Edit</th>
                                        <th width="7.5%">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_data">
                                    
                                </tbody>
                            </table>
                            <center>
                                <button type="button" class="btn btn-light-success btn-sm btn-rounded" id="btn_process" style="display: none;">Update</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var id_group = '{{ $id_group }}';
    var active_menu = '{{ $active_menu }}';
</script>
<script src="{{ asset('project/antahassy/admin/js/group_access.js?t=').mt_rand() }}"></script>
@endsection