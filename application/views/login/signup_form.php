<div class="container">

  <div class="form-create-account">

    <h1>Create account</h1>
    <fieldset>
      <legend>Personal Information</legend>
      <?php
        echo form_open('login/create_member');

        echo form_input(array(
          'name' => 'first_name',
          'value' => set_value('first_name'),
          'placeholder' => 'First Name'
        ));

        echo form_input(array(
          'name' => 'last_name',
          'value' => set_value('last_name'),
          'placeholder' => 'Last Name'
        ));

        echo form_input(array(
          'name' => 'email_address',
          'value' => set_value('email_address'),
          'placeholder' => 'Email Address'
        ));
       ?>
    </fieldset>

    <fieldset>
      <legend>Login info</legend>
      <?php
        echo form_input(array(
          'name' => 'username',
          'value' => set_value('username'),
          'placeholder' => 'Username'
        ));
        echo form_password(array(
          'name' => 'password',
          'value' => set_value('password'),
          'placeholder' => 'Password'
        ));

        echo form_submit('submit', 'Create Account');
       ?>

       <?php echo validation_errors('<p class="error">') ?>
    </fieldset>
      <?php
        echo anchor('login', 'Back to Login');
       ?>

  </div>

</div>
