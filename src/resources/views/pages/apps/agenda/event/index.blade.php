<x-default-layout>
    @section('title')
        Agenda
    @endsection

    @section('breadcrumbs')

    @endsection

        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title fw-bold"></h2>

                        <div class="card-toolbar">
                            <button class="btn btn-flex btn-primary" data-kt-calendar="add">
                                <i class="ki-duotone ki-plus fs-2"></i>
                                {{ __('Add event') }}
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id='kt_calendar_app'></div>
                    </div>
                </div>
            </div>
            <!--end::Content container-->
        </div>

    @push('scripts')
        <script>
            let clients = @json($clients);

            let KTAppCalendar = function () {
                // Calendar variables
                let calendar;
                let data = {
                    id: '',
                    eventClient: '',
                    eventClientID: '',
                    eventName: '',
                    eventDescription: '',
                    eventLocation: '',
                    startDate: '',
                    endDate: '',
                    allDay: false
                };
                let hasEventListener;

                // Add event variables
                let eventClient;
                let eventName;
                let eventDescription;
                let eventLocation;
                let startDatepicker;
                let startFlatpickr;
                let endDatepicker;
                let endFlatpickr;
                let startTimepicker;
                let startTimeFlatpickr;
                let endTimepicker
                let endTimeFlatpickr;
                let modal;
                let modalTitle;
                let form;
                let validator;
                let addButton;
                let submitAddButton;
                let submitEditButton;
                let cancelButton;
                let closeButton;

                // View event variables
                let viewEventClient;
                let viewEventClientID;
                let viewEventName;
                let viewAllDay;
                let viewEventDescription;
                let viewEventLocation;
                let viewStartDate;
                let viewEndDate;
                let viewModal;
                let viewEditButton;
                let viewDeleteButton;


                // Private functions
                let initCalendarApp = function () {
                    // Define variables
                    let calendarEl = document.getElementById('kt_calendar_app');
                    let todayDate = moment().startOf('day');
                    let TODAY = todayDate.format('YYYY-MM-DD');

                    calendar = new FullCalendar.Calendar(calendarEl, {
                        locale: 'pt-br',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        initialDate: TODAY,
                        navLinks: true,
                        selectable: true,
                        selectMirror: true,

                        select: function (arg) {
                            formatArgs(arg);
                            handleNewEvent();
                        },

                        eventClick: function (arg) {
                            formatArgs({
                                id: arg.event.id,
                                client: arg.event.extendedProps.client,
                                client_id: arg.event.extendedProps.client_id,
                                title: arg.event.title,
                                description: arg.event.extendedProps.description,
                                location: arg.event.extendedProps.location,
                                startStr: arg.event.startStr,
                                endStr: arg.event.endStr,
                                allDay: arg.event.allDay
                            });

                            handleViewEvent();
                        },

                        editable: true,
                        dayMaxEvents: true,
                        events: [
                            @foreach($events as $event)
                            {
                                id: {{ $event->id }},
                                client: '{{ $event?->client?->name }}',
                                client_id: '{{ $event?->client?->id }}',
                                title: '{{ $event->name }}',
                                start: '{{ $event->initial_time !== null ? $event->initial_date . 'T' . $event->initial_time : $event->initial_date }}',
                                end: '{{ $event->final_time !== null ? $event->final_date . 'T' . $event->final_time : $event->final_date }}',
                                description: '{{ $event->description }}',
                                location: '{{ $event->address }}',
                                allDay: {{ json_encode($event->final_time === null) }}
                            },
                            @endforeach
                        ]
                    });

                    calendar.render();
                }

                // Init validator
                const initValidator = () => {
                    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                    validator = FormValidation.formValidation(
                        form,
                        {
                            fields: {
                                'name': {
                                    validators: {
                                        notEmpty: {
                                            message: '{{ __('Event name is required') }}'
                                        }
                                    }
                                },
                                'description': {
                                    validators: {
                                        notEmpty: {
                                            message: '{{ __('Description is required') }}'
                                        }
                                    }
                                },
                                'address': {
                                    validators: {
                                        notEmpty: {
                                            message: '{{ __('Location is required') }}'
                                        }
                                    }
                                },
                                'initial_date': {
                                    validators: {
                                        notEmpty: {
                                            message: '{{ __('Initial date is required') }}'
                                        }
                                    }
                                },
                            },

                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap: new FormValidation.plugins.Bootstrap5({
                                    rowSelector: '.fv-row',
                                    eleInvalidClass: '',
                                    eleValidClass: ''
                                })
                            }
                        }
                    );
                }

                // Initialize datepickers --- more info: https://flatpickr.js.org/
                const initDatepickers = () => {
                    startFlatpickr = flatpickr(startDatepicker, {
                        enableTime: false,
                        dateFormat: "Y-m-d",
                    });

                    endFlatpickr = flatpickr(endDatepicker, {
                        enableTime: false,
                        dateFormat: "Y-m-d",
                    });

                    startTimeFlatpickr = flatpickr(startTimepicker, {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                    });

                    endTimeFlatpickr = flatpickr(endTimepicker, {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                    });
                }

                // Handle add button
                const handleAddButton = () => {
                    addButton.addEventListener('click', e => {
                        // Reset form data
                        data = {
                            id: '',
                            eventClient: '',
                            eventClientID: '',
                            eventName: '',
                            eventDescription: '',
                            startDate: new Date(),
                            endDate: new Date(),
                            allDay: false
                        };
                        handleNewEvent();
                    });
                }

                // Handle add new event
                const handleNewEvent = () => {
                    // Update modal title
                    modalTitle.innerText = "{{ __('Add a new event') }}";
                    modal.show();

                    // Select datepicker wrapper elements
                    const datepickerWrappers = form.querySelectorAll('[data-kt-calendar="datepicker"]');

                    // Handle all day toggle
                    const allDayToggle = form.querySelector('#kt_calendar_datepicker_allday');
                    allDayToggle.addEventListener('click', e => {
                        if (e.target.checked) {
                            datepickerWrappers.forEach(dw => {
                                dw.classList.add('d-none');
                            });
                        } else {
                            endFlatpickr.setDate(data.startDate, true, 'Y-m-d');
                            datepickerWrappers.forEach(dw => {
                                dw.classList.remove('d-none');
                            });
                        }
                    });

                    populateForm();

                    // Handle add submit form
                    $(submitEditButton).prop('disabled', true).addClass('d-none');
                    $(submitAddButton).prop('disabled', false).removeClass('d-none').on('click', triggerCreateNewEvent);
                }

                const triggerCreateNewEvent = (allDayToggle) => {
                    // Validate form before submit
                    if (validator) {
                        validator.validate().then(function (status) {
                            if (status === 'Valid') {
                                // Show loading indication
                                submitAddButton.setAttribute('data-kt-indicator', 'on');

                                // Disable submit button whilst loading
                                submitAddButton.disabled = true;

                                setTimeout(function () {
                                    submitAddButton.removeAttribute('data-kt-indicator');
                                    let formData = new FormData(form);

                                    $.ajax({
                                        url: form.action,
                                        type: 'POST',
                                        data: formData,
                                        contentType: false,
                                        processData: false,
                                        success: function (response) {
                                            let event = response.event;

                                            Swal.fire({
                                                text: "{{ __('New event added to calendar!') }}",
                                                icon: "success",
                                                buttonsStyling: false,
                                                confirmButtonText: "{{ __('Ok, got it!') }}",
                                                customClass: {
                                                    confirmButton: "btn btn-primary"
                                                }
                                            }).then(function (result) {
                                                if (result.isConfirmed) {
                                                    modal.hide();

                                                    // Detect if is all day event
                                                    let allDayEvent = false;
                                                    if (allDayToggle.checked) { allDayEvent = true; }
                                                    if (startTimeFlatpickr.selectedDates.length === 0) { allDayEvent = true; }

                                                    // Merge date & time
                                                    let startDateTime = moment(startFlatpickr.selectedDates[0]).format();
                                                    let endDateTime = moment(endFlatpickr.selectedDates[endFlatpickr.selectedDates.length - 1]).format();
                                                    if (!allDayEvent) {
                                                        const startDate = moment(startFlatpickr.selectedDates[0]).format('YYYY-MM-DD');
                                                        const endDate = startDate;
                                                        const startTime = moment(startTimeFlatpickr.selectedDates[0]).format('HH:mm:ss');
                                                        const endTime = moment(endTimeFlatpickr.selectedDates[0]).format('HH:mm:ss');

                                                        startDateTime = startDate + 'T' + startTime;
                                                        endDateTime = endDate + 'T' + endTime;
                                                    }

                                                    // Add new event to calendar
                                                    calendar.addEvent({
                                                        id: event.id,
                                                        title: eventName.value,
                                                        description: eventDescription.value,
                                                        location: eventLocation.value,
                                                        start: startDateTime,
                                                        end: endDateTime,
                                                        allDay: allDayEvent
                                                    });
                                                    calendar.render();

                                                    form.reset();
                                                    $(eventClient).val(null).trigger('change');

                                                    submitAddButton.disabled = false;
                                                }
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

                                            submitAddButton.disabled = false;
                                        }
                                    });
                                }, 500);
                            } else {
                                Swal.fire({
                                    text: "{{ __('Sorry, some required fields are missing.') }}",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('Ok, got it!') }}",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        });
                    }
                }

                // Handle edit event
                const handleEditEvent = () => {
                    // Update modal title
                    modalTitle.innerText = "{{ __('Edit an event') }}";
                    setTimeout(() => {
                        modal.show();
                    }, 500);

                    // Select datepicker wrapper elements
                    const datepickerWrappers = form.querySelectorAll('[data-kt-calendar="datepicker"]');

                    // Handle all day toggle
                    const allDayToggle = form.querySelector('#kt_calendar_datepicker_allday');
                    allDayToggle.addEventListener('click', e => {
                        if (e.target.checked) {
                            datepickerWrappers.forEach(dw => {
                                dw.classList.add('d-none');
                            });
                        } else {
                            endFlatpickr.setDate(data.startDate, true, 'Y-m-d');
                            datepickerWrappers.forEach(dw => {
                                dw.classList.remove('d-none');
                            });
                        }
                    });

                    populateForm();

                    // Handle submit form
                    $(submitAddButton).prop('disabled', true).addClass('d-none');
                    $(submitEditButton).prop('disabled', false).removeClass('d-none').on('click', triggerEditEvent);
                }

                const triggerEditEvent = (allDayToggle) => {
                    // Validate form before submit
                    if (validator) {
                        validator.validate().then(function (status) {
                            if (status === 'Valid') {
                                // Show loading indication
                                submitAddButton.setAttribute('data-kt-indicator', 'on');

                                // Disable submit button whilst loading
                                submitAddButton.disabled = true;

                                const eventId = data.id;
                                const formData = new FormData(form);
                                formData.append('_method', 'PUT');

                                $.ajax({
                                    url: `/agenda/event/${eventId}`,
                                    type: 'POST',
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function (response) {
                                        // Detect if is all day event
                                        let allDayEvent = false;
                                        if (allDayToggle.checked) { allDayEvent = true; }
                                        if (startTimeFlatpickr.selectedDates.length === 0) { allDayEvent = true; }

                                        // Merge date & time
                                        let startDateTime = moment(startFlatpickr.selectedDates[0]).format();
                                        let endDateTime = moment(endFlatpickr.selectedDates[endFlatpickr.selectedDates.length - 1]).format();
                                        if (!allDayEvent) {
                                            const startDate = moment(startFlatpickr.selectedDates[0]).format('YYYY-MM-DD');
                                            const endDate = startDate;
                                            const startTime = moment(startTimeFlatpickr.selectedDates[0]).format('HH:mm:ss');
                                            const endTime = moment(endTimeFlatpickr.selectedDates[0]).format('HH:mm:ss');

                                            startDateTime = startDate + 'T' + startTime;
                                            endDateTime = endDate + 'T' + endTime;
                                        }

                                        calendar.getEventById(eventId).remove();
                                        calendar.addEvent({
                                            id: eventId,
                                            title: response.name,
                                            description: response.description,
                                            location: response.location,
                                            start: startDateTime,
                                            end: endDateTime,
                                            allDay: allDayEvent
                                        });
                                        calendar.render();

                                        modal.hide();
                                        form.reset();
                                        $(eventClient).val(null).trigger('change');

                                        Swal.fire({
                                            text: "{{ __('Event updated successfully!') }}",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "{{ __('Ok, got it!') }}",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        });
                                    },
                                    error: function (xhr, status, error) {
                                        Swal.fire({
                                            text: xhr.responseJSON.message,
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "{{ __('Ok, got it!') }}",
                                            customClass: {
                                                confirmButton: "btn btn-primary",
                                            }
                                        });
                                    },
                                    complete: function () {
                                        submitAddButton.removeAttribute('data-kt-indicator');
                                        submitAddButton.disabled = false;
                                    }
                                });
                            } else {
                                Swal.fire({
                                    text: "{{ __('Sorry, looks like there are some errors detected, please try again.') }}",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('Ok, got it!') }}",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        });
                    }
                }

                // Handle view event
                const handleViewEvent = () => {
                    viewModal.show();

                    // Detect all day event
                    let eventNameMod;
                    let startDateMod;
                    let endDateMod;

                    // Generate labels
                    if (data.allDay) {
                        eventNameMod = '{{ __('All day') }}';
                        startDateMod = moment(data.startDate).format('Do MMM, YYYY');
                        endDateMod = moment(data.endDate).format('Do MMM, YYYY');
                    } else {
                        eventNameMod = '';
                        startDateMod = moment(data.startDate).format('Do MMM, YYYY - h:mm a');
                        endDateMod = moment(data.endDate).format('Do MMM, YYYY - h:mm a');
                    }

                    // Populate view data
                    viewEventClient.innerText = data.eventClient ? data.eventClient : '--';
                    viewEventClientID.innerText = data.eventClientID ? data.eventClientID : '';
                    viewEventName.innerText = data.eventName;
                    viewAllDay.innerText = eventNameMod;
                    viewEventDescription.innerText = data.eventDescription;
                    viewEventLocation.innerText = data.eventLocation ? data.eventLocation : '--';
                    viewStartDate.innerText = startDateMod;
                    viewEndDate.innerText = data.endDate ? endDateMod : '--';
                }

                // Handle delete event
                const handleDeleteEvent = () => {
                    viewDeleteButton.addEventListener('click', e => {
                        e.preventDefault();

                        Swal.fire({
                            text: "{{ __('Are you sure you would like to delete this event?') }}",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "{{ __('Yes, delete it!') }}",
                            cancelButtonText: "{{ __('No, return') }}",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                const eventId = data.id;
                                const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

                                $.ajax({
                                    url: `/agenda/event/${eventId}`,
                                    type: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    success: function (response) {
                                        calendar.getEventById(eventId).remove();
                                        viewModal.hide();
                                        Swal.fire({
                                            text: "{{ __('Event has been deleted.') }}",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "{{ __('Ok, got it!') }}",
                                            customClass: {
                                                confirmButton: "btn btn-primary",
                                            }
                                        });
                                    },
                                    error: function (xhr, status, error) {
                                        Swal.fire({
                                            text: "{{ __('Error deleting the event.') }}",
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
                };

                // Handle edit button
                const handleEditButton = () => {
                    viewEditButton.addEventListener('click', e => {
                        e.preventDefault();

                        viewModal.hide();
                        handleEditEvent();
                    });
                }

                // Handle cancel button
                const handleCancelButton = () => {
                    // Edit event modal cancel button
                    cancelButton.addEventListener('click', function (e) {
                        e.preventDefault();

                        Swal.fire({
                            text: "{{ __('Are you sure you would like to cancel?') }}",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "{{ __('Yes, cancel it!') }}",
                            cancelButtonText: "{{ __('No, return') }}",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                form.reset();
                                $(eventClient).val(null).trigger('change');
                                modal.hide();
                            }
                        });
                    });
                }

                // Handle close button
                const handleCloseButton = () => {
                    // Edit event modal close button
                    closeButton.addEventListener('click', function (e) {
                        e.preventDefault();

                        Swal.fire({
                            text: "{{ __('Are you sure you would like to cancel?') }}",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "{{ __('Yes, cancel it!') }}",
                            cancelButtonText: "{{ __('No, return') }}",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                form.reset();
                                $(eventClient).val(null).trigger('change');
                                modal.hide();
                            }
                        });
                    });
                }

                // Reset form validator on modal close
                const resetFormValidator = (element) => {
                    // Target modal hidden event --- For more info: https://getbootstrap.com/docs/5.0/components/modal/#events
                    element.addEventListener('hidden.bs.modal', e => {
                        if (validator) {
                            // Reset form validator. For more info: https://formvalidation.io/guide/api/reset-form
                            validator.resetForm(true);
                        }
                    });
                }

                // Populate form
                const populateForm = () => {
                    eventName.value = data.eventName ? data.eventName : '';
                    eventDescription.value = data.eventDescription ? data.eventDescription : '';
                    eventLocation.value = data.eventLocation ? data.eventLocation : '';
                    startFlatpickr.setDate(data.startDate, true, 'Y-m-d');
                    $(eventClient).val(data.eventClientID).trigger('change');

                    // Handle null end dates
                    const endDate = data.endDate ? data.endDate : moment(data.startDate).format();
                    endFlatpickr.setDate(endDate, true, 'Y-m-d');

                    const allDayToggle = form.querySelector('#kt_calendar_datepicker_allday');
                    const datepickerWrappers = form.querySelectorAll('[data-kt-calendar="datepicker"]');
                    if (data.allDay) {
                        allDayToggle.checked = true;
                        datepickerWrappers.forEach(dw => {
                            dw.classList.add('d-none');
                        });
                    } else {
                        startTimeFlatpickr.setDate(data.startDate, true, 'Y-m-d H:i');
                        endTimeFlatpickr.setDate(data.endDate, true, 'Y-m-d H:i');
                        endFlatpickr.setDate(data.startDate, true, 'Y-m-d');
                        allDayToggle.checked = false;
                        datepickerWrappers.forEach(dw => {
                            dw.classList.remove('d-none');
                        });
                    }
                }

                // Format FullCalendar reponses
                const formatArgs = (res) => {
                    data.id = res.id;
                    data.eventClient = res.client;
                    data.eventClientID = res.client_id;
                    data.eventName = res.title;
                    data.eventDescription = res.description;
                    data.eventLocation = res.location;
                    data.startDate = res.startStr;
                    data.endDate = res.endStr;
                    data.allDay = res.allDay;
                }

                return {
                    // Public Functions
                    init: function () {
                        // Define variables
                        // Add event modal
                        const element = document.getElementById('kt_modal_add_event');
                        form = element.querySelector('#kt_modal_add_event_form');
                        eventClient = form.querySelector('[name="client_id"]');
                        eventName = form.querySelector('[name="name"]');
                        eventDescription = form.querySelector('[name="description"]');
                        eventLocation = form.querySelector('[name="address"]');
                        startDatepicker = form.querySelector('#kt_calendar_datepicker_start_date');
                        endDatepicker = form.querySelector('#kt_calendar_datepicker_end_date');
                        startTimepicker = form.querySelector('#kt_calendar_datepicker_start_time');
                        endTimepicker = form.querySelector('#kt_calendar_datepicker_end_time');
                        addButton = document.querySelector('[data-kt-calendar="add"]');
                        submitAddButton = form.querySelector('#kt_modal_add_event_submit');
                        submitEditButton = form.querySelector('#kt_modal_edit_event_submit');
                        cancelButton = form.querySelector('#kt_modal_add_event_cancel');
                        closeButton = element.querySelector('#kt_modal_add_event_close');
                        modalTitle = form.querySelector('[data-kt-calendar="title"]');
                        modal = new bootstrap.Modal(element);

                        clients.forEach(function (client) {
                            let option = document.createElement('option');
                            option.value = client.id;
                            option.text = client.name;
                            option.setAttribute('data-address', client.address);
                            eventClient.appendChild(option);
                        });

                        // View event modal
                        const viewElement = document.getElementById('kt_modal_view_event');
                        viewModal = new bootstrap.Modal(viewElement);
                        viewEventName = viewElement.querySelector('[data-kt-calendar="event_name"]');
                        viewEventClient = viewElement.querySelector('[data-kt-calendar="event_client"]');
                        viewEventClientID = viewElement.querySelector('[data-kt-calendar="event_client_id"]');
                        viewAllDay = viewElement.querySelector('[data-kt-calendar="all_day"]');
                        viewEventDescription = viewElement.querySelector('[data-kt-calendar="event_description"]');
                        viewEventLocation = viewElement.querySelector('[data-kt-calendar="event_location"]');
                        viewStartDate = viewElement.querySelector('[data-kt-calendar="event_start_date"]');
                        viewEndDate = viewElement.querySelector('[data-kt-calendar="event_end_date"]');
                        viewEditButton = viewElement.querySelector('#kt_modal_view_event_edit');
                        viewDeleteButton = viewElement.querySelector('#kt_modal_view_event_delete');

                        initCalendarApp();
                        initValidator();
                        initDatepickers();
                        handleEditButton();
                        handleAddButton();
                        handleDeleteEvent();
                        handleCancelButton();
                        handleCloseButton();
                        resetFormValidator(element);
                    }
                };
            }();

            // On document ready
            KTUtil.onDOMContentLoaded(function () {
                KTAppCalendar.init();

                const element = document.getElementById('kt_modal_add_event');
                const form = element.querySelector('#kt_modal_add_event_form');
                let eventClient = form.querySelector('[name="client_id"]');
                let eventLocation = form.querySelector('[name="address"]');

                $(eventClient).on('select2:select', function (e) {
                    eventLocation.value = e.params.data.element.getAttribute('data-address');
                });
            });
        </script>
    @endpush
</x-default-layout>
