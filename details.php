<?php
if (isset($_POST['id_to_delete'])) {
    $id_to_delete = htmlspecialchars($_POST['id_to_delete']);
    require_once 'includes/dbh.inc.php';
    $id_to_delete = mysqli_real_escape_string($conn, $id_to_delete);
    $sql = "DELETE FROM trainers WHERE trainer_id=?;";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id_to_delete);
    mysqli_stmt_execute($stmt);
    mysqli_close($conn);
    header("Location: index.php");
}


if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    require_once 'includes/dbh.inc.php';
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT * FROM trainers WHERE trainer_id = ?;";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $trainer = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
}
?>
<?php require_once 'layouts/header.php' ?>
<div class="container center">
    <?php if ($trainer) : ?>
        <h4><?= $trainer['name'] ?></h4>
        <h6>who has <?= $trainer['age'] ?> years old</h6>
        <p>Created by: <?= $trainer['email'] ?></p>
        <p>Created at: <?= date($trainer['created_at']) ?></p>
        <h5>Courses</h5>
        <p><?= $trainer['courses'] ?></p>
        <form action="" method="POST">
            <input type="hidden" name="id_to_delete" value="<?= $trainer['trainer_id'] ?>">
            <input type="submit" value="delete" name="delete" class="btn brand z-depth-0">
        </form>
        <a class="btn brand z-depth-0" href="edit-trainer.php?id= <?= $trainer['trainer_id'] ?>">update
        </a>
    <?php else : ?>
        <p>No such a trainer</p>
    <?php endif ?>
</div>
<?php require_once 'layouts/footer.php' ?>