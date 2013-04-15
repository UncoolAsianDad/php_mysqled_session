<?php

include_once('session.php');


//echo session_id();

$_SESSION['key'] = 'value';
//$_SESSION['test'] = 'hmm';

var_dump($_SESSION);
