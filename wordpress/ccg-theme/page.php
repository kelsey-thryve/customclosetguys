<?php
/* Any other page (privacy policy, etc.): standard editor content in the site's layout. */
get_header(); ?>
<section class="page-head"><div class="wrap"><h1><?php the_title(); ?></h1></div></section>
<section class="section"><div class="wrap" style="max-width:760px">
<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
</div></section>
<?php get_footer();
