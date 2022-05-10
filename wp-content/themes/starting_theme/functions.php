<?php
add_theme_support( 'post-thumbnails' );
add_filter( 'jpeg_quality', function () {
	return 100;
} );
function _remove_script_version( $src ) {
	$parts = explode( '?', $src );
	if ( $parts[0] == 'https://fonts.googleapis.com/css' ) {
		$parts[0] = $src;
	}
	if ( $parts[0] == 'https://maps.googleapis.com/maps/api/js' ) {
		$parts[0] = $src;
	}
	return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
/*Add style or scripts files*/
function load_theme_styles() {
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), null, 'all' );
	wp_register_style( 'style', get_template_directory_uri() . '/style.css', array(), time(), 'all' );
	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'style' );
	$js_directory_uri = get_template_directory_uri() . '/js/';
	wp_register_script( 'slick', $js_directory_uri . 'slick.js', array( 'jquery' ), null ,true);
	wp_register_script( 'script', $js_directory_uri . 'script.js', array( 'jquery' ), null,true );
	wp_enqueue_script( 'slick' );
	wp_enqueue_script( 'script' );
}
add_action( 'wp_enqueue_scripts', 'load_theme_styles', 100 );
/*REGISTER MENU*/
function menulang_setup() {
	load_theme_textdomain( 'themename', get_template_directory() . '/languages' );
	register_nav_menus( array( 'header_menu' => __( 'Menu', 'themename' ) ) );
	register_nav_menus( array( 'footer_menu-onehalf' => __( 'footer menu one half', 'themename' ) ) );
	register_nav_menus( array( 'footer_contact' => __( 'footer contact', 'themename' ) ) );
	register_nav_menus( array( 'footer_menu-center' => __( 'footer menu-center', 'themename' ) ) );
}
add_action( 'after_setup_theme', 'menulang_setup' );
function theme_sidebars() {
	register_sidebar( array( 'name'          => __( 'Header logo', 'themename' ),
	                         'id'            => 'header_logo',
	                         'description'   => __( 'Header logo', 'themename' ),
	                         'before_widget' => '',
	                         'after_widget'  => '',
	                         'before_title'  => '',
	                         'after_title'   => ''
	) );
	register_sidebar( array( 'name'          => __( 'Header button', 'themename' ),
	                         'id'            => 'header_button',
	                         'description'   => __( 'Header button', 'themename' ),
	                         'before_widget' => '',
	                         'after_widget'  => '',
	                         'before_title'  => '',
	                         'after_title'   => ''
	) );
	register_sidebar( array( 'name'          => __( 'Header Call Us', 'themename' ),
	                         'id'            => 'header_call',
	                         'description'   => __( 'Header phone', 'themename' ),
	                         'before_widget' => '',
	                         'after_widget'  => '',
	                         'before_title'  => '',
	                         'after_title'   => ''
	) );
	register_sidebar( array( 'name'          => __( 'Footer logo', 'themename' ),
	                         'id'            => 'footer_logo',
	                         'description'   => __( 'Footer logo', 'themename' ),
	                         'before_widget' => '',
	                         'after_widget'  => '',
	                         'before_title'  => '',
	                         'after_title'   => ''
	) );
	register_sidebar( array( 'name'          => __( 'Footer Developed', 'themename' ),
	                         'id'            => 'footer_developed',
	                         'description'   => __( 'Footer Developed', 'themename' ),
	                         'before_widget' => '',
	                         'after_widget'  => '',
	                         'before_title'  => '',
	                         'after_title'   => ''
	) );
    register_sidebar( array( 'name'          => __( 'Footer Phone', 'themename' ),
                              'id'           => 'footer_phone',
                              'description'  => __( 'Footer phone', 'themename' ),
                              'before_widget' => '',
                              'after_widget'  => '',
                              'before_title'  => '',
                              'after_title'   => ''
    ) );
    register_sidebar( array( 'name'          => __( 'Footer Address', 'themename' ),
                              'id'            => 'footer_addres',
                              'description'   => __( 'Footer address', 'themename' ),
                              'before_widget' => '',
                              'after_widget'  => '',
                              'before_title'  => '',
                              'after_title'   => ''
    ) );
    register_sidebar( array( 'name'          => __( 'Footer Copyright', 'themename' ),
                              'id'            => 'footer_copyright',
                              'description'   => __( 'Footer copyright', 'themename' ),
                              'before_widget' => '',
                              'after_widget'  => '',
                              'before_title'  => '',
                              'after_title'   => ''
    ) );
    register_sidebar( array( 'name'          => __( 'Footer Website Design', 'themename' ),
                              'id'            => 'footer_design',
                              'description'   => __( 'Footer Website Design', 'themename' ),
                              'before_widget' => '',
                              'after_widget'  => '',
                              'before_title'  => '',
                              'after_title'   => ''
    ) );
    register_sidebar( array( 'name'          => __( 'Footer Contact 2', 'themename' ),
                              'id'            => 'footer_contact_2',
                              'description'   => __( 'Footer contact', 'themename' ),
                              'before_widget' => '',
                              'after_widget'  => '',
                              'before_title'  => '',
                              'after_title'   => ''
    ) );
}
add_action( 'widgets_init', 'theme_sidebars' );
//*EXCERPT LENGTH*/
function new_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');
function add_file_types_to_uploads( $file_types ) {
	$new_filetypes        = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types           = array_merge( $file_types, $new_filetypes );

	return $file_types;
}
add_action( 'upload_mimes', 'add_file_types_to_uploads' );
// Remove blog highlighting
class    Main_Submenu_Class extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $classes     = array( 'sub-menu', 'list-unstyled', 'child-navigation' );
        $class_names = implode( ' ', $classes );
        $output      .= "\n" . '<ul class="' . $class_names . '">' . "\n";
    }
    function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
    function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names_arr = array();
        $class_names     = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        if(is_single()){
            $curr_post_type=get_post_type(get_the_ID());
            if (in_array($curr_post_type,$classes)) {
                $classes[]='current_page_parent';
                $classes[]='current-menu-item';
            } else {
                if (($key = array_search('current_page_parent', $classes)) !== false) {
                    unset($classes[$key]);
                }
                if (($key = array_search('current-menu-item', $classes)) !== false) {
                    unset($classes[$key]);
                }
            }
        }
        $class_names       = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names_arr[] = esc_attr( $class_names );
        $class_names_arr[] = 'menu-item-id-' . $item->ID;
        if ( $args->has_children ) {
            $class_names_arr[] = 'has-child';
        }
        $class_names = ' class="' . implode( ' ', $class_names_arr ) . '"';
        $output      .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
        $attributes  = '';
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . $item->url . '"' : '';
        $item_output = $args->before;
        $item_output .= '<div class="parent"><a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= $args->link_after;
        $item_output .= '</a>';
        if ( $args->has_children ) {
            $item_output .= '<span data-id="' . $item->ID . '"><i class="fa-solid fa-chevron-left"></i></span>';
        }
        $item_output .= '</div>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
