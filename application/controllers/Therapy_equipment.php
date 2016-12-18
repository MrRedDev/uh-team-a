<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Therapy_equipment extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');
        $this->load->library('grocery_CRUD');
    }

    public function therapy_equipment_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/therapy_equipment_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

    public function therapy_equipment()
    {

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database to read data from
        $crud->set_table('therapyEquipment');

        // replace Primary key and Foreign key values with therapy name and equipment name

        $crud->set_relation('therapyId', 'therapy', 'therapyName');
        $crud->set_relation('eIdNumber', 'equipment', 'eName');
        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapy Equipment');

        // display user friendly columns
        $crud->display_as('therapyId', 'Therapy');
        $crud->display_as('eIdNumber', 'Equipment');
        // specify what columns appear in the view
        $crud->columns('eIdNumber', 'therapyId');
        $crud->required_fields('eIdNumber', 'therapyId', 'enabled');

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

        $output = $crud->render();

		$this->therapy_equipment_output($output);

    }

}
?>