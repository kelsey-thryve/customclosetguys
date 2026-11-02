<?php
/* Generated from what-we-build.html by tools/build-wp-theme.py. Edit the static page, then re-run the script. */
get_header(); ?>


<section class="page-head">
  <div class="wrap">
    <p class="eyebrow">What we build</p>
    <h1>Every room that holds your things.</h1>
    <p class="lede">Each project is measured, designed and built for one space, with solid wood drawers and finishes chosen for your home. Pick a room to start a design with it.</p>
  </div>
</section>
<section class="section">
  <div class="wrap">
    <article class="svc" id="walk-in">
      <img src="<?php echo ccg_asset( 'img/work/walkin-island-drawers.jpg' ); ?>" alt="Walk-in closets" loading="lazy">
      <div><h3>Walk-in closets</h3><p>Drawer banks, cabinets, open shelving and hanging space planned around your clothes, bags and shoes.</p></div>
      <a class="link-arrow" href="<?php echo ccg_url( 'design' ); ?>">Design a walk-in</a>
    </article>
    <article class="svc" id="closet">
      <img src="<?php echo ccg_asset( 'img/work/closet-center-drawers.jpg' ); ?>" alt="Smaller closets" loading="lazy">
      <div><h3>Smaller closets</h3><p>A central drawer bank with shelving and hanging on each side, making the most of a compact closet.</p></div>
      <a class="link-arrow" href="<?php echo ccg_url( 'design' ); ?>">Design a closet</a>
    </article>
    <article class="svc" id="mudroom">
      <img src="<?php echo ccg_asset( 'img/work/mudroom-pine-bench.jpg' ); ?>" alt="Mudrooms and entryways" loading="lazy">
      <div><h3>Mudrooms and entryways</h3><p>Benches, coat hooks, drawers and shelving that give bags, coats and shoes a place by the door.</p></div>
      <a class="link-arrow" href="<?php echo ccg_url( 'design' ); ?>">Design a mudroom</a>
    </article>
    <article class="svc" id="garage">
      <div class="ph">[Garage spaces photo from Richard]</div>
      <div><h3>Garage spaces</h3><p>Cabinets, workbenches and wall shelving that turn the garage into an organized space you actually want to use.</p></div>
      <a class="link-arrow" href="<?php echo ccg_url( 'design' ); ?>#garage">Design a garage</a>
    </article>
    <article class="svc" id="cabinetry">
      <div class="ph">[Cabinetry photo from Richard]</div>
      <div><h3>Cabinetry</h3><p>Upper and lower cabinets with countertops, as seen in our gallery. <span class="todo">[Confirm room type: laundry room?]</span></p></div>
      <a class="link-arrow" href="<?php echo ccg_url( 'contact' ); ?>">Ask about cabinetry</a>
    </article>
  </div>
</section>
<section class="section mist">
  <div class="wrap two-col">
    <img src="<?php echo ccg_asset( 'img/work/walkin-glass-doors.jpg' ); ?>" alt="Walk-in closet with glass-front cabinets and lit shelving" loading="lazy">
    <div>
      <p class="eyebrow">In every build</p>
      <h2 style="margin-top:14px">The details that make it work.</h2>
      <ul class="ticks">
        <li>Solid wood drawers</li>
        <li>Double and long hanging sized to what you own</li>
        <li>Shoe walls, cubbies and display shelving</li>
        <li>Islands, vanities and built-in desks</li>
        <li>Integrated LED lighting and glass-front doors</li>
        <li>Finished with hardware and accessories, installed by our team</li>
      </ul>
      <p style="margin-top:24px"><a class="btn gold" href="<?php echo ccg_url( 'design' ); ?>">Start a design</a></p>
    </div>
  </div>
</section>

<section class="section dark contact" id="contact">
  <div class="wrap">
    <div>
      <p class="eyebrow">Free consultation</p>
      <h2 style="margin-top:14px">Book a free <em>design consultation.</em></h2>
      <p class="lede" style="margin-top:18px;max-width:44ch">We come to you to talk through your goals, take measurements and outline a plan. If you have already made a design online, mention it and we will bring it along.</p>
      <dl>
        <dt>Phone</dt><dd><a href="tel:+15055461788">(505) 546-1788</a></dd>
        <dt>Email</dt><dd><a href="mailto:richard@customclosetguys.com">richard@customclosetguys.com</a></dd>
        <dt>Service area</dt><dd>Albuquerque, Santa Fe and surrounding communities</dd>
        <dt>Hours</dt><dd><?php echo ccg_hours(); ?></dd>
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

<?php get_footer();
