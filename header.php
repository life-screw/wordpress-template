<?php
/**
 * Header
 *
 * テーマのheader。
 *
 * @category   Components
 * @package    WordPress
 * @subpackage themes_template
 * @author     ▲▲▲▲
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://◯◯◯◯◯◯/
 * @since      1.0.0
 */

?>
<!doctype html>
<html lang="ja">
<head>

<!-- Web font (CSSはfunctions.phpに記載)-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="format-detection" content="email=no,telephone=no,address=no">
<title>
<?php if ( is_front_page() ) : ?>
	<?php bloginfo( 'name' ); ?>｜〇〇〇〇〇〇
<?php else : ?>
	<?php wp_title( ' |', true, 'right' ); ?><?php bloginfo( 'name' ); ?>
<?php endif; ?>
</title>

<?php
// キーワード・ディスクリプション.
if ( is_front_page() ) {
	$page_desc = esc_attr( get_bloginfo( 'description' ) );
} elseif ( is_page() ) {
	$meta_keywords    = get_post_meta( $post->ID, 'seo-keywords', true );
	$meta_description = get_post_meta( $post->ID, 'seo-description', true );
	if ( ! empty( $meta_description ) ) {
		$page_desc = $meta_description;
	}
	// 空の場合、本文を代入.
	if ( empty( $page_desc ) ) {
		$page_desc = mb_strimwidth( wp_strip_all_tags( apply_filters( 'the_content', $post->post_content ) ), 0, 200, '...' );
		// 改行の除去.
		$page_desc = str_replace( array( "\r\n", "\n", "\r" ), '', $page_desc );
	}
} elseif ( is_category() ) {
	$page_desc = get_bloginfo( 'name' ) . 'の「' . trim( wp_title( '', 0 ) ) . '」のページです。';
} elseif ( is_post_type_archive( 'works' ) ) {
		$page_desc = get_bloginfo( 'name' ) . 'が手がけたの実績の一部をご紹介します。';
} elseif ( is_singular( 'works' ) ) {
	if ( empty( $page_desc ) ) {
		$page_desc = get_bloginfo( 'name' ) . 'が手がけた' . trim( wp_title( '', 0 ) ) . 'の実績紹介です。';
	}
} elseif ( is_single() ) {
	if ( empty( $page_desc ) ) {
		$page_desc = mb_strimwidth( wp_strip_all_tags( apply_filters( 'the_content', $post->post_content ) ), 0, 200, '...' );
		// 改行の除去.
		$page_desc = str_replace( array( "\r\n", "\n", "\r" ), '', $page_desc );
	}
}
?>
<?php
// 設定がなければ、サイトのMETA初期設定.
if ( empty( $page_desc ) ) {
	$page_desc = get_bloginfo( 'name' ) . 'の' . trim( wp_title( '', 0 ) ) . 'です。';
}
?>
<meta name="description" content="<?php echo esc_html( $page_desc ); ?>">

<!--キャッシュがない時に表示-->
<?php if ( is_page( 'contact' ) ) : ?>
	<style>
		dialog#js_cookie_dialog {
			/* ↓リセット */
			margin: 0;
			padding: 0;
			border: none;
			color: inherit;
			/* ↑リセット */
			justify-content: center;
			align-items: center;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, .1); /* <dialog> 未対応ブラウザ用 */
			z-index: 2147483647; /* <dialog> 未対応ブラウザ用 */
			overflow-y: auto;
		}

		dialog#js_cookie_dialog:not([hidden]) {
			display: flex;
		}

		dialog#js_cookie_dialog::backdrop {
			background: rgba(0, 0, 0, .1);
		}

		dialog#js_cookie_dialog > .inner {
			padding: 1em;
			border: 2px solid #000;
			max-width: 36em;
			background: #fff;
		}

		dialog#js_cookie_dialog > .inner {
			padding: 1em;
			border: 2px solid #000;
			max-width: 36em;
			background: #fff;
			font-size: 14px;
		}
		dialog#js_cookie_dialog button{
			margin-top: 0.5em;
			cursor: pointer;
			background-color: #cacaca;
		}
	</style>
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- ↓↓↓↓↓↓コードを設置し終わったら消すこと↓↓↓↓↓↓ -->
<!-- よく使うPHPコード -->
	<?php if ( is_front_page() ) : ?>
	<?php endif; ?>

	<?php echo esc_url( home_url( '/' ) ); ?>
	<?php echo esc_url( get_template_directory_uri() ); ?>

<!-- SNS（PHPコードの例） -->
	<ul class="l-sns l-sns--humnav">
		<li class="l-sns__list">
			<a target="_blank" rel="noopener" href="
				<?php
					// twitterのURL.
					require 'wp-parts/sns-url.php';
					echo esc_url( $twitter_url );
				?>
			">
				<img class="twitter" src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/img/common/icon_twitter.svg" alt="Twitter" width="22" height="18" />
			</a>
		</li>
		<li class="l-sns__list">
			<a target="_blank" rel="noopener" href="
				<?php
					// facebookのURL.
					require 'wp-parts/sns-url.php';
					echo esc_url( $facebook_url );
				?>
			">
				<img class="facebook" src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/img/common/icon_facebook.svg" alt="facebook" width="11" height="22" />
			</a>
		</li>
		<li class="l-sns__list">
			<a target="_blank" rel="noopener" href="
				<?php
					// instagramのURL.
					require 'wp-parts/sns-url.php';
					echo esc_url( $instagram_url );
				?>
			">
				<img class="instagram" src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/img/common/icon_instagram.svg" alt="instagram" width="19" height="19" />
			</a>
		</li>
	</ul>
