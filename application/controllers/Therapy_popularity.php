<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Therapy_popularity extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');

        $this->load->library('grocery_CRUD');
    }

    public function therapy_popularity_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/therapy_popularity_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

    public function therapy_popularity()
    {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapypopularity');
        $crud->set_subject('Therapy Popularity');
        

        $crud->set_primary_key('Therapy');

        //$crud->set_relation('therapyName', 'therapy', 'therapyName');

        // replace staff number with name of therapist
        $crud->columns('therapy', 'Total number of sessions');

	    
        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('therapy', 'Therapy Name');

        $crud->unset_operations();

        $output = $crud->render();

		$this->therapy_popularity_output($output);
    }

}
?>
