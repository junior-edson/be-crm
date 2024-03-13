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
                        <div class="fs-4 fw-bold pb-3 border-bottom border-3 border-primary cursor-pointer" data-kt-table-widget-3="tab" data-kt-table-widget-3-value="Show All">{{ __('All quotations') }}</div>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <div class="fs-4 fw-bold text-muted pb-3 cursor-pointer" data-kt-table-widget-3="tab" data-kt-table-widget-3-value="Draft">{{ __('Draft') }}</div>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <div class="fs-4 fw-bold text-muted pb-3 cursor-pointer" data-kt-table-widget-3="tab" data-kt-table-widget-3-value="Pending">{{ __('Pending') }}</div>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <div class="fs-4 fw-bold text-muted pb-3 cursor-pointer" data-kt-table-widget-3="tab" data-kt-table-widget-3-value="Sent">{{ __('Sent') }}</div>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <div class="fs-4 fw-bold text-muted pb-3 cursor-pointer" data-kt-table-widget-3="tab" data-kt-table-widget-3-value="Approved">{{ __('Approved') }}</div>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <div class="fs-4 fw-bold text-muted pb-3 cursor-pointer" data-kt-table-widget-3="tab" data-kt-table-widget-3-value="Rejected">{{ __('Rejected') }}</div>
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
                                <div class="text-muted fs-7 me-2">{{ __('Status') }}</div>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto" data-hide-search="true" data-control="select2" data-dropdown-css-class="w-150px" data-placeholder="Select an option" data-kt-table-widget-3="filter_status">
                                    <option></option>
                                    <option value="Show All" selected="selected">{{ __('Show All') }}</option>
                                    <option value="Draft">{{ __('Draft') }}</option>
                                    <option value="Pending">{{ __('Pending') }}</option>
                                    <option value="Sent">{{ __('Sent') }}</option>
                                    <option value="Approved">{{ __('Approved') }}</option>
                                    <option value="Rejected">{{ __('Rejected') }}</option>
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
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Dates') }}</th>
                            <th>{{ __('Client') }}</th>
                            <th>{{ __('Company') }}</th>
                            <th>{{ __('Items') }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($quotations as $quotation)
                            <tr>
                                <td>
                                    <div class="position-relative ps-6 pe-3 py-2">
                                        <div class="position-absolute start-0 top-0 w-4px h-100 rounded-2 bg-{{ getQuotationColor($quotation->status) }}"></div>
                                        <a class="mb-1 text-gray-900 text-hover-primary fw-bold">{{ $quotation->client_name }}</a>
                                        <div class="fs-7 text-muted fw-bold">{{ __('Created by ') }}{{ $quotation->user->name }}</div>
                                        <div class="fs-7 text-muted fw-bold">{{ __('Created at ') }}{{ $quotation->created_at->format('d/m/Y H:i') }}</div>
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
                                    <div class="fs-6 fw-bold text-muted">{{ __('Issue: ') }}<span class="text-gray-800">{{ $quotation->issue_date ? $quotation->issue_date->format('d/m/Y') : '-' }}</span></div>
                                    <div class="fs-6 fw-bold text-muted">{{ __('Due: ') }}<span class="text-gray-800">{{ $quotation->due_date ? $quotation->due_date->format('d/m/Y') : '-' }}</span></div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <a class="fs-6 text-gray-800 text-hover-primary">{{ $quotation->client_name }}</a>
                                            <div class="fw-semibold text-gray-500">{!! addressLineBreaker($quotation->client_address) !!}</div>
                                            <div class="fw-semibold text-gray-500">{{ $quotation->client_email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <a class="fs-6 text-gray-800 text-hover-primary">{{ $quotation->company_name }}</a>
                                            <div class="fw-semibold text-gray-500">{!! addressLineBreaker($quotation->company_address) !!}</div>
                                            <div class="fw-semibold text-gray-500">{{ $quotation->company_email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light-secondary fw-bold px-4 py-3">
                                        {{ $quotation->items->count() }}
                                    </span>
                                </td>
                                <td class="d-none">{{ $quotation->status }}</td>
                                <td class="w-100px">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{ __('Actions') }}
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                    </a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('quotation.quotation.show', $quotation->id) }}" class="menu-link px-3">{{ __('View') }}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        @if ($quotation->status === \App\Enums\EnumQuotationStatus::DRAFT->value)
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('quotation.quotation.edit', $quotation->id) }}" class="menu-link px-3">{{ __('Edit') }}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a class="menu-link px-3 btnDeleteDraft" data-quotation-id="{{ $quotation->id }}">{{ __('Delete') }}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        @endif
                                        @if ($quotation->status === \App\Enums\EnumQuotationStatus::PENDING->value)
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a class="menu-link px-3 btnSendQuotation" data-quotation-id="{{ $quotation->id }}">{{ __('Send') }}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        @endif
                                        @if ($quotation->status === \App\Enums\EnumQuotationStatus::SENT->value)
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a class="menu-link px-3 btnApproveQuotation" data-quotation-id="{{ $quotation->id }}">{{ __('Approve') }}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a class="menu-link px-3 btnRejectQuotation" data-quotation-id="{{ $quotation->id }}">{{ __('Reject') }}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        @endif
                                        @if ($quotation->status === \App\Enums\EnumQuotationStatus::APPROVED->value)
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a class="menu-link px-3" data-quotation-id="{{ $quotation->id }}">{{ __('Create invoice') }}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        @endif
                                        @if ($quotation->status === \App\Enums\EnumQuotationStatus::REJECTED->value)
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('quotation.quotation.edit', $quotation->id) }}" class="menu-link px-3">{{ __('Edit') }}</a>
                                            </div>
                                            <!--end::Menu item-->
                                        @endif
                                    </div>
                                    <!--end::Menu-->
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

    @push('scripts')
        <script>
            // Delete draft button event
            $(document).on('click', '.btnDeleteDraft', function () {
                let quotationId = $(this).data('quotation-id');
                let thisButton = $(this);

                // Alert to confirm
                Swal.fire({
                    text: "{{ __('Are you sure you want to delete this draft?') }}",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "{{ __('Yes, delete it!') }}",
                    cancelButtonText: "{{ __('No, cancel!') }}",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    },
                    reverseButtons: true,
                }).then(function (result) {
                    if (result.value) {
                        let deleteUrl = "{{ route('quotation.quotation.destroy', ':quotationId') }}";
                        deleteUrl = deleteUrl.replace(':quotationId', quotationId);

                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                Swal.fire({
                                    text: "{{ __('Your draft was successfully deleted!') }}",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('Ok, got it!') }}",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });

                                // Remove line from table
                                thisButton.closest('tr').remove();
                            },
                            error: function (xhr, status, error) {
                                let errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "{{ __('Sorry, an error occurred.') }}";

                                Swal.fire({
                                    text: errorMessage,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('Ok, got it!') }}",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });
                            }
                        });
                    }

                });
            });

            // Send quotation button event
            $(document).on('click', '.btnSendQuotation', function () {
                let quotationId = $(this).data('quotation-id');
                let thisButton = $(this);

                thisButton.disabled = true;

                // Alert to confirm
                Swal.fire({
                    text: "{{ __('Are you sure you want to send this quotation to the client? This will change status to SENT.') }}",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "{{ __('Yes, send it!') }}",
                    cancelButtonText: "{{ __('No, cancel!') }}",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    },
                    reverseButtons: true,
                }).then(function (result) {
                    if (result.value) {
                        let sendUrl = "{{ route('quotation.quotation.send', ':quotationId') }}";
                        sendUrl = sendUrl.replace(':quotationId', quotationId);

                        $.ajax({
                            url: sendUrl,
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                Swal.fire({
                                    text: "{{ __('Your quotation was successfully sent!') }}",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('Ok, got it!') }}",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });

                                window.location.reload();
                            },
                            error: function (xhr, status, error) {
                                let errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "{{ __('Sorry, an error occurred.') }}";

                                Swal.fire({
                                    text: errorMessage,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('Ok, got it!') }}",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });

                                thisButton.disabled = false;
                            }
                        });
                    }

                });
            });

            // Approve quotation button event
            $(document).on('click', '.btnApproveQuotation', function () {
                let quotationId = $(this).data('quotation-id');
                let thisButton = $(this);

                thisButton.disabled = true;

                // Alert to confirm
                Swal.fire({
                    text: "{{ __('Are you sure you want to approve this quotation? After that you can create an invoice of it.') }}",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "{{ __('Yes, approve it!') }}",
                    cancelButtonText: "{{ __('No, cancel!') }}",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    },
                    reverseButtons: true,
                }).then(function (result) {
                    if (result.value) {
                        let approveUrl = "{{ route('quotation.quotation.approve', ':quotationId') }}";
                        approveUrl = approveUrl.replace(':quotationId', quotationId);

                        $.ajax({
                            url: approveUrl,
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                Swal.fire({
                                    text: "{{ __('Your quotation was successfully approved!') }}",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('Ok, got it!') }}",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });

                                window.location.reload();
                            },
                            error: function (xhr, status, error) {
                                let errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "{{ __('Sorry, an error occurred.') }}";

                                Swal.fire({
                                    text: errorMessage,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('Ok, got it!') }}",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });

                                thisButton.disabled = false;
                            }
                        });
                    }

                });
            });

            // Reject quotation button event
            $(document).on('click', '.btnRejectQuotation', function () {
                let quotationId = $(this).data('quotation-id');
                let thisButton = $(this);

                thisButton.disabled = true;

                // Alert to confirm
                Swal.fire({
                    text: "{{ __('Are you sure you want to reject this quotation?') }}",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "{{ __('Yes, reject it!') }}",
                    cancelButtonText: "{{ __('No, cancel!') }}",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    },
                    reverseButtons: true,
                }).then(function (result) {
                    if (result.value) {
                        let rejectUrl = "{{ route('quotation.quotation.reject', ':quotationId') }}";
                        rejectUrl = rejectUrl.replace(':quotationId', quotationId);

                        $.ajax({
                            url: rejectUrl,
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                Swal.fire({
                                    text: "{{ __('Your quotation was successfully rejected!') }}",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('Ok, got it!') }}",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });

                                window.location.reload();
                            },
                            error: function (xhr, status, error) {
                                let errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "{{ __('Sorry, an error occurred.') }}";

                                Swal.fire({
                                    text: errorMessage,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('Ok, got it!') }}",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });

                                thisButton.disabled = false;
                            }
                        });
                    }

                });
            });
        </script>
    @endpush
</x-default-layout>
