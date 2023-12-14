<?php
/**
 * Page
 *
 * 固定ページ（Contact）
 *
 * @category   Components
 * @package    WordPress
 * @subpackage themes_template
 * @author     COLLECTONS
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://collectons.jp/
 * @since      1.0.0
 */

?>
<?php get_header(); ?>


	<div class="p-form">
		

		<!-- 管理画面の内容を読み込むテンプレート -->
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>

				<?php remove_filter( 'the_content', 'wpautop' ); // Pタグ除去. ?>
				<?php the_content(); ?>


				<?php
		endwhile;
		endif;
		?>



	</div>

<?php get_footer(); ?>
