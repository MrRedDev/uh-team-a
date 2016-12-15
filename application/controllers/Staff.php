<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');  
        $this->load->helper('html');
        $this->load->library('session');

        $this->load->library('grocery_CRUD');
    }

    public function staff_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/staff_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

	// Staff table is called frome here
    public function staff()
    {
        // Loading view home page views, Grocery CRUD Standard Library

        $crud = new grocery_CRUD();

        //$this->load->view('templates/header');

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('staff');
        	        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Staff'); 
        $crud->columns('staffNo', 'fName', 'lName', 'enabled', 'staffLogin', 'staffPassword', 'accessLevel');
        	        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('staffNo', 'STAFF NO.');
        $crud->display_as('fName', 'First Name');
        $crud->display_as('lName', 'Last Name');
        $crud->display_as('staffLogin', 'Username');
        $crud->display_as('staffPassword', 'Password');
        $crud->display_as('sPosition', 'Staff Position');

        $crud->unset_columns('enabled'); //Remove enabled from view, enabled is only used when disabling data instead of deleting
        $crud->callback_column('enabled', 'Y'); //Insert default value Y when adding new staff

        $crud->fields('staffNo', 'fName', 'lName', 'staffLogin', 'staffPassword', 'accessLevel');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('staffNo', 'fName', 'lName', 'enabled', 'staffLogin', 'staffPassword', 'accessLevel');
        
       //Commented out add field staff password as stopping password from adding to DB
       /*$crud->callback_add_field('staffPassword',function () {
            return '<input type="text" maxlength="4" <!--style="-webkit-text-security: square;-->">';
        }); */
        
        //Following function provides a user friendly checkbox with understandable terms. EG level 3 is referred to as a therapist by the SPA. Form should return the the appropriate value when checked after editing or adding

                // Provide a checkbox for access level when adding user
        $crud->callback_add_field('accessLevel',function () {
                return  '<form>
                        <input type="radio" value="1" name="accessLevel" id="accessLevel1" checked="checked"
                             if (isset($_POST["accessLevel"]) && $_POST["accessLevel"] == "1"): endif; /> Manager 
                        <input type="radio" value="2" name="accessLevel" id="accessLevel2" checked="checked"
                             if (isset($_POST["accessLevel"]) && $_POST["accessLevel"] == "2"): endif; /> Marketing 
                        <input type="radio" value="3" name="accessLevel" id="accessLevel3" checked="checked"
                             if (isset($_POST["accessLevel"]) && $_POST["accessLevel"] == "3"): endif; /> Therapist 
                        </form>';

        });

       $crud->callback_edit_field('accessLevel',function () {
                return  '<form>
                        <input type="radio" value="1" name="accessLevel" id="accessLevel1" checked="checked"
                             if (isset($_POST["accessLevel"]) && $_POST["accessLevel"] == "1"): endif; /> Manager 
                        <input type="radio" value="2" name="accessLevel" id="accessLevel2" checked="checked"
                             if (isset($_POST["accessLevel"]) && $_POST["accessLevel"] == "2"): endif; /> Marketing 
                        <input type="radio" value="3" name="accessLevel" id="accessLevel3" checked="checked"
                             if (isset($_POST["accessLevel"]) && $_POST["accessLevel"] == "3"): endif; /> Therapist 
                        </form>';

        });
        

        /*
        Need to add if statemnt to check access level is authorised. If level 3 enable this control to remove delete data button
        $crud->unset_delete();
        */

        /*
        Need to add if statemnt to check access level is authorised. If level 2/3 enable this control to remove create new staff/therapist data button
        $crud->unset_add();
        */

        //$crud->callback_insert('enabled', 'Y');
        $output = $crud->render();

        $this->staff_output($output);
    }

}
?>