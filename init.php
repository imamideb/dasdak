<?php

session_start();

$app = require_once __DIR__ . '/config/app.php';

require 'vendor/autoload.php';

include_once __DIR__ . '/models/connections/CONN.php';
include_once __DIR__ . '/models/connections/DB.php';
include_once __DIR__ . '/models/emails/SendGridEmails.php';
include_once __DIR__ . '/models/Registrations.php';