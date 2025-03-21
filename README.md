# ThankQ 結婚式ゲスト参加アプリ

## 概要
**「食べて、笑って、いい日だったなー！」**  
結婚式でゲストが楽しみながら参加できる体験型Webアプリです。

## 主な機能

- ゲスト用QRコードでアクセス
- 新郎新婦からの感謝メッセージ表示
- クイズ出題（3〜4問）＆回答投稿
- 新郎新婦へのコメント＆「一緒にやりたいこと」投稿
- 正解数トップのゲストへ景品授与（集計機能）
- 管理者専用ページでクイズ管理・回答確認・コメント閲覧

## 使用技術

- Laravel（バックエンド）
- Vue3（フロントエンド）
- MySQL（データベース）

## セットアップ

```bash
# クローン
git clone https://github.com/your-username/kanshaq.git
cd kanshaq

# Laravel セットアップ
composer install
cp .env.example .env
php artisan key:generate

# .envのDB設定を修正

# マイグレーション
php artisan migrate

# サーバー起動
php artisan serve

