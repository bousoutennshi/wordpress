<?php
  $search_date = $_GET['search_date'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
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

<div class="decMB40">
<?php get_header(); ?>
</div>

<div id="contents" class="clfix decMB50">

<div id="main">

<?php
if($search_date){
?>
<h1><?php echo $search_date; ?>開催中のイベント</h1>
<?php
}
?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>


<?php 
var_dump($post);
if($i == undefined || $i == null) {
  $i = 0;
}
if($i == 0 || $i % 3 == 0) {
?>
<div class="clfix decMB20">
<?php 
}
if (($i == 2) || ($i % 3 == 2)) {
?>
<div class="ropCmnMdPanel typeLast">
<?php 
} else{
?>
<div class="ropCmnMdPanel">
<?php 
}
?>
  <a href="<?php the_permalink(); ?>">
  <span class="untPanelInner">
    <span class="ptsImg decMB10">
      <?php the_post_thumbnail('medium'); ?>
    </span>
    <span class="ptsTtl decMB5">
      <?php the_title(); ?>
    </span>
    <span class="ptsDate decMB10">
<?php the_time(); ?>
    </span>
    <span class="ptsLead decMB10">
<?php the_excerpt(); ?>
    </span>
  </span>
  </a>
</div>
<!-- /.ropCmnMdPanel -->

<?php
if (($i == 2) || ($i % 3 == 2)) {
?>
    </div>
<?php
  }
  $i++;
?>
<?php endwhile; ?>
<?php endif; ?>
<?php 
if (($i != 2) || (($i % 3) != 2)) {
?>
</div>
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
<?php get_template_part( "sub/subMdMailMagazin" ) ?>

</div><!-- /#sub -->

</div><!-- /#contents -->

<?php get_footer(); ?>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jQuery.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/slideShow.js"></script>

</div><!-- /#wrapper -->
</body>
</html>
