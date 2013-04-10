<?php
/*
Template Name: ranking
*/
?>
<?php
// define
define('URL','http://redonepress.com');

// google analytics api library require
require_once('/home/sites/heteml/users/r/e/d/redonepress/web/rop/wp-content/themes/rop/googleanalytics.class.php');

// get argument
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d', strtotime("- 1 days"));
$end_date   = isset($_GET['end_date'])   ? $_GET['end_date']   : date('Y-m-d');
$sort       = isset($_GET['sort'])       ? $_GET['sort']       : 'timeOnPage';

try{
    // create library object
    $ga = new GoogleAnalytics('xxxxx@gmail.com','passwd');

    // set profile
    $ga->setProfile('ga:xxxxx');

    // set term
    $ga->setDateRange($start_date,$end_date);

    // create query
    $dimensions = array( 'ga:pagePath', 'ga:pageTitle' );
    $metrics    = array( 'ga:timeOnPage', 'ga:visitors', 'ga:pageviews' );
    $filters    = array( 'ga:pagePath=~/news/', 'ga:pagePath!=/news/' );
    $query = array(
        'dimensions'    => urlencode(join(",",$dimensions)),
        'metrics'       => urlencode(join(",",$metrics)),
        'filters'       => urlencode(join(";",$filters)),
        'sort'          => urlencode("-ga:$sort")
    );

    // get analytics report
    $reports = $ga->getReport($query);

    // create ranking data
    $ranking = array();
    $i = 0;
    foreach( $reports as $dimensions => $metrics ){
        $dimensions = explode("~~",$dimensions);
        $tmp = explode("/",$dimensions[0]);
        $path = $tmp[2];
        $ranking[$i]['ga:pageUrl']     = URL.$dimensions[0];
        $ranking[$i]['ga:pageTitle']   = substr($dimensions[1], 17);
        $results = get_page_by_title($ranking[$i]['ga:pageTitle'],OBJECT,'post');
        if( is_null($results) ){
            $results = get_page_by_path($path,OBJECT,'post');
        }
        $image = wp_get_attachment_image_src( get_post_thumbnail_id($results->ID), 'full' );
        $ranking[$i]['ga:thumbnail'] = $image[0];
        foreach( $metrics as $key => $val ){
            $ranking[$i][$key] = $val;
        }
        $i++;
    }
    echo json_encode($ranking);

} catch (Exception $e) {
    echo '[{"Error":"'.$e->getMessage().'"}]';
}

?>
