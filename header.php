<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Portal</title>
    <style>
        body {
            background: linear-gradient(rgba(255, 239, 194, 0.9), rgba(255, 239, 194, 0.9)), url('https://images.pexels.com/photos/2980066/pexels-photo-2980066.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500') no-repeat center center/cover;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">PORTAL</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php if (!empty($_SESSION['logged_in'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Dashboard</a>
                    </li>
                    <?php if ($_SESSION['user']->role === 'admin') : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./assign_subject.php">Subjects</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Faculty
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="./add_faculty.php">Add</a>
                                <a class="dropdown-item" href="./list_faculty.php">List</a>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if ($_SESSION['user']->role === 'faculty' || $_SESSION['user']->role === 'admin') : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Student
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php if ($_SESSION['user']->role === 'faculty') : ?>
                                    <a class="dropdown-item" href="./add_student.php">Add</a>
                                <?php endif; ?>
                                <a class="dropdown-item" href="./list_student.php">List</a>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if ($_SESSION['user']->role === 'faculty' || $_SESSION['user']->role === 'student') : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Attendance
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php if ($_SESSION['user']->role === 'faculty') : ?>
                                    <a class="dropdown-item" href="./add_attendance.php">Add</a>
                                <?php endif; ?>
                                <a class="dropdown-item" href="./list_attendance.php">List</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Mark Sheet
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="./list_marksheet.php">View</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Assignment
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php if ($_SESSION['user']->role === 'faculty') : ?>
                                    <a class="dropdown-item" href="./add_assignment.php">Add</a>
                                <?php endif; ?>
                                <?php if ($_SESSION['user']->role === 'student') : ?>
                                    <a class="dropdown-item" href="./submit_assignment.php">Submit</a>
                                <?php endif; ?>
                                <a class="dropdown-item" href="./list_assignment.php">List</a>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if($_SESSION['user']->role === 'student') : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./messages.php">Messages</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav">
                <?php if (empty($_SESSION['logged_in'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php">Login</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container my-5">