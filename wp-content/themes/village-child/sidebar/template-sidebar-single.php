<?php do_action('discussion_before_blog_article_closed_tag');
      get_template_part( 'sidebar/template-ads', 'page' );
      get_template_part( 'sidebar/template-social-share', 'page' );
      
      if(get_current_blog_id()!=1){  // Remove ratings from main site
        get_template_part( 'sidebar/template-rate-this-article', 'page' );
      }
      
      if(is_single() && get_post_type() == 'videos'){
          get_template_part( 'sidebar/template-related-articles', 'page' );
      }
      else if(is_single() && get_post_type() == 'ai1ec_event')
      {
          get_template_part( 'sidebar/template-upcoming-events', 'page' );
      }
      else {
          get_template_part( 'sidebar/template-related-stories', 'page' );
      }
       
      
?>