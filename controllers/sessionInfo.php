<?php

session_start();

if (isset($_SESSION)) {
    $userName = $_SESSION['username'];
}
