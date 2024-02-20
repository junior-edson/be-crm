
<!--begin::Modal - New Product-->
<div class="modal fade" id="kt_modal_add_event" tabindex="-1" aria-hidden="true" data-bs-focus="false">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="{{ route('agenda.event.store') }}" id="kt_modal_add_event_form">
                @csrf
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" data-kt-calendar="title">{{ __('Add event') }}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" id="kt_modal_add_event_close">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Input group-->
                    <div class="fv-row mb-9">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold mb-2">{{ __('Client') }}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select name="client_id" aria-label="{{ __('Select a client...') }}" data-control="select2" data-placeholder="{{ __('Select a client...') }}" class="form-select form-select-solid form-select-lg">
                            <option value="">{{ __('Select a client...') }}</option>
                        </select>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-9">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold required mb-2">{{ __('Event name') }}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" placeholder="" name="name" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-9">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold required mb-2">{{ __('Description') }}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" placeholder="" name="description" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-9">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold required mb-2">{{ __('Location') }}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" placeholder="" name="address" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-9">
                        <!--begin::Checkbox-->
                        <label class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" id="kt_calendar_datepicker_allday" name="allday" />
                            <span class="form-check-label fw-semibold" for="kt_calendar_datepicker_allday">{{ __('All day') }}</span>
                        </label>
                        <!--end::Checkbox-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row row-cols-lg-2 g-10">
                        <div class="col">
                            <div class="fv-row mb-9">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold mb-2 required">{{ __('Initial date') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" name="initial_date" placeholder="Pick a start date" id="kt_calendar_datepicker_start_date" />
                                <!--end::Input-->
                            </div>
                        </div>
                        <div class="col" data-kt-calendar="datepicker">
                            <div class="fv-row mb-9">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold mb-2 required">{{ __('Initial time') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" name="initial_time" placeholder="Pick a start time" id="kt_calendar_datepicker_start_time" />
                                <!--end::Input-->
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row row-cols-lg-2 g-10">
                        <div class="col">
                            <div class="fv-row mb-9">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold mb-2 required">{{ __('Final date') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" name="final_date" placeholder="Pick a end date" id="kt_calendar_datepicker_end_date" />
                                <!--end::Input-->
                            </div>
                        </div>
                        <div class="col" data-kt-calendar="datepicker">
                            <div class="fv-row mb-9">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold mb-2 required">{{ __('Final time') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" name="final_time" placeholder="Pick a end time" id="kt_calendar_datepicker_end_time" />
                                <!--end::Input-->
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_add_event_cancel" class="btn btn-light me-3">{{ __('Cancel') }}</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_add_event_submit" class="btn btn-primary d-none" disabled>
                        <span class="indicator-label">{{ __('Submit') }}</span>
                        <span class="indicator-progress">
                            {{ __('Please wait...') }}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_edit_event_submit" class="btn btn-primary d-none" disabled>
                        <span class="indicator-label">{{ __('Submit') }}</span>
                        <span class="indicator-progress">
                            {{ __('Please wait...') }}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - New Product-->
