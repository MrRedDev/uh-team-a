<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Therapist_qualif extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
        $this->load->library('grocery_CRUD');
    }

    public function staff_qualif_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/staff_qualif_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

	// Staff table is called frome here
    public function staff_qualif()
    {
        // Loading view home page views, Grocery CRUD Standard Library
       // $this->load->view('templates/header');

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('staff');
        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('TherapistQualifications');

        $crud->set_relation_n_n('qualification', 'therapistqualifications', 'qualifications', 'staffNo', 'qId', 'qName');


        $crud->unset_columns('enabled', 'staffLogin', 'staffPassword', 'accessLevel');

        $crud->columns('staffNo','fName', 'lName', 'qualification', 'therapists', 'qName', 'dateQualified', 'qExpiryDdate');

        $output = $crud->render();
		$this->staff_qualif_output($output);

    }

}
?>