<?php

/**
 * Widget that adds search form
 *
 * Class DiscussionSearchForm
 */
class DiscussionSearchForm extends DiscussionWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_search_opener', // Base ID
            'Mikado Search Opener' // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'name'        => 'search_icon_size',
                'type'        => 'textfield',
                'title'       => 'Search Icon Size (px)',
                'description' => 'Define size for Search icon'
            ),
            array(
                'name'        => 'search_icon_color',
                'type'        => 'textfield',
                'title'       => 'Search Icon Color',
                'description' => 'Define color for Search icon'
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
        global $discussion_IconCollections;

        $search_type_class    = 'mkd-search-opener';
        $search_opener_styles = array();

        if(!empty($instance['search_icon_size'])) {
            $search_opener_styles[] = 'font-size: '.$instance['search_icon_size'].'px';
        }

        if(!empty($instance['search_icon_color'])) {
            $search_opener_styles[] = 'color: '.$instance['search_icon_color'];
        }
        ?>

        <?php print $args['before_widget']; ?>
            <a  <?php discussion_inline_style($search_opener_styles); ?>
                <?php discussion_class_attribute($search_type_class); ?> href="javascript:void(0)">
                <?php $discussion_IconCollections->getSearchIcon('ion_icons', false); ?>
            </a>

            <div class="mkd-search-widget-holder">
                <form id="searchform-<?php echo rand();?>" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                    <div class="mkd-form-holder">
                        <div class="mkd-column-left">
                            <input type="text" placeholder="<?php esc_html_e('Search', 'discussionwp'); ?>" name="s" class="mkd-search-field" autocomplete="off" />
                        </div>
                        <div class="mkd-column-right">
                            <input type="submit" class="mkd-search-submit" value="GO" />
                        </div>
                    </div>
                </form>
            </div>
        <?php print $args['after_widget']; ?>
    <?php }
}