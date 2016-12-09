<?php
class Membership_model extends CI_Model
{
  function validate()
  {
    $this->db->where('username', $this->input->post('username'));
    $this->db->where('password', $this->input->post('password')); // MD5 hash it
    $query = $this->db->get('membership');

    if ($query->num_rows() == 1)
    {
      return true;
    }
  }

  function create_member()
  {
    // if validation passed inside controller
    $new_member_insert_data = array(
      'first_name' => $this->input->post('first_name'),
      'last_name' => $this->input->post('last_name'),
      'email_address' => $this->input->post('email_address'),
      'username' => $this->input->post('username'),
      'password' => $this->input->post('password'), // convert MD5
    );

    $insert = $this->db->insert('membership', $new_member_insert_data);
    return $insert; // true or false
  }
}
 ?>
