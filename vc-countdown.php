<?php
/**
 * Plugin Name: VC Countdown Timer
 * Plugin URI: http://themepicasso.com/
 * Description: Displays a Countdown Timer Circle in your page from Visual Composer Elements or as a shortcode.
 * Version: 1.1
 * Author: Muntasir Mahmud
 * Author URI: http://themepicasso.com/
 * Text Domain: vc_countdown
 * License: GPL2
 */


if( ! defined( 'WPINC' ) ) die;

if ( ! class_exists( 'VC_Countdown' ) ) {

    class VC_Countdown {  
        
      public function __construct() {
        add_action( 'wp_enqueue_scripts', array($this, 'ct_enqueue_scripts' ) );
        add_action( 'plugins_loaded', array($this, 'ct_plugin_text_domain' ) );
        add_shortcode( 'ct_countdown', array($this, 'ct_countdown_render') );
      }

      public function ct_enqueue_scripts() {
        wp_enqueue_style( 'ct-style', plugins_url( 'assets/css/custom.css', __FILE__ ) );
        // Js files
        wp_enqueue_script( 'ct-countdown', plugins_url( 'assets/js/jquery.lwtCountdown-1.0.js', __FILE__ ), array('jquery'), null, true );
        wp_enqueue_script( 'ct-custom', plugins_url( 'assets/js/custom.js', __FILE__ ), array('jquery'), null, true );
      }

      /* Load text domain */
      public function ct_plugin_text_domain() {
        load_plugin_textdomain( 'vc_countdown', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
      }

      public function ct_countdown_render($atts) {
          extract( shortcode_atts( array (
              'day' => '2',
              'month' => 'February',
              'year' => '2016',
              'digit_color' => '#f15b5d',
              'border_color' => '#333333'
          ), $atts ) );

          $output = '<div class="event-countdown wow fadeInUp" data-wow-delay=".5s">
                        <div id="countdown_dashboard" class="countdown text-center">
                          <div class="dash">
                            <div class="weeks_dash">
                              <div class="time-number" data-border-color="'.$border_color.'">
                                <span class="digit" data-digit-color="'.$digit_color.'">0</span>
                                <span class="digit">0</span>
                              </div>
                              <span class="dash_title">'.__('Weeks', 'vc_countdown').'</span>
                            </div>
                          </div>

                          <div class="dash">
                            <div class="days_dash" data-day="'.$day.'">
                              <div class="time-number">
                                <span class="digit">0</span>
                                <span class="digit">0</span>
                              </div>
                              <span class="dash_title">'.__('Days', 'vc_countdown').'</span>
                            </div>
                          </div>

                          <div class="dash">
                            <div class="hours_dash" data-month="'.$month.'">
                              <div class="time-number">
                                <span class="digit">0</span>
                                <span class="digit">0</span>
                              </div>
                              <span class="dash_title">'.__('Hours', 'vc_countdown').'</span>
                            </div>
                          </div>

                          <div class="dash">
                            <div class="minutes_dash" data-year="'.$year.'">
                              <div class="time-number">
                                <span class="digit">0</span>
                                <span class="digit">0</span>
                              </div>
                              <span class="dash_title">'.__('Minutes', 'vc_countdown').'</span>
                            </div>
                          </div>

                          <div class="dash">
                            <div class="seconds_dash">
                              <div class="time-number">
                                <span class="digit">0</span>
                                <span class="digit">0</span>
                              </div>
                              <span class="dash_title">'.__('Seconds', 'vc_countdown').'</span>
                            </div>
                          </div>
                        </div>
                      </div>';

          return $output;
        }

        public function dates_month() {
            $dates_month=array();
            for($i=1;$i<=31;$i++) {
                $dates_month[] = $i;
            }

            return $dates_month;
        }

        public function no_of_years() {
            $years_array = array();
            for($i=2015;$i<=2050;$i++) {
                $years_array[] = $i;
            }

            return $years_array;
        }

    }
}

$ct_instance = new VC_Countdown();

if ( function_exists('vc_map') ) {

  vc_map( array(
      "name" => __("Countdown Timer", "vc_countdown"),
      "base" => "ct_countdown",
      "category" => __('Content', 'vc_countdown'),
      "params" => array(
            array(
                "type" => "dropdown",
                "heading" => __("Year", "vc_countdown"),
                "param_name" => "year",
                "value" => $ct_instance->no_of_years(),
                "std" => "2016",
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Month", "vc_countdown"),
                "param_name" => "month",
                "value" => array(
                        '1' => 'January',
                        '2' => 'February',
                        '3' => 'March',
                        '4' => 'April',
                        '5' => 'May',
                        '6' => 'June',
                        '7' => 'July ',
                        '8' => 'August',
                        '9' => 'September',
                        '10' => 'October',
                        '11' => 'November',
                        '12' => 'December',
                    ),
                "std" => "February",

            ),
            array(
                "type" => "dropdown",
                "heading" => __("Day", "vc_countdown"),
                "param_name" => "day",
                "description" => __("Please select the date for a month that does exist", "vc_countdown"),
                "value" => $ct_instance->dates_month(),
                "std" => "2"
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Digit Color", "vc_countdown"),
                "param_name" => "digit_color",
                "description" => __("Choose color for the Digit", "vc_countdown"),
                "std" => "#f15b5d",
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Border Color", "vc_countdown"),
                "param_name" => "border_color",
                "description" => __("Choose color for the Border", "vc_countdown"),
                "std" => "#333333",
            ),
        )
    ) );

}
