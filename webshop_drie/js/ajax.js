
//=============================================================================
// Author   : M@nKind - Geert Weggemans 
// Date     : 13-01-2016
// Project  : Ajax
// Goal     : Check difference in PHP Server vars in AJAX vs PAGE request
//=============================================================================
$(document).ready(function(){
    $(".RatingArea").on("click", "button", function(e) 
    {
			let _this = $(this);
			let item_id = $(this).attr('data-gt-item-id');
			let rating = $('input#rating_' + item_id).val();
			let action = 'rate';
			
            $.ajax({ 
                type    : 'POST',     
                cache   : false,
                url     : 'index.php',
				data: {rating: rating, item_id: item_id, action: action},
                success : function(html) 
                {
					_this.parent().hide();
					$('#item_rating_' + item_id).html(html);
                }
                });
    });    
	
	$(".AddToCartButton").on("click", "button", function(e) 
    {
			let _this = $(this);
			let item_id = $(this).attr('data-gt-item-id');
			let action = 'add_to_cart';
			
            $.ajax({ 
                type    : 'POST',     
                cache   : false,
                url     : 'index.php',
				data: {item_id: item_id, action: action},
                success : function(html) 
                {
                }
                });
    });   
});
//============================================================================= 
