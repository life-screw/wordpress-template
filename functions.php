<?php
/**
 * Functions
 *
 * テーマのFunction.php
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
<?php
/*
* Add Javascript, CSS, Fonts.
* (管理ページ以外に適応)
*/
if ( ! is_admin() ) {

	/**
	 * Add Javascript, CSS, Fonts.
	 * 参考サイト：http://rfs.jp/sb/wordpress/wp-lab/wp_enqueue_script.html.
	 * https://devanswers.co/enqueue-google-fonts-to-wordpress-functions-php/
	 */
	function register_script() {
		// WP同梱のjqueryを読み込ませない.(重複読込防止).
		wp_deregister_script( 'jquery' );

		// JavaScriptファイル-------------.
		// サイト共通.
		wp_enqueue_script( 'jquery', esc_url( get_template_directory_uri() ) . '/dist/js/jquery-3.7.1.min.js', array(), '3.7.1', false );
		// [第4引数]array()の()には、先に読み込んでほしいものを書く.
		// [第5引数]trueの場合、</body>終了タグ前に配置.
		wp_enqueue_script( 'all', esc_url( get_template_directory_uri() ) . '/dist/js/common.js', array( 'jquery' ), '1.0.0', true );// 第一引数に「common」は使わない（システムファイルと被るから）.

		// 各ページ、システムごと.
		if ( is_front_page() ) {
			wp_enqueue_script( 'home', esc_url( get_template_directory_uri() ) . '/dist/js/home.js', array(), '1.0.0', true );
		}
		if ( is_singular( 'works' ) ) {
			wp_enqueue_script( 'works', esc_url( get_template_directory_uri() ) . '/dist/js/single.js', array( 'jquery' ), '1.0.0', true );
		}
		if ( is_page( 'contact' ) ) {
			wp_enqueue_script( 'contact', esc_url( get_template_directory_uri() ) . '/dist/js/contact.js', array( 'jquery' ), '1.0.0', true );
		}

		// WEB FONT---------------------.
		// GoogleFontsのコードをそのまま貼ると、最初のフォントしか適応されないので、下の参考サイトを参考に直すこと.
		// https://neetlance.com/post/enqueue-style-google-fonts/ .
		wp_enqueue_style( 'google-fonts', esc_url( 'https://fonts.googleapis.com/css?family=Cormorant:400,600|Noto+Sans+JP|Noto+Serif+JP:300,400&display=swap' ), '', '20230706' );// esc_urlでURLを無害化するとレンダリングが綺麗.

		// CSSファイル--------------------.
		// サイト共通.
		wp_enqueue_style( 'all', esc_url( get_template_directory_uri() ) . '/dist/css/common.css', '', '20230706' );
		// 各ページ、システムごと.
		$src;
		if ( is_front_page() ) {
			$src = 'home';
		} elseif ( is_post_type_archive( 'works' ) || is_tax( 'works-category' ) || is_singular( 'works' ) ) {
			$src = 'works';
		} elseif ( is_home() || is_paged( 'news' ) || is_archive() || is_single() || is_search() ) { // is_paged() 2ページ目以降 //is_archive()はカテゴリページ.
			$src = 'news';
		} elseif ( is_page() ) {
			global $wp_query; // ループ外なので、オブジェクトを取得.
			// 親ページがある時の条件分岐.
			$parent_page = $wp_query->post->post_parent; // 親ページのIDを取得.
			// 'product' ページを取得し、存在するか確認.
			$product_page = get_page_by_path( 'product' );
			if ( $product_page && $product_page->ID === $parent_page ) {
				$src = 'product';
			} else {
				$post_obj = $wp_query->get_queried_object();
				$slug     = $post_obj->post_name;  // 投稿や固定ページのスラッグ.
				switch ( $slug ) {
					default:
						$src = $slug;
						break;
				}
			}
		} elseif ( is_404() ) {
			$src = 'not-found';
		}
		wp_enqueue_style( 'parts', esc_url( get_template_directory_uri() ) . '/dist/css/' . esc_html( $src ) . '.css', '', '20230706' );
	}
	add_action( 'wp_enqueue_scripts', 'register_script' );
}


/**ダッシュボードの名称変更　投稿→NEWS*/
function edit_admin_menus() {
	global $menu;
	global $submenu;
	// phpcs:ignore WordPress.WP.GlobalVariablesOverride
	$menu[5][0] = 'NEWS';
}
add_action( 'admin_menu', 'edit_admin_menus' );

