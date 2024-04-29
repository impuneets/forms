<?php

namespace App\DataTables;

use App\Models\Athlete;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\HtmlBuilder as HtmlHtmlBuilder;

class AthletesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return '<a href="' . route('athlete.edit', $query->id) . '" class="btn btn-info">Edit</a>';
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 1) {
                    return '<a onclick="updateTableData(event)"><button data-id="' . $query->id . '" class="btn btn-success statusBtn">Active</button></a>';
                } else {
                    return '<a onclick="updateTableData(event)"><button data-id="' . $query->id . '" class="btn btn-danger statusBtn">Inactive</button></a>';
                }
            })
            ->addColumn('register_image', function ($query) {
                return '<img src="' . asset('storage/uploads/' . $query->register_image) . '" width="80" height="80" alt="' . $query->register_image . '">';
            })
            ->addColumn('join_image', function ($query) {
                return '<img src="' . asset('storage/uploads/' . $query->join_image) . '" width="80" height="80" alt="' . $query->join_image . '">';
            })->addColumn('coach_image', function ($query) {
                return '<img src="' . asset('storage/uploads/' . $query->coach_image) . '" width="80" height="80" alt="' . $query->coach_image . '">';
            })
            ->rawColumns(['status', 'action', 'register_image', 'coach_image', 'join_image'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Athlete $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */


    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('athletes-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            // ->dom('Bfrtip')
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
            // Column::make('id'),
            Column::make('title')->sortable()->searchable(),
            Column::make('date')->sortable()->searchable(false),
            Column::make('link')->sortable(false)->searchable(false),
            Column::make('register_image')->sortable(false)->searchable(false),
            Column::make('join_image')->sortable(false)->searchable(false),
            Column::make('level')->sortable(false)->searchable(false),
            Column::make('coach_name')->sortable(false)->searchable(false),
            Column::make('coach_description')->sortable(false)->searchable(false),
            Column::make('coach_image')->sortable(false)->searchable(false),
            Column::make('language')->sortable(false)->searchable(),
            Column::make('session_time')->sortable(false)->searchable(false),
            Column::make('session_label')->sortable(false)->searchable(false),
            Column::make('session_type')->sortable(false)->searchable(false),
            Column::make('description')->sortable(false)->searchable(false),
            Column::make('dos_and_donts')->sortable(false)->searchable(false),
            Column::make('health_details')->sortable(false)->searchable(false),
            Column::make('faqs')->sortable(false)->searchable(false),
            Column::make('status')->sortable(false)->searchable(false),
            Column::make('action')->sortable(false)->searchable(false)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Athletes_' . date('YmdHis');
    }
}