// Numbered pagination
function pagination( $pages = '', $range = 4 ) {
	$showitems = ( $range * 2 ) + 1;

	global $paged;
	if ( empty( $paged ) ) {
		$paged = 1;
	}

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;
		}
	}
	if ( 1 != $pages ) {
		echo "<div class='paginate'>";
		if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
			echo "<a href='" . get_pagenum_link( 1 ) . "'>&laquo; First</a>";
		}
		if ( $paged > 1 && $showitems < $pages ) {
			echo "<a href='" . get_pagenum_link( $paged - 1 ) . "'>&lsaquo; Previous</a>";
		}

		for ( $i = 1; $i <= $pages; $i ++ ) {
			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i ) ? "<span class=\"pag_item current\">" . $i . "</span>" : "<a href='" . get_pagenum_link( $i ) . "' class=\"pag_item inactive\">" . $i . "</a>";
			}
		}
		if ( $paged < $pages && $showitems < $pages ) {
			echo "<a href=\"" . get_pagenum_link( $paged + 1 ) . "\">Next &rsaquo;</a>";
		}
		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
			echo "<a href='" . get_pagenum_link( $pages ) . "'>Last &raquo;</a>";
		}
		echo "</div>\n";
	}
}
// TODO: Register custom post type and taxonomy
//Register custom post type and taxonomy
$post_type_labels = array(
    'name' => __('Custom_Post', 'themename'),
    'singular_name' => __('Custom_Post', 'themename'),
    'add_new' => __('Add New', 'themename'),
    'add_new_item' => __('Add New', 'themename'),
    'edit_item' => __('Edit', 'themename'),
    'new_item' => __('New', 'themename'),
    'view_item' => __('View', 'themename'),
    'search_items' => __('Search', 'themename'),
    'not_found' => __('No found', 'themename'),
    'parent_item_colon' => '',
);
$description = get_option('theme_custom_description');
$post_type_args = array(
    'labels' => apply_filters('inspiry_property_post_type_labels', $post_type_labels),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'has_archive' => true,
    'capability_type' => 'post',
    'hierarchical' => true,
    'menu_icon' => 'dashicons-welcome-widgets-menus',
    'menu_position' => 5,
    'description' => $description,
    'supports' => array('title', 'thumbnail', 'editor',  'page-attributes'),
    'rewrite' => array(
        'slug' => apply_filters('inspiry_property_slug',  'custom_posts'),
    ),
);
register_post_type('custom_post', $post_type_args);
$feature_labels = array(
    'name'          => __('Custom category', 'themename'),
    'singular_name' => __('Custom category', 'themename'),
    'menu_name'     => __('Custom category', 'themename'),
);
register_taxonomy(
    'custom_post-type',
    array('custom_post'),
    array(
        'hierarchical'   => true,
        'labels'         => apply_filters('inspiry_property_feature_labels', $feature_labels),
        'show_ui'        => true,
        'query_var'      => true,
        'rewrite'        => array(
                'slug'       => apply_filters('inspiry_property_feature_slug',  'custom_post-types'),
        ),
    )
);
//Snazzy Map
function func_show_map_contact($attr) {
    $id_contact_page = '16';
    $api_key = get_field('api_key',$id_contact_page);
    $lt=$lg=$address=$ret=$lang='';
    $snazzymaps='no';
    if (isset($attr['lt'])) $lt=$attr['lt'];
    if (isset($attr['lg'])) $lg=$attr['lg'];
    if (isset($attr['address'])) $address=$attr['address'];
    if (isset($attr['language'])) $lang='&language='.$attr['language'].'';
    if (isset($attr['snazzymaps'])) $snazzymaps=$attr['snazzymaps'];
    if ($lt!='' AND $lg!='') {
        $json='';
        if ($snazzymaps=='yes') {
            $SnazzyMapStyles = get_option( 'SnazzyMapStyles' );
            if (isset($SnazzyMapStyles[0]['json']))$json=$SnazzyMapStyles[0]['json'];
        }
        $ret='
<div class="container wrapper_top_contact mb42">
<div class="top_contact"><h5 class="ff_tittle_caps">'.get_field('section_name',$id_contact_page).'</h5>
<h2 class="title">'.get_field('title_sec_map',$id_contact_page).'</h2>
</div>
<div class="address_info">
<div class="address"><a class="mb16" href="'.get_field('link_address',$id_contact_page).'"><i class="fa-solid fa-location-dot"></i>'.get_field('address',$id_contact_page).'</a>
<div class="wrapper_tel_email">
<a href="tel:'.get_field('telephone',$id_contact_page).'" class="tel"><i class="fa-solid fa-phone"></i>'.get_field('telephone',$id_contact_page).'</a>
<a href="mailto:'.get_field('email',$id_contact_page).'" class="email"><i class="fa-solid fa-envelope"></i>'.get_field('email',$id_contact_page).'</a></div>
</div>
<div class="line">
</div>
<div class="company_name">
<p>'.get_field('company_name',$id_contact_page).'</p>
</div>

</div>
</div>
<div class="out_acf-map marg_bottom" >
    <div class="acf-map" >
        <div class="marker" data-lat="'.$lt.'" data-lng="'.$lg.'"></div>
    </div>
    <div class="overlay" onclick="style.pointerEvents='."'none'".'"></div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key='.$api_key.$lang.'"></script>
<script>
    const zooms=15;  
	let snazzystyles='.$json.';
	const pinImage="'.get_template_directory_uri() .'/css/img/free-icon-placeholder-684908.png";
    (function($) {
        let map = null;
        $(document).ready(function(){
            $(".acf-map").each(function(){
                map = new_map( $(this) ,snazzystyles);
            });
        });
    })(jQuery);
</script>';

    }
    return $ret;
}
add_shortcode('show_map_contact','func_show_map_contact');
function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
function top_section() {
    $id = get_the_ID();
    $title = get_field('the_title_top',$id) ?: '';
    $subtitle = get_field('the_subtitle_top',$id) ?: '';
    $background_image = get_field('background_image',$id) ?: '';
    $link_btn = get_field('link_btn_top',$id) ?: '';
    $text_btn = get_field('button_text_top',$id) ?: '';
    $m_x_full = get_field('content_width',$id) ?: '';
    ?>
    <section class="block_hero">
        <div class="container-top">
            <div class="top_section p110 border_none " style="background-image: url(<?=$background_image?>)">
                <div class="container">
                    <div class="content_hero <?php if($m_x_full) { ?>title_w_full<?php } ?>">
                      <?=$title ?>
                        <?php if($subtitle) { ?>
                            <p class="subtitle"><?=$subtitle ?></p>
                        <?php }?>

                        <?php if($link_btn && $text_btn) { ?>
                            <div class="pt42">
                            <a class="btn_main btn_orange" href="<?php echo $link_btn; ?>"><?=$text_btn ?></a>
                        </div>
                       <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php }
add_shortcode('show_top_section','top_section');
/*NUMBERS SECTION (HOME PAGE)*/
function func_numbers() {
    $rows = get_field('rows');
    ?>
    <?php if($rows): ?>
   <div class="numbers">
       <div class="numbers_wrapper">
        <?php foreach ($rows as $key => $value) { ?>
            <div class="number_item">
                <div class="value_title-num h2">
                    <?=$value['value'];?>
                </div>
                <h5><?=$value['text_value'];?></h5>
            </div>
              <?php  } ?>
       </div>
   </div>
    <?php endif; ?>
<?php }
add_shortcode('numbers_financing_industry','func_numbers');
/*RECOURCES (RECORCES PAGE)*/
function func_resources() {
    $list_xlc = get_field('list_xls');
    $list_pdf = get_field('list_pdf');
    $list_doc = get_field('list_doc');
    ?>
    <div class="row row_list_resources mt110">
     <div class="col-lg-4 col_list_r list_xlc">
    <?php if($list_xlc): ?>
         <div class="wrapper_list p110">
             <ul>
                 <?php foreach ($list_xlc as $key => $value) { ?>
                     <li class="list pb26">
                         <i class="fa-solid fa-cloud-arrow-down"></i>
                         <a href=" <?=$value['file_xls'];?>"><?=$value['file_name'];?></a>
                     </li>
                 <?php  } ?>
             </ul>
         </div>
    <?php endif; ?>
     </div>
        <div class="col-lg-4 col_list_r list_pdf">
            <?php if($list_pdf): ?>
                <div class="wrapper_list p110">
                    <ul>
        <?php foreach ($list_pdf as $key => $value) { ?>
                        <li class="list pb26">
                            <i class="fa-solid fa-cloud-arrow-down"></i>
                            <a href=" <?=$value['file_pdf'];?>"><?=$value['file_name'];?></a>
                        </li>
        <?php  } ?>
                    </ul>

                </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-4 col_list_r list_doc">
            <?php if($list_doc): ?>
                <div class="wrapper_list p110">
                    <ul>
                        <?php foreach ($list_doc as $key => $value) { ?>
                            <li class="list pb26">
                                <i class="fa-solid fa-cloud-arrow-down"></i>
                                <a href="<?=$value['file_doc'];?>"><?=$value['file_name'];?></a>
                            </li>
                        <?php  } ?>
                        <a class="acrobat_link" href="<?php  echo get_field('acrobat_link') ?>">
                            <img src="/wp-content/uploads/2022/05/Group-4895.svg" alt="Actobate"></a>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php }
add_shortcode('list_resources','func_resources');
/*LIST INFO(PRODUCT PAGE)*/
function func_list_info() {
    $list_left = get_field('list_left');
    $list_right = get_field('list_right');
    ?>
        <div class="wrapper_product_info">
    <div class="row row_list_info">
        <div class="col-lg-6 col_product_item">
            <?php if($list_left): ?>
                <div class="wrapper_list">
                    <ul>
                        <?php foreach ($list_left as $key => $value) { ?>
                            <li class="list_item p16 mb6">
                                <span class="h5"><?=$value['list_item_title'];?></span>
                                <span class="h5"><?=$value['list_item_text'];?></span>
                            </li>
                        <?php  } ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-6 col_product_item">
            <?php if($list_right): ?>
                <div class="wrapper_list">
                    <ul>
                        <?php foreach ($list_right as $key => $value) { ?>
                            <li class="list_item p16 mb6">
                                <span class="h5"><?=$value['list_item_title'];?></span>
                                <span class="h5"><?=$value['list_item_text'];?></span>
                            </li>
                        <?php  } ?>
                    </ul>

                </div>
            <?php endif; ?>
        </div>
    </div>
        </div>
<?php }
add_shortcode('list_info','func_list_info');
//GRAVITY FORM

function gform_column_splits( $content, $field, $value, $lead_id, $form_id ) {
    if( !IS_ADMIN ) { // only perform on the front end

        // target section breaks
        if( $field['type'] == 'section' ) {
            $form = RGFormsModel::get_form_meta( $form_id, true );

            // check for the presence of multi-column form classes
            $form_class = explode( ' ', $form['cssClass'] );
            $form_class_matches = array_intersect( $form_class, array( 'two-column', 'three-column' ) );

            // check for the presence of section break column classes
            $field_class = explode( ' ', $field['cssClass'] );
            $field_class_matches = array_intersect( $field_class, array('gform_column') );

            // if field is a column break in a multi-column form, perform the list split
            if( !empty( $form_class_matches ) && !empty( $field_class_matches ) ) { // make sure to target only multi-column forms

                // retrieve the form's field list classes for consistency
                $form = RGFormsModel::add_default_properties( $form );
                $description_class = rgar( $form, 'descriptionPlacement' ) == 'above' ? 'description_above' : 'description_below';

                // close current field's li and ul and begin a new list with the same form field list classes
                return '</li></ul><ul class="gform_fields '.$form['labelPlacement'].' '.$description_class.' '.$field['cssClass'].'"><li class="gfield gsection empty">';

            }
        }
    }

    return $content;
}
add_filter( 'gform_field_content', 'gform_column_splits', 10, 5 );