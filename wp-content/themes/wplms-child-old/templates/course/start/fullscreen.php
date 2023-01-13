<?php


// COURSE STATUS : 
// 0 : NOT STARTED 
// 1: STARTED 
// 2 : SUBMITTED
// > 2 : EVALUATED

// VERSION 1.8.4 NEW COURSE STATUSES
// 1 : START COURSE
// 2 : CONTINUE COURSE
// 3 : FINISH COURSE : COURSE UNDER EVALUATION
// 4 : COURSE EVALUATED

if (!defined('ABSPATH')) exit;

/**
 * wplms_before_start_course hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action('wplms_before_start_course');

get_header('blank');

/**
 * wplms_before_course_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
$user_id = get_current_user_id();
?>

<style>
    #content.unit_content_section {
        background: #f3f6f7;
        min-height: 650px;
        padding-top: 30px;
        position: relative;
        margin-top: 75px;
    }

    .unit_menu_section {
        background: #fff;
        height: 75px;
        padding: 5px 0px;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 9999;
    }

    .unit_sidebar {
        text-align: center;
    }

    .unit_sidebar img {
        width: 80%;
    }

    #unit_content {
        margin: 0;
        padding: 25px !important;
        height: auto;
    }

    .unit_module_progress {
        font-size: 13px;
        font-weight: bold;
        margin: 0;
    }

    .unit_module_progress span {
        font-weight: normal;
    }

    .unit_module_progress span:first-child {
        margin-left: 60px;
    }

    .unit_status_userbar {
        display: flex;
    }

    .course_percent {
        width: 70%;
        padding-right: 30px;
        margin-top: 15px;
    }

    .unit_user_profile {
        width: 30%;
        display: flex;
        justify-content: end;
        padding-top: 7px;
    }

    .course_progressbar.progress {
        margin: 10px 0 0;
        width: 85%
    }

    .unit_user_icon {
        width: 40px;
        height: 40px;
        border: 2px solid #f99d27;
        padding: 6px;
        border-radius: 50%;
        text-align: center;
        color: #f99d27;
    }

    .unit_user_icon:hover {
        background-color: #f99d27;
        cursor: pointer;
        color: #fff;
    }

    .unit_user_icon i {
        font-size: 25px;
    }

    .unit_profile_sec img {
        height: 40px;
        border: 2px solid #b3bdc0;
        border-radius: 50%;
        margin-left: 10px;
    }

    .progress .bar span {
        padding: 2px 8px;
    }

    .course_timeline {
        margin: 0;
    }

    .units_menu {
        position: relative;
    }

    .units_menu h3 {
        color: #465159;
        cursor: pointer;
        font-size: 20px;
        font-weight: 700;
        letter-spacing: .02px;
        margin-bottom: 0;
        padding: 13px 0 11px;
        text-align: left;
        margin-top: 5px;
    }

    .units_menu h3 i {
        padding-right: 10px;
    }

    /**
 * profile_modals ($profile_modals)
 */

    /* 1. Ensure this sits above everything when visible */
    .profile_modal {
        position: absolute;
        z-index: 10000;
        top: 90px;
        left: 0;
        visibility: hidden;
        width: 100%;
        height: 100%;
    }

    .profile_modal.is-visible {
        visibility: visible;
    }

    .profile_modal-overlay {
        position: fixed;
        z-index: 10;
        top: 78px;
        left: 0;
        width: 100%;
        height: 100%;
        background: hsla(0, 0%, 0%, 0.5);
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s linear 0.3s, opacity 0.3s;
    }

    .profile_modal.is-visible .profile_modal-overlay {
        opacity: 1;
        visibility: visible;
        transition-delay: 0s;
    }

    .profile_modal-wrapper {
        position: absolute;
        z-index: 9999;
        top: 0px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 3px 6px rgb(0 0 0 / 20%);
        padding-bottom: 19px;
        right: 20px;
        transition: right .3s ease-in-out;
        width: 332px;
    }

    .profile_modal-transition {
        transition: all 0.3s 0.12s;
        transform: translateY(-10%);
        opacity: 0;
    }

    .profile_modal.is-visible .profile_modal-transition {
        transform: translateY(0);
        opacity: 1;
    }

    .profile_modal-header {
        padding: 18px 0 18px 16px;
    }

    .profile_modal-header {
        position: relative;
        background-color: #fff;
        box-shadow: 0 1px 2px hsla(0, 0%, 0%, 0.06);
        border-bottom: 1px solid #e8e8e8;
        border-radius: 15px 15px 0 0;
    }

    .profile_modal-close {
        position: absolute;
        top: 0;
        right: 0;
        padding: 1em;
        color: #aaa;
        background: none;
        border: 0;
    }

    .profile_modal-close:hover {
        color: #777;
    }

    .profile_modal-heading {
        font-size: 1.125em;
        margin: 0;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .profile_modal-content>*:first-child {
        margin-top: 0;
    }

    .profile_modal-content>*:last-child {
        margin-bottom: 0;
    }

    .profile_modal-toggle {
        cursor: pointer;
    }


    /**
 * USD profile ($usd_modals)
 */

    /* 1. Ensure this sits above everything when visible */
    .usd_modal {
        position: absolute;
        z-index: 10000;
        top: 80px;
        left: 0;
        visibility: hidden;
        width: 100%;
        height: 100%;
    }

    .usd_modal.is-visible {
        visibility: visible;
    }

    .usd_modal-overlay {
        position: fixed;
        z-index: 10;
        top: 77px;
        left: 0;
        width: 100%;
        height: 100%;
        background: hsla(0, 0%, 0%, 0.5);
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s linear 0.3s, opacity 0.3s;
    }

    .images_for_usd img {
        margin: 7px 12px 0 0;
    }

    .content_for_usd p {
        line-height: 21px;
        margin-bottom: 20px;
        font-weight: 400;
        font-size: .875em;
    }

    .usd_modal.is-visible .usd_modal-overlay {
        opacity: 1;
        visibility: visible;
        transition-delay: 0s;
    }

    .usd_modal-wrapper {
        position: absolute;
        z-index: 9999;
        top: 1em;
        right: 50px;
        width: 464px;
        margin-left: -16em;
        background-color: #fff;
        box-shadow: 0 3px 6px rgb(0 0 0 / 29%);
        border-radius: 12px;
        padding: 0 7px;
    }

    .usd_modal-transition {
        transition: all 0.3s 0.12s;
        transform: translateY(-10%);
        opacity: 0;
    }

    .usd_modal.is-visible .usd_modal-transition {
        transform: translateY(0);
        opacity: 1;
    }

    .usd_modal-content {
        display: flex;
    }

    .usd_modal-header,
    .usd_modal-content {
        padding: 0em;
    }

    .usd_modal-header {
        position: relative;
        background-color: #fff;
        box-shadow: 0 1px 2px hsla(0, 0%, 0%, 0.06);
        border-bottom: 1px solid #e8e8e8;
        border-radius: 15px 15px 0 0;
    }

    .usd_modal-close {
        position: absolute;
        top: 0;
        right: 0;
        padding: 5px 10px 0 0;
        color: #aaa;
        background: none;
        border: 0;
    }

    .usd_modal-close:hover {
        color: #777;
    }

    .usd_modal-heading {
        font-size: 1.125em;
        margin: 0;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .content_for_usd {
        width: 50%;
        padding: 10px 0;
    }

    .content_for_usd button {
        background: #f99d27;
        border-radius: 20px;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        font-size: 14px;
        font-weight: 500;
        padding: 10.5px;
        text-align: center;
        width: 178px;
        border: none;
    }

    .usd_modal-content>*:first-child {
        margin-top: 0;
    }

    .usd_modal-content>*:last-child {
        margin-bottom: 0;
    }

    .usd_modal-toggle {
        cursor: pointer;
    }

    .unit_module_menu {
        display: none;
    }

    .unit_module_visible {
        display: block;
        background-color: #fff;
        width: 380px;
        padding: 20px;
        box-shadow: 0 3px 8px 0 rgb(50 50 50 / 20%);
        position: absolute;
        z-index: 99;
        top: 65px;
    }

    .unit_items_menu {
        position: absolute;
        background: white;
        width: 380px;
        padding: 20px;
        box-shadow: 0 3px 8px 0 rgb(50 50 50 / 20%);
        margin-left: 360px;
        top: 0;
    }

    .unit_line {
        display: none;
    }

    .minimal .course_timeline .section {
        border-bottom: none;
        border-top: 1px solid rgba(0, 0, 0, .08);
    }

    .course_timeline ul li {
        cursor: pointer;
    }

    .course_timeline li a {
        color: rgb(0 0 0 / 72%) !important;
    }

    .course_timeline {
        border: none;
        border-radius: 2px;
        background: #fff !important;
        margin: 0px 0;
        padding-bottom: 0px;
        position: relative;
    }

    .course_timeline h4 {
        padding: 15px 10px;
    }

    .page-template-start .course_timeline h4,
    .minimal .course_timeline li h4 {
        color: #000;
    }

    .course_timeline li+li.section,
    .course_timeline li.section+li {
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .page-template-start .course_timeline h4 {
        background-color: #fff;
    }

    .course_timeline h4,
    .course_timeline li a {
        font-size: 18px !important;
        text-transform: capitalize;
        color: rgba(255, 255, 255, .8);
        font-weight: 600;
    }

    .unit_user_meta {
        display: flex;
    }

    .user_unit_img {
        height: 60px;
        width: 60px;
        border: none;
    }

    .user_unit_img img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }

    .user_unit_name h2 {
        margin-top: 6px;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 8px;
        margin-left: 15px;
    }

    .user_unit_name a {
        margin-left: 15px;
        color: #010101;
    }

    .user_unit_name a:hover {
        color: #f99d27;
    }

    .profile_modal-content ul li a img {
        background: #eaeff4;
        border-radius: 100%;
        display: inline-flex;
        height: 36px;
        justify-content: center;
        margin-right: 16px;
        min-width: 36px;
        padding-top: 0;
        text-align: center;
        width: 36px;
    }

    .profile_modal-content ul li a {
        align-items: center;
        color: #1b232e;
        display: flex;
        flex-wrap: wrap;
        font-size: 14px;
        padding: 9px 0 9px 24px;
    }

    .profile_modal-content ul li a:hover {
        font-weight: 500;
    }

    .unit_menu_list {
        padding: 15px 0;
    }

    .for-pc {
        display: initial;
    }

    .for-mobile {
        display: none;
    }

    @media screen and (max-width: 991px) and (min-width: 768px) {}

    @media screen and (max-width: 767px) and (min-width: 481px) {}

    @media screen and (max-width: 991px) and (min-width: 320px) {
        .unit_user_profile {
            width: 25%;
            position: absolute;
            top: -101px;
            right: 18px;
        }

        .logo-part {
            box-shadow: 0 3px 6px rgb(0 0 0 / 8%);
            padding: 0px 0 0 7px;
        }

        .course_progressbar.progress {
            margin: 0;
        }

        .progress .bar span {
            display: none;
        }

        .profile_modal-overlay,
        .usd_modal-overlay {
            top: 55px;
        }

        .profile_modal-wrapper {
            top: -20px;
            right: 36px;
        }

        .usd_modal-wrapper {
            top: 0em;
            right: 5px;
            width: 400px;
        }

        .unit_module_progress {
            display: none;
        }

        .course_percent {
            width: 100%;
            padding-right: 0;
            margin-top: 0;
        }

        .course_progressbar.progress .bar {
            background: #f99d27;
        }

        .for-pc {
            display: none;
        }

        .for-mobile {
            display: initial;
            background: #374651;
            color: white;
            padding: 6px 6px 6px 10px;
            border-radius: 50%;
            width: 29px;
            text-align: center;
            margin: auto;
            font-size: 15px;
        }

        .units_menu h3 i {
            padding-right: 15px !important;
            margin-right: 0;
        }

        .units_menu h3 {
            display: flex;
            justify-content: end;
            padding: 10px 0 5px;
        }

        #content.unit_content_section {
            margin-top: 120px;
        }

        .units_menu h3 {
            font-size: 18px;
        }

        .forMobileSidebarAds {
            display: flex;
            padding: 40px 10px;
        }

        .forMobileSidebarAds div {
            padding: 0px;
        }

        .forMobileSidebarAds div img {
            width: 90%;
        }


    }
</style>

<section class="unit_menu_section">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3 logo-part">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.png" alt="" width="160px">
            </div>
            <div class="col-md-6 module-part">
                <div class="units_menu">
                    <h3><i class="fa fa-caret-down for-pc" aria-hidden="true"></i> Select Course Module for Learnig <i class="fa fa-caret-down for-mobile" aria-hidden="true"></i></h3>
                    <div id="menuToggle" class="unit_module_menu">
                    </div>
                </div>
            </div>
            <div class="col-md-3 unit_status_userbar">
                <div class="course_percent">
                    <h3 class="unit_module_progress">Module Progress </h3>
                    <?php
                    // global $post;
                    // $uid = 206;
                    // $course_id = bp_course_get_unit_course_id($uid);
                    // $user_id = get_current_user_id();
                    // $progress = bp_course_get_user_progress($user_id, $course_id);
                    // echo $progress . 'hello';
                    ?>
                </div>
                <div class="unit_user_profile">
                    <div>
                        <div class="unit_user_icon usd_modal-toggle"><i class="fa fa-usd" aria-hidden="true"></i></div>
                    </div>
                    <div class="unit_profile_sec">
                        <?php
                        $user = wp_get_current_user();

                        if ($user) :
                        ?>
                            <img class="profile_modal-toggle" src="<?php echo esc_url(get_avatar_url($user->ID)); ?>" alt="" />
                        <?php endif; ?>
                        <!-- <img class="profile_modal-toggle" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/27661367.png" alt=""> -->
                    </div>
                </div>
            </div>



        </div>
    </div>
</section>

<div class="usd_modal">
    <div class="usd_modal-overlay usd_modal-toggle"></div>
    <div class="usd_modal-wrapper usd_modal-transition">
        <div class="xusd_modal-header">
            <button class="usd_modal-close usd_modal-toggle">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
            <!-- <h2 class="usd_modal-heading">This is a USD</h2> -->
        </div>

        <div class="usd_modal-body">
            <div class="usd_modal-content">
                <div class="images_for_usd">
                    <img src="https://alison.com/html/site/img/affiliates/not-affiliate.svg" alt="">
                </div>
                <div class="content_for_usd">
                    <p>Become an Alison Affiliate in one click, and start earning money by sharing any page on the Alison website.</p>
                    <button class="usd_modal-toggle">Become an Affiliate</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="profile_modal">
    <div class="profile_modal-overlay profile_modal-toggle"></div>
    <div class="profile_modal-wrapper profile_modal-transition">
        <div class="profile_modal-header">
            <button class="profile_modal-close profile_modal-toggle">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
            <div class="unit_user_meta">
                <div class="user_unit_img">
                    <?php
                    $user = wp_get_current_user();

                    if ($user) :
                    ?>
                        <img src="<?php echo esc_url(get_avatar_url($user->ID)); ?>" />
                    <?php endif; ?>
                </div>
                <div class="user_unit_name">

                    <h2>
                        <?php


                        $username = get_user_meta($user_id);

                        $fname = $username['first_name'][0] ?? '';
                        $lname = $username['last_name'][0] ?? '';
                        $fullname =  ($fname != '' && $lname != '') ? $fname . ' ' . $lname : 'Set Your Name';
                        echo $fullname;


                        // if ($username['first_name'][0] || $username['last_name'][0]) {
                        //     echo $username['first_name'][0] . ' ' . $username['last_name'][0];
                        // } else {
                        //     echo 'User Name Empty';
                        // }

                        ?>
                    </h2>
                    <a href="#">View Your Alison Profile</a>
                </div>
            </div>
        </div>

        <div class="profile_modal-body">
            <div class="profile_modal-content">
                <ul class="unit_menu_list">
                    <li><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/dashboard.svg" alt="dashboard">Your Dashboard</a></li>
                    <li><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/your-certificates.svg" alt="Certificates">Get Your Certificates</a></li>
                    <li><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/your-resume.svg" alt="Resumé">Create Your Resumé</a></li>
                    <li><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/help.svg" alt="Help">Help</a></li>
                    <li><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/settings.svg" alt="settings">Settings</a></li>
                    <li><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logout.svg" alt="logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>




<section id="content" class="unit_content_section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6 unit_sidebar">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Screenshot_1.png" alt="">
            </div>
            <div class="col-md-6 col-sm-12 xcourse_content_panel">
                <?php do_action('wplms_before_course_main_content'); ?>
                <div class="course_content_panel_content">
                    <?php

                    if (have_posts()) : while (have_posts()) : the_post();
                            /**
                             * wplms_unit_content hook.
                             *
                             * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                             * @hooked woocommerce_breadcrumb - 20
                             */
                            do_action('wplms_unit_content');
                        endwhile;
                    endif;

                    /**
                     * wplms_unit_controls hook.
                     *
                     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                     * @hooked woocommerce_breadcrumb - 20
                     */
                    do_action('wplms_unit_controls');
                    ?>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 unit_sidebar">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Screenshot_2.png" alt="">
            </div>
            <div class="forMobileSidebarAds"></div>
            <!-- <div id="hideshow_course_pursue_panel"><span></span></div> -->
            <div class="course_pursue_panel">
                <div class="course_pursue_panel_content">

                    <?php

                    // $postInfo = get_post_meta(109);
                    // var_dump($postInfo);

                    /**
                     * wplms_course_action_points hook.
                     *
                     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                     * @hooked woocommerce_breadcrumb - 20
                     */
                    do_action('wplms_course_action_points');
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    var subscription = 0;
    // next_unit.addEventListener('click', hideUnit);
    // if(subscription == 0){
    const unitWrapper = document.getElementById('unit-wrap');
    // const next_unit = document.getElementById('next_unit');
    const units = document.querySelectorAll('.unit');
    const unitsArray = Array.from(units);
    document.getElementById('unit-wrap').classList.add('hide-unit');
    for (let i = 0; i < units.length; i++) {
        unitsArray[i].addEventListener('click', hideUnit);
    }

    document.getElementById('hide-ad').addEventListener('click', showUnit);

    function hideUnit() {
        jQuery(document).ajaxStop(function() {
            clearInterval(timer);
            startTimer();
            document.getElementById('unit-wrap').classList.add('hide-unit');
            document.getElementById('ad-div').classList.remove('hide-unit');
        });
    }

    function showUnit() {
        document.getElementById('unit-wrap').classList.remove('hide-unit');
        document.getElementById('ad-div').classList.add('hide-unit');
    }
    var timer;

    function startTimer() {
        // Disable the button
        document.getElementById("hide-ad").disabled = true;

        // Set the timer interval (in milliseconds)
        var interval = 1000;

        // Set the timer countdown (in seconds)
        var countdown = 11;

        // Set the timer label
        var timerLabel = document.getElementById("timer-label");

        // Initialize the timer
        timer = setInterval(function() {
            // Decrement the countdown
            countdown--;

            // Update the timer label
            timerLabel.innerHTML = countdown + " seconds remaining";

            // If the countdown reaches 0, stop the timer
            if (countdown === 0) {
                clearInterval(timer);
                timerLabel.innerHTML = "";
                // Enable the button
                document.getElementById("hide-ad").disabled = false;
            }
        }, interval);
    }
    startTimer();
    // }
</script>

<script>
    (function($) {
        // alert('hello arif');    
        $('.course_action_points .course_progressbar').appendTo($('.course_percent'));
        $('.course_timeline').appendTo($('.unit_module_menu'));
        $('.progress div span').appendTo($('.unit_module_progress'));
        $('.unit_module_progress').append('<span> Complete</span>');
        $('.course_pursue_panel').remove();

        // for menu style
        $('.units_menu h3').on('click', function(e) {
            e.preventDefault();
            $('.unit_module_menu').toggleClass('unit_module_visible');
        });

        //toggle for profile 
        $('.profile_modal-toggle').on('click', function(e) {
            e.preventDefault();
            $('.profile_modal').toggleClass('is-visible');
        });

        //toggle for usd 
        $('.usd_modal-toggle').on('click', function(e) {
            e.preventDefault();
            $('.usd_modal').toggleClass('is-visible');
        });

        $(".section").click(function() {
            //$(this).siblings('.desc').toggle();
            //var sections = $(this).nextUntil(".section").toggle();
            var sections = $(this).nextUntil(".section").toggle();

            //console.log(sections);
            //sections.prepend('<ul>');
            //var allSelected = $(".section").nextUntil(".section");
            //alert(allSelected);
            //$('.section').after("<p>");
            //$('.section').html("<div>");
        });
        $(".section h4").click(function() {
            document.querySelector('.units_menu h3').innerText = this.innerText;
            $('.units_menu h3').prepend('<i class="fa fa-caret-down for-pc" aria-hidden="true"></i>');
            $('.units_menu h3').append('<i class="fa fa-caret-down for-mobile" aria-hidden="true"></i>');

        });
    })(jQuery);
</script>

<script>
    jQuery(document).ready(function() {
        jQuery(window).on("resize", function(e) {
            checkScreenSize();
        });

        checkScreenSize();

        function checkScreenSize() {
            var newWindowWidth = jQuery(window).width();
            if (newWindowWidth < 991) {

                //jQuery('.unit_sidebar').appendTo($('.sd'));

                var textElements = jQuery('.unit_sidebar');
                jQuery('.unit_sidebar').remove();
                jQuery('.forMobileSidebarAds').html(textElements);
            }
        }
    });
</script>



<?php
/**
 * wplms_after_course_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action('wplms_after_start_course');

get_footer('blank');
