<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qualifications extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');

        $this->load->library('grocery_CRUD');
    }

    public function qualifications_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/qualifications_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

	// Staff table is called frome here
    public function qualifications()
    {
        // Loading view home page views, Grocery CRUD Standard Library
       // $this->load->view('templates/header');

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('qualifications');
        	        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Qualifications');
        $crud->columns('qId', 'qName', 'qLevel', 'qAccBody', 'enabled');
        	        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('qId', 'Qualification ID Number');
        $crud->display_as('qName', 'Qualification');
        $crud->display_as('qAccBody', 'Accrediting Body');

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

        $crud->fields('qId', 'qName', 'qLevel', 'qAccBody', 'enabled');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('qId', 'qName', 'qLevel', 'qAccBody', 'enabled');

        // Prevent duplicating data
        $crud->unique_fields(array('qId','qName'));

        $output = $crud->render();

				$this->qualifications_output($output);

    }

		public function member_qualifications_output($output = null)
		{

			$this->load->helper('form');

			$data['output'] = $output;
			$data['main_content'] = 'site/member_qualifications_view';
			$data['staffnum'] = $this->session->userdata('staffnum');
			$data['user'] = $this->session->userdata('username');
			$data['al'] = $this->session->userdata('al');
			$this->load->view('includes/template', $data);

		}

		public function member_qualifications()
		{
			// Loading view home page views, Grocery CRUD Standard Library

			$crud = new grocery_CRUD();

			$staffNumber = $this->session->userdata('staffnum');
			// $crud->where('staffNo',$staffNumber);
			//$this->load->view('templates/header');

			// read only
			$crud->unset_operations();

			$crud->set_theme('flexigrid');

			//table name exact from database
			$crud->set_table('therapistQualifications');

			$crud->where('staffNo',$staffNumber);

								//give focus on name used for operations e.g. Add Order, Delete Order
			$crud->set_subject('Staff');
			$crud->columns('qName', 'qLevel', 'qAccBody');
								//change column heading name for readability ('columm name', 'name to display in frontend column header')
			$crud->display_as('qName', 'Qualification');
			$crud->display_as('qLevel', 'Level');
			$crud->display_as('qAccBody', 'Description');

			$crud->unset_columns('enabled'); //Remove enabled from view, enabled is only used when disabling data instead of deleting
			$crud->callback_column('enabled', 'Y'); //Insert default value Y when adding new staff

			$crud->fields('qName', 'qLevel', 'qAccBody');

			//form validation (could match database columns set to "not null")
			$crud->required_fields('qName', 'qLevel', 'qAccBody');

			// $crud->callback_add_field('accessLevel',function()
			// {
			// 	return  '<form>
			// 					<input type="radio" value="1" name="accessLevel" id="accessLevel1" checked="checked"
			// 							 if (isset($_POST["accessLevel"]) && $_POST["accessLevel"] == "1"): endif; /> Manager
			// 					<input type="radio" value="2" name="accessLevel" id="accessLevel2" checked="checked"
			// 							 if (isset($_POST["accessLevel"]) && $_POST["accessLevel"] == "2"): endif; /> Marketing
			// 					<input type="radio" value="3" name="accessLevel" id="accessLevel3" checked="checked"
			// 							 if (isset($_POST["accessLevel"]) && $_POST["accessLevel"] == "3"): endif; /> Therapist
			// 					</form>';
			// });

			$output = $crud->render();
			$this->member_qualifications_output($output);

		}

}
?>
