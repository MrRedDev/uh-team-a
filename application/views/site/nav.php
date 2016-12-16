
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo site_url('site/home')?>">SRMS Prototype</a>
    </div>
    <?php if ($al == 1) {
      echo '
        <ul class="nav navbar-nav">
                  <!-- staff Menu Items -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="">Staff<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="http://localhost:8888/uh-team-a/index.php/staff/staff">View or Edit Staff</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/staff/staff/add">Add New Staff</a></li>
            </ul>
          </li>
                    <!-- Qualifications Menu Items -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="">Manage Qualifications<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="http://localhost:8888/uh-team-a/index.php/qualifications/qualifications">View or Edit Qualifications</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/qualifications/qualifications/add">Add New Qualifications</a></li>
            </ul>
          </li>
                    <!-- Therapy Menu Items -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="">Manage Therapies<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapy/therapy">View or Edit Therapies</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapy/therapy/add">Add New Therapy</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/equipment/equipment">View or Edit Equipment</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/equipment/equipment/add">Add New Equipment</a></li>
            </ul>
          </li>
                    <!-- Therapist Menu Items -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="">Manage Therapists<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapist/therapist">View or Edit Therapists</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/therapist/therapist/add">Add New Therapist</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/room/room/">View or Edit Therapy Rooms</a></li>
              <li><a href="http://localhost:8888/uh-team-a/index.php/room/room/add">Add New Therapy Rooms</a></li>
            </ul>
          </li>
          
                    <!-- Therapist Qualifications Item -->
          <li><a href="http://localhost:8888/uh-team-a/index.php/therapist_qualif/staff_qualif">Therapist Qualifications</a></li>
          
                    <!-- Therapy Equipment Item -->
          <li><a href="http://localhost:8888/uh-team-a/index.php/therapy_equipment/therapy_equipment">Therapy Equipment</a></li>
        </ul>
      ';
    } else if ($al == 2): {
      echo '
        <ul class="nav navbar-nav">
          <li>
            <a href="http://localhost:8888/uh-team-a/">Marketing views not set up</a>
          </li>
        </ul>
      ';
    } elseif ($al == 3): {
      echo '
        <ul class="nav navbar-nav">
          <li>
            <a href="http://localhost:8888/uh-team-a/">Therapist views not set up</a>
          </li>
        </ul>
      ';
    } endif;
    ?>
    <ul class="nav navbar-nav navbar-right">
      <?php echo '
        <li class="dropdown">
          <a href=""><span class="glyphicon glyphicon-user"></span> ';
            echo $user;
              if ($al == 1): {
                echo ' - Access level: Manager </a></li>';
              } elseif ($al == 2): {
                echo ' - Access level: Marketing </a></li>';
              } elseif ($al == 3): {
                echo ' - Access level: Therapist </a></li>';
              } else: {
                echo 'Please Log In';
              } endif;
            ?>
      <li><a href='<?php echo site_url('site/logout')?>'><span class="glyphicon glyphicon-log-out"></span> Log out</a>
      </li>
    </ul>
  </div>
</nav>
      
<div class="container-fluid">