/**
 * -----------------------------------------------------
 * ＜apngはアップロードする時の注意＞
 * 1.圧縮するとアニメーションが動かなくなるので、
 *   メディアサイズは必ずapngのサイズ以上の大きさに設定する。
 * 2.画像を挿入するときは、フルサイズの画像を設定する。
 * ----------------------------------------------------- */
/**
 * APNG,SVGをアップロード https://blog.universe-web.jp/3359/
 *
 * @param string $file_types first parameter.
 */
function add_file_types_to_uploads( $file_types ) {

	$new_filetypes         = array();
	$new_filetypes['svg']  = 'image/svg+xml';
	$new_filetypes['apng'] = 'image/apng';
	$file_types            = array_merge( $file_types, $new_filetypes );

	return $file_types;
}
add_action( 'upload_mimes', 'add_file_types_to_uploads' );

/**
 * メディアの挿入をルート相対パスに https://illbenet.jp/view/wordpress-admin_function-delete_domain_from_attachment_url
 *
 * @param string $url url.
 */
function delete_domain_from_attachment_url( $url ) {
	if ( preg_match( '/^http(s)?:\/\/[^\/\s]+(.*)$/', $url, $match ) ) {
		$url = $match[2];
	}
	return $url;
}
add_filter( 'wp_get_attachment_url', 'delete_domain_from_attachment_url' );
add_filter( 'attachment_link', 'delete_domain_from_attachment_url' );

/**
 * カスタム投稿タイプの設定　
 */
function create_custom_post_type() {
	// カスタム投稿タイプを追加（WORKS）.
	register_post_type(
		'works',
		array(
			'label'               => 'WORKS',
			'public'              => true, // 投稿タイプをpublicにするか.
			'exclude_from_search' => true, // 投稿タイプを検索対象に含めるか.
			'has_archive'         => true, // アーカイブ機能ON/OFF.
			'show_in_rest'        => true, // 5系から出てきた新エディタ[Gutenberg]を有効にする.
			'supports'            => array( 'title', 'editor', 'thumbnail', 'author', 'revisions' ),
			'menu_position'       => 7, // 管理画面上での配置場所.
			'show_in_rest'        => true, // 5系から出てきた新エディタ.
			'rewrite'             => array(
				'with_front' => false, // 最初に設定したパーマリンクをもとにディレクトリ生成しない.
			),
		)
	);
	// カスタム投稿タイプを追加（TOPICS）.
	register_post_type(
		'topics',
		array(
			'label'               => 'TOPICS',
			'public'              => true, // 投稿タイプをpublicにするか.
			'exclude_from_search' => true, // 投稿タイプを検索対象に含めるか.
			'has_archive'         => true, // アーカイブ機能ON/OFF.
			'show_in_rest'        => true, // 5系から出てきた新エディタ[Gutenberg]を有効にする.
			'supports'            => array( 'title', 'editor', 'author', 'revisions' ),
			'menu_position'       => 5, // 管理画面上での配置場所.
			'show_in_rest'        => true, // 5系から出てきた新エディタ.
			'rewrite'             => array(
				'with_front' => false, // 最初に設定したパーマリンクをもとにディレクトリ生成しない.
			),
		)
	);

	// タクソノミーを追加（WORKSのみ）.
	register_taxonomy(
		'works-category',
		'works',
		array(
			'hierarchical'   => true, // 親子関係.
			'label'          => 'WORKSカテゴリー',
			'show_in_rest'   => true, // 5系から出てきた新エディタ[Gutenberg]を有効にする.
			'show_ui'        => true,
			'query_var'      => true,
			'public'         => true,
			'singular_label' => 'WORKSカテゴリー',
			'rewrite'        => array(
				'with_front' => false, // 最初に設定したパーマリンクをもとにディレクトリ生成しない.
			),
		)
	);
}
add_action( 'init', 'create_custom_post_type' );

/**
 * -----------------------------------------------------
 * カスタム投稿の管理画面一覧に項目を表示
 * https://b-risk.jp/blog/2017/02/wp_admin_list_columns/ を改造
 * works はカスタム投稿タイプ、works-category　はカスタム投稿のタクソノミー
 * ----------------------------------------------------- */
/**
 * 管理画面での表示項目追加
 *
 * @param string $columns first parameter.
 * @return $columns
 */
function my_add_columns( $columns ) {
	$columns['works-category'] = 'WORKSカテゴリー';
	return $columns;
}
add_filter( 'manage_edit-works_columns', 'my_add_columns' );

