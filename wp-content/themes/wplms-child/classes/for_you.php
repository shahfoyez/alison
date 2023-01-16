<?php
	$filepath= realpath(dirname(__FILE__));
	include_once ($filepath.'/Format.php');
?>
<?php
class ForYou {
    private $fm;
    public function __construct() {
        global $wpdb;
        $this->fm=new Format();
        // wp_for_you
    }
    public function getUserSubmit($userId) {
        global $wpdb;
        $table_name = 'wp_for_you';
        $userId =$this->fm->validation($userId);
        // check if user already submitted the data
        $userSubmit = $wpdb->get_results($wpdb->prepare("
            SELECT * 
            FROM wp_for_you
            WHERE user_id = %d", 
            $userId
        ) );
       return $userSubmit;
    }

    public function insert($data, $userId) {
        global $wpdb;
        $table_name = 'wp_for_you';
        $userId =$this->fm->validation($userId);
        
        // check if user already submitted the data
        $userSubmit = $this->getUserSubmit($userId);

        if($userSubmit){
            $msg="<span class='foy-error'>You form has already submitted.</span>";
			return $msg;
        }
        var_dump($userSubmit);
        // main goal
        $mainGoal =$this->fm->validation($data['main-goal']);
        //course cats
        $courseCats = $data['course_cat'];
        $courseCats = implode(',',$courseCats);
        // sub cats
        $subCategories = '';
        $subCatStr = '';
        for($i=0; $i<3; $i++){
            $subCats = $data['course-sub-cat-'.$i];
            foreach($subCats as $subCat ){
                $subCategories = implode(',',$subCats);
            }
            $subCatStr = $subCatStr.','.$subCategories;
        }
        $subCatStr = ltrim($subCatStr, ",");
        // career cats
        $careerCats = $data['career-cat'];
        $careerCats = implode(',',$careerCats);
        // career stage
        $careerStage =$this->fm->validation($data['career-stage']);
        if($mainGoal =="" || $courseCats =="" || $subCatStr =="" || $careerCats =="" || $careerStage =="" || $userId =="" ){
            $msg="<span class='foy-error'>There is some error!</span>";
			return $msg;
        }
        // Insert query
        $insertData = array(
            'main_goal' => $mainGoal,
            'course_cats' => $courseCats,
            'sub_cats' =>  $subCatStr,
            'career_cats' => $careerCats,
            'career_stage' => $careerStage,
            'user_id' => $userId
        );
        $insert = $wpdb->insert($table_name, $insertData);
        if($insert){
            $msg="<span class='foy-success'>Successful! Your form has been submitted successfully</span>";
            var_dump($_SERVER['HTTP_REFERER']);
            // echo "<script>window.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            echo "<script>window.location='".$_SERVER['HTTP_REFERER']."?msg=".$msg."'</script>";
			// return $msg;
        }else{
            $msg="<span class='foy-error'>There is some error!</span>";
			return $msg;
        }
     }
     public function userRecommendedCourse($dataSubmitted) {
        global $wpdb;
        $table_name = 'wp_for_you';
        $courseCats = $dataSubmitted->course_cats;
        $cats = explode(",",$courseCats);

        $subCats = $dataSubmitted->sub_cats;
        $subs = explode(",",$subCats);
        // echo '<pre>';
        // var_dump($cats);
        // echo '</pre>';


        // check if user already submitted the data
        // $args = array(
        //     'post_type' => 'course',
        //     'tax_query' => array(
        //         'relation' => 'OR',
        //         array(
        //             'taxonomy' => 'course-cat',
        //             'field'    => 'term_id',
        //             'terms'    => $cats,
        //         ),
        //         array(
        //             'taxonomy' => 'course-cat',
        //             'field'    => 'term_id',
        //             'terms'    => $subs,
        //         ),
        //     ),
        // );
        // $courses = get_posts( $args );
        // $courses = $wpdb->get_results(
        //     "SELECT p.ID, t.term_id
        //     FROM wp_posts p
        //     JOIN wp_term_relationships tr ON p.ID = tr.object_id
        //     JOIN wp_term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        //     JOIN wp_terms t ON tt.term_id = t.term_id
        //     WHERE p.post_type = 'course'
        //     AND p.ID IN {$cats}
        //     AND tt.taxonomy = 'course-cat'
        //     AND t.term_id IN {$subs}
        //     GROUP BY p.ID",
        //     OBJECT
        // );
        // $courses = $wpdb->get_results("
        //     SELECT * FROM wp_posts 
        //     WHERE ID IN (" . implode(',', $cats) . ") AND post_type = 'course'
        // ");
        // $course_ids = array(47, 48, 49);
        // $courses = $wpdb->get_results("
        //     SELECT * FROM wp_posts 
        //     WHERE ID IN (" . implode(',', $course_ids) . ") AND post_type = 'course'
        // ");

        // $args = array(
        //     'post_type' => 'course',
        //     'tax_query' => array(
        //         'relation' => 'AND',
        //         array(
        //             'taxonomy' => 'course-cat',
        //             'field'    => 'term_id',
        //             'terms'    => $cats,
        //         ),
        //         array(
        //             'taxonomy' => 'course-cat',
        //             'field'    => 'term_id',
        //             'terms'    => $subs,
        //         ),
        //     ),
        //     'orderby' => 'title',
        //     'order'   => 'ASC',
        //     'groupby' => 'title'
        // );
        // $query = new WP_Query( $args );
        // var_dump($query);
    
        /* ensure that the WPLMS plugin is active */
        global $wpdb;


        // $args = array(
        //     'post_type' => 'course',
        //     'tax_query' => array(
        //         'relation' => 'AND',
        //         array(
        //             'taxonomy' => 'course-cat',
        //             'field' => 'term_id',
        //             'terms' => $cats,
        //         ),
        //         array(
        //             'taxonomy' => 'course-cat',
        //             'field' => 'term_id',
        //             'terms' => $subs,
        //             'include_children' => false,
        //         )
        //     ),
        // );
        // $query = new WP_Query( $args );
        
        // $categories = array();
        // if ( $query->have_posts() ) {
        //     while ( $query->have_posts() ) {
        //         $query->the_post();
        //         $terms = wp_get_post_terms( get_the_ID(), 'course-cat' );
        //         foreach ( $terms as $term ) {
        //             if ( ! isset( $categories[ $term->term_id ] ) ) {
        //                 $categories[ $term->term_id ] = array(
        //                     'name' => $term->name,
        //                     'courses' => array(),
        //                 );
        //             }
        //             $categories[ $term->term_id ]['courses'][] = get_the_title();
        //         }
        //     }
        //     wp_reset_postdata();
        // }
     
        global $wpdb;

$courses = $wpdb->get_results(
    $wpdb->prepare("
        SELECT *, t.name as parent_name
        FROM wp_posts p
        INNER JOIN wp_term_relationships tr ON (p.ID = tr.object_id)
        INNER JOIN wp_term_taxonomy tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
        INNER JOIN wp_terms t ON (tt.term_id = t.term_id)
        WHERE p.post_type = 'course'
        AND tt.taxonomy = 'course-cat'
        AND (tt.term_id IN (175,176,177,164,169,163,165,166,170 ))
        ORDER BY t.name ASC
    ")
);

if ( $courses ) {
    $curParent = '';
    $oldParent = '';
    $catCourse = [];
    foreach ( $courses as $course ) {
        // $curParent = $course->parent;
        $curParent = get_term( $course->parent, 'course-cat' )->name;
        // var_dump(get_the_terms( 47, 'course-cat' ));
        if($curParent != $oldParent){
            $catCourse[$curParent] = array();
           
            $oldParent = get_term( $course->parent, 'course-cat' )->name;
            echo '<h2>' .  get_term( $course->parent, 'course-cat' )->name . '</h2>';
        }
        array_push($catCourse[$curParent], $course);
        // echo '<h2>' . $course->parent_name . '</h2>';
        echo '<h3>' . $course->post_title . '</h3>';
    }
} else {
    echo 'No courses found.';
}

// foreach($curriculams as $curriculam){
//     if(!is_numeric($curriculam)){
//         $unitArray[$curriculam] = array();
//         $curCurriculam = $curriculam; 
//     }if(is_numeric($curriculam)){
//         $post = get_post($curriculam);
//         array_push($unitArray[$curCurriculam??$defaultSection], $post);
//     }
// }
// dd( $unitArray);

// if ( $courses ) {
//     foreach ( $courses as $course ) {

//         echo '<h2>' . $course->parent_name . '</h2>';
//         echo '<h3>' . $course->post_title . '</h3>';
//     }
// } else {
//     echo 'No courses found.';
// }
        echo '<pre>';
        // dd($catCourse);
        echo '</pre>';
        // $categories = array(46,47,48);
        // $sub_categories = array(175,176,177,164,169,163,165,166,170);

        // $courses = $wpdb->get_results(
        //     "
        //     SELECT c.post_title as course_name, c.ID as course_id, c.post_parent as sub_category_id, cat.post_title as category_name
        //     FROM wp_posts c, wp_posts cat
        //     WHERE c.post_type = 'course' and c.post_status = 'publish'  and c.post_parent in (175,176,177,164,169,163,165,166,170) and cat.ID = c.post_parent and cat.post_type = 'course-category' and cat.post_parent IN (46,47,48)
        //     GROUP BY cat.post_title, c.post_parent
        //     "
        // );
        
        // $categories = array();
        // foreach ($courses as $course) {
        //     if (!isset($categories[$course->category_name])) {
        //         $categories[$course->category_name] = array();
        //     }
        //     $categories[$course->category_name][] = array(
        //         'course_name' => $course->course_name,
        //         'course_id' => $course->course_id,
        //         'sub_category_id' => $course->sub_category_id
        //     );
        // }


        // $courses = $wpdb->get_results( "
        // SELECT p.ID, p.post_title, t1.name as category, t2.name as sub_category 
        // FROM wp_posts p 
        // LEFT JOIN wp_term_relationships tr1 ON p.ID = tr1.object_id
        // LEFT JOIN wp_term_taxonomy tt1 ON tr1.term_taxonomy_id = tt1.term_taxonomy_id
        // LEFT JOIN wp_terms t1 ON tt1.term_id = t1.term_id
        // LEFT JOIN wp_term_relationships tr2 ON p.ID = tr2.object_id
        // LEFT JOIN wp_term_taxonomy tt2 ON tr2.term_taxonomy_id = tt2.term_taxonomy_id
        // LEFT JOIN wp_terms t2 ON tt2.term_id = t2.term_id
        // WHERE p.post_type = 'course'
        // GROUP BY category,sub_category" );
        // $courses = $wpdb->get_results("
        //     SELECT p.ID, p.post_title 
        //     FROM wp_posts p 
        //     WHERE p.post_type = 'course'
        // ");

        // if($courses){
        //     foreach ($courses as $course) {
        //     echo '<h3>' . $course->category . '</h3>';
        //     echo '<ul>';
        //     echo '<li>' . $course->post_title . ' (' . $course->sub_category . ') </li>';
        //     echo '</ul>';
        //     }
        // }else{
        //     echo "No courses found.";
        // }
     
        // if ( $query->have_posts() ) {
        //     while ( $query->have_posts() ) {
        //         $query->the_post();
        //         var_dump("Hello".the_title());
        //     }
        // } else {
        //     // No courses found
        // }


        // global $wpdb;
        // $results = $wpdb->get_results( 
        // $wpdb->prepare( 
        //     "SELECT DISTINCT p.post_title as title, p.ID as course_id 
        //     FROM wp_posts p
        //     JOIN wp_term_relationships tr ON p.ID = tr.object_id
        //     JOIN wp_term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        //     JOIN wp_terms t ON tt.term_id = t.term_id
        //     WHERE p.post_type = 'course'
        //     AND (t.term_id = 46 OR t.term_id = 47 OR t.term_id = 48)
        //     AND tt.taxonomy = 'course-cat'
        //     JOIN wp_term_relationships tr2 ON p.ID = tr2.object_id
        //     JOIN wp_term_taxonomy tt2 ON tr2.term_taxonomy_id = tt2.term_taxonomy_id
        //     JOIN wp_terms t2 ON tt2.term_id = t2.term_id
        //     AND (t2.term_id = 175 OR t2.term_id = 176 OR t2.term_id = 177 OR t2.term_id = 164 OR t2.term_id = 169 OR t2.term_id = 173 OR t2.term_id = 165 OR t2.term_id = 166 OR t2.term_id = 170)
        //     AND tt2.taxonomy = 'sub-course-cat'
        //     GROUP BY p.post_title
        //     ORDER BY p.post_title ASC"),ARRAY_A);


        
        echo '<pre>';
        // var_dump($cats);
        // var_dump($cats);
        // var_dump($subs);
        // var_dump($query);


        echo '</pre>';
        // return $courses;
    }

}