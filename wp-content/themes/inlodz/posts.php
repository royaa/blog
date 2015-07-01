<div class="post-warp">
<?php if ( have_posts() ) { ?>
<?php while ( have_posts() ) { the_post(); global $post; ?>
	<div class="post-box">	    	
	    	<?php if ( post_password_required( $post->ID ) ) { ?>
	    	<div class="password-post-content">
	    		<?php echo get_the_password_form( $post->ID ); ?>
	    	</div>
	    	<?php } else { ?>			
			<div class="post-thumb">				
				<figure class="effect-bubba">
				<?php echo inlo_get_thumb( $post->ID, $post->post_title, $post->post_content, true ); ?>
					<figcaption>
						<h2></h2>
						<p><i class="fa fa-file-text-o"></i></p>
						<a href="<?php echo get_permalink(); ?>">View more</a>
					</figcaption>
				</figure>				
				<div class="clear"></div>	
			</div>			
	    	<div class="post-content">
			<div class="post-header">
					<h2 class="post-title tra"><a href="<?php the_permalink(); ?>" class="tra"><?php the_title(); ?></a></h2>
			</div>
	    	<?php
	    		$desc = has_excerpt();
	    		if ( ! $desc ) {
	    			// 去掉表情 和 回复可见内容
	    			$post_content = preg_replace( '/(\s\:.*\:\s)|(<\!--inlo_hide_start-->([\s\S]*)<\!--inlo_hide_end-->)/i', '', get_the_content() );
	    			echo inlo_substr( strip_tags( $post_content ), 260, '<span class="read-more" style="margin-left:5px;color:#aaa">...</span>' ) ;
	    		} else {
	    			the_excerpt();
	    		}
	    	?>
	    	</div>
			<div class="post-tags">				
				<span class="views" title="访问人数"><i class="fa fa-eye"></i><a>&nbsp;热度&nbsp;<?php echo inlo_get_view( $post->ID ); ?></a></span>
				<span class="comments" title="评论数"><i class="fa fa-comment"></i><a>&nbsp;评论&nbsp;<?php echo inlo_comts_count( $post->ID ); ?></a></span>
				<span class="podate" title="发布时间"><i class="fa fa-clock-o"></i><a>&nbsp;时间&nbsp;<?php the_time('Y.n.j'); ?></a></span>
				<div class="clear"></div>	
			</div>
	    	<div class="clear"></div>	
	    	<?php } ?>
	</div>
	<div class="clear"></div>
<?php  } ?>
<?php } ?>
</div>
<?php echo inlo_pagenavi(); ?>