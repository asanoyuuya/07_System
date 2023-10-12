<?php

session_start();

require_once(dirname(__FILE__) . '/util.inc.php');
require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once(dirname(__FILE__) . '/settings.php');

if (isset($_SESSION['contact'])) {

    $contact = $_SESSION['contact'];

    $name    = $contact['name'];
    $kana    = $contact['kana'];
    $email   = $contact['email'];
    $phone   = $contact['phone'];
    $inquiry = $contact['inquiry'];
    $token   = $contact['token'];
}


if ($token !== getToken()) {
    header('Location: contact.php');
    exit;
}

if (!isset($_SESSION['contact'])) {
    header('Location: cotanct.php');
    exit;
}

if (isset($_POST['send'])) {
    
    $transport = new Swift_SmtpTransport(SMTP_HOST, SMTP_PORT, SMTP_PROTOCOL);
        $transport->setUsername(GMAIL_SITE);
        $transport->setPassword(GMAIL_APPPASS);
        $mailer = new Swift_Mailer($transport);

        $message = new Swift_Message(MAIL_TITLE);
        $message->setFrom(MAIL_FROM);
        $message->setTo(['tennis6293@gmail.com' => 'Web担当者様']);

        $mailBody = <<<EOT
        <h2>お問い合わせありがとうございます</h2>
        <p>この度はお問い合わせいただき誠にありがとうございました。<br>
        送信内容を以下の内容で承りました。</p>
        ----------------------------
        <p>お名前：{$name}</p>
        <p>フリガナ：{$kana}</p>
        <p>メールアドレス：{$email}</p>
        <p>メールアドレス：{$phone}</p>
        <p>お問い合わせ：{$inquiry}</p>
        ----------------------------
        EOT;
        $message->setBody($mailBody, 'text/html');
        $result = $mailer->send($message);
    
    if($result == 1){
        unset($_SESSION['contact']);
        header('Location: contact_done.php');
        exit;
    } else {
        header('Location: contact_error.php');
        exit;
    }
}

if (isset($_POST['back'])) {
    header('Location: contact.php');
    exit;
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="クレセントシューズは靴の素材と履き心地にこだわる方に満足をお届けする東京の靴屋です。後悔しない靴選びはぜひクレセントシューズにお任せください。">
    <meta name="keyword" content="Crescent,shoes,クレセントシューズ,東京,新宿区,メンズシューズ,レディースシューズ,キッズシューズ,ベビーシューズ">

    <title>Contact | Crescent Shoes</title>

    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body class="pageTop">
    <header class="navbar navbar-default navbar-fixed-top" role="banner">
        <div class="container">
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h1 class="navbar-header">
                <a href="index.php" class="navbar-brand"><img src="images/logo01.png" alt="LOGO"></a>
            </h1>
            <nav class="navbar-collapse collapse" id="navigation" role="navigation">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">ホーム<span>HOME</span></a></li>
                    <li><a href="about.php">会社概要<span>ABOUT</span></a></li>
                    <li><a href="news.php">ニュース<span>NEWS</span></a></li>
                    <li><a href="shop.php">ショップ<span>ONLINE SHOP</span></a></li>
                    <li><a href="contact.php">お問い合わせ<span>CONTACT</span></a></li>
                </ul>
                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="keyword">
                        <span class="input-group-btn"><button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button></span>
                    </div>
                </form>
            </nav>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav>
                    <h1 class="page-header">Contact</h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li class="active">送信内容確認</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 hidden-sm hidden-xs">
                <div class="contact-img">
                    <img src="images/contact.jpg">
                </div>
            </div>
            <div class="col-md-8">
                <h3 class="page-header">Message Confirmation</h3>
                <p>内容を修正される場合は「修正する」ボタンを、送信される場合は「送信する」ボタンを押してください。</p>
                <table class="table table-hover table-bordered">
                    <tr>
                        <th style="padding:10px;border:1px solid #ccc">お名前</th>
                        <td style="padding:10px;border:1px solid #ccc"><?= h($name) ?></td>
                    </tr>
                    <tr>
                        <th style="padding:10px;border:1px solid #ccc">フリガナ</th>
                        <td style="padding:10px;border:1px solid #ccc"><?= h($contact['kana']) ?></td>
                    </tr>
                    <tr>
                        <th style="padding:10px;border:1px solid #ccc">メールアドレス</th>
                        <td style="padding:10px;border:1px solid #ccc"><?= h($contact['email']) ?></td>
                    </tr>
                    <tr>
                        <th style="padding:10px;border:1px solid #ccc">電話番号</th>
                        <td style="padding:10px;border:1px solid #ccc"><?= h($contact['phone']) ?></td>
                    </tr>
                    <tr>
                        <th style="padding:10px;border:1px solid #ccc">お問い合わせ内容</th>
                        <td style="padding:10px;border:1px solid #ccc"><?= nl2br(h($contact['inquiry'])) ?></td>
                    </tr>
                </table>
                <form action="" method="post" class="form-horizontal">
                    <input type="hidden" name="back" value="<?= getToken() ?>">
                    <div class="form-group">
                        <div class="col-sm-10">
                            <button type="submit" name="send" class="btn btn-success btn-lg">送信する</button>
                            <button type="submit" action="contact.php" class="btn btn-success btn-lg">修正する</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="pagetop margin-top-md">
        <a href="#pageTop" class="center-block text-center" onclick="$('html,body').animate({scrollTop: 0}); return false;"><i class="fa fa-chevron-up center-block "></i>Page Top</a>
    </div>
    <footer class="margin-top-md" role="contentinfo">
        <div class="container">
            <div class="row">
                <div class="text-center">
                    <ul class="list-inline">
                        <li><a href="index.php">HOME</a></li>
                        <li><a href="about.php">ABOUT</a></li>
                        <li><a href="news.php">NEWS</a></li>
                        <li><a href="shop.php">ONLINE SHOP</a></li>
                        <li><a href="contact.php">CONTACT</a></li>
                    </ul>
                    <small>&copy; Crescent Shoes.All Rights Reserved.</small>
                </div>
            </div>
        </div>
    </footer>
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('th').css({
                width: '20%',
                minWidth: '80px'
            });
            $('.contact-img').css({
                marginTop: '40px',
                overflow: 'hidden',
                height: $('.col-md-8').height() - 55
            });
        });
    </script>
</body>

</html>
