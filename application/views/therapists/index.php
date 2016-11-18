
<!-- <form>

  <label for="fname">First name</label>
  <input type="input" name="fname" /><br />

  <label for="lname">Last name</label>
  <input type="input" name="lname" /><br />

  <input type="submit" name="submit" value="Add therapist" />

</form> -->

<table class="table table-striped">
  <th colspan="2">
    <h4>Therapists</h4>
  </th>
  <tr>
    <th>
      <h4>First Name</h4>
    </th>
    <th>
      <h4>Last Name</h4>
    </th>
  </tr>

    <?php foreach ($therapists as $therapist_item): ?>

        <tr>
          <td>
            <?php echo $therapist_item['f_name']; ?>
          </td>
          <td>
            <?php echo $therapist_item['l_name']; ?>
          </td>
        </tr>

    <?php endforeach; ?>
</table>
