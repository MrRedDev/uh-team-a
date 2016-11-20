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

    $data['therapists'] = $this->therapist_model->get_therapists();
    $data['title'] = 'Therapist list';

    $this->load->view('templates/header', $data);
    $this->load->view('therapists/index', $data);
    $this->load->view('templates/footer');

  }


  public function create()
  {
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('fname', 'First Name', 'required');
    $this->form_validation->set_rules('lname', 'Last Name', 'required');

    $data['title'] = 'Therapist Create';

    if ($this->form_validation->run() === FALSE)
    {

      $this->load->view('templates/header', $data);
      $this->load->view('therapists/create', $data);
      $this->load->view('templates/footer');

    }
    else {

      $postData = array(
          'f_name' => $this->input->post('fname'),
          'l_name' => $this->input->post('lname')
      );

      // $this->session->set_flashdata('postdata', $postData);
      $this->therapist_model->add_therapist($postData);
      redirect('http://localhost:8888/UH-Team-A/index.php/therapists');

      // $this->index();
      // $this->load->view('templates/header', $data);
      // $this->load->view('therapists/create', $data);
      // $this->load->view('templates/footer');
      // $this->load->view('templates/therapists/success');

    }

  }



}
