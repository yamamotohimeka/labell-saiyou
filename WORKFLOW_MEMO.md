# Git運用メモ（ローカルと本番を分離する）

## 方針
- ブランチは `main` を基準に一本化する。
- 開発は必ず `feature/*` ブランチで行う。
- 本番に入れないローカル設定は Git 管理外に置く（`.env.local` / `docker-compose.override.yml`）。
- 「ローカル専用 if 文」をアプリ本体に増やさない。

## 日々の作業手順
1. `main` を最新化する。
2. `feature/<task-name>` を切る。
3. 実装して動作確認する（Docker はローカル専用 override を使用）。
4. `git status` でローカル専用ファイルが混ざっていないことを確認する。
5. PR を作成する。

## ローカル専用ファイル（コミットしない）
- `.env.local`
- `docker-compose.override.yml`
- `agent-last-error.html`
- 一時ログファイル（`*.log`）

## 事故防止チェック
- PR 前に `git status --short` を確認する。
- 変更ファイルに次が含まれていないことを確認する:
  - ローカルIP固定
  - ローカルDBパスワード直書き
  - テスト用ダミーアカウント固定

## 補足
- ローカル起動に必要な差分は「ファイルを分けて吸収」する。
- 本番に必要なコード変更だけを `feature/*` に残す。
