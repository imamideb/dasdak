<?php include_once __DIR__ . '/partials/header.php'; session_destroy(); ?>
<body class="landing">
<div class="container-fluid">
<div class="row">
<div class="right-panel-container">
<?php include_once __DIR__ . '/partials/right_panel.php'; ?>
</div>
<div class="left-panel-container">
<div class="left-panel">
<div class="glyphicon glyphicon-menu-down form-focus-trigger" aria-hidden="true"></div>
<h4 class="address">Bon Secours Training Center, 2401 W Lelgh St, Richmond, VA 23220</h4>
<h4 class="text-center title"><strong>2018 Redskins Training Camp</strong></h4>
<div class="registration_form">
<form name="registration" method="post" class="clearfix" action="codes/registrations.php">
<?php include_once __DIR__ . '/partials/screenshot_1_left_panel.php'; ?>
<?php include_once __DIR__ . '/partials/footer.php'; ?>