jQuery(document).ready(function($) {
	$('#ingredient').on('change', function() {
    var categoryId = $(this).find('option:selected').val();
    var currentValue = $('#recipe-idea').val();
		$('#ingredient option').each(function() {
			var optionValue = $(this).val();
			if (optionValue) {
				var regex = new RegExp(localizedStrings.dishBasisText+ ' ' + optionValue + ' ', "g");
				currentValue = currentValue.replace(regex, '');
			}
		});
    $('#recipe-idea').val(localizedStrings.dishBasisText + ' ' + categoryId  + ' ' + currentValue);
});

});
document.addEventListener('DOMContentLoaded', function() {
	var selectElement = document.getElementById('ingredient_posts');
	var textareaElement = document.getElementById('recipe-idea');
	selectElement.addEventListener('change', function() {
		var selectedValue = selectElement.value;
		var currentText = textareaElement.value;
		if (selectedValue) {
			textareaElement.value = currentText ? currentText + ', ' + selectedValue : selectedValue;
		}
	});
});
jQuery(document).ready(function($) {
	$('.cstm_recp_frm').on('submit', function(e) {
		// 		jQuery("#recipe_overlay").fadeIn(300);
		jQuery(".before-rsp-recipe").fadeIn(300);
		jQuery('.cstm_recp_frm .btnsubmit button').attr('disabled', true);
		
		/* Below code add code on 02-09-2024 */
		jQuery('#basis').attr('disabled', true);
		jQuery('#ingredient').attr('disabled', true);
		jQuery('#recipe-idea').attr('disabled', true);
		jQuery('#cooking_time_sldr').attr('disabled', true);
		jQuery('#ingredient_posts').attr('disabled', true);
		jQuery('.btn-number').attr('disabled', true);
		jQuery('#quantity').attr('disabled', true);
		/* Upper code add code on 02-09-2024 */
		
		e.preventDefault(); 
		var recipe = $('#basis').val();
		var product = $('#ingredient').val();
		var productcategoryId = $('#ingredient').find('option:selected').attr('data-id');
		var recipeIdea = $('#recipe-idea').val();
		var ingredient = $('#ingredient_posts').val();
		var quantity = $('#quantity').val();
		var cookingtimeval = $('#cooking_time_sldr').val();
 
		if(cookingtimeval == '1'){
			var cookingtime = localizedStrings.tenmin;
		}else if(cookingtimeval == '2'){
			var cookingtime = localizedStrings.fourtymin;
		}else if(cookingtimeval == '3'){
			var cookingtime = localizedStrings.doesntmatter;
		}
		$.ajax({
			type: 'POST',
			url: ajax_object.ajax_url,
			data: {
				action: 'submit_recipe',
				recipe: recipe,
				product: localizedStrings.createpea+' '+product,
				recipe_idea: recipeIdea,
				ingredient:ingredient,
				quantity:quantity,
				cookingtime:cookingtime,
				productcategoryId : productcategoryId
			},
			success: function(response) {
			    /* Below code add code on 02-09-2024 */
			    jQuery('.cstm_recp_frm .btnsubmit').hide();
			    jQuery('.cstm_recp_frm .btnreload').show();
			    /* Upper code add code on 02-09-2024 */
		
				console.log(response);
				setTimeout(function(){
					// 			jQuery("#recipe_overlay").fadeOut(300);
					jQuery('.cstm_recp_frm .btnsubmit button').attr('disabled', true);
					jQuery(".before-rsp-recipe").fadeOut(300);
				},500);
				try {
					if (typeof response === 'string') {
						response = JSON.parse(response);
					}
					if (response.success) {
						var htmlContent = '';

						response.posts.forEach(function(post) {
							var imageUrl = post.image_url;
							var content = post.content;
							var postId = post.post_id;

							var tempDiv = $('<div>').html(content);

							var overviewText = tempDiv.find('.overview').text();

							var limitedContent = overviewText.split(' ').slice(0, 25).join(' ') + '...';

							// Create the HTML structure for each post
							htmlContent += '<div class="recipe-post">';
							if (imageUrl && imageUrl !== 'Error generating image.') {
								htmlContent += '<div class="cstm_recp_img"><img src="' + imageUrl + '" alt="Recipe Image" style="max-width: 100%;"></div>';
							}
							htmlContent += '<div class="recipe-title">'+ localizedStrings.recipetext +' '+product+' '+ recipe + '</div>';
							htmlContent += '<div class="recipe-content">' + limitedContent + '</div>';
							htmlContent += '<a target="_blank" href="/?p=' + postId + '" class="read-more-button">See recipe</a>';
							htmlContent += '</div>';
						});

						// Display the content in the response container
						$('#response-container').html(htmlContent);
					} else {
						setTimeout(function(){
							jQuery("#recipe_overlay").fadeOut(300);
						},500);
						console.error('Unexpected response format:', response);
				        // $('#response-container').html('<p>Error: ' + response.message + '</p>');
				        
				        var errorMessage = "Sorry, there’s a problem with our server right now. We’re working to fix it as quickly as possible. Please try again later, and thank you for your patience.";
				        $('#response-container').html('<div class="error-container"><div class="error-icon">🚫</div><div class="error-message">' + errorMessage + '</div></div>');
					}
				} catch (error) {
					setTimeout(function(){
						jQuery("#recipe_overlay").fadeOut(300);
					},500);
					
					
					console.error('Error parsing response:', error);
				    // $('#response-container').html('<p>Error parsing response</p>');
				    var errorMessage = "Sorry, there’s a problem with our server right now. We’re working to fix it as quickly as possible. Please try again later, and thank you for your patience.";
				    $('#response-container').html('<div class="error-container"><div class="error-icon">🚫</div><div class="error-message">' + errorMessage + '</div></div>');
				}
			},
			error: function(xhr, status, error) {
				// console.log(xhr);
				// console.error('AJAX Error:', error);
				
                // Customize your error message here
                var errorMessage = "Sorry, there’s a problem with our server right now. We’re working to fix it as quickly as possible. Please try again later, and thank you for your patience.";
                
                // You can check for specific status codes
                if (xhr.status === 404) {
                    errorMessage = "We couldn’t find any recipes with the ingredients you’ve selected. It’s possible that these ingredients are not relevant for creating a recipe. Please try using different ingredients.";
                } else if (xhr.status === 500) {
                    errorMessage = "Sorry, we're having trouble loading the recipe at the moment. Please try refreshing the page or check back later. We appreciate your patience!";
                }

                // Display the error message
                $('#response-container').html('<div class="error-container"><div class="error-icon">🚫</div><div class="error-message">' + errorMessage + '</div></div>');
			}
		});
	});
});


jQuery(document).ready(function(){
	var quantitiy=0;
	jQuery('.quantity-right-plus').click(function(e){
		e.preventDefault();
		var quantity = parseInt(jQuery('#quantity').val());
		jQuery('#quantity').val(quantity + 1);
	});

	jQuery('.quantity-left-minus').click(function(e){
		e.preventDefault();
		var quantity = parseInt(jQuery('#quantity').val());
		if(quantity>1){
			jQuery('#quantity').val(quantity - 1);
		}
	});
});

jQuery(document).on('click', '.cstm_recp_frm .btnreload button', function(){
    location.reload();
});
