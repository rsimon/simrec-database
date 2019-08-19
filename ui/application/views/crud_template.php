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
        border-width:8px 0 0 0;
        padding:0;
        color:#5385c1;
        font-size:22px;
        font-weight:bold;
        box-shadow:0 1px 12px rgba(0,0,0,0.3);
      }

      .header ul {
        list-style-type:none;
        padding:0;
        margin:0;
        padding:0 20px;
        border-bottom:2px solid #5385c1;
        background-color:rgba(83, 133, 193, 0.15);
      }

      .header li {
        display:inline-block;
        padding:10px;
      }

      .header .title {
        padding:30px;
        background-color:#5385c1;
        color:#fff;
      }

      .content {
        padding:30px;
      }

      .content > div {
        box-shadow:0 0 12px rgba(0, 0, 0, 0.15);
      }

      a {
        color:#5385c1;
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
        <li><a href='<?php echo site_url('crud/route_types')?>'>Route Types</a></li>
      </ul>

      <div class="title"><?php echo $data['title'] ?></div>
    </div>

    <div class="content">
        <?php echo $output; ?> 
    </div>
  </body>
</html>