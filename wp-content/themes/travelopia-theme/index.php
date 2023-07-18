
<?php get_header(); ?>

<section class="blog-main">
    <div class="container">
      <div class="top-bar">
        <span class="top-had">EXPLORE</span>
        <h2 class="bold-h">Latest from <span class="text-red">our blog</span></h2>
      </div>
      <div class="row mt-5">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div class="col-md-3">
            <a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute(); ?>">
          <div class="blog-box">
            <div class="blog-imag">
            <?php
            $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_option('page_for_posts')),'full'); 
            if(empty($img)){
                $featured_image = "";
            }else{
                $featured_image = $img[0];
            }
            
            ?>  
            
            <img src="<?php echo $featured_image; ?>" alt="" />

              
            </div>
            <div class="blog-content">
              <h6><?php the_title(); ?></h6>
              <p><?php echo the_date('M, d, Y'); ?> <a href="<?php the_permalink(); ?>" class="continue-butn" title="<?php echo the_title_attribute(); ?>">CONTINUE</a></p>
            </div>
          </div>
          </a>
        </div>
      <?php endwhile; else : ?>
        <p>Sorry, no posts were found!</p>
        <?php endif; ?>
      </div>
    </div>
</section>

<?php get_footer(); ?>