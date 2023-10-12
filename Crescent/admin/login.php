<?php declare(strict_types=1);

session_start();

require_once(dirname(__FILE__) . '/../Models/Auth.php');
require_once(dirname(__FILE__) . '/../util.inc.php');

if (isset($_SESSION['authenticated']) && (isset($_SESSION['login_id']))) {
    header('Location: index.php');
    exit;
}

$isValidated = false;
$login_id    = '';
$login_pass  = '';

if (!empty($_POST)) {
    $isValidated = true;
    $login_id    = $_POST['login_id'];
    $login_pass  = $_POST['login_pass'];

    if ($login_id === '' || preg_match('/^(\s|　)+$/u', $login_id)) {
        $login_idError = 'ログインIDを入力してください';
        $isValidated   = false;
    }

    if ($login_pass === '' || preg_match('/^(\s|　)+$/u', $login_pass)) {
        $login_passError = 'パスワードを入力してください';
        $isValidated     = false;
    }

    $isLoggedIn = (new Auth())->login($login_id);

    if ($isValidated === true && $login_id === $isLoggedIn['login_id'] && password_verify($login_pass, $isLoggedIn['login_pass'])) {

        session_regenerate_id(true);
        $_SESSION['login_id']      = $login_id;
        $_SESSION['authenticated'] = true;

        header('Location: index.php');
        exit;

    } else {
        $verifyError = 'ログインIDもしくはパスワードに誤りがあります';
    }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ログイン | Crescent Shoes 管理</title>
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <header>
        <div class="inner">
            <span><a href="index.php">Crescent Shoes 管理</a></span>
        </div>
    </header>
    <div class="container">
        <main>
            <h1>ログイン</h1>
            <?php if (isset($verifyError)): ?>
                <p class="error"><?= $verifyError ?></p>
            <?php endif; ?>
            
            <?php if (isset($login_idError)): ?>
                <p class="error"><?= $login_idError ?></p>
            <?php endif; ?>
            
            <?php if (isset($login_passError)): ?>
                <p class="error"><?= $login_passError ?></p>
            <?php endif; ?>
            
            <form action="" method="post">
                <table class="loginbox">
                    <tr>
                        <th>ログインID</th>
                        <td><input type="text" name="login_id" value="<?=h($login_id)?>"></td>
                    </tr>
                    <tr>
                        <th>パスワード</th>
                        <td><input type="password" name="login_pass" value="<?=h($login_pass)?>"></td>
                    </tr>
                </table>
                <p>
                    <input type="submit" value="ログイン">
                    ※ログインID・パスワードの登録は<a href="asign.php">こちら</a>
                </p>
            </form>
        </main>
        <footer>
            <p>&copy; Crescent Shoes All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
