
<!--begin::Modal - New Product-->
<div class="modal fade" id="kt_modal_add_event" tabindex="-1" aria-hidden="true" data-bs-focus="false">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="#" id="kt_modal_add_event_form">
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
                        <label class="fs-6 fw-semibold required mb-2">{{ __('Event name') }}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_name" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-9">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold mb-2">{{ __('Description') }}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_description" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-9">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold mb-2">{{ __('Location') }}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_location" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-9">
                        <!--begin::Checkbox-->
                        <label class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="" id="kt_calendar_datepicker_allday" />
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
                                <label class="fs-6 fw-semibold mb-2 required">{{ __('Data inicial') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" name="calendar_event_start_date" placeholder="Pick a start date" id="kt_calendar_datepicker_start_date" />
                                <!--end::Input-->
                            </div>
                        </div>
                        <div class="col" data-kt-calendar="datepicker">
                            <div class="fv-row mb-9">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold mb-2">{{ __('Hora inicial') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" name="calendar_event_start_time" placeholder="Pick a start time" id="kt_calendar_datepicker_start_time" />
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
                                <label class="fs-6 fw-semibold mb-2 required">{{ __('Data final') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" name="calendar_event_end_date" placeholder="Pick a end date" id="kt_calendar_datepicker_end_date" />
                                <!--end::Input-->
                            </div>
                        </div>
                        <div class="col" data-kt-calendar="datepicker">
                            <div class="fv-row mb-9">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold mb-2">{{ __('Hora final') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" name="calendar_event_end_time" placeholder="Pick a end time" id="kt_calendar_datepicker_end_time" />
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
                    <button type="button" id="kt_modal_add_event_submit" class="btn btn-primary">
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
