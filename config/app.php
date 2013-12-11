<?php

// Set debug to 1 when debugging else set it to 0
define('DEBUG', 1);

define('DEFAULT_CONTROLLER', 'pages');
define('DEFAULT_METHOD', 'index');
define('DEFAULT_LAYOUT', 'default');
define('DEFAULT_VIEW_EXTENSION', '.php');
define('BACKEND_PREFIX', 'admin');

define('DAY', 86400);
define('HOUR', 3600);
define('MINUTE', 60);
define('SECOND', 1);

define('BOOKING_TIME', HOUR * 1.5);
define('INTERVAL', MINUTE * 15);

define('MIN_PEOPLE_BOOKING', 4);
define('MAX_PEOPLE_BOOKING_SAME_DAY', 9);
define('DEFAULT_MAX', 50);
define('ABSOLUTE_MAX', 150);

define('DEFAULT_TIME_START', '12:00:00');
define('DEFAULT_TIME_END', '23:45:00');

define('TIMESTAMP_FORMAT', 'Y-m-d H:i:s');
define('TIME_FORMAT', 'H:i:s');
define('DATE_FORMAT', 'Y-m-d');