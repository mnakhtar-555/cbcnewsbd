<?php
get_header();
?>

<div class="archive-news">
    <div class="single-container">
        <div class="row">
            <div class="col-md-8">
        <?php
        if ( have_posts() ) :
        ?>
            <div class="archive-taxonomy">
                <h1 class="archive-title"><?php single_term_title(); ?></h1>
                <div class="taxonomy-description">
                    <?php echo term_description(); ?>
                </div>
                <div class="taxonomy-posts">
                    <div class="row">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                    ?>
                        <div class="col-md-4">
                            <div class="taxonomy-post-item">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    ?>
                    </div>
                </div>
            </div>
        <?php
        else :
            echo '<p>No posts found in this taxonomy.</p>';
        endif;
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

<?php
get_footer();
?>
