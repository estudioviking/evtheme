<?php
/**
 * Slider
 */
$param = array( 'tag'				=> 'destaque',
				'posts_per_page'	=> 5,
				'post_status'		=> 'publish',
				'orderby'			=> 'date',
				'order'				=> 'DESC',
				'meta_key'			=> '_thumbnail_id'
				);

$obj_query = $wp_query->get_queried_object();

if ( is_tag() ) :
	$tag_slug = $obj_query->slug;
	$param[ 'tag_slug__and' ] = $tag_slug;
endif;

if ( is_category() ) :
	$cat_slug = $obj_query->slug;
	$param[ 'category_name' ] = $cat_slug;
endif;

if ( is_date() ) :
	$day_num	= get_the_date( 'j' );;
	$month_num	= get_the_date( 'n' );;
	$year_num	= get_the_date( 'Y' );;
	
	if ( is_day() )
		$date_param = array(
			'day'	=> $day_num,
			'month'	=> $month_num,
			'year'	=> $year_num
		);
	
	if ( is_month() )
		$date_param = array(
			'month'	=> $month_num,
			'year'	=> $year_num
		);
	
	if ( is_year() )
		$date_param = array(
			'day'	=> $day_num,
			'month'	=> $month_num,
			'year'	=> $year_num
		);
	
	$param[ 'date_query' ] = array( $date_param );
endif;

$slides = new WP_Query( $param );

if ( $slides->post_count > 0 ) :
?>
<!-- slider -->
<?php

$slider_pause_hover = 'true';

?>
<div id="viking-slider" class="col_8">
	<figure class="cycle-slideshow"
			data-cycle-fx="scrollHorz"
			data-cycle-pause-on-hover="<?php echo $slider_pause_hover ?>"
			data-cycle-timeout="4000"
			data-cycle-pager="#slider-pager"
			data-cycle-pager-template="<a href=#> &#9679; </a>"
			data-cycle-prev="#prev"
			data-cycle-next="#next"
			data-cycle-slides="> div"><?php
		
		while ( $slides->have_posts() ) : $slides->the_post();
			$img        = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-size' );
			$img_src    = $img[0];
			$post_link  = get_permalink();
			$post_title = get_the_title(); ?>
		
		<div class="viking-slide">
			<a href="<?php echo $post_link ?>" title="<?php echo $post_title ?>">
				<img src="<?php echo $img_src ?>" />
			</a>
			
			<figcaption class="slider-caption cycle-overlay">
				<h4 class="post-title">
					<a href="<?php echo $post_link ?>" title="<?php echo $post_title ?>">
						<?php echo $post_title ?>
					</a>
				</h4>
				<?php viking_excerpt( 'viking_length_slider' ); ?>
			</figcaption>
		</div>
		
		<?php endwhile; ?>
		
		<span id="slider-navigation">
            <a href="#" id="prev">◄</a>
            <span id="slider-pager"></span>
            <a href="#" id="next">►</a>
        </span>
		
	</figure>
</div>
<!-- /slider -->
<?php
endif;

wp_reset_postdata();