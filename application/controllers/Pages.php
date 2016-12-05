<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->load->library('table');
    }

    //L
    public function index()
    {
        $this->load->view('header');
        $this->load->view('home');
        $this->load->view('templates/footer');
    }

    // Staff table is called frome here
    public function staff()
    {
        // Loading view home page views, Grocery CRUD Standard Library
        $this->load->view('header');
        $crud = new grocery_CRUD();
        $crud->set_theme('datatables');

        //table name exact from database
        $crud->set_table('staff');
        $crud->fields('staffNo', 'fName', 'lName', 'phoneNo', 'roomNo', 'sPosition');

        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Staff');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('staffNo', 'fName', 'lName', 'phoneNo', 'roomNo', 'sPosition');

        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('staffNo', 'STAFF NO.');
        $crud->display_as('fName', 'First Name');
        $crud->display_as('lName', 'Last Name');
        $crud->display_as('phoneNo', 'Phone No.');
        $crud->display_as('roomNo', 'Room No.');
        $crud->display_as('sPosition', 'Staff Position');

        $output = $crud->render();
        $this->staff_output($output);
    }

    function staff_output($output = null)
    {
        $this->load->view('staff_view.php', $output);
    }


    // The qualification table is called from here
    public function qualifications()
    {
        $this->load->view('header');
        $crud = new grocery_CRUD();

        $crud->set_theme('datatables');
        $crud->set_table('qualifications');
        $crud->set_subject('Qualification');
        $crud->fields('qId', 'qName', 'qAccrBody');
        $crud->set_relation('qId','therapistQualifications','qId');
        $crud->required_fields('qId', 'qName', 'qAccrBody');
        $crud->display_as('qId', 'Qualif. ID');
        $crud->display_as('qName', 'Name');
        $crud->display_as('qAccrBody', 'Acc. Body');

        $output = $crud->render();
        $this->qualif_output($output);
    }

    function qualif_output($output = null)
    {
        //this function links up to corresponding page in the views folder to display content for this table
        $this->load->view('qualif_view.php', $output);
    }


    // The Therapist Qualification Table is called form here
    public function therapistQualif()
    {
        $this->load->view('header');
        $crud = new grocery_CRUD();

        $crud->set_theme('datatables');
        $crud->set_table('therapistqualifications');
        $crud->set_subject('Therapist Qualifications');
        $crud->fields('staffNo', 'qId', 'tqLevel', 'dateQualified', 'tqExpiryDate');
        $crud->set_relation('qId','qualifications','qId');
        $crud->set_relation('staffNo','staff','staffNo');
        $crud->required_fields('staffNo', 'qId', 'tqLevel', 'dateQualified', 'tqExpiryDate');
        $crud->display_as('staffNo', 'Staff No.');
        $crud->display_as('qId', 'ID');
        $crud->display_as('tqLevel', 'Level');
        $crud->display_as('dateQualified', 'Qualif Date');
        $crud->display_as('tqExpiryDate', 'Expiry Date');

        $output = $crud->render();
        $this->therapistQualif_output($output);
    }

    function therapistQualif_output($output = null)
    {
        //this function links up to corresponding page in the views folder to display content for this table
        $this->load->view('therapistQualif_view.php', $output);
    }

    // The Equipment table is called form here
    public function equipment()
    {
        $this->load->view('header');
        $crud = new grocery_CRUD();

        $crud->set_theme('datatables');
        $crud->set_table('equipment');
        $crud->set_subject('Equipment');
        $crud->fields('eIdNumeber', 'eName', 'eMtnValue', 'eReviewDate');
        $crud->required_fields('eIdNumeber', 'eName', 'eMtnValue', 'eReviewDate');
        $crud->display_as('eIdNumeber', 'ID.');
        $crud->display_as('eName', 'Name');
        $crud->display_as('eMtnValue', 'Mtn Value');
        $crud->display_as('eReviewDate', 'Review Date');

        $output = $crud->render();
        $this->equipment_output($output);
    }

    function equipment_output($output = null)
    {
        //this function links up to corresponding page in the views folder to display content for this table
        $this->load->view('equipment_view.php', $output);
    }


    // The TherapyEquipment table is called form here
    public function therapyEquip()
    {
        $this->load->view('header');
        $crud = new grocery_CRUD();

        $crud->set_theme('datatables');
        $crud->set_table('therapyequipment');
        $crud->set_subject('Therapy Equipment');
        $crud->fields('therapyId', 'eId');
        $crud->set_relation('therapyId','therapy','therapyId');
        $crud->set_relation('eId','equipment','eIdNumber');
        $crud->required_fields('therapyId', 'eId');
        $crud->display_as('therapyId', 'Therapy ID');
        $crud->display_as('eId', 'Equipment ID');

        $output = $crud->render();
        $this->therapyEquip_output($output);
    }

    function therapyEquip_output($output = null)
    {
        //this function links up to corresponding page in the views folder to display content for this table
        $this->load->view('therapyEquip_view.php', $output);
    }

    // The Therapy table is called form here
    public function therapy()
    {
        $this->load->view('header');
        $crud = new grocery_CRUD();

        $crud->set_theme('datatables');
        $crud->set_table('therapy');
        $crud->set_subject('Therapy');
        $crud->fields('therapyId','therapyName','tCategory', 'tType', 'tReviewDate', 'isOffered');
        $crud->required_fields('therapyId','therapyName','tCategory', 'tType', 'tReviewDate', 'isOffered');
        $crud->display_as('therapyId', 'Therapy ID');
        $crud->display_as('therapyName', 'Name');
        $crud->display_as('tCategory', 'tType');
        $crud->display_as('tType', 'Type');
        $crud->display_as('tReviewDate', 'Review Date');
        $crud->display_as('isOffered', 'Offered');


        $output = $crud->render();
        $this->therapy_output($output);
    }

    function therapy_output($output = null)
    {
        //this function links up to corresponding page in the views folder to display content for this table
        $this->load->view('therapy_view.php', $output);
    }

    // The Therapy table is called form here
    public function therapySession()
    {
        $this->load->view('header');
        $crud = new grocery_CRUD();

        $crud->set_theme('datatables');
        $crud->set_table('therapysession');
        $crud->set_subject('Therapy Session');
        $crud->fields('sessionId','therapyId','staffNo', 'sDate', 'startTime', 'finishTime');
        $crud->required_fields('sessionId','therapyId','staffNo', 'sDate', 'startTime', 'finishTime');
        $crud->set_relation('therapyId', 'Therapy', 'therapyId');
        $crud->set_relation('staffNo', 'staff', 'staffNo');
        $crud->display_as('sessionId', 'Session ID');
        $crud->display_as('therapyId', 'Therapy ID');
        $crud->display_as('staffNo', 'Staff No');
        $crud->display_as('sDate', 'Session Date');
        $crud->display_as('startTime', 'Start Time');
        $crud->display_as('finishTime', 'Finish Time');


        $output = $crud->render();
        $this->therapySession($output);
    }

    function therapySession_output($output = null)
    {
        //this function links up to corresponding page in the views folder to display content for this table
        $this->load->view('therapySession_view.php', $output);
    }

    // The TherapyEquipment table is called form here
    public function room()
    {
        $this->load->view('header');
        $crud = new grocery_CRUD();

        $crud->set_theme('datatables');
        $crud->set_table('room');
        $crud->set_subject('Room');
        $crud->fields('roomNo');
        $crud->required_fields('roomNo');
        $crud->display_as('roomNo', 'Room No');

        $output = $crud->render();
        $this->room_output($output);
    }

    function room_output($output = null)
    {
        //this function links up to corresponding page in the views folder to display content for this table
        $this->load->view('room_view.php', $output);
    }

    public function querynav()
    {
        $this->load->view('header');
        $this->load->view('querynav_view');
    }
}
