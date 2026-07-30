# Task Manager

Laravel 13 / PHP 8.4を基盤にした、Bladeベースのタスク管理アプリです。既存の画面構成を維持し、今回のスコープではフレームワーク更新、認証・認可、データ境界、Docker、テストを優先しています。

## Features

- Laravel Fortifyによるログイン、登録、パスワードリセット
- Laravel標準の署名付きメールアドレス認証
- タスクの作成、編集、削除、閲覧者共有
- タスク配下のプロジェクト管理
- グループ作成、メンバー管理、グループ単位のタスク共有
- MySQL、Mailpit、nginx、PHP-FPMのDocker Compose開発環境

## Versions

- PHP `8.4`
- Laravel `13.x`
- Laravel Fortify `1.x`
- Laravel Sanctum `4.x`
- Node.js `22`
- MySQL `8.4`
- PHPUnit `12.x`

## Architecture

- `nginx`が静的ファイルとPHPリクエストを受け、`app`のPHP-FPMへ転送します。
- `app`はBlade、Fortify、Eloquent、Policy、FormRequestを使用します。Inertia/Vueによる全画面刷新はこのPRの対象外です。
- `db`はMySQL、`mailpit`は開発時のSMTP受信箱です。
- Taskの所有者は既存スキーマの`tasks.user`文字列を維持しています。新規作成時はログインユーザー名をサーバー側で設定し、入力値を信用しません。
- `status`、`email_verified`、`email_verify_token`列は既存データ互換のため残しています。新規の認証判定は`email_verified_at`を主とし、旧ユーザーの`status=1`または`email_verified=1`は既存の検証済み状態として扱います。

## Docker Quickstart

Docker Desktop、Docker Compose v2以降が必要です。

```sh
cp .env.example .env
docker compose config
docker compose --profile assets run --rm assets
docker compose up --build -d
docker compose exec app php artisan key:generate --force
docker compose exec app php artisan migrate --seed
curl http://localhost:8081/up
```

初期データのログイン情報は`demo@example.com`と、`.env`の`DEMO_USER_PASSWORD`です。Mailpitは`http://localhost:8026`、アプリは`http://localhost:8081`で確認できます。

開発環境ではソースを`app`と`nginx`へbind mountし、`assets`サービスが`npm ci`とproduction buildを実行します。ComposerとNodeの依存ディレクトリは名前付きvolumeです。アプリをイメージとして実行する本番構成ではbind mountを使用しません。

```sh
docker compose -f docker-compose.prod.yml config
docker compose -f docker-compose.prod.yml up --build -d
```

本番では`.env`をイメージへコピーせず、`APP_KEY`、DBパスワード、メール認証情報をSecret管理から注入してください。本番構成の起動後もmigrationは自動実行しないため、リリース手順で明示的に実行します。

## Environment

`.env.example`を`.env`へコピーしてから値を設定します。Compose内のDBホスト名は`db`、SMTPホスト名は`mailpit`です。ホストからMySQLへ接続する場合だけ`127.0.0.1:3306`を使用します。

重要な値:

- `APP_KEY`: `php artisan key:generate --force`で生成
- `DB_HOST`: Composeでは`db`
- `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`: ComposeのMySQL設定と一致させる
- `MAIL_HOST`: Composeでは`mailpit`
- `MAIL_PORT`: Compose内のMailpit SMTPは`1025`。ホスト公開ポートは`MAILPIT_SMTP_PORT`（既定`1026`）

## Authentication

認証の実装はFortifyに統一しています。旧`laravel/ui`の`Auth::routes`、独自base64メールtoken、独自メールMailableは使用しません。

- 登録後はFortifyが`Registered`イベントを処理して標準の検証通知を送信します。
- `/home`以下の機能画面は`auth`と`verified`が必須です。
- 検証リンクはLaravelの署名付きURLです。再送は`/email/verification-notification`です。
- `email_verify_token`は新規処理で生成・参照しません。既存行の列は破壊的変更を避けるため保持します。
- 既存ユーザーの認証状態が曖昧な場合は、標準の再送リンクで`email_verified_at`を更新してください。

## Database

既存テーブルを削除・正規化するmigrationは追加していません。ローカルのmigrationとseedは次の通りです。

```sh
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
docker compose exec app php artisan migrate:fresh --seed
```

`migrate:fresh`は開発・テスト専用です。共有環境や既存データのある環境では使用しないでください。

## Verification

依存、脆弱性、PHPUnit、JavaScript buildはDocker上で再現できます。

```sh
docker compose exec app composer validate --strict
docker compose exec app composer audit
docker compose exec app php artisan test
docker compose run --rm assets npm ci --ignore-scripts --no-audit
docker compose run --rm assets npm run lint
docker compose run --rm assets npm run typecheck
docker compose run --rm assets npm run build
docker compose ps
docker compose exec app php artisan route:list --no-ansi
```

`docker compose ps`で`app`、`nginx`、`db`、`mailpit`がhealthyになることを確認します。アプリのHTTPヘルスエンドポイントは`GET /up`です。

## Constraints and Follow-ups

- 既存のBlade UIを維持しているため、Inertia/Vueへの全画面移行は未実施です。移行する場合は画面単位で実際の動作確認を行う別PRに分割します。
- `tasks.user`と`projects.PIC`は既存の表示名文字列を維持しています。将来的にユーザーIDへ移行する場合は、既存データを変換する別migrationと段階的な互換期間が必要です。
- グループは既存の`group_id`単一列を維持しています。複数グループ選択時の既存挙動は、グループごとにタスクを作成します。
- 2FAのUIは未実装のためFortifyの2FA featureは有効化していません。必要になった場合はchallenge、設定、recovery code画面を揃えた別PRで追加します。
- 既存のlegacy seederクラスは互換のため残していますが、標準の`db:seed`は再実行可能な`DemoDataSeeder`のみを使用します。
