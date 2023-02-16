<?php

add_action('wp_enqueue_scripts', 'wplms_child_enqueue_styles');

function wplms_child_enqueue_styles()
{
    $theme = wp_get_theme();
    wp_enqueue_style(
        'parent-style',
        get_template_directory_uri() . '/style.css',
        array(),
        $theme->parent()->get('Version')
    );
    wp_enqueue_style(
        'child-style',
        get_stylesheet_uri(),
        array('parent-style'),
        $theme->get('Version')
    );

    // enque for dashboard 
    wp_enqueue_style('dash-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), true);
    wp_enqueue_style('course-card-style', get_stylesheet_directory_uri() . '/assets/css/foyStyle.css', array(), true);

    //wp_enqueue_style('dash-style-font', get_stylesheet_directory_uri() . '/assets/css/font-awesome.css', array(), true);
    wp_enqueue_style('slick-style', get_stylesheet_directory_uri() . '/assets/css/slick.css', array(), true);
    wp_enqueue_style('slick-theme-style', get_stylesheet_directory_uri() . '/assets/css/slick-theme.css', array(), true);

    wp_enqueue_script('dashmain-srcipt', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'), NULL, true);
    wp_enqueue_script('slick-min-srcipt', get_stylesheet_directory_uri() . '/assets/js/slick.min.js', array('jquery'), NULL, true);
}

function my_scripts_method()
{ ?>
    <script>
        (function($) {
            alert('hello');
        })(jQuery);
    </script>
<?php }

//add_action('wp_footer', 'my_scripts_method');

// added by foyez ali
// check user subsscription
function get_user_subscription(){
    $user = wp_get_current_user();
    $user_id = $user->id;
    $sub = 0;
    $subscriptions = wcs_get_users_subscriptions($user_id);
    foreach ($subscriptions as $subscription){
        $status = $subscription->get_status();
        if (in_array($status, array( 'active' ))) {
            $sub = 1;
            return $sub;
        }
    }
    return $sub;
}
// left/right advertisement banner
function left_add(){
    $sub = 0;
    // $sub = get_user_subscription();
    
    if ($sub == 0) {
        echo '<iframe id="aswift_1" name="aswift_1" style="width:300px;height:600px;" sandbox="allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation" width="300" height="600" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" src="https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-4877892089121284&amp;output=html&amp;h=600&amp;slotname=5004277412&amp;adk=343299291&amp;adf=1416276351&amp;pi=t.ma~as.5004277412&amp;w=300&amp;fwrn=4&amp;fwrnh=100&amp;lmt=1674447952&amp;rafmt=1&amp;format=300x600&amp;url=https%3A%2F%2Falison.com%2Ftopic%2Flearn%2F69364%2Flegal-ethical-issues-in-caregiving%23course-plan&amp;fwr=0&amp;fwrattr=true&amp;rpe=1&amp;resp_fmts=4&amp;wgl=1&amp;uach=WyJXaW5kb3dzIiwiMTAuMC4wIiwieDg2IiwiIiwiMTA5LjAuNTQxNC43NSIsW10sZmFsc2UsbnVsbCwiNjQiLFtbIk5vdF9BIEJyYW5kIiwiOTkuMC4wLjAiXSxbIkdvb2dsZSBDaHJvbWUiLCIxMDkuMC41NDE0Ljc1Il0sWyJDaHJvbWl1bSIsIjEwOS4wLjU0MTQuNzUiXV0sZmFsc2Vd&amp;dt=1674447951845&amp;bpp=2&amp;bdt=2391&amp;idt=939&amp;shv=r20230118&amp;mjsv=m202301030101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie=ID%3D15879ace970d3951-22fa538726d900de%3AT%3D1672639409%3ART%3D1672639409%3AS%3DALNI_MZxJvsm3OOXBTVPuGj85aUhYN7OBg&amp;gpic=UID%3D00000b9c68ad54f6%3AT%3D1672639409%3ART%3D1674212171%3AS%3DALNI_MYJWU_Pp5XfOjlczo9pBZJweYVCPg&amp;prev_fmts=336x280&amp;correlator=1955245418194&amp;frm=20&amp;pv=1&amp;ga_vid=1207935776.1672639231&amp;ga_sid=1674447953&amp;ga_hid=1909241048&amp;ga_fc=1&amp;u_tz=360&amp;u_his=7&amp;u_h=1080&amp;u_w=1920&amp;u_ah=1040&amp;u_aw=1920&amp;u_cd=24&amp;u_sd=1&amp;dmc=8&amp;adx=5&amp;ady=92&amp;biw=1903&amp;bih=967&amp;scr_x=0&amp;scr_y=0&amp;eid=44759876%2C44759927%2C44759837&amp;oid=2&amp;pvsid=3219457783627400&amp;tmod=712671790&amp;uas=0&amp;nvt=3&amp;eae=0&amp;fc=896&amp;brdim=0%2C0%2C0%2C0%2C1920%2C0%2C0%2C0%2C1920%2C967&amp;vis=2&amp;rsz=%7C%7CaEr%7C&amp;abl=CA&amp;pfx=0&amp;fu=128&amp;bc=31&amp;ifi=2&amp;uci=a!2&amp;fsb=1&amp;xpc=BWr7z3kMNT&amp;p=https%3A//alison.com&amp;dtd=943" data-google-container-id="a!2" data-google-query-id="CLzZvZft3PwCFSGT5god3r0MZQ" data-load-complete="true"></iframe>';
    }
}
add_shortcode( 'foy_left_add', 'left_add' );

// top/bottom advertisement banner
function bottom_add(){  
    $sub = 0;
    // $sub = get_user_subscription();
    
    if ($sub == 0) {
        echo '<iframe id="aswift_1" name="aswift_1" style="width:1150px;height:280px;" sandbox="allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation" width="1150" height="280" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" src="https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-4877892089121284&amp;output=html&amp;h=280&amp;slotname=6799450798&amp;adk=2645430490&amp;adf=3670586355&amp;pi=t.ma~as.6799450798&amp;w=1150&amp;fwrn=4&amp;fwrnh=100&amp;lmt=1674454186&amp;rafmt=1&amp;format=1150x280&amp;url=https%3A%2F%2Falison.com%2Fcourses%2Fdiploma-in-caregiving-revised-2018%2Fresources&amp;fwr=0&amp;fwrattr=true&amp;rpe=1&amp;resp_fmts=3&amp;wgl=1&amp;uach=WyJXaW5kb3dzIiwiMTAuMC4wIiwieDg2IiwiIiwiMTA5LjAuNTQxNC43NSIsW10sZmFsc2UsbnVsbCwiNjQiLFtbIk5vdF9BIEJyYW5kIiwiOTkuMC4wLjAiXSxbIkdvb2dsZSBDaHJvbWUiLCIxMDkuMC41NDE0Ljc1Il0sWyJDaHJvbWl1bSIsIjEwOS4wLjU0MTQuNzUiXV0sZmFsc2Vd&amp;dt=1674454186148&amp;bpp=3&amp;bdt=5296&amp;idt=277&amp;shv=r20230118&amp;mjsv=m202301030101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie=ID%3D15879ace970d3951-22fa538726d900de%3AT%3D1672639409%3ART%3D1672639409%3AS%3DALNI_MZxJvsm3OOXBTVPuGj85aUhYN7OBg&amp;gpic=UID%3D00000b9c68ad54f6%3AT%3D1672639409%3ART%3D1674448081%3AS%3DALNI_MYJWU_Pp5XfOjlczo9pBZJweYVCPg&amp;prev_fmts=0x0&amp;nras=1&amp;correlator=4470929150298&amp;frm=20&amp;pv=1&amp;ga_vid=1207935776.1672639231&amp;ga_sid=1674451983&amp;ga_hid=269590432&amp;ga_fc=1&amp;u_tz=360&amp;u_his=1&amp;u_h=1080&amp;u_w=1920&amp;u_ah=1040&amp;u_aw=1920&amp;u_cd=24&amp;u_sd=1&amp;dmc=8&amp;adx=222&amp;ady=449&amp;biw=1903&amp;bih=969&amp;scr_x=0&amp;scr_y=0&amp;eid=44759876%2C44759927%2C44759837%2C31071546%2C31071581%2C44779794%2C31071662&amp;oid=2&amp;pvsid=2665657069420571&amp;tmod=821244725&amp;uas=0&amp;nvt=1&amp;ref=https%3A%2F%2Falison.com%2Ftopic%2Flearn%2F69367%2Fthe-fundamentals-of-caregiving-lesson-summary&amp;eae=0&amp;fc=1920&amp;brdim=1920%2C0%2C1920%2C0%2C1920%2C0%2C1920%2C1040%2C1920%2C969&amp;vis=1&amp;rsz=o%7Co%7CpeE%7C&amp;abl=NS&amp;pfx=0&amp;fu=128&amp;bc=31&amp;ifi=2&amp;uci=a!2&amp;fsb=1&amp;xpc=vjMIqVSjSc&amp;p=https%3A//alison.com&amp;dtd=290" data-google-container-id="a!2" data-google-query-id="CIPh-LOE3fwCFRWGcAodmqcO4g" data-load-complete="true"></iframe>';
    }
}
add_shortcode( 'foy_bottom_add', 'bottom_add' );


function add_section(){  
    $sub = 0;
    // $sub = get_user_subscription();
    if ($sub == 1) { ?>
        <div class="foy_adv_section" id="ad-div">
            <div class="foy-add-content">
                <div class="foy-add" id="foy-add">
                    
                </div>
                <div class="foy-add-bottom">
                    <button href="#" id="remove-ad">Remove Add</button>
                    <button id="hide-ad">Start Topic</button>
                </div>
            </div>
            <span id="timer-label"></span>
        </div>
    <?php  } 
     
}
add_shortcode( 'foy_add_section', 'add_section' );

//ajax request to add product
// function foy_add_certificate_action() {
// 	// $product_id =  $_POST['product_id'];
//     // $course_name = $_POST['course_name'];
//     // $user = $_POST['user'];
//     // $email = $_POST['email'];
//     var_dump("jksdb");
//     $product_id = 522;
//     // $course_name = 'hello';
//     // $user = 1;
//     // $email = 'dasb@gmail.com';
//     WC()->cart->add_to_cart( $product_id, 1 );
// 	die();
// }
 
// add_action('wp_ajax_foy_add_certificate','foy_add_certificate_action');
// add_action('wp_ajax_nopriv_foy_add_certificate','foy_add_certificate_action');

function foy_add_certificate_action() {
    // var_dump($_POST);
    $quantity = 1;
    $variation_id = '';
    $variation = array();
    $products = $_POST['products'];

    $courses = $_POST['courses'];
    $users = $_POST['users'];

    $custom_input_3 = $_POST['email'];
    $i = 0;
    foreach($products as $product){
        $custom_input_1 = $courses[$i];
        $custom_input_2 = $users[$i];
        $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product, $quantity, $variation_id, $variation );
        if ( $passed_validation ) {
            do_action( 'woocommerce_before_add_to_cart', $product, $quantity, $variation_id, $variation );
            $cart_item_key = WC()->cart->add_to_cart( $product, $quantity, $variation_id, $variation, array( 'custom_input_1' => $custom_input_1, 'custom_input_2' => $custom_input_2, 'custom_input_3' => $custom_input_3 ) );
            do_action( 'woocommerce_after_add_to_cart', $cart_item_key, $product, $quantity, $variation_id, $variation );
        }
        $i++;
    }
    wp_send_json_success();
    wp_die();
}
 
add_action('wp_ajax_foy_add_certificate','foy_add_certificate_action');
add_action('wp_ajax_nopriv_foy_add_certificate','foy_add_certificate_action');
 
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

// function exclude_category_home( $query ) {
//     // if ( $query->is_home ) {
//     $query->set( 'course-cat', '-46, -9, -23' );
//     $query->set( 'posts_per_page', 2 ); 

//     // }
//     return $query;
// }
// add_filter( 'pre_get_posts', 'exclude_category_home' );

function get_page_id(){
    global $post;
    if(!$foy_mark){

    }
    $foy_mark = 0;
    $page_id = $post->ID;
    if($page_id == 0){
        $foy_mark == 1;
    }
    return $foy_mark;
}
function exclude_courses_from_category($query) {
    global $post;
    $page_id = $post->ID;
    // var_dump( $page_id);
    var_dump(is_post_type_archive( 'course' ));
    var_dump( is_page( 'all-courses' ) );
    var_dump( is_page( 0 ) );
    var_dump( is_admin() );

    if( (!bp_is_my_profile() && !is_admin())    ){
        $tax_query = array(
            array(
                'taxonomy' => 'course-cat',
                'field'    => 'term_id',
                'terms'    => array(46),
                'operator' => 'NOT IN',
            ),
        );
        $query->set('tax_query', $tax_query);
    }
}
add_action('pre_get_posts', 'exclude_courses_from_category');
 
 

function foyez_ali()
{
    var_dump(is_admin());
   

    $args = array(
        'post_type' => 'course',
        'post_status' => 'publish',
        'order' => 'DESC',
        'posts_per_page' => 10,
    );
    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) {
		while ($the_query->have_posts()) : $the_query->the_post();
			$meta = get_post_meta(get_the_ID());
			$product_meta = get_post_meta(get_the_ID(), 'vibe_students', true);
	?>
			<div class="foy-course-list col-md-4" onclick="courseClicked(this)">
				<?php
                    $default =  get_theme_file_uri('/assets/images/defaultCourse.png');
                    $image_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                    $img_url = $image_url ? $image_url : $default;
				?>
				<img src="<?php echo $img_url; ?>" style="height: 200px; width: 200px;">
				<p id="<?php echo get_the_ID()?>"><?php the_title(); ?></p>
			</div>
			<hr>
	<?php endwhile;
		wp_reset_postdata();
	}else{
        echo "no course data available";
    }
}
add_shortcode('foy_courses', 'foyez_ali');
 
 