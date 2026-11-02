<?php
/* Generated from design.html by tools/build-wp-theme.py. Edit the static page, then re-run the script. */
get_header(); ?>


<section class="page-head mist" style="background:var(--mist)">
  <div class="wrap">
    <p class="eyebrow">The design studio</p>
    <h1>See it in your room before anything is built.</h1>
    <p class="lede">Upload a photo, tick the features you need and get a realistic render of the finished space. Ask for changes in plain words, then send it to us for a quote. It handles most closets and garages. If your room is an unusual shape, we will design it with you at a free in-home meeting instead.</p>
  </div>
</section>

<section class="section" id="designer">
  <div class="wrap" data-designer>

    <div class="steps-pills" data-pills data-space>
      <span class="lbl">Which space?</span>
      <button type="button" class="pill on" data-value="closet">Closet, walk-in or mudroom</button>
      <button type="button" class="pill" data-value="garage">Garage</button>
    </div>
    <div class="steps-pills"><span class="lbl">Preview steps</span><span class="pill on">1. Photo and brief</span><span class="pill">2. Render and refine</span><span class="pill">3. Your details</span><span class="pill">4. Sent</span></div>
    <div class="studio">
      <div>
        <p class="kicker">Step one</p>
        <h3>Show us the space</h3>
        <label class="upload">
          <span class="tag">Sample photo</span>
          <span class="cta">Tap to upload a photo</span>
          <input type="file" accept="image/*" aria-label="Upload a photo of your space">
        </label>
        <p class="hint">Upload a photo of your wall, alcove or closet. For a walk-in, add up to 5 photos from different angles.</p>
      </div>
      <div>
        <p class="kicker">Step two</p>
        <h3>Tell us what you need</h3>
        <div data-for-space="closet">
          <p style="font-size:14px">Add the essentials. Tap any that apply:</p>
          <div class="chips" data-chips>
          <button type="button" class="chip on" aria-pressed="true">Full-height hanging rails</button>
          <button type="button" class="chip on" aria-pressed="true">Bank of soft-close drawers</button>
          <button type="button" class="chip" aria-pressed="false">Open cube shelves</button>
          <button type="button" class="chip on" aria-pressed="true">Dedicated shoe racks</button>
          <button type="button" class="chip on" aria-pressed="true">Integrated LED lighting</button>
          <button type="button" class="chip" aria-pressed="false">Full-length mirror</button>
          <button type="button" class="chip" aria-pressed="false">Island with drawers</button>
          <button type="button" class="chip" aria-pressed="false">Glass-front doors</button>
          <button type="button" class="chip" aria-pressed="false">Vanity or desk</button>
          </div>
          <label for="st-notes">Anything else? Dimensions, style, finish...</label>
          <textarea id="st-notes">Mostly hanging with 4 drawers and a shoe rack at the base. Finish: white with matte black rods.</textarea>
        </div>
        <div data-for-space="garage" hidden>
          <p style="font-size:14px">Add the essentials. Tap any that apply:</p>
          <div class="chips" data-chips>
          <button type="button" class="chip on" aria-pressed="true">Slatwall</button>
          <button type="button" class="chip on" aria-pressed="true">Base and wall cabinets</button>
          <button type="button" class="chip" aria-pressed="false">Workbench</button>
          <button type="button" class="chip on" aria-pressed="true">Epoxy floor</button>
          <button type="button" class="chip" aria-pressed="false">Fridge space</button>
          <button type="button" class="chip" aria-pressed="false">Gun safe space</button>
          <button type="button" class="chip" aria-pressed="false">Overhead storage</button>
          <button type="button" class="chip" aria-pressed="false">Tool wall</button>
          <button type="button" class="chip" aria-pressed="false">Poker or game table</button>
          </div>
          <label for="st-garage-notes">Colors, sizes, what you store...</label>
          <textarea id="st-garage-notes">Slatwall down one side with cabinets under, gray epoxy floor, space for a second fridge.</textarea>
        </div>
        <a class="btn gold block" style="margin-top:16px" href="#designer">Generate my design</a>
      </div>
    </div>
    <p class="note">Concept preview of the real designer, with a sample photo. On the live site the working AI designer loads in this panel: visitors upload their own photo and get a photorealistic render.</p>

  </div>
</section>

<section class="section mist" id="sizes">
  <div class="wrap two-col">
    <div>
      <p class="eyebrow">Built to standard depths</p>
      <h2 style="margin-top:14px">Designed to sizes we actually build.</h2>
      <p class="lede" style="margin-top:16px">The designer works to our standard build depths, so what you see is close to what we install. Final sizes are confirmed when we measure up.</p>
    </div>
    <div style="overflow-x:auto">
      <table class="spec-table">
        <thead><tr><th>Component</th><th>Depth</th></tr></thead>
        <tbody>
          <tr><td>Hanging sections</td><td>16 in</td></tr>
          <tr><td>Dressers and drawer banks</td><td>22 in</td></tr>
          <tr><td>Shelving</td><td>12 or 16 in</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section class="section" id="garage">
  <div class="wrap two-col">
    <div class="ph" style="aspect-ratio:4/3">[Garage project photo from Richard]</div>
    <div>
      <p class="eyebrow">Garage spaces</p>
      <h2 style="margin-top:14px">A garage you actually want to use.</h2>
      <p class="lede" style="margin-top:16px">Choose Garage in the designer and pick from the options we install:</p>
      <ul class="ticks">
        <li>Slatwall in six colors, with hooks and baskets for tools and gear</li>
        <li>Base and wall cabinets in a range of colors <span class="todo">[confirm cabinet color count]</span></li>
        <li>Epoxy floors in your choice of color</li>
        <li>Space planned for a second fridge, a gun safe or even a poker table</li>
      </ul>
    </div>
  </div>
</section>

<section class="section tight mist">
  <div class="wrap" style="display:flex;flex-wrap:wrap;gap:20px;align-items:center;justify-content:space-between">
    <div style="max-width:60ch"><h2 style="font-size:34px">L-shaped or tricky room?</h2><p style="margin-top:10px">Some spaces need a tape measure and a conversation. Book a free in-home design meeting and we will plan it with you.</p></div>
    <a class="btn gold" href="<?php echo ccg_url( 'contact' ); ?>">Book an in-home consultation</a>
  </div>
</section>
<?php get_footer();
