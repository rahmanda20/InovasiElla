<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="{{ asset('images/favicon.ico') }}">
	<title>ELLA - Dashboard</title>

	<!-- CSS -->
	<link rel="stylesheet" href="{{ asset('css/vendors_css.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/skin_color.css') }}">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

	{{-- Stack untuk gaya kustom dari halaman lain --}}
   <style>
	html {
		font-size: 90%;
	}
	.dashboard-btn {
		width: 100%; /* Menggunakan seluruh lebar */
		padding: 15px;
		font-size: 18px;
		color: white;
		background-color: #0D92F4; /* Biru */
		border: none;
		border-radius: 5px;
		margin-bottom: 20px;
		text-align: center;
		transition: background-color 0.3s ease;
	}


	.modal-backdrop {
		background-color: rgba(0, 0, 0, 0.1) !important; /* Paksa transparansi lebih tinggi */
	}


	.knowledge-btn {
		width: 100%; /* Menggunakan seluruh lebar */
		padding: 15px;
		font-size: 18px;
		color: white;
		background-color: #e53935; /* Merah */
		border: none;
		border-radius: 5px;
		margin-bottom: 20px;
		text-align: center;
		transition: background-color 0.3s ease;
	}

	.compliance-box {
		background-position: right bottom;
		background-repeat: no-repeat;
		border-bottom: 2px solid #0056b3;
	}

	.menu-link {
		display: block;
		color: black;
		text-decoration: none;
		border-radius: 8px; /* Menambahkan sedikit kelengkungan pada sudut */
		margin-bottom: 4px; /* Jarak antar menu item */
	}

		.menu-link.active {
			background-color: #0D92F4;
			color: white !important;
			border-radius: 8px; /* Menambahkan kelengkungan yang sama pada menu yang aktif */
		}

			.menu-link.active i {
				color: white !important;
			}

		.menu-link i {
			color: black;
		}

	
	.main-sidebar {
		margin-top: 2vh !important;
		padding-top: 48px; /* jika ingin ada jarak sedikit dari atas */
		font-size: 0.9 rem;
	}


</style>
	@stack('styles')

</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

	<div class="wrapper">
		<div id="loader"></div>

		<header class="main-header bg-info">
			<div class="d-flex align-items-center logo-box justify-content-start">
				<img src="{{ asset('images/logo.jpg') }}" alt="logo" style="width: 140px; height: auto;">
				<div class="ml-3 text-container">
					<h4 class="mb-0" style="color: #000000; font-weight: 700; font-style: italic; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">
						Smart Letter
					</h4>
					<h5 style="color: #000000; margin-top: 5px; font-weight: 500; text-align: left; font-size: 1.1rem;">
						Inovasi ELLA
					</h5>

				</div>

			</div>

			<!-- Header Navbar -->
			<nav class="navbar navbar-static-top">

				<a href="#" class="waves-effect waves-light nav-link d-none d-md-inline-block mx-10 push-btn bg-transparent" data-toggle="push-menu" role="button">
					<i class="fas fa-bars text-white"></i>
				</a>


				<div class="app-menu">
					<ul class="header-megamenu nav">
						<li class="btn-group nav-item d-md-none">
							<a href="#" class="waves-effect waves-light nav-link push-btn" data-toggle="push-menu" role="button">
								<span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
							</a>
						</li>
					</ul>
				</div>

				<div class="navbar-custom-menu r-side">
					<ul class="nav navbar-nav ">
						<li class="btn-group nav-item d-lg-inline-flex d-none bg-transparent">
							<a href="#" data-provide="fullscreen" class="waves-effect nav-link full-screen bg-transparent" title="Full Screen">
								<i class="fas fa-expand-arrows-alt text-white"></i>
							</a>
						</li>


						<!-- Notifications -->

						<!-- User Account-->
						<li class="dropdown user user-menu">
							<a href="#" class="waves-effect bg-transparent dropdown-toggle" data-bs-toggle="dropdown" title="User">
								<i class="fas fa-user-circle text-white"></i>
							</a>

							<ul class="dropdown-menu animated flipInX">
								<li class="user-body">
									<a class="dropdown-item" href="#"><i class="ti-user text-muted me-2"></i> Profile</a>
									<a class="dropdown-item" href="#"><i class="ti-wallet text-muted me-2"></i> My Wallet</a>
									<a class="dropdown-item" href="#"><i class="ti-settings text-muted me-2"></i> Settings</a>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
										Logout
									</a>
									{{-- Menggunakan sintaks Blade yang benar untuk form logout --}}
									<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
										@csrf
									</form>
								</li>
							</ul>
						</li>

					</ul>
				</div>

			</nav>

		</header>

		<aside class="main-sidebar">
			<hr style="border: 1px solid black;">

			<section class="sidebar position-relative">
				<div class="multinav">
					<div class="multinav-scroll" style="height: 100%;">
						<!-- sidebar menu-->

						<ul class="sidebar-menu" data-widget="tree">
							
