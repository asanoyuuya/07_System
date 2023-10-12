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
                        <li class="active">送信エラー</li>
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
                <h3 class="page-header">Message Delivery Failed</h3>
                <p class="text-warning">大変申し訳ございません。内部エラーが発生しました。</p>
                <p>お手数ですが、時間をおいて再度お試しいただくか、<b>03-1234-5678</b>までお電話いただけますようお願い申し上げます。</p>
                <p><a href="contact.php">お問い合わせページへ戻る</a></p>
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
            $('.contact-img').css({
                marginTop: '40px'
            });
        });
    </script>
</body>

</html>
