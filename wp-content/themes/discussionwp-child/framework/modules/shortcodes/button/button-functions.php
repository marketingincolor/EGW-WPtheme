<?php

if(!function_exists('discussion_get_button_html')) {
    /**
     * Calls button shortcode with given parameters and returns it's output
     * @param $params
     *
     * @return mixed|string
     */
    function discussion_get_button_html($params) {
        $button_html = discussion_execute_shortcode('mkd_button', $params);
        $button_html = str_replace("\n", '', $button_html);
        return $button_html;
    }
}