<?php
/* Generated from accessories.html by tools/build-wp-theme.py. Edit the static page, then re-run the script. */
get_header(); ?>


<section class="page-head">
  <div class="wrap">
    <p class="eyebrow">Accessories</p>
    <h1>Finish your closet.</h1>
    <p class="lede">The hangers, stands and organizers we like to see in a finished closet. Each one links to Amazon, where you can order it straight to your door.</p>
  </div>
</section>
<section class="section">
  <div class="wrap">
    <div class="acc-tools">
      <nav class="jump" aria-label="Accessory categories">
<?php $ccg_groups = ccg_accessory_groups(); foreach ( $ccg_groups as $g ) : ?>
        <a class="pill" href="#<?php echo esc_attr( $g['term']->slug ); ?>"><?php echo esc_html( $g['term']->name ); ?> (<?php echo count( $g['items'] ); ?>)</a>
<?php endforeach; ?>
      </nav>
    </div>
    <p class="disclosure" style="margin-bottom:48px">As an Amazon Associate, Custom Closet Guys earns from qualifying purchases. Prices and availability are set by Amazon.</p>
    <div>
<?php if ( ! $ccg_groups ) : ?>
      <p>No accessories yet. Add them under <strong>Accessories</strong> in wp-admin, or run <em>Import starter content</em> in Settings &rarr; Custom Closet Guys.</p>
<?php endif; ?>
<?php foreach ( $ccg_groups as $g ) : ?>
      <section class="acc-cat" id="<?php echo esc_attr( $g['term']->slug ); ?>">
        <header><h2 style="font-size:32px"><?php echo esc_html( $g['term']->name ); ?></h2><p><?php echo esc_html( $g['term']->description ); ?></p></header>
        <div class="acc-grid">
<?php foreach ( $g['items'] as $p ) : $ccg_link = get_post_meta( $p->ID, '_ccg_url', true ); ?>
          <a class="product" href="<?php echo esc_url( $ccg_link ); ?>" target="_blank" rel="sponsored noopener">
            <div class="img"><?php echo get_the_post_thumbnail( $p->ID, 'ccg-product', array( 'loading' => 'lazy', 'alt' => esc_attr( get_the_title( $p ) ) ) ); ?></div>
            <div class="body"><h3><?php echo esc_html( get_the_title( $p ) ); ?></h3><p><?php echo esc_html( $p->post_excerpt ); ?></p><span class="link-arrow go">View on Amazon</span></div>
          </a>
<?php endforeach; ?>
        </div>
      </section>
<?php endforeach; ?>
    </div>
  </div>
</section>
<section class="section tight mist">
  <div class="wrap" style="display:flex;flex-wrap:wrap;gap:20px;align-items:center;justify-content:space-between">
    <div style="max-width:60ch"><h2 style="font-size:34px">Need the closet to go with them?</h2><p style="margin-top:10px">We design and build custom closets across Albuquerque and Santa Fe.</p></div>
    <a class="btn gold" href="<?php echo ccg_url( 'design' ); ?>">Design yours</a>
  </div>
</section>
<?php get_footer();
