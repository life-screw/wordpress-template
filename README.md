<<<<<<< HEAD
=======
# WordPress 自作テーマのテンプレート

## コンパイルアプリ
- prepros7を使用
- Webpack、Gulpの使用経験もありますが、使いやすさを優先してpreprosを使用しています。
- 基本、JavaScript・CSSはミニファイ化しています。保守を誰がやるかに合わせてミニファイするかどうか決めています。

### preprosについて
- ダウンロードと使用は無料で可能。（定期的に購入を促すポップアップが出てくるが無視して大丈夫です）
- PROJECTでこのフォルダを設定すると、prepros.configの設定を使用できます。
- ファイル設定など、ご不明点があればご連絡ください。


## デザインデータ
- XD、figma（XDでもらうことが多いです）

## フォントの設定方法
- WebフォントをHTMLのhead内に読み込んでいます。デザインに合わせてカスタマイズしてください。

### フォント（※これはダミーです）
<dl>
  <dt>Noto Sans JP（基本のフォント）</dt>
  <dd>500;600;700;800</dd>
  <dd>https://fonts.google.com/noto/specimen/Noto+Sans+JP?query=noto+san</dd>
  <dt>Heebo（英語フォント）</dt>
  <dd>500;700;800</dd>
  <dd>https://fonts.google.com/specimen/Heebo</dd>
</dl>

## 注意事項

### HTMLについて
- src/pugファイルで静的コーディング後、PHPに移植しています。必ずPugでコーディングする必要はありません。やりやすい方法でコーディングしてください。


### メディアクエリ
#### タブレット・パソコンのメディアクエリ
- @media print, screen and (min-width: 769px)
#### スマホのみのメディアクエリ
- @media only screen and (max-width: 768px)


## フォントの単位
- フォントサイズの単位は、スマホとタブレットでは基本vwを使用します。パソコンではremかpxを使用します。
- XDのpxをremに直すときは、pxに 0.1を乗算した値をremに入れてください。
- （例：12px → 1.2rem）


## 全体のフォルダ構造
- dist（コンパイル後のファイル）
- src（コンパイル前のファイル）
  - srcフォルダ内のjs,scssは、distフォルダのjs,css内のフォルダにそれぞれコンパイルするように設定しています。
- src内のpugは、distフォルダ内ではなく、htmlにコンパイルして第一階層に書き出しています。

### ファイル名のルール（CSS,JavaScript）
- commonファイル：ページ全体の設定。
- homeファイル：トップページ（PHPの設定で、トップのみに読み込ませます）
- 各ページ名のファイル：各ページに関するもの（functions.phpで各ページごとに読み込ませます）
- 例外として、投稿一覧・詳細は同じファイルにまとめることもあります。

## 画像
### 画像のフォルダ構成
- dist > img の各ページorパーツごとのフォルダに入れる
- 全ページに使う画像はcommonフォルダに入れる
- 他の画像は基本ページ名のフォルダに入れる
### 画像の命名ルール（ あくまで参考程度 ）
- 画像の命名の基本ルール、セクション名_img番号.png（例：fv_img01.png）
　PCとスマホで画像を分けるときは、セクション名_img番号_pc.png、セクション名_img番号_sp.pngと拡張子の前に_pc,_spをつける。
- 背景画像は、セクション名_bg_img番号.png（例：fv_bg_img01.png）
- アイコンは、icon_アイコン名.png。ボタンは、btn_ボタン名.png　と分かりやすい名前をつける
### 画像の拡張子
- Webpは、後でプラグインで変換できるので、使用しないです。


## class
- 命名ルールはFLOCSS。
- 絶対厳守ではないですが、保守性を担保するためになるべく守るようにお願いします。
- 参考サイト：https://qiita.com/super-mana-chan/items/644c6827be954c8db2c0

## CSSについて
- dartSass
- FLOCSS
- スマホファーストコーディング
- リキッドレイアウト

## SCSS内のディレクトリ構造説明
<p>
├── Foundation<br>
│   ├── _base.scss（rootで設定する色・フォント,html,body,aなどサイトの根幹のタグのSCSS）<br>
│   ├── _index.scss<br>
│   └── _reset.scss（リセットCSS）<br>
├── Module（サイト構築全体でよく使うパーツのSCSSを入れている）<br>
│   ├── Component（使い回しできる部品。主にボタンやタイトル。）<br>
│   ├── Javascript（JavaScriptで付与したクラスにCSSを付けたい時に記述。）<br>
│   ├── Layout（全体の骨組みになる部分。ほとんどPage > Commonに記載）<br>
│   └── Utility（プロパティ単体で使用。スマホのみ、PCのみ出すためのCSSを記載。）<br>
├── Page（サイト固有のCSS）<br>
│   ├── Common （header,footerなど全体で使用）<br>
│   ├── CommonPage （下層ページ全体で使用）<br>
│   └── 各ページスラッグ（各ページのみで使用）<br>
├── Setting（各SCSSに読み込ませるSCSSを入れている）<br>
│   ├── _animation.scss（CSSアニメーション）<br>
│   ├── _index.scss<br>
│   ├── _mixin.scss（mixinパーツ）<br>
│   └── _variable.scss（function,breakpoint,英文などの特殊フォントの関数）
</p>

##　 コンポーネントと関数の使い方について
### ブレイクポイント、英語フォント
scss > Setting > _variable に記載
### フォント一括設定の@mixin f_aroundについて
scss > Setting > _mixin に記載

### JavaScript
- src/js/partsにモジュール化（機能ごとにファイルを分けた）JavaScriptファイルを入れています。これをcommon.js、home.jsなどのそれぞれのファイルにexportで読み込んでコンパイルしています。
- jQueryは必要なページにのみfunctions.phpで読み込むページを設定します。
- headタグ内にJavaScriptを読み込んでください。読み込みを遅らせたいときは「defer」を設定してください。
>>>>>>> ffe0bbe (テンプレートを汎用化)
