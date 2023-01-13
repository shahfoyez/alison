<?php
global $wpdb;
$args = array(
  'taxonomy' => 'course-cat',
  'hide_empty' => true,
  'parent' => 0,
  'number' => 8,
  'orderby' => 'count',
  'order' => 'DESC',
);
$categories = get_terms( $args );
echo '<pre>';
var_dump($categories);
echo '</pre>';
// dd($categories);

// foreach( $categories as $category ) {
//   $category_name = $category->name;
//   $category_slug = $category->slug;
// }
foreach ($categories as $category) {
  $args = array(
    'taxonomy' => 'course-cat',
    'hide_empty' => false,
    'parent' => $category->term_id
  );
  $subcategories = get_terms($args);
 

  // Print the category name
  echo $category->name;
  echo "<br>";

  // Print the subcategory names
  foreach ($subcategories as $subcategory) {
    echo $category->name." Subcategory ".$subcategory->name;
    echo "<br>";

  }
}
// dd($categories);

 
 
$user = wp_get_current_user();
if (in_array('student', (array) $user->roles)) {

  $user_id = get_current_user_id();

  $pageposts = $wpdb->get_results(apply_filters('wplms_usermeta_direct_query', $wpdb->prepare("
        SELECT posts.ID as id, IF(meta.meta_value > %d,'active','expired') as status
        FROM {$wpdb->posts} AS posts
        LEFT JOIN {$wpdb->usermeta} AS meta ON posts.ID = meta.meta_key
        WHERE   posts.post_type   = %s
        AND   posts.post_status   = %s
        AND   meta.user_id   = %d
        ", time(), 'course', 'publish', $user_id)));

  if ($pageposts) {
    $singleCourseArray = [];
    $allCourseArray = [];
    $term_list = [];
    $valCatID = [];
    $count = 0;
    foreach ($pageposts as $singleCourse) {
      $count++;
      if ($count == 1) {
        $singleCourseArray[] = $singleCourse->id;
      }
    }
    foreach ($pageposts as $allCourse) {
      $allCourseArray[] = $allCourse->id;

      $cat = get_the_terms($allCourse->id, 'course-cat');
      $term_list[] =  wp_list_pluck($cat, 'slug');
    }
    foreach ($term_list as $terms) {
      $valCatID[] = $terms[0];
    }
  } else {
    echo '<h2>Not found any Data</h2>';
  }

?>

  <div class="ar-main-content">
    <div class="ar-sidebar" id="#ar-id-side">

      <div class="sidebar-user-data">
        <div class="user_avatar_img">
          <?php
          $user = wp_get_current_user();

          if ($user) :
          ?>
            <img src="<?php echo esc_url(get_avatar_url($user->ID)); ?>" alt="" />
          <?php endif; ?>
        </div>
        <h4 class="sidebar-user-name">
          <?php
          $username = get_user_meta($user_id);
          $fname = $username['first_name'][0] ?? '';
          $lname = $username['last_name'][0] ?? '';
          $fullname =  ($fname != '' && $lname != '') ? $fname . ' ' . $lname : 'Set Your Name';
          echo $fullname;
          ?></h4>
        <a class="user-profile-link"><span class="new-badge"><?php echo $user->user_email; ?></span></a>
        <h6 class="user-id">User Id : <span><?php echo $user_id; ?></span> </h6>
      </div>

      <ul class="menu-list" id="idforactive">


        <li class="common-design">
          <a href="#tab_default_1" data-toggle="tab" class="common-design-2">
            <i class="fa fa-heart side-icon" aria-hidden="true"></i> For You
          </a>
        </li>

        <li class="common-design activemenu">
          <a href="#tab_default_2" data-toggle="tab" class="common-design-2">
            <i class="fa fa-th side-icon" aria-hidden="true"></i> Dashboard
          </a>
        </li>

        <!-- <li class="common-design">
                  <a href="#tab_default_3" data-toggle="tab"  class="common-design-2"> 
                    <i class="fa fa-file-text side-icon"></i> Resumé Builder 
                  </a>
                </li> -->

        <!-- <li class="common-design">
                  <a href="#tab_default_4" data-toggle="tab"  class="common-design-2"> 
                    <i class="fa fa-line-chart side-icon"></i> Learner Report 
                  </a>
                </li> -->

        <hr class="hrwdth">

        <li class="common-design">
          <a href="#tab_default_5" data-toggle="tab" class="common-design-2">
            <i class="fa fa-magic  side-icon"></i> Upgrade to Premium
          </a>
        </li>

        <li class="common-design">
          <a href="#tab_default_6" data-toggle="tab" class="common-design-2">
            <i class="fa fa-trophy  side-icon"></i> Get Certification
          </a>
        </li>

        <hr class="hrwdth">

        <li class="common-design">
          <a href="#tab_default_7" data-toggle="tab" class="common-design-2">
            <i class="fa fa-cogs  side-icon"></i> Account Settings
          </a>
        </li>

        <li class="common-design">
          <a href="#tab_default_8" data-toggle="tab" class="common-design-2">
            <i class="fa fa-plus-square  side-icon"></i> Help
          </a>
        </li>

      </ul>
      <a href="<?php echo wp_logout_url(home_url()); ?>" class="common-design-2 logout-link">
        <i class="fa fa-power-off  side-icon"></i> Logout
      </a>



    </div>
    <div id="ar-sidebar-btn">
      <span></span>
      <span></span>
      <span></span>
    </div>

    <div class="ar-content">

      <div class="tab-content">

        <div class="tab-pane" id="tab_default_1">

          <div class="ar-banner-cmn">
            <div class="titandtx">
              <h1 class="bn-title">My Courses</h1>
            </div>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/dashboard-top-right-img.svg" class="imgclass" alt="">
          </div>
          <div class="container">

            <div class="ar-othr-crsOvrflx">

              <?php
              if ($allCourseArray) :
                foreach ($allCourseArray as $allCourse) :
                  setup_postdata($allCourse);
              ?>
                  <div class="ar-cntn-fll ar-mrg-btm">
                    <?php
                    $imgbg = get_the_post_thumbnail_url($allCourse);
                    $imgLc = get_stylesheet_directory_uri() . '/assets/img/428x320.jpg';
                    ?>
                    <img src="<?php if ($imgbg) {
                                echo $imgbg;
                              } else {
                                echo $imgLc;
                              } ?>" class="ar-crs-img">

                    <div class="ar-crs-dt">
                      <h4 class="ar-crs-ttl"><b><?php echo get_the_title($allCourse); ?></b></h4>

                      <div class="ar-crs-prgr">
                        <?php
                        $progress = bp_course_get_user_progress($user_id, $allCourse);
                        ?>
                        <progress max="100" value="<?php echo $progress; ?>" class="prog ar-prgwd">
                        </progress>
                        <h5 class="ar-crs-cmplt"><b>
                            <?php
                            if (empty($progress)) {
                              echo '0';
                            } else {
                              echo $progress;
                            }
                            ?> % </b> Complete</h5>
                      </div>

                      <h5 class="ar-crs-btmsub"><b>Last active:</b><?php
                                                                    //  $active = wplms_user_course_check($user_id,$allCourse);
                                                                    //  var_dump($active);
                                                                    ?> Today</h5>
                    </div>

                    <hr class="hrforline">
                    <div class="ar-btn-lrn">
                      <?php the_course_button($allCourse); ?>
                    </div>

                  </div>
              <?php
                endforeach;
              endif;
              ?>

            </div>
          </div>
        </div>

        <div class="tab-pane active" id="tab_default_2">


          <!-- Banner -->
          <div class="ar-banner">
            <div class="titandtx">
              <h1 class="bn-title">Welcome to your Dashboard</h1>

              <ul class="navtabs">

                <li class="active">
                  <a href="#tab1default" data-toggle="tab" class="linkn">
                    <i class="icon-book nmarg"></i>
                    <span class="long">Learn & Get Certificates</span>
                    <span class="Short">Learn</span>
                  </a>
                </li>

                <li>
                  <a href="#tab2default" data-toggle="tab" class="linkn">
                    <i class="icon-suitcase nmarg"></i>
                    <span class="long">Your Runing Offers</span>
                    <span class="Short">Career</span>
                    <span class="notification-badge">3</span>
                  </a>
                </li>

                <li>
                  <a href="#tab3default" data-toggle="tab" class="linkn">
                    <i class="icon-usd nmarg"></i>
                    <span class="long">Earn Now</span>
                    <span class="Short">Earn</span>
                    <span class="notification-badge">1</span>
                  </a>
                </li>

              </ul>

            </div>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/dashboard-top-right-img.svg" class="imgclass" alt="">
          </div>

          <div class="container">
            <div class="tab-content">

              <!-- 1st tab content -->
              <div class="tab-pane fade in active" id="tab1default">

                <div class="panel-body">
                  <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1default">


                      <div class="tab1-full">
                        <h2 class="tab1h">Get Personalised Course & Career Recommendations!</h2>
                        <div class="tab1sub">
                          <p>Tell us what your learning goals and career objectives are, and we will recommend the best courses for you to enrol in. </p>
                        </div>
                        <a href="#" class="btn tab1btn">Get Recommendations</a>
                      </div>

                      <div class="ar-crs-prgrs">

                        <div class="ar-crs-cntnt">



                          <div class="ar-crs-p1h1">
                            <div class="ar-crsr-ttl">Courses In Progress (<?php echo count($allCourseArray); ?>)</div>
                            <div class="ar-crsr-mre">
                              <a href="#open-modal" class="crs-lng">Other Courses In Progress <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/expand_icon.svg"></a>
                              <a href="#open-modal" class="crs-srt" style="display:none;">Other's <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/expand_icon.svg"></a>
                            </div>
                          </div>




                          <div id="open-modal" class="modal-window">
                            <div>
                              <a href="#" title="Close" class="modal-close"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/close.svg" alt="close"></a>

                              <h4 class="modal-title" id="modalLabel"><b>Courses In Progress (<?php echo count($allCourseArray); ?>)</b></h4>

                              <div class="ar-othr-crsOvrfl">

                                <!-- 1 -->
                                <?php
                                if ($allCourseArray) :
                                  foreach ($allCourseArray as $allCourse) :
                                    setup_postdata($allCourse);

                                ?>
                                    <div class="ar-cntn-fll ar-mrg-btm">
                                      <?php
                                      $imgbg = get_the_post_thumbnail_url($allCourse);
                                      $imgLc = get_stylesheet_directory_uri() . '/assets/img/428x320.jpg';
                                      ?>
                                      <img src="<?php if ($imgbg) {
                                                  echo $imgbg;
                                                } else {
                                                  echo $imgLc;
                                                } ?>" class="ar-crs-img">

                                      <div class="ar-crs-dt">
                                        <h4 class="ar-crs-ttl"><b><?php echo get_the_title($allCourse); ?></b></h4>

                                        <div class="ar-crs-prgr">
                                          <?php

                                          $progress = bp_course_get_user_progress($user_id, $allCourse);

                                          ?>
                                          <progress max="100" value="<?php echo $progress; ?>" class="prog ar-prgwd">
                                          </progress>
                                          <h5 class="ar-crs-cmplt"><b><?php
                                                                      if (empty($progress)) {
                                                                        echo '0';
                                                                      } else {
                                                                        echo $progress;
                                                                      }
                                                                      ?> % </b> Complete</h5>
                                        </div>

                                        <h5 class="ar-crs-btmsub"><b>Last active:</b><?php
                                                                                      //  $active = wplms_user_course_check($user_id,$allCourse);
                                                                                      //  var_dump($active);
                                                                                      ?> Today</h5>
                                      </div>

                                      <hr class="hrforline">
                                      <div class="ar-btn-lrn">
                                        <?php the_course_button($allCourse); ?>
                                      </div>

                                    </div>
                                <?php
                                  endforeach;
                                endif;
                                ?>

                              </div>
                            </div>
                          </div>






                          <?php
                          if ($singleCourseArray) :
                            foreach ($singleCourseArray as $OneCourse) :
                              setup_postdata($OneCourse);
                          ?>
                              <div class="ar-cntn-fll">
                                <?php
                                $imgbg = get_the_post_thumbnail_url($OneCourse);
                                $imgLc = get_stylesheet_directory_uri() . '/assets/img/428x320.jpg';
                                ?>
                                <img src="<?php if ($imgbg) {
                                            echo $imgbg;
                                          } else {
                                            echo $imgLc;
                                          } ?>" class="ar-crs-img">

                                <div class="ar-crs-dt">
                                  <h4 class="ar-crs-ttl"><b><?php echo get_the_title($OneCourse); ?></b></h4>

                                  <div class="ar-crs-prgr">
                                    <?php
                                    $progress = bp_course_get_user_progress($user_id, $OneCourse);
                                    ?>
                                    <progress max="100" value="<?php echo $progress; ?>" class="prog ar-prgwd">
                                    </progress>
                                    <h5 class="ar-crs-cmplt"><b>
                                        <?php
                                        if (empty($progress)) {
                                          echo '0';
                                        } else {
                                          echo $progress;
                                        }
                                        ?> % </b> Complete</h5>
                                  </div>

                                  <h5 class="ar-crs-btmsub"><b>Last active:</b><?php
                                                                                //  $active = wplms_user_course_active_check($user_id,$OneCourse);
                                                                                //  var_dump($active);
                                                                                ?> Today</h5>
                                </div>

                                <hr class="hrforline">
                                <div class="ar-btn-lrn">
                                  <?php the_course_button($OneCourse); ?>
                                </div>
                              </div>
                          <?php
                            endforeach;
                          endif;
                          ?>




                        </div>
                      </div>


                      <div class="ar-crs-prgrs" style="margin-top: 30px;">
                        <div class="ar-crsr-ttl">Enrol In Similar Courses</div>
                        <?php


                        $cat_number = 1;
                        $all_course_obj = [];
                        $valCatID = array_unique($valCatID, SORT_STRING);
                        $num_of_cat = count($valCatID);
                        $ppp = floor(6 / $num_of_cat);
                        foreach ($valCatID as $cat) {
                          $related_args = '$related_args_' . $cat_number;

                          $related_args = array(
                            'post_type' => 'course',
                            'posts_per_page' => $ppp,
                            'post_status' => 'publish',
                            'post__not_in'      => $allCourseArray,
                            'orderby'   => 'meta_value_num',
                            'order' => 'DESC',
                            'tax_query' => array(
                              'relation' => 'AND',
                              array(
                                'taxonomy' => 'course-cat',
                                'field' => 'slug',
                                'terms' => $cat
                              )
                            ),
                            'meta_query' => array(
                              array(
                                'key'     => 'vibe_students',
                              ),
                            )
                          );

                          $related_obj = '$related_' . $cat_number;
                          $related_obj = new WP_Query($related_args);
                          $all_course_obj[] = $related_obj;
                        }

                        $related = $all_course_obj;
                        ?>

                        <div class="your-class">
                          <?php
                          // dd($related);
                          foreach ($related as $rel) {

                            if ($rel->have_posts()) :
                          ?>
                              <?php while ($rel->have_posts()) : $rel->the_post(); ?>
                                <div>
                                  <div class="d-flex-simi">
                                    <?php
                                    if (has_post_thumbnail()) {
                                      the_post_thumbnail('', array('class' => 'ar-crs-img'));
                                    } else {
                                      echo '<img src="' . get_stylesheet_directory_uri() . '/assets/img/428x320.jpg" class="ar-crs-img">';
                                    }
                                    ?>
                                    <div class="ar-crs-dt">
                                      <h4 class="ar-crs-ttl"><?php //echo get_post_meta(get_the_ID(), 'vibe_students', true); 
                                                              ?> <b><?php the_title(); ?></b></h4>
                                      <a href="<?php the_permalink(); ?>" class="ar-more-link">More Information <i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                    </div>
                                  </div>
                                </div>
                              <?php endwhile; ?>

                          <?php
                            endif;
                            wp_reset_postdata();
                          }
                          ?>
                        </div>



                      </div>



                      <script type="text/javascript">
                        // jQuery(document).ready(function($) {
                        //   jQuery('.your-class').slick({
                        //     infinite: false,
                        //     slidesToShow: 3,
                        //     slidesToScroll: 1,
                        //     autoplay: false,
                        //     autoplaySpeed: 2000,
                        //     responsive: [{
                        //         breakpoint: 768,
                        //         settings: {
                        //           arrows: true,
                        //           centerMode: true,
                        //           centerPadding: '40px',
                        //           slidesToShow: 2
                        //         }
                        //       },
                        //       {
                        //         breakpoint: 480,
                        //         settings: {
                        //           arrows: true,
                        //           centerMode: true,
                        //           centerPadding: '40px',
                        //           slidesToShow: 1
                        //         }
                        //       }
                        //     ]
                        //   });
                        // });

                        //
                        jQuery(document).ready(function(jQuery) {
                          jQuery('.menu-list li a').click(function(e) {

                            jQuery('.menu-list li.activemenu').removeClass('activemenu');

                            var $parent = jQuery(this).parent();
                            $parent.addClass('activemenu');
                            e.preventDefault();
                          });
                        });
                      </script>


                      <div class="sec4">

                        <div class="box1">
                          <h3 class="sec3h1">Learning Statistics</h3>

                          <div class="Statistics">

                            <div class="st1">

                              <div class="rowhead">
                                <h4 class="tnme">0 Mins</h4>
                                <h5 class="tsub">Your Total Time Learning</h5>
                              </div>

                              <div class="rowheadf">
                                <h5 class="tsubp1">Course Completion Percentage</h5>
                                <h5 class="tsubp">0%</h5>
                              </div>

                              <div class="rowheadf">
                                <a href="#" class="tsubp1">Courses Completed</a>
                                <h5 class="tsubp">
                                  <?php
                                  $compl = bp_course_check_unit_complete(188);
                                  // echo '<pre>';
                                  // var_dump($compl);
                                  // echo '</pre>';
                                  ?>
                                </h5>
                              </div>

                              <div class="rowheadf brdr">
                                <a href="#" class="tsubp1">Courses In Progress</a>
                                <h5 class="tsubp">0</h5>
                              </div>

                            </div>

                            <div class="sttc-2nd">
                              <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/statistics_empty.svg" class="sttcimg">
                              <h5 class="sttcsub">Your biggest competition is yourself! Track your study hours and watch your learning journey.</h5>
                            </div>

                          </div>
                        </div>


                        <div class="box2">
                          <h3 class="sec3h1">Medals</h3>

                          <div class="modtop">
                            <div class="medels">

                              <div class="medsm">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/medals-gold.svg" class="sec4p2-img">
                                <div class="med2tt">
                                  <h4 class="modtnme">Gold</h4>
                                  <h5 class="modtsub">Learn 3 days in a week to earn Gold</h5>
                                </div>
                              </div>

                              <div class="medsm">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/medals-silver.svg" class="sec4p2-img">
                                <div class="med2tt">
                                  <h4 class="modtnme">Gold</h4>
                                  <h5 class="modtsub">Learn 3 days in a week to earn Gold</h5>
                                </div>
                              </div>

                              <div class="medsm">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/medals-bronze.svg" class="sec4p2-img">
                                <div class="med2tt">
                                  <h4 class="modtnme">Gold</h4>
                                  <h5 class="modtsub">Learn 3 days in a week to earn Gold</h5>
                                </div>
                              </div>

                            </div>
                          </div>

                          <div class="modbottom">
                            <h3 class="sec3h2">Next Medal</h3>

                            <div class="medsm1 dis-mbile">
                              <div class="med3tt">
                                <h4 class="mbtname">You are 1 day away from earning</h4>
                              </div>
                            </div>

                            <div class="medels2">

                              <div class="medsm1 dis-none-mbile">
                                <div class="med3tt">
                                  <h4 class="mbtname">You are 1 day away from earning</h4>
                                </div>
                              </div>

                              <div class="medsm2">
                                <progress max="100" value="50" class="prog">

                                </progress>
                              </div>

                              <div class="medsm3">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/medals-bronze-mini.svg" class="miniimg">
                              </div>

                              <div class="medsm4">
                                <div class="med2tt">
                                  <h4 class="modlatsnm">Bronze</h4>
                                </div>
                              </div>

                            </div>

                          </div>

                          <div class="med-button">
                            <a href="#" class="fndcr">
                              Find Another Course
                            </a>
                          </div>

                        </div>

                      </div>

                    </div>
                  </div>
                </div>



              </div>

              <!-- 2nd tab content end -->
              <div class="tab-pane fade" id="tab2default">

                <div class="cards">

                  <div class="card-item">
                    <div class="card-badge">1</div>
                    <div class="card-body">

                      <div class="hdttl">Resume</div>
                      <img class="card-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/resume-builder-illustration.svg" alt="" />
                      <p class="card-text-n">Let employers know how skilled you are with our</p>
                      <a class="btncard" href="">Details</a>
                    </div>
                  </div>

                  <div class="card-item">
                    <div class="card-badge">1</div>
                    <div class="card-body">
                      <div class="hdttl prcolor">Resume</div>
                      <div class="uncardh">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/top-careers.svg">
                        <p class="uhead">Top Career Paths</p>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/top-careers.svg">
                        <p class="uhead">Top Career Paths</p>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/top-careers.svg">
                        <p class="uhead">Top Career Paths</p>
                      </div>
                      <p class="card-text-n">Preferred by 80% employers, take our Workplace Personality Assessment to discover who you truly are</p>
                      <a class="btncard prcolorh" href="">Details</a>
                    </div>
                  </div>

                  <div class="card-item">
                    <div class="card-badge">1</div>
                    <div class="card-body">
                      <div class="hdttl blcolor">Resume</div>
                      <img class="card-img blcolor" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/resume-builder-illustration.svg" alt="" />
                      <p class="card-text-n">Let employers know how skilled you are with our</p>
                      <a class="btncard blcolorh" href="">Details</a>
                    </div>
                  </div>
                </div>

                <div class="panel-body">
                  <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1default">

                      <div class="tab1-full">
                        <h2 class="tab1h">Get Personalised Course & Career Recommendations!</h2>
                        <div class="tab1sub">
                          <p>Tell us what your learning goals and career objectives are, and we will recommend the best courses for you to enrol in. </p>
                        </div>
                        <a href="" class="btn tab1btn">Get Recommendations</a>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <!-- 3rd tab content end -->
              <div class="tab-pane fade" id="tab3default">
                <div class="nav3-hbadge">1</div>
                <div class="panel-body">
                  <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab3default">

                      <div class="tab1-full bgcolr">
                        <h2 class="tab3h">Learn, Share And Earn!</h2>
                        <h2 class="tab3sub">Join The Skillwise Affiliate Programme</h2>
                        <div class="tab1sub">
                          <p>By becoming an Skillwise Affiliate
                            Programme Member, you can earn income
                            for yourself AND help empower others by
                            introducing them to free learning and the
                            other services we provide.</p>
                        </div>
                        <button class="btn tab3btn">Become An Affiliate Member</button>
                      </div>

                    </div>
                  </div>
                </div>

                <h2 class="tab1h2" id="tab3default">Attend Skillwise’s Free Webinar on the Affiliate Programme</h2>

                <div class="carditemlast">
                  <div class="cardbodylast">

                    <div class="lastheader">
                      <div class="titllast3">Introducing The Skillwise Affiliate Programme</div>
                      <div class="badgelast3">FREE</div>
                    </div>

                    <div class="middleheader">

                      <div class="onem">
                        <div class="iclast3"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/calendar.svg"></div>
                        <div class="datewla">November 24</div>
                      </div>

                      <div class="onem">
                        <div class="iclast3"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Time.svg"></div>
                        <div class="timewla">21:00 (GMT+6)</div>
                      </div>

                    </div>

                    <p class="card-text-n">Speak directly with an Affiliate representative to learn more about earning an income while empowering millions around the world.</p>

                    <div class="prflpost">

                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/0fZUSA3dMREmeGJLhVQS1648478387.png" class="ppostimg">

                      <div class="ppost">
                        <h4 class="ppostttl">Mustafa Ali Khan</h4>
                        <h5 class="ppostsub">Speaker</h5>
                      </div>

                    </div>

                    <a class="btncard rgrcolor" href="#">Register Now</a>

                  </div>
                </div>

              </div>
            </div>
          </div>


        </div>

        <!-- <div class="tab-pane" id="tab_default_3">
                <div class="ar-banner-cmn">
                  <div class="titandtx">
                    <h1 class="bn-title">Resume Builder</h1>
                  </div>
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/dashboard-top-right-img.svg" class="imgclass" alt="">
                </div>                     
            </div> -->

        <!-- <div class="tab-pane" id="tab_default_4">
                <div class="ar-banner-cmn">
                  <div class="titandtx">
                    <h1 class="bn-title">Learner Report</h1>
                  </div>
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/dashboard-top-right-img.svg" class="imgclass" alt="">
                </div>
            </div> -->

        <div class="tab-pane" id="tab_default_5">
          <div class="ar-banner-cmn">
            <div class="titandtx">
              <h1 class="bn-title">Upgrade to Premium</h1>
            </div>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/dashboard-top-right-img.svg" class="imgclass" alt="">
          </div>
        </div>

        <div class="tab-pane" id="tab_default_6">
          <div class="ar-banner-cmn">
            <div class="titandtx">
              <h1 class="bn-title">My Certificates</h1>
            </div>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/dashboard-top-right-img.svg" class="imgclass" alt="">
          </div>
          <div class="container">
            <div id="item-body">
              <?php wplms_show_profile_snapshot(); ?>
            </div>
            <div class="get_certificates">
              <div class="tab1-full">
                <h2 class="tab1h">Get Personalised Certifications & Career Bost!</h2>
                <div class="tab1sub">
                  <p>Tell us what your learning goals and career objectives are, and we will recommend the best courses for you to enrol in. </p>
                </div>
                <a href="#" class="btn tab1btn">Get Certifications</a>
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane" id="tab_default_7">

          <div class="ar-banner-cmn">
            <div class="titandtx">
              <h1 class="bn-title">Profile Settings</h1>
            </div>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/dashboard-top-right-img.svg" class="imgclass" alt="">
          </div>






          <div class="container">
            <?php do_action('bp_template_content'); ?>

            <form action="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/general'; ?>" method="post" class="standard-form" id="settings-form">

              <?php if (!is_super_admin()) : ?>

                <label for="pwd"><?php _e('Current Password <span>(required to update email or change current password)</span>', 'vibe'); ?></label>
                <input type="password" name="pwd" id="pwd" size="16" value="" class="settings-input small" /> &nbsp;<a href="<?php echo wp_lostpassword_url(); ?>" title="<?php _e('Password Lost and Found', 'vibe'); ?>"><?php _e('Lost your password?', 'vibe'); ?></a>

              <?php endif; ?>

              <label for="email"><?php _e('Account Email', 'vibe'); ?></label>
              <input type="text" name="email" id="email" value="<?php echo bp_get_displayed_user_email(); ?>" class="settings-input" />

              <label for="pass1"><?php _e('Change Password <span>(leave blank for no change)</span>', 'vibe'); ?></label>
              <input type="password" name="pass1" id="pass1" size="16" value="" class="settings-input small" /> &nbsp;<?php _e('New Password', 'vibe'); ?><br />
              <input type="password" name="pass2" id="pass2" size="16" value="" class="settings-input small" /> &nbsp;<?php _e('Repeat New Password', 'vibe'); ?>

              <?php do_action('bp_core_general_settings_before_submit'); ?>

              <div class="submit">
                <input type="submit" name="submit" value="<?php _e('Save Changes', 'vibe'); ?>" id="submit" class="auto" />
              </div>

              <?php do_action('bp_core_general_settings_after_submit'); ?>

              <?php wp_nonce_field('bp_settings_general'); ?>

            </form>
          </div>
        </div>

        <div class="tab-pane" id="tab_default_8">
          <div class="ar-banner-cmn">
            <div class="titandtx">
              <h1 class="bn-title">Helpline Corner</h1>
            </div>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/dashboard-top-right-img.svg" class="imgclass" alt="">
          </div>
        </div>

      </div>

    </div>


  </div>


<?php } else { ?>

  <?php
  $header_style =  vibe_get_customizer('header_style');
  if ($header_style == 'transparent' || $header_style == 'generic') {
    echo '<section id="title">';
    do_action('wplms_before_title');
    echo '</section>';
  }
  ?>

  <section id="content">
    <div id="buddypress">
      <div class="<?php echo vibe_get_container(); ?>">
        <div class="row">
          <div class="col-md-3 col-sm-4">
            <?php do_action('bp_before_member_home_content'); ?>
            <div class="pagetitle">
              <div id="item-header" class="<?php
                                            $image = bp_attachments_get_user_has_cover_image();
                                            echo (empty($image) ? '' : 'cover_image') ?>" role="complementary">
                <?php locate_template(array('members/single/member-header.php'), true); ?>

              </div><!-- #item-header -->
            </div>
            <div id="item-nav" class="">
              <div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
                <ul>

                  <?php bp_get_displayed_user_nav(); ?>

                  <?php do_action('bp_member_options_nav'); ?>

                </ul>
              </div>
            </div><!-- #item-nav -->
          </div>

          <div class="col-md-9 col-sm-8 box" style="position: relative;">
            <div class="padder box-body">


            <?php } ?>