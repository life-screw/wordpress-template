<?php
/**
 * Index
 *
 * Diaryのカテゴリー一覧。
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

<div class="p-topics l-page-wrap l-inner">
	<div class="l-page-listwrap">
		<div class="c-sec-title p-home-philosophy__title js-fadein">
			<h1 class="c-sec-title__title u-upper js-fadein__inner"><a href="<?php echo esc_url( home_url( '/' ) ); ?>news">Diary</a></h1>
		</div>
		<nav class="c-cat-pagelink js-fadein">
			<ul class="js-fadein__inner">
				<li><a class="u-upper" href="<?php echo esc_url( home_url( '/' ) ); ?>news">All</a></li>
				<?php
					// カテゴリー一覧を表示.
					$categories = array(
						'orderby'    => 'id', // idの順番.
						'hide_empty' => '0', // カテゴリーに記事がなくても表示させる（記事がない場合に一覧ページを表示させると、エラーが出るのでご注意）.
					);
					$categories = get_categories( $categories );// 上で指定した配列を条件にターム一覧を取得.

					// 現在のカテゴリーを取得.
					$cats = get_the_category();

					if ( $categories ) :
						foreach ( $categories as $category ) :
							if ( $cats[0]->cat_name === $category->name ) :
								?>
						<li><a class="is-show u-upper" href="javascript:void(0);"><?php echo esc_html( $category->name ); ?></a></li>
						<?php else : ?>
						<li><a class="u-upper" href="<?php echo esc_url( home_url( '/' ) ); ?>news/category/<?php echo esc_html( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
							<?php
						endif;
					endforeach;
					endif;
					?>
			</ul>
		</nav>
		</div>
		<div class="p-topics__listarea">

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>

				<?php
				$categories = get_the_category();
				?>

		<article class="p-topics-list">
			<figure class="js-fadein">
			<a class="c-figure-hover js-fadein__inner" href="<?php the_permalink(); ?>">

				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'thumbnail' ); ?>
		<?php else : ?>
		<img
			src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/img/common/topics_thumbnail.png"
			alt=""
			width="630"
			height="400"
		/>
		<?php endif; ?>

			</a>
			</figure>
			<div class="p-topics-list__textarea">
			<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>" class="p-topics-list__time">
				<?php echo esc_attr( get_the_date( 'Y.m.d' ) ); ?>
		</time>
				<?php
				foreach ( $categories as $category ) {
					echo '<p class="p-topics-list__category"><a class="u-upper" href="' . esc_url( get_category_link( $category->term_id ) ) . '">#' . esc_html( $category->name ) . '</a></p>';
				}
				?>
			<h2 class="p-topics-list__title">
				<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
				</a>
			</h2>
			<p class="c-view-more">
				<a href="<?php the_permalink(); ?>">
				<span class="c-view-more__wrap">
					<span class="c-view-more__inner">
					<span class="c-view-more__text">view more</span>
					</span>
				</span>
				</a>
			</p>
			</div>
		</article>

					<?php endwhile; ?>

		<?php else : ?>
		<p class="p-news-list__category">ただいま準備中です。</p>
		<?php endif; ?>

		<?php
		if ( $wp_query->max_num_pages > 1 ) : // ここからページネーション.
			echo '<div class="p-archive-pager">';
			// paginate_linksをエスケープ処理.
			echo wp_kses_post(
				paginate_links(
					array(
						'base'      => get_pagenum_link( 1 ) . '%_%',
						'format'    => '?paged=%#%',
						'current'   => max( 1, $paged ),
						'total'     => $wp_query->max_num_pages,
						'prev_text' => '',
						'next_text' => '',
					)
				)
			);
			echo '</div>';
		endif;
		?>

		</div>
	</div>

<?php get_footer(); ?>
