<x-default-layout>

    @section('title')
        {{ __('Clients')}}
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('client-management.clients.index') }}
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-client-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="{{ __('Search client') }}" id="mySearchInput"/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-client-table-toolbar="base">
                    <!--begin::Add client-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_client">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        {{ __('Create new client') }}
                    </button>
                    <!--end::Add client-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Modal-->
                <livewire:client.add-client-modal></livewire:client.add-client-modal>
                <!--end::Modal-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            document.getElementById('mySearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['clients-table'].search(this.value).draw();
            });
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_client').modal('hide');
                    window.LaravelDataTables['clients-table'].ajax.reload();
                });
            });
        </script>
    @endpush

</x-default-layout>
