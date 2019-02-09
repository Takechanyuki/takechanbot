<?php

//Composerでインストールしたライブラリを一括読み込み
require_once __DIR__ . '/vender/autoload.php';

//インスタンス化、署名関連
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);
$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
$events = $bot->parseEventRequest(file_get_contents('php://input'),$signature);

foreach($events as $event){
  //テキスト返信
  $bot->replyText($event->getReplyToken(), 'TextMessage');
}

?>
