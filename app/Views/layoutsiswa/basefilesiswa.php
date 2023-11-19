<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Affan - PWA Mobile HTML Template">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title><?= $title ?> - SMKN 2 Cimahi</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="<?=base_url('img/icon_bara.png')?>">
    <link rel="apple-touch-icon" href="<?=base_url('img/icon_bara.png')?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?=base_url('img/icon_bara.png')?>">
    <link rel="apple-touch-icon" sizes="167x167" href="<?=base_url('img/icon_bara.png')?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('img/icon_bara.png')?>">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('css/bootstrap-icons.css')?>">
    <link rel="stylesheet" href="<?=base_url('css/tiny-slider.css')?>">
    <link rel="stylesheet" href="<?=base_url('css/baguetteBox.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('css/rangeslider.css')?>">
    <link rel="stylesheet" href="<?=base_url('css/vanilla-dataTables.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('css/apexcharts.css')?>">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="<?=base_url('/style.css')?>">
    <!-- Web App Manifest -->
    <link rel="manifest" href="manifest.json">
    <style>
        .password-toggle {
        position: absolute;
        right: 0;
        top: 0;
        height: 100%;
        display: flex;
        align-items: center;
        padding: 0.375rem;
        color: #6c757d;
        cursor: pointer;
        }
    </style>
</head>
<body>
    <?= $this->renderSection('content') ?>
    <?= $this->include('layoutsiswa/footersiswa') ?>
</body>
</html>
