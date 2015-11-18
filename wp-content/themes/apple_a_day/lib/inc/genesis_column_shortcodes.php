<?php
function column_shortcode($atts, $content = null){
	extract( shortcode_atts( array(
		'cols' => '3',
		'position' => '',
      ), $atts ) );
      switch($cols){
      	case 5:
      		$classes[] = 'one-fifth';
      		break;
      	case 4:
      		$classes[] = 'one-fouth';
      		break;
      	case 3:
      		$classes[] = 'one-third';
      		break;
      	case 2:
      		$classes[] = 'one-half';
      		break;
      }
      switch($position){
      	case 'first':
      	case '1':
      		$classes[] = 'first';
      	case 'last':
      		$classes[] = 'last';
      }
      return '<div class="'.implode(' ',$classes).'">'.$content.'</div>';
}

add_shortcode('columns','column_shortcode');