問題1. audiobook.jpのサイトが遅いと⾔われたらどのように解決しますか?

1.apachbenchを用いて　ユーザー*リクエストのマトリクスを計測し､現状把握を行います｡
2.フロントの確認としてchrome developerツールを用いて読み込み速度の遅いアセットファイル､またはAPI(処理)を特定し､改善に努めます｡また修正前､修正後の処理時間を計測し､効果測定を行います｡
3.サーバーサイドプログラムの確認として､ログを仕込んで処理に時間のかかっているmethodを特定し､改善に努めます｡また修正前､修正後の処理時間を計測し､効果測定を行います｡
4.DBの確認としてSQLを洗い出し､想定されるSQLを発行し､取得情報の精査､結合､subquery等に不備がないか確認し､改善に努めます｡また修正前､修正後の処理時間を計測し､効果測定を行います｡
5.webserverの起動optionや､ログ出力項目の削減､名前解決における処理の遅延を確認し､改善に努めます｡また修正前､修正後の処理時間を計測し､効果測定を行います｡

問題2. ナベアツプログラムを書いてください
test2.php に実装しました｡

問題3. ナベアツプログラムを汎用的にしてください
test3.php に実装しました｡

問題4. リファクタリングしてください

■違和感
1.引数ありでsend.phpを実行しても受付番号が返却されません｡
2.receive.php では受付番号を引数で受け取るようになっておらず､getReceiptNumber()を実行し結果を出力しています｡

■リファクタリング
1.引数ありでsend.phpを実行した際､受付番号を出力します｡
2.receive.php 実行時､引数の指定がない場合のメッセージ出力処理を追加します｡
3.receive.php 実行時､引数の指定がなされた場合､適宜受付番号に対応した結果を出力します｡

修正内容
1.send.php:L20に以下を追加
`echo $receiptNumber;`

2.receive.php:L8をコメントアウトし､以下に置き換え
```
//$receiptNumber = $questionService->getReceiptNumber();
if ($argc === 1) {
    echo '引数が足りません', PHP_EOL;
    exit(1);
}

$receiptNumber = $argv[1];
```

問題5. 下記の仕様を満たすWebアプリケーションを作成してください

docker-laravelを利用しアプリケーションを作成しました｡
docker,docker-compose を 事前にインストールし､以下を実行して頂ければと存じます｡

$docker-compose up -d


※DBに接続出来ない場合はDB containerに接続後､以下のalter文を実行して頂ますようお願い致します｡

containerへの接続
$ docker exec -it docker-laravel_db_1 /bin/bash

>alter user 'phper'@'%' IDENTIFIED WITH mysql_native_password BY 'secret';
