

<?php echo validation_errors(); ?>

<?php echo form_open('therapists/create') ?>


  <div class="">

    <div class="container">
      <ul class="nav nav-tabs">
        <li role="presentation" class="">
          <a href="/UH-Team-A/index.php/therapists">BACK</a>
        </li>

      </ul>
    </div>
    <br>
    <div class="container">
      <div class="form-group">

        <div class="create-form">
          <label for="fname">First name</label>
          <input class="form-control" type="input" name="fname" />
        </div>

        <div class="">
          <label for="lname">Last name</label>
          <input class="form-control" type="input" name="lname" />
        </div>

        <br>
        <button class="btn btn-default" type="submit" name="submit">Add Therapist</button>

      </div>
    </div>

  </div>

</form>
