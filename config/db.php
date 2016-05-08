<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=mob_new;',
    //'dsn' => 'mysql:host=localhost;port=8889;dbname=mob_new;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock',
    'username' => 'mobnew',
    'password' => 'mob@123',
    'charset' => 'utf8',
];


/*
SELECT
  id, (
    3959 * acos (
      cos(radians(13.0595) )
      * cos(radians(vendor_latitude))
      * cos(radians(vendor_longitude) - radians(80.2425))
      + sin(radians(13.0595))
      * sin(radians(vendor_latitude ))
    )
  ) AS distance
FROM mob_location
HAVING distance < 30
ORDER BY distance
LIMIT 0 , 20

*/
