<?php
get_header();

?>


<div class="single-news">
    <div class="single-container">
        <div class="row">
            <div class="col-md-8">
                <?php
                // Custom query for single 'editorial' post
                if ( have_posts() ) : 
                    while ( have_posts() ) : 
                        the_post();
                        
                        // Ensure the post is of type 'editorial'
                        if ( get_post_type() === 'editorial' ) :
                ?>
                            <h1 class="single-news-title"><?php the_title(); ?></h1>
                            <div class="post-meta">
                                <ul>
                                    <li>Published on: <?php echo get_the_date(); ?></li>
                                    <li>Author: <?php the_author(); ?></li>
                                </ul>
                            </div>
                            <?php the_post_thumbnail(); ?>
                            <p><?php the_content(); ?></p>
                <?php 
                        endif;
                    endwhile; 
                else : 
                ?>
                    <p>No posts found.</p>
                <?php endif; ?>
            </div>

            <div class="col-md-4">
                <div class="cbc-news-sidebar">
                <div class="sidebar-card">
                </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer();