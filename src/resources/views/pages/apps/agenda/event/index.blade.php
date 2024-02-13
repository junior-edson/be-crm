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
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
        <script>
            let KTAppCalendar = function () {
                // Calendar variables
                let calendar;
                let data = {
                    id: '',
                    eventName: '',
                    eventDescription: '',
                    eventLocation: '',
                    startDate: '',
                    endDate: '',
                    allDay: false
                };

                // Add event variables
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
                let submitButton;
                let cancelButton;
                let closeButton;

                // View event variables
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
                    let YM = todayDate.format('YYYY-MM');
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
                            {
                                id: uid(),
                                title: 'All Day Event',
                                start: YM + '-01',
                                end: YM + '-02',
                                description: 'Toto lorem ipsum dolor sit incid idunt ut',
                                className: "border-success bg-success text-inverse-success",
                                location: 'Federation Square'
                            }
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
                                'calendar_event_name': {
                                    validators: {
                                        notEmpty: {
                                            message: '{{ __('Event name is required') }}'
                                        }
                                    }
                                },
                                'calendar_event_start_date': {
                                    validators: {
                                        notEmpty: {
                                            message: '{{ __('Start date is required') }}'
                                        }
                                    }
                                },
                                'calendar_event_end_date': {
                                    validators: {
                                        notEmpty: {
                                            message: '{{ __('End date is required') }}'
                                        }
                                    }
                                }
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
                        enableTime: true,
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

                    populateForm(data);

                    // Handle submit form
                    submitButton.addEventListener('click', function (e) {
                        // Prevent default button action
                        e.preventDefault();

                        // Validate form before submit
                        if (validator) {
                            validator.validate().then(function (status) {
                                if (status === 'Valid') {
                                    // Show loading indication
                                    submitButton.setAttribute('data-kt-indicator', 'on');

                                    // Disable submit button whilst loading
                                    submitButton.disabled = true;

                                    // Simulate form submission
                                    setTimeout(function () {
                                        // Simulate form submission
                                        submitButton.removeAttribute('data-kt-indicator');

                                        // Show popup confirmation
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

                                                // Enable submit button after loading
                                                submitButton.disabled = false;

                                                // Detect if is all day event
                                                let allDayEvent = false;
                                                if (allDayToggle.checked) { allDayEvent = true; }
                                                if (startTimeFlatpickr.selectedDates.length === 0) { allDayEvent = true; }

                                                // Merge date & time
                                                var startDateTime = moment(startFlatpickr.selectedDates[0]).format();
                                                var endDateTime = moment(endFlatpickr.selectedDates[endFlatpickr.selectedDates.length - 1]).format();
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
                                                    id: uid(),
                                                    title: eventName.value,
                                                    description: eventDescription.value,
                                                    location: eventLocation.value,
                                                    start: startDateTime,
                                                    end: endDateTime,
                                                    allDay: allDayEvent
                                                });
                                                calendar.render();

                                                // Reset form for demo purposes only
                                                form.reset();
                                            }
                                        });

                                        //form.submit(); // Submit form
                                    }, 2000);
                                } else {
                                    // Show popup warning
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
                    });
                }

                // Handle edit event
                const handleEditEvent = () => {
                    // Update modal title
                    modalTitle.innerText = "{{ __('Edit an Event') }}";
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

                    populateForm(data);

                    // Handle submit form
                    submitButton.addEventListener('click', function (e) {
                        // Prevent default button action
                        e.preventDefault();

                        // Validate form before submit
                        if (validator) {
                            validator.validate().then(function (status) {
                                if (status === 'Valid') {
                                    // Show loading indication
                                    submitButton.setAttribute('data-kt-indicator', 'on');

                                    // Disable submit button whilst loading
                                    submitButton.disabled = true;

                                    // Simulate form submission
                                    setTimeout(function () {
                                        // Simulate form submission
                                        submitButton.removeAttribute('data-kt-indicator');

                                        // Show popup confirmation
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

                                                // Enable submit button after loading
                                                submitButton.disabled = false;

                                                // Remove old event
                                                calendar.getEventById(data.id).remove();

                                                // Detect if is all day event
                                                let allDayEvent = false;
                                                if (allDayToggle.checked) { allDayEvent = true; }
                                                if (startTimeFlatpickr.selectedDates.length === 0) { allDayEvent = true; }

                                                // Merge date & time
                                                var startDateTime = moment(startFlatpickr.selectedDates[0]).format();
                                                var endDateTime = moment(endFlatpickr.selectedDates[endFlatpickr.selectedDates.length - 1]).format();
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
                                                    id: uid(),
                                                    title: eventName.value,
                                                    description: eventDescription.value,
                                                    location: eventLocation.value,
                                                    start: startDateTime,
                                                    end: endDateTime,
                                                    allDay: allDayEvent
                                                });
                                                calendar.render();

                                                // Reset form for demo purposes only
                                                form.reset();
                                            }
                                        });

                                        //form.submit(); // Submit form
                                    }, 2000);
                                } else {
                                    // Show popup warning
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
                    });
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
                        eventNameMod = 'All Day';
                        startDateMod = moment(data.startDate).format('Do MMM, YYYY');
                        endDateMod = moment(data.endDate).format('Do MMM, YYYY');
                    } else {
                        eventNameMod = '';
                        startDateMod = moment(data.startDate).format('Do MMM, YYYY - h:mm a');
                        endDateMod = moment(data.endDate).format('Do MMM, YYYY - h:mm a');
                    }

                    // Populate view data
                    viewEventName.innerText = data.eventName;
                    viewAllDay.innerText = eventNameMod;
                    viewEventDescription.innerText = data.eventDescription ? data.eventDescription : '--';
                    viewEventLocation.innerText = data.eventLocation ? data.eventLocation : '--';
                    viewStartDate.innerText = startDateMod;
                    viewEndDate.innerText = endDateMod;
                }

                // Handle delete event
                const handleDeleteEvent = () => {
                    viewDeleteButton.addEventListener('click', e => {
                        e.preventDefault();

                        Swal.fire({
                            text: "Are you sure you would like to delete this event?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                calendar.getEventById(data.id).remove();

                                viewModal.hide(); // Hide modal
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: "Your event was not deleted!.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });
                            }
                        });
                    });
                }

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
                            text: "Are you sure you would like to cancel?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes, cancel it!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                form.reset(); // Reset form
                                modal.hide(); // Hide modal
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: "Your form has not been cancelled!.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });
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
                            text: "Are you sure you would like to cancel?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes, cancel it!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                form.reset(); // Reset form
                                modal.hide(); // Hide modal
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: "Your form has not been cancelled!.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });
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
                    data.eventName = res.title;
                    data.eventDescription = res.description;
                    data.eventLocation = res.location;
                    data.startDate = res.startStr;
                    data.endDate = res.endStr;
                    data.allDay = res.allDay;
                }

                // Generate unique IDs for events
                const uid = () => {
                    return Date.now().toString() + Math.floor(Math.random() * 1000).toString();
                }

                return {
                    // Public Functions
                    init: function () {
                        // Define variables
                        // Add event modal
                        const element = document.getElementById('kt_modal_add_event');
                        form = element.querySelector('#kt_modal_add_event_form');
                        eventName = form.querySelector('[name="calendar_event_name"]');
                        eventDescription = form.querySelector('[name="calendar_event_description"]');
                        eventLocation = form.querySelector('[name="calendar_event_location"]');
                        startDatepicker = form.querySelector('#kt_calendar_datepicker_start_date');
                        endDatepicker = form.querySelector('#kt_calendar_datepicker_end_date');
                        startTimepicker = form.querySelector('#kt_calendar_datepicker_start_time');
                        endTimepicker = form.querySelector('#kt_calendar_datepicker_end_time');
                        addButton = document.querySelector('[data-kt-calendar="add"]');
                        submitButton = form.querySelector('#kt_modal_add_event_submit');
                        cancelButton = form.querySelector('#kt_modal_add_event_cancel');
                        closeButton = element.querySelector('#kt_modal_add_event_close');
                        modalTitle = form.querySelector('[data-kt-calendar="title"]');
                        modal = new bootstrap.Modal(element);

                        // View event modal
                        const viewElement = document.getElementById('kt_modal_view_event');
                        viewModal = new bootstrap.Modal(viewElement);
                        viewEventName = viewElement.querySelector('[data-kt-calendar="event_name"]');
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
            });
        </script>
    @endpush
</x-default-layout>
