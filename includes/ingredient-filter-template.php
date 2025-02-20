<div class="recipe-filter-page-content">
<form method="post" action="" class="cstm_recp_frm">
   <input type="hidden" name="action" value="submit_recipe">
   <div class="box">
	    <div class="size-30 lft_drpdwn basic">
			<label for="basis" class="block text-sm font-medium text-foreground"><?php esc_html_e('The Basis', 'crg'); ?></label>
				<?php
		$posts = get_posts(array(
			'post_type' => 'base',
			'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
		));

		if ($posts) {
			echo '<select id="basis" name="recipe" class="mt-1 block w-full p-2 border border-input rounded-md bg-background text-foreground" required>';
			echo '<option value="">' . esc_html__('Select Base', 'crg') . '</option>';

			foreach ($posts as $post) {
				// Get the translated post ID based on the current language
				$translated_post_id = apply_filters('wpml_object_id', $post->ID, 'base', true);
				$translated_post = get_post($translated_post_id);

				// Use the translated post title
				$post_title = $translated_post->post_title;

				echo '<option value="' . esc_attr($post_title) . '">' . esc_html($post_title) . '</option>';
			}

			echo '</select>';
		} else {
			echo esc_html__('No posts found.', 'crg');
		}
		?>


             <label for="ingredient_posts" class="block text-sm font-medium text-foreground ctn"><?php esc_html_e('Add Ingredient', 'crg'); ?></label>
         <?php
            // Define the categories to exclude
            $excluded_categories = array('BEEFFREE', 'CHICKENFREE', 'FISHFREE');
            $excluded_category_ids = array();
            
            // Get category IDs for excluded categories
            foreach ($excluded_categories as $cat_name) {
                $term = get_term_by('name', $cat_name, 'category');
                if ($term) {
                    $excluded_category_ids[] = $term->term_id;
                }
            }
            
            // Retrieve all 'ingredient' posts
            $posts = get_posts(array(
                'post_type' => 'ingredient',
                'posts_per_page' => -1
            ));
            
            // Filter posts to exclude those assigned to any of the excluded categories
            $filtered_posts = array_filter($posts, function($post) use ($excluded_category_ids) {
                // Get the categories assigned to the post
                $categories = wp_get_post_categories($post->ID);
                // Check if post has any of the excluded category IDs
                foreach ($categories as $cat_id) {
                    if (in_array($cat_id, $excluded_category_ids)) {
                        return false; // Exclude post
                    }
                }
                return true; // Include post
            });
            
            if ($filtered_posts) {
                echo '<select name="ingredient_posts[]" id="ingredient_posts" class="mt-1 block w-full p-2 border border-input rounded-md bg-background text-foreground" required>';
                echo '<option value="">' . esc_html__('Select Ingredient', 'crg') . '</option>';
                
                $seen_titles = array(); // Array to store seen post titles
            
                foreach ($filtered_posts as $post) {
                    $translated_post_id = apply_filters('wpml_object_id', $post->ID, 'ingredient', true);
                    $translated_post = get_post($translated_post_id);
            
                    // Use the translated post title
                    $post_title = $translated_post->post_title;
            
                    // Check if the post title has already been added
                    if (!in_array($post_title, $seen_titles)) {
                        // Add the post title to the array of seen titles
                        $seen_titles[] = $post_title;
                    }
                }
            
                // Sort the titles alphabetically
                sort($seen_titles);
            
                // Output the sorted titles as options
                foreach ($seen_titles as $title) {
                    echo '<option value="' . esc_attr($title) . '">' . esc_html($title) . '</option>';
                }
            
                echo '</select>';
            } else {
                echo 'No posts found.';
            }
            ?>
			<label for="recipe-idea" class="block text-sm font-medium text-foreground ctn"><?php esc_html_e('Enter Your Recipe Idea', 'crg'); ?></label>
        <textarea id="recipe-idea" name="recipe_idea" rows="6" class="mt-1 block w-full p-2 border border-input rounded-md bg-background text-foreground ctn" placeholder="<?php esc_html_e('Free description of your recipe idea. Example: Buckwheat with chicken. Add tomatoes, basil... or Round Rice and Mango Dessert...', 'crg') ?>"></textarea>
      </div>
    <div class="flex-ctnwrp">	   
	   <div class="size-70 right_drpdwn descrption-box">       
		   <label for="ingredient" class="block text-sm font-medium text-foreground"><?php esc_html_e('Select Product', 'crg'); ?></label>
         <?php
            $terms = get_terms(array(
                'taxonomy' => 'ingredient_category',
                'hide_empty' => false,
            ));
            if (!empty($terms) && !is_wp_error($terms)) {
                echo '<select name="ingredient" id="ingredient" class="mt-1 block w-full p-2 border border-input rounded-md bg-background text-foreground" required>';
                echo '<option value="">'. esc_html__('Select Product', 'crg') .'</option>';
                foreach ($terms as $term) {
                    echo '<option value="' . esc_html($term->name) . '" data-id="'.esc_attr($term->term_id).'">' . esc_html($term->name) . '</option>';
                }
                echo '</select>';
            } else {
                echo 'No ingredients categories found.';
            }
            ?>
    </div>
      <div class="size-30 right-merge-box right_drpdwn">
        <div class="size-30 top-box">
         
        </div> 
        <div class="size-30 quantity_select lft_drpdwn">
            <label for="ingredient_posts" class="block text-sm font-medium text-foreground"><?php esc_html_e('Number of Servings', 'crg'); ?></label>
            <div class="input-group">
                <span class="input-group-btn">
                <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="" aria-label="minus quantity">
                <i class="fa fa-minus" aria-hidden="true"></i>
                </button>
                </span>
                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100" aria-label="quantity">
                <span class="input-group-btn">
                <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="" aria-label="plus quantity">
                <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
                </span>
            </div>
        </div>   
    </div>
        <div class="size-30 right_drpdwn cooking_tme">
            <label for="ingredient_posts" class="block text-sm font-medium text-foreground"><?php esc_html_e('Cooking Time', 'crg'); ?></label>
            <div style="padding-left: 0px !important;padding-top: 0px !important;display: flex; flex-direction: column; align-items: center; gap: 10px; flex: 1 1 0%;  outline: none; background-color: transparent; color: rgb(0, 0, 0); font-family: Inter, sans-serif; font-size: 14px; font-style: normal; letter-spacing: 0em; line-height: 1.5em; width: 100%; border: solid 1px rgb(112 112 112 / 41%);
    border-radius: 8px;
    padding: 20px 18px !important;">
                <input type="range" min="1" max="3" step="1" value="3" style="width: 100%; cursor: pointer;" id="cooking_time_sldr" aria-label="range">
                <div style="display: flex; justify-content: space-between; width: 100%; font-size: 10px;"><span><?php esc_html_e('10-20 min', 'crg'); ?></span><span><?php esc_html_e('20-40 min', 'crg'); ?></span><span><?php esc_html_e("doesn't matter", 'crg'); ?></span></div>
            </div>
        </div>
	</div>
   </div>
   <div class="box">
      <div class="size-70">
         <div class="mt-6 flex flex-col md:flex-row items-center justify-between btnsubmit">
            <button class="mt-4 md:mt-0 px-6 py-2 bg-primary text-primary-foreground rounded-md" type="submit"><?php esc_html_e('Create a recipe', 'crg'); ?>  <img src="<?php echo plugins_url( 'assets/images/whisk.png', dirname(__FILE__) ); ?>" alt="Loading..."></button>
         </div>
         <div class="mt-6 flex flex-col md:flex-row items-center justify-between btnreload" style="display: none;">
            <button class="mt-4 md:mt-0 px-6 py-2 bg-primary text-primary-foreground rounded-md" type="button"><?php esc_html_e('Generate a new recipe', 'crg'); ?>  <img src="<?php echo plugins_url( 'assets/images/whisk.png', dirname(__FILE__) ); ?>" alt="Loading..."></button>
         </div>
      </div>
   </div>
   <div id="recipe_overlay">
      <div class="cv-spinner">
         <img src="<?php echo plugins_url( 'assets/images/spin.svg', dirname(__FILE__) ); ?>" alt="Loading...">
      </div>
   </div>
