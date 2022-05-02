<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
$name = isset($_SESSION['name']) ? $_SESSION['name'] : null;
$age = isset($_SESSION['age']) ? $_SESSION['age'] : null;
$courses = isset($_SESSION['courses']) ? $_SESSION['courses'] : null;

?>

<?php require_once 'layouts/header.php' ?>
<section class="container grey-text">
    <h4 class="center">Add a Trainer</h4>
    <form class="white" action="includes/add-trainer.inc.php" method="POST">
        <label>Trainer Email</label>
        <input type="text" name="email" value=" <?= $email != null ? $email : null; ?> ">
        <div class="red-text"> <?= isset($errors['emailError']) ? $errors['emailError'] : null; ?></div>
        <label>Trainer Name</label>
        <input type="text" name="name" value=" <?= $name != null ? $name : null; ?> ">
        <div class="red-text"> <?= isset($errors['nameError']) ? $errors['nameError'] : null; ?></div>
        <label>Trainer Age</label>
        <input type="text" name="age" value=" <?= $age != null ? $age : null; ?> ">
        <div class="red-text"> <?= isset($errors['ageError']) ? $errors['ageError'] : null; ?></div>
        <label>Courses (comma separated)</label>
        <input type="text" name="courses" value=" <?= $courses != null ? $courses : null; ?> ">
        <div class="red-text"> <?= isset($errors['coursesError']) ? $errors['coursesError'] : null; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>
<?php require_once 'layouts/footer.php' ?>
<?php
session_unset();
session_destroy();
?>