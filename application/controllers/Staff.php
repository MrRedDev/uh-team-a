<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
    }

    public function staff_output($output = null)
    {
        $this->load->view('pages/staff_view.php', $output);
    }

	// Staff table is called frome here
    public function staff()
    {
        // Loading view home page views, Grocery CRUD Standard Library
       // $this->load->view('templates/header');

        $crud = new grocery_CRUD();

        $this->load->view('templates/header');
        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('staff');
        	        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Staff'); 
        $crud->columns('staffNo', 'fName', 'lName', 'enabled', 'staffLogin', 'staffPassword', 'accessLevel');
        	        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('staffNo', 'STAFF NO.');
        $crud->display_as('fName', 'First Name');
        $crud->display_as('lName', 'Last Name');
        $crud->display_as('staffLogin', 'Username');
        $crud->display_as('staffPassword', 'Password');
        $crud->display_as('sPosition', 'Staff Position');

        $crud->unset_columns('enabled'); //Remove enabled from view, enabled is only used when diabling data instead of deleting
        $crud->callback_insert('enabled', 'Y'); //Insert default value Y when adding

        $crud->fields('staffNo', 'fName', 'lName', 'staffLogin', 'staffPassword', 'accessLevel');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('staffNo', 'fName', 'lName', 'enabled', 'staffLogin', 'staffPassword', 'accessLevel');
        
        /* Following function provides a user friendly checkbox with understandable terms. EG level 3 is referred to as a therapist by the SPA. Form should return the the appropriate value when checked after editing or adding

                // Provide a checkbox for access level when adding user
        $crud->callback_add_field('accessLevel',function () {
            return '<form>
                        <input type="checkbox" value="1" name="accessLevel1"> Manager
                        <input type="checkbox" value="2" name="accessLevel2"> Marketing 
                        <input type="checkbox" value="3" name="accessLevel3"> Therapist
                    </form>';
        });
        */

        /*
        Need to add if statemnt to check access level is authorised. If level 3 enable this control to remove delete data button
        $crud->unset_delete();
        */

        /*
        Need to add if statemnt to check access level is authorised. If level 2/3 enable this control to remove create new staff/therapist data button
        $crud->unset_add();
        */
        $crud->callback_insert('enabled', 'Y');
        $output = $crud->render();
		$this->staff_output($output);

        $this->load->view('templates/footer');
    }

}
