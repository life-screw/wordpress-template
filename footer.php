<?php
/**
 * Footer
 *
 * テーマのFooter
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
<!-- ↓↓↓↓↓↓コードを設置し終わったら消すこと↓↓↓↓↓↓ -->
<!-- よく使うPHPコード -->
	<?php if ( is_front_page() ) : ?>
	<?php endif; ?>

	<?php echo esc_url( home_url( '/' ) ); ?>
	<?php echo esc_url( get_template_directory_uri() ); ?>
<!-- ↑↑↑↑↑↑コードを設置し終わったら消すこと↑↑↑↑↑↑ -->



<!-- ▲▲▲ コンテンツの記述ここまで ▲▲▲ -->

<?php wp_footer(); ?>

</body>
</html>
