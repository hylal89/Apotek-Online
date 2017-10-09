<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -----------------------------------------------------------------------
| Copyright (c) 2017 E-Apotek Online
| -----------------------------------------------------------------------
| NAMA APLIKASI 	: E-Apotek Online
| VERSI APLIKASI 	: v 1.0
| 
| ------------------------------------------------------------------------
| Aplikasi E-Apotek Online merupakan sistem informasi untuk usaha apotek
| yang dibuat dan didesain sedemikian rupa untuk memanajemen semua data
| yang ada dalam apotek agar terstruktur secara teratur. dan mendapatkan
| data laporan penjualan, pembelian, stok barang dll. secara cepat, dan
| mudah.
| ------------------------------------------------------------------------
| Aplikasi ini dibuat dan dikembangkan oleh Anas Amu.
| Dilarang menyebarkan aplikasi ini tanpa ijin dari pembuat.
|
| untuk kritik, saran, pelaporan bugs atau mendapatkan info mengenai 
| pembaharuan aplikasi ini silahkan email di anasamu7@gmail.com
| ------------------------------------------------------------------------
| 
| File Constants.php
|
| Perhatian !
| Dilarang melakukan perubahan dalam file ini jika anda tidak mengerti
| dengan code2 yang ada. perubahan yg dilakukan dapat menyebabkan aplikasi
| tidak berjalan dengan semestinya.
| --------------------------------------------------------------------------
*/

define('KEY', '465&ajIKehuy435%suyEDFg');
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb');
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b');
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
