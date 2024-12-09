<?php
get_header();

?>


<div class="single-news">
    <div class="single-container">
        <div class="row">
            <div class="col-md-8">
                <?php 
                if( have_posts() ) : the_post(); ?>
                    <h1 class="single-news-title"><?php the_title(); ?></h1>
                    <div class="post-meta">
                        <ul>
                            <li></li>
                        </ul>
                    </div>
                    <?php the_post_thumbnail(); ?>
                    <p><?php the_content(); ?></p>

                    <?php display_related_news_posts(); ?>
                <?php endif; ?>

                <?php
                // Fetch related posts based on categories
                function display_related_news_posts() {
                    global $post;
                
                    // Get terms from the custom taxonomy
                    $categories = wp_get_object_terms( $post->ID, 'news_category', array( 'fields' => 'ids' ) );
                
                    if ( ! empty( $categories ) ) {
                        $args = array(
                            'post_type'      => 'news', // Custom post type
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'news_category',
                                    'field'    => 'term_id',
                                    'terms'    => $categories,
                                ),
                            ),
                            'post__not_in'   => array( $post->ID ), // Exclude the current post
                            'posts_per_page' => 6, // Number of related posts
                        );
                
                        $related_posts = new WP_Query( $args );
                
                        if ( $related_posts->have_posts() ) {
                            echo '<div class="related-news-section">';
                            echo '<h3>সংশ্লিষ্ট আরো খবর</h3>';
                            echo '<div class="row">';
                
                            while ( $related_posts->have_posts() ) {
                                $related_posts->the_post();
                                ?>
                                <div class="col-md-4">
                                    <div class="related-news-item">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <div class="related-news-thumbnail">
                                                    <?php the_post_thumbnail( 'thumbnail' ); ?>
                                                </div>
                                            <?php endif; ?>
                                            <h4><?php the_title(); ?></h4>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            }
                
                            echo '</div>'; // End related-news-list
                            echo '</div>'; // End related-news-posts
                        } else {
                            echo '<p>No related news found.</p>';
                        }
                
                        wp_reset_postdata();
                    } else {
                        echo '<p>No categories assigned to this news post.</p>';
                    }
                }
                
                ?>        

            </div>
            <div class="col-md-4">
                <div class="cbc-news-sidebar">
                 <?php dynamic_sidebar('cbcnews-right-sidebar'); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer();