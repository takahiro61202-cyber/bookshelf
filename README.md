# Bookshelf

書籍管理アプリです。

## 概要

書籍の管理とレビュー投稿を行うWebアプリです。

## 環境構築

### 1 リポジトリをクローンする

今回はテストなので個人のリポジトリのurlを変更してください

````bash
git clone https://github.com/takahiro61202-cyber/bookshelf.git

### 2 Dockerのコンテナを作成します

```bash
docker-compose up -d --build
````

### 3 phpコンテナにログインしてコンポーザーをインストールしてください

```bash
docker-compose exec php bash
composer install
```

### 4 envファイルとアプリキーを作成してください

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

### 5 envファイルの下記の欄を修正してください

```bash
DB_CONNECTION=mysql
# before
DB_HOST=127.0.0.1
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
# after
DB_HOST=mysql
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

### 6 マイグレーションを実施してください

```bash
php artisan migrate
```

ここでデーターベースに作成されているか確認することをおすすめします
エラーが発生する場合は以下のコマンドを試してください

```bash
sudo chmod -R 777 *
```

### 7 シーディング実施してください

```bash
php artisan db:seed
```

## 使用技術(実装環境)

- PHP version 8.1.34
- Laravel Framework 8.83.29
- Composer version 2.9.5
- mysql from 11.8.3-MariaDB
- git version 2.43.0

## ER図

![alt text](ER2.png)

## URL

- 書籍一覧画面: http://localhost/
- ランキング画面: http://localhost/rankingm
- 書籍登録画面: http://localhost/register
- お気に入り登録画面: http://localhost/books/create
- ジャンル管理: http://localhost/favorites
- ログイン画面: http://localhost/login
- 会員登録画面: http://localhost/register
- phpMyAdmin: http://localhost:8080/
