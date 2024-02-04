<?php
/**
 * 404
 *
 * Not found.
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
<?php get_header(); ?>

<div class="l-page-wrap c-inner">
	<div class="c-sec-title js-fadein">
		<h1 class="c-sec-title__title u-upper js-fadein__inner">Not found</h1>
	</div>
	<div class="l-page-inner p-not-found">
		<p class="p-not-found__txt">弊社のウェブサイトをご利用いただき、<br class="u-only-sp">誠にありがとうございます。<br>
		誠に申し訳ございませんが、アクセスいただいたURLが見つかりません。<br>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">HOME</a>から再度アクセスしてください。</p>
		<div class="p-not-found-link">
			<a class="p-not-found-link__wrap" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="p-not-found-link__text" data-text="HOMEへ戻る">HOMEへ戻る</div>
			</a>
		</div>
	</div>
</div>


<?php get_footer(); ?>
