<div class="container">

  <div id="login_form" class="form-signin">
    <h1 class="form-signin-heading">Login</h1>
    <?php

      echo form_open('login/validate_credentials');

      echo form_input(array(
        'name' => 'username',
        'value' => set_value('username'),
        'placeholder' => 'Username'
      ));
      echo form_input(array(
        'name' => 'password',
        'value' => set_value('password'),
        'placeholder' => 'Password'
      ));

      echo form_submit('submit', 'Login');
      echo anchor('login/signup', 'Create Account');

     ?>
  </div>

</div>
