<?php

// Popular Posts Widget
class Mna_Cbcnews_Popular_Posts_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Base ID
            'mna_cbcnews_popular_posts',

            // Widget Name
            __('CBC NEWS Popular Posts', 'cbcnews'),

            // Widget Description
            array('description' => __('Displays popular posts', 'cbcnews'))
        );
    }

    // Frontend display of the widget
public function widget($args, $instance)
{
    $title = apply_filters('widget_title', $instance['title']);
    $number_of_posts = !empty($instance['number_of_posts']) ? $instance['number_of_posts'] : 3;

    echo $args['before_widget'];

    // Display widget title
    if (!empty($title)) {
        echo $args['before_title'] . $title . $args['after_title'];
    }

    // Query popular posts from the 'news' post type by comment count
    $popular_posts = new WP_Query(array(
        'post_type'      => 'news', // Specify the 'news' post type
        'posts_per_page' => $number_of_posts,
        'orderby'        => 'comment_count',
        'order'          => 'DESC'
    ));

    // Loop through popular posts
    if ($popular_posts->have_posts()) :
        while ($popular_posts->have_posts()) : $popular_posts->the_post();
?>
            <div class="recent-post-widget mb-20">
                <div class="recent-post-img">
                    <a href="<?php the_permalink(); ?>">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('thumbnail');
                        } else {
                            echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/img/inner-pages/default-image.png') . '" alt="' . esc_attr(get_the_title()) . '">';
                        }
                        ?>
                    </a>
                </div>
                <div class="recent-post-content">
                    <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_date('d F, Y'); ?></a>
                    <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                </div>
            </div>
<?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>' . __('No popular posts available', 'cbcnews') . '</p>';
    endif;

    echo $args['after_widget'];
}


    // Widget backend form
    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : __('Popular Posts', 'cbcnews');
        $number_of_posts = isset($instance['number_of_posts']) ? $instance['number_of_posts'] : 3;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'cbcnews'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>"><?php _e('Number of Posts:', 'cbcnews'); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>"
                name="<?php echo esc_attr($this->get_field_name('number_of_posts')); ?>" type="number"
                step="1" min="1" value="<?php echo esc_attr($number_of_posts); ?>" size="3">
        </p>
<?php
    }

    // Updating widget replacing old instances with new values
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['number_of_posts'] = (!empty($new_instance['number_of_posts'])) ? intval($new_instance['number_of_posts']) : 3;
        return $instance;
    }
}

//Category custom widget

class Mna_Cbcnews_Category_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(

            // Base ID of our widget
            'cbcnews_category',

            // Widget name
            __('CBC NEWS Category', 'cbcnews'),

            // Widget description
            array('description' => __('CBC NEWS Category', 'cbcnews'),)
        );
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];

        $title = apply_filters('widget_title', $instance['title']);

        if (!empty($title)) : ?>
            <?php echo $args['before_title'] . esc_attr(__($title, 'cbcnews')) . $args['after_title']; ?>
        <?php endif;

        // Display popular categories from 'news_category'
        echo '<ul class="category-list">';

        // Fetch popular terms from 'news_category' taxonomy
        $popular_terms = get_terms(array(
            'taxonomy'   => 'news_category', // Specify the custom taxonomy
            'orderby'    => 'count',         // Order by post count
            'order'      => 'DESC',          // Descending order for popular categories
            'number'     => 8,               // Limit the number of categories (e.g., top 5)
            'hide_empty' => true,            // Only show categories with associated posts
        ));

        if (!is_wp_error($popular_terms) && !empty($popular_terms)) {
            foreach ($popular_terms as $term) {
                echo '<li><a href="' . esc_url(get_term_link($term->term_id, $term->taxonomy)) . '">
                <span>
                        <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path
                                    d="M14.0015 6.99978C14.0015 7.59651 13.2684 8.08835 13.1216 8.63846C12.9701 9.20722 13.3535 9.99975 13.0656 10.4974C12.7731 11.0032 11.8931 11.0638 11.4829 11.4741C11.0726 11.8844 11.012 12.7643 10.5062 13.0568C10.0085 13.3447 9.21601 12.9613 8.64725 13.1128C8.09714 13.2596 7.6053 13.9927 7.00857 13.9927C6.41184 13.9927 5.92 13.2596 5.36989 13.1128C4.80113 12.9613 4.0086 13.3447 3.51093 13.0568C3.00511 12.7643 2.9445 11.8844 2.53425 11.4741C2.124 11.0638 1.24405 11.0032 0.951514 10.4974C0.663638 9.99975 1.04708 9.20722 0.89557 8.63846C0.748719 8.08835 0.015625 7.59651 0.015625 6.99978C0.015625 6.40305 0.748719 5.91121 0.89557 5.3611C1.04708 4.79234 0.663638 3.99981 0.951514 3.50214C1.24405 2.99632 2.124 2.93571 2.53425 2.52546C2.9445 2.11521 3.00511 1.23526 3.51093 0.942725C4.0086 0.654849 4.80113 1.0383 5.36989 0.886781C5.92 0.73993 6.41184 0.00683594 7.00857 0.00683594C7.6053 0.00683594 8.09714 0.73993 8.64725 0.886781C9.21601 1.0383 10.0085 0.654849 10.5062 0.942725C11.012 1.23526 11.0726 2.11521 11.4829 2.52546C11.8931 2.93571 12.7731 2.99632 13.0656 3.50214C13.3535 3.99981 12.9701 4.79234 13.1216 5.3611C13.2684 5.91121 14.0015 6.40305 14.0015 6.99978Z"/>
                                <path
                                    d="M9.03132 4.91555L6.36934 7.57753L4.9894 6.19876C4.84548 6.05492 4.65033 5.97412 4.44686 5.97412C4.24339 5.97412 4.04824 6.05492 3.90432 6.19876C3.76049 6.34267 3.67969 6.53782 3.67969 6.74129C3.67969 6.94477 3.76049 7.13991 3.90432 7.28383L5.8402 9.21971C5.98028 9.35963 6.17018 9.43823 6.36817 9.43823C6.56616 9.43823 6.75606 9.35963 6.89614 9.21971L10.1152 6.00062C10.2591 5.85671 10.3399 5.66156 10.3399 5.45809C10.3399 5.25461 10.2591 5.05947 10.1152 4.91555C10.0441 4.84434 9.95959 4.78785 9.8666 4.7493C9.77361 4.71076 9.67393 4.69092 9.57327 4.69092C9.47261 4.69092 9.37293 4.71076 9.27994 4.7493C9.18695 4.78785 9.10246 4.84434 9.03132 4.91555Z"/>
                            </g>
                        </svg>';
                echo esc_html($term->name);
                echo '</span> <span>(' . esc_html($term->count) . ')</span>'; // Display post count in each term
                echo '</a></li>';
            }
        } else {
            echo '<li>' . __('No popular categories found', 'cbcnews') . '</li>';
        }

        echo '</ul>';

        echo $args['after_widget'];
    }



    // Widget Backend
    public function form($instance)
    {
        // Check for existing values
        $title = isset($instance['title']) ? $instance['title'] : __('Categories', 'cbcnews');
        ?>
        <!-- Title input field -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'cbcnews'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" 
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    // Updating widget, replacing old instances with new ones
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        return $instance;
    }
}

// Register the widget
function register_mna_cbcnews_popular_posts_widget()
{
    register_widget('Mna_Cbcnews_Popular_Posts_Widget');
    register_widget('Mna_Cbcnews_Category_Widget');
}
add_action('widgets_init', 'register_mna_cbcnews_popular_posts_widget');