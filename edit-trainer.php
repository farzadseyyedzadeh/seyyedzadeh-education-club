<?php
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

    session_start();
    $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : null;
    $courses = isset($_SESSION['courses']) ? $_SESSION['courses'] : null;

?>

    <?php require_once 'layouts/header.php' ?>
    <section class="container grey-text">
        <h4 class="center">edit details for <?php echo $trainer['name'] ?></h4>
        <form class="white" action="includes/edit-trainer.inc.php" method="POST">
            <label>Trainer Email</label>
            <input type="text" name="email" value=" <?= $trainer['email'] != null ?  $trainer['email'] : null; ?> ">
            <div class="red-text"> <?= isset($errors['emailError']) ? $errors['emailError'] : null; ?></div>
            <label>Trainer Name</label>
            <input type="text" name="name" value=" <?= $trainer['name'] != null ?  $trainer['name']  : null; ?> ">
            <div class="red-text"> <?= isset($errors['nameError']) ? $errors['nameError'] : null; ?></div>
            <label>Courses (comma separated)</label>
            <input type="text" name="courses" value=" <?= $trainer['courses'] != null ?  $trainer['courses']  : null; ?> ">
            <div class="red-text"> <?= isset($errors['coursesError']) ? $errors['coursesError'] : null; ?></div>
            <div class="center">
                <input type="hidden" name="id_to_update" value="<?= $trainer['trainer_id'] ?>">
                <input type="submit" name="update" value="update" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
    <?php require_once 'layouts/footer.php' ?>
    <?php
    session_unset();
    session_destroy();
    ?>
<?php
} else {
    session_start();
    $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : null;
    $courses = isset($_SESSION['courses']) ? $_SESSION['courses'] : null;
?>
    <?php require_once 'layouts/header.php' ?>
    <section class="container grey-text">
        <h4 class="center">edit details for <?= $name ?></h4>
        <form class="white" action="includes/edit-trainer.inc.php" method="POST">
            <label>Trainer Email</label>
            <input type="text" name="email" value=" <?= $email != null ? $email : null; ?> ">
            <div class="red-text"> <?= isset($errors['emailError']) ? $errors['emailError'] : null; ?></div>
            <label>Trainer Name</label>
            <input type="text" name="name" value=" <?= $name != null ? $name : null; ?> ">
            <div class="red-text"> <?= isset($errors['nameError']) ? $errors['nameError'] : null; ?></div>
            <label>Courses (comma separated)</label>
            <input type="text" name="courses" value=" <?= $courses != null ? $courses : null; ?> ">
            <div class="red-text"> <?= isset($errors['coursesError']) ? $errors['coursesError'] : null; ?></div>
            <div class="center">
                <input type="submit" name="update" value="update" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
    <?php require_once 'layouts/footer.php' ?>
<?php
    session_unset();
    session_destroy();
}
?>