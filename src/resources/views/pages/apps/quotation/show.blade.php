<x-default-layout>
    @section('title')
        {{ __('Create quotation') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('quotation.show', $quotation->id) }}
    @endsection

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Invoice 2 main-->
            <div class="card">
                <!--begin::Body-->
                <div class="card-body p-lg-20">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-xl-row">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
                            <!--begin::Invoice 2 content-->
                            <div class="mt-n1">
                                <!--begin::Top-->
                                <div class="d-flex flex-stack pb-10">
                                    <!--begin::Logo-->
                                    <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/code-lab.svg') }}" />
                                    <!--end::Logo-->
                                    <!--begin::Action-->
                                    <a href="#" class="btn btn-sm btn-success d-none">Pay Now</a>
                                    <!--end::Action-->
                                </div>
                                <!--end::Top-->
                                <!--begin::Wrapper-->
                                <div class="m-0">
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-3 text-gray-800 mb-8">Quotation #{{ $quotation->number ?? \App\Enums\EnumQuotationStatus::DRAFT->value }}</div>
                                    <!--end::Label-->
                                    <!--begin::Row-->
                                    <div class="row g-5 mb-11">
                                        <!--end::Col-->
                                        <div class="col-sm-6">
                                            <!--end::Label-->
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Issue date:</div>
                                            <!--end::Label-->
                                            <!--end::Col-->
                                            <div class="fw-bold fs-6 text-gray-800">{{ $quotation->issue_date ? $quotation->issue_date->format('d/m/Y') : '-' }}</div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Col-->
                                        <!--end::Col-->
                                        <div class="col-sm-6">
                                            <!--end::Label-->
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Due date:</div>
                                            <!--end::Label-->
                                            <!--end::Info-->
                                            <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center flex-wrap">
                                                <span class="pe-2">{{ $quotation->due_date ? $quotation->due_date->format('d/m/Y') : '-' }}</span>
                                                @if ($quotation->due_date)
                                                    @php
                                                        $daysUntilDue = now()->diffInDays($quotation->due_date) + 1;
                                                        $isDueToday = now()->isSameDay($quotation->due_date);
                                                        $isExpired = now()->gt($quotation->due_date);
                                                    @endphp

                                                    @if ($isDueToday)
                                                        <span class="fs-7 text-warning d-flex align-items-center">
                                                            <span class="bullet bullet-dot bg-warning me-2"></span>
                                                            Due today
                                                        </span>
                                                    @elseif ($isExpired)
                                                        <span class="fs-7 text-danger d-flex align-items-center">
                                                            <span class="bullet bullet-dot bg-danger me-2"></span>
                                                            Expired
                                                        </span>
                                                    @elseif ($daysUntilDue > 0)
                                                        <span class="fs-7 text-danger d-flex align-items-center">
                                                            <span class="bullet bullet-dot bg-danger me-2"></span>
                                                            Due in {{ $daysUntilDue }} {{ $daysUntilDue === 1 ? __('day') : __('days') }}
                                                        </span>
                                                    @endif
                                                @endif
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="row g-5 mb-12">
                                        <!--end::Col-->
                                        <div class="col-sm-6">
                                            <!--end::Label-->
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Issue for:</div>
                                            <!--end::Label-->
                                            <!--begin::Client name-->
                                            <div class="fw-bold fs-6 text-gray-800">{{ $quotation->client_name }}</div>
                                            <!--end::Client name-->
                                            <!--begin::Address-->
                                            <div class="fw-semibold fs-7 text-gray-600" >
                                                {!! addressLineBreaker($quotation->client_address) !!}
                                            </div>
                                            <!--end::Address-->
                                            <!--begin::Email-->
                                            <div class="fw-semibold fs-7 text-gray-600" >
                                                {{ $quotation->client_email }}
                                            </div>
                                            <!--end::Email-->
                                        </div>
                                        <!--end::Col-->
                                        <!--end::Col-->
                                        <div class="col-sm-6">
                                            <!--end::Label-->
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Issued by:</div>
                                            <!--end::Label-->
                                            <!--begin::Client name-->
                                            <div class="fw-bold fs-6 text-gray-800">{{ $quotation->company_name }}</div>
                                            <!--end::Client name-->
                                            <!--begin::Address-->
                                            @php
                                                $address = $quotation->company_address;
                                                $addressWithLineBreaks = preg_replace('/(\D|^)(\d{4})/', "$1<br>$2", $address);
                                            @endphp
                                            <div class="fw-semibold fs-7 text-gray-600" >
                                                {!! $addressWithLineBreaks !!}
                                            </div>
                                            <!--end::Address-->
                                            <!--begin::Email-->
                                            <div class="fw-semibold fs-7 text-gray-600" >
                                                {{ $quotation->company_email }}
                                            </div>
                                            <!--end::Email-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Content-->
                                    <div class="flex-grow-1">
                                        <!--begin::Table-->
                                        <div class="table-responsive border-bottom mb-9">
                                            <table class="table mb-3">
                                                <thead>
                                                    <tr class="border-bottom fs-6 fw-bold text-muted">
                                                        <th class="min-w-175px pb-2">Description</th>
                                                        <th class="min-w-70px text-end pb-2">Qty</th>
                                                        <th class="min-w-80px text-end pb-2">Price</th>
                                                        <th class="min-w-100px text-end pb-2">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($quotation->items->isEmpty() === false)
                                                        @foreach ($quotation->items as $item)
                                                            <tr class="fw-bold text-gray-700 fs-5 text-end">
                                                                <td class="d-flex align-items-center">
                                                                    <i class="fa fa-genderless text-primary fs-2 me-2"></i>
                                                                    {{ $item->description }}
                                                                </td>
                                                                <td>
                                                                    {{ $item->quantity }}
                                                                </td>
                                                                <td>
                                                                    {{ moneyFormat($item->unit_price) }}
                                                                </td>
                                                                <td class="fs-5 text-gray-900 fw-bolder">
                                                                    {{ moneyFormat($item->quantity * $item->unit_price) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="4">
                                                                <div class="text-center">
                                                                    No items found
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                        <!--begin::Container-->
                                        <div class="d-flex justify-content-end">
                                            @php
                                                $subtotal = getItemsTotalAmount($quotation->items);
                                                $taxAmount = getTaxAmount($subtotal, $quotation->tax_type);
                                            @endphp
                                            <!--begin::Section-->
                                            <div class="mw-300px">
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack mb-3">
                                                    <!--begin::Accountname-->
                                                    <div class="fw-semibold pe-10 text-gray-600 fs-7">Subtotal:</div>
                                                    <!--end::Accountname-->
                                                    <!--begin::Label-->
                                                    <div class="text-end fw-bold fs-6 text-gray-800">{{ moneyFormat($subtotal) }}</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack mb-3">
                                                    <!--begin::Accountname-->
                                                    <div class="fw-semibold pe-10 text-gray-600 fs-7">{{ __(getTaxName($quotation)) }}</div>
                                                    <!--end::Accountname-->
                                                    <!--begin::Label-->
                                                    <div class="text-end fw-bold fs-6 text-gray-800">{{ moneyFormat($taxAmount) }}</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack">
                                                    <!--begin::Code-->
                                                    <div class="fw-semibold pe-10 text-gray-600 fs-7">Total</div>
                                                    <!--end::Code-->
                                                    <!--begin::Label-->
                                                    <div class="text-end fw-bold fs-6 text-gray-800">{{ moneyFormat($subtotal + $taxAmount) }}</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                        <!--end::Container-->
                                    </div>
                                    <!--end::Content-->
                                    <div class="separator separator-dashed my-5"></div>
                                    <!--begin::Notes-->
                                    <div class="d-flex flex-stack {{ $quotation->notes ?? 'd-none' }}">
                                        <div class="d-flex align-items-center">
                                            <div class="fs-6 text-gray-800">{!! nl2br($quotation->notes) !!}</div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Invoice 2 content-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Sidebar-->
                        <div class="m-0">
                            <!--begin::Invoice 2 sidebar-->
                            <div class="d-print-none border border-dashed border-gray-300 card-rounded h-lg-80 min-w-md-350px p-9 bg-lighten">
                                <!--begin::Labels-->
                                <div class="mb-8">
                                    <span class="d-none badge badge-light-success me-2">Approved</span>
                                    <span class="d-none badge badge-light-warning">Pending Payment</span>
                                    <span class="badge badge-light-dark">{{ $quotation->status }}</span>
                                </div>
                                <!--end::Labels-->
                                <!--begin::Title-->
                                <h6 class="mb-8 fw-bolder text-gray-600 text-hover-primary">PAYMENT DETAILS</h6>
                                <!--end::Title-->
                                <!--begin::Item-->
                                <div class="mb-6">
                                    <div class="fw-semibold text-gray-600 fs-7">Paypal:</div>
                                    <div class="fw-bold text-gray-800 fs-6">-</div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="mb-6">
                                    <div class="fw-semibold text-gray-600 fs-7">Account:</div>
                                    <div class="fw-bold text-gray-800 fs-6">-</div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="mb-15">
                                    <div class="fw-semibold text-gray-600 fs-7">Payment Term:</div>
                                    <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center">
                                        30 days
                                        <span class="fs-7 text-danger d-flex align-items-center d-none">
                                            <span class="bullet bullet-dot bg-danger mx-2"></span>
                                            Due today
                                        </span>
                                    </div>
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Invoice 2 sidebar-->
                        </div>
                        <!--end::Sidebar-->
                    </div>
                    <!--end::Layout-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Invoice 2 main-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</x-default-layout>
