<?php


/** *
 * @author DemonIa sanchoclo@gmail.com
 * @function shortcode_handler
 * @description This function render iframe by given form id
 * @param $atts
 * @return string
 */
function shortcode_handler($atts)
{
    return '<iframe src="https://dev.mightyforms.com/form/' . $atts['id'] . '/design" width="100%" height="500px" frameborder="0"></iframe>';
}

add_shortcode('mightyforms', 'shortcode_handler');

