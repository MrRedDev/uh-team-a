<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Therapist extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');

        $this->load->library('grocery_CRUD');
    }

    public function therapist_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/therapist_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

    public function therapist()
    {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapist');
        $crud->set_subject('Therapist'); 

        // replace staff number with name of therapist
        $crud->set_relation('staffNo', 'staff', '{fName} {lName}');

        // choose room number from list of rooms available
        $crud->set_relation('roomNo', 'room', 'roomNo');

        	        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->columns('staffNo', 'phoneNo', 'roomNo', 'managerNo');
        	        //change column heading name for readability ('columm name', 'name to display in frontend column header')

        $crud->display_as('staffNo', 'Therapist Name')
            ->display_as('phoneNo', 'Phone Number')
            ->display_as('roomNo', 'Room Number')
            ->display_as('managerNo', 'Manager ID Number')
            ->display_as('enabled', 'Delete');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes', 'Y' => 'No'));

        $crud->where('therapist.enabled', 'Y');

        $crud->fields('staffNo', 'phoneNo', 'roomNo', 'managerNo', 'enabled');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('staffNo', 'phoneNo', 'roomNo', 'managerNo', 'enabled');

        // Prevent duplicating data
        $crud->unique_fields(array('staffNo','roomNo'));

        $crud->unset_export();
        $crud->unset_delete();


        $output = $crud->render();

		$this->therapist_output($output);
    }

    public function therapistReadOnly()
    {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapist');
        $crud->set_subject('Therapist'); 

        // replace staff number with name of therapist
        $crud->set_relation('staffNo', 'staff', '{fName} {lName}');

        // choose room number from list of rooms available
        $crud->set_relation('roomNo', 'room', 'roomNo');

                    //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->columns('staffNo', 'phoneNo', 'roomNo', 'managerNo');
                    //change column heading name for readability ('columm name', 'name to display in frontend column header')

        $crud->display_as('staffNo', 'Therapist Name')
            ->display_as('phoneNo', 'Phone Number')
            ->display_as('roomNo', 'Room Number')
            ->display_as('managerNo', 'Manager ID Number');

        $crud->where('therapist.enabled', 'Y');

        $crud->unset_operations();

        $output = $crud->render();

        $this->therapist_output($output);
    }

    public function therapistDeleted()
    {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapist');

        $crud->set_subject('Archived Therapists'); 

        // replace staff number with name of therapist
        $crud->set_relation('staffNo', 'staff', '{fName} {lName}');

        // choose room number from list of rooms available
        $crud->set_relation('roomNo', 'room', 'roomNo');

                    //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->columns('staffNo', 'phoneNo', 'roomNo', 'managerNo');
                    //change column heading name for readability ('columm name', 'name to display in frontend column header')

        $crud->display_as('staffNo', 'Therapist Name')
            ->display_as('phoneNo', 'Phone Number')
            ->display_as('roomNo', 'Room Number')
            ->display_as('managerNo', 'Manager ID Number')
            ->display_as('enabled', 'Delete');

        $crud->field_type('enabled', 'dropdown', array('N' => 'Yes', 'Y' => 'No'));

        $crud->where('therapist.enabled', 'N');

        $crud->fields('staffNo', 'phoneNo', 'roomNo', 'managerNo', 'enabled');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('staffNo', 'phoneNo', 'roomNo', 'managerNo', 'enabled');

        // Prevent duplicating data
        $crud->unique_fields(array('staffNo','roomNo'));

        $crud->unset_add();
        $crud->unset_delete();

        $output = $crud->render();

        $this->therapist_output($output);
    }
}
?>