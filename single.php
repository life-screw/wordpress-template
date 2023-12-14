<?php
/**
 * Single
 *
 * Diaryの詳細ページ。
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
<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
		<?php
		$categories    = get_the_category();
		$category_name = $categories[0]->name;
		$category_link = get_category_link( $categories[0]->term_id );
		?>

<article class="p-works l-page-wrap l-inner">
	<div class="c-sec-title p-home-philosophy__title js-fadein">
		<p class="c-sec-title__title u-upper js-fadein__inner"><a href="<?php echo esc_url( home_url( '/' ) ); ?>news">Diary</a></p>
	</div>

	<div class="p-topics-single">
		<div class="p-topics-single__headarea">
				<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>" class="p-topics-single__time"><?php echo esc_attr( get_the_date( 'Y.m.d' ) ); ?></time>
					<div class="p-topics-single__categorybox">
						<?php
						foreach ( $categories as $category ) {
							echo '<p class="p-topics-single__category"><a class="u-upper" href="' . esc_url( get_category_link( $category->term_id ) ) . '">#' . esc_html( $category->name ) . '</a></p>';
						}
						?>
					</div>
				<h1 class="p-topics-single__title">
					<?php the_title(); ?>
				</h1>
		</div>
		<div class="p-topics-single__contents">
				<?php the_content(); ?>
		</div>
	</div>

	<div class="p-works-pager">
			<?php
			$prev_post = get_previous_post();
			$next_post = get_next_post();
			?>
		<div class="p-topics-pager">
		<div class="p-topics-pager__btn p-topics-pager__btn--back">

			<?php if ( $prev_post ) { ?>
					<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
						<span class="p-topics-pager__link-wrap">
							<span class="p-topics-pager__link-inner">
								<span class="p-topics-pager__link-text">Back</span>
							</span>
						</span>
					</a>
			<?php } ?>
		</div>

		<p class="p-topics-pager__back">
			<a
			class="u-upper"
			href="<?php echo esc_url( home_url( '/' ) ); ?>news"
			>
				<span class="wrap">
					<span class="inner"><span class="text">Diary top</span></span>
				</span>
			</a>
		</p>

		<div class="p-topics-pager__btn p-topics-pager__btn--next">
		<?php if ( $next_post ) { ?>
			<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
				<span class="p-topics-pager__link-wrap">
							<span class="p-topics-pager__link-inner">
					<span class="p-topics-pager__link-text">Next</span>
							</span>
				</span>
			</a>
		<?php } ?>
		</div>
	</div>
</div>

</article>

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
