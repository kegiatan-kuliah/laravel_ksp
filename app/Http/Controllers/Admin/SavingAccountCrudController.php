<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SavingAccountRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SavingAccountCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SavingAccountCrudController extends CrudController
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
        CRUD::setModel(\App\Models\SavingAccount::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/saving-account');
        CRUD::setEntityNameStrings('saving account', 'saving accounts');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // set columns from db columns.
        CRUD::column([
            'name' => 'account_number',
            'label' => "Account Number",
            'type'  => 'text',
        ]);
        CRUD::column([
            'name' => 'member.name',
            'label' => "Member",
            'type'  => 'text',
        ]);
        CRUD::column([
            'name' => 'balance',
            'label' => "Balance",
            'type'  => 'text',
        ]);
        CRUD::column([
            'name'        => 'status',
            'label'       => 'Status',
            'type'        => 'select_from_array',
            'options'     => ['active' => 'Active', 'inactive' => 'InActive'],
        ]);
    }

    protected function setupShowOperation()
    {
        CRUD::column([
            'name' => 'account_number',
            'label' => "Account Number",
            'type'  => 'text',
        ]);
        CRUD::column([
            'name' => 'member.name',
            'label' => "Member",
            'type'  => 'text',
        ]);
        CRUD::column([
            'name' => 'balance',
            'label' => "Balance",
            'type'  => 'text',
        ]);
        CRUD::column([
            'name'        => 'status',
            'label'       => 'Status',
            'type'        => 'select_from_array',
            'options'     => ['active' => 'Active', 'inactive' => 'InActive'],
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
        CRUD::setValidation(SavingAccountRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        CRUD::field([   // Number
            'name' => 'account_number',
            'label' => 'Account Number',
            'type' => 'number',
            'min' => 0,
        ]);
        CRUD::field([   // Number
            'name' => 'balance',
            'label' => 'Balance',
            'type' => 'number',
            'min' => 0,
        ]);
        CRUD::field([   // select_from_array
            'name'        => 'status',
            'label'       => 'Status',
            'type'        => 'select_from_array',
            'options'     => ['active' => 'Active', 'inactive' => 'InActive'],
            'allows_null' => false,
            'default'     => 'one',
        ]);
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
}
