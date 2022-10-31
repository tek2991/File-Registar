<?php

namespace App\Http\Livewire;

use App\Models\Movement;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class MovementTable extends PowerGridComponent
{
    use ActionButton;

    public $fileId;
    public string $sortField = 'id';
    public string $sortDirection = 'desc';

    public function __construct($fileId)
    {
        $this->fileId = $fileId;
    }


    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Movement>
     */
    public function datasource(): Builder
    {
        $query = Movement::query();

        if ($this->fileId !== null && $this->fileId !== '') {
            $query->where('file_id', $this->fileId);
        }

        return $query->with('file');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            'file' => ['name', 'file_number'],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('office_id')
            ->addColumn('office_name', function (Movement $model) {
                return e($model->office->name);
            })
            ->addColumn('file_id')
            ->addColumn('file_name', function (Movement $model) {
                return e($model->file->name);
            })
            ->addColumn('file_number', function (Movement $model) {
                return e($model->file->file_number);
            })
            ->addColumn('from_office_id')
            ->addColumn('from_office_name', function (Movement $model) {
                return e($model->fromOffice->name);
            })
            ->addColumn('to_office_id')
            ->addColumn('to_office_name', function (Movement $model) {
                return e($model->toOffice->name);
            })
            ->addColumn('dispatched_at')
            ->addColumn('dispatched_at_formatted', fn (Movement $model) => $model->dispatched_at ? Carbon::parse($model->dispatched_at)->format('d/m/Y H:i') : 'NA')
            ->addColumn('received_at')
            ->addColumn('received_at_formatted', fn (Movement $model) => $model->received_at ? Carbon::parse($model->received_at)->format('d/m/Y H:i') : 'NA')
            ->addColumn('user_id')
            ->addColumn('user_name', function (Movement $model) {
                return e($model->user->name);
            })
            ->addColumn('created_at_formatted', fn (Movement $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i'))
            ->addColumn('created_at_formatted', fn (Movement $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i'))
            ->addColumn('updated_at_formatted', fn (Movement $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i'))
            ->addColumn('remarks');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('RECORDING OFFICE', 'office_name', 'office_id')
                ->sortable()
                ->searchable()
                ->makeInputSelect(\App\Models\Office::all(), 'name', 'office_id'),

            Column::make('FILE', 'file_name', 'file_id')
                ->sortable()
                ->searchable(),

            Column::make('FILE NUMBER', 'file_number', 'file_id')
                ->sortable()
                ->searchable(),

            Column::make('FROM OFFICE', 'from_office_name', 'from_office_id')
                ->sortable()
                ->searchable(),

            Column::make('TO OFFICE', 'to_office_name', 'to_office_id')
                ->sortable()
                ->searchable(),

            Column::make('DISPATCHED AT', 'dispatched_at_formatted', 'dispatched_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('RECEIVED AT', 'received_at_formatted', 'received_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('REMARKS', 'remarks')
                ->searchable(),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Movement Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('movement.edit', ['movement' => 'id']),

            /*
           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('movement.destroy', ['movement' => 'id'])
               ->method('delete')
               */
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Movement Action Rules.
     *
     * @return array<int, RuleActions>
     */

    
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($movement) => $movement->received_at || null && $movement->user_id != auth()->user()->id)
                ->hide(),
        ];
    }
    
}
