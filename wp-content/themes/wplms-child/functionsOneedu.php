<?php
if (!defined('VIBE_URL'))
    define('VIBE_URL', get_template_directory_uri());

//Added by Sakib
include_once 'sakib/sakib-real-time-voucher-code.php';
include_once 'sakib/sakib-reed-api-automation.php';
include_once 'sakib/sakib-instructor-page.php';
include_once 'sakib/feature.php';
include_once 'sakib/st-rec.php';
include_once 'sakib/sa-mb.php';
include_once 'sakib/bundle-courses/bundle-courses.php';

include_once 'includes/api/get_course_progress.php';


//Single page assets 
function oneedu_learning_css()
{
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('single', get_theme_file_uri('/css/singleCourse.css'), false, '1.16', 'all');
    wp_enqueue_style('all-course-css', get_theme_file_uri('/css/all-course.css'), false, time(), 'all');
    wp_enqueue_script('script', get_theme_file_uri('/js/mycustom.js'), array('jquery'), 1.1, true);

    //if ( get_page_template_slug() ==  'gift-card-test-sa' ) {
    if (is_page(609182)) {
        wp_enqueue_script('gift-card-js', get_theme_file_uri('/js/gift-card.js'), array('jquery'), time(), true);
    }
    //}

    // Habib
    wp_enqueue_style('custom-blog-style', get_stylesheet_directory_uri() . '/assets/style/style.css', null, 1.1, 'all');
    //wp_enqueue_script('custom-blog-script', get_stylesheet_directory_uri().'/assets/js/custom-blog.js', 'jquery', 1.1, true);
}
add_action("wp_enqueue_scripts", "oneedu_learning_css",);




//Added by Sakib
add_action('wp_head', 'my_analytics', 20);
function my_analytics()
{
?>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WLXDHXZ');
    </script>
    <script src="https://www.googleoptimize.com/optimize.js?id=OPT-K6CTGNP"></script>
    <!-- End Google Tag Manager -->
    <meta name="facebook-domain-verification" content="ly5o65z54husiac503c4029bhh1yfw" />


    <!-- Start of oneeducationsupport Zendesk Widget script -->
    <!-- <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=f536baba-7141-46ab-b57e-5851abb0e5a3"> </script> -->
    <!-- End of oneeducationsupport Zendesk Widget script -->
    <!-- <script type="text/javascript">
        zE('webWidget', 'helpCenter:setSuggestions', { search: 'certificate' });
        </script> -->

    <!-- Hotjar Tracking Code for www.oneeducation.org.uk -->
    <!-- <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:1701642,hjsv:6};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script> -->

    <?php
    //Sakib
    if (is_user_logged_in()) {
        echo "<script language='javascript'>
                var user_id1 = " . get_current_user_id() . ";
			</script>";
    ?>
        <script>
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                'userId': user_id1
            });
        </script>

        <script>
            function waitForFbq(callback) {
                if (typeof fbq !== 'undefined') {
                    callback()
                } else {
                    setTimeout(function() {
                        waitForFbq(callback)
                    }, 2000)
                }
            };
            waitForFbq(function() {
                gtag('set', {
                    'user_id': user_id1
                });
            });
        </script>

    <?php
    }
    ?>

<?php
}

add_action('__before_header', 'tag_manager2', 20);
function tag_manager2()
{    ?>
    <!-- Google Tag Manager (noscript) -->
    <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WLXDHXZ"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
    <!-- End Google Tag Manager (noscript) -->
<?php
}

function custom_content_after_body_open_tag()
{
?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WLXDHXZ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php

}
add_action('after_body_open_tag', 'custom_content_after_body_open_tag');
//End


//Sakib

// add_filter( 'woocommerce_cart_item_price', 'sa_bbloomer_change_cart_table_price_display', 30, 3 );

// function sa_bbloomer_change_cart_table_price_display( $price, $values, $cart_item_key ) {
//    $slashed_price = $values['data']->get_price_html();
//    $is_on_sale = $values['data']->is_on_sale();
//    if ( $is_on_sale ) {
//       $price = $slashed_price;
//    }
//    return $price;
// }

// Copy from below here.

function show_regularsale_price_at_cart($old_display, $cart_item, $cart_item_key)
{
    $product = $cart_item['data'];
    if ($product) {
        return $product->get_price_html();
    }
    return $old_display;
}
add_filter('woocommerce_cart_item_price', 'show_regularsale_price_at_cart', 10, 3);






global $wp;
$url =  home_url($wp->request) . add_query_arg($wp->query_vars);
if (strpos($url, "hot-deals") !== false) {
    $url;
    session_start();
    $_SESSION["business_product"] = 'business-team-offer';
} else {
    //unset($_SESSION["business_product"]);
}


//if(!isset($_SESSION["business_product"])){
//if (strpos($url, "hot-deals")!==true){


/**
 * Automatically add product to cart on visit
 */

add_action('woocommerce_add_to_cart', 'add_product_to_cart', 10, 10);
function add_product_to_cart()
{
    if (!is_admin()  && !is_cart() && !is_checkout()) {
        $product_id = 263654; //replace with your own product id

        $excloud_product = 380978;
        $excloud_product1 = 446740;
        $excloud_product2 = 379377;
        $ex1 = 436121;
        $ex2 = 436122;
        $ex3 = 436123;
        $ex4 = 436124;
        $ex5 = 436125;
        $ex6 = 436126;
        $ex7 = 436127;
        $ex8 = 491822;


        $found = false;
        $items_count = 0;
        //check if product already in cart
        if (sizeof(WC()->cart->get_cart()) > 0) {
            foreach (WC()->cart->get_cart() as $cart_item_key => $values) {
                $_product = $values['data'];


                // if($_product->get_id() === 446740){
                // 	$bundle = true;
                // 	$items_count = 4;
                // }

                if ($_product->get_id() == $product_id  || $_product->get_id() == $excloud_product || $_product->get_id() == $excloud_product2 || $_product->get_id() == $ex1 || $_product->get_id() == $ex2 || $_product->get_id() == $ex3 || $_product->get_id() == $ex4 || $_product->get_id() == $ex5 || $_product->get_id() == $ex6 || $_product->get_id() == $ex7) {
                    $product_key = $cart_item_key;
                    $product_qty = $cart_item['quantity'];
                    $found = true;
                } else {
                    $items_count++;
                }

                /* $product_category_id 	= 55653; // cricket bat category id
                    $product_cats_ids 	= wc_get_product_term_ids( $_product->get_id(), 'product_cat' );
                    if(in_array( $product_category_id, $product_cats_ids ) ){
                        return;
                    } */

                //Product category ->  Exclude Cross Sell = 57836
                $product_category_id = 57836; // 
                $product_cats_ids     = wc_get_product_term_ids($_product->get_id(), 'product_cat');
                if (in_array($product_category_id, $product_cats_ids)) {
                    $no_offer_item = 1;
                    $items_count = $items_count - $no_offer_item;
                    //return;
                }
            }
            // if product not found, add it
            if (!$found) {
                WC()->cart->add_to_cart($product_id, $items_count);
            } else {
                WC()->cart->set_quantity($product_key, $items_count);
            }
        } else {
            // if no products in cart, add it
            WC()->cart->add_to_cart($product_id);
        }
    }
}

/* }else{
    //echo "session set";
} */


add_action('template_redirect', 'pdf_remove_for_hotUKDeals_page');
function pdf_remove_for_hotUKDeals_page()
{
    if (is_admin()) return;
    $GET_product_id = $_GET['remove_item'];
    if (isset($_GET['remove_item']) && $_GET['remove_item'] == '263654') {
        $product_id = $_GET['remove_item'];
        $product_cart_id = WC()->cart->generate_cart_id($product_id);
        $cart_item_key = WC()->cart->find_product_in_cart($product_cart_id);
        if ($cart_item_key) WC()->cart->remove_cart_item($cart_item_key);
    }
}



/* $offer_page = $_GET['offer'];
if (isset($_GET['offer']) && $_GET['offer'] == 'jsk') {
   // echo  $_GET['offer'];
    session_start();
	$_SESSION["business_product"]= 'business-team-offer';
    remove_action( 'woocommerce_add_to_cart', 'add_product_to_cart');

} */




add_action('template_redirect', 'remove_items_from_the_cart', 0);
function remove_items_from_the_cart()
{
    if (is_admin()) return;
    global $post;
    $post_id = $post->ID;
    if (531302 == $post_id) {
        $product_id = 263654;
        $product_cart_id = WC()->cart->generate_cart_id($product_id);
        $cart_item_key = WC()->cart->find_product_in_cart($product_cart_id);
        if ($cart_item_key) WC()->cart->remove_cart_item($cart_item_key);
    }
}





//Farhan
add_action('woocommerce_add_to_cart', 'check_product_cart_remove_product', 10, 6);
function check_product_cart_remove_product($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data)
{
    // Set HERE your targeted product ID
    $target_product_id_1 = 498558;
    $target_product_id_2 = 498468;
    $target_product_id_3 = 501156;
    $target_product_id_4 = 512336;
    $target_product_id_5 = 512308;
    $target_product_id_6 = 512226;
    $target_product_id_7 = 511953;
    $target_product_id_8 = 511949;
    $target_product_id_9 = 511870;
    $target_product_id_10 = 511798;
    $target_product_id_11 = 511541;

    // Set HERE the  product ID to remove
    $item_id_to_remove = 263654;
    // Initialising some variables
    $has_item = false;
    $is_product_id = false;
    foreach (WC()->cart->get_cart() as $key => $item) {
        // Check if the item to remove is in cart
        if ($item['product_id'] == $item_id_to_remove) {
            $has_item = true;
            $key_to_remove = $key;
        }
        // Check if we add to cart the targeted product ID
        if ($product_id == $target_product_id_1 || $product_id == $target_product_id_2 || $product_id  == $target_product_id_3 || $product_id  == $target_product_id_4 || $product_id  == $target_product_id_5 || $product_id  == $target_product_id_6 || $product_id  == $target_product_id_7 || $product_id  == $target_product_id_8 || $product_id  == $target_product_id_9 || $product_id  == $target_product_id_10 || $product_id  == $target_product_id_11) {
            $is_product_id = true;
        }
    }
    if ($has_item && $is_product_id) {
        //WC()->cart->remove_cart_item($key_to_remove);
        // Optionaly displaying a notice for the removed item:
    }
}




/*************************************************************************************/
/*
// Cart certificate and Id cart offer code by Sakib
/*
*************************************************************************************/
add_action('woocommerce_checkout_before_terms_and_conditions', 'custom_checkbox_checkout_field');
function custom_checkbox_checkout_field()
{
    $value = WC()->session->get('add_a_product');
    echo '

   
    
    
    
    <section class="cart-image-section">
        <div class="cart-inner">
            <h2>Special Gift For You!</h2>
            <h4>Personal Development Bundle (10 Courses)</h4>
            <p>Only for <span class="cart-inner-hone"><del>£2499</del> £19.99<?php echo  $price_subs; ?></span></p>

            <a class="">';
    woocommerce_form_field('cb_add_product', array(
        'type'          => 'checkbox',
        'label'         => 'Add this product to your order',
        'class'         => array('form-row-wide'),
    ), $value == 'yes' ? true : false);
    echo '
            </a>
            <ul>
                <li>Click \'Add This Product To Your Order\' to add this to your order now.</li>
                <li>This product sells on our website for £2499.99 and it\'s available for £19.99 for only once.</li>
                <li>This offer is NOT available at ANY other time or place.</li>
            </ul>
        </div>
    </section><br>';
}

// The jQuery Ajax request
add_action('wp_footer', 'checkout_custom_jquery_script');
function checkout_custom_jquery_script()
{
    // Only checkout page
    if (is_checkout() && !is_wc_endpoint_url()) :
        // Remove "ship_different" custom WC session on load
        if (WC()->session->get('add_a_product')) {
            WC()->session->__unset('add_a_product');
        }
        if (WC()->session->get('product_added_key')) {
            WC()->session->__unset('product_added_key');
        }
        // jQuery Ajax code
    ?>
        <script type="text/javascript">
            jQuery(function($) {
                if (typeof wc_checkout_params === 'undefined')
                    return false;

                $('form.checkout').on('change', '#cb_add_product', function() {
                    var value = $(this).prop('checked') === true ? 'yes' : 'no';

                    $.ajax({
                        type: 'POST',
                        url: wc_checkout_params.ajax_url,
                        data: {
                            'action': 'add_a_product',
                            'add_a_product': value,
                        },
                        success: function(result) {
                            $('body').trigger('update_checkout');
                            console.log(result);
                        }
                    });
                });
            });
        </script>
    <?php
    endif;
}

