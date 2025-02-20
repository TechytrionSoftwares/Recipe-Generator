<?php
function ingredient_single_template($single) {
    global $post;
    if ($post->post_type == 'ingredient') {
        if (file_exists(plugin_dir_path(__FILE__) . 'single-ingredient.php')) {
            return plugin_dir_path(__FILE__) . 'single-ingredient.php';
        }
    }

    return $single; 
}

add_filter('single_template', 'ingredient_single_template');


function recipe_single_template($single) 
{
    global $post;
    if ($post->post_type == 'recipe') {
          if (file_exists(plugin_dir_path(__FILE__) . 'single-recipe.php')) {
            return plugin_dir_path(__FILE__) . 'single-recipe.php';
        }
    } 

    return $single; 
}

add_filter('single_template', 'recipe_single_template', 9999);

?>