/**
 * カスタム投稿一覧の時（ソート用のリンクもつける）
 *
 * @param string $column_name first parameter.
 * @param string $post_id second parameter.
 */
function my_add_columns_content( $column_name, $post_id ) {
	if ( 'works-category' === $column_name ) {
		$taxs = wp_get_object_terms( $post_id, 'works-category' );
		foreach ( $taxs as $tax ) {
			if ( $tax ) {
				echo wp_kses_post( '<a style="margin-right:1rem;" href="edit.php?post_type=works&works-category=' . $tax->slug . '"> ' . $tax->name . '</a>' );
			}
		}
	}
}
add_action( 'manage_works_posts_custom_column', 'my_add_columns_content', 10, 2 );

/**
 * ソート機能をつける
 */
function my_add_post_taxonomy_restrict_filter() {
	global $post_type;
	if ( 'works' === $post_type ) {
		?>
		<select name="works-category">
		<option value="">カテゴリー指定なし</option>
		<?php
		$terms = get_terms( 'works-category' );
		// URI（ドメイン以下のパス）を取得.
		if ( isset( $_GET['works-category'] ) ) {
			$terms_cat = sanitize_text_field( wp_unslash( $_GET['works-category'] ) );
		}
		foreach ( $terms as $term ) {
			?>
		<option value="<?php echo esc_html( $term->slug ); ?>"
			<?php
			if ( isset( $terms_cat ) && $terms_cat === $term->slug ) {
				echo esc_html( 'selected' );
			}
			?>
			>
			<?php echo esc_html( $term->name ); ?></option>
			<?php
		}
		?>
		</select>
		<?php
	}
}
add_action( 'restrict_manage_posts', 'my_add_post_taxonomy_restrict_filter' );

/**
 * -----------------------------------------------------
 * WordPress 固定ページ内でページネーションを使ったら404になる原因と対策
 * https://meshikui.com/2019/04/10/1559/
 * ----------------------------------------------------- */
/**
 * ページネーションのURLを調整
 *
 * @param string $redirect_url first parameter.
 * @return $redirect_url
 */
function my_disable_redirect_canonical( $redirect_url ) {
	if ( is_archive() ) {
		$subject = $redirect_url;
		$pattern = '/\/page\//'; // URLに「/page/」があるかチェック.
		preg_match( $pattern, $subject, $matches );

		if ( $matches ) {
			// リクエストURLに「/page/」があれば、リダイレクトしない.
			$redirect_url = false;
			return $redirect_url;
		}
	}
}
add_filter( 'redirect_canonical', 'my_disable_redirect_canonical' );

/**
 * MW WP FORM　複数要素のエラーをまとめて表示する
 * https://b-risk.jp/blog/2022/03/mwwpform-customize/
 * ※ここで設定する項目には、バリデーションルールの「必須項目」にはチェックをつけない
 *
 * @param string $validation first parameter.
 * @param string $data second parameter.
 * @return $validation
 */
function add_mwform_validation_rule( $validation, $data ) {
	$validation_message01 = '姓もしくは名が未入力です。';
	if ( empty( $data['姓'] ) ) {
		$validation->set_rule( '姓', 'noempty', array( 'message' => $validation_message01 ) );
	} elseif ( empty( $data['名'] ) ) {
		$validation->set_rule( '名', 'noempty', array( 'message' => $validation_message01 ) );
	}
	$validation_message02 = 'セイもしくはメイが未入力です。';
	if ( empty( $data['セイ'] ) ) {
		$validation->set_rule( 'セイ', 'noempty', array( 'message' => $validation_message02 ) );
	} elseif ( empty( $data['メイ'] ) ) {
		$validation->set_rule( 'メイ', 'noempty', array( 'message' => $validation_message02 ) );
	}
	return $validation;
}
add_filter( 'mwform_validation_mw-wp-form-377', 'add_mwform_validation_rule', 10, 2 ); // 377はformのkey番号.

/**
 * -----------------------------------------------------
 * MW WP Fromのビジュアルエディターを無効化する
 * 固定ページはビジュアルエディタを使いたかったので、コード変更
 * https://knowledge-base.site/web_creative/web_creative-940/#:~:text=MW%20WP%20Forms%E3%81%A7%E3%83%93%E3%82%B8%E3%83%A5%E3%82%A2%E3%83%AB,php%E3%82%92%E7%B7%A8%E9%9B%86%20%E3%81%97%E3%81%BE%E3%81%99%E3%80%82&text=%E3%81%93%E3%82%8C%E3%81%A7%E3%80%81MW%20WP%20Forms,%E3%81%AF%E8%A1%A8%E7%A4%BA%E3%81%95%E3%82%8C%E3%81%AA%E3%81%8F%E3%81%AA%E3%82%8A%E3%81%BE%E3%81%99%E3%80%82
 * ----------------------------------------------------- */
