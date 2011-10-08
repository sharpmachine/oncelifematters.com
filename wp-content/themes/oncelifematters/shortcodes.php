<?php

function paypal_mp_shortcode($atts, $content=null){
	
		extract(shortcode_atts( array('amount' => '', 'id' => ''), $atts));
		return $content . '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=' . $id . ' " class="paypal-button mp">' . $amount . '</a>';
  }

add_shortcode('paypal-mp', 'paypal_mp_shortcode');

function paypal_otd_shortcode($atts, $content=null){
	
		extract(shortcode_atts( array('id' => ''), $atts));  
		return $content . '<span class="or-make-a">or make a</span><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=' . $id . ' "class="paypal-button ot">One-time Donation</a>';
  }

add_shortcode('paypal-otd', 'paypal_otd_shortcode');
    
function register_now_shortcode($atts, $content=null){
	
		extract(shortcode_atts( array('url' => ''), $atts));  
		return $content . '<a class="super-link no-ml" href="' . $url . '">Register Now</a>';
  }

add_shortcode('register', 'register_now_shortcode');

function leave_empty_shortcode($atts, $content=null){
	  
		return $content . ' ';
  }

add_shortcode('LEAVE-EMPTY', 'leave_empty_shortcode');

function page_links_shortcode($atts, $content=null){
	  
		extract(shortcode_atts( array('title' => '', 'link_title' => '', 'url' => ''), $atts)); 
		return $content . ' 
		<div class="page-links">
		<h3>'. $title .'</h3>
		<a class="super-link" title="'. $title .'" href="'.$url.'">'.$link_title . '</a>
		</div>
		';
  }

add_shortcode('page_link', 'page_links_shortcode');

?>


