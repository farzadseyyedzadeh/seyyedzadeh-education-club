<?php

if (isset($_POST['update'])) {
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
    $courses = cleanData($_POST['courses']);
    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
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
    if (empty($courses)) {
        $_SESSION['errors']['coursesError'] = REQUIRED_FIELD;
    } else {
        if (!preg_match("/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/", $courses)) {
            $_SESSION['errors']['coursesError'] = 'Courses are not valid';
        } else {
        }
    }

    if (isset($_SESSION['errors'])) {
        header("Location: ../edit-trainer.php");
        exit();
    } else {
        require "dbh.inc.php";
        $id_to_update = htmlspecialchars($_POST['id_to_update']);
        $email = $_POST['email'];
        $name = $_POST['name'];
        $courses = $_POST['courses'];
        $sql = "UPDATE trainers SET email = ? , name = ? , courses= ?  WHERE trainer_id = ?;";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $email, $name, $courses, $id_to_update);
        mysqli_stmt_execute($stmt);
        mysqli_close($conn);
        session_unset();
        session_destroy();
    }
    header('location: ../index.php');
    exit();
} else {
    header("Location: ../edit-trainer.php");
    exit();
}
