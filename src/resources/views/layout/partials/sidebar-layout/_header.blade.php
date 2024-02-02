<!--begin::Header-->
<div class="app-header" style="left: 0!important; background-color: #f3f3f3;">
	<!--begin::Header container-->
	<div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
		<!--begin::Mobile logo-->
		<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
			<a href="{{ route('dashboard') }}" class="d-lg-none">
				<img alt="Logo" src="{{ image('logos/default-small.svg') }}" class="h-30px" />
			</a>
		</div>
		<!--end::Mobile logo-->
		<!--begin::Header wrapper-->
		<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
			@include(config('settings.KT_THEME_LAYOUT_DIR').'/partials/sidebar-layout/header/_menu/_menu')
			@include(config('settings.KT_THEME_LAYOUT_DIR').'/partials/sidebar-layout/header/_navbar')
		</div>
		<!--end::Header wrapper-->
	</div>
	<!--end::Header container-->
</div>
<!--end::Header-->
