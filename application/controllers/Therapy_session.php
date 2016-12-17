<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Therapy_session extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');

        $this->load->library('grocery_CRUD');
    }

    public function therapy_session_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/therapy_session_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

	// Staff table is called frome here
    public function therapy_session()
    {
        // Loading view home page views, Grocery CRUD Standard Library
       // $this->load->view('templates/header');

        $crud = new grocery_CRUD();

        $crud->where('therapySession.enabled', 'N');

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapySession');
        $crud->set_subject('Therapy sessions'); 

        // replace staff number with name of therapist
        $crud->set_relation('staffNo', 'staff', '{fName} {lName}', array('accessLevel' => '3'));

        // choose room number from list of rooms available
        $crud->set_relation('therapyId', 'therapy', '{therapyName} - {tType}', array('isOffered' => 'Y'));

        // choose the manager of the therapist
        //$crud->set_relation_n_n('managerNo', 'staff', 'staffNo', '');

        	        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->columns('sessionId', 'therapyId', 'staffNo', 'sDate', 'startTime', 'finishTime', 'enabled');
        	        //change column heading name for readability ('columm name', 'name to display in frontend column header')

        $crud->display_as('sessionId', 'Therapy Session Reference')
            ->display_as('therapyId', 'Therapy Name')
            ->display_as('staffNo', 'Therapist Name')
            ->display_as('sDate', 'Therapy Date')
            ->display_as('startTime', 'Therapy Start Time')
            ->display_as('finishTime', 'Therapy finishTime');

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

        $crud->fields('sessionId', 'therapyId', 'staffNo', 'sDate', 'startTime', 'finishTime', 'enabled');

        $crud->required_fields('sessionId', 'therapyId', 'staffNo', 'sDate', 'startTime', 'finishTime', 'enabled');

        $output = $crud->render();

		$this->therapy_session_output($output);
    }

}
?>