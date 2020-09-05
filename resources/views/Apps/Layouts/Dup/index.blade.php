<!DOCTYPE html>
<html lang="zxx" class="no-js">
    <head>
        @include($_config_path_layout . 'Dup.includes.include_meta') 
        <!-- Site Title -->
        <title><?php echo isset($title_for_layout) ? $title_for_layout : env('APP_TITLE'); ?></title>
        @include($_config_path_layout . 'Dup.includes.include_css') 
    </head>
    <body class="dup-body">
        <div class="dup-body-wrap">
            <?php if ($_path_content_app): ?>
                @include("{$_path_content_app}")
            <?php endif; ?>
            @include($_config_path_layout . 'Dup.includes.contact') 
            @include($_config_path_layout . 'Dup.includes.footer')
            <!-- End Footer Area -->
        </div>
        @include($_config_path_layout . 'Dup.includes.include_js')
    </body>
</html>