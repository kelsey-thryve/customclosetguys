# Custom Closet Guys: new website (test build)

Static preview of the new customclosetguys.com, built from the approved homepage design. Every page carries a "Test site" banner and `noindex`, so search engines will not pick it up.

## Pages

| File | Page |
| --- | --- |
| `index.html` | Home: hero, design studio preview, what we build, getting started, recent work, reviews, consultation form |
| `design.html` | Design yours: closet or garage pre-screen, studio panel (AI designer loads here), standard build depths, L-shaped room fallback |
| `what-we-build.html` | Walk-ins, smaller closets, mudrooms, garages, cabinetry |
| `getting-started.html` | The 5-step process, design prep, FAQ |
| `gallery.html` | Filterable photo gallery with lightbox |
| `accessories.html` | Amazon accessory picks, grouped by category (carried over from the current site) |
| `contact.html` | Consultation form and contact details |

## Editing the accessories

All products live in `assets/js/accessories-data.js`. Each entry has a category, name, short note, image and Amazon link. Add, remove or reorder entries there; the page builds itself from that list. Links keep the existing Amazon Associates tag.

## Still to do before launch

Gold `[bracket]` tags on the pages mark content still needed:

- Richard's edited photo library (garage and cabinetry photos in particular). Current photos come from the existing site.
- Real reviews, rating and review count.
- Business hours.
- Confirm the cabinetry room type and garage cabinet color count.
- Typical build timeline (FAQ).
- Connect the live AI designer in the studio panel and wire the forms to email / WordPress.

## WordPress theme (for testing and launch)

`wordpress/ccg-theme.zip` is the same site as a WordPress theme. It adds what the static preview can't do:

- **Accessories editable in wp-admin** (Accessories in the sidebar): product name, note, photo, Amazon link, category and order. No code needed.
- **Working consultation form.** Each request is emailed to the address in Settings and also saved under **Enquiries**, so nothing is lost while email is being set up.
- **Settings → Custom Closet Guys:** enquiry email, business hours, test mode (banner + hidden from Google) and a staging lock (only logged-in users can see the site).
- Page URLs match the current site (`/gallery/`, `/accessories/`, `/getting-started/`), so existing links keep working after launch.

### Set up a test site for Richard

1. On the host, create a **staging copy** of the WordPress site (most hosts have a one-click "Staging" button; otherwise use a subdomain such as `test.customclosetguys.com` with a fresh WordPress install).
2. On the staging site: Appearance → Themes → Add New → Upload Theme → choose `ccg-theme.zip` → Activate.
3. Settings → Custom Closet Guys → click **Import starter content** (creates the pages and the 44 accessories), set the enquiry email, and tick **Staging lock**.
4. Settings → Permalinks → choose "Post name" → Save.
5. Give Richard a login (Users → Add New) so he can see the site and edit the accessories.

### Launch day

On the live site: upload and activate the theme, run **Import starter content**, untick **Test mode** and make sure **Staging lock** is off.

### Editing the design

The static pages are the design source. After changing them, run `python3 tools/build-wp-theme.py` to regenerate the theme templates and the zip. Theme logic lives in `wordpress/ccg-theme/functions.php` and `wordpress/ccg-theme/inc/`.

## Preview locally

Open `index.html` in a browser. No build step.
