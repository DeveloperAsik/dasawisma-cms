<!doctype html>
<html class="no-js" lang="en">

    <head>
        <title><?php echo isset($title_for_layout) ? $title_for_layout : ''; ?></title>
        @include('Layouts.Autima.Includes.index.include_meta') 
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $_config_base_url . 'Lib/autima/assets/img/favicon.ico' ?>">
        @include('Layouts.Autima.Includes.index.include_css') 
    </head>

    <body>
        <!-- Main Wrapper Start -->
        @include('Layouts.Autima.Includes.index.header') 
        <!--Offcanvas menu area start-->
        <div class="off_canvars_overlay"></div>
        @include('Layouts.Autima.Includes.index.menu') 
        <!--Offcanvas menu area end-->
        <!--slider area start-->
        @include('Layouts.Autima.Includes.index.categories') 
        <!--slider area end-->
        <!--shipping area start-->
        @include('Layouts.Autima.Includes.index.mid-info') 
        <!--shipping area end-->
        <!--product area start-->
        <?php if ($_path_contentPath): ?>
            @include("{$_path_contentPath}")
        <?php endif; ?>
        <!--product area end-->
        <!--featured categories area start-->
        @include('Elements.Autima.feature_product') 
        <!--featured categories area end-->
        <!--banner area start-->
        @include('Elements.Autima.banner_bottom') 
        <!--banner area end-->
        <!--product area start-->
        @include('Elements.Autima.special_offers') 
        <!--product area end-->
        <!--brand area start-->
        @include('Elements.Autima.brand') 
        <!--brand area end-->
        <!--custom product area-->
        @include('Elements.Autima.custom_product') 
        <!--custom product end-->
        <!--call to action start-->
        @include('Elements.Autima.social_media') 
        <!--call to action end-->
        <!--footer area start-->
        @include('Layouts.Autima.Includes.index.footer') 
        <!--footer area end-->
        <!--news letter popup start-->
        @include('Elements.modal.Autima.index') 
        <!-- JS ============================================ -->
        @include('Layouts.Autima.Includes.index.include_js') 
    </body>
</html>