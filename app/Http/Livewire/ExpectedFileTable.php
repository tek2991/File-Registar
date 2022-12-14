<?php

namespace App\Http\Livewire;

use App\Models\File;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class ExpectedFileTable extends PowerGridComponent
{
    use ActionButton;

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
     * @return Builder<\App\Models\File>
     */
    public function datasource(): Builder
    {
        // Get the users office
        $office = auth()->user()->office;
        // Get the expected file ids for the users office
        $expectedFileIds = $office->expected_file_ids();
        return File::query()
            ->whereIn('files.id', $expectedFileIds)
            ->join('offices as parent_office', 'files.parent_office_id', '=', 'parent_office.id')
            ->join('offices as current_office', 'files.current_office_id', '=', 'current_office.id')
            ->join('movements', 'files.movement_id', '=', 'movements.id')
            ->select('files.*', 'parent_office.name as parent_office_name', 'current_office.name as current_office_name', 'movements.dispatched_at as dispatched_at');
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
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ??? IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('file_number')
            ->addColumn('file_link', function (File $file) {
                // Create an a tag with the file number as the link text
                return "<a href='" . route('file.show', [$file->id]) . "' target='' class='hover:underline text-blue-600'>{$file->file_number}</a>";
            })

            /** Example of custom column using a closure **/
            ->addColumn('name_lower', function (File $model) {
                return strtolower(e($model->name));
            })

            ->addColumn('parent_office_id')
            ->addColumn('parent_office_name')
            ->addColumn('current_office_id')
            ->addColumn('current_office_name')
            ->addColumn('dispatched_at')
            ->addColumn('dispatched_at_formatted', fn (File $file) => Carbon::parse($file->dispatched_at)->format('d/m/Y H:i'))
            ->addColumn('created_at_formatted', fn (File $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i'))
            ->addColumn('updated_at_formatted', fn (File $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i'));
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
            Column::make('FILE NAME', 'name')
                ->sortable()
                ->searchable(),

            Column::make('FILE NUMBER', 'file_link', 'file_number')
                ->sortable()
                ->searchable(),

            Column::make('PARENT OFFICE', 'parent_office_name', 'parent_office_id')
                ->sortable()
                ->searchable(),

            Column::make('DISPATCHED AT', 'dispatched_at_formatted', 'dispatched_at')
                ->makeInputDatePicker(),
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
     * PowerGrid File Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('edit', 'Receive')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('file.receive.update', ['file' => 'id'])
                ->method('PUT')
                ->target(''),

            /*
           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('file.destroy', ['file' => 'id'])
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
     * PowerGrid File Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($file) => $file->id === 1)
                ->hide(),
        ];
    }
    */
}
