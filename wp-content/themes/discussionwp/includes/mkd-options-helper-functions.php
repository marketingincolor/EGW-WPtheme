<?php

if(!function_exists('discussion_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function discussion_is_responsive_on() {
        return discussion_options()->getOptionValue('responsiveness') !== 'no';
    }
}