// The Wordpress Ajax PHP receiver
add_action('wp_ajax_add_a_product', 'checkout_ajax_add_a_product');
add_action('wp_ajax_nopriv_add_a_product', 'checkout_ajax_add_a_product');
function checkout_ajax_add_a_product()
{
    if (isset($_POST['add_a_product'])) {
        WC()->session->set('add_a_product', esc_attr($_POST['add_a_product']));
        echo $_POST['add_a_product'];
    }
    die();
}

// Add remove free product
add_action('woocommerce_before_calculate_totals', 'adding_removing_specific_product');
function adding_removing_specific_product($cart)
{
    if (is_admin() && !defined('DOING_AJAX'))
        return;

    if (did_action('woocommerce_before_calculate_totals') >= 2)
        return;

    // HERE the specific Product ID
    $product_id = 264097;

    if (WC()->session->get('add_a_product') == 'yes' && !WC()->session->get('product_added_key')) {
        $cart_item_key = $cart->add_to_cart($product_id);
        WC()->session->set('product_added_key', $cart_item_key);
    } elseif (WC()->session->get('add_a_product') == 'no' && WC()->session->get('product_added_key')) {
        $cart_item_key = WC()->session->get('product_added_key');
        $cart->remove_cart_item($cart_item_key);
        WC()->session->__unset('product_added_key');
    }

    if (WC()->cart->get_cart_contents_count() == 1) {
        $prod_to_remove = $product_id;
        // Cycle through each product in the cart
        foreach (WC()->cart->cart_contents as $prod_in_cart) {
            // Get the Variation or Product ID
            $prod_id = (isset($prod_in_cart['variation_id']) && $prod_in_cart['variation_id'] != 0) ? $prod_in_cart['variation_id'] : $prod_in_cart['product_id'];
            // Check to see if IDs match
            if ($prod_to_remove == $prod_id) {
                // Get it's unique ID within the Cart
                $prod_unique_id = WC()->cart->generate_cart_id($prod_id);
                // Remove it from the cart by un-setting it
                unset(WC()->cart->cart_contents[$prod_unique_id]);
            }
        }
    }
}
// END (Sakib)

// global $wpdb;

// $result = $wpdb->update(
//     'wp_voucher_details', //table
//     array('course_id' => 259990), //replace id
//     array('course_id' => 227332) //where (old id)
// );
// var_dump($result);

// add_action( 'template_redirect', 'subscription_redirect_post' );

// function subscription_redirect_post() {
//   $queried_post_type = get_query_var('course');
//   if ( is_single() ) {

// 	get_the_ID();
//     wp_redirect( pricingpageURL, 301 );
//     exit;
//   }
// }

//SAkib
/*
function sakib_magic_one() {
    $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $my_url = get_site_url().'/cart/?product';

    if (strpos($actual_link, $my_url) !== false) {

        if (isset($_GET['product1']) && $_GET['product1'] == 130900  OR $_GET['product1'] == 282022  OR $_GET['product1'] == 225471 ) {

            if ($_GET['product1'] != '' ) {
                WC()->cart->add_to_cart( $_GET['product1'] );
                $coupon_code = 'EDU15'; 
      
                if ( WC()->cart->has_discount( $coupon_code ) ) return;
            
                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            
                    // this is your product ID
                    $autocoupon = array($_GET['product1'] );
                
                    if ( in_array( $cart_item['product_id'], $autocoupon ) ) {   
                        WC()->cart->add_discount( $coupon_code );
                       // wc_print_notices();
                    }
                }
                $_GET['product1'] = '';
                unset( $_GET['product1']);
                header("Location: https://www.oneeducation.org.uk/cart/");

            }
            header("Location: https://www.oneeducation.org.uk/cart/");
        }
    }
}
add_action( 'template_redirect', 'sakib_magic_one', 8 );
*/


//SAkib
function sakib_chk_funtion()
{
    $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $my_url = get_site_url() . '/cart/?product';

    if (strpos($actual_link, $my_url) !== false) {
        // if (isset($_GET['product1']) && $_GET['product1'] == 130900  OR $_GET['product1'] == 282022  OR $_GET['product1'] == 225471 ) {
        if ($_GET['product1'] != '') {
            WC()->cart->add_to_cart($_GET['product1']);
            $coupon_code = 'ONEFREEGIFT';

            if (WC()->cart->has_discount($coupon_code)) return;

            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {

                // this is your product ID
                $autocoupon = array($_GET['product1']);

                if (in_array($cart_item['product_id'], $autocoupon)) {
                    WC()->cart->add_discount($coupon_code);
                    // wc_print_notices();
                }
            }
            $_GET['product1'] = '';
            unset($_GET['product1']);
            header("Location: https://www.oneeducation.org.uk/cart/");
        }

        header("Location: https://www.oneeducation.org.uk/cart/");
        // }
    }
}
add_action('template_redirect', 'sakib_chk_funtion', 8);

//Sakib
/*
add_action( 'woocommerce_thankyou', 'sa_rtk_mail');
function sa_rtk_mail( $order_id ) {
    if ( ! $order_id )
        return;

    $order = wc_get_order( $order_id );
	$items = $order->get_items();
	$user_email =  $order->get_billing_email();
	if ( $order->has_status('completed') ) {

		foreach ( $items as $item ) {
			 	$product_id = $item['product_id'];
				if ($product_id == 79931) {
                    //echo "<b>We will contact with you as soon.</b>";
                    $to = array(
                        //'info@johnacademy.co.uk',
                        //'sakib.ahmed.staffasia@gmail.com'
                        $user_email 
                    );
                    //$to       = 'sakib.ahmed.staffasia@gmail.com';
                    $subject  = 'Your Retake Request';
                    $body     = 'Dear Learner,<br>we have received your retake request. You will receive a confirmation once we have processed your order. Thank you for staying with us.<br><br>Regards<br>
                    <b>One Education</b>';
                    $headers  =  array('Content-Type: text/html; charset=UTF-8');
                    wp_mail( $to, $subject, $body, $headers );
				}
			}
	}  
}

*/

/*Sakib*/

$ppc = $_GET['our-offer'];
if (isset($_GET['our-offer'])) {
    $ppc = $_GET['our-offer'];
    if (!session_id())
        session_start();
    $_SESSION['cpncode'] =  $ppc;
} else {
    //	echo "not found";
    //unset($_SESSION["cpncode"]);
}

if (isset($_SESSION['cpncode']) && !empty($_SESSION['cpncode'])) {
    // echo 'Set and not empty, and no undefined index error!';
    function add_coupon_notice()
    {
        $cart_total = WC()->cart->get_subtotal();
        $minimum_amount = 5;
        $currency_code = get_woocommerce_currency();
        wc_clear_notices();
        if ($cart_total < $minimum_amount) {
            WC()->cart->remove_coupon($_SESSION['cpncode']);
            wc_print_notice("Get off if you spend more than $minimum_amount $currency_code!", 'notice');
        } else {
            WC()->cart->apply_coupon($_SESSION['cpncode']);
            wc_print_notice('Congratulations! Your coupon has been auto applied. Complete your purchase and start learning today.', 'notice');
        }
        wc_clear_notices();
    }
    add_action('woocommerce_before_cart', 'add_coupon_notice');
    add_action('woocommerce_before_checkout_form', 'add_coupon_notice');
} else {
    unset($_SESSION["cpncode"]);
}

//Sakib : Blog page 
function blog_banner_large($atts)
{
    // $img = $atts['img'];
    // $link = $atts['link'];
    $img = 'https://www.oneeducation.org.uk/wp-content/uploads/2020/11/OE-PPC-17.11-970x250-1.gif';
    $link = 'https://www.oneeducation.org.uk/cmc-offer/?our-offer=CMC27';
    $banner = "<a class='blog-offer-img' href='$link'> <img src='$img' alt='offer'></a> ";
    $banner = "";
    return $banner;
}
add_shortcode('blog-banner-large', 'blog_banner_large');

function blog_banner_small($atts)
{
    // $img = $atts['img'];
    // $link = $atts['link'];
    $img = 'https://www.oneeducation.org.uk/wp-content/uploads/2020/11/OE-PPC-17.11-728x90-1.gif';
    $link = 'https://www.oneeducation.org.uk/cmc-offer/?our-offer=CMC27';
    $banner = "<a class='blog-offer-img' href='$link'> <img src='$img' alt='offer'></a> ";
    $banner = "";
    return $banner;
}
add_shortcode('blog-banner-small', 'blog_banner_small');



function course_banner_small($atts)
{
    // $img = $atts['img'];
    // $link = $atts['link'];
    $img = 'https://www.oneeducation.org.uk/wp-content/uploads/2020/11/course-banner.jpg';
    //$link = 'https://www.oneeducation.org.uk/cmc-offer/?our-offer=CMC27';
    $banner = "<img class='blog-offer-img' src='$img' alt='offer'>";
    $banner = "";
    return $banner;
}
add_shortcode('course-banner-small', 'course_banner_small');



/*Added by Sakib*/
function wc_remove_checkout_fields($fields)
{

    // Billing fields
    unset($fields['billing']['billing_company']);
    //unset( $fields['billing']['billing_email'] );
    //unset( $fields['billing']['billing_phone'] );
    //unset( $fields['billing']['billing_state'] );
    //unset( $fields['billing']['billing_first_name'] );
    //unset( $fields['billing']['billing_last_name'] );
    //unset( $fields['billing']['billing_address_1'] );
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    //unset( $fields['billing']['billing_postcode'] );

    // Shipping fields
    unset($fields['shipping']['shipping_company']);
    unset($fields['shipping']['shipping_phone']);
    unset($fields['shipping']['shipping_state']);
    unset($fields['shipping']['shipping_first_name']);
    unset($fields['shipping']['shipping_last_name']);
    unset($fields['shipping']['shipping_address_1']);
    unset($fields['shipping']['shipping_address_2']);
    unset($fields['shipping']['shipping_city']);
    unset($fields['shipping']['shipping_postcode']);

    // Order fields
    //unset( $fields['order']['order_comments'] );

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'wc_remove_checkout_fields');

function property_slideshow($content)
{
    if (is_single() && 'course' == get_post_type()) {
        $custom_content = '<script src="https://widget.reviews.io/badge-ribbon/dist.js"></script>
		<div id="badge-ribbon"></div>
		<script>
			reviewsBadgeRibbon("badge-ribbon", {
				store: "one-education",
				size: "small",
			});
		</script>';
        $custom_content .= $content;
        return $custom_content;
    } else {
        return $content;
    }
}
add_filter('the_content', 'property_slideshow');



/*Payment*/
add_action('template_redirect', 'define_default_payment_gateway');
function define_default_payment_gateway()
{
    if (is_checkout() && !is_wc_endpoint_url()) {
        // HERE define the default payment gateway ID
        $default_payment_id = 'stripe';

        WC()->session->set('chosen_payment_method', $default_payment_id);
    }
}


/*=======================
    Added by Farhan
=======================**/
/*
* This is a Function off Dynamically add product by selected category
*/
/* add_action( 'woocommerce_add_to_cart', 'farhan_check_if_product_category_is_in_cart_page' );
function farhan_check_if_product_category_is_in_cart_page() {
    // Modified Loop
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        // Check if catagory ABC Awards - Level 1 exists
        if(check_category_is_exists($cart_item['product_id'], 53046)){
            add_product_to_cart_page(436121);
        }
        // Check if catagory ABC Awards - Level 2 exists
        if(check_category_is_exists($cart_item['product_id'], 53047)){
            add_product_to_cart_page(436122);
        }
        // Check if catagory ABC Awards - Level 3 exists
        if(check_category_is_exists($cart_item['product_id'], 53049)){
            add_product_to_cart_page(436123);
        }
        // Check if catagory ABC Awards - Level 4 exists
        if(check_category_is_exists($cart_item['product_id'], 53050)){
            add_product_to_cart_page(436124);
        }
        // Check if catagory ABC Awards - Level 5 exists
        if(check_category_is_exists($cart_item['product_id'], 53051)){
            add_product_to_cart_page(436125);
        }
        // Check if catagory ABC Awards - Level 6 exists
        if(check_category_is_exists($cart_item['product_id'], 53052)){
            add_product_to_cart_page(436126);
        }
        // Check if catagory ABC Awards - Level 7 exists
        if(check_category_is_exists($cart_item['product_id'], 53048)){
            add_product_to_cart_page(436127);
        }
    }
} */

// Check if a category exists in product
/* function check_category_is_exists($product_id, $category_id){
    return has_term( $category_id, 'product_cat', $product_id );
} */


// Add Product to Cart for specifice category 
/* function add_product_to_cart_page($product_id){
    $delete_product_id_here  = 263654;
    $found = false;
    $product_check = 380978;
    //check if product already in cart
    if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
        foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
            $_product = $values['data'];
            if ( $_product->get_id() == $product_id || $_product->get_id() == $product_check)
                $found = true;
        }
        // if product not found, add it
        if ( ! $found )
            WC()->cart->add_to_cart( $product_id );
    } 
    
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        if ( $cart_item['product_id'] == $delete_product_id_here ) {
               // WC()->cart->remove_cart_item( $cart_item_key );
        }
    }
} */

