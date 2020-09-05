<link href="https://fonts.googleapis.com/css?family=Poppins:100,300,500" rel="stylesheet">
<!-- CSS ============================================= -->
<link rel="stylesheet" href="<?php echo $_path_css . '/css/default.css'; ?>">
<link rel="stylesheet" href="<?php echo $_path_templates . '/dup/css/linearicons.css'; ?>">
<link rel="stylesheet" href="<?php echo $_path_templates . '/dup/css/owl.carousel.css'; ?>">
<link rel="stylesheet" href="<?php echo $_path_templates . '/dup/css/font-awesome.min.css'; ?>">
<link rel="stylesheet" href="<?php echo $_path_templates . '/dup/css/nice-select.css'; ?>">
<link rel="stylesheet" href="<?php echo $_path_templates . '/dup/css/magnific-popup.css'; ?>">
<link rel="stylesheet" href="<?php echo $_path_templates . '/dup/css/bootstrap.css'; ?>">
<link rel="stylesheet" href="<?php echo $_path_templates . '/dup/css/main.css'; ?>">

<!-- load css lib / class / library from controller start here -->
<?php if (isset($load_css) && !empty($load_css)) : ?>
    <?php foreach ($load_css AS $key => $values) : ?>
        <link href="<?php echo $_config_lib_url . $values ?>" rel="stylesheet" type="text/css"/>
    <?php endforeach; ?>
<?php endif; ?>
<!-- load css lib / class / library from controller end here -->