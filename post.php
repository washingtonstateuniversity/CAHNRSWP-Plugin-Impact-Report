<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<figure class="article-thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a></figure>

	<div>

		<header class="article-header">
			<hgroup>
				<h3 class="article-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h3>
			</hgroup>
		</header>

		<?php
			$summary = get_post_meta( get_the_ID(), '_impact_report_summary', true );
			if ( $summary ) {
				?><a href="<?php the_permalink(); ?>" class="article-summary"><?php echo wp_kses_post( $summary ); ?></a><?php
			}
		?>

	</div>

</article>