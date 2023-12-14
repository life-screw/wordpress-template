<?php
/**
 * Arcive works
 *
 * WORKSの一覧全体（タクソノミー一覧はtaxonomy.php）。
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

<article class="p-works l-page-wrap l-inner">
	<div class="l-page-listwrap">
		<div class="c-sec-title p-home-philosophy__title js-fadein">
			<h1 class="c-sec-title__title u-upper js-fadein__inner"><a href="<?php echo esc_url( home_url( '/' ) ); ?>works">WORKS</a></h1>
		</div>
		<nav class="c-cat-pagelink js-fadein">
			<ul class="js-fadein__inner">
				<li><a class="is-show u-upper" href="<?php echo esc_url( home_url( '/' ) ); ?>works">All</a></li>
				<?php
					// タクソノミーの一覧を表示.
					$categories = array(
						'post_type'  => 'works', // カスタム投稿タイプ名.
						'taxonomy'   => 'works-category', // 取得したいタクソノミー名.
						'orderby'    => 'id', // idの順番.
						'hide_empty' => '0',
					);
					$categories = get_categories( $categories );// 上で指定した配列を条件にターム一覧を取得.
					if ( $categories ) :
						foreach ( $categories as $category ) :
							?>
					<li><a class="u-upper" href="<?php echo esc_url( home_url( '/' ) ); ?>works-category/<?php echo esc_html( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
							<?php
					endforeach;
						wp_reset_postdata();
				endif;
					?>
			</ul>
		</nav>
	</div>
	<div class="p-works__list">
		<?php
		// WP_Queryでページャーを出す https://into-the-program.com/wpquery-pagination/ .
		// phpcs:ignore WordPress.WP.GlobalVariablesOverride
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

			// カスタム投稿タイプの設定.
			$query = new WP_Query(
				array(
					'post_type'      => 'works',
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

				<figure class="js-fadein">
					<a class="c-figure-hover js-fadein__inner" href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'thumbnail' ); ?>
					</a>
				</figure>

			<?php endwhile; ?>

		<?php else : ?>
		<p class="p-news-list__category">ただいま準備中です。</p>
			<?php
		endif;
		wp_reset_postdata();
		?>

	</div>
</article>

<?php get_footer(); ?>
