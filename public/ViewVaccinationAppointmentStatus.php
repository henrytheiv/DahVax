<?php

session_start();

require_once '../app/app.php';

$username = $_SESSION['user'];

require_once 'checkPatientSignIn.php';

$getVaccinations = $pdo->prepare("SELECT * FROM vaccinations WHERE username = :username");
$getVaccinations->bindValue(":username", $username);
$getVaccinations->execute();
$vaccinations = $getVaccinations->fetchAll(PDO::FETCH_ASSOC);


$title = "DahVax - View Vaccination Appointment Status";


include_once "../views/partials/header.php";


?>

<nav class="navbar navbar-expand-lg custom-navbar" id="navbarNav">
    <span class="navbar-brand mb-0 h1">DahVax</span>
    <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <div id="my-custom-ddl">
                    <a onclick="dropDownIconChange()" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu
                        <i class="fas fa-bars"></i>
                    </a>
                    <div class="dropdown-menu custom-nav-dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="PatientMenu.php">Dashboard <i class="fas fa-user"></i></a>
                        <a class="dropdown-item" href="VRequestVaccinationAppointment.php">Request Vaccination Appointment</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Log Out <i class="fas fa-sign-out-alt"></i></a>
            </li>
        </ul>
    </div>
</nav>

<h2 class="page-title">View Vaccination Appointment Status</h2>

<!-- Vaccine table -->

<div class="container mt-3">

    <?php if ($getVaccinations->rowCount() > 0) {  ?>
        <div class="row justify-content-center">
            <div class="col-6">
                <h3 class="instruction">Select a vaccination appointment to view:</h3>
            </div>
        </div>
        <div class="row justify-content-center">

            <div class="col-6 text-center">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Vaccination ID</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vaccinations as $vaccination) : ?>
                            <tr>
                                <td><?php echo $vaccination["vaccinationID"]; ?></td>
                                <td>
                                    <i class="fas fa-eye fa-2x view_data" id="<?php echo $vaccination['vaccinationID']; ?>" data-toggle="modal" data-target="#vaccinationDetail" onclick="getVaccinationAppointmentDetail(this.id)"></i>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php  } else { ?>

        <h3 class="text-center">No vaccination appointments requested yet.</h3>

    <?php  } ?>
</div>

<div class="modal fade" id="vaccinationDetail" tabindex="-1" role="dialog" aria-labelledby="VaccinationDetailTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="VaccinationDetailTitle">Vaccination Details</h3>
                <i class="fas fa-window-close fa-2x close" data-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body">
                <div id="vaccination-detail">


                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function getVaccinationAppointmentDetail(id) {

        var vaccinationID = id;

        $.ajax({
            url: "selected_vaccination_appointment.php",
            method: "POST",
            data: {
                vaccinationID: vaccinationID
            },
            success: function(data) {
                $("#vaccination-detail").html(data);
            }

        });





    }
</script>