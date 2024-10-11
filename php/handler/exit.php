<?php
session_start();
unset($_SESSION['user']);
header('Location: /Design_Lab_X');
session_destroy();