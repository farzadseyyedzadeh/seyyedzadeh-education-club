<?php

require_once 'includes/dbh.inc.php';


$sql = "SELECT * FROM trainers;";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$Result = mysqli_stmt_get_result($stmt);
$trainers = mysqli_fetch_all($Result, MYSQLI_ASSOC);
mysqli_free_result($Result);
mysqli_close($conn);


//test
?>

<?php require_once 'layouts/header.php' ?>

<h4 class="center grey-text">Trainers</h4>
<div class="container">
    <div class="row">
        <?php foreach ($trainers as $trainer) : ?>
            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h6><?= $trainer['name'] ?></h6>
                        <ul>
                            <?php foreach (explode(',', $trainer['courses']) as $course) : ?>
                                <li> <?= $course ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="card-action right-align">
                        <a href="details.php?id= <?= $trainer['trainer_id'] ?>" class="brand-text">More info
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?php require_once 'layouts/footer.php' ?>
