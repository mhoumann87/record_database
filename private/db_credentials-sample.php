<?php

/* ============================================================
 * Keep db_credentials in a separate file
 * 1.Easy to exclude this file from source code managers
 * 2. Unique credentials on development and production servers
 * 3. Unique credentials if working with multiple developers    
============================================================ */

/* ============================================================
* REMOVE -sample from the filename so you end up with:
* 'db_credentials.php'
* enter your information down below
============================================================= */

define("DB_SERVER", "Your Server Name");
define("DB_USER", "Your User name");
define("DB_PASS", "Your Password");
define("DB_NAME", "Your Database Name");