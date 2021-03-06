<?php
/**
 * Template Name: Just The Tip
 */
?>
<?php mesmerize_get_header();

$donate_options = get_option('jtt_theme_settings');
$social_media_header = $donate_options['donation_social_media_header'];
$social_media_message = $donate_options['donation_social_media'];
$date = strtotime($donate_options['donation_date']);
$time = date('M j, Y', $date);
$display_countdown = '';
$padding_fix_content = '';
if ($donate_options['donation_toggle'] !== "on") {
    $display_countdown = 'style="display:none"';
    $padding_fix_content = 'remove-padding';

}

?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0"></script>
<div id='page-content' class="page-content <?php echo $padding_fix_content;?>">

    <div class="next-donation-container" <?php echo $display_countdown;?>>
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

    </div>

<!--    <div class="social-media-box">-->
<!--        <h1 class="social-media">--><?php //echo $social_media_header;?><!--</h1>-->
<!--        <textarea id="social-share">--><?php //echo $social_media_message;?><!--</textarea>-->
<!--        <div class="button-container">-->
<!--        <a href="#"-->
<!--           class="twitter-hashtag-button twitter-button mobile-break" target="_blank"><i class="fa fa-twitter"></i> Tweet-->
<!--        </a>-->
<!--        <div class="fb-share-button" data-href="https://givejustthetip.com" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://givejustthetip.com&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>-->
<!--        </div>-->
<!--    </div>-->
</div>

<?php get_footer(); ?>
