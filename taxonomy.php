<?php
/**
 * Taxonomy
 *
 * WORKSのタクソノミー一覧。
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
					<li><a class="u-upper" href="<?php echo esc_url( home_url( '/' ) ); ?>works">All</a></li>
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
							if ( $term === $category->slug ) :// 現在ページが該当するタクソノミーの時　$termはグローバル変数で現在ページのタームが自動で入る.
								?>
							<li><a class="is-show u-upper" href="javascript:void(0);"><?php echo esc_html( $category->name ); ?></a></li>
							<?php else : ?>
							<li><a class="u-upper" href="<?php echo esc_url( home_url( '/' ) ); ?>works-category/<?php echo esc_html( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
								<?php
									endif;
									endforeach;
									endif;
					?>
				</ul>
			</nav>
		</div>
		<div class="p-works__list">

		<?php
		$args      = array(
			'post_type'      => 'works',
			// ページャなしで投稿を全て表示（WordPressの最大投稿数を無視する）.
			'posts_per_page' => -1,
			'tax_query'      => array(
				array(
					'taxonomy' => $taxonomy, // 現在ページのタクソノミー.
					'field'    => 'slug',
					'terms'    => $term, // 現在ページのターム.
				),
			),
		);
		$the_query = get_posts( $args );
		if ( $the_query ) :
			// phpcs:ignore WordPress.WP.GlobalVariablesOverride
			foreach ( $the_query as $post ) :
				setup_postdata( $post );// 上の配列で指定した通り、現在ページのタームの記事一覧をループ.
				$works_category = get_the_terms( $post->ID, 'works-category' );// 記事の works-category のタームを取得.
				// $works_member = get_the_terms($post->ID, 'works_member');//記事のworks_memberのタームを取得.
				?>

		<figure class="js-fadein">
			<a class="c-figure-hover js-fadein__inner" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'thumbnail' ); ?>
			</a>
		</figure>

					<?php endforeach; ?>

		<?php else : ?>
			<p class="p-works-single__textarea">ただいま準備中です。</p>
			<?php
			endif;
		?>

		</div>
</article>

<?php get_footer(); ?>
