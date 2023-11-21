<?php

    session_start();

    session_unset();
    session_destroy();

    header("location: /cwh/login.php");
    exit;
