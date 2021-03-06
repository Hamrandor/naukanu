<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <title>Kalendar</title>
    </head>
    <meta charset="UTF-8">
    <style type="text/css">
        .calendar {
            background: #FFFFFF;
            font-family: Arial, Verdana, Sans-serif;
            width: 95%;
            min-width: 960px;
            border-collapse: collapse;
        }

        .calendar tbody tr:first-child th {
            color: #505050;
            margin: 0 0 10px 0;
        }

        .day_header {
            font-weight: normal;
            text-align: center;
            color: #757575;
            font-size: 10px;
        }

        .calendar td {
            width: 14%; /* Force all cells to be about the same width regardless of content */
            border:1px solid #CCC;
            height: 100px;
            vertical-align: top;
            font-size: 10px;
            padding: 0;
        }

        .calendar td:hover {
            background: #F3F3F3;
        }

        .day_listing {
            display: block;
            text-align: right;
            font-size: 12px;
            color: #2C2C2C;
            padding: 5px 5px 0 0;
        }

        div.today {
            background: #E9EFF7;
            height: 100%;
        } 
    </style>
    <body>
        <?php echo $calendar; ?> 
    </body>
</html>