<li class="treeview {{ request()->routeIs('ProgramSDA') ? 'menu-open' : '' }}">
								<a href="#">
									<i class="fas fa-home"></i>
									<span>Beranda</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-right pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li>
										<a class="menu-link {{ request()->routeIs('ProgramSDA') ? 'active' : '' }}" href="{{ route('ProgramSDA') }}">
											<i class="fas fa-water"></i> Program SDA
										</a>
									</li>
									<li><a href="index2.html"><i class="fas fa-road"></i> Program Bina Marga</a></li>
									<li><a href="index3.html"><i class="fas fa-building"></i> Program Cipta Karya</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="fas fa-project-diagram"></i>
									<span>Perencanaan</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-right pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="/dokumen"><i class="fas fa-file-alt"></i> Dokumen Pengadaan</a></li>
									<li><a href="/perencanaan/dokumen-kontrak"><i class="fas fa-file-contract"></i> Dokumen Kontrak</a></li>
									<li><a href="/Rekapan"><i class="fas fa-clipboard-list"></i> Rekapan</a></li>
									
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="fas fa-tools"></i>
									<span>Konstruksi</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-right pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="/DokumenPengadaanKonstruksi"><i class="fas fa-file-alt"></i> Dokumen Pengadaan</a></li>
									<li><a href="/DokumenKontrakKonstruksi"><i class="fas fa-file-contract"></i> Dokumen Kontrak</a></li>
									<li><a href="/RekapanKonstruksi"><i class="fas fa-clipboard-list"></i> Rekapan</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="fas fa-search"></i>
									<span>Pengawasan</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-right pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="/DokumenPengadaanPengawasan"><i class="fas fa-file-alt"></i> Dokumen Pengadaan</a></li>
									<li><a href="/DokumenKontrakPengawasan"><i class="fas fa-file-contract"></i> Dokumen Kontrak</a></li>
									<li><a href="/RekapanPengawasan"><i class="fas fa-clipboard-list"></i> Rekapan</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="fas fa-box"></i>
									<span>Barang</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-right pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="ui_badges.html"><i class="fas fa-file-alt"></i> Dokumen Pengadaan</a></li>
									<li><a href="ui_border_utilities.html"><i class="fas fa-file-contract"></i> Dokumen Kontrak</a></li>
									<li><a href="ui_ribbons.html"><i class="fas fa-clipboard-list"></i> Rekapan</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="fas fa-file-invoice-dollar"></i>
									<span>Laporan Fiskeu</span>

								</a>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="fas fa-map"></i>
									<span>Map Jaringan</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-right pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="ecommerce_products.html"><i class="fas fa-water"></i> Sumber Daya Air</a></li>
									<li><a href="ecommerce_cart.html"><i class="fas fa-road"></i> Jalan</a></li>
									<li><a href="ecommerce_products_edit.html"><i class="fas fa-toilet"></i> Sanitasi</a></li>
									<li><a href="ecommerce_details.html"><i class="fas fa-dumpster"></i> Limbah</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="fas fa-gavel"></i>
									<span>Dasar Hukum</span>
								</a>
							</li>
                            <li>
                                <a class="menu-link {{ request()->routeIs('peninjauan.index') ? 'active' : '' }}" href="{{ route('peninjauan.index') }}">
                                    <i class="fas fa-clipboard-check"></i> {{-- Ganti dengan ikon pilihan --}}
                                    <span>Peninjauan</span>
                                </a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-comments"></i>
									<span>Tanggapan & Rekom</span>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-question-circle"></i>
									<span>Pertanyaan</span>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-address-book"></i>
									<span>Kontak Person</span>
								</a>
							</li>

						<li>
                            {{-- Mengarahkan ke template.dashboard karena template.index memerlukan parameter {jenis} --}}
                            <a class="menu-link {{ request()->routeIs('template.dashboard') || request()->routeIs('template.index') ? 'active' : '' }}" href="{{ route('template.dashboard') }}">
                                <i class="fas fa-file-alt"></i> {{-- Ikon dokumen/template --}}
                                <span>Template</span>
                            </a>
                        </li>

							
							<li>
							<a class="menu-link {{ request()->routeIs('master.index') ? 'active' : '' }}" href="{{ route('master.index') }}">
									<i class="fas fa-database"></i>
									<span>Master Data</span>
								</a>

							</li>

						</ul>
					</div>
				</div>
			</section>


		</aside>


		<!-- Konten utama -->
		<div class="content-wrapper" style="min-height: 100vh;  background: url(../images/hero-bg.png) top center no-repeat;">
			<div class="container-full">
				<section class="content">
					@yield('content')
				</section>

			</div>

			
		</div>



		<footer class="main-footer" style="text-align: center;">
			<div style="display: inline-block;">
				&copy; 2025 <a href="https://www.multipurposethemes.com/">ELLA - SmartLetter</a>.
			</div>
		</footer>

	</div>


	<div id="chat-box-body">
		<div id="chat-circle" class="waves-effect waves-circle btn btn-circle btn-lg btn-warning l-h-70">
			<div id="chat-overlay"></div>
			<span class="icon-Group-chat fs-30"><span class="path1"></span><span class="path2"></span></span>
		</div>
		<div class="chat-box">
			<div class="chat-box-header p-15 d-flex justify-content-between align-items-center">
				<div class="btn-group">
					<button class="waves-effect waves-circle btn btn-circle btn-primary-light h-40 w-40 rounded-circle l-h-45" type="button" data-bs-toggle="dropdown">
						<span class="icon-Add-user fs-22"><span class="path1"></span><span class="path2"></span></span>
					</button>
					<div class="dropdown-menu min-w-200">
						<a class="dropdown-item fs-16" href="#">
							<span class="icon-Color me-15"></span>
							New Group
						</a>
						<a class="dropdown-item fs-16" href="#">
							<span class="icon-Clipboard me-15"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
							Contacts
						</a>
						<a class="dropdown-item fs-16" href="#">
							<span class="icon-Group me-15"><span class="path1"></span><span class="path2"></span></span>
							Groups
						</a>
						<a class="dropdown-item fs-16" href="#">
							<span class="icon-Active-call me-15"><span class="path1"></span><span class="path2"></span></span>
							Calls
						</a>
						<a class="dropdown-item fs-16" href="#">
							<span class="icon-Settings1 me-15"><span class="path1"></span><span class="path2"></span></span>
							Settings
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item fs-16" href="#">
							<span class="icon-Question-circle me-15"><span class="path1"></span><span class="path2"></span></span>
							Help
						</a>
						<a class="dropdown-item fs-16" href="#">
							<span class="icon-Notifications me-15"><span class="path1"></span><span class="path2"></span></span>
							Privacy
						</a>
					</div>
				</div>
				<div class="text-center flex-grow-1">
					<div class="text-dark fs-18">Mayra Sibley</div>
					<div>
						<span class="badge badge-sm badge-dot badge-primary"></span>
						<span class="text-muted fs-12">Active</span>
					</div>
				</div>
				<div class="chat-box-toggle">
					<a id="chat-box-toggle" class="waves-effect waves-circle btn btn-circle btn-danger-light h-40 w-40 rounded-circle l-h-45" href="#">
						<span class="icon-Close fs-22"><span class="path1"></span><span class="path2"></span></span>
					</a>
				</div>
			</div>
			<div class="chat-box-body">
				<div class="chat-box-overlay">
				</div>
				<div class="chat-logs">
					<div class="chat-msg user">
						<div class="d-flex align-items-center">
							<span class="msg-avatar">
								<img src="../images/avatar/2.jpg" class="avatar avatar-lg">
							</span>
							<div class="mx-10">
								<a href="#" class="text-dark hover-primary fw-bold">Mayra Sibley</a>
								<p class="text-muted fs-12 mb-0">2 Hours</p>
							</div>
						</div>
						<div class="cm-msg-text">
							Hi there, I'm Jesse and you?
						</div>
					</div>
					<div class="chat-msg self">
						<div class="d-flex align-items-center justify-content-end">
							<div class="mx-10">
								<a href="#" class="text-dark hover-primary fw-bold">You</a>
								<p class="text-muted fs-12 mb-0">3 minutes</p>
							</div>
							<span class="msg-avatar">
								<img src="../images/avatar/3.jpg" class="avatar avatar-lg">
							</span>
						</div>
						<div class="cm-msg-text">
							My name is Anne Clarc.
						</div>
					</div>
					<div class="chat-msg user">
						<div class="d-flex align-items-center">
							<span class="msg-avatar">
								<img src="../images/avatar/2.jpg" class="avatar avatar-lg">
							</span>
							<div class="mx-10">
								<a href="#" class="text-dark hover-primary fw-bold">Mayra Sibley</a>
								<p class="text-muted fs-12 mb-0">40 seconds</p>
							</div>
						</div>
						<div class="cm-msg-text">
							Nice to meet you Anne.<br>How can i help you?
						</div>
					</div>
				</div>
			</div>
			<div class="chat-input">
				<form>
					<input type="text" id="chat-input" placeholder="Send a message..." />
					<button type="submit" class="chat-submit" id="chat-submit">
						<span class="icon-Send fs-22"></span>
					</button>
				</form>
			</div>
		</div>
	</div>






	<script src="{{ asset('js/vendors.min.js') }}"></script>
	<script src="{{ asset('js/pages/chat-popup.js') }}"></script>
	<script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('assets/vendor_components/moment/min/moment.min.js') }}"></script>
	<script src="{{ asset('assets/vendor_components/fullcalendar/fullcalendar.js') }}"></script>
	<script src="{{ asset('assets/vendor_components/perfect-scrollbar-master/perfect-scrollbar.jquery.min.js') }}"></script>
	<script src="{{ asset('assets/vendor_components/fullcalendar/lib/moment.min.js') }}"></script>
	<script src="{{ asset('assets/vendor_components/fullcalendar/fullcalendar.min.js') }}"></script>
	<script src="{{ asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
	<script src="{{ asset('js/pages/calendar.js') }}"></script>
	<script src="{{ asset('assets/vendor_components/chart.js-master/Chart.min.js') }}"></script>
	<script src="{{ asset('js/template.js') }}"></script>
	<script src="{{ asset('js/pages/dashboard.js') }}"></script>
	<script src="{{ asset('js/pages/calendar.js') }}"></script>
	<script src="{{ asset('assets/data-table.js') }}"></script>
	<script src="{{ asset('assets/datatables.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="{{ asset('js/pages/widget-charts2.js') }}"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




	

@yield('scripts')

</body>

</html>
