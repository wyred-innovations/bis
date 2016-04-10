<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary' => base_path('/vendor/bin/wkhtmltox/bin/wkhtmltopdf-64'),
        'timeout' => false,
        'options' => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary' => base_path('/vendor/bin/wkhtmltoimage'),
        'timeout' => false,
        'options' => array(),
    ),


);
