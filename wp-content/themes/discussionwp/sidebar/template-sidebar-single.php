<?php do_action('discussion_before_blog_article_closed_tag');
      get_template_part( 'sidebar/template-social-share', 'page' );
      get_template_part( 'sidebar/template-rate-this-article', 'page' );
      get_template_part( 'sidebar/template-ads', 'page' );
      if(is_single() && get_post_type() == 'videos'){
          get_template_part( 'sidebar/template-related-articles', 'page' );
      }else {
          get_template_part( 'sidebar/template-related-stories', 'page' );
      }
       
      
?>