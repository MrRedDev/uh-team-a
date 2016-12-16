<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
        
        $this->load->library('grocery_CRUD');
    }

    public function room_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/room_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

	// Staff table is called frome here
    public function room()
    {
        // Loading view home page views, Grocery CRUD Standard Library
       // $this->load->view('templates/header');

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('room');
        	        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapy Rooms'); 
        $crud->columns('roomNo', 'enabled');
        	        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('roomNo', 'Therapy Room Number')
            ->display_as('enebled', 'Is Available');

        $crud->fields('roomNo', 'enabled');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('roomNo', 'enabled');

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

        //$crud->callback_delete('enabled', 'N');

        $output = $crud->render();



		$this->room_output($output);

    }

}
?>