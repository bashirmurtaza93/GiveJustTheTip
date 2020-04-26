<?php
/**
 * Template Name: Just The Tip
 */
?>
<?php mesmerize_get_header(); ?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0"></script>
<div id='page-content' class="page-content">
    <?php
        $donate_options =  get_option('jtt_theme_settings');
        $social_media_header   =  $donate_options['donation_social_media_header'];
        $social_media_message   =  $donate_options['donation_social_media'];
        $date = strtotime($donate_options['donation_date']);
        $time = date('M j, Y', $date);

        ?>
    <div class="next-donation-container">
        <div class="next-donation-text"><?php echo $donate_options['donation_heading'];?></div>
     <div id="countdown" data-time="<?php echo $time;?>"></div>
    </div>
    <div class="content-block content-even col-xs-12">

        <?php
        $post = get_post(get_the_ID());
        $content = apply_filters('the_content', $post->post_content);
        echo $content;
        $donations = get_page_by_title('donations',OBJECT,'post');
        $donation_options = get_option('jtt_theme_settings');
        $donation_percentage = (isset($donation_options['donation_percentage'])) ? $donation_options['donation_percentage'] : 0;
        $donation_calculator_success = (isset($donation_options['donation_calculator_success'])) ? $donation_options['donation_calculator_success'] : 'To donate the tip, you must donate: ';
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
            <button class="submit-donation jtt-button">Calculate</button>
            <div class="donate-percentage" data-text="<?php echo $donation_calculator_success;?>"></div>

        </div>
    </div>

    <div class="social-media-box">
        <h1 class="social-media"><?php echo $social_media_header;?></h1>
        <textarea id="social-share"><?php echo $social_media_message;?></textarea>
        <div class="button-container">
        <a href="#"
           class="twitter-hashtag-button twitter-button mobile-break" target="_blank"><i class="fa fa-twitter"></i> Tweet
        </a>
        <div class="fb-share-button" data-href="https://givejustthetip.com" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://givejustthetip.com&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
