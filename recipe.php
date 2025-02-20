<?php
/*
 * Plugin Name:       Custom Recipe Generator
 * Plugin URI:        https://techytrionsoftwares.com/
 * Description:       It Generate the recipe using filter.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Techy Developer
 * Author URI:        https://techytrionsoftwares.com/
 * License:           GPL v2 or later
 * License URI:       #
 * Update URI:        https://techytrionsoftwares.com/
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define('CRG_NAME',"crg");
include_once plugin_dir_path( __FILE__ ) . 'includes/ingredient-template.php';
// Function to create the custom post type
// 

add_action('init','crg_language_translate');
function crg_language_translate(){
	load_plugin_textdomain( 'crg', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
}


function create_ingredient_post_type() {
    $labels = array(
        'name'               => _x( 'Ingredients', 'post type general name' ),
        'singular_name'      => _x( 'Ingredient', 'post type singular name' ),
        'menu_name'          => _x( 'Ingredients', 'admin menu' ),
        'name_admin_bar'     => _x( 'Ingredient', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'ingredient' ),
        'add_new_item'       => __( 'Add New Ingredient' ),
        'new_item'           => __( 'New Ingredient' ),
        'edit_item'          => __( 'Edit Ingredient' ),
        'view_item'          => __( 'View Ingredient' ),
        'all_items'          => __( 'All Ingredients' ),
        'search_items'       => __( 'Search Ingredients' ),
        'parent_item_colon'  => __( 'Parent Ingredients:' ),
        'not_found'          => __( 'No ingredients found.' ),
        'not_found_in_trash' => __( 'No ingredients found in Trash.' )
    );

    // Register the post type
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'ingredient' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );

    register_post_type( 'ingredient', $args );
	   $labels = array(
        'name'               => _x( 'Base', 'post type general name' ),
        'singular_name'      => _x( 'Base', 'post type singular name' ),
        'menu_name'          => _x( 'Base', 'admin menu' ),
        'name_admin_bar'     => _x( 'Base', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'Base' ),
        'add_new_item'       => __( 'Add New Base' ),
        'new_item'           => __( 'New Base' ),
        'edit_item'          => __( 'Edit Base' ),
        'view_item'          => __( 'View Base' ),
        'all_items'          => __( 'All Base' ),
        'search_items'       => __( 'Search Base' ),
        'parent_item_colon'  => __( 'Parent Base:' ),
        'not_found'          => __( 'No Base found.' ),
        'not_found_in_trash' => __( 'No Base found in Trash.' )
    );

    // Register the post type
    $argsbase = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'Base' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );

    register_post_type( 'Base', $argsbase );
		$labelsrecipe = array(
        'name'               => _x( 'Recipe', 'post type general name' ),
        'singular_name'      => _x( 'Recipe', 'post type singular name' ),
        'menu_name'          => _x( 'Recipe', 'admin menu' ),
        'name_admin_bar'     => _x( 'Recipe', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'Recipe' ),
        'add_new_item'       => __( 'Add New Recipe' ),
        'new_item'           => __( 'New Recipe' ),
        'edit_item'          => __( 'Edit Recipe' ),
        'view_item'          => __( 'View Recipe' ),
        'all_items'          => __( 'All Recipe' ),
        'search_items'       => __( 'Search Recipe' ),
        'parent_item_colon'  => __( 'Parent Recipe:' ),
        'not_found'          => __( 'No Recipe found.' ),
        'not_found_in_trash' => __( 'No Recipe found in Trash.' )
    );

    // Register the post type
    $argsrecipe = array(
        'labels'             => $labelsrecipe,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'recipe' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );

    register_post_type( 'recipe', $argsrecipe );
}

// Function to create the custom taxonomy
function create_ingredient_taxonomy() {
    // Set up labels for the taxonomy
    $labels = array(
        'name'              => _x( 'Ingredient Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Ingredient Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Ingredient Categories' ),
        'all_items'         => __( 'All Ingredient Categories' ),
        'parent_item'       => __( 'Parent Ingredient Category' ),
        'parent_item_colon' => __( 'Parent Ingredient Category:' ),
        'edit_item'         => __( 'Edit Ingredient Category' ),
        'update_item'       => __( 'Update Ingredient Category' ),
        'add_new_item'      => __( 'Add New Ingredient Category' ),
        'new_item_name'     => __( 'New Ingredient Category Name' ),
        'menu_name'         => __( 'Ingredient Categories' ),
    );

    // Register the taxonomy
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'ingredient-category' ),
    );

    register_taxonomy( 'ingredient_category', array( 'ingredient' ), $args );
}

add_action( 'init', 'create_ingredient_post_type' );
add_action( 'init', 'create_ingredient_taxonomy' );

// Activation hook to register the custom post type and taxonomy on plugin activation
function activate_ingredient_plugin() {
    create_ingredient_post_type();
    create_ingredient_taxonomy();
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'activate_ingredient_plugin' );

// Deactivation hook to unregister the custom post type and taxonomy on plugin deactivation
function deactivate_ingredient_plugin() {
    unregister_post_type( 'ingredient' );
    unregister_taxonomy( 'ingredient_category' );
    flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'deactivate_ingredient_plugin' );


function ingredient_filter_shortcode() {
    ob_start();
    include plugin_dir_path( __FILE__ ) . 'includes/ingredient-filter-template.php';
    return ob_get_clean();
}

add_shortcode('ingredient_filter', 'ingredient_filter_shortcode');

function icp_enqueue_custom_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('icp-custom-script', plugin_dir_url(__FILE__) . 'assets/js/custom-script.js', array('jquery'), time(), true);
	wp_enqueue_style('icp-custom-style', plugin_dir_url(__FILE__) . 'assets/css/custom.css', false, time(), 'all');
    wp_localize_script('icp-custom-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
	wp_localize_script('icp-custom-script', 'localizedStrings', array(
        'dishBasisText' => __('The basis of the dish:', CRG_NAME),
		'recipetext' => __('Recipe:', CRG_NAME),
		'createpea' => __('Creatpea', CRG_NAME),
		'tenmin' => __('10-20 min', CRG_NAME),
		'fourtymin' => __('20-40 min', CRG_NAME),
		'doesntmatter' => __("doesn't matter", CRG_NAME),
    ));
	
}
add_action('wp_enqueue_scripts', 'icp_enqueue_custom_scripts');

// Handle AJAX request to get posts by category
function icp_get_posts_by_category() {
    $category_id = intval($_POST['category_id']);
    
    $args = array(
        'post_type' => 'ingredient',
        'tax_query' => array(
            array(
                'taxonomy' => 'ingredient_category',
                'field'    => 'term_id',
                'terms'    => $category_id,
            ),
        ),
    );
    $posts = get_posts($args);
    
    if ( !empty( $posts ) ) {
		
         $post_titles = array();
        
        foreach ( $posts as $post ) {
            $post_titles[] = esc_html( $post->post_title );
        }
        
        echo implode(', ', $post_titles);
    } else {
       echo __('No posts found', CRG_NAME);
    }
    
    wp_die();
}
add_action('wp_ajax_get_posts_by_category', 'icp_get_posts_by_category');
add_action('wp_ajax_nopriv_get_posts_by_category', 'icp_get_posts_by_category');


add_action('wp_ajax_nopriv_submit_recipe', 'handle_recipe_submission');
add_action('wp_ajax_submit_recipe', 'handle_recipe_submission');

function handle_recipe_submission() {
    if (isset($_POST['recipe'], $_POST['ingredient'], $_POST['recipe_idea'], $_POST['product'], $_POST['quantity'])) {
        $recipe = sanitize_text_field($_POST['recipe']);
        $ingredient = sanitize_text_field($_POST['ingredient']);
        $recipe_idea = sanitize_textarea_field($_POST['recipe_idea']);
        $product = sanitize_textarea_field($_POST['product']);
        $productcategoryId = sanitize_textarea_field($_POST['productcategoryId']);
		$quantity = sanitize_textarea_field($_POST['quantity']);
		$cookingtime = sanitize_textarea_field($_POST['cookingtime']);
		
		$posts = get_posts(array(
            'post_type'      => 'recipe',
            'post_status'    => 'publish', // Only get published posts
            'numberposts'    => 2, // Get all posts
            'meta_query'     => array(
                'relation' => 'AND', // Use 'AND' to ensure all conditions are met
                array(
                    'key'     => 'recipe_base',
                    'value'   => $recipe,
                    'compare' => '='
                ),
                array(
                    'key'     => 'recipe_idea',
                    'value'   => $recipe_idea,
                    'compare' => '='
                )
            )
        ));
        
        if (count($posts) >= 2) {
            ob_clean();
            
            $successful_responses = array();
            foreach ($posts as $post) {
                $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'full');
                $successful_responses[] = array(
                    'post_id' => $post->ID,
                    'content' => $post->post_content,
                    'image_url' => esc_url($thumbnail_url)
                );
            }
            
            wp_send_json(array('success' => true, 'posts' => $successful_responses));
            
            wp_die();
        }
        
        if($product == 'Creatpea BEEFFREE'){
			$creatpea_instruction = 'To prepare 500 g of ready mass, mix 130 g of dry powder with 300 ml of cold water and 70 ml of oil. Mix until a homogeneous mass is obtained and store in the refrigerator for 10 minutes.';
		}elseif($product == 'Creatpea CHICKENFREE'){
			$creatpea_instruction = 'To prepare 500 g of ready mass, mix 130 g of dry powder with 300 ml of cold water and 70 ml of oil. Mix until a homogeneous mass is obtained and store in the refrigerator for 10 minutes.';
		}elseif($product == 'Creatpea FISHFREE'){
			$creatpea_instruction = 'To prepare 500 g of ready mass, mix 130 g of dry powder with 300 ml of cold water and 70 ml of oil. Mix until a homogeneous mass is obtained and store in the refrigerator for 10 minutes.';
		}elseif($product == 'Creatpea תחליף דגים'){
            // $creatpea_instruction = 'כדי להכין 500 גרם של מסה מוכנה, ערבבו 130 גרם של אבקה יבשה עם 300 מ"ל מים קרים ו-70 מ"ל שמן. ערבבו עד לקבלת מסה הומוגנית ואחסנו במקרר למשך 10 דקות. חלקו ל-5 מנות (100 גרם לכל מנה) והכינו את המנה האהובה עליכם (המבורגרים, כדורי בשר, קבבים וכו\'). ניתן לבשל/לטגן/לאפות ולהוסיף תבלינים וירקות בכל דרך שתרצו.';
            $creatpea_instruction = 'להכנת 500 גרם תערובת מוכנה, ערבבו 130 גרם אבקה יבשה עם 300 מ"ל מים קרים ו-70 מ"ל שמן. ערבבו עד שהתקבל מסה אחידה ואחסנו במקרר למשך 10 דקות.';

		}elseif($product == 'Creatpea תחליף עוף'){
            // $creatpea_instruction = 'כדי להכין 500 גרם של מסה מוכנה, ערבבו 130 גרם של אבקה יבשה עם 300 מ"ל מים קרים ו-70 מ"ל שמן. ערבבו עד לקבלת מסה הומוגנית ואחסנו במקרר למשך 10 דקות. חלקו ל-5 מנות (100 גרם לכל מנה) והכינו את המנה האהובה עליכם (המבורגרים, כדורי בשר, קבבים וכו\'). ניתן לבשל/לטגן/לאפות ולהוסיף תבלינים וירקות בכל דרך שתרצו.';
            
            $creatpea_instruction = 'להכנת 500 גרם תערובת מוכנה, ערבב 130 גרם אבקה יבשה עם 300 מ"ל מים קרים ו-70 מ"ל שמן. ערבב עד שהתקבלה מסה אחידה ואחסן במקרר למשך 10 דקות.';

		}elseif($product == 'Creatpea תחליף בשר'){
            // $creatpea_instruction = 'כדי להכין 500 גרם של מסה מוכנה, ערבבו 130 גרם של אבקה יבשה עם 300 מ"ל מים קרים ו-70 מ"ל שמן. ערבבו עד לקבלת מסה הומוגנית ואחסנו במקרר למשך 10 דקות. חלקו ל-5 מנות (100 גרם לכל מנה) והכינו את המנה האהובה עליכם (המבורגרים, כדורי בשר, קבבים וכו\'). ניתן לבשל/לטגן/לאפות ולהוסיף תבלינים וירקות בכל דרך שתרצו.';
            $creatpea_instruction = 'להכנת 500 גרם תערובת מוכנה, ערבב 130 גרם אבקה יבשה עם 300 מ"ל מים קרים ו-70 מ"ל שמן. ערבב עד שתתקבל מסה אחידה ואחסן במקרר למשך 10 דקות.';

		}
        $api_responses = call_chatgpt_api($recipe, $ingredient, $recipe_idea, $product, $quantity, $cookingtime, $creatpea_instruction);

        $successful_responses = array();
        $max_retries = 4;
        $retry_count = 0;

        while (count($successful_responses) < 2 && $retry_count < $max_retries) {
            foreach ($api_responses as $api_response) {
                if (isset($api_response['content'], $api_response['image_url']) && !empty($api_response['image_url'])) {
					$recipestitle = $product . ' '. $recipe;
                    $post_title = esc_html_e('Recipe: ', CRG_NAME) . $recipestitle;
                    $post_content = $api_response['content'];

                    $new_post = array(
                        'post_title' => $post_title,
                        'post_content' => $post_content,
                        'post_type' => 'recipe',
                        'post_status' => 'publish'
                    );

                    $post_id = wp_insert_post($new_post);
                    
                    if ($recipe) {
                        update_post_meta($post_id, 'recipe_base', $recipe);
                    }
                
                    if ($ingredient) {
                        update_post_meta($post_id, 'recipe_ingredient', $ingredient);
                    }
                
                    if ($recipe_idea) {
                        update_post_meta($post_id, 'recipe_idea', $recipe_idea);
                    }
                
                    if ($product) {
                        update_post_meta($post_id, 'recipe_product', $product);
                    }
                
                    if ($productcategoryId) {
                        update_post_meta($post_id, 'recipe_product_id', $productcategoryId);
                    }
                
                    if ($quantity) {
                        update_post_meta($post_id, 'recipe_persons', $quantity);
                    }
                
                    if ($cookingtime) {
                        update_post_meta($post_id, 'recipe_cooking_time', $cookingtime);
                    }
                    
                    update_post_meta($post_id, 'creatpea_instruction', $creatpea_instruction);

                    if ($post_id && !is_wp_error($post_id)) {
                        $image_url = $api_response['image_url'];
                        require_once(ABSPATH . 'wp-admin/includes/file.php');
                        require_once(ABSPATH . 'wp-admin/includes/media.php');
                        require_once(ABSPATH . 'wp-admin/includes/image.php');

                        $image_html = media_sideload_image($image_url, $post_id, $post_title, 'id');

                        if (!is_wp_error($image_html)) {
                            $attachment = get_posts([
                                'numberposts' => 1,
                                'post_type' => 'attachment',
                                'post_parent' => $post_id,
                                'orderby' => 'post_date',
                                'order' => 'DESC',
                            ]);
                            $attachment_id = $attachment[0]->ID;

                            set_post_thumbnail($post_id, $attachment_id);

                            $successful_responses[] = array(
                                'post_id' => $post_id,
                                'content' => $post_content,
                                'image_url' => $image_url
                            );

                            if (count($successful_responses) >= 2) {
                                break;
                            }
                        } else {
                            wp_delete_post($post_id, true);
                        }
                        
                        
                    }
                }
            }

            $retry_count++;

            if (count($successful_responses) < 2) {
                $api_responses = call_chatgpt_api($recipe, $ingredient, $recipe_idea, $product, $quantity, $cookingtime, $creatpea_instruction);
            }
        }
    ob_clean();
        if (count($successful_responses) >= 2) {
            wp_send_json(array('success' => true, 'posts' => $successful_responses));
        } else {
            wp_send_json_error('Failed to generate three successful results.');
        }
    } else {
        wp_send_json_error('Form not submitted correctly.');
    }

    wp_die();
}


function call_chatgpt_api($recipe, $ingredient, $recipe_idea, $product, $quantity, $cookingtime, $creatpea_instruction) {
    // Old key
    // $api_key = 'sk-proj-X4RRTsvPXJeemtR9lgCYT3BlbkFJbJbUzT3f2ulDIBjAeIfk';
    // New key
    $api_key = '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';

    $responses = [];
    $current_language = apply_filters('wpml_current_language', null);
    for ($i = 0; $i < 2; $i++) {
        if( $current_language == "he"){
            // $request_body_text = json_encode([
            //     			'model' => 'gpt-3.5-turbo',
            //     			'messages' => [
            //     				['role' => 'system', 'content' => 'You are a helpful assistant.'],
            //     							['role' => 'user', 'content' => 
            //     							"כיש לי מתכון עם בסיס: $recipe, ורכיב: $ingredient, יחד עם $product. הנה הרעיון: $recipe_idea. הכמות היא $quantity. זמן הבישול הכולל הוא $cookingtime. האם תוכל לעזור לי עם מתכון מפורט? הנה הוראות נוספות: ספק סקירה כללית של 30 מילים על המתכון ב-div עם class 'overview'. לאחר מכן, הוסף div נפרד עם class 'Ingredients'. ב-div זה, כותרת הרכיב צריכה להיות בתג <h3> ורשום את הרכיבים ואת המשקל/כף/כמות בתג <table> עם כותרות 'Ingredient' ו-'Amount'. רשום כל רכיב עם 'weight', 'tablespoon', או 'amount' ספציפיים — ודא שכל הרכיבים מספקים פרטים אלה במדויק עם מדידה מדויקת ולא השתמש ב-'quantity as desired', אל תשתמש ב-'varies' או מדידות מעורפלות. לאחר מכן, הוסף div נפרד עם class 'how-to-cook'. ב-div זה, הכותרת 'How to Cook' צריכה להיות בתג <h3>, ותאר את תהליך הבישול עם אייקונים כלולים. השתמש בתגיות <ul> ו-<li> לרשימה ואל השתמש ב-'Step 1:' , אל השתמש ב-'1:' , אל השתמש ב-'1.' , אל השתמש ב-'Step 1.' ואל השתמש באייקונים ב-'How to Cook'. השמט את תגיות ה-head וה-body HTML. נדרש בשפה האנגלית. לאחר מכן, הוסף div נפרד עם class 'Nutritional_Value'. ב-div זה, כותרת 'Nutritional Value' צריכה להיות בתג <h3> ו-'Nutritional Value' בתג <table> עם כותרות 'Nutritions' ו-'Calories', וב-'Nutritions' הצג Nutritions וב-'Calories' הצג Gram Value — ודא שכל ערך תזונתי ו- Gram Value מספקים פרטים אלו במדויק עם מדידה מדויקת ואל השתמש ב-'varies Based', אל השתמש ב-'Varies' או מדידות מעורפלות."]
            //     			]
            // ]);
            
            $request_body_text = json_encode([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'אתה עוזר מועיל.'],
                    ['role' => 'system', 'content' => "יש לי מתכון עם הבסיס: $recipe, ורכיב: $ingredient, יחד עם $product. הרעיון הוא: $recipe_idea. הכמות היא $quantity. זמן הבישול הכולל הוא $cookingtime.

                        האם תוכל לעזור לי עם מתכון מפורט?
                        
                        הנה הוראות נוספות:
                        
                        ספק סקירה של 30 מילים על המתכון בתוך div עם הקלאס 'overview'.
                        
                        לאחר מכן, כלול div נפרד עם הקלאס 'Ingredients'. בתוך div זה, כותרת הרכיבים צריכה להיות ב-tag h3 ורכיבים עם המדידות שלהם צריכים להיות רשומים בתוך תגית table עם כותרות th 'Ingredient' ו-'Amount'. רשום כל רכיב עם 'weight', 'tablespoon', או 'amount' — ודא שכל הרכיבים מספקים פרטים אלו באופן מפורש עם מדידות מדויקות ולא השתמש ב-'quantity as desired', 'varies', אל תשתמש במדידות מעורפלות או ב-'1 Weight'.
                        
                        לאחר מכן, כלל div נפרד עם הקלאס 'how-to-cook'. בתוך div זה, כותרת ה-'How to Cook' צריכה להיות ב-tag h3. הנקודה הראשונה בקטע 'How to Cook' צריכה להיות $creatpea_instruction. לאחר מכן, תאר את תהליך הבישול עם הוראות מפורטות עם מינימום של 20 מילים לכל שורה וללא אייקונים. השתמש בתגיות ul ו-li לרשימה ואל תשתמש ב-'Step 1:', '1:', '1.', 'Step 1.' או בכל אייקון אחר ב-'How to Cook'.
                        
                        לבסוף, כלל div נפרד עם הקלאס 'Nutritional_Value'. בתוך div זה, כותרת ה-'Nutritional Value' צריכה להיות ב-tag h3 ו-'Nutritional Value' והוסף <p>בהתאם לחשבונות של רשת הנוירונים Mistral</p> לאחר h3. הצג 'Nutritions' וערכים בתוך שני td של טבלה — ודא שכל ערך תזונתי וערך מסופקים עם מדידות מדויקות ולא השתמש ב-'varies Based', 'Varies', אל תשתמש במדידות מעורפלות או ב-'Calculated Based On Serving Size'."]

                ]
            ]);
		}else{
            // $request_body_text = json_encode([
            // 			'model' => 'gpt-3.5-turbo',
            // 			'messages' => [
            // 				['role' => 'system', 'content' => 'You are a helpful assistant.'],
            // 				['role' => 'user', 'content' => "I have a recipe with the base: $recipe, and an ingredient: $ingredient, along with $product. Here is the idea: $recipe_idea. The quantity is $quantity. The total cooking time is $cookingtime. Can you help me with a detailed recipe? Here are some additional instructions: Provide a 30-word overview of the recipe in a div with class 'overview'. Then, include a separate div with class 'Ingredients'. In this div, the ingredient title should be in an h3 tag and ingredients and weight/tablespoon/amount in table tag with th heading 'Ingredient' and 'Amount'. List each ingredient with a specific 'weight', 'tablespoon', or 'amount'—ensure that all ingredients provide these details explicitly. Do not use 'quantity as desired' or any vague measurements. After that, include a separate div with class 'how-to-cook'. In this div, the 'How to Cook' title should be in an h3 tag, and describe the cooking process with icons included. Use ul and li tags for the list and do not use 'Step 1:' , do not use '1:', do not use '1.', do not use 'Step 1.' and do not use icons in the 'How to Cook'. Exclude HTML head and body tags. Need in English language.Then, include a separate div with class 'Nutritional Value'. In this div, the 'Nutritional Value' title should be in an h3 tag and 'Calories' like 'Cholesterol, Fat, Protein Etc' and 'Approximately Gram' Like '10g Etc' in table tag with th heading 'Calories' and 'Approximately Gram'. List each Calories with a specific 'gram'—ensure that all ingredients provide these details explicitly."]
            // 			]
            // 		]);

            // $request_body_text = json_encode([
            // 			'model' => 'gpt-3.5-turbo',
            // 			'messages' => [
            // 				['role' => 'system', 'content' => 'You are a helpful assistant.'],
            // 				['role' => 'user', 'content' => "I have a recipe with the base: $recipe, and an ingredient: $ingredient, along with $product. Here is the idea: $recipe_idea. The quantity is $quantity. The total cooking time is $cookingtime. Can you help me with a detailed recipe? Here are some additional instructions: Provide a 30-word overview of the recipe in a div with class 'overview'. Then, include a separate div with class 'Ingredients'. In this div, the ingredient title should be in an h3 tag and ingredients and weight/tablespoon/amount in table tag with th heading 'Ingredient' and 'Amount'. List each ingredient with a specific 'weight', 'tablespoon', or 'amount' —ensure that all ingredients provide these details explicitly with exact measurement and do not use 'quantity as desired', do not use 'varies' or any vague measurements. After that, include a separate div with class 'how-to-cook'. In this div, the 'How to Cook' title should be in an h3 tag, and describe the cooking process with detailed instructions with a minimum of 20 words per line and no icons included. Use ul and li tags for the list and do not use 'Step 1:', do not use '1:', do not use '1.', do not use 'Step 1.' and do not use icons in the 'How to Cook'. Exclude HTML head and body tags. Need in English language. Then, include a separate div with class 'Nutritional_Value'. In this div, the 'Nutritional Value' title should be in an h3 tag and 'Nutritional Value' in table tag with th heading 'Nutritions' and 'Calories' and in 'Nutritions' tab show Nutritions and in 'Calories' show Gram Value —ensure that all Nutrition Value and Gram Value provide these details explicitly with exact measurement and do not use 'varies Based', do not use 'Varies' or do not use any vague measurements."]
            // 			]
            // 		]);

            $request_body_text = json_encode([
    			'model' => 'gpt-3.5-turbo',
    			'messages' => [
    				['role' => 'system', 'content' => 'You are a helpful assistant.'],
    				['role' => 'user', 'content' => "I have a recipe with the base: $recipe, and an ingredient: $ingredient, along with $product. Here is the idea: $recipe_idea. The quantity is $quantity. The total cooking time is $cookingtime. 
    
                        Can you help me with a detailed recipe? 
                        
                        Here are some additional instructions:
                        
                        Provide a 30-word overview of the recipe in a div with class 'overview'. 
                        
                        Then, include a separate div with class 'Ingredients'. In this div, the ingredient title should be in an h3 tag and ingredients and their measurements should be listed in a table tag with th headings 'Ingredient' and 'Amount'. List each ingredient with a specific 'weight', 'tablespoon', or 'amount' — ensure that all ingredients provide these details explicitly with exact measurements and do not use 'quantity as desired', 'varies', do not use any vague measurements, or not use '1 Weight'.
                        
                        After that, include a separate div with class 'how-to-cook'. In this div, the 'How to Cook' title should be in an h3 tag. The first point in the 'How to Cook' section should be $creatpea_instruction. Then, describe the cooking process with detailed instructions with a minimum of 20 words per line and no icons included. Use ul and li tags for the list and do not use 'Step 1:', '1:', '1.', 'Step 1.' or any icons in the 'How to Cook'.
                        
                        Finally, include a separate div with class 'Nutritional_Value'. In this div, the 'Nutritional Value' title should be in an h3 tag and 'Nutritional Value' and add a <p>According to calculations by the Mistral neural network</p> after h3 tag. In this show 'Nutritions' and values in two table td — ensure that all Nutrition Value and Value provide these details explicitly with exact measurements and do not use 'varies Based', 'Varies', do not use any vague measurements, or do not use 'Calculated Based On Serving Size' .
                        
                        Please format the response accordingly."]
    			]
    		]);
		
		}
	

        $timeout_seconds = 2000; 
        $response_text = wp_remote_post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $api_key,
            ],
            'body' => $request_body_text,
			'timeout' => $timeout_seconds,
        ]);

        if (is_wp_error($response_text)) {
            $responses[] = ['content' => 'Error calling ChatGPT API for text completion.', 'image_url' => ''];
            continue;
        }

        $response_text_body = json_decode(wp_remote_retrieve_body($response_text), true);
        $content = $response_text_body['choices'][0]['message']['content'];
        error_log(print_r($response_text_body, true));

        $request_body_image = json_encode([
            'prompt' => "Image for recipe: $recipe with $ingredient. Recipe idea: $recipe_idea",
            'n' => 1,
            'model' => 'dall-e-2',
            'size' => '512x512'
        ]);

        $timeout_seconds = 30;

        $response_image = wp_remote_post('https://api.openai.com/v1/images/generations', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $api_key,
            ],
            'body' => $request_body_image,
            'timeout' => $timeout_seconds,
        ]);

        if (is_wp_error($response_image)) {
            $responses[] = ['content' => $content, 'image_url' => 'Error generating image: ' . $response_image->get_error_message()];
            continue;
        }

        $response_image_body = json_decode(wp_remote_retrieve_body($response_image), true);
        error_log(print_r($response_image_body, true));

        if (!isset($response_image_body['data'][0]['url'])) {
            $responses[] = ['content' => $content, 'image_url' => 'Error generating image.'];
            continue;
        }

        $image_url = $response_image_body['data'][0]['url'];
        $responses[] = ['content' => $content, 'image_url' => $image_url];
    }

    return $responses;
}

function custom_recipe_metaboxes() {
    add_meta_box('recipe_base', 'Recipe Base', 'render_recipe_base_metabox', 'recipe', 'normal', 'high');
    add_meta_box('recipe_ingredient', 'Recipe Ingredient', 'render_recipe_ingredient_metabox', 'recipe', 'normal', 'high');
    add_meta_box('recipe_idea', 'Recipe Idea', 'render_recipe_idea_metabox', 'recipe', 'normal', 'high');
    add_meta_box('recipe_product', 'Recipe Product', 'render_recipe_product_metabox', 'recipe', 'normal', 'high');
    add_meta_box('recipe_product_id', 'Recipe Product ID', 'render_recipe_product_id_metabox', 'recipe', 'normal', 'high');
    add_meta_box('recipe_persons', 'Recipe Number of Persons', 'render_recipe_persons_metabox', 'recipe', 'normal', 'high');
    add_meta_box('recipe_cooking_time', 'Recipe Cooking Time', 'render_recipe_cooking_time_metabox', 'recipe', 'normal', 'high');
}
add_action('add_meta_boxes', 'custom_recipe_metaboxes');

// Step 2: Render Metaboxes
function render_recipe_base_metabox($post) {
    $value = get_post_meta($post->ID, 'recipe_base', true);
    echo '<input type="text" name="recipe_base" value="' . esc_attr($value) . '" class="widefat">';
}

function render_recipe_ingredient_metabox($post) {
    $value = get_post_meta($post->ID, 'recipe_ingredient', true);
    echo '<input type="text" name="recipe_ingredient" value="' . esc_attr($value) . '" class="widefat">';
}

function render_recipe_idea_metabox($post) {
    $value = get_post_meta($post->ID, 'recipe_idea', true);
    echo '<input type="text" name="recipe_idea" value="' . esc_attr($value) . '" class="widefat">';
}

function render_recipe_product_metabox($post) {
    $value = get_post_meta($post->ID, 'recipe_product', true);
    echo '<input type="text" name="recipe_product" value="' . esc_attr($value) . '" class="widefat">';
}

function render_recipe_product_id_metabox($post) {
    $value = get_post_meta($post->ID, 'recipe_product_id', true);
    echo '<input type="text" name="recipe_product_id" value="' . esc_attr($value) . '" class="widefat">';
}

function render_recipe_persons_metabox($post) {
    $value = get_post_meta($post->ID, 'recipe_persons', true);
    echo '<input type="number" name="recipe_persons" value="' . esc_attr($value) . '" class="widefat">';
}

function render_recipe_cooking_time_metabox($post) {
    $value = get_post_meta($post->ID, 'recipe_cooking_time', true);
    echo '<input type="text" name="recipe_cooking_time" value="' . esc_attr($value) . '" class="widefat">';
}




?>