# Frontend Quicklinks (`ws_quicklinks`)

TYPO3 extension providing personal frontend quicklinks with a drag & drop
manager. Every visitor can pick and order their own quicklinks; the order is
stored **in the frontend user record when logged in**, otherwise **in a cookie**.

## Features

* List content element rendering the visitor's personal quicklinks
* Drag & drop manager to choose and reorder quicklinks
* Per-user persistence: `fe_users` record when logged in, cookie otherwise
* Bundled Sortable.js – no third-party CDN request
* Fully translatable (English source, German translation included)

## Requirements

| Extension | TYPO3     | PHP    |
|-----------|-----------|--------|
| 0.1.x     | 14.0–14.4 | 8.2+   |

## Installation

Install via Composer:

```bash
composer require wapplersystems/quicklinks
```

Set up the extension (creates the `fe_users.tx_wsquicklinks_order` column):

```bash
vendor/bin/typo3 extension:setup --extension=ws_quicklinks
```

> **Classic (non-Composer) mode:** install the extension from the TER via the
> Extension Manager, then run the database compare in the *Maintenance* module
> to create the `fe_users.tx_wsquicklinks_order` column.

Finally add the site set **WS Quicklinks** (`wapplersystems/quicklinks`) to your
site configuration so the extension's TypoScript is loaded:

```yaml
# config/sites/<identifier>/config.yaml
dependencies:
  - wapplersystems/quicklinks
```

## Configuration

The site set exposes the following settings (Site Settings module or
`config/sites/<identifier>/settings.yaml`):

| Setting                                          | Description                                                             |
|--------------------------------------------------|-------------------------------------------------------------------------|
| `plugin.tx_wsquicklinks.persistence.storagePid`  | Storage folder holding the quicklink records                            |
| `plugin.tx_wsquicklinks.settings.editPageUid`    | Page the list plugin's *edit* link points to (page with the manager)    |

```yaml
# config/sites/<identifier>/settings.yaml
plugin:
  tx_wsquicklinks:
    persistence:
      storagePid: 42
    settings:
      editPageUid: 43
```

Instead of `persistence.storagePid` you can also set the *Record Storage Page*
directly on the list/manager plugin.

The Fluid template roots can be overridden through the constants
`plugin.tx_wsquicklinks.view.templateRootPath`, `partialRootPath` and
`layoutRootPath`.

## Usage

1. Create the quicklink records (**Name**, **Link**, optional **Icon**) in the
   storage folder configured above.
2. Add the **Quicklinks list** content element where the personal quicklinks
   should appear.
3. Add the **Quicklinks manager** content element on the page referenced by
   `editPageUid` so visitors can choose and reorder their quicklinks.

### Content elements

* **Quicklinks list** – renders the visitor's chosen quicklinks in their stored
  order. Falls back to *all* quicklinks when nothing has been personalised yet.
* **Quicklinks manager** – drag & drop UI to move quicklinks between *Available*
  and *Selected* and to reorder the selection. The order is saved on every drag.

## How ordering is stored

The manager writes the order on every drag:

* **Cookie** `quicklinks_order` – a comma-separated uid list (`SameSite=Lax`),
  the fallback for anonymous visitors.
* **`fe_users.tx_wsquicklinks_order`** – when a frontend user is logged in the
  order is additionally persisted server-side and preferred over the cookie on
  read.

Server-side persistence uses a lightweight PSR-15 middleware: the manager posts
the order to the current URL with `?tx_wsquicklinks_save=1`, the middleware runs
right after frontend user authentication, stores the order and returns a small
JSON response (`{"status":"ok","storage":"user|cookie"}`) instead of rendering a
page.

All plugin actions are registered as non-cacheable (`USER_INT`) because the
output is personalised per visitor.

## License

GPL-2.0-or-later. © WapplerSystems, Sven Wappler.
