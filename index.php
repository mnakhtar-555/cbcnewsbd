<?php get_header(); ?>

<main>
    <div class="cbc-news-container">
      <div class="hero-section">
        <div class="row">
          <div class="col-md-8">
            <div class="featured-slider">
              <h3>আলোচিত খবর</h3>
              <!-- SWIPER Slider -->
              <section class="creative-photography--slider theme1">
                <div class="swiper-container photography-swiper--slider">
                  <div class="swiper-wrapper">
                    <?php
                        $args = array(
                            'post_type'      => 'news', // Custom post type
                            'posts_per_page' => 6,      // Number of posts to display
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'news_category',
                                    'field'    => 'slug',
                                    'terms'    => 'featured', 
                                ),
                            ),
                        );
                        $featured_news = new WP_Query( $args );
                        while( $featured_news->have_posts() ): $featured_news->the_post();
                    ?>
                    <div class="swiper-slide">
                      <div class="photography-slider--item">
                        <div class="photography-slider--content">
                          <a href="<?php the_permalink(); ?>">
                          <div class="photography-slider--image">
                            <?php the_post_thumbnail(); ?>							
                            <div class="photography-slider--inner">
                              <div class="photography-heading">
                                <div class="photography-item--inner">
                                  <h1 class="photography-item--title"><?php the_title(); ?></h1>
                                </div>
                              </div>
                            </div>
                          </div>
                          </a>
                        </div>
                      </div>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>

                    <!-- Pagination -->
                    <div class="creative-swiper--dots">
                      <div class="swiper-pagination"></div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- SWIPER Slider -->
            </div>
          </div>
          <div class="col-md-4">
            <div class="shirsho-news">
              <h3>শীর্ষ সংবাদ</h3>
              <div class="shirsho-news-area">
                <?php
                    $args = array(
                        'post_type'      => 'news', // Custom post type
                        'posts_per_page' => 5,      // Number of posts to display
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'news_category',
                                'field'    => 'slug',
                                'terms'    => 'top-news',
                            ),
                        ),
                    );
                    $top_news = new WP_Query( $args );
                ?>
                <div class="marquee-container marquee-wrapper">
                    <ul class="marquee_topnews" id="#marquee">
                        <?php 
                            while( $top_news->have_posts() ): $top_news->the_post();
                        ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>
      <div class="body-with-sidebar">
        <div class="row">
          <div class="col-md-8">
            <div class="cbc-newses">
              <div class="national-section">
                <div class="section-top">
                    <h3><span class="section-head-circle">জাতীয়</span></h3>
                </div>
                <div class="row">
                <?php
                    $args = array(
                        'post_type'      => 'news', // Custom post type
                        'posts_per_page' => 6,      // Number of posts to display
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'news_category',
                                'field'    => 'slug',
                                'terms'    => 'national', 
                            ),
                        ),
                    );
                    $national_news = new WP_Query( $args );
                    while( $national_news->have_posts() ): $national_news->the_post();
                ?>
                  <div class="col-md-4">
                    <div class="cbc-news-card">
						<a href="<?php the_permalink(); ?>">
                        	<?php the_post_thumbnail('post-thumbnail', ['class' => 'cbc-news-thumbnail']);  ?>
                      		<h3 class="cbc-news-title"><?php the_title(); ?></h3>
						</a>
                    </div>
                  </div>
                  <?php endwhile; wp_reset_postdata(); ?>
                </div>
              </div><!--  National Section End-->
              <div class="interational-section">
                <div class="section-top">
                    <h3><span class="section-head-circle">আন্তর্জাতিক</span></h3>
                </div>
                <div class="row">
                <?php
                    $args = array(
                        'post_type'      => 'news', // Custom post type
                        'posts_per_page' => 6,      // Number of posts to display
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'news_category',
                                'field'    => 'slug',
                                'terms'    => 'international', 
                            ),
                        ),
                    );
                    $international_news = new WP_Query( $args );
                    while( $international_news->have_posts() ): $international_news->the_post();
                ?>
                  <div class="col-md-4">
                    <div class="cbc-news-card">
                        <a href="<?php the_permalink(); ?>">
                        	<?php the_post_thumbnail('post-thumbnail', ['class' => 'cbc-news-thumbnail']);  ?>
                      		<h3 class="cbc-news-title"><?php the_title(); ?></h3>
						</a>
                    </div>
                  </div>
                  <?php endwhile; wp_reset_postdata(); ?>
                </div>
              </div><!--  Interational Section End-->
              <div class="saradesh-section">
                <div class="section-top">
                    <h3><span class="section-head-circle">দেশজুরে</span></h3>
                </div>
                <div class="row">
                  <?php
                      $args = array(
                          'post_type'      => 'news', // Custom post type
                          'posts_per_page' => 6,      // Number of posts to display
                          'tax_query'      => array(
                              array(
                                  'taxonomy' => 'news_category',
                                  'field'    => 'slug',
                                  'terms'    => 'country', 
                              ),
                          ),
                      );
                      $saradesh_news = new WP_Query( $args );
                      while( $saradesh_news->have_posts() ): $saradesh_news->the_post();
                  ?>
                  <div class="col-md-4">
                    <div class="cbc-news-card">
                        <a href="<?php the_permalink(); ?>">
                        	<?php the_post_thumbnail('post-thumbnail', ['class' => 'cbc-news-thumbnail']);  ?>
                      		<h3 class="cbc-news-title"><?php the_title(); ?></h3>
						</a>
                    </div>
                  </div>
                  <?php endwhile; wp_reset_postdata(); ?>
                </div>
              </div><!--  Saradesh Section End-->
              <div class="politics-section">
                <div class="section-top">
                    <h3><span class="section-head-circle">রাজনীতি</span></h3>
                </div>
                <div class="row">
                    <?php
                      $args = array(
                          'post_type'      => 'news', // Custom post type
                          'posts_per_page' => 6,      // Number of posts to display
                          'tax_query'      => array(
                              array(
                                  'taxonomy' => 'news_category',
                                  'field'    => 'slug',
                                  'terms'    => 'politics', 
                              ),
                          ),
                      );
                      $politics_news = new WP_Query( $args );
                      while( $politics_news->have_posts() ): $politics_news->the_post();
                    ?>
                  <div class="col-md-4">
                    <div class="cbc-news-card">
                        <a href="<?php the_permalink(); ?>">
                        	<?php the_post_thumbnail('post-thumbnail', ['class' => 'cbc-news-thumbnail']);  ?>
                      		<h3 class="cbc-news-title"><?php the_title(); ?></h3>
						</a>
                    </div>
                  </div>
                  <?php endwhile; wp_reset_postdata(); ?>
                </div>
              </div><!--  Politics Section End-->
              <div class="economics-section">
                <div class="section-top">
                    <h3><span class="section-head-circle">অর্থনীতি</span></h3>
                </div>
                <div class="row">
                    <?php
                      $args = array(
                          'post_type'      => 'news', // Custom post type
                          'posts_per_page' => 6,      // Number of posts to display
                          'tax_query'      => array(
                              array(
                                  'taxonomy' => 'news_category',
                                  'field'    => 'slug',
                                  'terms'    => 'economics', 
                              ),
                          ),
                      );
                      $economics_news = new WP_Query( $args );
                      while( $economics_news->have_posts() ): $economics_news->the_post();
                    ?>
                  <div class="col-md-4">
                    <div class="cbc-news-card">
                        <a href="<?php the_permalink(); ?>">
                        	<?php the_post_thumbnail('post-thumbnail', ['class' => 'cbc-news-thumbnail']);  ?>
                      		<h3 class="cbc-news-title"><?php the_title(); ?></h3>
						</a>
                    </div>
                  </div>
                  <?php endwhile; wp_reset_postdata(); ?>
                </div>
              </div><!--  Economics Section End-->
              <div class="sports-section">
                <div class="section-top">
                    <h3><span class="section-head-circle">খেলাধুলা</span></h3>
                </div>
                <div class="row">
                    <?php
                      $args = array(
                          'post_type'      => 'news', // Custom post type
                          'posts_per_page' => 6,      // Number of posts to display
                          'tax_query'      => array(
                              array(
                                  'taxonomy' => 'news_category',
                                  'field'    => 'slug',
                                  'terms'    => 'sports', 
                              ),
                          ),
                      );
                      $sports_news = new WP_Query( $args );
                      while( $sports_news->have_posts() ): $sports_news->the_post();
                    ?>
                  <div class="col-md-4">
                    <div class="cbc-news-card">
                        <a href="<?php the_permalink(); ?>">
                        	<?php the_post_thumbnail('post-thumbnail', ['class' => 'cbc-news-thumbnail']);  ?>
                      		<h3 class="cbc-news-title"><?php the_title(); ?></h3>
						</a>
                    </div>
                  </div>
                  <?php endwhile; wp_reset_postdata(); ?>
                </div>
              </div><!--  Politics Section End-->
              <div class="entertain-section">
                <div class="section-top">
                    <h3><span class="section-head-circle">বিনোদোন</span></h3>
                </div>
                <div class="row">
                    <?php
                      $args = array(
                          'post_type'      => 'news', // Custom post type
                          'posts_per_page' => 6,      // Number of posts to display
                          'tax_query'      => array(
                              array(
                                  'taxonomy' => 'news_category',
                                  'field'    => 'slug',
                                  'terms'    => 'entertainment', 
                              ),
                          ),
                      );
                      $entertainment_news = new WP_Query( $args );
                      while( $entertainment_news->have_posts() ): $entertainment_news->the_post();
                    ?>
                  <div class="col-md-4">
                    <div class="cbc-news-card">
                        <a href="<?php the_permalink(); ?>">
                        	<?php the_post_thumbnail('post-thumbnail', ['class' => 'cbc-news-thumbnail']);  ?>
                      		<h3 class="cbc-news-title"><?php the_title(); ?></h3>
						</a>
                    </div>
                  </div>
                  <?php endwhile; wp_reset_postdata(); ?>
                </div>
              </div><!--  Entertainment Section End-->
              <div class="opinion-section">
                <div class="section-top">
                    <h3><span class="section-head-circle">মতামত</span></h3>
                </div>
                <div class="row">
                    <?php
                      $args = array(
                          'post_type'      => 'news', // Custom post type
                          'posts_per_page' => 6,      // Number of posts to display
                          'tax_query'      => array(
                              array(
                                  'taxonomy' => 'news_category',
                                  'field'    => 'slug',
                                  'terms'    => 'opinion', 
                              ),
                          ),
                      );
                      $opinion_news = new WP_Query( $args );
                      while( $opinion_news->have_posts() ): $opinion_news->the_post();
                    ?>
                  <div class="col-md-4">
                    <div class="cbc-news-card">
                        <a href="<?php the_permalink(); ?>">
                        	<?php the_post_thumbnail('post-thumbnail', ['class' => 'cbc-news-thumbnail']);  ?>
                      		<h3 class="cbc-news-title"><?php the_title(); ?></h3>
						</a>
                    </div>
                  </div>
                  <?php endwhile; wp_reset_postdata(); ?>
                </div>
              </div><!--  Opinion Section End-->
            </div>
          </div>
          <div class="col-md-4">
            <div class="cbc-news-sidebar">
              <div class="editorial-aria">
                <h4><span>সম্পাদকীয়</span></h4>
                <?php
                  $cbcnewsbd_editorial = new WP_Query(
                    array(
                      'post_type'    => 'cbcnewsbd_editorial',
                      'posts_per_page'=> 1
                    )
                  );
                  while( $cbcnewsbd_editorial->have_posts() ) : $cbcnewsbd_editorial->the_post();
                ?>
                <div class="editorial-card">
                  <h4><?php the_title(); ?></h4>
                  <?php $bistarito = "<a href='" . get_permalink() . "' class='read-more'>....বাকী অংশ</a>"; ?>
                  <p><?php echo wp_trim_words( get_the_content(), 60, $bistarito ); ?></p>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
              </div>
              <?php dynamic_sidebar('cbcnews-right-sidebar'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php get_footer(); ?>