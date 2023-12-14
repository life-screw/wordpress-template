<?php
/**
 * Page
 *
 * 固定ページ。
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
		// 固定ページのスラッグを取得.

		$src;
		global $wp_query; // ループ外なので、オブジェクトを取得.
		$post_obj = $wp_query->get_queried_object();
		$slug     = $post_obj->post_name;  // 投稿や固定ページのスラッグ.
		switch ( $slug ) {
			case 'contact':
			case 'thanks':
				$src = 'contact';
				break;

			default:
				$src = $slug;
				break;
		}
		?>

		<!-- よく使うPHPコード -->
		<?php the_title(); ?>

		<!-- 管理画面の内容を読み込むテンプレート -->
		<div class="l-page-inner p-<?php echo esc_html( $src ); ?>">
			<?php remove_filter( 'the_content', 'wpautop' ); // Pタグ除去. ?>
				<?php the_content(); ?>
		</div>


		<?php
		endwhile;
		endif;
?>
<?php get_footer(); ?>