function visual_editor_off() {
	global $typenow;
	if ( in_array( $typenow, array( 'mw-wp-form' ) ) ) {
		add_filter( 'user_can_richedit', 'off_visual_editor' );
	}
}
/**
 * MW WP Fromのビジュアルエディタを無効化する
 */
function off_visual_editor() {
	return false;
}
add_action( 'load-post.php', 'visual_editor_off' );
add_action( 'load-post-new.php', 'visual_editor_off' );

/**
 * 投稿/固定ページのURLが日本語の場合、記事IDで自動生成する
 * https://satokenblog.com/wordpress-post-slug/
 *
 * @param string $slug first parameter.
 * @param string $post_ID second parameter.
 * @param string $post_status third parameter.
 * @param string $post_type fourth parameter.
 */
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
	if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
		$slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
	}
	return $slug;
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4 );

/**
 * Author ページを検索されないようにする（※セキュリティ対策。外部からユーザー名が取得できないように）.
 */
function no_author_archive() {
	if ( is_author() ) {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		get_template_part( 404 );
		exit;
	}
}

add_action( 'template_redirect', 'no_author_archive' );

if ( ! function_exists( 'pnd_allow_all_attr' ) ) {
	/**
	 * 属性値消失を防ぐ関数.
	 *
	 * @param string $init first parameter.
	 */
	function pnd_allow_all_attr( $init ) {
		$ext_elements = '';

		$target_elements = array(
			'a',
			'b',
			'base',
			'big',
			'blockquote',
			'body',
			'br',
			'caption',
			'clear',
			'dd',
			'div',
			'dl',
			'dt',
			'em',
			'embed',
			'font',
			'form',
			'h',
			'head',
			'hr',
			'html',
			'i',
			'img',
			'input',
			'li',
			'link',
			'meta',
			'nobr',
			'noembed',
			'object',
			'ol',
			'option',
			'p',
			'pre',
			'rel',
			's',
			'script',
			'select',
			'small',
			'span',
			'strike',
			'strong',
			'sub',
			'sup',
			'table',
			'tbody',
			'td',
			'textarea',
			'tfoot',
			'th',
			'thead',
			'title',
			'tr',
			'tt',
			'u',
			'ul',
			'iframe',
		);
		$target_attr     = array(
			'*',
		);

		foreach ( $target_elements as $target_element ) {
			$ext_elements .= ',' . $target_element . '[' . implode( '|', $target_attr ) . ']';
		}

		if ( ! empty( $ext_elements ) ) {
			if ( ! empty( $init['extended_valid_elements'] ) ) {
				$init['extended_valid_elements'] .= $ext_elements;
			} else {
				$init['extended_valid_elements'] = trim( $ext_elements, ',' );
			}
		}

		return $init;
	}
	add_filter( 'tiny_mce_before_init', 'pnd_allow_all_attr', 100 );
}

/**
 * 本文のimgタグだけ、pで囲わない設定.
 *
 * @param string $content first parameter.
 */
function remove_p_on_images( $content ) {
	return preg_replace( '/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '\2', $content );
}
add_filter( 'the_content', 'remove_p_on_images' );



/**
 * 固定ページでGUTENBERG（ブロックエディタ）を無効化
 * https://irodory.jp/web/wordpress/customize/5456
 *
 * @param string $use_block_editor first parameter.
 * @param string $post_type second parameter.
 */
function hide_block_editor( $use_block_editor, $post_type ) {
	if ( 'page' === $post_type ) {
		return false;
	}
	return $use_block_editor;
}
add_filter( 'use_block_editor_for_post_type', 'hide_block_editor', 10, 10 );


/**
 * メディアサイズ追加
 * 「function_exists」は指定した関数をチェックする。
 * すなわち、この関数を使っていたら、
 * この関数以下に書いた関数（この場合「add_image_size」）がなくなってもエラーが出ず、無視してくれる。
 */
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'works-thumb-top', 274, 582, true ); // 縮小時にトリミングする場合はtrue、しない場合はfalse（省略時はfalse）.
	add_image_size( 'works-single-top', 720, 429, true );
}


