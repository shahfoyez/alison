<?php
function foy_custom_product_fields() {
    global $product;
    $allowed_products = array('522','568','648', '657');
    if(in_array($product->id, $allowed_products)  ){ ?>
        <style>
            .foy-suggestion-box {
                background: #ffffff;
                width: 93%;
                padding: 8px;
                border-radius: 8px;
                box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
                display: none;
                position: absolute;
                z-index: 600;
                max-width: 700px;
                margin-top: 45px;
            }
            .foy-course-list img {
                height: 30px;
                width: 45px;
                border-radius: 3px;
                margin-right: 10px;
            }
            .foy-course-list p{
                margin: 0px;
            }
            .foy-suggestion-box hr{
                margin-top: 10px !important;
                margin-bottom: 10px !important;
            }
            .foy-suggestion-box hr:last-child {
                display: none;
            }
            .spinner-border{ 
                display: none;
            }
            .spinner-border img {
                height: 30px;
                width: 30px;
                position: absolute;
                right: 6%;
                margin-top: 5px;
            }
            .foy-suggestion-box h3 {
                margin: 0px;
                font-size: 12px;
                padding: 5px;
            }
            .foy-course-list {
                align-items: center;
                display: flex;
                justify-content: start;
            }
            .foy-searchform{
                display: flex;
            }
            .foy-hide{
                display: none !important;
            }
            .foy-show{
                display: block !important;
            }
            .foy-searchform input.s {
                padding: 10px;
                width: 100%;
                border-radius: 5px;
            }
        </style>
        <div class="product-custom-fields">
            <label for="field1">Course 01 </label>
            <div class="searchform foy-searchform">
                <input type="text" class="s" id="field1" name="custom_input_1" placeholder="Search courses..." value="" autocomplete="off" onkeyup="foyFunction1()">
                <input type="text" class="s" id="course_id_1" name="course_id_1" placeholder="Id" value="" hidden>
                <div id="foy-loading1" class="spinner-border" role="status">
                    <img src="https://project12.wpengine.com/wp-content/uploads/2023/01/1494.gif">
                </div>
                <div class="foy-suggestion-box" id="foy-suggestion-box1">
                    <!-- course suggestion -->
                </div>
            </div>
            <script type="text/javascript">
                function foyFunction1(){
                    jQuery('.foy-suggestion-box').css( 'display', 'none' );
                    jQuery('#foy-loading1').css( 'display', 'block' );
                    var keyword = jQuery('#field1').val();
                    if(keyword.length < 3){
                        jQuery('#foy-suggestion-box1').html("");
                        jQuery('#foy-suggestion-box1').css( 'display', 'none' );
                        jQuery('#foy-loading1').css( 'display', 'none' );
                    } else {
                        jQuery.ajax({
                            url: ajaxurl,
                            type: 'get',
                            data: { 
                                action: 'data_fetch', 
                                keyword: keyword  
                            },
                            success: function(data) { 
                                jQuery('#foy-suggestion-box1').html( data );
                                jQuery('#foy-suggestion-box1').css( 'display', 'block' );
                                jQuery('#foy-loading1').css( 'display', 'none' );
                            }         
                        });
                    }
                } 
            </script>
            <!-- Input 2 -->
            <label for="field2">Course 02</label>
            <div class="searchform foy-searchform">
                <input type="text" class="s" id="field2" name="custom_input_2" placeholder="Search courses..." value="" autocomplete="off" onkeyup="foyFunction2()">
                <input type="text" class="s" id="course_id_2" name="course_id_2" placeholder="Id" value="" hidden>
                <div id="foy-loading2" class="spinner-border" role="status">
                    <img src="https://project12.wpengine.com/wp-content/uploads/2023/01/1494.gif">
                </div>
                <div class="foy-suggestion-box" id="foy-suggestion-box2">
                    <!-- course suggestion -->
                </div>
            </div>
            <script type="text/javascript">
                function foyFunction2(){
                    jQuery('.foy-suggestion-box').css( 'display', 'none' );
                    jQuery('#foy-loading2').css( 'display', 'block' );
                    var keyword = jQuery('#field2').val();
                    if(keyword.length < 3){
                        jQuery('#foy-suggestion-box2').html("");
                        jQuery('#foy-suggestion-box2').css( 'display', 'none' );
                        jQuery('#foy-loading2').css( 'display', 'none' );
                    } else {
                        jQuery.ajax({
                            url: ajaxurl,
                            type: 'get',
                            data: { 
                                action: 'data_fetch', 
                                keyword: keyword  
                            },
                            success: function(data) { 
                                jQuery('#foy-suggestion-box2').html( data );
                                jQuery('#foy-suggestion-box2').css( 'display', 'block' );
                                jQuery('#foy-loading2').css( 'display', 'none' );
                            }         
                        });
                    }
                }
            </script>
            <!-- Input 3 -->
            <label for="field3">Course 03</label>
            <div class="searchform foy-searchform">
                <input type="text" class="s" id="field3" name="custom_input_3" placeholder="Search courses..." value="" autocomplete="off" onkeyup="foyFunction3()">
                <input type="text" class="s" id="course_id_3" name="course_id_3" placeholder="Id" value="" hidden>

                <div id="foy-loading3" class="spinner-border" role="status">
                    <img src="https://project12.wpengine.com/wp-content/uploads/2023/01/1494.gif">
                </div>
                <div class="foy-suggestion-box" id="foy-suggestion-box3">
                    <!-- course suggestion -->
                </div>
            </div>
            <script type="text/javascript">
                function foyFunction3(){
                    jQuery('.foy-suggestion-box').css( 'display', 'none' );
                    jQuery('#foy-loading3').css( 'display', 'block' );
                    var keyword = jQuery('#field3').val();
                    if(keyword.length < 3){
                        jQuery('#foy-suggestion-box3').html("");
                        jQuery('#foy-suggestion-box3').css( 'display', 'none' );
                        jQuery('#foy-loading3').css( 'display', 'none' );
                    } else {
                        jQuery.ajax({
                            url: ajaxurl,
                            type: 'get',
                            data: { 
                                action: 'data_fetch', 
                                keyword: keyword  
                            },
                            success: function(data) { 
                                jQuery('#foy-suggestion-box3').html( data );
                                jQuery('#foy-suggestion-box3').css( 'display', 'block' );
                                jQuery('#foy-loading3').css( 'display', 'none' );
                            }         
                        });
                    }
                }
            </script>
            <!-- Input 4 -->
            <?php 
                $bundle_4 = array('657', '648');
                if(in_array($product->id, $bundle_4)){ ?>
                <label for="field4">Course 04</label>
                <div class="searchform foy-searchform">
                    <input type="text" class="s" id="field4" name="custom_input_4" placeholder="Search courses..." value="" autocomplete="off" onkeyup="foyFunction4()">
                    <input type="text" class="s" id="course_id_4" name="course_id_4" placeholder="Id" value="" hidden>

                    <div id="foy-loading4" class="spinner-border" role="status">
                        <img src="https://project12.wpengine.com/wp-content/uploads/2023/01/1494.gif">
                    </div>
                    <div class="foy-suggestion-box" id="foy-suggestion-box4">
                        <!-- course suggestion -->
                    </div>
                </div>
                <script type="text/javascript">
                    function foyFunction4(){
                        jQuery('.foy-suggestion-box').css( 'display', 'none' );
                        jQuery('#foy-loading4').css( 'display', 'block' );
                        var keyword = jQuery('#field4').val();
                        if(keyword.length < 3){
                            jQuery('#foy-suggestion-box4').html("");
                            jQuery('#foy-suggestion-box4').css( 'display', 'none' );
                            jQuery('#foy-loading4').css( 'display', 'none' );
                        } else {
                            jQuery.ajax({
                                url: ajaxurl,
                                type: 'get',
                                data: { 
                                    action: 'data_fetch', 
                                    keyword: keyword  
                                },
                                success: function(data) { 
                                    jQuery('#foy-suggestion-box4').html( data );
                                    jQuery('#foy-suggestion-box4').css( 'display', 'block' );
                                    jQuery('#foy-loading4').css( 'display', 'none' );
                                }         
                            });
                        }
                    }
                </script>

            <?php }?>
            <!-- Input 5 -->
            <?php 
                $bundle_5 = array('648');
                if(in_array($product->id, $bundle_5)){ ?>
                    <label for="field5">Course 05</label>
                    <div class="searchform foy-searchform">
                        <input type="text" class="s" id="field5" name="custom_input_5" placeholder="Search courses..." value="" autocomplete="off" onkeyup="foyFunction5(this)">
                        <input type="text" class="s" id="course_id_5" name="course_id_5" placeholder="Id" value="" hidden>

                        <div id="foy-loading5" class="spinner-border" role="status">
                            <img src="https://project12.wpengine.com/wp-content/uploads/2023/01/1494.gif">
                        </div>
                        <div class="foy-suggestion-box" id="foy-suggestion-box5">
                            <!-- course suggestion -->
                        </div>
                    </div>
                    <script type="text/javascript">
                        function foyFunction5(){
                            jQuery('.foy-suggestion-box').css( 'display', 'none' );
                            jQuery('#foy-loading5').css( 'display', 'block' );
                            var keyword = jQuery('#field5').val();
                            if(keyword.length < 3){
                                jQuery('#foy-suggestion-box5').html("");
                                jQuery('#foy-suggestion-box5').css( 'display', 'none' );
                                jQuery('#foy-loading5').css( 'display', 'none' );
                            } else {
                                jQuery.ajax({
                                    url: ajaxurl,
                                    type: 'get',
                                    data: { 
                                        action: 'data_fetch', 
                                        keyword: keyword  
                                    },
                                    success: function(data) { 
                                        jQuery('#foy-suggestion-box5').html( data );
                                        jQuery('#foy-suggestion-box5').css( 'display', 'block' );
                                        jQuery('#foy-loading5').css( 'display', 'none' );
                                    }         
                                });
                            }
                        }
                    </script>
            <?php }?>

            <script>
                function courseClicked(element){
                    var courseText = element.lastElementChild.innerText;
                    var courseId = element.lastElementChild.id;
                    var grandParent = element.parentElement.parentElement;
                    var inputField = grandParent.firstElementChild;
                    var secondInputField = grandParent.children[1];

                    inputField.value = courseText;
                    inputField.setAttribute("value", courseId);
                    inputField.setAttribute("data-attribute", courseId);

                    jQuery('.foy-suggestion-box').css( 'display', 'none' );
                    secondInputField.value = courseId;
                    console.log(secondInputField);
                    

                    // var suggestionBox = element.parentElement;
                    // suggestionBox.classList.add("foy-hide");
                }
            </script>
            <!-- <script type="text/javascript">
                function foyFunction6(element){
                    var parent = element.parentElement;
                    var loading = parent.children[2].id; 
                    var suggestionBox = parent.children[3].id;
                   
                    

                    jQuery('.'+suggestionBox).css( 'display', 'none' );
                    jQuery('#'+loading).css( 'display', 'block' );
                    var keyword = jQuery('#field5').val();
                    if(keyword.length < 3){
                        
                        jQuery('#'+suggestionBox).html("");
                        jQuery('#'+suggestionBox).css( 'display', 'none' );
                        jQuery('#'+loading).css( 'display', 'none' );
                    } else {
                        jQuery.ajax({
                            url: ajaxurl,
                            type: 'get',
                            data: { 
                                action: 'data_fetch', 
                                keyword: keyword  
                            },
                            success: function(data) { 
                                jQuery('#'+suggestionBox).html( data );
                                jQuery('#'+suggestionBox).css( 'display', 'block' );
                                jQuery('#'+loading).css( 'display', 'none' );
                            }         
                        });
                    }
                }
            </script> -->
        </div>
    <?php }
}
add_action( 'woocommerce_before_add_to_cart_button', 'foy_custom_product_fields' );

