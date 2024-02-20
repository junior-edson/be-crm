<?php

namespace App\DataTables;

use App\Models\Client;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ClientsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->rawColumns(['type', 'tax_type', 'is_npo', 'is_building_older_than_10_years'])
            ->editColumn('name', function (Client $client) {
                return $client->name;
            })
            ->editColumn('registration_code', function (Client $client) {
                return $client->registration_code;
            })
            ->editColumn('type', function (Client $client) {
                return sprintf('<div class="badge badge-light fw-bold">%s</div>', $client->type);
            })
            ->editColumn('tax_type', function (Client $client) {
                return sprintf('<div class="badge badge-light fw-bold">%s</div>', $client->tax_type);
            })
            ->editColumn('is_npo', function (Client $client) {
                return sprintf('<div class="badge badge-light fw-bold">%s</div>', $client->is_npo ? 'Yes' : 'No');
            })
            ->editColumn('is_building_older_than_10_years', function (Client $client) {
                return sprintf('<div class="badge badge-light fw-bold">%s</div>', $client->is_building_older_than_10_years ? 'Yes' : 'No');
            })
            ->editColumn('address', function (Client $client) {
                return $client->address;
            })
            ->editColumn('phone', function (Client $client) {
                return $client->phone;
            })
            ->editColumn('email', function (Client $client) {
                return $client->email;
            })
            ->addColumn('action', function (Client $client) {
                return view('pages/apps.client-management.clients.columns._actions', compact('client'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Client $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('clients-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/pages/apps/client-management/clients/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('type')->title('Type'),
            Column::make('name')->title('Name'),
            Column::make('registration_code')->title('Registration'),
            Column::make('tax_type')->title('Tax type'),
            Column::make('is_npo')->title('NPO'),
            Column::make('is_building_older_than_10_years')->title('+10 years'),
            Column::make('address')->title('Address'),
            Column::make('phone')->title('Phone'),
            Column::make('email')->title('Email'),
            Column::computed('action')
                ->addClass('text-end text-nowrap')
                ->exportable(false)
                ->printable(false)
                ->width(60)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Clients_' . date('YmdHis');
    }
}
