<?php declare(strict_types=1);

session_start();
require_once(dirname(__FILE__) . '/auth.inc.php');
authConfirm();

require_once(dirname(__FILE__) . '/../Models/News.php');
require_once(dirname(__FILE__) . '/../util.inc.php');


const IMG_PATH = '../images/press/';
const NUM_PER_PAGE = 5;


$pdo  = new News();
$hits = $pdo->count();
$numPages = ceil($hits / NUM_PER_PAGE);

$page = $_GET['p'] ?? 1;
$prevNum = $page - 1;
$nextNum = $page + 1;
$offset  = ($page - 1) * 4;

$news = $pdo->all('desc', $offset, NUM_PER_PAGE);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>お知らせ一覧 | Crescent Shoes 管理</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body class="admin_index">
    <header>
        <div class="inner">
            <span><a href="index.php">Crescent Shoes 管理</a></span>
            <?php include dirname(__FILE__) . '/account.parts.php'; ?>
        </div>
    </header>
    <div class="container">
        <main>
            <h1>お知らせ一覧</h1>
            <p><a href="news_add.php">お知らせの追加</a></p>
            <?php if ($numPages > 0) : ?>
                <ul class="pagination pages">
                    <?php if ($page == 1) : ?>
                        <li class="page-item">
                            <a href="" class="page-link disabled">前のページへ</a>
                        </li>
                    <?php else : ?>
                        <li class="page-item">
                            <a href="?p=<?= $prevNum ?>" class="page-link">前のページへ</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $numPages; $i++) : ?>
                        <?php if ($page == $i) : ?>
                            <li class="page-item active">
                                <a href="" class="page-link"><?= $i ?></a>
                            </li>
                        <?php else : ?>
                            <li class="page-item">
                                <a href="?p=<?= $i ?>" class="page-link"><?= $i ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($page == $numPages) : ?>
                        <li class="page-item">
                            <a href="" class="page-link disabled">次のページへ</a>
                        </li>
                    <?php else : ?>
                        <li class="page-item">
                            <a href="?p=<?= $nextNum ?>" class="page-link">次のページへ</a>
                        </li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
            <table>
                <tr>
                    <th>日付</th>
                    <th>タイトル／お知らせ内容</th>
                    <th>画像(64x64)</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
                <?php foreach ($news as $item) : ?>
                    <tr>
                        <td class="center"><?= $item['posted_at'] ?></td>
                        <td>
                            <span class="title"><?= $item['title'] ?></span>
                            <?= $item['message'] ?>
                        </td>
                        <td class="center">
                            <img src="<?= IMG_PATH . ($item['image'] ?: 'press.jpg') ?>" width="64" height="64" alt="">
                        <td class="center"><a href="news_edit.php?id=<?= $item['id'] ?>">編集</a></td>
                        <td class="center"><a href="news_delete.php?id=<?= $item['id'] ?>">削除</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </main>
        <footer>
            <p>&copy; Crescent Shoes All rights reserved.</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>