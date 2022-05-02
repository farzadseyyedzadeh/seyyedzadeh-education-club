<?php
if (isset($_POST['submit'])) {
    $email = $name = $courses = $age = '';
    define('REQUIRED_FIELD', 'This field is required');
    function cleanData($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $email = cleanData($_POST['email']);
    $name = cleanData($_POST['name']);
    $age = cleanData($_POST['age']);
    $courses = cleanData($_POST['courses']);
    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    $_SESSION['age'] = $age;
    $_SESSION['courses'] = $courses;

    if (empty($email)) {
        $_SESSION['errors']['emailError'] = REQUIRED_FIELD;
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']['emailError'] = 'Email is not valid';
        } else {
        }
    }

    if (empty($name)) {
        $_SESSION['errors']['nameError'] = REQUIRED_FIELD;
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $_SESSION['errors']['nameError'] = 'name is not valid';
        } else {
        }
    }
    if (empty($age)) {
        $_SESSION['errors']['ageError'] = REQUIRED_FIELD;
    } else {
        if (!preg_match("/^[0-9]+$/", $age)) {
            $_SESSION['errors']['ageError'] = 'age is not valid';
        } else {
        }
    }

    if (empty($courses)) {
        $_SESSION['errors']['coursesError'] = REQUIRED_FIELD;
    } else {
        if (!preg_match("/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/", $courses)) {
            $_SESSION['errors']['coursesError'] = 'Courses are not valid';
        } else {
        }
    }

    if (isset($_SESSION['errors'])) {
        header("Location: ../add-trainer.php");
        exit();
    } else {
        require 'dbh.inc.php';
        $email = mysqli_real_escape_string($conn, $email);
        $name = mysqli_real_escape_string($conn, $name);
        $age = mysqli_real_escape_string($conn, $age);
        $courses = mysqli_real_escape_string($conn, $courses);
        $sql = "INSERT INTO trainers(email,name,age,courses) VALUES(?,?,?,?);";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $email, $name,$age, $courses);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        session_unset();
        session_destroy();
        header("Location: ../index.php");
        exit();
    }
} else {
    // redirect
    header("Location: ../add-trainer.php");
    exit();
}
