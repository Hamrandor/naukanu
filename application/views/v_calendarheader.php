<html>
    <head>
        <title><?= $title ?></title>
  
<?php
    
    $link = array(
               'href' => base_url().'css/calendar.css',
               'rel'  => 'stylesheet',
               'type' => 'text/css'
    );
    
    echo link_tag($link);
    echo $library_src;
    echo $script_foot;
?>
</head>
<body>
    <div id="wrapper">
        <div id ="header">
            <h1>Kalender : <?php echo $title;?></h1>

