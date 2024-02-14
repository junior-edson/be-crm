<div class="modal hide" id="kt_modal_add_client" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_client_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">{{ __('Client') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_client_form" class="form" action="#" wire:submit="submit"
                      enctype="multipart/form-data">
                    <input type="hidden" wire:model="client_id" name="client_id" value="{{ $client_id }}"/>
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_client_scroll"
                         data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                         data-kt-scroll-dependencies="#kt_modal_add_client_header"
                         data-kt-scroll-wrappers="#kt_modal_add_client_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-8 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold mb-2 required">{{ __('Type') }}</label> 
                            <!--end::Label-->

                            <!--begin::Row-->
                            <div class="row g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']" data-kt-initialized="1">
                                <!--begin::Col-->
                                <div class="col-md-6 col-lg-12 col-xxl-6">
                                    <!--begin::Option-->
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                                        <!--begin::Radio-->
                                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                            <input class="form-check-input" type="radio" wire:model="type"  name="type" value="{{ \App\Enums\EnumClientType::INDIVIDUAL }}" onchange="toggleFieldsForClientType()">
                                        </span>
                                        <!--end::Radio-->

                                        <!--begin::Info-->
                                        <span class="ms-5">
                                            <span class="fs-4 fw-bold text-gray-800 mb-2 d-block">{{ __('Individual') }}</span>
                                            <span class="fw-semibold fs-7 text-gray-600">
                                                {{ __('A person that is your client. Taxes applied: 21% or self liquidation.') }}
                                            </span>
                                        </span>
                                        <!--end::Info-->
                                    </label>
                                    <!--end::Option-->
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-md-6 col-lg-12 col-xxl-6">
                                    <!--begin::Option-->
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                                        <!--begin::Radio-->
                                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                            <input class="form-check-input" type="radio" wire:model="type"  name="type" value="{{ \App\Enums\EnumClientType::COMPANY }}" onchange="toggleFieldsForClientType()">
                                        </span>
                                        <!--end::Radio-->

                                        <!--begin::Info-->
                                        <span class="ms-5">
                                            <span class="fs-4 fw-bold text-gray-800 mb-2 d-block">{{ __('Company') }}</span>
                                            <span class="fw-semibold fs-7 text-gray-600">
                                                {{ __('A company that is your client. Taxes applied: subcontracted or self liquidation.') }}
                                            </span>
                                        </span>
                                        <!--end::Info-->
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            @error('type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Heading-->
                            <div class="mb-3">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-5 fw-semibold">
                                    <span class="required">{{ __('Tax type') }}</span>
                                </label>
                                <!--end::Label-->

                                <!--begin::Description-->
                                <div class="fs-7 fw-semibold text-muted">{{ __('System will validate the tax according to the client type') }}</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Heading-->

                            <!--begin::Row-->
                            <div class="fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
                                <!--begin::Radio group-->
                                <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]" data-kt-initialized="0">
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-active-success btn-color-muted" data-kt-button="true" id="taxType21Percent">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" wire:model="tax_type" name="tax_type" value="{{ \App\Enums\EnumClientTaxType::TAX_21_PERCENT->personTaxes() }}">
                                        <!--end::Input-->
                                        {{ __('VAT 21%') }}
                                    </label>
                                    <!--end::Radio-->

                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-active-primary btn-color-muted" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" wire:model="tax_type" name="tax_type" value="{{ \App\Enums\EnumClientTaxType::SELF_LIQUIDATION->personTaxes() }}">
                                        <!--end::Input-->
                                        {{ __('Self liquidation') }}
                                    </label>
                                    <!--end::Radio-->

                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-active-danger btn-color-muted" data-kt-button="true" id="taxTypeSubcontracted">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" wire:model="tax_type" name="tax_type" value="{{ \App\Enums\EnumClientTaxType::SUBCONTRACTOR->companyTaxes() }}">
                                        <!--end::Input-->
                                        {{ __('Subcontracted') }}
                                    </label>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Radio group-->
                                @error('tax_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                            <!--end::Row-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('Name') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" wire:model="name" name="name"
                                   class="form-control form-control-solid mb-3 mb-lg-0" placeholder="{{ __('Name') }}"/>
                            <!--end::Input-->
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7 col-6" wire:ignore id="registrationCodeField">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('Registration code') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" wire:model="registration_code" name="registration_code"
                                   class="form-control form-control-solid mb-3 mb-lg-0" placeholder="1234567890"/>
                            <!--end::Input-->
                            @error('registration_code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('Address') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" wire:model="address" name="address"
                                   class="form-control form-control-solid mb-3 mb-lg-0" placeholder="123 Street"/>
                            <!--end::Input-->
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <div class="col-6">
                                <!--begin::Label-->
                                <label class="fw-semibold fs-6 mb-2">{{ __('Phone') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" wire:model="phone" name="phone"
                                       class="form-control form-control-solid mb-3 mb-lg-0" placeholder="04 1234 5678"/>
                                <!--end::Input-->
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <!--begin::Label-->
                                <label class="fw-semibold fs-6 mb-2">{{ __('Email') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="email" wire:model="email" name="email"
                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                       placeholder="example@domain.com"/>
                                <!--end::Input-->
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex" id="isNPO">
                            <!--begin::Checkbox-->
                            <div class="form-check form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input me-3" wire:model="is_npo" name="is_npo" type="checkbox" value="1">
                                <!--end::Input-->

                                <!--begin::Label-->
                                <label class="form-check-label" for="kt_modal_update_email_notification_0">
                                    <div class="fw-bold">{{ __('Is this a Non-Profit Organization (NPO)?') }}</div>
                                    <div class="text-gray-600">{{ __('If this option is checked, then this customer will not be taxed.') }}</div>
                                </label>
                                <!--end::Label-->
                            </div>
                            <!--end::Checkbox-->
                            @error('is_npo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <div class="separator separator-dashed my-5"></div>
                        <!--begin::Input group-->
                        <div class="d-flex" id="buildingOlderThanTenYears">
                            <!--begin::Checkbox-->
                            <div class="form-check form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input me-3" wire:model="is_building_older_than_10_years" name="is_building_older_than_10_years" type="checkbox" value="1">
                                <!--end::Input-->

                                <!--begin::Label-->
                                <label class="form-check-label" for="kt_modal_update_email_notification_0">
                                    <div class="fw-bold">{{ __('Is the building older than 10 years?') }}</div>
                                    <div class="text-gray-600">{{ __('If this option is checked, then tax applied will be 6%. Otherwise, it will be 21%.') }}</div>
                                </label>
                                <!--end::Label-->
                            </div>
                            <!--end::Checkbox-->
                            @error('is_building_older_than_10_years')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="{{ __('Discard') }}" wire:loading.attr="disabled">
                            {{ __('Discard') }}
                        </button>
                        <button type="submit" class="btn btn-primary" data-kt-clients-modal-action="submit">
                            <span class="indicator-label" wire:loading.remove>{{ __('Submit') }}</span>
                            <span class="indicator-progress" wire:loading wire:target="submit">
                                {{ __('Please wait...') }}
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

@push('scripts')
    <script>
        function toggleFieldsForClientType() {
            const type = document.querySelector('input[name="type"]:checked').value;
            const registrationCodeField = document.getElementById('registrationCodeField');
            const taxType21Percent = document.getElementById('taxType21Percent');
            const taxTypeSubcontracted = document.getElementById('taxTypeSubcontracted');
            const buildingOlderThanTenYears = document.getElementById('buildingOlderThanTenYears');
            const isNPO = document.getElementById('isNPO');

            if (type === '{{ \App\Enums\EnumClientType::INDIVIDUAL }}') {
                registrationCodeField.style.display = 'none';
                taxTypeSubcontracted.style.display = 'none';
                taxType21Percent.style.display = 'block';
                buildingOlderThanTenYears.style.display = 'block';
                isNPO.style.display = 'none';
            } else {
                registrationCodeField.style.display = 'block';
                taxTypeSubcontracted.style.display = 'block';
                taxType21Percent.style.display = 'none';
                buildingOlderThanTenYears.style.display = 'none';
                isNPO.style.display = 'block';
            }
        }

        document.addEventListener('livewire:load', function () {
            Livewire.hook('message.processed', (message, component) => {
                if (message.name === 'typeUpdated') {
                    document.querySelector('input[name="tax_type"]').checked = false;
                }
            });
        });
    </script>
@endpush