/**
 * NEWS一覧 抜粋の長さを変更する
 *
 * @param string $length first parameter.
 */
function custom_excerpt_length( $length ) {
	return 70;
}
add_filter( 'excerpt_length', 'custom_excerpt_length' );

/**
 * NEWS一覧 文末文字を変更する
 *
 * @param string $more first parameter.
 */
function custom_excerpt_more( $more ) {
	return ' ... ';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

/**
 * <body> につくbody_classの整理
 *
 * @param string $classes first parameter.
 */
function custom_body_class( $classes ) {
	$classes = array(); // clear
	// カスタム投稿タイプのclassを追加.
	$posttype = esc_html( get_post_type() );
	if ( ! empty( $posttype ) && ! is_front_page() ) {
		$classes[ $posttype ] = $posttype;
	}
	if ( is_tax() ) {
		global $wp_query;
		$my_taxonomy = get_query_var( 'taxonomy' );
		if ( $my_taxonomy ) {
			$set             = esc_html( get_taxonomy( $my_taxonomy )->object_type[0] );
			$classes[ $set ] = $set;
		}
		$term      = $wp_query->queried_object;
		$classes[] = esc_html( $term->slug );
	}
	if ( is_category() ) {
		global $cat;
		$classes[] = 'category';
		if ( $cat ) {
			$classes[] = trim( get_category_parents( $cat, false, ' ', true ) );
		}
	} elseif ( is_archive() ) {
		$classes[] = 'archive';
		if ( empty( $posttype ) && ! is_tax() ) {
			$obj                   = get_queried_object();
			$classes[ $obj->name ] = $obj->name;
		}
	} elseif ( is_front_page() ) {
		$classes[] = 'home';
	} elseif ( is_page() ) {
		global $post;
		if ( $post->post_parent ) {
			$page_ancestors = get_post_ancestors( $post->ID );
			foreach ( $page_ancestors as $v ) {
				$p         = get_page( $v );
				$classes[] = $p->post_name;
			}
		}
		$classes[]       = $post->post_name;
		$classes['page'] = 'page';
	} elseif ( is_single() ) {
		// phpcs:ignore WordPress.WP.GlobalVariablesOverride
		$cat = get_the_category();
		if ( ! empty( $cat ) ) {
			// phpcs:ignore WordPress.WP.GlobalVariablesOverride
			$cat       = $cat[0]->cat_ID;
			$classes[] = trim( get_category_parents( $cat, false, ' ', true ) );
		}
		$classes[] = 'single';
		global $post;
		if ( ! empty( $posttype ) ) {
			$classes[] = $posttype . '-' . $post->ID;
		}
	} elseif ( is_404() ) {
		$classes[] = 'not-found';
	}
	return $classes;
}
add_filter( 'body_class', 'custom_body_class' );

/**
 * 「続きを読む」のカスタマイズ
 *
 * @param string $output first parameter.
 * @param string $more_link_text second parameter.
 */
function my_content_more_link( $output, $more_link_text ) {
	return '...';
}
add_filter( 'the_content_more_link', 'my_content_more_link', 10, 2 );

/**
 * ページネーション の出力
 *
 * @param string $pages first parameter.
 * @param string $range second parameter.
 */
function pagination( $pages = '', $range = 2 ) {
	$showitems = ( $range * 2 ) + 1;
	global $paged;
	if ( empty( $paged ) ) {
		// phpcs:ignore WordPress.WP.GlobalVariablesOverride
		$paged = 1;
	}

	if ( '' === $pages ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;}
	}

	if ( 1 !== $pages ) {
		echo '<div class="pagination">';
		// echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";.
		if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
			echo "<a href='" . wp_kses_post( get_pagenum_link( 1 ) ) . "'>&laquo; First</a>";
		}
		if ( $paged > 1 && $showitems < $pages ) {
			echo "<a href='" . wp_kses_post( get_pagenum_link( $paged - 1 ) ) . "'>&lsaquo; Previous</a>";
		}

		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 !== $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged === $i ) ? '<span class="active">' . esc_html( $i ) . '</span>' : "<a href='" . wp_kses_post( get_pagenum_link( $i ) ) . "' class=\"inactive\">" . esc_html( $i ) . '</a>';
			}
		}
		if ( $paged < $pages && $showitems < $pages ) {
			echo '<a href="' . wp_kses_post( get_pagenum_link( $paged + 1 ) ) . '">Next &rsaquo;</a>';
		}
		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
			echo "<a href='" . wp_kses_post( get_pagenum_link( $pages ) ) . "'>Last &raquo;</a>";
		}
		echo "</div>\n";
	}
}

