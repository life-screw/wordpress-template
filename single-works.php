<?php
/**
 * Single-works
 *
 * WORKSの詳細ページ。
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

<article class="p-works l-page-wrap l-inner">
	<div class="c-sec-title p-home-philosophy__title js-fadein">
	<p class="c-sec-title__title u-upper js-fadein__inner"><a href="<?php echo esc_url( home_url( '/' ) ); ?>works">WORKS</a></p>
	</div>

	<div class="p-works-single">
	<h1 class="p-works-single__title js-fadein"><span class="js-fadein__inner"><?php the_title(); ?></span></h1>
		<?php
		$taxonomys = get_the_terms( $post->ID, 'works-category' );
		if ( $taxonomys ) :
      		// phpcs:ignore WordPress.WP.GlobalVariablesOverride
			foreach ( $taxonomys as $taxonomy ) {
				echo '<p class="p-works-single__term js-fadein"><a class="js-fadein__inner" href="' . esc_url( get_term_link( $taxonomy ) ) . '">' . esc_textarea( $taxonomy->name ) . '</a></p>';
			}
		endif;
		?>
	<div class="p-works-single__contents">
			<?php the_content(); ?>
	</div>

		<?php
		$works_part = get_field( 'works_part' );
		$works_name = get_field( 'works_name' );
		if ( $works_name ) {
			echo '<p class="p-works-single__name">' . esc_textarea( $works_part ) . '：' . esc_textarea( $works_name ) . '</p>';
		}
		?>
		<?php
		$works_textarea = get_field( 'works_textarea' );
		if ( $works_textarea ) {
			echo '<p class="p-works-single__textarea">' . esc_textarea( $works_textarea ) . '</p>';
		}
		?>
	</div>

	<div class="p-works-pager">
			<?php
			$prev_post = get_previous_post();
			$next_post = get_next_post();

			if ( $prev_post ) {
				$prev_image        = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ), 'thumbnail' );

				// $prev_imageが真偽型でない時(アイキャッチが入っている時)にアイキャッチを出力.
				if ( ! ( is_bool( $prev_image ) ) ) {
					$prev_image_src    = $prev_image[0];
					$prev_image_width  = $prev_image[1];
					$prev_image_height = $prev_image[2];
				} else {
					$prev_image_src = esc_url( get_template_directory_uri() ) . '/dist/img/common/topics_thumbnail.png';
					$prev_image_width       = '630';
					$prev_image_height      = '400';
				}
				?>
		<div class="p-works-pager__btn p-works-pager__btn--back">
			<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
				<figure><img src="<?php echo esc_url( $prev_image_src ); ?>" width="<?php echo esc_textarea( $prev_image_width ); ?>" height="<?php echo esc_textarea( $prev_image_height ); ?>" alt="<?php echo esc_html( $prev_post->post_title ); ?>"></figure>
				<span class="p-works-pager__link-wrap"><span class="p-works-pager__link-inner"><span class="p-works-pager__link-text">Back</span></span></span>
			</a>
		</div>
		<?php } ?>

		<?php
		if ( $next_post ) {
				$next_image    = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ), 'thumbnail' );
			// $next_imageが真偽型でない時(アイキャッチが入っている時)にアイキャッチを出力.
			if ( ! ( is_bool( $next_image ) ) ) {
				$next_image_src    = $next_image[0];
				$next_image_width  = $next_image[1];
				$next_image_height = $next_image[2];
			} else {
				$next_image_src = esc_url( get_template_directory_uri() ) . '/dist/img/common/topics_thumbnail.png';
				$next_image_width       = '630';
				$next_image_height      = '400';
			}
			?>
			<div class="p-works-pager__btn p-works-pager__btn--next">
				<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
					<figure><img src="<?php echo esc_url( $next_image_src ); ?>" width="<?php echo esc_textarea( $next_image_width ); ?>" height="<?php echo esc_textarea( $next_image_height ); ?>" alt="<?php echo esc_html( $next_post->post_title ); ?>"></figure>
					<span class="p-works-pager__link-wrap"><span class="p-works-pager__link-inner"><span class="p-works-pager__link-text">Next</span></span></span>
				</a>
			</div>
		<?php } ?>
	<p class="p-works-pager__back">
		<a class="u-upper" href="<?php echo esc_url( home_url( '/' ) ); ?>works">
			<span class="wrap"><span class="inner"><span class="text">All WORKS</span></span></span>
		</a>
	</p>
	</div>

	</article>

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
