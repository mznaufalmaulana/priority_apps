<?php
$isLogin = $this->session->userdata('id');
if ($isLogin == '') {
  redirect(BASE_URL . 'auth');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href=<?= BASE_THEME . 'images/icon/logo-mini.png' ?>>

  <title><?= $judul ?></title>

  <!-- Custom fonts for this template-->
  <link href=<?= BASE_THEME . "vendor/fontawesome-free/css/all.min.css" ?> rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href=<?= BASE_THEME . "css/sb-admin-2.css" ?> rel="stylesheet">
  <script src=<?= BASE_THEME . "vendor/jquery/jquery.min.js" ?>></script>

	<script src="https://cdn.tiny.cloud/1/z9pa3j34kuvrg3wuo62g6tdj0flzrds04xgth9avs3idj6ga/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

	<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
	<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
