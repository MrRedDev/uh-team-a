
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo site_url('')?>">SRMS Prototype</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <?php echo '
        <li class="dropdown">
          <a href=""><span class="glyphicon glyphicon-user"></span> ';
            echo $user;
            echo ' - Access level: ';
            if ($al == 1): {
              echo 'Manager </a></li>';
            } elseif ($al == 2): {
              echo 'Marketing </a></li>';
            } elseif ($al == 3): {
              echo 'Therapist </a></li>';
            } 
          endif;?>
      <li><a href='<?php echo site_url('site/logout')?>'><span class="glyphicon glyphicon-log-out"></span> Log out</a>
      </li>
    </ul>
  </div>
</nav>
      <?php if ($al == 1) {
        echo '
                <ul class="nav nav-stacked dropdown-menu-left">
                  <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="http://localhost:8888/uh-team-a/index.php">Staff<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="http://localhost:8888/uh-team-a/index.php/staff/staff">All Staff</a></li>
                        <li><a href="http://localhost:8888/uh-team-a/index.php/staff/staff/add">Add New Staff</a></li>
                      </ul>
                  </li>
                  <li role="presentation">
                    <a href="http://localhost:8888/uh-team-a/index.php/qualifications/qualifications">Qualifications</a></li>
                  <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="">Therapy<span class="caret"></span></a></li>
                    <ul class="dropdown-menu">
                      <li><a href="http://localhost:8888/uh-team-a/index.php/therapy/therapy">All Therapies</a></li>
                      <li><a href="http://localhost:8888/uh-team-a/index.php/therapy/therapy/add">Add New Therapies</a></li>
                      </ul>
                  </li>
                </ul>
              </div>
            </div>
          </nav>'; 
        } ?>
        <?php if ($al > 1) {
          echo '
            <nav class="nav nav-pills nav-stacked">
            <div class="collapse navbar-collapse" id="mynavbar">
            <div class="collapse navbar-collapse" id="mynavbar">
              <div <!--class="nav_bar"-->>
                <ul class="nav nav-pills nav-stacked">
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="">TBC<span class="caret"><span></a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo site_url("")?>">TBC1</a></li>
                      <li><a href="<?php echo site_url("")?>">TBC2</a></li>
                      <li><a href="<?php echo site_url("")?>">5</a></li>
                      <li><a href="<?php echo site_url("")?>">6</a></li>
                      <li><a href="<?php echo site_url("")?>">7</a></li>
                      <li><a href="<?php echo site_url("")?>">8</a></li>
                      <li><a href="<?php echo site_url("")?>">9</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            </div>
            </nav>'; 
          } ?>
        </ul>
        
      </div>
    </div>
  </div>
</nav>
<div class="container-fluid">