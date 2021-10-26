<?php


include_once '../app/app.php';

$getVaccinesStatement = $pdo->prepare('SELECT * FROM vaccines');
$getVaccinesStatement->execute();
$vaccines = $getVaccinesStatement->fetchAll(PDO::FETCH_ASSOC);

$batchNo = '';
$expiryDate = '';
$quantityAvailable = '';


if (is_post()) {

    require_once 'form-validation/batch_validation.php';

    if (empty($errors)) {

        $addBatchStatement = $pdo->prepare("INSERT INTO batches (batchNo, expiryDate, quantityAvailable, quantityPending, quantityAdministered, vaccineID)
    VALUES (:batchNo,:expiryDate,:quantityAvailable,:quantityPending, :quantityAdministered, :vaccineID)");
        $addBatchStatement->bindValue(':batchNo', $batchNo);
        $addBatchStatement->bindValue(':expiryDate', $expiryDate);
        $addBatchStatement->bindValue(':quantityAvailable', $quantityAvailable);
        $addBatchStatement->bindValue(':quantityPending', 0);
        $addBatchStatement->bindValue(':quantityAdministered', 0);
        $addBatchStatement->bindValue(':vaccineID', $vaccineID);

        $addBatchStatement->execute();

        $batchNo = '';
        $expiryDate = '';
        $quantityAvailable = '';
        redirect('RecordNewVaccineBatch.php');
    }
    // else{

    //     echo "<script>
    //     document.getElementbyId('form').addEventListener('submit', (e) => {
    //         e.preventDefault();
    //       });
    //     </script>";
    // }
}

include_once '../views/partials/header.php';

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
                            <a class="dropdown-item" href="AdminMenu.html">Dashboard <i class="fas fa-user"></i></a>
                            <a class="dropdown-item" href="ViewVaccineBatchInfo.html">View Vaccine Batch Info</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Log Out <i class="fas fa-sign-out-alt"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <h2 class="page-title">Record New Vaccine Batch</h2>

    <!-- Vaccine table -->

    <div class="container mt-3">
        <h3 class="instruction">Select a vaccine to record new batch:</h3>

        <div class="scrollable">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Vaccine ID</th>
                        <th scope="col">Vaccine Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vaccines as $vaccine) : ?>
                        <tr onclick="saveVaccineForNewBatch(this)">
                            <td class="vaccineID"><?php echo $vaccine["vaccineID"]; ?><span id="hidden-vaccineID"></span></td>
                            <td><?php echo $vaccine["vaccineName"]; ?></td>
                            <td>
                                <i class="fas fa-plus-square fa-2x" onclick="openPopUp()"></i>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pop-up window -->
    <div class="popup-overlay"></div>
    <div class="popup record-new-batch">
        <div class="popup-close" onclick="closePopUp()">&times;</div>
        <h3 class="header">Record New Batch:</h3>
        <div class="information">
            <p>Vaccine Name</p>
            <p>Manufacturer</p>
        </div>
        <div class="container form-container">
            <form id="form" class="validation-form" method="post">
                <div class="form-control">
                    <label for="batchNo">Batch no.:</label>
                    <input type="text" placeholder="BXXX" id="batchNo" name="batchNo" value="<?php echo $batchNo; ?>"/>
                    <?php if (isset($blankBatchNoMsg)){ ?>
                        <small><?php echo $blankBatchNoMsg; ?></small>
                        <?php } ?>
                 
                </div>
                <div class="form-control">
                    <label for="expiryDate">Expiry date:</label>
                    <input type="date" id="expiryDate" name="expiryDate"  value="<?php echo $expiryDate; ?>"/>
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if (isset($blankExpiryDateMsg)){ ?>
                        <small><?php echo $blankExpiryDateMsg; ?></small>
                        <?php } ?>
                </div>
                <div class="form-control">
                    <label for="quantiy">Quantity of doses available:</label>
                    <input type="number" id="quantity" name="quantityAvailable"  value="<?php echo $quantityAvailable; ?>" />
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if (isset($blankQuantityMsg)){ ?>
                        <small><?php echo $blankQuantityMsg; ?></small>
                        <?php } ?>
                </div>
                <button type="submit" name="add">Record</button>
            </form>
        </div>
    </div>


    <?php include_once '../views/partials/footer.php'; ?>