/**
 * ダッシュボードウィジェット非表示.
 */
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] ); // アクティビティ.
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // 現在の状況.
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] ); // クイック投稿.
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] ); // 最近の下書き.
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] ); // WordPressブログ.
	if ( ! current_user_can( 'level_10' ) ) {
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] ); // 被リンク.
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] ); // プラグイン.
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] ); // 最近のコメント.
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] ); // WordPressフォーラム.
	} else {
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] ); // 概要.
	}
}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );

// ダッシュボードの「WordPress へようこそ !」の非表示.
remove_action( 'welcome_panel', 'wp_welcome_panel' );

/**
 * 読み込み不要なﾌﾟﾗｸﾞｲﾝのCSSを削除（Search Everything）
 */
function deregister_plugin_files() {
		wp_dequeue_style( 'se-link-styles' );
		wp_dequeue_style( 'yarppWidgetCss' );
}
add_action( 'wp_enqueue_scripts', 'deregister_plugin_files' );

// アイキャッチ画像を有効化.
add_theme_support( 'post-thumbnails' );

/**
 * WordPressログイン画面 ロゴ画像を変更
 */
function login_logo_image() {
	echo '<style type="text/css">
            #login h1 a {
                background: url(' . esc_url( get_template_directory_uri() ) . '/dist/img/common/logo.svg) no-repeat center / contain !important;
				width: 200px;
				height: 102px;
				margin: auto;
            }
    </style>';
}
add_action( 'login_head', 'login_logo_image' );

/**
 * WordPressログイン画面 ロゴ画像のリンク先をサイトトップに
 */
function login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'login_logo_url' );

/**
 * 「wp_enqueue_script() が誤って呼び出されました」エラーの対処法
 * https://www.geek.sc/archives/3372
 */
function phi_theme_support() {
	remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'phi_theme_support' );

/*
*
* ||||| セキュリティ関係追加 ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
*
*/

/*
* remove - wp-head <head>～</head>内で不要なものを出力しない
*/
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
remove_action( 'wp_head', 'parent_post_rel_link' );
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'croer_version' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'rsd_link' );

/*
* link rel="index"の削除
*/
remove_action( 'wp_head', 'index_rel_link' );

/*
* meta name="genarator"（WPのバージョン情報）の削除
*/
remove_action( 'wp_head', 'wp_generator' );

/**
 * Feed配信の削除
 */
function disable_our_feeds() {
	wp_die( esc_html( __( 'Error: No RSS Feed Available, Please visit our.' ) ) );
}
add_action( 'do_feed', 'disable_our_feeds', 1 );
add_action( 'do_feed_rdf', 'disable_our_feeds', 1 );
add_action( 'do_feed_rss', 'disable_our_feeds', 1 );
add_action( 'do_feed_rss2', 'disable_our_feeds', 1 );
add_action( 'do_feed_atom', 'disable_our_feeds', 1 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );


/*
* 管理画面へのリダイレクト（URL/loginからURL/wp-login.phpへのリダイレクト）を無効にする
*/
remove_action( 'template_redirect', 'wp_redirect_admin_locations', 1000 );


/*
*  author/category/search/comment ページを設定しない（※設定後パーマリンクを再設定すること）
*/
add_filter( 'author_rewrite_rules', '__return_empty_array' );
add_filter( 'search_rewrite_rules', '__return_empty_array' );
add_filter( 'comments_rewrite_rules', '__return_empty_array' );


/**
 * 削除 X-Pingback header（※セキュリティ対策　2015.3.9）
 * ※X-Pingback をヘッダーから外すと不具合が出る可能性があります。予約投稿など。
 *
 * @param string $headers first parameter.
 */
function remove_x_pingback( $headers ) {
	unset( $headers['X-Pingback'] );
	return $headers;
}
add_filter( 'wp_headers', 'remove_x_pingback' );

/**
 * 検索結果から特定の投稿を除外 （403用の固定ページを除外）
 * 除外のフィルターを掛ける
 *
 * @param string $query first parameter.
 */
function search_filter( $query ) {
	if ( defined( 'PAGE_403_ID' ) && ! is_admin() && $query->is_main_query() && $query->is_search() ) {
		$query->set( 'post__not_in', array( PAGE_403_ID ) );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'search_filter' );


