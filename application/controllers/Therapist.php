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

	// Staff table is called frome here
    public function therapist()
    {
        // Loading view home page views, Grocery CRUD Standard Library
       // $this->load->view('templates/header');

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapist');
        $crud->set_subject('Therapist'); 

        // replace staff number with name of therapist
        $crud->set_relation('staffNo', 'staff', '{fName} {lName}');

        // choose room number from list of rooms available
        $crud->set_relation('roomNo', 'room', 'roomNo');

        // choose the manager of the therapist
        //$crud->set_relation_n_n('managerNo', 'staff', 'staffNo', '');

        	        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->columns('staffNo', 'phoneNo', 'roomNo', 'managerNo', 'enabled');
        	        //change column heading name for readability ('columm name', 'name to display in frontend column header')

        $crud->display_as('staffNo', 'Therapist Name')
            ->display_as('phoneNo', 'Phone Number')
            ->display_as('roomNo', 'Room Number')
            ->display_as('managerNo', 'Manager ID Number');

                // When adding Present radial button to archive yes or no
        $crud->callback_add_field('enabled',function () {
                return  '<form>
                        <input type="radio" value="Y" name="enabled" id="enabledY" checked="checked"
                             if (isset($_POST["enabled"]) && $_POST["enabled"] == "Y"): endif; /> Yes
                        <input type="radio" value="N" name="enabled" id="enabledN"
                             if (isset($_POST["enabled"]) && $_POST["enabled"] == "N"): endif; /> No
                        </form>';
                    });

        // When adding Present radial button to archive yes or no
        $crud->callback_edit_field('enabled',function () {
                return  '<form>
                        <input type="radio" value="Y" name="enabled" id="enabledY" checked="checked"
                             if (isset($_POST["enabled"]) && $_POST["enabled"] == "Y"): endif; /> Yes
                        <input type="radio" value="N" name="isOffered" id="enabledN"
                             if (isset($_POST["enabled"]) && $_POST["enabled"] == "N"): endif; /> No
                        </form>';
                    });

        $crud->fields('staffNo', 'phoneNo', 'roomNo', 'managerNo', 'enabled');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('staffNo', 'phoneNo', 'roomNo', 'managerNo', 'enabled');

        $output = $crud->render();

		$this->therapist_output($output);
    }

}
?>