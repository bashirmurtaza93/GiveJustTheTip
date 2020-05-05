<?php

if(is_admin()){
    $settings = new JTT_Settings();
}
class JTT_Settings{

    public function __construct()
    {
        add_action('admin_menu',[$this,'add_options_page']);
    }

    function add_options_page()
    {

        add_options_page(
            'Settings Admin',
            'Theme Settings',
            'manage_options',
            'jtt-settings-admin', [$this, 'jtt_admin_page']);

        register_setting('jtt_option_group','jtt_theme_settings',[$this,'register']);
        add_settings_section('donation_section', 'Please provide next donation time', [$this, 'donation_section_callback'], 'jtt-setting-admin');
        add_settings_field('donation_heading','Donation Heading Above Timer', [$this, 'donation_heading'],'jtt-setting-admin','donation_section',$this->options['donation_heading']);
        add_settings_field('donation_image','Donation Image URL for header', [$this, 'donation_image'],'jtt-setting-admin','donation_section',$this->options['donation_image']);
        add_settings_field('donation_toggle','Donation On/Off', [$this, 'donation_toggle'],'jtt-setting-admin','donation_section',$this->options['donation_toggle']);
        add_settings_field('donation_time','Donation Time', [$this, 'donation_time'],'jtt-setting-admin','donation_section',$this->options['donation_time']);
        add_settings_field('donation_example','Donation Field Example', [$this, 'donation_example'],'jtt-setting-admin','donation_section','');
        add_settings_field('donation_percentage','Donation Percentage ', [$this, 'donation_percentage'],'jtt-setting-admin','donation_section','');
        add_settings_field('donation_calculator_success','Calculation Generated Text ', [$this, 'donation_calculator_success'],'jtt-setting-admin','donation_section','');

        add_settings_section('page_sections', 'Social Media', [$this, 'donation_section_callback'], 'jtt-setting-admin');
        add_settings_field('donation_social_media_header','Social Media Header.', [$this, 'donation_social_media_header'],'jtt-setting-admin','page_sections',$this->options['donation_social_media_header']);
        add_settings_field('donation_social_media','Social Media Message.', [$this, 'page_section_input'],'jtt-setting-admin','page_sections',$this->options['donation_social_media']);
        add_settings_field('donation_twitter_hashtag','Twitter Hashtag.', [$this, 'donation_twitter_hashtag'],'jtt-setting-admin','page_sections',$this->options['donation_twitter_hashtag']);



    }

    public function donation_twitter_hashtag(){
        print '<input name="jtt_theme_settings[donation_twitter_hashtag]" type="text" value="'.$this->options['donation_twitter_hashtag'].'">';

    }
    public function donation_social_media_header(){
        $social_media_header = (isset($this->options['donation_social_media_header'])) ? $this->options['donation_social_media_header'] : '';
        print '<input name="jtt_theme_settings[donation_social_media_header]" type="text" value="'.$social_media_header.'" style="width:400px;">';
    }

    public function page_section_input(){
        $social_media = (isset($this->options['donation_social_media'])) ? $this->options['donation_social_media'] : '';
        print '<input name="jtt_theme_settings[donation_social_media]" type="text" value="'.$social_media.'" style="width:400px;">';
    }

    public function donation_calculator_success(){
        $text = (isset($this->options['donation_calculator_success'])) ? $this->options['donation_calculator_success'] : '';
        print '<input name="jtt_theme_settings[donation_calculator_success]" type="text" value="'.$text.'">
               <br/>
               Donation Success Example: '.$text.' $65';
    }
    public function donation_percentage(){
        $percentage = (isset($this->options['donation_percentage'])) ? $this->options['donation_percentage'] : '';
        print '<input name="jtt_theme_settings[donation_percentage]" type="text" value="'.$percentage.'">';
    }

    public function donation_section_callback(){

    }

    public function donation_toggle(){
        $toggle = (isset($this->options['donation_toggle'])) ? $this->options['donation_toggle'] : false;
        if($toggle == "on"){
            print '<input name="jtt_theme_settings[donation_toggle]" type="checkbox" checked>';
        } else{
            print '<input name="jtt_theme_settings[donation_toggle]" type="checkbox">';
        }

    }

    public function donation_example(){
        $date = strtotime($this->options['donation_date']);
        print 'The donation on the homepage will read as follows: '. $this->options['donation_text'].' '.date('F dS', $date);
    }


    public function donation_image(){
        print '<input name="jtt_theme_settings[donation_image]" type="text" value="'.$this->options['donation_image'].'">';
    }

    public function donation_heading(){
        print '<input name="jtt_theme_settings[donation_heading]" type="text" value="'.$this->options['donation_heading'].'">';
    }

    public function donation_time(){
        print '<input name="jtt_theme_settings[donation_date]" type="date" value="'.$this->options['donation_date'].'">';

    }

    public function jtt_admin_page(){
        $this->options = get_option('jtt_theme_settings');
        $action = is_multisite() ? 'edit.php?action=github-updater' : 'options.php';
        ?>
        <form method="post" action="<?php esc_attr_e($action);?>"><?php
            settings_fields('jtt_option_group');
            do_settings_sections('jtt-setting-admin');
            submit_button();?>
        </form> <?php
    }

    public function register($input){

        return $input;
    }

}