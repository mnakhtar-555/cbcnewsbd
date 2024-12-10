<!-- News Marquee -->
<div class="marquee-section">
    <span class="marquee-heading">আপডেট খবরঃ</span>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="news-mq-wrapper">
                        <div class="news-mq-area">
                            <div class="marquee_text2">
                            <?php
                              $args = array(
                                  'post_type'      => 'news',
                                  'posts_per_page' => -1,
                                  'tax_query'      => array(
                                      array(
                                          'taxonomy' => 'news_category',
                                          'field'    => 'slug',
                                          'terms'    => 'top-news', 
                                      ),
                                  ),
                              );
                              $marquee_items = new WP_Query( $args );
                              while( $marquee_items->have_posts() ): $marquee_items->the_post();
                            ?>
                              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
                              <?php endwhile; wp_reset_postdata();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- News Marquee Ends -->

<footer class="footer">
    <div class="container">    
        <div class="row">
            <div class="col-md-4">
                <div class="editors-body">
                    <div><span>সম্পাদকঃ</span>নাম হবে</div>
                    <div><span>সহঃ সম্পাদকঃ</span>নাম হবে</div>
                    <div><span>উপ সম্পাদকঃ</span>নাম হবে</div>
                    <div><span>উপ সম্পাদকঃ</span>নাম হবে</div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-widget">
                            <h4>চিন্তা-ভাবনা</h4>
                            <ul>
                                <li><a href="">সাহিত্য</a></li>
                                <li><a href="">পাঠকের মত</a></li>
                                <li><a href="">ধর্ম জ্ঞান</a></li>
                                <li><a href="">বিজ্ঞান জগৎ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-widget">
                            <h4>বিষয়াবলী</h4>
                            <ul>
                                <li><a href="">কৃষি ও কৃষক</a></li>
                                <li><a href="">পরিবেশ</a></li>
                                <li><a href="">তথ্য-প্রযুক্তি</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-widget">
                            <h4>বিভাগীয়</h4>
                            <ul>
                                <li><a href="">ঢাকা</a></li>
                                <li><a href="">চট্টগ্রাম</a></li>
                                <li><a href="">খুলনা</a></li>
                                <li><a href="">বরিশাল</a></li>
                                <li><a href="">রাজশাহী</a></li>
                                <li><a href="">ময়মনসিংহ</a></li>
                                <li><a href="">সিলেট</a></li>
                                <li><a href="">রংপুর</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <?php dynamic_sidebar('cbcnews-footer-bottom'); ?>
        <p>Copyright: CBCNEWSBD-2024</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>