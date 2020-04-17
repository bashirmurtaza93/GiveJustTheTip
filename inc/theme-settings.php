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
        add_settings_field('donation_image','Donation Image URL for header', [$this, 'donation_image'],'jtt-setting-admin','donation_section',$this->options['donation_image']);
        add_settings_field('donation_time','Donation Time', [$this, 'donation_time'],'jtt-setting-admin','donation_section',$this->options['donation_time']);
        add_settings_field('donation_example','Donation Field Example', [$this, 'donation_example'],'jtt-setting-admin','donation_section','');
        add_settings_field('donation_percentage','Donation Percentage ', [$this, 'donation_percentage'],'jtt-setting-admin','donation_section','');
        add_settings_field('donation_calculator_success','Calculation Generated Text ', [$this, 'donation_calculator_success'],'jtt-setting-admin','donation_section','');

        add_settings_section('page_sections', 'Break up the order of posts', [$this, 'donation_section_callback'], 'jtt-setting-admin');
        add_settings_field('page_section_input','Name of posts. Please break up each post name with comma.', [$this, 'page_section_input'],'jtt-setting-admin','page_sections',$this->options['page_section_input']);



    }


    public function page_section_input(){
        $pages = (isset($this->options['page_section_input'])) ? $this->options['page_section_input'] : '';
        print '<input name="jtt_theme_settings[page_section_input]" type="text" value="'.$pages.'" style="width:400px;">';
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

    public function donation_example(){
        $date = strtotime($this->options['donation_date']);
        print 'The donation on the homepage will read as follows: '. $this->options['donation_text'].' '.date('F dS', $date);
    }


    public function donation_image(){
        print '<input name="jtt_theme_settings[donation_image]" type="text" value="'.$this->options['donation_image'].'">';
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