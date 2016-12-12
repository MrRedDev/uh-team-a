<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddTherapist extends CI_Controller {

	public function __construct(){

        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
	}

	public function addTherapist_output($output = null)
    {
        $this->load->view('pages/addStaff_view.php', $output);
    }

	public function addTherapist(){

		$crud = new grocery_CRUD();
 
 		$this->load->view('templates/header');

		$crud->set_table('staff');
		//$crud->set_relation_n_n('staffNo', 'fname', 'lname', 'enabled', 'staffLogin', 'staffPassword','accessLevel');
		//$crud->set_relation_n_n('therapist', 'phoneNo', 'roomNo', 'enabled', 'managerNo');
		$crud->set_subject('Add Staff');
		$crud->required_fields('staffNo', 'fName', 'lName', 'enabled', 'staffLogin', 'staffPassword','accessLevel');

		$crud->columns('staffNo', 'fname', 'lname', 'staffLogin', 'staffPassword','accessLevel');
		$crud->display_as('staffNo', 'STAFF NO.');
        $crud->display_as('fName', 'First Name');
        $crud->display_as('lName', 'Last Name');
        $crud->display_as('staffLogin', 'Username');
        $crud->display_as('staffPassword', 'Password');
        $crud->display_as('sPosition', 'Staff Position');

		$crud->callback_add_field('staffPassword', function () {
			return '<input type="password" maxlength="50" value="" name="psw">';
		});
	
		$crud->callback_add_field('accessLevel',function () {
			return '<form>
						<input type="checkbox" value="1" name="accessLevel1"> Manager
						<input type="checkbox" value="2" name="accessLevel2"> Marketing 
						<input type="checkbox" value="3" name="accessLevel3"> Therapist
					</form>';
		});

		$crud->callback_insert('enabled', 'Y');

		$output = $crud->render();
 
		$this->addStaff_output($output);

		$this->load->view('templates/footer');
	
	}

}?>