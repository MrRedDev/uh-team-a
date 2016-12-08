<h1>Members Area</h1>

<h3>Welcome, <?php echo $username ?></h3>

<div>
  <?php
    echo form_open('site/logout');

    echo form_submit('submit', 'Logout');

   ?>
</div>
