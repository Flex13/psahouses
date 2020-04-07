<?php ob_start(); ?>
<?php session_start(); ?>
<?php
if (!isset($page_title)) {
    $page_title = 'PSA Houses Community';
    }
?>

<?php include('functions.php');?>

<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $page_title; ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css" />

</head>
<body>
<!-- Navbar -->
<?php include('navbar.php'); ?>
<!-- Navbar -->