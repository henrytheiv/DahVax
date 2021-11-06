<?php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  session_start();

  $output = "";

  require_once "../app/database.php";

  $batchNo = $_POST['batchNo'];

  $getVaccinationsSql = $pdo->prepare("SELECT * FROM vaccinations WHERE batchNo = :batchNo");
  $getVaccinationsSql->bindValue(":batchNo", $batchNo);
  $getVaccinationsSql->execute();
  $vaccinations = $getVaccinationsSql->fetchAll(PDO::FETCH_ASSOC);

  if (empty($vaccinations)) {

    $output = "<h3 class='p-5 text-center'>No vaccinations requested yet.</h3>";
  }

  foreach ($vaccinations as $vaccination) {


    $output = '<div class="scrollable">
        <table class="table table-hover p-0">
        <thead>
          <tr>
            <th scope="col">Vaccination ID</th>
            <th scope="col">Appointment date</th>
            <th scope="col">Status</th>
            <th scope="col">Remarks</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            <tr>
                <td>' . $vaccination["vaccinationID"] . '</td>
                <td>' . $vaccination["appointmentDate"] . '</td>
                <td>' . $vaccination["status"] . '</td>
                <td>' . $vaccination["remarks"] . '</td>
                <td>
                <i class="fas fa-edit fa-2x" id="'. $vaccination['vaccinationID'] .'" data-toggle="modal" href="#myModal2" onclick="getVaccination()"></i>
                </td>
            </tr>
        </tbody>
      </table>

      </div>';
  }

  echo $output;
}
