<?php
/**
 * Template Name: Just The Tip
 */
?>
<?php mesmerize_get_header(); ?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0"></script>
<div id='page-content' class="page-content">

    <div class="content-block content-even col-xs-12">
        <?php
        $post = get_page_by_title('How it Works', OBJECT, 'post');
        $donations = get_page_by_title('donations',OBJECT,'post');
        $donation_options = get_option('jtt_theme_settings');
        $donation_percentage = (isset($donation_options['donation_percentage'])) ? $donation_options['donation_percentage'] : 0;
        $donation_calculator_success = (isset($donation_options['donation_calculator_success'])) ? $donation_options['donation_calculator_success'] : 'To donate the tip, you must donate: ';
        echo do_shortcode($post->post_content);
        ?>
        <br/>
        <div class="main-calculation-container col-xs-12">
            <div class="calculation-container col-xs-12">
                <div class="col-sm-12 col-md-5 percentage-container">
                    <div class="percentage-information-container">
                        <div class="unemployment-label">Unemployment Percentage</div>
                        <input type="text" disabled value="<?php echo $donation_percentage;?>" id="percentage">
                    </div>
                </div>
                <div class="mobile-break multiplier col-md-2">*</div>
                <div class="col-sm-12 col-md-5 paycheck-container">
                    <div class="paycheck-information-container">
                        <div class="unemployment-label">Bi Weekly Paycheck</div>
                        <span class="dollar-sign">$<input type="text" id="paycheck"></span>
                    </div>
                </div>
            </div>
            <div class="mobile-break submit-donation">Submit</div>
            <div class="donate-percentage" data-text="<?php echo $donation_calculator_success;?>"></div>

        </div>
    </div>
    <div class="content-block donations">
        <?php echo $donations->post_content;?>
    </div>

    <div class="social-media-box">
        <h1 class="social-media">Share on Social Media!</h1>
        <textarea id="social-share">I did something with my tip..... #givejusthetip</textarea>
        <div class="button-container">
        <a href="https://twitter.com/intent/tweet?hashtags=givejustthetip%2C&original_referer=http%3A%2F%2Flocalhost%3A8000%2F&ref_src=twsrc%5Etfw&text=give%20thet%20up&tw_p=tweetbutton"
           class="twitter-hashtag-button twitter-button" target="_blank">Tweet
        </a>
        <div class="fb-share-button" data-href="https://givejustthetip.com" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://givejustthetip.com&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
        </div>
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
