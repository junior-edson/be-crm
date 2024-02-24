<x-default-layout>
    @section('title')
        {{ __('Quotation') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('quotation.index') }}
    @endsection

    <!--begin::Content-->
    <div class="row">
        <div class="col-xl-12 col-xxl-12 mb-5 mb-xl-10">

            <!--begin::Table Widget 3-->
            <div class="card card-flush h-xl-100">
                <!--begin::Card header-->
                <div class="card-header py-7">
                    <!--begin::Tabs-->
                    <div class="card-title pt-3 mb-0 gap-4 gap-lg-10 gap-xl-15 nav nav-tabs border-bottom-0" data-kt-table-widget-3="tabs_nav">
                        <!--begin::Tab item-->
                        <div class="fs-4 fw-bold pb-3 border-bottom border-3 border-primary cursor-pointer" data-kt-table-widget-3="tab" data-kt-table-widget-3-value="Show All">All quotations</div>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <div class="fs-4 fw-bold text-muted pb-3 cursor-pointer" data-kt-table-widget-3="tab" data-kt-table-widget-3-value="Draft">Draft</div>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <div class="fs-4 fw-bold text-muted pb-3 cursor-pointer" data-kt-table-widget-3="tab" data-kt-table-widget-3-value="Pending">Pending</div>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <div class="fs-4 fw-bold text-muted pb-3 cursor-pointer" data-kt-table-widget-3="tab" data-kt-table-widget-3-value="Sent">Sent</div>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <div class="fs-4 fw-bold text-muted pb-3 cursor-pointer" data-kt-table-widget-3="tab" data-kt-table-widget-3-value="Approved">Approved</div>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <div class="fs-4 fw-bold text-muted pb-3 cursor-pointer" data-kt-table-widget-3="tab" data-kt-table-widget-3-value="Rejected">Rejected</div>
                        <!--end::Tab item-->
                    </div>
                    <!--end::Tabs-->
                    <!--begin::Create campaign button-->
                    <div class="card-toolbar">
                        <a href="{{ route('quotation.quotation.create') }}" class="btn btn-primary">{{ __('Create quotation') }}</a>
                    </div>
                    <!--end::Create campaign button-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-1">
                    <!--begin::Sort & Filter-->
                    <div class="d-none d-flex flex-stack flex-wrap gap-4">
                        <!--begin::Sort-->
                        <div class="d-flex align-items-center flex-wrap gap-3 gap-xl-9">
                            <!--begin::Status-->
                            <div class="d-flex align-items-center fw-bold">
                                <!--begin::Label-->
                                <div class="text-muted fs-7 me-2">Status</div>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto" data-hide-search="true" data-control="select2" data-dropdown-css-class="w-150px" data-placeholder="Select an option" data-kt-table-widget-3="filter_status">
                                    <option></option>
                                    <option value="Show All" selected="selected">Show All</option>
                                    <option value="Draft">Draft</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Sent">Sent</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--begin::Status-->
                        </div>
                        <!--end::Sort-->
                    </div>
                    <!--end::Sort & Filter-->
                    <!--begin::Seprator-->
                    <div class="d-none separator separator-dashed my-5"></div>
                    <!--end::Seprator-->
                    <!--begin::Table-->
                    <table id="kt_widget_table_3" class="table table-row-dashed align-middle fs-6 gy-4 my-0 pb-3" data-kt-table-widget-3="all">
                        <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Status</th>
                            <th>Client data</th>
                            <th>Company data</th>
                            <th>Issue/Due date</th>
                            <th>Has items?</th>
                            <td></td>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($quotations as $quotation)
                            <tr>
                                <td>
                                    <div class="position-relative ps-6 pe-3 py-2">
                                        <div class="position-absolute start-0 top-0 w-4px h-100 rounded-2 bg-{{ getQuotationColor($quotation->status) }}"></div>
                                        <a class="mb-1 text-gray-900 text-hover-primary fw-bold">Draft for {{ $quotation->client_name }}</a>
                                        <div class="fs-7 text-muted fw-bold">Created at {{ $quotation->created_at->format('d M, Y H:i') }}</div>
                                    </div>
                                </td>
                                <td>
                                    {{ $quotation->number ?? '-' }}
                                </td>
                                <td>
                                    <span class="badge badge-light-{{ getQuotationColor($quotation->status) }} fw-bold px-4 py-3">
                                        {{ $quotation->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <a class="fs-6 text-gray-800 text-hover-primary">{{ $quotation->client_name }}</a>
                                            <div class="fw-semibold text-gray-500">{{ $quotation->client_email }}</div>
                                            <div class="fw-semibold text-gray-500">{{ $quotation->client_address }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <a class="fs-6 text-gray-800 text-hover-primary">{{ $quotation->company_name }}</a>
                                            <div class="fw-semibold text-gray-500">{{ $quotation->company_email }}</div>
                                            <div class="fw-semibold text-gray-500">{{ $quotation->company_address }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-2 fw-bold">{{ $quotation->issue_date ? $quotation->issue_date->format('d M, Y') : '-' }} - {{ $quotation->due_date ? $quotation->due_date->format('d M, Y') : '-' }}</div>
                                    <div class="fs-7 fw-bold text-muted">Date range</div>
                                </td>
                                <td>
                                    <span class="badge badge-light-secondary fw-bold px-4 py-3">
                                        @if ($quotation->items->isNotEmpty())
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </span>
                                </td>
                                <td class="d-none">{{ $quotation->status }}</td>
                                <td class="w-75px">
                                    <a href="{{ route('quotation.quotation.show', $quotation->id) }}" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="bi bi-eye-fill fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </a>

                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="bi bi-pencil-fill fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <!--end::Table-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Table Widget 3-->
        </div>
    </div>
    <!--end::Content-->
</x-default-layout>
