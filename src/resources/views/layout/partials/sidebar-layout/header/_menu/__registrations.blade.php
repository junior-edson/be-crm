<!--begin:Dashboards menu-->
<div class="menu-state-bg menu-extended overflow-hidden overflow-lg-visible" data-kt-menu-dismiss="true">
	<!--begin:Row-->
	<div class="row">
		<!--begin:Col-->
		<div class="col-lg-12 mb-3 mb-lg-0 py-3 px-3 py-lg-6 px-lg-6">
			<!--begin:Row-->
			<div class="row">
                <!--begin:Col-->
                <div class="col-lg-6 mb-3">
                    <!--begin:Menu item-->
                    <div class="menu-item p-0 m-0">
                        <!--begin:Menu link-->
                        <a href="{{ route('agenda.event.index') }}" class="menu-link {{ request()->routeIs('agenda.event.*') ? 'active' : '' }}">
                            <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">{!! getIcon('calendar', 'text-info fs-1') !!}</span>
                            <span class="d-flex flex-column">
								<span class="fs-6 fw-bold text-gray-800">{{ __('Agenda') }}</span>
								<span class="fs-7 fw-semibold text-muted">{{ __('Manage your appointments') }}</span>
							</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end:Col-->
				<!--begin:Col-->
				<div class="col-lg-6 mb-3">
					<!--begin:Menu item-->
					<div class="menu-item p-0 m-0">
						<!--begin:Menu link-->
						<a href="{{ route('user-management.users.index') }}" class="menu-link {{ request()->routeIs('user-management.users.*') ? 'active' : '' }}">
							<span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">{!! getIcon('profile-user', 'text-primary fs-1') !!}</span>
							<span class="d-flex flex-column">
								<span class="fs-6 fw-bold text-gray-800">{{ __('Users') }}</span>
								<span class="fs-7 fw-semibold text-muted">{{ __('Those who use our system') }}</span>
							</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Col-->
                <!--begin:Col-->
                <div class="col-lg-6 mb-3">
                    <!--begin:Menu item-->
                    <div class="menu-item p-0 m-0">
                        <!--begin:Menu link-->
                        <a href="{{ route('quotation.quotation.index') }}" class="menu-link">
                            <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">{!! getIcon('tag', 'text-success fs-1') !!}</span>
                            <span class="d-flex flex-column">
								<span class="fs-6 fw-bold text-gray-800">{{ __('Quotations') }}</span>
								<span class="fs-7 fw-semibold text-muted">{{ __('Manage your quotations') }}</span>
							</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end:Col-->
				<!--begin:Col-->
				<div class="col-lg-6 mb-3">
					<!--begin:Menu item-->
					<div class="menu-item p-0 m-0">
						<!--begin:Menu link-->
						<a href="{{ route('client-management.clients.index') }}" class="menu-link {{ request()->routeIs('client-management.clients.*') ? 'active' : '' }}">
							<span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">{!! getIcon('shop', 'text-primary fs-1') !!}</span>
							<span class="d-flex flex-column">
								<span class="fs-6 fw-bold text-gray-800">{{ __('Clients') }}</span>
								<span class="fs-7 fw-semibold text-muted">{{ __('Those who pay our bills') }}</span>
							</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Col-->
				<!--begin:Col-->
				<div class="col-lg-6 mb-3">
					<!--begin:Menu item-->
					<div class="menu-item p-0 m-0">
						<!--begin:Menu link-->
						<a href="{{ route('dashboard') }}" class="menu-link">
							<span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">{!! getIcon('cheque', 'text-gray-900 fs-1') !!}</span>
							<span class="d-flex flex-column">
								<span class="fs-6 fw-bold text-gray-800">{{ __('Invoices') }}</span>
								<span class="fs-7 fw-semibold text-muted">{{ __('Manage your invoices') }}</span>
							</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Col-->
				<!--begin:Col-->
				<div class="col-lg-6 mb-3">
                    <!--begin:Menu item-->
                    <div class="menu-item p-0 m-0">
                        <!--begin:Menu link-->
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <span class="menu-custom-icon d-flex flex-center flex-shrink-0 rounded w-40px h-40px me-3">{!! getIcon('crown', 'text-primary fs-1') !!}</span>
                            <span class="d-flex flex-column">
								<span class="fs-6 fw-bold text-gray-800">{{ __('Companies') }}</span>
								<span class="fs-7 fw-semibold text-muted">{{ __('Manage your companies') }}</span>
							</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
				</div>
				<!--end:Col-->
			</div>
			<!--end:Row-->
		</div>
		<!--end:Col-->
	</div>
	<!--end:Row-->
</div>
<!--end:Dashboards menu-->
