
<?php
class Therapists extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('therapist_model');
    $this->load->helper('url_helper');
  }

  public function index()
  {
    // The app will look better with some features like adding
    // to be all on one page. So lots of code inside index method.
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('fname', 'First Name', 'required');
    $this->form_validation->set_rules('lname', 'Last Name', 'required');

    $data['therapists'] = $this->therapist_model->get_therapists();
    $data['title'] = 'Therapist list';

    if ($this->form_validation->run() === FALSE)
    {
      $this->load->view('templates/header', $data);
      $this->load->view('therapists/create');
      $this->load->view('therapists/index', $data);
      $this->load->view('templates/therapists/failure');
      $this->load->view('templates/footer');
    }
    else {
      $this->therapist_model->add_therapist();

      // $this->load->view('templates/header', $data);
      // $this->load->view('therapists/create');
      // $this->load->view('therapists/index', $data);
      $this->load->view('templates/therapists/success');
      // $this->load->view('templates/footer');
    }
  }

  public function view($name = NULL)
  {
    $data['therapist_item'] = $this->therapist_model->get_therapists($name);

    if (empty($data['therapist_item']))
    {
      show_404();
    }

    $data['title'] = 'Therapist: ' . $data['therapist_item']['f_name'];

    $this->load->view('templates/header', $data);
    $this->load->view('therapists/view', $data);
    $this->load->view('templates/footer');
  }


  public function create()
  {
    // create page
  }

  public function update($name, $l_name)
  {
    // update page
  }

  public function delete($name, $l_name)
  {
    // delete page
  }

}
