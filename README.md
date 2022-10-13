## TABETA

ご飯を食べない子供と親の為のレシピ投稿アプリケーションです。  
自分の子供がなかなかご飯を食べてくれない悩みがきっかけで作成いたしました。  
料理の写真が投稿でき、レシピとその作り方を共有できます。  
レスポンシブ対応しているので、スマホからでもご確認いただけます。  
<br />
<br />
![レシピ一覧](https://user-images.githubusercontent.com/107093636/195508167-6dc8b54e-cbd1-40a8-9283-fbc3db0dfd96.png)

## URL

<http://3.115.9.12>  
テストユーザーアカウントを用意しております。  
email:test@test.com  
password:asdasdasd  

## 使用技術

- PHP 8.0.24
- Laravel Framework 6.20.44
- MySQL 8.0.30-0 ubuntu 0.22.04.1
- Nginx/1.18.0 (Ubuntu)
- AWS
  - EC2
  - S3  
- Docker 20.10.17/Docker-compose v2.7.0

## 機能一覧

- ユーザー登録機能
- ログイン機能
- レシピ投稿機能
- いいね、ブックマーク機能
- 投稿レシピ編集・削除機能
- あいまい検索機能
- ユーザー登録情報変更機能
  - プロフィール画像編集機能

## こだわった点

動的に追加されたフォーム欄のデータベースへの登録・バリデーションになります。
<br />
<br />


 - 材料・分量フォーム欄のバリデーション
 <br />

![バリデーションa](https://user-images.githubusercontent.com/107093636/195652406-da5c473d-ae7e-4345-8df7-d42a1469f4d2.gif)
<br />
<br />
<br />
<br />

 - 作り方・手順画像フォーム欄のバリデーション
<br />

![バリデーションb](https://user-images.githubusercontent.com/107093636/195652409-24ff2dc8-3b9c-4e40-9d1b-7b7e51c9c4ec.gif)
<br />
<br />
<br />
<br />



## 苦労した点

動的に追加されたフォーム欄の扱いに関して全般です。（登録・編集・バリデーション）  
QiitaやTeratail、stackoverflow（英語版含む）で記事を検索、また質問致しました。  
その中で、日本語・英語ともに求めている情報が無かった場合、Laracastsにて英語で質問いたしました。  
<https://laracasts.com/discuss/channels/laravel/laravel6-multi-dimensional-array-validation>  
(上記URLは、動的に追加されたフォーム欄のFormRequestを用いたバリデーションについてLaracastsで質問したものです。)  
