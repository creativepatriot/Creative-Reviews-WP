<?php 

// Single Yelp Shortcode View
$arr = json_decode($output);
$html = '';
$html .= '<ul>';
foreach ( $arr->reviews as $o ):
    $html .= '<li>';
    $html .= $o->text; 
    $html .= '<img src="';
    $html .= $o->user->image_url; 
    $html .= ' ">';
    $html .= "</li>";
endforeach; 
$html .= "</ul>";