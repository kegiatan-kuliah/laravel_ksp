<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LoanRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LoanCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LoanCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Loan::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/loan');
        CRUD::setEntityNameStrings('loan', 'loans');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
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
            'name' => 'application_date',
            'label' => 'Application Date',
            'type' => 'date',
        ]);
        CRUD::column([
            'name' => 'due_date',
            'label' => 'Due Date',
            'type' => 'date',
        ]);
        CRUD::column([   // Number
            'name' => 'loan_amount',
            'label' => 'Loan Amount',
            'type' => 'number',
            'min' => 0,
        ]);
        CRUD::column([   // Number
            'name' => 'interest_rate',
            'label' => 'Interest Rate',
            'type' => 'number',
            'min' => 0,
        ]);
        CRUD::column([   // Number
            'name' => 'loan_term_months',
            'label' => 'Loan Term Months',
            'type' => 'number',
            'min' => 0,
        ]);
        CRUD::column([   // Number
            'name' => 'monthly_installment',
            'label' => 'Monthly Installment',
            'type' => 'number',
            'min' => 0,
        ]);

        CRUD::column([   // select_from_array
            'name'        => 'status',
            'label'       => 'Status',
            'type'        => 'select_from_array',
            'options'     => ['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected', 'active' => 'Active', 'completed' => 'Completed'],
            'allows_null' => false,
            'default'     => 'one',
        ]);
    }

    protected function setupShowOperation()
    {
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
            'name' => 'application_date',
            'label' => 'Application Date',
            'type' => 'date',
        ]);
        CRUD::column([
            'name' => 'due_date',
            'label' => 'Due Date',
            'type' => 'date',
        ]);
        CRUD::column([   // Number
            'name' => 'loan_amount',
            'label' => 'Loan Amount',
            'type' => 'number',
            'min' => 0,
        ]);
        CRUD::column([   // Number
            'name' => 'interest_rate',
            'label' => 'Interest Rate',
            'type' => 'number',
            'min' => 0,
        ]);
        CRUD::column([   // Number
            'name' => 'loan_term_months',
            'label' => 'Loan Term Months',
            'type' => 'number',
            'min' => 0,
        ]);
        CRUD::column([   // Number
            'name' => 'monthly_installment',
            'label' => 'Monthly Installment',
            'type' => 'number',
            'min' => 0,
        ]);

        CRUD::column([   // select_from_array
            'name'        => 'status',
            'label'       => 'Status',
            'type'        => 'select_from_array',
            'options'     => ['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected', 'active' => 'Active', 'completed' => 'Completed'],
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
        CRUD::setValidation(LoanRequest::class);
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
            'name' => 'application_date',
            'label' => 'Application Date',
            'type' => 'date',
        ]);
        CRUD::field([
            'name' => 'due_date',
            'label' => 'Due Date',
            'type' => 'date',
        ]);
        CRUD::field([   // Number
            'name' => 'loan_amount',
            'label' => 'Loan Amount',
            'type' => 'number',
            'min' => 0,
        ]);
        CRUD::field([   // Number
            'name' => 'interest_rate',
            'label' => 'Interest Rate',
            'type' => 'number',
            'min' => 0,
        ]);
        CRUD::field([   // Number
            'name' => 'loan_term_months',
            'label' => 'Loan Term Months',
            'type' => 'number',
            'min' => 0,
        ]);
        CRUD::field([   // Number
            'name' => 'monthly_installment',
            'label' => 'Monthly Installment',
            'type' => 'number',
            'min' => 0,
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