</form>
<div id="response-container">
   <div class="recipe-post before-rsp-recipe" style="text-align:center;display:none;padding-top: 50px;">
      <img src="<?php echo plugins_url( 'assets/images/cooking.gif', dirname(__FILE__) ); ?>" alt="Recipe Image" style="max-width: 100%;width: 50%;">
      <br>
	   
		 <div id="bounc_container">
		  <div id="ball-1" class="circle_bonce"></div>
		  <div id="ball-2" class="circle_bonce"></div>
		  <div id="ball-3" class="circle_bonce"></div>
	   </div>
   </div>
   <div class="recipe-post before-rsp-recipe" style="text-align:center;display:none;padding-top: 50px;">
      <img src="<?php echo plugins_url( 'assets/images/cooking.gif', dirname(__FILE__) ); ?>" alt="Recipe Image" style="max-width: 100%;width: 50%;">
      <br>
      <div id="bounc_container">
		  <div id="ball-1" class="circle_bonce"></div>
		  <div id="ball-2" class="circle_bonce"></div>
		  <div id="ball-3" class="circle_bonce"></div>
	   </div>
   </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" integrity="sha512-DD6Lm09YDHzhW3K4eLJ9Y7sFrBwtCF+KuSWOLYFqKsZ6RX4ifCu9vWqM4R+Uy++aBWe6wD4csgQRzGKp5vP6tg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</div>