// save input fields
function foy_save_custom_fields_data( $cart_item_data, $product_id ) {
    for ($i = 1; $i <= 5; $i++) {
        $custom_input = "custom_input_$i";
        $course_id = "course_id_$i";
        if( isset( $_POST[$custom_input] ) ) {
            $cart_item_data[$custom_input] = $_POST[$custom_input] ?? NULL;
            $cart_item_data[$course_id] =  $_POST[$course_id] ?? NULL;
        }
    }
    return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'foy_save_custom_fields_data', 10, 2 );

// display the custom input field values on the cart and checkout pages
function display_custom_cart_item_data($item_data, $cart_item)
{
    // Check if the custom input field values are set
    for ($i = 1; $i <= 5; $i++) {
        $custom_input = "custom_input_$i";
        if (isset($cart_item[$custom_input])) {
            $item_data[] = array(
                'key' => "Course $i",
                'value' => $cart_item[$custom_input] ?? Null
            );
        }
    }
    return $item_data;
}
add_filter('woocommerce_get_item_data', 'display_custom_cart_item_data', 10, 2);
// saving the custom input fields value to order item meta
function save_custom_order_item_meta($item_id, $values)
{
    for ($i = 1; $i <= 5; $i++) {
        $custom_input = "custom_input_$i";
        $course_id = "course_id_$i";
        if (isset($values[$custom_input])) {
            wc_add_order_item_meta($item_id, "Course_$i", $values[$custom_input] ?? NULL);
            wc_add_order_item_meta($item_id, "id_$i", $values[$course_id] ?? NULL);
        }
    }
}
add_action('woocommerce_add_order_item_meta', 'save_custom_order_item_meta', 10, 2);

