<?php
/**
 * Created by PhpStorm.
 * User: savchenko
 * Date: 25.01.17
 * Time: 16:48
 */

require_once 'common.php';

if (isset($_POST['token']) && isset($_SESSION['auth_url'])) {
    $g = new GoogleSheets($config['googleAppName'], $config['googleCredentialsFile'], $config['googleClientSecretFile']);
    $saved = $g->saveAccessToken($_POST['token']);
    if ($saved)
        echo 'Token is saved, you can use webhook now.';
} else {
    if ($_SESSION['auth_url'] == null) {
        echo '<a href="index.php">index.php</a>';
        die;
    }
    $authUrl = $_SESSION['auth_url'];
    require_once 'views/token-form.php';
}