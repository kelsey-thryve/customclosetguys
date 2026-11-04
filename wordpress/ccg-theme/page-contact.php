<?php
/* Generated from contact.html by tools/build-wp-theme.py. Edit the static page, then re-run the script. */
get_header(); ?>



<section class="section dark contact" id="contact">
  <div class="wrap">
    <div>
      <p class="eyebrow">Free consultation</p>
      <h1 style="margin-top:14px">Book a free <em>design consultation.</em></h1>
      <p class="lede" style="margin-top:18px;max-width:44ch">We come to you to talk through your goals, take measurements and outline a plan. If you have already made a design online, mention it and we will bring it along.</p>
      <dl>
        <dt>Phone</dt><dd><a href="tel:+15055461788">(505) 546-1788</a></dd>
        <dt>Email</dt><dd><a href="mailto:richard@customclosetguys.com">richard@customclosetguys.com</a></dd>
        <dt>Service area</dt><dd>Albuquerque, Santa Fe and surrounding communities</dd>
      </dl>
    </div>
    <div>
      <?php ccg_form_open(); ?>
        <div><label for="cf-name">Name</label><input id="cf-name" name="name" type="text" autocomplete="name" required></div>
        <div><label for="cf-phone">Phone</label><input id="cf-phone" name="phone" type="tel" autocomplete="tel" required></div>
        <div class="full"><label for="cf-email">Email</label><input id="cf-email" name="email" type="email" autocomplete="email"></div>
        <div class="full"><label for="cf-space">Which space?</label>
          <select id="cf-space" name="space"><option>Walk-in closet</option><option>Smaller / reach-in closet</option><option>Mudroom or entryway</option><option>Garage</option><option>Cabinetry</option><option>Something else</option></select></div>
        <div class="full"><label for="cf-msg">Tell us about it</label><textarea id="cf-msg" name="message" placeholder="Rough size of the space, what is not working now, any styles you like"></textarea></div>
        <div class="full hp" aria-hidden="true"><label for="cf-web">Leave this empty</label><input id="cf-web" name="website" type="text" tabindex="-1" autocomplete="off"></div>
        <div class="full"><button class="btn gold" type="submit">Request my consultation</button></div>
      </form>
      <div class="form-done<?php echo ccg_sent() ? ' show' : ''; ?>" tabindex="-1">Thanks, we have your request. Richard will call to set up your design meeting.</div>
    </div>
  </div>
</section>

<section class="section">
  <div class="wrap two-col">
    <img src="<?php echo ccg_asset( 'img/work/walkin-chandelier.jpg' ); ?>" alt="Finished walk-in closet" loading="lazy">
    <div>
      <p class="eyebrow">What happens next</p>
      <h2 style="margin-top:14px">We come to you.</h2>
      <ul class="ticks">
        <li>Richard calls to set a time for your design meeting</li>
        <li>We measure up and talk through what you store and how you use the space</li>
        <li>You get a fully customized design to review before anything is built</li>
      </ul>
      <p style="margin-top:24px"><a class="link-arrow" href="<?php echo ccg_url( '' ); ?>#process">See the full process</a></p>
    </div>
  </div>
</section>

<section class="section mist" id="projects">
  <div class="wrap">
    <div class="head-split">
      <div><p class="eyebrow">Projects</p><h2>Recent work.</h2></div>
      <p class="lede">A few recent closets and mudrooms, each designed and built for one space.</p>
    </div>
    <div class="work-grid">
      <figure class="wide"><img src="<?php echo ccg_asset( 'img/work/walkin-skylights-island.jpg' ); ?>" alt="Island walk-in closet under skylights" loading="lazy"><figcaption>Island walk-in under skylights</figcaption></figure>
      <figure><img src="<?php echo ccg_asset( 'img/work/reach-in-lit.jpg' ); ?>" alt="Lit reach-in closet with shoe tower" loading="lazy"><figcaption>Lit reach-in with shoe tower</figcaption></figure>
      <figure><img src="<?php echo ccg_asset( 'img/work/walkin-glass-doors.jpg' ); ?>" alt="Glass-front cabinets with lighting" loading="lazy"><figcaption>Glass-front cabinets with lighting</figcaption></figure>
      <figure><img src="<?php echo ccg_asset( 'img/work/walkin-walnut-top.jpg' ); ?>" alt="Drawer bank with walnut top" loading="lazy"><figcaption>Drawer bank with walnut top</figcaption></figure>
      <figure><img src="<?php echo ccg_asset( 'img/work/mudroom-pine-bench.jpg' ); ?>" alt="Pine mudroom bench with hooks and drawers" loading="lazy"><figcaption>Mudroom bench with hooks and drawers</figcaption></figure>
    </div>
    <p style="margin-top:28px"><a class="link-arrow" href="<?php echo ccg_url( '' ); ?>#work">See more projects</a></p>
  </div>
</section>
<?php get_footer();
