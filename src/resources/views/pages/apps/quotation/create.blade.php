<x-default-layout>
    @section('title')
        {{ __('Create quotation') }}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('quotation.create') }}
    @endsection

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body p-12">
                            <!--begin::Form-->
                            <form id="kt_quotation_form">
                                @csrf
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column align-items-start flex-xxl-row">
                                    <!--begin::Input group-->
                                    <div class="d-flex align-items-center flex-equal fw-row me-4 order-2" data-bs-toggle="tooltip" data-bs-trigger="hover" title="{{ __('Specify quotation date') }}">
                                        <!--begin::Date-->
                                        <div class="fs-6 fw-bold text-gray-700 text-nowrap">{{ __('Issue date') }}:</div>
                                        <!--end::Date-->
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center w-150px">
                                            <!--begin::Datepicker-->
                                            <input class="form-control form-control-transparent fw-bold pe-5" placeholder="{{ __('Select date') }}" name="issue_date" />
                                            <!--end::Datepicker-->
                                            <!--begin::Icon-->
                                            <i class="ki-duotone ki-down fs-4 position-absolute ms-4 end-0"></i>
                                            <!--end::Icon-->
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4">
                                        <span class="fs-2x fw-bold text-gray-800">{{ __('Quotation') }}</span>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex align-items-center justify-content-end flex-equal order-3 fw-row" data-bs-toggle="tooltip" data-bs-trigger="hover" title="{{ __('Specify quotation due date') }}">
                                        <!--begin::Date-->
                                        <div class="fs-6 fw-bold text-gray-700 text-nowrap">{{ __('Due Date') }}:</div>
                                        <!--end::Date-->
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center w-150px">
                                            <!--begin::Datepicker-->
                                            <input class="form-control form-control-transparent fw-bold pe-5" placeholder="{{ __('Select date') }}" name="due_date" />
                                            <!--end::Datepicker-->
                                            <!--begin::Icon-->
                                            <i class="ki-duotone ki-down fs-4 position-absolute end-0 ms-4"></i>
                                            <!--end::Icon-->
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Top-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-10"></div>
                                <!--end::Separator-->
                                <!--begin::Wrapper-->
                                <div class="mb-0">
                                    <!--begin::Row-->
                                    <div class="row gx-10 mb-5">
                                        <!--begin::Col-->
                                        <div class="col-lg-6">
                                            <label class="form-label fs-6 fw-bold text-gray-700 mb-3 required">{{ __('Client') }}</label>
                                            <!--begin::Input group-->
                                            <div class="mb-5">
                                                <!--begin::Select-->
                                                <input type="hidden" id="quotation_id" name="quotation_id" />
                                                <select name="client_id" aria-label="{{ __('Select client') }}" data-control="select2" data-placeholder="{{ __('Select client') }}" class="form-select form-select-solid">
                                                    <option value=""></option>
                                                    @foreach($clients as $client)
                                                    <option data-tax-type-name="{{ __(getTaxName($client)) }}" data-tax-type="{{ getTaxName($client) }}" data-tax-percentage="{{ getClientTaxPercentage($client) }}" data-name="{{ $client->name }}" data-email="{{ $client->email }}" data-address="{{ $client->address }}" value="{{ $client->id }}">
                                                        {{ $client->name }} {{ $client->type !== \App\Enums\EnumClientType::INDIVIDUAL->value ? "(" . __('Reg.no.') . ":" . $client->registration_code . ")" : '' }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <!--end::Select-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-5">
                                                <input type="hidden" name="client_name" />
                                                <input type="text" name="client_email" class="form-control form-control-solid" placeholder="{{ __('Email') }}" />
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-5">
                                                <textarea name="client_address" class="form-control form-control-solid" rows="3" placeholder="{{ __('Address') }}"></textarea>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6">
                                            <label class="form-label fs-6 fw-bold text-gray-700 mb-3">{{ __('Company') }}</label>
                                            <!--begin::Input group-->
                                            <div class="mb-5">
                                                <input type="text" name="company_name" class="form-control form-control-solid" placeholder="{{ __('Name') }}" value="{{ \Illuminate\Support\Facades\Auth::user()->currentTeam->name }}" readonly />
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-5">
                                                <input type="text" name="company_email" class="form-control form-control-solid" placeholder="{{ __('Email') }}" value="{{ \Illuminate\Support\Facades\Auth::user()->currentTeam->email }}" readonly />
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-5">
                                                <textarea name="company_address" class="form-control form-control-solid" rows="3" placeholder="{{ __('Address') }}" readonly>{{ \Illuminate\Support\Facades\Auth::user()->currentTeam->address }}</textarea>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive mb-10">
                                        <!--begin::Table-->
                                        <table class="table g-5 gs-0 mb-0 fw-bold text-gray-700" data-kt-element="items">
                                            <!--begin::Table head-->
                                            <thead>
                                            <tr class="border-bottom fs-7 fw-bold text-gray-700 text-uppercase">
                                                <th class="min-w-300px w-475px">Item</th>
                                                <th class="min-w-100px w-100px">QTY</th>
                                                <th class="min-w-150px w-150px">Price</th>
                                                <th class="min-w-100px w-150px text-end">Total</th>
                                                <th class="min-w-75px w-75px text-end">Action</th>
                                            </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody>
                                            <tr class="border-bottom border-bottom-dashed" data-kt-element="item">
                                                <td class="pe-7">
                                                    <input type="text" class="form-control form-control-solid" name="description[]" placeholder="Description" />
                                                </td>
                                                <td class="ps-0">
                                                    <input class="form-control form-control-solid" type="number" min="1" name="quantity[]" placeholder="1" value="1" data-kt-element="quantity" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-solid text-end" name="price[]" placeholder="0,00" data-kt-element="price" />
                                                </td>
                                                <td class="pt-8 text-end text-nowrap">
                                                    <span data-kt-element="total">0,00</span></td>
                                                <td class="pt-5 text-end">
                                                    <button type="button" class="btn btn-sm btn-icon btn-icon-danger" data-kt-element="remove-item">
                                                        <i class="ki-duotone ki-trash fs-3">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                        </i>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                            <!--begin::Table foot-->
                                            <tfoot>
                                            <tr class="border-top border-top-dashed align-top fs-6 fw-bold text-gray-700">
                                                <th class="text-primary">
                                                    <button class="btn btn-sm btn-primary" data-kt-element="add-item">Add item</button>
                                                </th>
                                                <th colspan="2" class="border-bottom border-bottom-dashed ps-0">
                                                    <div class="d-flex flex-column align-items-start">
                                                        <div class="fs-5">Subtotal</div>
                                                        <div class="fs-5 tax_label">VAT</div>
                                                        <input type="hidden" class="tax_type" name="tax_type" value="" />
                                                        <input type="hidden" class="tax_percentage" name="tax_percentage" value="0" />
                                                        <input type="hidden" name="currency" value="EUR" />
                                                    </div>
                                                </th>
                                                <th colspan="2" class="border-bottom border-bottom-dashed text-end">
                                                    <div class="d-flex flex-column align-items-end">
                                                        <span data-kt-element="sub-total">0,00</span>
                                                        <span data-kt-element="display-tax">0,00</span>
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr class="align-top fw-bold text-gray-700">
                                                <th></th>
                                                <th colspan="2" class="fs-4 ps-0">Total</th>
                                                <th colspan="2" class="text-end fs-4 text-nowrap">
                                                    <span data-kt-element="grand-total">0,00</span>
                                                </th>
                                            </tr>
                                            </tfoot>
                                            <!--end::Table foot-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                    <!--begin::Item template-->
                                    <table class="table d-none" data-kt-element="item-template">
                                        <tr class="border-bottom border-bottom-dashed" data-kt-element="item">
                                            <td class="pe-7">
                                                <input type="text" class="form-control form-control-solid" name="description[]" placeholder="Description" />
                                            </td>
                                            <td class="ps-0">
                                                <input class="form-control form-control-solid" type="number" min="1" name="quantity[]" placeholder="1" data-kt-element="quantity" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-solid text-end" name="price[]" placeholder="0,00" data-kt-element="price" />
                                            </td>
                                            <td class="pt-8 text-end">
                                                <span data-kt-element="total">0,00</span></td>
                                            <td class="pt-5 text-end">
                                                <button type="button" class="btn btn-sm btn-icon btn-color-danger" data-kt-element="remove-item">
                                                    <i class="ki-duotone ki-trash fs-3">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="table d-none" data-kt-element="empty-template">
                                        <tr data-kt-element="empty">
                                            <th colspan="5" class="text-muted text-center py-10">{{ __('No items') }}</th>
                                        </tr>
                                    </table>
                                    <!--end::Item template-->
                                    <!--begin::Notes-->
                                    <div class="mb-0">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Notes</label>
                                        <textarea name="notes" class="form-control form-control-solid" rows="3" placeholder="This information comes to the bottom of the quotation"></textarea>
                                    </div>
                                    <!--end::Notes-->
                                </div>
                                <!--end::Wrapper-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
                <!--begin::Sidebar-->
                <div class="flex-lg-auto min-w-lg-300px">
                    <!--begin::Card-->
                    <div class="card" data-kt-sticky="true" data-kt-sticky-name="quotation" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', lg: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                        <!--begin::Card body-->
                        <div class="card-body p-10">
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-bold fs-6 text-gray-700">{{ __('Currency') }}</label>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select aria-label="{{ __('Select currency') }}" data-control="select2" data-placeholder="{{ __('Select currency') }}" class="form-select form-select-solid">
                                    <option value=""></option>
                                    <option value="EUR" selected>
                                        <b>EUR</b>&nbsp;-&nbsp;{{ __('Euro') }}
                                    </option>
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed mb-8"></div>
                            <!--end::Separator-->
                            <!--begin::Actions-->
                            <div class="mb-0">
                                <!--begin::Row-->
                                <div class="row mb-5">
                                    <!--begin::Col-->
                                    <div class="col">
                                        <button type="submit" class="btn btn-light btn-active-light-primary w-100" id="kt_submit_draft_button">
                                            <i class="ki-duotone ki-note-2 fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                            Save draft
                                        </button>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <button type="submit" class="btn btn-primary w-100" id="kt_quotation_submit_button">
                                    <i class="ki-duotone ki-triangle fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    Send quotation
                                </button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Sidebar-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

    @push('scripts')
        <script>
            let KTAppQuotationsCreate = function () {
                let form;

                // Private functions
                let updateTotal = function() {
                    let items = [].slice.call(form.querySelectorAll('[data-kt-element="items"] [data-kt-element="item"]'));
                    let subTotal = 0;
                    let grandTotal = 0;
                    let taxValue = 0;
                    let format = wNumb({
                        prefix: '€ ',
                        decimals: 2,
                        mark: ',',
                        thousand: '.'
                    });

                    items.map(function (item) {
                        let quantity = item.querySelector('[data-kt-element="quantity"]');
                        let price = item.querySelector('[data-kt-element="price"]');
                        let tax_percentage = $('.tax_percentage');
                        let priceValue = format.from(price.value);
                        priceValue = (!priceValue || priceValue < 0) ? 0 : priceValue;

                        let quantityValue = parseInt(quantity.value);
                        quantityValue = (!quantityValue || quantityValue < 0) ?  1 : quantityValue;

                        price.value = format.to(priceValue);
                        quantity.value = quantityValue;

                        item.querySelector('[data-kt-element="total"]').innerText = format.to(priceValue * quantityValue);

                        subTotal += priceValue * quantityValue;
                        taxValue = subTotal * tax_percentage.val() / 100;
                        grandTotal = subTotal + taxValue;
                    });

                    form.querySelector('[data-kt-element="display-tax"]').innerText = format.to(taxValue);
                    form.querySelector('[data-kt-element="sub-total"]').innerText = format.to(subTotal);
                    form.querySelector('[data-kt-element="grand-total"]').innerText = format.to(grandTotal);
                }

                let handleEmptyState = function() {
                    if (form.querySelectorAll('[data-kt-element="items"] [data-kt-element="item"]').length === 0) {
                        let item = form.querySelector('[data-kt-element="empty-template"] tr').cloneNode(true);
                        form.querySelector('[data-kt-element="items"] tbody').appendChild(item);
                    } else {
                        KTUtil.remove(form.querySelector('[data-kt-element="items"] [data-kt-element="empty"]'));
                    }
                }

                let handeForm = function (element) {
                    // Add item
                    form.querySelector('[data-kt-element="items"] [data-kt-element="add-item"]').addEventListener('click', function(e) {
                        e.preventDefault();

                        let item = form.querySelector('[data-kt-element="item-template"] tr').cloneNode(true);

                        form.querySelector('[data-kt-element="items"] tbody').appendChild(item);

                        handleEmptyState();
                        updateTotal();
                    });

                    // Remove item
                    KTUtil.on(form, '[data-kt-element="items"] [data-kt-element="remove-item"]', 'click', function(e) {
                        e.preventDefault();

                        KTUtil.remove(this.closest('[data-kt-element="item"]'));

                        handleEmptyState();
                        updateTotal();
                    });

                    // Handle price and quantity changes
                    KTUtil.on(form, '[data-kt-element="items"] [data-kt-element="quantity"], [data-kt-element="items"] [data-kt-element="price"]', 'change', function(e) {
                        e.preventDefault();
                        updateTotal();
                    });
                }

                let initForm = function(element) {
                    // Due date. For more info, please visit the official plugin site: https://flatpickr.js.org/
                    let quotationDate = $(form.querySelector('[name="issue_date"]'));
                    quotationDate.flatpickr({
                        enableTime: false,
                        dateFormat: "Y-m-d",
                    });

                    // Due date. For more info, please visit the official plugin site: https://flatpickr.js.org/
                    let dueDate = $(form.querySelector('[name="due_date"]'));
                    dueDate.flatpickr({
                        enableTime: false,
                        dateFormat: "Y-m-d",
                    });
                }

                // Public methods
                return {
                    init: function(element) {
                        form = document.querySelector('#kt_quotation_form');

                        handeForm();
                        initForm();
                        updateTotal();
                    },
                    updateTotal: updateTotal,
                };
            }();

            // On document ready
            KTUtil.onDOMContentLoaded(function () {
                KTAppQuotationsCreate.init();
                let form = document.querySelector('#kt_quotation_form');
                let submitDraftButton = document.getElementById('kt_submit_draft_button');

                $('[name="client_id"]').on('change', function (e) {
                    let selectedOption = $(this).select2('data')[0];

                    if (selectedOption) {
                        let taxTypeName = selectedOption.element.dataset.taxTypeName;
                        let taxType = selectedOption.element.dataset.taxType;
                        let taxPercentage = selectedOption.element.dataset.taxPercentage;
                        let name = selectedOption.element.dataset.name;
                        let email = selectedOption.element.dataset.email;
                        let address = selectedOption.element.dataset.address;

                        $('.tax_label').text(taxTypeName);
                        $('.tax_type').val(taxType);
                        $('.tax_percentage').val(taxPercentage);
                        $('[name="client_name"]').val(name);
                        $('[name="client_email"]').val(email);
                        $('[name="client_address"]').val(address);

                        KTAppQuotationsCreate.updateTotal();
                    }
                });

                submitDraftButton.addEventListener('click', function (event) {
                    event.preventDefault();
                    submitDraftButton.disabled = true;

                    let formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('quotation.quotation.draft') }}',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            Swal.fire({
                                text: "{{ __('Your draft was successfully saved!') }}",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "{{ __('Ok, got it!') }}",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function (result) {
                                submitDraftButton.disabled = false;

                                // After creating a draft, we fill the quotation id
                                $('#quotation_id').val(response.id);
                            });
                        },
                        error: function (xhr, status, error) {
                            Swal.fire({
                                text: xhr.responseJSON.message || "{{ __('Sorry, an error occurred.') }}",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "{{ __('Ok, got it!') }}",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });

                            submitDraftButton.disabled = false;
                        }
                    });
                });
            });
        </script>
    @endpush
</x-default-layout>
