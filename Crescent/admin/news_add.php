<?php

session_start();
require_once(dirname(__FILE__) . '/auth.inc.php');
authConfirm();

require_once(dirname(__FILE__) . '/../util.inc.php');
require_once(dirname(__FILE__) . '/../Models/News.php');

const IMG_PATH = '../images/press/';

$isValidated = false;
$posted      = (new DateTime())->format('Y-m-d');
$title       = '';
$message     = '';
$image       = '';

if (!empty($_POST)) {
    $isValidated = true;
    $posted      = $_POST['posted'];
    $title       = $_POST['title'];
    $message     = $_POST['message'];

    if ($title === '' || preg_match('/^(\s|　)+$/u', $title)) {
        $titleError  = '※タイトルを入力してください';
        $isValidated = false;
    } elseif (strlen($title) > 20) {
        $titleError  = '※タイトルを20文字以内で入力してください';
        $isValidated = false;
    }

    if ($message === '' || preg_match('/^(\s|　)+$/u', $message)) {
        $messageError = '※お知らせ内容を入力してください';
        $isValidated  = false;
    }

    if (!empty($_FILES)) {
        if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $image = basename($_FILES['image']['name']);
            if (
                !move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    IMG_PATH . mb_convert_encoding($image, 'cp932', 'utf8')
                )
            ) {
                $imageError  = 'ファイルの移動に失敗しました';
                $isValidated = false;
            }
        } elseif ($_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {

        } else {
            $imageError  = 'ファイルのアップロードはシステムエラーです';
            $isValidated = false;
        }
    }

    if ($isValidated === true) {

        $postArr = [
            'posted'  => $posted,
            'title'   => $title,
            'message' => $message,
            'image'   => $image
        ];

        (new News())->add($postArr);
        header('Location: news_add_done.php');
        exit;
    }
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>お知らせの追加 | Crescent Shoes 管理</title>
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <header>
        <div class="inner">
            <span><a href="index.php">Crescent Shoes 管理</a></span>
            <?php include dirname(__FILE__) . '/account.parts.php'; ?>
        </div>
    </header>
    <div class="container">
        <main>
            <h1>お知らせの追加</h1>
            <p>情報を入力し、「追加」ボタンを押してください。</p>
            <form action="" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th class="fixed">日付(任意)</th>
                        <td>
                        <input type="date" name="posted" value="<?= h($posted) ?>">
                        </td>
                    </tr>
                    <tr>
                        <th class="fixed">タイトル</th>
                        <td>
                            <?php if (isset($titleError)): ?>
                                    <div class="error"><?= $titleError ?></div>
                            <?php endif; ?>
                        <input type="text" name="title" size="80" value="<?= h($title) ?>">
                        </td>
                    </tr>
                    <tr>
                        <th class="fixed">お知らせの内容</th>
                        <td>
                            <?php if (isset($messageError)): ?>
                                    <div class="error"><?= $messageError ?></div>
                            <?php endif; ?>
                        <textarea name="message" cols="80" rows="5"><?= h($message) ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th class="fixed">画像(任意)</th>
                        <td>
                            <?php if (isset($imageError)): ?>
                                    <p class="error"><?= $imageError ?></p>
                            <?php endif; ?>
                            <input type="file" name="image">
                            <div>画像は64x64ピクセルで表示されます</div>
                            <?php if ($image): ?>
                                    <img src="<?= IMG_PATH . ($image ?: 'press.jpg') ?>" width="64" height="64" alt="">
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <p>
                    <input type="submit" name="add" value="追加">
                    <input type="submit" name="cancel" value="キャンセル">
                </p>
            </form>
        </main>
        <footer>
            <p>&copy; Crescent Shoes All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
