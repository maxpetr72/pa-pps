<html>
    <head>
        <link rel="stylesheet" href="./debug.css"/>
        <title>Test debuging</title>
    </head>
    <body>
        <div class="test">
            <?php
                $object = new stdClass();
                $array = array(1, 'var_dump test', 4 => $object);
                var_dump($array);
                echo 'Xdebug';
                phpinfo();
            ?>
        </div>
    </body>
</html>