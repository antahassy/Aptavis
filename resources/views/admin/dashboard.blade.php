@extends('admin_layout/index')
@section('content')
<?php
	$sess_id = Session::get('admin.id');
	$session = DB::table('tb_admin')->where('id', $sess_id)->first();
	$id_group = DB::table('tb_admin_group_2')->where('id_admin', $sess_id)->first()->id_group;
	$level_group = DB::table('tb_admin_group')->where('id', $id_group)->first();
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
			</div>
		</div>
	</div>
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="row" style="min-height: 68vh;">
				<div class="col-lg-12 col-xxl-4 order-1 order-xxl-2">
					<div class="card card-custom card-stretch gutter-b">
						<div class="card-body pt-10">
							Hello <span style="font-weight: 800;">{{ $session->username }}</span>, welcome
							<br>
							Your access level as <span style="font-weight: 800;">{{ $level_group->description }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection