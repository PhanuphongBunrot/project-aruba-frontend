<?php
$page = isset($_GET['page']) ? $_GET['page'] : "index";

$title = "Dashboard";
if ($page == 'index') {
	$title = "Dashboard";
} else if ($page == '1') {
	$title = "Clients";
} else if ($page == '2') {
	$title = "All Master";
} else if ($page == '3') {
	$title = "Detail";
} else if ($page == '4') {
	$title = "App IP Master ";
} else if ($page == '5') {
	$title = "All Master ";
} else if ($page == '7') {
	$title = "Detail Offline ";
}
?>
<!--begin::Page title-->
<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
	<!--begin::Title-->
	<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><?php echo $title; ?>
		<!--begin::Separator-->
		<span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
		<!--end::Separator-->
		<!--begin::Description-->
		<small class="text-muted fs-7 fw-bold my-1 ms-1"></small>
		<!--end::Description-->
	</h1>
	<!--end::Title-->
</div>
<!--end::Page title-->