<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
 
    <?php 
    foreach($css_files as $file): ?>
      <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    
    <?php endforeach; ?>

    <?php foreach($js_files as $file): ?> 
      <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>

    <style type='text/css'>
      body {
        font-family:Arial;
        font-size:14px;
        padding:0;
        margin:0;
      }

      .header {
        border-color:#5385c1;
        border-style:solid;
        border-width:8px 0 3px 0;
        padding:0;
        color:#5385c1;
        font-size:22px;
        font-weight:bold;
      }

      .header ul {
        list-style-type:none;
        padding:0;
        margin:0;
        padding:0 20px;
        border-bottom:2px solid #5385c1;
      }

      .header li {
        display:inline-block;
        padding:10px;
      }

      .header .title {
        padding:20px 30px 30px 30px;
      }

      a {
        color: blue;
        text-decoration: none;
        font-size: 14px;
      }

      a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <div class="header">
      <ul class="menu">
        <li><a href='<?php echo site_url('crud/routes')?>'>Routes</a></li>
        <li><a href='<?php echo site_url('crud/places')?>'>Places</a></li>
        <li><a href='<?php echo site_url('crud/network')?>'>Network</a></li>
        <li><a href='<?php echo site_url('crud/named_routes')?>'>Named Routes</a></li>
        <li><a href='<?php echo site_url('crud/bibliography')?>'>Bibliography</a></li>
        <li><a href='<?php echo site_url('crud/route-types')?>'>Route Types</a></li>
      </ul>

      <div class="title"><?php echo $data['title'] ?></div>
    </div>

    <div class="content">
        <?php echo $output; ?> 
    </div>
  </body>
</html>