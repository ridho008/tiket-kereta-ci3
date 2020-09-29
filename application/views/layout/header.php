<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title; ?></title>
	<link rel="stylesheet" href="<?= base_url('/assets/'); ?>css/bootstrap.min.css">
	<link href="<?= base_url('/assets/'); ?>fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url('/assets/'); ?>css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container">
	  <a class="navbar-brand" href="<?= base_url(); ?>">Kerete API</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	    <div class="navbar-nav">
	      <a class="nav-link<?= $this->uri->segment(1) != 'tamu' ? ' active' : ''; ?>" href="<?= base_url(); ?>">Home</a>
	      <a class="nav-link<?= $this->uri->segment(2) == 'pembayaran' ? ' active' : ''; ?>" href="<?= base_url('tamu/pembayaran'); ?>">Konfirmasi Pembayaran</a>
	      <a class="nav-link<?= $this->uri->segment(1) == 'jadwal' ? ' active' : ''; ?>" href="<?= base_url('jadwal'); ?>">Kelola Jadwal</a>
	    </div>
	  </div>
	</div>
</nav>