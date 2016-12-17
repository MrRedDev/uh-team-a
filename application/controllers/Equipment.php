<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
        $this->load->library('grocery_CRUD');
        // $this->check_dates();
    }

    public function check_dates() {
      // will try notifications
    }

    public function equipment_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/equipment_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

	// Staff table is called frome here
    public function equipment()
    {
        // Loading view home page views, Grocery CRUD Standard Library
       // $this->load->view('templates/header');

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('equipment');
        	        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Equipment');
        $crud->columns('eIdNumber', 'eName', 'eReviewDate', 'enabled');
        	        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('eIdNumber', 'Equipment ID Number');
        $crud->display_as('eName', 'Equipment Name');
        $crud->display_as('eReviewDate', 'Review Date');

        // When adding Present radial button to archive yes or no
        $crud->callback_add_field('enabled',function () {
                return  '<form>
                        <input type="radio" value="Y" name="enabled" id="isOfferedY" checked
                             if (isset($_POST["enabled"]) && $_POST["enabled"] == "Y"): endif; /> Yes
                        <input type="radio" value="N" name="enabled" id="isOfferedN" checked
                             if (isset($_POST["enabled"]) && $_POST["enabled"] == "N"): endif; /> No
                        </form>';
                    });

        // When adding Present radial button to archive yes or no
        $crud->callback_edit_field('enabled',function () {
                return  '<form>
                        <input type="radio" value="Y" name="enabled" id="isOfferedY" checked
                             if (isset($_POST["enabled"]) && $_POST["enabled"] == "Y"): endif; /> Yes
                        <input type="radio" value="N" name="enabled" id="isOfferedN" checked
                             if (isset($_POST["enabled"]) && $_POST["enabled"] == "N"): endif; /> No
                        </form>';
                    });

        $crud->where('enabled', 'Y');

        $crud->fields('eIdNumber', 'eName', 'eReviewDate', 'enabled');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('eIdNumber', 'eName', 'eReviewDate', 'enabled');

        // Prevent duplicating data
        $crud->unique_fields(array('eIdNumber','eName'));

        $output = $crud->render();
		    
        $this->equipment_output($output);

    }
    //////////////////////////////////////
    // equipment read only method
    //////////////////////////////////////
    public function read_only_equipment()
    {
        // Loading view home page views, Grocery CRUD Standard Library
        // $this->load->view('templates/header');

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('equipment');
        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Equipment');
        $crud->columns('eIdNumber', 'eName', 'eReviewDate', 'enabled');
        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('eIdNumber', 'Equipment ID Number');
        $crud->display_as('eName', 'Equipment Name');
        $crud->display_as('eReviewDate', 'Review Date');

        $crud->unset_operations();

        $crud->where('enabled', 'Y');

        $crud->fields('eIdNumber', 'eName', 'eReviewDate', 'enabled');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('eIdNumber', 'eName', 'eReviewDate', 'enabled');

        // Prevent duplicating data
        $crud->unique_fields(array('eIdNumber','eName'));

        $output = $crud->render();

        $this->equipment_output($output);

    }

}
?>
