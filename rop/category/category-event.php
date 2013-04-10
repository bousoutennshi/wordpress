<?php

/**
 * Category Name : event
 *
 */

// イベント開催日取得
$event_date = isset($_REQUEST['event_date']) ? $_REQUEST['event_date'] : '';

// 投稿データ検索クエリ作成
$query = array(
    'category_name' => 'event',
    'posts_per_page' => '15'
);

// イベント開催日検索追加
if( $event_date !== '' ){
    $query['meta_query'] = array(
        'relation'  => 'AND',
        array(
            'key'       => 'イベント開始日',
            'value'     => $event_date,
            'compare'   => '<=',
            'type'      => 'NUMERIC'
        ),
        array(
            'key'       => 'イベント終了日',
            'value'     => $event_date,
            'compare'   => '>=',
            'type'      => 'NUMERIC'
        )
    );
}

// 投稿データ取得
$post_datas = query_posts($query);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>EVENT</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="">
<meta name="keywords" content="">
<meta property="og:title" content="" />
<meta property="og:type" content="website" />
<meta property="og:url" content="" />
<meta property="og:image" content="" />
<meta property="og:site_name" content="" />
<meta property="og:description" content=""/>
<link href="<?php echo get_template_directory_uri(); ?>/css.php" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="./img/favicon.ico">
</head>

<body>

<div id="wrapper">

<?php get_template_part( "MHD" ) ?>

<div class="decMB40">
<?php get_header(); ?>
</div>

<div id="contents" class="clfix decMB50">

<div id="main">

<?php
$today = date('Ymd');
if( $event_date == $today ){
?>

<div class="ropCmnMdLbl decMB30">
  <h1 class="ptsTtl typeTodayEvent">Today's event!</h1>
</div>
<!-- /.ropCmnMdLbl decMB30 -->

<div class="ropCmnMdLead decMB20">
<p>本日開催中のイベントを紹介します！</p>
</div>

<?php
}else{
?>

<div class="ropCmnMdLbl decMB30">
  <h1 class="ptsTtl typeCalendar">CALENDAR</h1>
</div>
<!-- /.ropCmnMdLbl decMB30 -->

<div class="ropCmnMdLead decMB20">
<?php
if( $event_date ){
    echo "<p>".$event_date."のイベントを紹介します。</p>";
}else{
    echo "<p>RED ONE PRESSのイベントを紹介します。</p>";
}
?>
</div>
<?php
}
?>

<?php

// div cntents ロジック追加
$i = 0;
$post_datas_num = count($post_datas);
foreach( $post_datas as $post_data ){

    // 3個回ったらリセット
    if( $i === 3 ) $i = 0;

    if( $i === 0 ){
        // 1行を形成するdiv
        echo '<div class="clfix decMB10">';
    }
    if( $i === 2 ){
        // 3個目を形成するdiv
        echo '<div class="ropCmnMdPanel typeLast">';
    }else{
        // 1個目と2個目を形成するdiv
        echo '<div class="ropCmnMdPanel">';
    }

    // heteml url を置き換え 
    $url = str_replace("redonepress.heteml.jp/rop","redonepress.com",$post_data->guid);
?>

<a href="<?php echo $url; ?>">
    <span class="untPanelInner">
        <span class="ptsImg decMB10">
            <?php echo get_the_post_thumbnail($post_data->ID, 'medium'); ?>
        </span>
        <span class="ptsTtl decMB5">
            <?php echo $post_data->post_title; ?>
        </span>
        <span class="ptsDate decMB10">
            <?php echo get_the_time("Y/m/d",$post_data->ID); ?>
        </span>
        <span class="ptsLead decMB10">
            <?php echo mb_substr(strip_tags($post_data->post_content),0,60)."..."; ?>
        </span>
    </span>
</a>
</div>

<?php

    $post_datas_num--;
    if( $i === 2 || $post_datas_num === 0 ){
        echo "</div>";
    }
    $i++;
}

?>

<?php
if( $event_date == $today ){
?>

<!-- p class="ptsBtnGoCalendar"><a href="#">イベントカレンダーはこちら</a></p -->

<?php
}else{
?>

<p class="ptsBtnGoTodayEvent"><a href="<?php echo home_url(); ?>/event?event_date=<?php echo $today; ?>">本日開催中のイベントはこちら</a></p>

<?php
}
?>

</div><!-- /#main -->

<div id="sub">

<?php get_template_part( "sub/subMdPickup" ) ?>
<?php get_template_part( "sub/subMdTodayEvent" ) ?>
<?php get_template_part( "sub/subMdRanking" ) ?>
<?php get_template_part( "sub/subMdBlog" ) ?>
<?php get_template_part( "sub/subMdTwitter" ) ?>
<?php get_template_part( "sub/subMdFacebook" ) ?>

</div><!-- /#sub -->

</div><!-- /#contents -->

<?php get_footer(); ?>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jQuery.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/slideShow.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/scroll.js"></script>

</div><!-- /#wrapper -->
</body>
</html>
