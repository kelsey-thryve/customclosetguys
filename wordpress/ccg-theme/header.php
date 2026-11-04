<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php if ( ccg_setting( 'test_mode' ) ) : ?>
<div class="test-banner"><b>Test site.</b> Preview of the new Custom Closet Guys website. Not live yet.</div>
<?php endif; ?>
<header class="site-header">
  <div class="wrap" style="position:relative">
    <a class="logo" href="<?php echo ccg_url(); ?>" aria-label="Custom Closet Guys home"><b>C<i>U</i>STOM CLOSE<i>T</i></b><small>GUYS</small></a>
    <button class="nav-toggle" aria-expanded="false" aria-controls="site-nav">Menu</button>
    <nav class="nav" id="site-nav" aria-label="Main">
      <a href="<?php echo ccg_url( 'design' ); ?>"<?php echo ccg_current( 'design' ); ?>>Design yours</a>
      <a href="<?php echo ccg_url(); ?>#services">What we build</a>
      <a href="<?php echo ccg_url(); ?>#process">The Process</a>
      <a href="<?php echo ccg_url(); ?>#work">Our work</a>
      <a href="<?php echo ccg_url( 'accessories' ); ?>"<?php echo ccg_current( 'accessories' ); ?>>Accessories</a>
      <a href="<?php echo ccg_url( 'contact' ); ?>"<?php echo ccg_current( 'contact' ); ?>>Contact</a>
      <a class="tel" href="tel:+15055461788">(505) 546-1788</a>
      <a class="btn gold small" href="<?php echo ccg_url( 'contact' ); ?>">Free consultation</a>
    </nav>
  </div>
</header>
<main>
