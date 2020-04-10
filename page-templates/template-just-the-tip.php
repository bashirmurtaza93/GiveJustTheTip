<?php
/**
 * Template Name: Just The Tip
 */
?>
<?php mesmerize_get_header(); ?>

<div id='page-content' class="page-content">

    <div class="content-block content-even col-xs-12">
        <?php
        $post = get_page_by_title('How it Works', OBJECT, 'post');
        $donations = get_page_by_title('donations',OBJECT,'post');
        $donation_options = get_option('jtt_theme_settings');
        $donation_percentage = (isset($donation_options['donation_percentage'])) ? $donation_options['donation_percentage'] : 0;
        $donation_calculator_success = (isset($donation_options['donation_calculator_success'])) ? $donation_options['donation_calculator_success'] : 'To donate the tip, you must donate: ';
        echo do_shortcode($post->post_content);
        //todo calculation here.
        ?>
        <br/>
        <input type="text" disabled value="<?php echo $donation_percentage;?>" id="percentage">% <div class="mobile-break multiplier">*</div>   <div class="paycheck-container">$<input type="text" id="paycheck"> <div class="mobile-break submit-donation">Submit</div></div>
        <div class="donate-percentage" data-text="<?php echo $donation_calculator_success;?>"></div>
    </div>
    <div class="donations">
        <?php echo $donations->post_content;?>
    </div>
    <div class="<?php mesmerize_page_content_wrapper_class(); ?>">
        <?php
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', 'page');
        endwhile;
        ?>
    </div>
</div>

<?php get_footer(); ?>
