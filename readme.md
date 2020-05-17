# 項目応答理論を用いた演習問題出題システム(Laravel)
研究背景：学校教育におけるデジタル化の開発が海外と比べて遅れており、2020年度から文部科学省が「デジタル教科書」を全国の小中高校で使えるようにするとの中間報告をまとめている。

研究目的：現在では英語分野(TOEICなど)などに項目応答理論が用いられた演習問題出題システムが多いが、数学分野の特に大学生向けの出題システムについてはないことから作成しました。

研究内容：項目応答理論を用いた問題出題システムをWeb上で実装し、実際に大学生に利用してもらいアンケート調査を行いました。

### 公開したアプリの URL
[MiDe(https://knmk.jpn.org/login)
](https://knmk.jpn.org/login)
サンプル
Eメールアドレス：sample@sample.com
パスワード：password

### 該当プロジェクトのリポジトリ URL
[GitHub - mako5656/laraquizlab: laraquiz](https://github.com/mako5656/laraquizlab)
※PHPの参考となる資料を基盤としたため0の状態から自分で作成したわけではありません。
※先行研究はありましたがMATLAB上のコマンドで実行して使用するだけのものでしたのでプログラミング自体は0の状態から作成しました。

## 開発環境
### 開発環境
MAMP 5.3(267)
PhpStorm
MySQL 5.7
Composer 1.9.0
さくらのレンタルサーバ(Apache/2.4.41)
Laravel Framework 5.6.39
chart.js
MathJax

### 開発言語
PHP 7.3

### システム全体
- 演習問題の生成をPython
- データ保管をMySQL
- 出題システムをLaraveL(PHP)

## アプリケーション機能
### 機能一覧
- 受講者の能力値確認：解いた問題の正誤によって受講者の能力の変化を折れ線グラフとして確認することができる。
- 過去に解いた問題確認：データベースに解いた番号が保存されるので過去に解いた問題を確認することができる。
- 受講者に適切な難易度の問題が提示される：演習問題の生成時に問題の難易度も保存されるので。
- 簡易的に受講者の能力値と演習問題の難しさは星で表現した。

### 画面一覧
- ログイン画面：登録と認証をすることができる。
- 能力推移画面：受講者の能力値の推移を折れ線グラフで確認できる。
- 演習問題出題画面 ：演習問題が出題される。
- 結果画面：演習問題の正誤結果がわかる。
- 過去問画面：過去に解いた問題がわかる。


