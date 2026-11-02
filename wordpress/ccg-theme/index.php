<?php
/* Fallback for posts and archives. */
get_header(); ?>
<section class="page-head"><div class="wrap"><h1><?php echo is_singular() ? esc_html( get_the_title() ) : esc_html( wp_strip_all_tags( get_the_archive_title() ) ); ?></h1></div></section>
<section class="section"><div class="wrap" style="max-width:760px">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article style="margin-bottom:40px">
    <?php if ( ! is_singular() ) : ?><h2 style="font-size:30px"><a href="<?php the_permalink(); ?>" style="text-decoration:none"><?php the_title(); ?></a></h2><?php endif; ?>
    <?php is_singular() ? the_content() : the_excerpt(); ?>
  </article>
<?php endwhile; else : ?>
  <p>Nothing here yet.</p>
<?php endif; ?>
</div></section>
<?php get_footer();
