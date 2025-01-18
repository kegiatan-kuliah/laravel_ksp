<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TransactionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Barryvdh\DomPDF\Facade\Pdf;
/**
 * Class TransactionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TransactionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Transaction::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/transaction');
        CRUD::setEntityNameStrings('transaction', 'transactions');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addButtonFromModelFunction('top', 'export_button', 'export', 'end');
        CRUD::column([
            'name' => 'transaction_date',
            'label' => 'Transaction Date',
            'type' => 'date',
        ]);
        CRUD::column([  // Select
            'label'     => "Member",
            'type'      => 'select',
            'name'      => 'member_id', // the db column for the foreign key
            'entity'    => 'Member',
            'model'     => "App\Models\Member", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                 return $query->orderBy('name', 'Desc')->get();
             })
        ]);
        CRUD::column([
            'name' => 'amount',
            'label' => 'Amount',
            'type' => 'number',
        ]);
        CRUD::column([   // select_from_array
            'name'        => 'transaction_type',
            'label'       => 'Type',
            'type'        => 'select_from_array',
            'options'     => ['deposit' => 'Deposit', 'withdraw' => 'Withdraw','payment' => 'Payment'],
            'allows_null' => false,
            'default'     => 'one',
        ]);
    }

    protected function setupShowOperation()
    {
        CRUD::column([
            'name' => 'transaction_date',
            'label' => 'Transaction Date',
            'type' => 'date',
        ]);
        CRUD::column([  // Select
            'label'     => "Member",
            'type'      => 'select',
            'name'      => 'member_id', // the db column for the foreign key
            'entity'    => 'Member',
            'model'     => "App\Models\Member", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                 return $query->orderBy('name', 'Desc')->get();
             })
        ]);
        CRUD::column([
            'name' => 'amount',
            'label' => 'Amount',
            'type' => 'number',
        ]);
        CRUD::column([   // select_from_array
            'name'        => 'transaction_type',
            'label'       => 'Type',
            'type'        => 'select_from_array',
            'options'     => ['deposit' => 'Deposit', 'withdraw' => 'Withdraw','payment' => 'Payment'],
            'allows_null' => false,
            'default'     => 'one',
        ]);
        CRUD::column([
            'name'  => 'created_at', // The db column name
            'label' => 'Created At', // Table column heading
            'type'  => 'date'
        ]);
        CRUD::column([
            'name'  => 'updated_at', // The db column name
            'label' => 'Updated At', // Table column heading
            'type'  => 'date'
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TransactionRequest::class);
        CRUD::field([  // Select
            'label'     => "Member",
            'type'      => 'select',
            'name'      => 'member_id', // the db column for the foreign key
            'entity'    => 'Member',
            'model'     => "App\Models\Member", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                 return $query->orderBy('name', 'Desc')->get();
             })
        ]);
        CRUD::field([
            'name' => 'transaction_date',
            'label' => 'Transaction Date',
            'type' => 'date',
        ]);
        CRUD::field([
            'name' => 'amount',
            'label' => 'Amount',
            'type' => 'number',
        ]);
        CRUD::field([   // select_from_array
            'name'        => 'transaction_type',
            'label'       => 'Type',
            'type'        => 'select_from_array',
            'options'     => ['deposit' => 'Deposit', 'withdraw' => 'Withdraw','payment' => 'Payment'],
            'allows_null' => false,
            'default'     => 'one',
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function export()
    {
        $transactions = \App\Models\Transaction::orderBy('id','desc')->get();   
        $pdf = Pdf::loadView('export.transaction',['transactions' => $transactions]);
        return $pdf->stream();
    }
}
