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

        $crud->callback_add_field('enabled',function () {
                return  '<form>
                        <input type="radio" value="Y" name="enabled" id="enabledY" checked="checked"
                             if (isset($_POST["enabled"]) && $_POST["enabled"] == "Y"): endif; /> Yes
                        <input type="radio" value="N" name="enabled" id="enabledN" 
                             if (isset($_POST["enabled"]) && $_POST["enabled"] == "N"): endif; /> No
                        </form>';
        });
        $crud->callback_edit_field('enabled',function () {
                return  '<form>
                        <input type="radio" value="Y" name="enabled" id="enabledY" checked="checked"
                             if (isset($_POST["enabled"]) && $_POST["enabled"] == "Y"): endif; /> Yes
                        <input type="radio" value="N" name="isOffered" id="enabledN"
                             if (isset($_POST["enabled"]) && $_POST["enabled"] == "N"): endif; /> No
                        </form>';
                    });

        $crud->fields('qId', 'qName', 'qLevel', 'qAccBody');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('qId', 'qName', 'qLevel', 'qAccBody');
        
        $output = $crud->render();

		$this->qualifications_output($output);

    }

}
?>