// Search Suggestion
function data_fetch()
{
	$keyword = $_REQUEST['keyword'];
	function title_filter($where, &$wp_query)
	{
		global $wpdb;
		if ($search_term = $wp_query->get('search_prod_title')) {
			$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql($wpdb->esc_like($search_term)) . '%\'';
		}
		return $where;
	}
	$args = array(
		'post_status' => 'publish',
		'post_type' => 'course',
		'orderby'   => 'meta_value_num',
		// 1. define a custom query variable here to pass your term through
		'search_prod_title' => $keyword,
		'meta_query' => array(
			array(
				// 'key' => 'average_rating',
				'key' => 'vibe_students',
			),
			array(
				'key' => 'vibe_product',
				'value'   => array(''),
				'compare' => 'NOT IN'
			)
		),
		'order' => 'DESC',
		'posts_per_page' => 10,
	);
	add_filter('posts_where', 'title_filter', 10, 2);
	$the_query = new WP_Query($args);
	remove_filter('posts_where', 'title_filter', 10);

	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) : $the_query->the_post();
			$meta = get_post_meta(get_the_ID());
			$product_meta = get_post_meta(get_the_ID(), 'vibe_students', true);
	?>
			<div class="foy-course-list" onclick="courseClicked(this)">
				<?php
                    $default =  get_theme_file_uri('/assets/images/defaultCourse.png');
                    $image_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                    $img_url = $image_url ? $image_url : $default;
				?>
				<img src="<?php echo $img_url; ?>">
				<p id="<?php echo get_the_ID()?>"><?php the_title(); ?></p>
			</div>
			<hr>
	<?php endwhile;
		wp_reset_postdata();
	} else {
		echo '<h3>No Results Found</h3>';
	}
	die();
}
add_action('wp_ajax_data_fetch', 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch', 'data_fetch');