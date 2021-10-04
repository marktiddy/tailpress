<?php 
//Template Name: HTML Sitemap

get_header(); ?>


<section class="px-8 md:px-16 pb-12 md:pb-32 sitemap-page">

<h2 id="sitemap-pages" class="text-3xl mt-8 mb-4">Pages</h2>
<ul class="list-inside list-disc">
<?php 
wp_list_pages( array( 
	'exclude' => '1387',
    'title_li' => '',
  )
);
?>
</ul>

<h2 id="sitemap-posts" class="text-3xl mt-8 mb-4">Posts</span></h2>
<ul class="list-inside list-disc">
<?php 
$postsArgs = array(
	'post_type' => 'post',
	 'posts_per_page'=>'-1',
	// 'post__not_in' => array(), 
	 );
$postsLoop = new WP_Query( $postsArgs );
while ( $postsLoop->have_posts() ) {
 $postsLoop->the_post();
?>
	<li <?php post_class(); ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php } wp_reset_query(); ?>
</ul>

<h2 id="sitemap-posts-categories" class="text-3xl mt-8 mb-4">Post Categories</h2>
<ul class="list-inside list-disc">
<?php wp_list_categories( array(
    'title_li' => '',
    'show_count' => false,
//  'exclude'    => array(),
) ); ?> 
</ul>


<!-- <h2 id="sitemap-services" class="text-3xl mt-8 mb-4">A Custom Postype</h2> -->
<!-- <ul class="list-inside list-disc"> -->
<?php 
// $postsArgs = array(
// 	'post_type' => 'services',
// 	'posts_per_page'=>'-1',
// 	//'post__not_in' => array(), 
//);
// $postsLoop = new WP_Query( $postsArgs );
// while ( $postsLoop->have_posts() ) {
// 	$postsLoop->the_post();
?>
	<!-- <li <?php //post_class(); ?>><a href="<?php //the_permalink(); ?>"><?php //the_title(); ?></a></li> -->
<?php //} wp_reset_query(); ?>
<!-- </ul> -->
</section>
<?php get_footer(); ?>