
<!--begin::Modal - View event-->
<div class="modal fade" id="kt_modal_view_event" tabindex="-1" data-bs-focus="false" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header border-0 justify-content-end">
                <!--begin::Edit-->
                <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Edit Event" id="kt_modal_view_event_edit">
                    <i class="ki-duotone ki-pencil fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Edit-->
                <!--begin::Edit-->
                <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-danger me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Delete Event" id="kt_modal_view_event_delete">
                    <i class="ki-duotone ki-trash fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                    </i>
                </div>
                <!--end::Edit-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary" data-bs-toggle="tooltip" title="Hide Event" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-2x">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body pt-0 pb-20 px-lg-17">
                <!--begin::Row-->
                <div class="d-flex">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-calendar-8 fs-1 text-muted me-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                        <span class="path6"></span>
                    </i>
                    <!--end::Icon-->
                    <div class="mb-9">
                        <!--begin::Event name-->
                        <div class="d-flex align-items-center mb-2">
                            <span class="fs-3 fw-bold me-3" data-kt-calendar="event_name"></span>
                            <span class="badge badge-light-success" data-kt-calendar="all_day"></span>
                        </div>
                        <!--end::Event name-->
                        <!--begin::Event description-->
                        <div class="fs-6" data-kt-calendar="event_description"></div>
                        <!--end::Event description-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="d-flex align-items-center mb-2">
                    <!--begin::Bullet-->
                    <span class="bullet bullet-dot h-10px w-10px bg-success ms-2 me-7"></span>
                    <!--end::Bullet-->
                    <!--begin::Event start date/time-->
                    <div class="fs-6">
                        <span class="fw-bold">Starts</span>
                        <span data-kt-calendar="event_start_date"></span>
                    </div>
                    <!--end::Event start date/time-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="d-flex align-items-center mb-9">
                    <!--begin::Bullet-->
                    <span class="bullet bullet-dot h-10px w-10px bg-danger ms-2 me-7"></span>
                    <!--end::Bullet-->
                    <!--begin::Event end date/time-->
                    <div class="fs-6">
                        <span class="fw-bold">Ends</span>
                        <span data-kt-calendar="event_end_date"></span>
                    </div>
                    <!--end::Event end date/time-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="d-flex align-items-center">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-geolocation fs-1 text-muted me-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <!--end::Icon-->
                    <!--begin::Event location-->
                    <div class="fs-6" data-kt-calendar="event_location"></div>
                    <!--end::Event location-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Modal body-->
        </div>
    </div>
</div>
<!--end::Modal - View event-->
