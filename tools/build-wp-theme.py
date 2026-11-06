#!/usr/bin/env python3
"""Build the WordPress theme templates from the static site.

The static pages (index.html, design.html, ...) are the design source. This script copies
their <main> content into theme templates, swapping links, asset paths, the consultation
form and the accessories list for their WordPress equivalents, then copies the assets
and zips the theme.

Run from the repo root:  python3 tools/build-wp-theme.py
Output: wordpress/ccg-theme/ (templates + assets) and wordpress/ccg-theme.zip
"""
import os, re, shutil, zipfile

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
THEME = os.path.join(ROOT, "wordpress", "ccg-theme")

# static file -> (template file, page slug used in links)
PAGES = {
    "index.html": ("front-page.php", ""),
    "design.html": ("page-design.php", "design"),
    "accessories.html": ("page-accessories.php", "accessories"),
    "contact.html": ("page-contact.php", "contact"),
}
SLUG = {k: v[1] for k, v in PAGES.items()}

ACCESSORIES_PHP = """<div class="acc-tools">
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
    </div>"""


def convert(html, page):
    main = html[html.index("<main>") + len("<main>"):html.index("</main>")]

    # Accessories: replace the JS-rendered list with the PHP loop.
    if page == "accessories.html":
        main = re.sub(r'<div class="acc-tools">.*?<noscript>.*?</noscript>', ACCESSORIES_PHP, main, flags=re.S)
        main = re.sub(r'\s*<script src="assets/js/accessories-data.js"></script>', "", main)

    # The designer URL comes from the WordPress settings (inline script), not the static config file.
    main = re.sub(r'\s*<script src="assets/js/config.js"></script>', "", main)

    # Links between pages (with optional ?query and #anchor).
    def link(m):
        f, query, anchor = m.group(1), m.group(2) or "", m.group(3) or ""
        return 'href="<?php echo ccg_url( \'%s\' ); ?>%s%s"' % (SLUG[f], query, anchor)
    main = re.sub(r'href="(%s)(\?[\w=&-]+)?(#[\w-]+)?"' % "|".join(re.escape(p) for p in PAGES), link, main)

    # Asset paths.
    main = re.sub(r'(src|href)="assets/([^"]+)"', lambda m: '%s="<?php echo ccg_asset( \'%s\' ); ?>"' % (m.group(1), m.group(2)), main)

    # Consultation form: real POST + saved / emailed.
    main = main.replace('<form class="form-grid" data-demo>', "<?php ccg_form_open(); ?>")
    main = main.replace(
        '<div class="form-done" tabindex="-1">Thanks. On the live site this request goes straight to Richard, who will call to set up your design meeting.</div>',
        '<div class="form-done<?php echo ccg_sent() ? \' show\' : \'\'; ?>" tabindex="-1">Thanks, we have your request. Richard will call to set up your design meeting.</div>')
    main = main.replace('<span class="todo">[Hours]</span>', "<?php echo ccg_hours(); ?>")
    main = re.sub(r'<span data-year>\d+</span>', "<?php echo esc_html( gmdate( 'Y' ) ); ?>", main)

    assert "data-demo" not in main and ".html" not in main, page
    return "<?php\n/* Generated from %s by tools/build-wp-theme.py. Edit the static page, then re-run the script. */\nget_header(); ?>\n%s<?php get_footer();\n" % (page, main)


def main():
    for page, (tpl, _) in PAGES.items():
        with open(os.path.join(ROOT, "public", page), encoding="utf-8") as f:
            php = convert(f.read(), page)
        with open(os.path.join(THEME, tpl), "w", encoding="utf-8") as f:
            f.write(php)

    # Assets (accessories images are kept: the importer needs them).
    dst = os.path.join(THEME, "assets")
    if os.path.isdir(dst):
        shutil.rmtree(dst)
    shutil.copytree(os.path.join(ROOT, "public", "assets"), dst, ignore=shutil.ignore_patterns("accessories-data.js", "config.js"))

    zpath = os.path.join(ROOT, "wordpress", "ccg-theme.zip")
    with zipfile.ZipFile(zpath, "w", zipfile.ZIP_DEFLATED) as z:
        for base, _, files in os.walk(THEME):
            for name in sorted(files):
                full = os.path.join(base, name)
                z.write(full, os.path.join("ccg-theme", os.path.relpath(full, THEME)))
    print("theme built:", zpath)


if __name__ == "__main__":
    main()
