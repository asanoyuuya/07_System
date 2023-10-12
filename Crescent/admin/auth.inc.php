<?php

/**
 * ログイン認証判定
 * @return void
 */
function authConfirm(): void
{
    if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] === !true) {
        header('Location: login.php');
        exit;
    }
}