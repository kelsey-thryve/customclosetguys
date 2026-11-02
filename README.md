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

## Preview locally

Open `index.html` in a browser. No build step.
