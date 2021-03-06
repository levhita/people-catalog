 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>People Catalog | Admin</title>
    
    <?php foreach($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>

    <?php foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>

    <style type='text/css'>
        body
        {
            font-family: Arial;
            font-size: 14px;
        }
        a {
            color: blue;
            text-decoration: none;
            font-size: 14px;
        }
        a:hover
        {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Beginning header -->
    <div>
        <a href='<?php echo site_url('admin/tags')?>'>Tags</a> |
        <a href='<?php echo site_url('admin/people')?>'>People</a> |
        <a href='<?php echo site_url('admin/extra')?>'>Extra</a> |
        <a href='<?php echo site_url('admin/contact')?>'>Contact</a> |
        <a href='<?php echo site_url('admin/assets')?>'>Assets</a> |
        <a href='<?php echo site_url('admin/configurations')?>'>Configurations</a> |
        <a href='<?php echo site_url('admin/logout')?>'>Logout</a>
    </div>
    <!-- End of header-->
    <div style='height:20px;'></div>  
    <div>
        <?php echo $_content_for_layout ?>
    </div>
    <!-- Beginning footer -->
    <div></div>
    <!-- End of Footer -->
</body>
</html>