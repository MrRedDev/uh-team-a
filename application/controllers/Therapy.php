<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Therapy extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
        
        $this->load->library('grocery_CRUD');
    }

    public function therapy_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/therapy_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

    public function therapy()
    {
        // Loading view home page views, Grocery CRUD Standard Library
       // $this->load->view('templates/header');

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapy');
        	        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapy'); 
        $crud->columns('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered','enabled');
        	   
    //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('therapyId', 'Therapy ID Number')
            ->display_as('therapyName', 'Therapy')
            ->display_as('tCategory', 'Therapy Category')
            ->display_as('tType', 'Therapy Type')
            ->display_as('tReviewDate', 'Therapy Review Date')
            ->display_as('isOffered', 'Therapy Available');

        $crud->fields('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered','enabled');

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
        
        // When adding Present radial button to archive yes or no
        $crud->callback_add_field('isOffered',function () {
                return  '<form>
                        <input type="radio" value="Y" name="isOffered" id="isOfferedY" checked
                             if (isset($_POST["isOffered"]) && $_POST["isOffered"] == "Y"): endif; /> Yes
                        <input type="radio" value="N" name="isOffered" id="isOfferedN" checked
                             if (isset($_POST["isOffered"]) && $_POST["isOffered"] == "N"): endif; /> No
                        </form>';
                    });

        // When adding Present radial button to archive yes or no
        $crud->callback_edit_field('isOffered',function () {
                return  '<form>
                        <input type="radio" value="Y" name="isOffered" id="isOfferedY" checked
                             if (isset($_POST["isOffered"]) && $_POST["isOffered"] == "Y"): endif; /> Yes
                        <input type="radio" value="N" name="isOffered" id="isOfferedN" checked
                             if (isset($_POST["isOffered"]) && $_POST["isOffered"] == "N"): endif; /> No
                        </form>';
                    });

        $crud->where('isOffered', 'Y'); // Only show available therapies. Archived therapies available from another view

        // Prevent duplicating data
        $crud->unique_fields(array('therapyId', 'therapyName'));

        $output = $crud->render();
        
		$this->therapy_output($output);

    }

    ////////////////////////////////
    // read only therapy view method
    ////////////////////////////////

    public function read_only_therapy()
    {
        // Loading view home page views, Grocery CRUD Standard Library
        // $this->load->view('templates/header');

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapy');
        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapy');
        $crud->columns('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered','enabled');

        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('therapyId', 'Therapy ID Number')
            ->display_as('therapyName', 'Therapy')
            ->display_as('tCategory', 'Therapy Category')
            ->display_as('tType', 'Therapy Type')
            ->display_as('tReviewDate', 'Therapy Review Date')
            ->display_as('isOffered', 'Therapy Available');

        // $crud->fields('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered');

        //form validation (could match database columns set to "not null")
        // $crud->required_fields('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered','enabled');

        $crud->where('enabled', 'Y');

        $crud->where('therapy.isOffered', 'Y'); // Only show available therapies. Archived therapies available from another view

        $crud->unset_operations();

        // Prevent duplicating data
        $crud->unique_fields(array('therapyId', 'therapyName'));

        $output = $crud->render();

        $this->therapy_output($output);

    }


    public function archived_therapy()
    {
        // Loading view home page views, Grocery CRUD Standard Library
       // $this->load->view('templates/header');

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapy');
                    //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapy'); 
        $crud->columns('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered','enabled');
               
    //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('therapyId', 'Therapy ID Number')
            ->display_as('therapyName', 'Therapy')
            ->display_as('tCategory', 'Therapy Category')
            ->display_as('tType', 'Therapy Type')
            ->display_as('tReviewDate', 'Therapy Review Date')
            ->display_as('isOffered', 'Therapy Available');

        $crud->fields('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered','enabled');

        $crud->unset_columns('enabled'); //Remove enabled from view, enabled is only used when disabling data instead of deleting
        $crud->callback_column('enabled', 'Y'); //Insert default value Y when adding new staff
        
        // When adding Present radial button to archive yes or no
        $crud->callback_add_field('isOffered',function () {
                return  '<form>
                        <input type="radio" value="Y" name="isOffered" id="isOfferedY" checked
                             if (isset($_POST["isOffered"]) && $_POST["isOffered"] == "Y"): endif; /> Yes
                        <input type="radio" value="N" name="isOffered" id="isOfferedN" checked
                             if (isset($_POST["isOffered"]) && $_POST["isOffered"] == "N"): endif; /> No
                        </form>';
                    });

        // When adding Present radial button to archive yes or no
        $crud->callback_edit_field('isOffered',function () {
                return  '<form>
                        <input type="radio" value="Y" name="isOffered" id="isOfferedY" checked
                             if (isset($_POST["isOffered"]) && $_POST["isOffered"] == "Y"): endif; /> Yes
                        <input type="radio" value="N" name="isOffered" id="isOfferedN" checked
                             if (isset($_POST["isOffered"]) && $_POST["isOffered"] == "N"): endif; /> No
                        </form>';
                    });

        $crud->where('isOffered', 'N'); // Only show available therapies. Archived therapies available from another view

        $crud->unset_add();
        $crud->unset_delete();
        $crud->unset_export();

        $output = $crud->render();
        
        $this->therapy_output($output);

    }

}
?>