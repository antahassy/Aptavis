<?php
    $meta = DB::table('tb_admin_setting')->get();
?>
<!DOCTYPE html>
<!--Antahassy Wibawa-->
<html lang="en">
	<head><base href="../../../../">
		<title>Daftar - {{ $meta[1]->value }}</title>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	    <meta name="description" content="{{ $meta[2]->value }}">
	    <meta name="keywords" content="">
	    <meta name="googlebot-news" content="index,follow">
	    <meta name="googlebot" content="index,follow">
	    <meta name="author" content="Antahassy Wibawa">
	    <meta name="robots" content="index,follow">
	    <meta name="language" content="id">
	    <meta name="Classification" content="Job Test">
	    <meta name="geo.country" content="Indonesia">
	    <meta name="geo.placename" content="Indonesia"> 
	    <meta name="geo.position" content="-6.5899176; 106.8230479">
	    <meta name="csrf-token" content="{{ csrf_token() }}">
	    <meta http-equiv="content-language" content="In-Id">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <meta http-equiv="Pragma" content="no-cache">
	    <meta http-equiv="Cache-Control" content="no-cache">
	    <meta http-equiv="Copyright" content="{{ $meta[1]->value }}">
	    <meta property="og:title" content="{{ $meta[1]->value }}">
	    <meta property="og:url" content="{{ $meta[0]->value }}">
	    <meta property="og:type" content="Job Test">
	    <meta property="og:site_name" content="{{ $meta[1]->value }}">
	    <meta itemprop="name" content="{{ $meta[1]->value }}">

		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<link href="{{ asset('google/font.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('metronic/css/login-2.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/plugins.bundle.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/prismjs.bundle.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/style.bundle.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/layout/base/light.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/layout/menu/light.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/layout/brand/dark.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/layout/aside/dark.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="{{ asset('project/image/' . $meta[3]->value . '?t=').mt_rand() }}" />

		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<script src="{{ asset('metronic/js/plugins.bundle.js?t=').mt_rand() }}"></script>
		<script src="{{ asset('metronic/js/prismjs.bundle.js?t=').mt_rand() }}"></script>
		<script src="{{ asset('metronic/js/scripts.bundle.js?t=').mt_rand() }}"></script>

		<link rel="stylesheet" href="{{ asset('project/css/antahassy.css?t=').mt_rand() }}">
		<link rel="stylesheet" href="{{ asset('project/css/animation.css?t=').mt_rand() }}">
	    <link rel="stylesheet" href="{{ asset('project/css/dataTables.bootstrap4.css?t=').mt_rand() }}">
	    <link rel="stylesheet" href="{{ asset('project/css/buttons.bootstrap4.min.css?t=').mt_rand() }}">
	    <link rel="stylesheet" href="{{ asset('project/css/dataTables.buttons.min.css?t=').mt_rand() }}">
	    <link rel="stylesheet" href="{{ asset('project/css/jquery-ui.min.css?t=').mt_rand() }}">
	    <link rel="stylesheet" href="{{ asset('project/css/sweetalert2.min.css?t=').mt_rand() }}">

	    <script src="{{ asset('project/js/jquery.dataTables.min.js?t=').mt_rand() }}"></script>
	    <script src="{{ asset('project/js/dataTables.bootstrap4.min.js?t=').mt_rand() }}"></script>
	    <script src="{{ asset('project/js/dataTables.buttons.min.js?t=').mt_rand() }}"></script>
	    <script src="{{ asset('project/js/buttons.print.min.js?t=').mt_rand() }}"></script>
	    <script src="{{ asset('project/js/buttons.html5.min.js?t=').mt_rand() }}"></script>
	    <script src="{{ asset('project/js/buttons.flash.min.js?t=').mt_rand() }}"></script>
	    <script src="{{ asset('project/js/buttons.colVis.min.js?t=').mt_rand() }}"></script>
	    <script src="{{ asset('project/js/be_tables_datatables.min.js?t=').mt_rand() }}"></script>
	    <script src="{{ asset('project/js/zip.min.js?t=').mt_rand() }}"></script>
	    <script src="{{ asset('project/js/pdfmake.min.js?t=').mt_rand() }}"></script>
	    <script src="{{ asset('project/js/vfs_fonts.js?t=').mt_rand() }}"></script>
	    <script src="{{ asset('project/js/jquery-ui.min.js?t=').mt_rand() }}"></script>
	    <script src="{{ asset('project/js/sweetalert2.all.min.js?t=').mt_rand() }}"></script>
	</head>
	<style>
		body.swal2-height-auto {
    		height: 100vh !important;
		}
	</style>
	<script>
		var site = "{{ url('/') }}";
	</script>
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
        <div class="d-flex flex-column flex-root">
            <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
                <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid" style="background-image: url('{{ asset("project/image/car.jpg?t=").mt_rand() }}');">
                	<div class="row" style="width: 90%; margin: 0 5%;">
                		<div class="col-md-8" style="color: #fff; text-align: left;">
                			<div style="text-transform: uppercase; font-size: 25px;">Sewa Mobil Online</div>
                			<div style="font-size: 50px; font-weight: 800;">Sewa Mobil Dimanapun Kapanpun</div>
                		</div>
                		<div class="col-md-4">
                			<div class="mb-10" style="color: #fff; text-transform: uppercase; font-size: 25px; margin-top: 10px;">
                        		<center>
                        			<u><h3>Pendaftaran</h3></u>
                        		</center>
	                        </div>
	                        <div class="login-signin">
	                            <form id="form_data">
                                    <div class="form-group" style="margin-bottom: .75rem;">
	                                    <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="Username" name="username" id="username" style="background-color: rgba(0,0,0,0.75) !important; color: #fff !important;">
	                                </div>
                                    <div class="form-group" style="margin-bottom: .75rem;">
	                                    <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="password" placeholder="Password" name="password" id="password" style="background-color: rgba(0,0,0,0.75) !important; color: #fff !important;">
	                                </div>
	                                <div class="form-group" style="margin-bottom: .75rem;">
	                                    <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="Nama" name="nama" id="nama" style="background-color: rgba(0,0,0,0.75) !important; color: #fff !important;">
	                                </div>
                                    <div class="form-group" style="margin-bottom: .75rem;">
                                        <textarea class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="Alamat" name="alamat" id="alamat" style="background-color: rgba(0,0,0,0.75) !important; color: #fff !important; border-radius: 25px !important;" cols="10" rows="4"></textarea>
	                                </div>
	                                <div class="form-group" style="margin-bottom: .75rem;">
	                                    <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="No. Handphone" name="telepon" id="telepon" style="background-color: rgba(0,0,0,0.75) !important; color: #fff !important;">
	                                </div>
	                                <div class="form-group" style="margin-bottom: .75rem;">
	                                    <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="No. SIM" name="sim" id="sim" style="background-color: rgba(0,0,0,0.75) !important; color: #fff !important;">
	                                </div>
	                                <div class="form-group text-center mt-10">
	                                    <button id="form_data_submit" type="submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3" style="font-weight: 800; font-size: 17px;">Daftar</button>
                                        <div style="font-weight: 800; color: #fff; margin-top: 10px;">Sudah punya akun ? Login <a href="#" id="btn_login">Disini</a></div>
	                                </div>
	                            </form>
	                        </div>
                		</div>
                	</div>
                </div>
            </div>
        </div>
		<div class="modal animated" id="modal_form" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"></h5>
					</div>
					<div class="modal-body"> 
						<form id="form_login">
							<input type="hidden" id="id_data" name="id_data">
							<input type="hidden" name="_method" id="_method">
							<div class="form-group">
								<div class="col-md-12">
									<label>Username<span style="color: red;">*</span></label>
									<input type="text" name="login_username" id="login_username" class="form-control">

									<label>Password<span style="color: red;">*</span></label>
									<input type="password" name="login_password" id="login_password" class="form-control">
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Tutup</button>
						<button type="button" class="btn btn-outline-primary" id="btn_process"></button>
					</div>
				</div>
			</div>
		</div>
        <script src="{{ asset('project/antahassy/admin/js/register.js?t=').mt_rand() }}"></script>
	</body>
</html>