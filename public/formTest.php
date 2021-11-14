<?php


include_once '../views/partials/header.php';

?>



<form id='form' class='validation-form'>
  <input type='hidden' value='VC111' name='vaccinationID' id='vaccinationID' class='form_data' />
  <input type='hidden' value='Confirmed' name='status' id='status' class='form_data' />
  <input type='hidden' value='b122' name='batchNo' id='batchNo' class='form_data' />
  <div class='form-control'>
    <label for='remarks'>Remarks:</label>
    <input type='text' placeholder='Any remarks?' name='remarks' id='remarks' class='form_data' />
  </div>
  <button type='button' name='submit' id='submit' onclick='updateToAdministered(); return false;'>Record</button>
</form>

<?php


include_once '../views/partials/footer.php';



?>