/*=======================
    Added by Sakib
=======================**/
function get_order_ids_by_coupon_and_date_range($coupon_code, $date_from, $date_to, $statuses = array())
{
    // Default order statuses set to 'processing' and 'completed'
    $statuses = empty($statuses) ? array('processing', 'completed') : $statuses;
    global $wpdb;
    return $wpdb->get_col($wpdb->prepare("
        SELECT p.ID
        FROM $wpdb->posts p
        INNER JOIN {$wpdb->prefix}woocommerce_order_items oi
            ON p.ID = oi.order_id
        WHERE p.post_type = 'shop_order'
            AND p.post_status IN ('wc-" . implode("','wc-", $statuses) . "')
            AND p.post_date BETWEEN '%s' AND '%s'
            AND oi.order_item_type = 'coupon'
            AND oi.order_item_name = '%s'
    ", $date_from, $date_to, sanitize_title($coupon_code)));
}


// Included by Zubo
include 'api.php';
include 'reed_data.php';



/*
if( is_user_logged_in() ) {
	$user = wp_get_current_user();
	$roles = ( array ) $user->roles;
	if (in_array("affiliate", $roles)){
		//var_dump($roles);
        global $post;
        global $wpdb;

        $id = get_the_ID();
        echo $page_id = get_queried_object_id();

        var_dump($id);
        var_dump($page_id);

        global $wp_query;
        echo $wp_query->post->ID;

		echo "<script>console.log('" . json_encode($roles) . "');</script>";
       // echo "<script>window.location.replace('https://www.oneeducation.org.uk/test001/')</script>";
	}
	//echo get_site_url('','/admin--');
}


function admin_default_page() {
	// if( is_user_logged_in() ) {
	// 	$user = wp_get_current_user();
	// 	$roles = ( array ) $user->roles;

    //     if (in_array("affiliate", $roles)){
    //         //var_dump($roles);
    //         echo "<script>console.log('" . json_encode($roles) . "');</script>";
    //         return 'https://www.oneeducation.org.uk/courses/';
    //     }	
	// }
    echo "<script>console.log('test code');</script>";
}
add_filter('login_redirect', 'admin_default_page');


// add_action('wp_head','redirect_admin');
// function redirect_admin(){
//   if(is_admin()){
//     wp_redirect(WP_HOME.'/news.php');
//     die; // You have to die here
//   }
// }

*/


/*Trustpilot Rating*/
add_filter('woocommerce_thankyou_order_received_text', 'woo_change_order_received_text', 10, 2);
function woo_change_order_received_text($str, $order)
{
    $new_str = 'Thank you. Your order has been received.<br>' . do_shortcode('[elementor-template id="444957"]');
    return $new_str;
}


/*
Sakib
*/
add_action('gform_after_submission_118', 'post_to_third_party', 10, 2);
function post_to_third_party($entry, $form)
{

    global $wpdb;
    global $post;
    echo $refer_name         = rgpost('input_1');
    echo $refer_email        = rgpost('input_2');
    echo $refered_name        = rgpost('input_4');
    echo $refered_email        = rgpost('input_5');

    $coupon_code = $refered_email;
    $amount = '89';
    $discount_type = 'percent';
    $customer_email = $refered_email;

    //$sqlContent = $content;
    // $sql="select * from {$wpdb->posts} where (post_title='{$sqlContent}' or post_name='{$sqlContent}' ) and post_type='shop_coupon' and post_status='publish' limit 0,1";
    // $my_posts = $wpdb->get_results($sql);
    // var_dump($my_posts);

    $coupon = array(
        'post_title'     => $coupon_code,
        'post_content'     => '',
        'post_status'     => 'publish',
        'post_author'     => 1,
        'post_type'        => 'shop_coupon'
    );
    $new_coupon_id = wp_insert_post($coupon);

    // Add meta
    update_post_meta($new_coupon_id, 'discount_type', $discount_type);
    update_post_meta($new_coupon_id, 'coupon_amount', $amount);
    update_post_meta($new_coupon_id, 'individual_use', 'yes');
    update_post_meta($new_coupon_id, 'product_ids', '');
    update_post_meta($new_coupon_id, 'usage_limit', 1);
    update_post_meta($new_coupon_id, 'expiry_date', '');
    update_post_meta($new_coupon_id, 'apply_before_tax', 'yes');
    update_post_meta($new_coupon_id, 'free_shipping', 'no');
    update_post_meta($new_coupon_id, 'customer_email', array($customer_email));
    update_post_meta($new_coupon_id, 'exclude_product_ids', '262240,236794,227885,227883,250740,232309,291778,287234,327295,262423,286162,83257,325651,325445,269212,281028,293621,264097,357361,317102,293608,293606,293607,330614,297739,79931,251621,292026,269407,237876,268381,287518');
    update_post_meta($new_coupon_id, 'exclude_product_categories', array(38355));
    update_post_meta($new_coupon_id, 'usage_limit_per_user', 1);


    $to           = $refered_email;
    $subject      = 'OneEducation Refer a Rriend Request';
    $body         = 'Your Coupon code is: <b>' . $refered_email . '</b>';
    $headers  =  array('Content-Type: text/html; charset=UTF-8');
    wp_mail($to, $subject, $body, $headers);


    $to           = $refer_email;
    $subject      = 'OneEducation Refer a Friend Request Sent Successfully';
    $body         = 'Request sent';
    $headers  =  array('Content-Type: text/html; charset=UTF-8');
    wp_mail($to, $subject, $body, $headers);
}


//Sakib
/*Ajax update cart*/
/*
add_action( 'wp_footer', 'cart_update_qty_script' ); 
function cart_update_qty_script() { 
    if (is_cart()) : 
    ?> 
    <script>
    jQuery( 'div.woocommerce' ).on( 'change', '.qty', function () {
    jQuery( "[name='update_cart']" ).trigger( "click" );
    } );
    </script>
    <?php 
    endif; 
}
*/

//Sakib
function replace_search($query_object)
{
    if ($query_object->is_search()) {
        $search_query = $query_object->query['s'];
        $current_user = wp_get_current_user();
        $user_email =  $current_user->user_email;
        $date_time = current_time('Y-m-d H:i:s');
        global $wpdb;
        $date_user     = "countries";
        $id         = $_POST["id"];
        $table_name = 'search_result';
        $result     = $wpdb->insert(
            $table_name,
            array('search_query' => $search_query, 'date_time' => $date_time, 'user_email' => $user_email)
        );
    }
}
add_action('parse_query', 'replace_search');



//Sakib
function wcs_exclude_category_search($query)
{
    $user = wp_get_current_user();
    $user->roles[0];
    if (!is_admin() or !is_user_logged_in() or $user->roles[0] === 'student') {
        if ($query->is_search) {
            $query->set('post_type', array('course'));
            $tax_query = array(
                array(
                    'taxonomy' => 'course-cat',
                    'field'   => 'ID',
                    'terms'   => 54300,
                    'operator' => 'NOT IN',
                ),
            );
            $query->set('meta_key', 'vibe_students');
            $query->set('orderby', 'meta_value_num');
            $query->set('order', 'DSEC');
            $query->set('posts_per_page', 16);
            $query->set('tax_query', $tax_query);
        }

        return $query;
    } else {
        return $query;
    }
}
add_action('pre_get_posts', 'wcs_exclude_category_search', 1);



function ni_search_by_title_only($search, $wp_query)
{
    global $wpdb;
    if (empty($search))
        return $search;
    $q = $wp_query->query_vars;
    $n = !empty($q['exact']) ? '' : '%';
    $search =
        $searchand = '';
    foreach ((array) $q['search_terms'] as $term) {
        $term = esc_sql(like_escape($term));
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }

    if (!empty($search)) {
        $search = " AND ({$search}) ";
        if (!is_user_logged_in())
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }
    return $search;
}
add_filter('posts_search', 'ni_search_by_title_only', 500, 2);





//Sakib
add_filter('query', 'page_move');
function page_move($query)
{
    if (is_single(array(234222, 237734, 238943, 238908, 239048, 239884, 241132, 241230, 241474, 243027, 243084, 243027, 259810, 253695, 254438, 254535, 254880, 239058, 243429)) && !is_user_logged_in()) {
        wp_redirect('https://www.oneeducation.org.uk/');
        echo '<script> location.replace("https://www.oneeducation.org.uk/");</script>';
        die();
    }
    return $query;
}



//Sakib
function wporg_register_taxonomy_popularity()
{
    $labels = array(
        'name'              => _x('Popularities', 'taxonomy general name'),
        'singular_name'     => _x('Popularity', 'taxonomy singular name'),
        'search_items'      => __('Search Popularities'),
        'all_items'         => __('All Popularities'),
        'parent_item'       => __('Parent Popularity'),
        'parent_item_colon' => __('Parent Popularity:'),
        'edit_item'         => __('Edit Popularity'),
        'update_item'       => __('Update Popularity'),
        'add_new_item'      => __('Add New Popularity'),
        'new_item_name'     => __('New Popularity Name'),
        'menu_name'         => __('Popularity'),
    );
    $args   = array(
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labels,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'popularity'],
    );
    register_taxonomy('popularity', ['course'], $args);
}
add_action('init', 'wporg_register_taxonomy_popularity');


//Sakib
add_filter('woocommerce_thankyou_order_received_text', 'woo_change_order_received_text_budnle', 10, 2);
function woo_change_order_received_text_budnle($str, $order)
{
    $new_str .= '<b>Thank you. Your order has been received.</b><br> <br><br>';

    global $wp;
    // If order_id is defined on Order reveived / thankyou page
    // if ( is_wc_endpoint_url('order-received')
    // && isset($wp->query_vars['order-received'])
    // && absint($wp->query_vars['order-received']) > 0 ) {

    $order = wc_get_order($order->id);
    $items = $order->get_items();
    foreach ($items as $item) {
        $product_name = $item->get_name();
        $product_id = $item->get_product_id();
        if ($product_id === 446740) {

            $order = new WC_Order($order->id);
            $billing_email = $order->data['billing']['email'];
            $learnes_name = $order->data['billing']['first_name'] . ' ' . $order->data['billing']['last_name'];

            $new_str .= '<div class="alert alert-success sa-checkout-page"><b>Congratulations!</b> You have successfully claimed the 5 courses for £49.99 offer.<br>Click the button below to view the form you need to fill to get access to your 5 courses.<br>Cheers.<br>
                <a class="naim-btn" href="https://www.oneeducation.org.uk/choose-your-5-courses/?learners_email=' . $billing_email . '&order_id=' . $order->id . '&learners_name=' . $learnes_name . '">Click Here</a></div>';


            //Email
            /*
                $to = $billing_email;
                $subject  = 'Five Course Bundle';
                $body     = '<br><br>Regards<br>
                <b>Alpha Academy</b>';
                $headers  =  array('Content-Type: text/html; charset=UTF-8');
                wp_mail( $to, $subject, $body, $headers );
                */
        }
        $product_variation_id = $item->get_variation_id();
    }
    return $new_str;
    // }
}

/*
 * API Integration by Zubo
 */

//include __DIR__."/zubo/api.php";





/*Sakib*/
function webroom_add_multiple_products_to_cart($url = false)
{
    // Make sure WC is installed, and add-to-cart qauery arg exists, and contains at least one comma.
    if (!class_exists('WC_Form_Handler') || empty($_REQUEST['add-to-cart']) || false === strpos($_REQUEST['add-to-cart'], ',')) {
        return;
    }

    // Remove WooCommerce's hook, as it's useless (doesn't handle multiple products).
    remove_action('wp_loaded', array('WC_Form_Handler', 'add_to_cart_action'), 20);

    $product_ids = explode(',', $_REQUEST['add-to-cart']);
    $count       = count($product_ids);
    $number      = 0;

    foreach ($product_ids as $id_and_quantity) {
        // Check for quantities defined in curie notation (<product_id>:<product_quantity>)

        $id_and_quantity = explode(':', $id_and_quantity);
        $product_id = $id_and_quantity[0];

        $_REQUEST['quantity'] = !empty($id_and_quantity[1]) ? absint($id_and_quantity[1]) : 1;

        if (++$number === $count) {
            // Ok, final item, let's send it back to woocommerce's add_to_cart_action method for handling.
            $_REQUEST['add-to-cart'] = $product_id;

            return WC_Form_Handler::add_to_cart_action($url);
        }

        $product_id        = apply_filters('woocommerce_add_to_cart_product_id', absint($product_id));
        $was_added_to_cart = false;
        $adding_to_cart    = wc_get_product($product_id);

        if (!$adding_to_cart) {
            continue;
        }

        $add_to_cart_handler = apply_filters('woocommerce_add_to_cart_handler', $adding_to_cart->get_type(), $adding_to_cart);

        // Variable product handling
        if ('variable' === $add_to_cart_handler) {
            woo_hack_invoke_private_method('WC_Form_Handler', 'add_to_cart_handler_variable', $product_id);

            // Grouped Products
        } elseif ('grouped' === $add_to_cart_handler) {
            woo_hack_invoke_private_method('WC_Form_Handler', 'add_to_cart_handler_grouped', $product_id);

            // Custom Handler
        } elseif (has_action('woocommerce_add_to_cart_handler_' . $add_to_cart_handler)) {
            do_action('woocommerce_add_to_cart_handler_' . $add_to_cart_handler, $url);

            // Simple Products
        } else {
            woo_hack_invoke_private_method('WC_Form_Handler', 'add_to_cart_handler_simple', $product_id);
        }
    }
}

// Fire before the WC_Form_Handler::add_to_cart_action callback.
add_action('wp_loaded', 'webroom_add_multiple_products_to_cart', 15);

function woo_hack_invoke_private_method($class_name, $methodName)
{
    if (version_compare(phpversion(), '5.3', '<')) {
        throw new Exception('PHP version does not support ReflectionClass::setAccessible()', __LINE__);
    }

    $args = func_get_args();
    unset($args[0], $args[1]);
    $reflection = new ReflectionClass($class_name);
    $method = $reflection->getMethod($methodName);
    $method->setAccessible(true);

    //$args = array_merge( array( $class_name ), $args );
    $args = array_merge(array($reflection), $args);
    return call_user_func_array(array($method, 'invoke'), $args);
}

//END


//Display product sell count percentage query by shortcode-Farhan
function product_sell_count_percentage($atts)
{
    $atts = shortcode_atts(array(
        'id' => ''
    ), $atts);

    $product_Id = $atts['id'];
    $product = wc_get_product($product_Id);
    if (!empty($product_Id)) {
    ?>
        <div class="progressdiv" data-percent="<?php echo $product->get_total_sales() * 5; ?> "> <svg class="progress_bar" width="78" height="78" viewport="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <circle r="30" cx="40" cy="40" fill="transparent" stroke-dasharray="190" stroke-dashoffset="0"></circle>
                <circle class="bar" r="30" cx="40" cy="40" fill="transparent" stroke-dasharray="190" stroke-dashoffset="0"></circle>
            </svg></div>
    <?php
    }
}
add_shortcode('product_purchases_count', 'product_sell_count_percentage');



function divi_engine_remove_required_fields_checkout($fields)
{
    // if(is_page('subscription-checkout')){

    $fields['billing_first_name']['required'] = false;
    $fields['billing_last_name']['required'] = false;
    $fields['billing_phone']['required'] = false;
    $fields['billing_email']['required'] = true;
    $fields['billing_country']['required'] = false;
    // }
    return $fields;
}
add_filter('woocommerce_billing_fields', 'divi_engine_remove_required_fields_checkout');

function remove_local_storage()
{
    if (is_user_logged_in()) {
    ?>
        <script>
            localStorage.removeItem('localPassword');
            localStorage.removeItem('localEmail');
            localStorage.removeItem('localFirstName');
            localStorage.removeItem('localLastName');
            localStorage.removeItem('localPhone');
        </script>
    <?php
    }
}
add_action('wp_head', 'remove_local_storage');

add_filter('wc_stripe_show_payment_request_on_checkout', '__return_true');

//delete_user_meta(194871, '_enrolled_courses', '282850' );


/************************************* 
 * Potential fix for slow backend load. 
 * It just prevents the custom fields meta box and some other meta boxes from loading in the backend. 
 * Since the custom fields meta box contains so many data, it takes forever to load and hence gives the "Page not responding" error. 
 * By removing that meta box, it's now fixed. 
 *************************************/

// Start of metabox remove code
function sa_remove_metaboxes()
{
    remove_meta_box('postcustom', 'course', 'normal');
    remove_meta_box('postcustom', 'unit', 'normal');
    remove_meta_box('postcustom', 'post', 'normal');
    remove_meta_box('postcustom', 'page', 'normal');
    // remove_meta_box( 'commentstatusdiv' , 'course' , 'normal' ); 
    // remove_meta_box( 'commentsdiv' , 'course' , 'normal' ); 
    // remove_meta_box( 'authordiv' , 'course' , 'normal' ); 
    remove_meta_box('aam-access-manager', 'course', 'advanced');
    remove_meta_box('commentstatusdiv', 'unit', 'normal');
    remove_meta_box('commentsdiv', 'unit', 'normal');
    //remove_meta_box( 'authordiv' , 'unit' , 'normal' ); 
    remove_meta_box('aam-access-manager', 'unit', 'advanced');
}
add_action('admin_init', 'sa_remove_metaboxes');
// End of metabox remove code





/*
Gift card by Rezwan
*/
function formnotification_func($atts)
{
    ob_start();
    $atts = shortcode_atts(
        array(
            'gift_form' => 'Name',
            'gift_to' => '------',
            'amount' => '------',
            'entry_id' => '------',
        ),
        $atts,
        'formnotification'
    );

    if ($atts['amount'] === '1 Course + Enrolment Letter') {
        $gift_value = '1 <br> Course';
    } elseif ($atts['amount'] === '3 Courses + Enrolment Letter') {
        $gift_value = '3 <br> Courses';
    } elseif ($atts['amount'] === '5 Courses + Enrolment Letter') {
        $gift_value = '5 <br> Courses';
    } elseif ($atts['amount'] === '1200+ Courses + Enrolment Letter') {
        $gift_value = '1200+ <br> Courses';
    }

    $contentt = '

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
<!--[if !mso]><!-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i%7CRoboto:400,400i,700,700i" rel="stylesheet">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<!--<![endif]-->

<style type="text/css">
    
    body {
        font-family: \'Poppins\', sans-serif;
		font-size:14px;
    }
    @media screen and (max-width: 540px) {
        .conteiner {
            width: 100%!important;
        }
        .col12 {
            display: block;
            width: 100%!important;
        }
        .box {
            width: 100%!important;
        }
        .mbtop-bg {
            background-image: url(\'https://bucet.mlcdn.com/a/3380/3380605/images/ae25bbb5439907ad8d569a0d8fe30b623d0526c8.png\')!important;
            background-position: top center!important;
        }
        .pd-none {
            padding: 55px 0 0 !important;
        }
        .pd-bottom {
            padding: 10px 0 30px!important;
        }.pd-ext {
            padding: 0 0 10px!important;
        }
        .center {
            text-align: -webkit-center!important;
        }
    }

</style>
</head>
	<body>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
			<tr>
			  <td align="center" >
				  <table width="600" border="0" cellpadding="0" cellspacing="0" class="conteiner" >
					  <tr>
						  <td align="center" style="background-color: #ffffff; background-image: url(\'https://bucket.mlcdn.com/a/3393/3393946/images/7070e036d298f565e2776875dc789da8b9a23ceb.png\'); background-position: top left;background-repeat: no-repeat;background-size: 100% ;border-radius: 20px" >
							 <table width="100%" border="0" cellpadding="0" cellspacing="0" >  
							   <tr>
								   <td class="col12 mbtop-bg" style="background-image: url(\'https://bucket.mlcdn.com/a/3380/338060/images/a91ead4a602160f72c8f6cc26694f36dea67436b.png\'); background-position: top left;background-repeat: no-repeat;background-size: 100% ;border-radius: 20px" valign="top">
									   <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                           <tr>
											   <td align="center">
											       <table width="70%" border="0" cellpadding="0" cellspacing="0">
											           <tr>
											               <td align="center" style="padding: 100px 0 0" class="pd-none center">
                                                               <img src="https://bucket.mlcdn.com/a/3393/3393946/images/369260d23b3d2ba96f70e4217e10b4dd425611bb.png" alt="">
                                                           </td>
											           </tr>
                                                       <tr>
											               <td align="left" class="pd-bottom center" style="padding: 0 0 0">
                                                               <img src="https://bucket.mlcdn.com/a/3393/3393946/images/141b1b0f19e5bca364d01bdce9757339b2a7c3ea.png" alt="">
                                                           </td>
											           </tr>
											       </table>
											   </td>
										   </tr>
										   
									   </table>
								   </td>
								   <td  class="col12 center" align="left" >
									  <table width="90%" border="0" cellpadding="0" cellspacing="0" >
										   <tr>
											   <td style="padding: 60px 0 11px" align="center" class="pd-ext"><img src="https://bucket.mlcdn.com/a/3393/3393946/images/834a0d4672a87e19f63d7743cd2c1bcbb1e1ebcc.png" style="display: block" alt=""></td>
										   </tr>
											<tr>
											   <td align="center" style="background-color: #040303;border: 9px solid #1E5733;border-radius: 16px">
												  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="box" >
													  <tr>
														  <td>
															 <table width="100%" border="0" cellpadding="0" cellspacing="0">
																 <tr>
                                                                    <td align="center" style="color:#3E3D40;font-size: 16px;line-height: 19px;font-weight: 500;padding: 15px 0 5px">
                                                                       <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                                                           <tr>
                                                                               <td align="left" style="color:#ffffff;font-size: 16px;line-height: 19px;font-weight: 500;padding: 0 0 5px" class="mobile-text">Gift to</td>
                                                                               <td align="left" style="color:#ffffff;font-size: 16px;line-height: 19px;font-weight: 500;padding: 0 0 5px" class="mobile-text">: ' . $atts['gift_to'] . '</td>
                                                                           </tr>
                                                                           <tr>
                                                                               <td align="left" style="color:#ffffff;font-size: 16px;line-height: 19px;font-weight: 500;padding: 0 0 5px"  class="mobile-text"> Gift From </td>
                                                                               <td align="left" style="color:#ffffff;font-size: 16px;line-height: 19px;font-weight: 500;padding: 0 0 5px" class="mobile-text">: ' . $atts['gift_form'] . '</td>
                                                                           </tr>
                                                                           <tr>
                                                                               <td align="left"  style="color:#ffffff;font-size: 16px;line-height: 19px;font-weight: 500;padding: 0 0 5px"  class="mobile-text">Value</td>
                                                                               <td align="left" style="color:#ffffff;font-size: 16px;line-height: 19px;font-weight: 500;padding: 0 0 5px" class="mobile-text">: ' . $atts['amount'] . '</td>
                                                                           </tr>
                                                                           <tr>
                                                                               <td align="left" style="color:#ffffff;font-size: 16px;line-height: 19px;font-weight: 500;padding: 0 0 5px"  class="mobile-text">Entry ID</td>
                                                                               <td align="left" style="color:#ffffff;font-size: 16px;line-height: 19px;font-weight: 500;padding: 0 0 5px" class="mobile-text">: ' . $atts['entry_id'] . '</td>
                                                                           </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
															 </table> 
														  </td>
													  </tr>
												  </table>
											   </td>
										   </tr>
										   <tr>
											   <td style="padding: 15px 0 0" align="center">
												   <img src="https://bucket.mlcdn.com/a/3393/3393946/images/ad223073d53203d3a36560a6e536912cfe430486.png" style="display: block" alt="">
											   </td>
										   </tr>
									   </table> 
								   </td>
							   </tr>                               
							  
							  </table> 
						  </td>
					</tr>
										  
			   </table>
			  </td>
			</tr>
		</table>
    </body>
</html>';
    echo $contentt;
    return ob_get_clean();
}
add_shortcode('formnotification', 'formnotification_func');



//Start Gift Card
function woocommerce_add_custom_text_after_product_title()
{
    if (get_the_ID() == 538874) {
        echo do_shortcode('[elementor-template id="538890"]');
    }
}
add_action('woocommerce_before_single_product', 'woocommerce_add_custom_text_after_product_title', 5);
//End Gift Card




// Reed Listing Data
add_shortcode('wplms_reed_API_data', 'wplms_reed_API_data');
function wplms_reed_API_data($atts)
{
    $limit = empty($atts['per_page']) ?  $limit = 500  :  $limit = $atts['per_page'];
    global $wpdb;
    $pagenum = isset($_GET['pagenum']) ? absint($_GET['pagenum']) : 1;
    $table_name = "wp_reed_details";
    $offset = ($pagenum - 1) * $limit;
    $total = $wpdb->get_var("select count(*) as total from $table_name");
    $num_of_pages = ceil($total / $limit);
    $results = $wpdb->get_results("SELECT id, course_id, reed_id FROM $table_name limit $offset, $limit");
    ?>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <?php
    ob_start();
    ?>
    <!-- Your HTML codes here ...  -->
    <div class="container">
        <h4>Total: <?php echo $total; ?></h4>
        <table class="table">
            <thead>
                <tr>
                    <th>#sr</th>
                    <th>Reed Id & Link</th>
                    <th>Course Id</th>
                    <th>Curse Name & Link</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($results as $rowData) { ?>
                    <tr>
                        <td><?php echo $rowData->id; ?></td>
                        <td><a href="https://www.reed.co.uk/courses/?keywords=<?php echo $rowData->reed_id; ?>"><?php echo $rowData->reed_id; ?></a></td>
                        <td><?php echo $rowData->course_id; ?></td>
                        <?php
                        global $post;
                        $args = array(
                            //'p'         	=> 139939, 
                            'p'             => $rowData->course_id,
                            'post_type'     => 'course',
                            'post_status'     => 'publish',
                            'posts_per_page' => -1,
                            'meta_key'         => 'vibe_product',
                            'meta_value'     => ' ',
                            'meta_compare'     => '!=',
                        );
                        $qr = new WP_Query($args);
                        $count = $qr->found_posts;

                        if ($count != 0) {
                            $course_title = get_the_title($rowData->course_id);
                            if ($course_title != '') {
                        ?>
                                <td>
                                    <a href="<?php echo get_the_permalink($rowData->course_id) ?>">
                                        <?php echo esc_html(get_the_title($rowData->course_id)); ?>
                                    </a>
                                </td>

                            <?php
                            } else {
                            ?>
                                <td style="background:#820c0c; color: #fff; text-align: center;"> <b>Course not Found </b></td>
                            <?php
                            }
                        } else {
                            ?>
                            <td style="background:#cddc39; color: #fff; text-align: center;"> <b><?php echo esc_html(get_the_title($rowData->course_id)); ?> (Problem)</b></td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
        $page_links = paginate_links(array(
            'base' => add_query_arg('pagenum', '%#%'),
            'format' => '',
            'prev_text' => __('&laquo;', 'text-domain'),
            'next_text' => __('&raquo;', 'text-domain'),
            'total' => $num_of_pages,
            'current' => $pagenum
        ));

        if ($page_links) {
            echo '<div class="tablenav" style="width: 99%;"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}
//END Reed Listing Data


/*
/* Afetr Cart Cross Selling Offer
/* Added by Sakib
*/
//add_action( 'woocommerce_after_cart_table', 'cart_page_offer', 20, 1 );
function cart_page_offer()
{
    $cart_items_ids = array();
    $product_id = 535062;
    foreach (WC()->cart->get_cart() as $cart_item) {
        $cart_items_ids[] = $cart_item['product_id'];
    }

    if (!in_array($product_id, $cart_items_ids)) {
        $regular_price = get_post_meta($product_id, '_regular_price', true);
        $sale = get_post_meta($product_id, '_sale_price', true);
        $currency =  get_woocommerce_currency_symbol();
        if (!empty($sale)) {
            $price_subs =  '<del>' . $currency . $regular_price . '</del> ' . $currency . $sale;
        } else {
            $price_subs = $currency . $regular_price;
        }
    ?>

        <section class="cart-image-section">
            <div class="cart-inner">
                <p>Get Lifetime Access for <span class="cart-inner-hone">Only <?php echo  $price_subs; ?></span></p>
                <a class="cart-button-inner" href="https://www.oneeducation.org.uk/cart/?add-to-cart=<?php echo $product_id; ?>">
                    <img class="cartimage-inner" src="https://www.oneeducation.org.uk/wp-content/uploads/2022/06/Vector-1.png"> Add to Cart</a>
                <ul>
                    <li>* Regulated courses and Subscription are not included</li>
                    <li>* Separate Lifetime Access is needed for each courses</li>
                </ul>
            </div>
        </section>
        <style>
            section.cart-image-section {
                background-image: url(https://www.oneeducation.org.uk/wp-content/uploads/2022/06/image-29-1.png);
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                width: 100%;
                text-align: center;
                padding: 22px;
                border-radius: 10px;
            }

            .cart-inner {
                margin: 0 auto;
                background-color: rgb(114 104 104 / 1%);
                border-radius: 12px;
                font-family: sans-serif;
                line-height: 1;
                -webkit-backdrop-filter: blur(10px);
                backdrop-filter: blur(16px);
                /* padding: 40px 50px; */
                padding: 22px;
                border: 2px solid rgba(255, 255, 255, 0.21);
            }

            .cart-inner p {
                font-family: 'Poppins';
                font-style: normal;
                font-weight: 600;
                font-size: 36px;
                line-height: 54px;
                color: #553C8B;
                margin-top: 0;
            }

            a.cart-button-inner {
                color: #F52A73;
                border: 1px solid #F52A73;
                padding: 15px 40px;
                border-radius: 6px;
            }

            .cart-button-inner img {
                margin-right: 12px;
                margin-bottom: -3px;
            }

            .cart-inner p:first-child {
                margin-bottom: 40px;
            }

            span.cart-inner-hone {
                color: #ED4266;
                font-weight: 800;
            }

            @media only screen and (min-width: 320px) and (max-width: 767px) {
                .cart-inner p {
                    font-size: 18px;
                    line-height: 26px;
                }

                .cart-inner ul {
                    flex-direction: column;
                    line-height: 22px;
                }

            }

            @media only screen and (min-width: 768px) and (max-width: 1024px) {
                .cart-inner p {
                    font-size: 27px;
                }
            }

            a.cart-button-inner:hover {
                background: #553C8B;
                border-color: #F52A73;
                color: #fff;
                text-decoration: none;
            }

            .cart-inner ul {
                display: flex;
                /* width: 50%; */
                margin: auto;
                margin-top: 40px;
                justify-content: center;
            }

            .cart-inner ul li {
                list-style-type: none;
                margin-right: 15px;
            }
        </style>




        <!-- OLD -->
        <!-- <section class="cart-image-section">
            <div class="cart-inner">
                <p>Get Lifetime Access for <span class="cart-inner-hone">Only <?php echo  $price_subs; ?></span></p>
                <a class="cart-button-inner" href="https://www.oneeducation.org.uk/cart/?add-to-cart=<?php echo $product_id; ?>"><img class="cartimage-inner" src="https://www.oneeducation.org.uk/wp-content/uploads/2022/01/Vector-38-1.png"> Add to Cart</a>
            </div>
        </section>
        <style>
            section.cart-image-section {
            background-image: url(https://www.oneeducation.org.uk/wp-content/uploads/2022/01/Frame-6-2-1-1.png);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            width: 100%;
            text-align: center;
            padding: 40px;
            border-radius: 10px;
        }
        .cart-inner {
            margin: 0 auto;
            background-color: rgb(114 104 104 / 1%);
            border-radius: 12px;
            font-family: sans-serif;
            line-height: 1;
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(16px);
            padding: 40px 50px;
            border: 2px solid rgba(255, 255, 255, 0.21);
        }
        .cart-inner p {
            color: #ffffff;
            font-size: 32px;
            font-weight: bold;
            font-family: 'Open Sans';
        }
        a.cart-button-inner {
            color: #ffffff;
            border: 1px solid #ffffff;
            padding: 15px 40px;
            border-radius: 6px;
        }
        .cart-inner p:first-child {
            margin-bottom: 40px;
        }
        span.cart-inner-hone {
            color: yellow;
        }
        @media only screen and (min-width: 320px) and (max-width: 767px) {
        .cart-inner p {
            font-size: 18px;
            line-height: 26px;
            }
        }
        @media only screen and (min-width: 768px) and (max-width: 1024px) {
            .cart-inner p {
            font-size: 27px;
            }
        }
        a.cart-button-inner:hover {
            background: #f52a73;
            border-color: #F52A73;
        }
        </style> -->
    <?
    }
}



//Place order button name change
add_filter('woocommerce_order_button_text', 'misha_custom_button_text');
function misha_custom_button_text($button_text)
{
    return 'Place Order'; // new text is here 
}


// Sakib
//Example with enclosed content: [student_pass_mark]content[/student_pass_mark]
add_shortcode('student_pass_mark', 'student_pass_mark_func');
function student_pass_mark_func($atts, $content = "")
{

    $course_mark = apply_filters('the_content', $content);
    return 'Distinction';
    /*  if ($course_mark >= 60 && $course_mark <= 79) {
        return 'Merit';
    }elseif ($course_mark >= 80 && $course_mark <= 100) {
        return 'Distinction';
    }elseif ($course_mark >= 0 && $course_mark <= 59) {
        return 'Distinction';
    } */
}

/* add_shortcode('quiz_results','vibe_quiz_results');
function vibe_quiz_results($atts,$content=null){
	$defaults = array(
		'quiz_id'=>'',
		'course_id'=>'',
		'user_id'=>get_current_user_id(),
		);
	$atts = wp_parse_args($atts,$defaults);
	extract($atts);

	if(!is_user_logged_in()) // Bail out for non-logged in users
		return;

	$return = bp_course_quiz_results($quiz_id,$user_id,$course_id);

	return $return;
} */


/* function  woocommerce_button_proceed_to_checkout(){
    global $woocommerce;
    echo "...";
}
add_action( 'woocommerce_after_cart', 'woocommerce_button_proceed_to_checkout', 10 ); */






add_filter('woocommerce_thankyou_order_received_text', 'woo_change_order_received_text_budnle_one', 10, 2);
function woo_change_order_received_text_budnle_one($str, $order)
{
    $new_str .= '<b>Thank you. Your order has been received.</b><br> <br><br>';
    $order = wc_get_order($order->id);
    $items = $order->get_items();
    foreach ($items as $item) {
        $product_name = $item->get_name();
        $product_id = $item->get_product_id();
        if ($product_id === 572167) {

            $order = new WC_Order($order->id);
            $billing_email = $order->data['billing']['email'];
            $learnes_name = $order->data['billing']['first_name'] . ' ' . $order->data['billing']['last_name'];

            /* $new_str .='<div class="alert alert-success sa-checkout-page"><b>Congratulations!</b> You have successfully claimed the 5 courses for £39.99 offer.<br>Click the button below to view the form you need to fill to get access to your 5 courses.<br>Cheers.<br>
            <a class="naim-btn" href="https://www.#/choose-your-5-courses/?learners_email='.$billing_email.'&order_id='.$order->id.'&learners_name='.$learnes_name.'">Click Here</a></div>';
            */

            //Email
            $to = $billing_email;
            $subject  = 'Make Your 5 Courses Bundle - Confirm The Courses';
            $body     = 'Dear ' . $order->data['billing']['first_name'] . ',<br><br>Thank you for purchasing the <b>5 Courses Bundle</b>. Please reply to this email, mentioning the courses you want or just send us your phone number and we\'ll contact you as soon as possible.<br><br>Waiting for your response. Have a lovely day.<br><br> Regards<br><b>One Education</b>';
            $headers  =  array('Content-Type: text/html; charset=UTF-8');
            wp_mail($to, $subject, $body, $headers);
        }
        $product_variation_id = $item->get_variation_id();
    }
    return $new_str;
}



// The Wordpress Ajax PHP receiver
add_action('wp_ajax_add_remove_subscription_upgrade', 'checkout_ajax_add_remove_subscription_upgrade');
add_action('wp_ajax_nopriv_add_remove_subscription_upgrade', 'checkout_ajax_add_remove_subscription_upgrade');
function checkout_ajax_add_remove_subscription_upgrade()
{
    if (isset($_POST['subscription_upgrade']) && $_POST['subscription_upgrade'] == "true") {
        $_SESSION['subscription_upgrade'] = 1;
    } elseif (isset($_POST['subscription_upgrade']) && $_POST['subscription_upgrade'] == "false") {
        $_SESSION['subscription_upgrade'] = 0;
    }
    die();
}




//Cart auto update by Ajax
/* add_action( 'wp_head', function() {

	?><style>
	.woocommerce button[name="update_cart"],
	.woocommerce input[name="update_cart"] {
		display: none;
	}</style><?php
	
} );

add_action( 'wp_footer', function() {
	
	?><script>
	jQuery( function( $ ) {
		let timeout;
		$('.woocommerce').on('change', 'input.qty', function(){
			if ( timeout !== undefined ) {
				clearTimeout( timeout );
			}
			timeout = setTimeout(function() {
				$("[name='update_cart']").trigger("click"); // trigger cart update
			}, 1000 ); // 1 second delay, half a second (500) seems comfortable too
		});
	} );
	</script><?php
	
} ); */


//Message for course subscription 
/* function course_subscription_msg( $atts ){
	return 'Please log in to access the course. <br>If you do not know your login details, look for a separate email with the login details.
    For more information please visit the FAQ page of our website.<br><br><b><a href="https://www.oneeducation.org.uk/faq" target="blank" rel="noopener noreferrer">Find the login instruction here.</a></b>';
}
add_shortcode( 'course_subscription_msg', 'course_subscription_msg' ); */




// Dynamic Timer 
function timer_function($atts)
{
    $interval = $atts['interval'];
    ?>
    <style>
        .foy-countdown .foy-time {
            font-size: 30px;
            margin-top: 0px;
            color: #ffffff;
            background: #424242;
            padding: 5px;
            margin: 0px;
        }

        .foy-countdown .foy-dot {
            font-size: 25px;
            margin-top: 0px;
            color: #ffffff;
            background: #424242;
            padding: 3px 0px 5px 0px;
            margin: 0px;
        }

        .foy-time-label {
            margin: 0px;
            font-size: 10px;
        }

        .foy-countdown .foy-countdown-items {
            display: flex;
            justify-content: center;
        }

        .foy-countdown .foy-days,
        .foy-hours,
        .foy-minutes,
        .foy-seconds {
            text-align: center;
            padding: 0px 5px 0px 5px;
            width: 20%;
        }

        .foy-countdown .foy-days p,
        .foy-hours p,
        .foy-minutes p,
        .foy-seconds p,
        .foy-divider p {
            line-height: 24px;
            text-transform: uppercase;
        }
    </style>
    <div class="foy-countdown">
        <div class="foy-countdown-items">
            <div class="foy-days">
                <p class="foy-time days" id="days"></p>
                <p class="foy-time-label"> Days</p>
            </div>
            <div class="foy-divider foy-days-divider">
                <p class="foy-dot">:</p>
                <p class="foy-time-label"></p>
            </div>
            <div class="foy-hours">
                <p class="foy-time hours" id="hours"></p>
                <p class="foy-time-label"> Hours</p>
            </div>
            <div class="foy-divider">
                <p class="foy-dot">:</p>
                <p class="foy-time-label"></p>
            </div>
            <div class="foy-minutes">
                <p class="foy-time mins" id="mins"></p>
                <p class="foy-time-label"> Minutes</p>
            </div>
            <div class="foy-divider">
                <p class="foy-dot">:</p>
                <p class="foy-time-label"></p>
            </div>
            <div class="foy-seconds">
                <p class="foy-time secs" id="secs"></p>
                <p class="foy-time-label"> Seconds</p>
            </div>
        </div>
    </div>
    <?php
    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM wp_timer_ctm WHERE id = 1");
    foreach ($results as $time) {
        $end_time_ctm =  $time->end_time_ctm;
    }
    date_default_timezone_set("Asia/Dhaka");
    $current_date = date('Y-m-d H:i:s');

    if ($current_date <  $end_time_ctm) { ?>
        <script>
            // Set the date we're counting down to
            var database_time = <?php echo json_encode($end_time_ctm, JSON_HEX_TAG); ?>;
            var countDownDate = new Date(database_time).getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {
                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Result is output to the specific element
                days = ("0" + days).slice(-2)
                var elems = document.getElementsByClassName("days");
                for (var i = 0; i < elems.length; i++) {
                    elems[i].innerHTML = days;
                }

                hours = ("0" + hours).slice(-2)
                var elems = document.getElementsByClassName("hours");
                for (var i = 0; i < elems.length; i++) {
                    elems[i].innerHTML = hours;
                }

                minutes = ("0" + minutes).slice(-2)
                var elems = document.getElementsByClassName("mins");
                for (var i = 0; i < elems.length; i++) {
                    elems[i].innerHTML = minutes;
                }

                seconds = ("0" + seconds).slice(-2)
                var elems = document.getElementsByClassName("secs");
                for (var i = 0; i < elems.length; i++) {
                    elems[i].innerHTML = seconds;
                }


                // If the count down is over
                if (distance < 0) {
                    clearInterval(x);
                    var elems = document.getElementsByClassName("days");
                    for (var i = 0; i < elems.length; i++) {
                        elems[i].innerHTML = '00';
                    }
                    var elems = document.getElementsByClassName("hours");
                    for (var i = 0; i < elems.length; i++) {
                        elems[i].innerHTML = '00';
                    }
                    var elems = document.getElementsByClassName("mins");
                    for (var i = 0; i < elems.length; i++) {
                        elems[i].innerHTML = '00';
                    }
                    var elems = document.getElementsByClassName("secs");
                    for (var i = 0; i < elems.length; i++) {
                        elems[i].innerHTML = '00';
                    }
                }
            }, 1000);
        </script>
    <?php
    } else {
        $date = $end_time_ctm;
        $new_time = date('Y-m-d H:i:s', strtotime($date . ' + ' . $interval . ' hours'));
        $execute = $wpdb->query("
            UPDATE `wp_timer_ctm` 
            SET `end_time_ctm` = '$new_time'
            WHERE `wp_timer_ctm`.`id` = 1
            ");
    }
}
add_shortcode('foy-timer', 'timer_function');



// Arif Hasan
function grade_result_by_percantage()
{
    function gradeResult($scores)
    {
        if ($scores >= 80) {
            return "Distinction";
        } elseif ($scores >= 60)  return "Merit";
        elseif ($scores <= 59)  return "Fail";
    }

    $student_m = do_shortcode('[certificate_student_marks]');
    $ppc = $_GET['c'];
    $val = bp_course_get_curriculum_quizes($ppc);
    $meta_values = get_post_meta($val[0], 'vibe_quiz_tags');
    $course_numbers = $meta_values[0]['numbers'];
    $course_marks = $meta_values[0]['marks'];
    $total_mar = array_map(function ($a, $b) {
        return $a * $b;
    }, $course_numbers, $course_marks);
    $total_marks = array_sum($total_mar);
    $scores = ($student_m / $total_marks) * 100;
    return gradeResult($scores);
}
add_shortcode('result_per', 'grade_result_by_percantage');




/**
 * Enqueue a script Affiliatefuture.
 */
function affiliate_future_scripts()
{
    wp_enqueue_script('affiliate_set_cookie', 'https://tags.affiliatefuture.com/7434.js', array(), 1.5, true);
    //wp_enqueue_script( 'affiliatefuture1', 'https://scripts.affiliatefuture.com/AFFunctions.js', array(), 1.4,true );
}
add_action('wp_enqueue_scripts', 'affiliate_future_scripts');



// For Kishor bhai
add_action('wplms_course_subscribed', function ($course_id, $user_id) {

    //Course info
    // Category Name: Regulated Courses =  55654 
    if (has_term(55654, 'course-cat', $course_id)) {
        $course_name    = get_the_title($course_id);

        //Site info
        $brand_name     = get_bloginfo('name');

        //user info
        $user_info  = get_userdata($user_id);
        $username   = $user_info->user_login;
        $first_name = $user_info->first_name;
        $last_name  = $user_info->last_name;
        $user_email = $user_info->user_email;


        $to = array('recruitment@elearningsolutions.org.uk');
        $subject    = 'Alert! New Learner Enrolled in ' . $course_name . ' at ' . $brand_name . '';
        $body       = 'Email Address: ' . $user_email . '<br>User Name: ' . $first_name . ' ' . $last_name . '<br>Course ID: ' . $course_id . '<br>Course Name: ' . $course_name . '<br>Brand Name: <b>' . $brand_name . '</b><br>';
        $headers    =  array('Content-Type: text/html; charset=UTF-8');
        wp_mail($to, $subject, $body, $headers);
    }
}, 10, 2);





// Function for checkout cart page - Habib


//remove Order review in checkout
//remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );
//remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
//remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );

// Removes Order Notes Title
add_filter('woocommerce_enable_order_notes_field', '__return_false', 9999);

// Add a custom coupon field before checkout payment section
add_action('cart_checkout_coupon', 'woocommerce_checkout_coupon_form_custom');
function woocommerce_checkout_coupon_form_custom()
{
    echo '
    <div class="cart-checkout-coupon">
        <div class="coupon-form" style="margin-bottom:20px;">
            <p>' . __("If you have a coupon code, please apply it below.") . '</p>
            <p class="form-row form-row-first woocommerce-validated">
                <input type="text" name="coupon_code" class="input-text" placeholder="' . __("Coupon code") . '" id="coupon_code" value="">
            </p>
            <p class="form-row form-row-last">
                <button type="button" class="button checkout-coupon" name="apply_coupon" value="' . __("Apply coupon") . '">' . __("Apply coupon") . '</button>
            </p>
            <div class="clear"></div>
        </div>
    </div>';
}

// jQuery - Send Ajax request
add_action('wp_footer', 'custom_checkout_jquery_script');
function custom_checkout_jquery_script()
{
    if (is_checkout() && !is_wc_endpoint_url()) :
    ?>
        <script type="text/javascript">
            jQuery(function($) {
                if (typeof wc_checkout_params === 'undefined')
                    return false;

                var couponCode = '';

                $('input[name="coupon_code"]').on('input change', function() {
                    couponCode = $(this).val();
                });

                $('button[name="apply_coupon"]').on('click', function() {
                    $.ajax({
                        type: 'POST',
                        url: wc_checkout_params.ajax_url,
                        data: {
                            'action': 'apply_checkout_coupon',
                            'coupon_code': couponCode,
                        },
                        success: function(response) {
                            $(document.body).trigger("update_checkout"); // Refresh checkout
                            $(document.body).trigger('updated_cart_totals');
                            $(document.body).trigger('cart_totals_refreshed');
                            $('.woocommerce-error,.woocommerce-message').remove(); // Remove other notices
                            $('input[name="coupon_code"]').val(''); // Empty coupon code input field
                            $('form.checkout').before(response); // Display notices
                            location.reload(true);

                        }
                    });
                });
            });
        </script>
    <?php
    endif;
}

// Ajax receiver function
add_action('wp_ajax_apply_checkout_coupon', 'apply_checkout_coupon_ajax_receiver');
add_action('wp_ajax_nopriv_apply_checkout_coupon', 'apply_checkout_coupon_ajax_receiver');
function apply_checkout_coupon_ajax_receiver()
{
    if (isset($_POST['coupon_code']) && !empty($_POST['coupon_code'])) {
        WC()->cart->add_discount(wc_format_coupon_code(wp_unslash($_POST['coupon_code'])));
    } else {
        wc_add_notice(WC_Coupon::get_generic_coupon_error(WC_Coupon::E_WC_COUPON_PLEASE_ENTER), 'error');
    }
    wc_print_notices();
    wp_die();
}



function checkcart_action_woocommerce_after_cart_table()
{ ?>

    <style>
        .card .button_wrapper_area {
            margin-top: 0 !important;
        }

        .special-offer-title {
            margin-bottom: 30px;
        }

        .special-offer-title h2 {
            font-weight: 600;
            font-size: 28px;
        }

        p.special-product-name {
            display: inline-block;
            margin: 0;
            font-size: 18px;
        }

        .special-products-wrapper {
            max-width: 550px;
            margin-bottom: 50px;
        }

        .special-products-single {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .special-products-single a.remove {
            background-color: #eeeeee;
            border-color: #eeeeee;
            color: #333333;
            padding: 0.6180469716em 1.41575em;
            height: unset;
            width: 100%;
            text-indent: unset;
            text-decoration: none !important;
            font-weight: 600;
            max-width: 120px;
            text-align: center;
        }

        .special-products-single a.remove:hover {
            background-color: #d5d5d5;
            border-color: #d5d5d5;
        }

        .special-products-single a.remove::before {
            display: none !important;
        }

        input.check_to_cart[type="checkbox"] {
            position: relative;
            width: 50px;
            height: 28px;
            -webkit-appearance: none;
            background: #c6c6c6;
            outline: none;
            border-radius: 50px;
            transition: 0.7s;
        }

        input.check_to_cart:checked[type="checkbox"] {
            background: #03a9f4;
        }

        input.check_to_cart[type="checkbox"]:before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            top: 50%;
            left: 5px;
            background: #ffffff;
            transform: translateY(-50%);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: .5s;
        }

        input.check_to_cart:checked[type="checkbox"]:before {
            left: 25px;
        }
    </style>
    <div class="special-offer-products-container">
        <div class="special-offer-title">
            <?php
            $specialcat = get_term_by('slug', 'special-offer', 'product_cat');
            echo "<h2>$specialcat->name</h2>";
            ?>
        </div>
        <div class="special-products-wrapper">
            <?php

            $term = term_exists('special-offer', 'product_cat');
            if ($term == 0 && $term == null) {
                wp_insert_term(
                    'Special Offer',
                    'product_cat',
                    array(
                        'description' => 'Special offer products to show after cart table',
                        'slug' => 'special-offer'
                    )
                );
            }


            $args = array(
                'category' => array('special-offer'),
                'orderby' => 'date',
                'order' => 'DESC',

            );

            $products = wc_get_products($args);

            foreach ($products as $product) { ?>

                <div class="special-products-single" data-product_id="<?php echo $product->id; ?>">
                    <p class="special-product-name"><?php echo $product->name; ?> @
                        <?php if (!empty($product->regular_price) && !empty($product->sale_price)) {

                            echo "<del>" . get_woocommerce_currency_symbol() . "" . $product->regular_price . "</del> <strong>" . get_woocommerce_currency_symbol() . "" . $product->sale_price . "</strong>";
                        } elseif (empty($product->sale_price)) {

                            echo "<strong>" . get_woocommerce_currency_symbol() . "" . $product->regular_price . "</strong>";
                        }
                        ?>
                    </p>
                    <input type="checkbox" name="check_to_cart" class="check_to_cart" id="<?php echo $product->id; ?>" data-quantity="1" data-product_id="<?php echo $product->id; ?>">
                </div>
            <?php
            }
            ?>
        </div>
    </div>
<?php

};

// add the action 
add_action('after_check_cart_special_offer', 'checkcart_action_woocommerce_after_cart_table', 10, 0);
add_action('woocommerce_after_cart_table', 'checkcart_action_woocommerce_after_cart_table', 10, 0);



add_action('wp_ajax_my_ajax_action', 'my_ajax_function');
add_action('wp_ajax_nopriv_my_ajax_action', 'my_ajax_function');

add_action('wp_ajax_remove_cart_action', 'remove_cart_ajax_function');
add_action('wp_ajax_nopriv_remove_cart_action', 'remove_cart_ajax_function');




function remove_cart_ajax_function()
{
    $remove_product_id =  $_POST['remove_product_id'];
    $product_cart_id = WC()->cart->generate_cart_id($remove_product_id);
    $cart_item_key = WC()->cart->find_product_in_cart($product_cart_id);
    if ($cart_item_key) WC()->cart->remove_cart_item($cart_item_key);
    wp_die();
}


function my_ajax_function()
{

    $product_id =  $_POST['product_id'];
    WC()->cart->add_to_cart($product_id, 1);

    wp_die();
}


function checkcart_footer_script()
{  ?>
    <script>
        jQuery(document).ready(function($) {


            function checkCartProducts() {
                jQuery(".special-products-single").each(function(index) {

                    let inCartID = [];

                    jQuery(".woocommerce-cart-form__cart-item.cart_item").each(function(index) {
                        let cartProductID = jQuery(this).find('.product-remove a').attr('data-product_id');
                        inCartID.push(cartProductID);
                    });

                    let offerProductID = jQuery(this).attr('data-product_id');

                    if (inCartID.indexOf(offerProductID) >= 0) {
                        console.log("Matched " + offerProductID);
                        jQuery(".special-products-single").find('.check_to_cart[data-product_id="' + offerProductID + '"]').attr('checked', true);

                    } else {
                        console.log("Not Matched " + offerProductID);
                    }

                });

            };

            checkCartProducts();

            jQuery('.check_to_cart').click(function() {
                //let cart_checked;

                if (jQuery(this).prop("checked") == true) {
                    //cart_checked = true;
                    let product_id;
                    product_id = jQuery(this).attr("id");

                    jQuery.ajax({
                        url: "<?php echo admin_url("admin-ajax.php"); ?>",
                        type: "POST",
                        data: {
                            action: "my_ajax_action",
                            'product_id': product_id
                        },
                        success: function(data) {

                            //jQuery( document.body ).trigger( 'updated_cart_totals' );
                            //jQuery( document.body ).trigger( 'update_checkout' );
                            window.location.reload();
                        }

                    });

                } else {
                    let remove_product_id;
                    remove_product_id = jQuery(this).attr("id");

                    jQuery.ajax({
                        url: "<?php echo admin_url("admin-ajax.php"); ?>",
                        type: "POST",
                        data: {
                            action: "remove_cart_action",
                            'remove_product_id': remove_product_id
                        },
                        success: function(data) {

                            //jQuery( document.body ).trigger( 'updated_cart_totals' );
                            //jQuery( document.body ).trigger( 'update_checkout' );
                            window.location.reload();

                        }

                    });
                }
            });
        });
    </script>

<?php

}
add_action('wp_footer', 'checkcart_footer_script');

// Checkout FUnctions end





/**
 * Post view count
 *
 */
function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
function setPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

//Featured MetaBox

class OEMetaBox
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'oe_add_metabox'));
        add_action('save_post', array($this, 'oe_save_metabox'));
    }


    public function oe_add_metabox()
    {
        add_meta_box(
            'oe_featured_post',
            'Make Featured',
            array($this, 'oe_display_metabox'),
            'post',
            'side',
            'high'

        );
    }

    public function oe_display_metabox($post)
    {
        $is_favorite = get_post_meta($post->ID, 'oe_is_featured', true);
        $checked = $is_favorite == 1 ? 'checked' : '';

        wp_nonce_field('oe_featured', 'oe_featured_field');
        $metabox = <<<EOD
<input type="checkbox" name="oe_is_featured" id="oe_is_featured" value="1" {$checked}>
<label for="oe_is_featured">Yes</label>
EOD;

        echo $metabox;
    }

    private function is_secured($nonce_field, $action, $post_id)
    {
        $nonce = isset($_POST[$nonce_field]) ? $_POST[$nonce_field] : '';

        if ($nonce == '') {
            return false;
        }

        if (!wp_verify_nonce($nonce, $action)) {
            return false;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return false;
        }

        if (wp_is_post_autosave($post_id)) {
            return false;
        }
        if (wp_is_post_revision($post_id)) {
            return false;
        }

        return true;
    }

    public function oe_save_metabox($post_id)
    {
        if (!$this->is_secured('oe_featured_field', 'oe_featured', $post_id)) {
            return $post_id;
        }

        $is_favorite = isset($_POST['oe_is_featured']) ? $_POST['oe_is_featured'] : '';
        update_post_meta($post_id, 'oe_is_featured', $is_favorite);
    }
}

new OEMetaBox();


function custom_excerpt_length($length)
{
    global $post;
    if ($post->post_type == 'post') {
        return 80;
    }
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);


function new_excerpt_more($more)
{
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');


// All course grid view 
/**
 * course directory course loop section modift by filter hook,
 * because its not a template so not possible to override course loop section without filter hook,
 * its wplms theme official instruction wplms theme support forum
 */
add_filter('bp_course_single_item_view', function ($x) {
    global $post;

    $course_id = get_the_ID();
    $product_id = get_post_meta($course_id, 'vibe_product', true);
    $vibe_students = get_post_meta($course_id, 'vibe_students', true);


    $average_rating = get_post_meta($course_id, 'average_rating', true);

    //var_dump($vibe_students);
    $course_post_id = $post->ID;
    $course_author = $post->post_author;

    $course_classes = apply_filters('bp_course_single_item', 'course_single_item course_id_' . $post->ID . ' course_status_' . $post->post_status . ' course_author_' . $post->post_author, get_the_ID());
?>

    <li class="<?php echo $course_classes; ?>">

        <div class="new-all-courses-single-section">
            <div class="containers-manual">
                <div class="new-all-courses-single-block">
                    <div class="new-all-course-single-img">
                        <div class="the-actual-img">
                            <a href="<?php //echo get_the_permalink($course_id) 
                                        ?>">
                                <!-- <img src="assets/img/coure-single-test-img.jpg" alt="course_img"> -->
                                <?php bp_course_avatar(); ?>
                            </a>
                        </div>
                    </div>
                    <div class="new-all-course-single-des">
                        <div class="course-dynamic-tags">
                            <ul>
                                <li class="if-featured-or-highlited">FEATURED</li>
                                <?php

                                if (has_term(56229, 'course-cat')) { //prince2
                                ?>
                                    <li class="only-for-specific-offers">Winter Ending Sale - 40% OFF</li>
                                <?php
                                } elseif (has_term(55654, 'course-cat')) { //Regulated Courses
                                ?>
                                    <li class="only-for-specific-offers">Winter Ending Sale</li>
                                <?php
                                } else {
                                ?>
                                    <li class="only-for-specific-offers">Winter Ending Sale - 95% OFF</li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="course-dynamic-title">
                            <h2>
                                <a href="<?php echo get_permalink(); ?>">
                                    <?php echo get_the_title(); ?>
                                </a>
                            </h2>
                        </div>
                        <div class="coure-dynamic-rating-and-students">
                            <ul>
                                <li class="ratings">
                                    <!-- <img src="<?php echo get_theme_file_uri() ?>/img/StarRatings.png" alt="star"> -->
                                    <?php if (!empty($average_rating)) { ?>
                                        <div class="ks-star-rating">
                                            <!-- <div class="sh_rating-upper" style="width:<?php echo ($average_rating * 20); ?>%">
                                            <span>★★★★★<?php echo $average_rating; ?></span>
                                        </div> -->


                                            <svg viewBox="0 0 1000 200" class='rating'>
                                                <defs>
                                                    <polygon id="star" points="100,0 131,66 200,76 150,128 162,200 100,166 38,200 50,128 0,76 69,66 " />
                                                    <clipPath id="stars">
                                                        <use xlink:href="#star" />
                                                        <use xlink:href="#star" x="20%" />
                                                        <use xlink:href="#star" x="40%" />
                                                        <use xlink:href="#star" x="60%" />
                                                        <use xlink:href="#star" x="80%" />
                                                    </clipPath>
                                                </defs>
                                                <rect class='rating__background' clip-path="url(#stars)"></rect>
                                                <!-- Change the width of this rect to change the rating -->
                                                <rect width="<?php echo ($average_rating * 20); ?>%" class='rating__value' clip-path="url(#stars)"></rect>
                                            </svg>
                                        </div>
                                    <?php } ?>

                                </li>
                                <li class="students"><img src="<?php echo get_theme_file_uri() ?>/img/students.png" alt="std"> <?php echo  $vibe_students;  ?></li>
                            </ul>
                        </div>

                        <div class="course-dynamic-des">
                            <p>
                                <?php the_excerpt(); ?>
                            </p>
                        </div>
                    </div>
                    <div class="new-all-course-price-btns">
                        <div class="price-div">
                            <?php
                            if (!bp_is_my_profile()) {
                                bp_course_credits();
                            } else {
                                the_course_button($course_id);
                            }
                            ?>
                        </div>
                        <div class="btn-div">
                            <a href="<?php echo get_the_permalink($course_id) ?>" class="view-btn">View Course</a>

                            <!-- <a style="" href="?add-to-cart=<?php echo $product_id; ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart add-cart-ctm start add-to-cart-btn" data-product_id="<?php echo $product_id; ?>" data-product_sku="" aria-label="Add" rel="nofollow">Add to Cart</a> -->
                            <?php
                            if (!bp_is_my_profile()) {
                            ?>
                                <a href="?add-to-cart=<?php echo $product_id; ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart  add-to-cart-btn" data-product_id="<?php echo $product_id; ?>" data-product_sku="" aria-label="Add" rel="nofollow">Add to Cart</a>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </li>

<?php
    return 1;
});


// added by shoive 

function popup_function()
{ ?>
    <header class="mooc <?php if (isset($fix) && $fix) {
                            echo 'fix';
                        } ?>">
        <ul class="topmenu">
            <?php do_action('wplms_header_top_login'); ?>
            <?php
            if (function_exists('bp_loggedin_user_link') && is_user_logged_in()) :
            ?>
                <li>
                    <a href="<?php bp_loggedin_user_link(); ?>" class="smallimg vbplogin"><?php $n = vbp_current_user_notification_count();
                                                                                            echo ((isset($n) && $n) ? '<em></em>' : '');
                                                                                            bp_loggedin_user_avatar('type=full'); ?>
                        <span><?php bp_loggedin_user_fullname(); ?></span>
                    </a>
                </li>
            <?php
            else :
            ?>
                <li>
                    <a href="#login" rel="nofollow" class=" vbplogin"><span><?php _e('LOGIN', 'vibe'); ?></span></a>
                </li>
            <?php
            endif;
            ?>
        </ul>
        <?php
        $style = vibe_get_login_style();
        if (empty($style)) {
            $style = 'default_login';
        }
        ?>
        <?php
        if (function_exists('bp_loggedin_user_link') && is_user_logged_in()) {
        ?>
            <div id="vibe_bp_login" class="<?php echo vibe_sanitizer($style, 'text'); ?>">
                <?php
                vibe_include_template("login/$style.php");
                ?>
            </div>
        <?php } ?>
        <!-- login popup -->
        <?php
        if (!is_user_logged_in()) { ?>
            <div class="foy-login-container">
                <div id="vibe_bp_login" class="<?php echo vibe_sanitizer($style, 'text'); ?> foy_vibe_bp_login">
                    <?php
                    vibe_include_template("login/$style.php");
                    ?>
                </div>
            </div>
        <?php } ?>
        <!-- login popup ends -->
    </header>
<?php }
add_shortcode('foy_lr', 'popup_function');

add_action('wp_head', 'themeslug_remove_hooks');
function themeslug_remove_hooks()
{
    remove_action('wplms_single_course_content_end', [WPLMS_Actions::init(), 'show_related']);
?>
    <style>
        .selling-tag {
            display: none;
        }
    </style>
    <?php
}
add_action('wplms_single_course_content_end', 'show_related_modified');
function show_related_modified()
{
    $style = vibe_get_option('default_course_block_style');
    $wpseo_primary_term = new WPSEO_Primary_Term('course-cat', get_the_id());
    $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
    $primary_term = get_term($wpseo_primary_term);
    $categories = array();
    if (!empty($primary_term)) {
        $categories[] = $primary_term->term_id;
    }
    $args = apply_filters('vibe_related_courses', array(
        'post_type' => 'course',
        'posts_per_page' => 3,
        'post__not_in' => array(get_the_ID()),
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'course-cat',
                'field' => 'id',
                'terms' => $categories,
            ),
        ),
    ));
    $courses = new WP_Query($args);

    if ($courses->have_posts()) :
    ?>
        <div class="related_courses">
            <h3 class="heading"><span><?php _e('Related Courses', 'vibe'); ?></span></h3>
            <?php

            ?>
            <ul class="row">
                <?php
                while ($courses->have_posts()) : $courses->the_post();
                    global $post;
                    echo '<li class="col-md-4">';

                    if (empty($style))
                        $style = 'course4';

                    echo thumbnail_generator($post, $style, 'medium');
                    echo '</li>';
                endwhile;
                ?>
            </ul>
        </div>
    <?php
    endif;
    wp_reset_postdata();
}



//add_action( 'gform_post_payment_completed_224', 'gift_card_after_payment', 10, 2 );
function gift_card_after_payment($entry, $form)
{
    global $wpdb;
    echo "After Payment";
    $image_base64 = rgpost('input_8');
    var_dump($image_base64);



    //Insert The Base64 String Here

    $image = base64_decode($image_base64);

    $upload_dir = wp_upload_dir();

    // @new
    $upload_path = str_replace('/', DIRECTORY_SEPARATOR, $upload_dir['path']) . DIRECTORY_SEPARATOR;

    $decoded = $image;
    $filename = 'gift_card.png';

    $hashed_filename = md5($filename . microtime()) . '_' . $filename;

    // @new
    $image_upload = file_put_contents($upload_path . $hashed_filename, $decoded);

    //HANDLE UPLOADED FILE
    if (!function_exists('wp_handle_sideload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }

    // Without that I'm getting a debug error!?
    if (!function_exists('wp_get_current_user')) {
        require_once(ABSPATH . 'wp-includes/pluggable.php');
    }

    // @new
    $file             = array();
    $file['error']    = '';
    $file['tmp_name'] = $upload_path . $hashed_filename;
    $file['name']     = $hashed_filename;
    $file['type']     = 'image/png';
    $file['size']     = filesize($upload_path . $hashed_filename);

    // upload file to server
    // @new use $file instead of $image_upload
    $file_return = wp_handle_sideload($file, array('test_form' => false));

    $filename = $file_return['file'];
    $attachment = array(
        'post_mime_type' => $file_return['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
        'post_content' => '',
        'post_status' => 'inherit',
        'guid' => $wp_upload_dir['url'] . '/' . basename($filename)
    );
    $attach_id = wp_insert_attachment($attachment, $filename);
}





add_action('gform_after_submission_224', 'gift_card_form_after_submission', 10, 2);
function gift_card_form_after_submission($entry, $form)
{
    global $wpdb;
    //echo "After form submission";

    $image_base64           = rgpost('input_8');

    $gift_to                = rgpost('input_2');
    $gift_receiver_email    = rgpost('input_19');

    $gift_from              = rgpost('input_1');
    $gift_sender_email      = rgpost('input_20');

    $gift_total             = rgpost('input_12');


    $subscription           = rgpost('input_25');

    //var_dump($subscription );

    //Insert The Base64 String Here

    $image = base64_decode($image_base64);

    $upload_dir = wp_upload_dir();

    // @new
    $upload_path = str_replace('/', DIRECTORY_SEPARATOR, $upload_dir['path']) . DIRECTORY_SEPARATOR;
    //var_dump($upload_path);
    $decoded = $image;
    $filename = 'gift_card.png';

    $hashed_filename = md5($filename . microtime()) . '_' . $filename;

    // @new
    $image_upload = file_put_contents($upload_path . $hashed_filename, $decoded);

    //HANDLE UPLOADED FILE
    if (!function_exists('wp_handle_sideload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }

    // Without that I'm getting a debug error!?
    if (!function_exists('wp_get_current_user')) {
        require_once(ABSPATH . 'wp-includes/pluggable.php');
    }

    // @new
    $file             = array();
    $file['error']    = '';
    $file['tmp_name'] = $upload_path . $hashed_filename;
    $file['name']     = $hashed_filename;
    $file['type']     = 'image/png';
    $file['size']     = filesize($upload_path . $hashed_filename);

    // upload file to server
    // @new use $file instead of $image_upload
    $file_return = wp_handle_sideload($file, array('test_form' => false));

    $filename = $file_return['file'];
    $attachment = array(
        'post_mime_type' => $file_return['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
        'post_content' => '',
        'post_status' => 'inherit',
        'guid' => $wp_upload_dir['url'] . '/' . basename($filename)
    );
    $attach_id = wp_insert_attachment($attachment, $filename);
    $img_url = wp_get_attachment_url($attach_id);
    //var_dump($img_url);

    include_once 'email-template/gift-card-receiver-email.php';
    include_once 'email-template/gift-card-sender-email.php';


    $to = array($gift_receiver_email);
    $subject = 'Dear ' . $gift_to . ', Congratulations, you\'ve received a gift card from ' . $gift_from . '';
    $body = $recv_content;
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($to, $subject, $body, $headers);


    $to = array($gift_sender_email);
    $subject = 'Dear ' . $gift_from . ', We\'ve received and executed your gift card request for ' . $gift_to . '';
    $body = $send_content;
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($to, $subject, $body, $headers);
}


/*
=====================================
 code added by foyez ali 1-03-2023
=====================================
 */
function foy_custom_product_fields()
{
    global $product;
    $allowed_products = array('619640', '624058', '624061');
    if (in_array($product->id, $allowed_products)) { ?>
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

            .foy-course-list p {
                margin: 0px;
            }

            .foy-suggestion-box hr {
                margin-top: 10px !important;
                margin-bottom: 10px !important;
            }

            .foy-suggestion-box hr:last-child {
                display: none;
            }

            .spinner-border {
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

            .foy-searchform {
                display: flex;
            }

            .foy-hide {
                display: none !important;
            }

            .foy-show {
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
                function foyFunction1() {
                    jQuery('.foy-suggestion-box').css('display', 'none');
                    jQuery('#foy-loading1').css('display', 'block');
                    var keyword = jQuery('#field1').val();
                    if (keyword.length < 3) {
                        jQuery('#foy-suggestion-box1').html("");
                        jQuery('#foy-suggestion-box1').css('display', 'none');
                        jQuery('#foy-loading1').css('display', 'none');
                    } else {
                        jQuery.ajax({
                            url: "<?php echo admin_url('admin-ajax.php'); ?>",
                            type: 'get',
                            data: {
                                action: 'data_fetch',
                                keyword: keyword
                            },
                            success: function(data) {
                                jQuery('#foy-suggestion-box1').html(data);
                                jQuery('#foy-suggestion-box1').css('display', 'block');
                                jQuery('#foy-loading1').css('display', 'none');
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
                function foyFunction2() {
                    jQuery('.foy-suggestion-box').css('display', 'none');
                    jQuery('#foy-loading2').css('display', 'block');
                    var keyword = jQuery('#field2').val();
                    if (keyword.length < 3) {
                        jQuery('#foy-suggestion-box2').html("");
                        jQuery('#foy-suggestion-box2').css('display', 'none');
                        jQuery('#foy-loading2').css('display', 'none');
                    } else {
                        jQuery.ajax({
                            url: "<?php echo admin_url('admin-ajax.php'); ?>",
                            type: 'get',
                            data: {
                                action: 'data_fetch',
                                keyword: keyword
                            },
                            success: function(data) {
                                jQuery('#foy-suggestion-box2').html(data);
                                jQuery('#foy-suggestion-box2').css('display', 'block');
                                jQuery('#foy-loading2').css('display', 'none');
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
                function foyFunction3() {
                    jQuery('.foy-suggestion-box').css('display', 'none');
                    jQuery('#foy-loading3').css('display', 'block');
                    var keyword = jQuery('#field3').val();
                    if (keyword.length < 3) {
                        jQuery('#foy-suggestion-box3').html("");
                        jQuery('#foy-suggestion-box3').css('display', 'none');
                        jQuery('#foy-loading3').css('display', 'none');
                    } else {
                        jQuery.ajax({
                            url: "<?php echo admin_url('admin-ajax.php'); ?>",
                            type: 'get',
                            data: {
                                action: 'data_fetch',
                                keyword: keyword
                            },
                            success: function(data) {
                                jQuery('#foy-suggestion-box3').html(data);
                                jQuery('#foy-suggestion-box3').css('display', 'block');
                                jQuery('#foy-loading3').css('display', 'none');
                            }
                        });
                    }
                }
            </script>
            <!-- Input 4 -->
            <?php
            $bundle_4 = array('624058', '624061');
            if (in_array($product->id, $bundle_4)) { ?>
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
                    function foyFunction4() {
                        jQuery('.foy-suggestion-box').css('display', 'none');
                        jQuery('#foy-loading4').css('display', 'block');
                        var keyword = jQuery('#field4').val();
                        if (keyword.length < 3) {
                            jQuery('#foy-suggestion-box4').html("");
                            jQuery('#foy-suggestion-box4').css('display', 'none');
                            jQuery('#foy-loading4').css('display', 'none');
                        } else {
                            jQuery.ajax({
                                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                                type: 'get',
                                data: {
                                    action: 'data_fetch',
                                    keyword: keyword
                                },
                                success: function(data) {
                                    jQuery('#foy-suggestion-box4').html(data);
                                    jQuery('#foy-suggestion-box4').css('display', 'block');
                                    jQuery('#foy-loading4').css('display', 'none');
                                }
                            });
                        }
                    }
                </script>

            <?php } ?>
            <!-- Input 5 -->
            <?php
            $bundle_5 = array('624061');
            if (in_array($product->id, $bundle_5)) { ?>
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
                    function foyFunction5() {
                        jQuery('.foy-suggestion-box').css('display', 'none');
                        jQuery('#foy-loading5').css('display', 'block');
                        var keyword = jQuery('#field5').val();
                        if (keyword.length < 3) {
                            jQuery('#foy-suggestion-box5').html("");
                            jQuery('#foy-suggestion-box5').css('display', 'none');
                            jQuery('#foy-loading5').css('display', 'none');
                        } else {
                            jQuery.ajax({
                                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                                type: 'get',
                                data: {
                                    action: 'data_fetch',
                                    keyword: keyword
                                },
                                success: function(data) {
                                    jQuery('#foy-suggestion-box5').html(data);
                                    jQuery('#foy-suggestion-box5').css('display', 'block');
                                    jQuery('#foy-loading5').css('display', 'none');
                                }
                            });
                        }
                    }
                </script>
            <?php } ?>

            <script>
                function courseClicked(element) {
                    var courseText = element.lastElementChild.innerText;
                    var courseId = element.lastElementChild.id;
                    var grandParent = element.parentElement.parentElement;
                    var inputField = grandParent.firstElementChild;
                    var secondInputField = grandParent.children[1];

                    inputField.value = courseText;
                    inputField.setAttribute("value", courseId);
                    inputField.setAttribute("data-attribute", courseId);

                    jQuery('.foy-suggestion-box').css('display', 'none');
                    secondInputField.value = courseId;
                    console.log(secondInputField);
                }
            </script>
        </div>
        <?php }
}
add_action('woocommerce_before_add_to_cart_button', 'foy_custom_product_fields');

// save input fields
function foy_save_custom_fields_data($cart_item_data, $product_id)
{
    for ($i = 1; $i <= 5; $i++) {
        $custom_input = "custom_input_$i";
        $course_id = "course_id_$i";
        if (isset($_POST[$custom_input])) {
            $cart_item_data[$custom_input] = $_POST[$custom_input] ?? NULL;
            $cart_item_data[$course_id] =  $_POST[$course_id] ?? NULL;
        }
    }
    return $cart_item_data;
}
add_filter('woocommerce_add_cart_item_data', 'foy_save_custom_fields_data', 10, 2);

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
                <p id="<?php echo get_the_ID() ?>"><?php the_title(); ?></p>
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
