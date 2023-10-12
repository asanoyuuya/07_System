<?php
const SMTP_HOST     = 'smtp.gmail.com';
const SMTP_PORT     = 587;
const SMTP_PROTOCOL = 'tls';
const GMAIL_SITE    = 'tennis6293@gmail.com';
const GMAIL_APPPASS = 'xqwx owqn ipzf izkk';
// 代替テキスト(送信元のGmailでOK)
const MAIL_FROM     = ['tennis6293@gmail.com' => 'Crescent Shoes 公式サイト'];
// 複数の送信先の設定
const MAIL_TO       = [
  'tennis6293@gmail.com'  => 'Web担当者様',
];
const MAIL_TITLE    = 'Crescent Shoes 問い合わせ通知';