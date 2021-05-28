<?php
    require_once 'bootstrap.php';
    checkSessionInactive();
    loadView('index.view.php', $data);
