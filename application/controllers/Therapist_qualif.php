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

    public function staff_qualif()
    {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        $crud->set_table('therapistQualifications');
        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapist Qualifications');

        $crud->set_relation('qId', 'qualifications', '{qName} - {qLevel}');
        $crud->set_relation('staffNo', 'staff', '{fName} {lName}');
        
        $crud->display_as('staffNo', 'Therapist Name')
            ->display_as('qId', 'Qualification and Level')
            ->display_as('dateQualified', 'Date Qualified')
            ->display_as('qExpiryDdate', 'Qualification Expiry Date');

        $crud->unset_columns('enabled'); //Remove enabled from view, enabled is only used when disabling data instead of deleting
        $crud->callback_column('therapistQualifications.enabled', 'Y'); //Insert default value Y when adding new staff

        $crud->columns('staffNo', 'qId', 'dateQualified', 'qExpiryDdate');
        $crud->fields('staffNo', 'qId', 'dateQualified', 'qExpiryDdate');

        $output = $crud->render();
		
        $this->staff_qualif_output($output);

    }

    public function member_qualifications()
    {
        // Loading view home page views, Grocery CRUD Standard Library

        $crud = new grocery_CRUD();

        $staffNumber = $this->session->userdata('staffnum');
        

        // read only
        $crud->unset_operations();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapistQualifications');

        $crud->where('therapistQualifications.staffNo',$staffNumber);

        $crud->set_subject('My Qualifications');

        $crud->set_relation('qId', 'qualifications', '{qName} - {qLevel}');
        $crud->set_relation('staffNo', 'staff', '{fName} {lName}');
        
        $crud->display_as('staffNo', 'Therapist Name')
            ->display_as('qId', 'Qualification and Level')
            ->display_as('dateQualified', 'Date Qualified')
            ->display_as('qExpiryDdate', 'Qualification Expiry Date');


        $crud->where('therapistQualifications.enabled', 'Y');

        $crud->columns('staffNo', 'qId', 'dateQualified', 'qExpiryDdate');
        $crud->fields('staffNo', 'qId', 'dateQualified', 'qExpiryDdate');

        $output = $crud->render();

        $this->staff_qualif_output($output);

    }

    public function staff_qualifReadOnly()
    {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapistQualifications');
        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapist Qualifications');

        $crud->set_relation('qId', 'qualifications', '{qName} - {qLevel}');
        $crud->set_relation('staffNo', 'staff', '{fName} {lName}');
            
        $crud->display_as('staffNo', 'Therapist Name')
            ->display_as('qId', 'Qualification and Level')
            ->display_as('dateQualified', 'Date Qualified')
            ->display_as('qExpiryDdate', 'Qualification Expiry Date');

        $crud->columns('staffNo', 'qId', 'dateQualified', 'qExpiryDdate');
        $crud->fields('staffNo', 'qId', 'dateQualified', 'qExpiryDdate');

        // Read Only
        $crud->unset_operations();

        $crud->where('therapistQualifications.enabled', 'Y');

        $output = $crud->render();
            
        $this->staff_qualif_output($output);

    }

}
?>