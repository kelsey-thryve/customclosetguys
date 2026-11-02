<?php
/* Generated from getting-started.html by tools/build-wp-theme.py. Edit the static page, then re-run the script. */
get_header(); ?>


<section class="page-head">
  <div class="wrap">
    <p class="eyebrow">Getting started</p>
    <h1>From a photo to a finished closet.</h1>
    <p class="lede">It starts with a complimentary design meeting at your home, and nothing gets built until the design is right for you.</p>
  </div>
</section>
<section class="section">
  <div class="wrap">
    <div class="steps">
      <div class="step"><div class="num">1</div><h3>Design meeting</h3><p>A complimentary onsite consultation to talk through your goals, take measurements and outline a plan.</p></div>
      <div class="step"><div class="num">2</div><h3>Design review</h3><p>We turn those goals into a fully customized design, weighing function, budget and added property value.</p></div>
      <div class="step"><div class="num">3</div><h3>Design prep</h3><p>We can bring portable clothes racks and shelves so your wardrobe stays accessible during the build.</p><span class="badge">Optional</span></div>
      <div class="step"><div class="num">4</div><h3>Build</h3><p>From sketching the design on your walls to installing hardware and accessories, our team builds your new closet.</p></div>
      <div class="step"><div class="num">5</div><h3>Enjoy</h3><p>Save time. Live better. Shop smarter.</p></div>
    </div>
  </div>
</section>
<section class="section mist">
  <div class="wrap two-col">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;background:#fff;padding:12px;border:1px solid var(--line)">
      <img src="<?php echo ccg_asset( 'img/work/prep-rack.jpg' ); ?>" alt="Portable clothes rack" style="aspect-ratio:1;object-fit:contain">
      <img src="<?php echo ccg_asset( 'img/work/prep-shelves.jpg' ); ?>" alt="Portable shelving unit" style="aspect-ratio:1;object-fit:contain">
    </div>
    <div>
      <p class="eyebrow">Design prep</p>
      <h2 style="margin-top:14px">Keep your wardrobe while we build.</h2>
      <p class="lede" style="margin-top:16px">We can bring our portable clothes racks and shelves to move your wardrobe out and keep everything accessible during the build. Just ask at your design meeting.</p>
    </div>
  </div>
</section>
<section class="section">
  <div class="wrap two-col" style="align-items:start">
    <div>
      <p class="eyebrow">Questions</p>
      <h2 style="margin-top:14px">Before your design meeting.</h2>
      <p class="lede" style="margin-top:16px">Want a head start? <a class="link-arrow" href="<?php echo ccg_url( 'design' ); ?>">Design it in your room first</a> and bring the render along.</p>
    </div>
    <div class="faq">
      <details open><summary>Is the design meeting really free?</summary><p>Yes. We come to your home, talk through your goals, take measurements and outline a plan at no cost.</p></details>
      <details><summary>Which areas do you cover?</summary><p>Albuquerque, Santa Fe and the surrounding communities.</p></details>
      <details><summary>Do I need to empty my closet?</summary><p>We can bring portable racks and shelves so your clothes stay accessible during the build. It is optional.</p></details>
      <details><summary>Can I start with the online designer?</summary><p>Yes. Upload a photo of your space, pick the features you want and send us the render. We will bring it to your design meeting.</p></details>
      <details><summary>How long does a build take?</summary><p><span class="todo">[Typical timeline from Richard]</span></p></details>
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
