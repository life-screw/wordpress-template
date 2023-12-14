<?php
/**
 * Archive topics
 *
 * Topicsの一覧全体。
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

<div class="p-news l-page-wrap l-inner">
	<div class="l-page-listwrap">
		<div class="c-sec-title p-home-philosophy__title js-fadein">
			<h1 class="c-sec-title__title u-upper js-fadein__inner"><a href="<?php echo esc_url( home_url( '/' ) ); ?>topics">Topics</a></h1>
		</div>
	</div>
	<div class="p-news__listarea">

		<?php
		// WP_Queryでページャーを出す https://into-the-program.com/wpquery-pagination/ .
		// phpcs:ignore WordPress.WP.GlobalVariablesOverride
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

			// カスタム投稿タイプの設定.
			$query = new WP_Query(
				array(
					'post_type'      => 'topics',
					// ページャなしで投稿を全て表示（WordPressの最大投稿数を無視する）.
					'posts_per_page' => -1,
				)
			);
			?>

		<?php if ( $query->have_posts() ) : ?>
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					?>

					<article class="p-news-list">
						<a href="<?php the_permalink(); ?>">
							<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>" class="p-news-list__time"><?php echo esc_attr( get_the_date( 'Y.m.d' ) ); ?></time>
							<h2 class="p-news-list__title">
								<?php the_title(); ?>
							</h2>
						</a>
					</article>

				<?php endwhile; ?>
			<?php else : ?>
			<p class="p-news-list__category">ただいま準備中です。</p>
				<?php
				endif;
				wp_reset_postdata();
			?>

	</div>
</div>

<?php get_footer(); ?>
