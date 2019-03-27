<?php
/**
 * Created by PhpStorm.
 * User: Sanchoss
 * Date: 3/13/19
 * Time: 16:33
 */

function shortcode_handler($atts)
{
    return '<iframe src="https://app.mightyforms.com/form/' . $atts['id'] . '/design" width="100%" height="500px" frameborder="0"></iframe>';
}

add_shortcode('mightyforms', 'shortcode_handler');

