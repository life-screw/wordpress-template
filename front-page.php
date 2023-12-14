<?php
/**
 * Front page
 *
 * トップページ。
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

<!-- ↓↓↓↓↓↓コードを設置し終わったら消すこと↓↓↓↓↓↓ -->
<!-- よく使うPHPコード -->
	<?php if ( is_front_page() ) : ?>
	<?php endif; ?>

	<?php echo esc_url( home_url( '/' ) ); ?>
	<?php echo esc_url( get_template_directory_uri() ); ?>

<!-- 記事のループ処理（PHPコードの例） -->
	<?php
	/*WordPressオブジェクトの作成*/
	$args1     = array(
		'post_type'      => 'post',// カスタム投稿ならカスタム投稿のスラッグを入れる
		'posts_per_page' => 1,
		'order'          => 'DESC',  // 'ASC' - 最低から最高に昇順 values (1, 2, 3; a, b, c).
		'orderby'        => 'date',
	);
	$my_query1 = new WP_Query( $args1 );
	?>
		<?php if ( $my_query1->have_posts() ) : ?>
			<?php
			while ( $my_query1->have_posts() ) :
				$my_query1->the_post();
				?>
		<a class="p-fv-topic" href="<?php the_permalink(); ?>">
			<h2 class="p-fv-topic__title u-upper">TOPICS</h2>
			<article class="p-fv-topic__textarea">
					<figure>
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
					</figure>
					<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>" class="p-fv-topic__time"><?php echo esc_attr( get_the_date( 'Y.m.d' ) ); ?></time>
					<h3 class="p-fv-topic__subtitle"><?php the_title(); ?></h3>
					<p class="p-fv-topic__text">
						<?php echo esc_html( get_the_excerpt() ); ?>
					</p>
			</article>
		</a>
		<?php endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_postdata();// ループの条件をリセット. ?>

<!-- instagram-feed埋め込み（PHPコードの例） -->
<section class="p-instagram l-inner">
	<h2 class="c-sec-title__title u-upper js-fadein__inner">Instagram</h2>
	</div>
	<div class="js-fadein">
		<?php echo do_shortcode( '[instagram-feed feed=1]' ); ?>
	</div>
</section>

<?php get_footer(); ?>
