<?php 
	$page = isset($_GET['page'] )? $_GET['page'] : "index";
?>					
						<!--begin::Aside Menu-->
						<div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
							<!--begin::Menu-->
							<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
								<div class="menu-item">
									<div class="menu-content pb-2">
										<span class="menu-section text-muted text-uppercase fs-8 ls-1">Dashboard</span>
									</div>
								</div>
								<div class="menu-item">
									<a class="menu-link <?php if($page === 'index'){echo 'active';} ?>" href="?page=index">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											<span class="svg-icon svg-icon-2">
												<img src="assets/media/icons/duotone/General/Visible.svg"/>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Dashboard</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link <?php if($page === '2'){echo 'active';} ?>" href="?page=2">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											
											<span class="menu-icon">
											<img src="assets/media/icons/duotone/General/Half-star.svg"/>
											
										</span>
										

											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">All Master </span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link <?php if($page === '3'){echo 'active';} ?>" href="?page=3">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											
											<span class="menu-icon">
											<img src="assets/media/icons/duotone/Code/Git2.svg"/>
											
										</span>
										

											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Detail</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link <?php if($page === '1'){echo 'active';} ?>" href="?page=1">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											
											<span class="menu-icon">
												<img src="assets/media/icons/duotone/General/User.svg"/>	
											
										    </span>
											
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Clients</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link <?php if($page === '4'){echo 'active';} ?>" href="?page=4">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											
											<span class="menu-icon">
											<img src="assets/media/icons/duotone/Code/Plus.svg"/>	
											
										    </span>
											
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">APP IP Master</span>
									</a>
								</div>
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Aside Menu-->
						