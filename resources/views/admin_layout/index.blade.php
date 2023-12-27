<?php
	$meta = DB::table('tb_admin_setting')->get();
	$sess_id = Session::get('admin.id');
	$session = DB::table('tb_admin')->where('id', $sess_id)->first();
	$id_group = DB::table('tb_admin_group_2')->where('id_admin', $sess_id)->first()->id_group;
	$level_group = DB::table('tb_admin_group')->where('id', $id_group)->first();
?>
<!DOCTYPE html>
<!--Antahassy Wibawa-->
<html lang="en"> 
	<head><base href="">
		<title>{{ $active_menu }} - {{ $meta[1]->value }}</title>
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

	    <link rel="shortcut icon" href="{{ asset('project/image/' . $meta[3]->value . '?t=').mt_rand() }}" />

		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<link href="{{ asset('google/font.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/fullcalendar.bundle.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/plugins.bundle.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/prismjs.bundle.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/style.bundle.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/layout/base/light.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/layout/menu/light.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/layout/brand/dark.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/layout/aside/dark.css?t=').mt_rand() }}" rel="stylesheet" type="text/css" />

		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<script src="{{ asset('metronic/js/plugins.bundle.js?t=').mt_rand() }}"></script>
		<script src="{{ asset('metronic/js/prismjs.bundle.js?t=').mt_rand() }}"></script>
		<script src="{{ asset('metronic/js/scripts.bundle.js?t=').mt_rand() }}"></script>
		<script src="{{ asset('metronic/js/fullcalendar.bundle.js?t=').mt_rand() }}"></script>
		<script src="{{ asset('metronic/js/widgets.js?t=').mt_rand() }}"></script>

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
		#kt_chat_modal{
			top: 0;
		}
		#kt_chat_modal .card-body .scroll{
			height: 250px !important;
		}
		.brand, .header-mobile{
			background-color: #fff;
		}
	</style>
	<script>
		var site = "{{ url('/') }}";
	</script>
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
            <a href="{{ url('/dashboard') }}">
                <img alt="Logo" src="{{ asset('project/image/' . $meta[4]->value . '?t=').mt_rand() }}" style="width: 175px; height:50px;"/>
            </a>
            <div class="d-flex align-items-center">
                <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                    <span></span>
                </button>
                <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                    <span class="svg-icon svg-icon-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                    </span>
                </button>
            </div>
        </div>
        <div class="d-flex flex-column flex-root">
            <div class="d-flex flex-row flex-column-fluid page">
                <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
                    <div class="brand flex-column-auto" id="kt_brand">
                        <a href="{{ url('/dashboard') }}" class="brand-logo">
                            <img alt="Logo" src="{{ asset('project/image/' . $meta[4]->value . '?t=').mt_rand() }}" style="width: 175px; height:50px;"/>
                        </a>
                        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                            <span class="svg-icon svg-icon svg-icon-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                                        <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                                    </g>
                                </svg>
                            </span>
                        </button>
                    </div>
                    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
                            <ul class="menu-nav" style="padding: 0;">
                                <li class="menu-section" style="margin: 0;">
                                    <h4 class="menu-text">AKSES MENU</h4>
                                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                                </li>
                                <?php
									$menu = DB::table('tb_admin_rel_group')
										->orderBy('tb_admin_menu.urutan','asc')
										->select('tb_admin_menu.id', 'tb_admin_menu.menu', 'tb_admin_menu.url', 'tb_admin_menu.rel')
										->where('tb_admin_rel_group.id_group', $id_group)
										->where('tb_admin_rel_group.akses', '1')
										->where('tb_admin_rel_group.deleted_at', null)
										->where('tb_admin_menu.rel', '0')
										->where('tb_admin_menu.deleted_at', null)
										->join('tb_admin_menu', 'tb_admin_rel_group.id_menu', '=', 'tb_admin_menu.id')
										->get();
									$arr_id = array();
                                    foreach ($menu as $r_menu) {
                                        array_push($arr_id, $r_menu->id);
                                    }
                                    foreach ($menu as $row_menu) {
                                        $id = $row_menu->id;
                                        $sub_menu = DB::table('tb_admin_rel_group')
                                        ->orderBy('tb_admin_menu.urutan','asc')
										->select('tb_admin_menu.id', 'tb_admin_menu.menu', 'tb_admin_menu.url', 'tb_admin_menu.rel')
										->where('tb_admin_rel_group.id_group', $id_group)
										->where('tb_admin_rel_group.akses', '1')
										->where('tb_admin_rel_group.deleted_at', null)
										->where('tb_admin_menu.rel', $id)
										->where('tb_admin_menu.deleted_at', null)
										->join('tb_admin_menu', 'tb_admin_rel_group.id_menu', '=', 'tb_admin_menu.id')
										->get();
                                        if(count($sub_menu) != 0){
                                            echo '<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">';
                                                echo '<a href="javascript:;" class="menu-link menu-toggle">';
                                                    echo '<span class="svg-icon menu-icon">';
                                                        echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">';
                                                            echo '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">';
                                                                echo '<rect x="0" y="0" width="24" height="24" />';
                                                                echo '<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />';
                                                                echo '<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />';
                                                            echo '</g>';
                                                        echo '</svg>';
                                                    echo '</span>';
                                                    echo '<span class="menu-text">' . $row_menu->menu . '</span>';
                                                    echo '<i class="menu-arrow"></i>';
                                                echo '</a>';
                                                echo '<div class="menu-submenu">';
                                                    echo '<i class="menu-arrow"></i>';
                                                    echo '<ul class="menu-subnav">';
                                                        echo '<li class="menu-item menu-item-parent" aria-haspopup="true">';
                                                            echo '<span class="menu-link">';
                                                                echo '<span class="menu-text">' . $row_menu->menu . '</span>';
                                                            echo '</span>';
                                                        echo '</li>';
                                                        foreach ($sub_menu as $row_submenu) {
                                                            echo '<li class="menu-item" aria-haspopup="true">';
                                                                echo '<a href="' . url('/' . $row_submenu->url) . '" class="menu-link">';
                                                                    echo '<i class="menu-bullet menu-bullet-dot">';
                                                                        echo '<span></span>';
                                                                    echo '</i>';
                                                                    echo '<span class="menu-text">' . $row_submenu->menu . '</span>';
                                                                echo '</a>';
                                                            echo '</li>';
                                                        }
                                                    echo '</ul>';
                                                echo '</div>';
                                            echo '</li>';
                                        }else{
                                            echo '<li class="menu-item" aria-haspopup="true">';
                                                echo '<a href="' . url('/' . $row_menu->url) . '" class="menu-link">';
                                                    echo '<span class="svg-icon menu-icon">';
                                                        echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">';
                                                            echo '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">';
                                                                echo '<rect x="0" y="0" width="24" height="24" />';
                                                                echo '<rect fill="#000000" opacity="0.3" x="4" y="5" width="16" height="6" rx="1.5" />';
                                                                echo '<rect fill="#000000" x="4" y="13" width="16" height="6" rx="1.5" />';
                                                            echo '</g>';
                                                        echo '</svg>';
                                                    echo '</span>';
                                                    echo '<span class="menu-text">' . $row_menu->menu . '</span>';
                                                echo '</a>';
                                            echo '</li>';
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    <div id="kt_header" class="header header-fixed">
                        <div class="container-fluid d-flex align-items-stretch justify-content-between">
                            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                            </div>
                            <div class="topbar">
                                <div class="topbar-item">
                                    <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                                        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ $session->username }}</span>
                                        <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                            <span class="symbol-label font-size-h5 font-weight-bold">{{ Str::substr($session->username, 0, 1) }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					@yield('content')
					<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between" style="justify-content: center !important;">
                            <div class="text-dark order-2 order-md-1 text-center">
                                <span class="text-muted font-weight-bold mr-2">
                                    Copyright &copy; 2023 - <script>document.write(new Date().getFullYear());</script> 
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
            <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
                <h3 class="font-weight-bold m-0">Profil
                <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close" style="position: absolute; right: 25px;">
                    <i class="ki ki-close icon-xs text-muted"></i>
                </a>
            </div>
            <div class="offcanvas-content pr-5 mr-n5">
                <div class="d-flex align-items-center mt-5">
                    <div class="symbol symbol-100 mr-5">
                    	@if ($session->image == '')
                    		<div class="symbol-label" style="background-image:url('{{ asset('metronic/media/users/blank.png?t=').mt_rand() }}')"></div>
                    	@else
                    		<div class="symbol-label" style="background-image:url('{{ asset('user/image/' . $session->image . '?t=').mt_rand() }}')"></div>
                    	@endif
                        <i class="symbol-badge bg-success"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ $session->nama }}</a>
                        @if ($level_group->deleted_at != '')
                        	<div class="text-muted mt-1">Level akses belum tersedia</div> 
                        @else
                        	<div class="text-muted mt-1">{{ $level_group->description }}</div> 
                        @endif
                        <div class="navi mt-2">
                            <a href="#" class="navi-item">
                                <span class="navi-link p-0 pb-2">
                                    <span class="navi-icon mr-1">
                                        <span class="svg-icon svg-icon-lg svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                                    <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                                </g>
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="navi-text text-muted text-hover-primary">{{ $session->email }}</span>
                                </span>
                            </a>
                            <a href="#" id="logout_btn" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Logout</a>
                        </div>
                    </div>
                </div>
                <!-- <div class="separator separator-dashed mt-8 mb-5"></div>
                <div class="navi navi-spacer-x-0 p-0">
                    <a href="#" class="navi-item">
                        <div class="navi-link">
                            <div class="symbol symbol-40 bg-light mr-3">
                                <div class="symbol-label">
                                    <span class="svg-icon svg-icon-md svg-icon-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
                                                <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="navi-text">
                                <div class="font-weight-bold">Profil</div>
                                <div class="text-muted">Pengaturan akun</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="navi-item">
                        <div class="navi-link">
                            <div class="symbol symbol-40 bg-light mr-3">
                                <div class="symbol-label">
                                    <span class="svg-icon svg-icon-md svg-icon-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5" />
                                                <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5" />
                                                <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero" />
                                                <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5" />
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="navi-text">
                                <div class="font-weight-bold">Pesan</div>
                                <div class="text-muted">Kotak masuk dan pesan</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="navi-item">
                        <div class="navi-link">
                            <div class="symbol symbol-40 bg-light mr-3">
                                <div class="symbol-label">
                                    <span class="svg-icon svg-icon-md svg-icon-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="navi-text">
                                <div class="font-weight-bold">Aktifitas</div>
                                <div class="text-muted">Catatan dan notifikasi</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="navi-item">
                        <div class="navi-link">
                            <div class="symbol symbol-40 bg-light mr-3">
                                <div class="symbol-label">
                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3" />
                                                <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000" />
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="navi-text">
                                <div class="font-weight-bold">Tugas</div>
                                <div class="text-muted">Tugas dan proyek</div>
                            </div>
                        </div>
                    </a>
                </div> -->
            </div>
        </div>
        <div id="kt_scrolltop" class="scrolltop">
            <span class="svg-icon">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                        <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
            </span>
        </div>
        <script src="{{ asset('project/antahassy/admin/js/logout.js?t=').mt_rand() }}"></script>
    </body>
</html>