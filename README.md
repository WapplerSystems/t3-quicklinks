# Frontend Quicklinks

TYPO3 extension providing frontend quicklinks with a drag & drop manager.
Each visitor can pick and order their own quicklinks; the personal order is
stored **in the frontend user record when logged in**, otherwise **in a cookie**.

## Requirements

* TYPO3 v14

## Installation

```bash
composer require wapplersystems/quicklinks
```

Run the database schema update afterwards (adds `fe_users.tx_wsquicklinks_order`):

```bash
vendor/bin/typo3 extension:setup
```

Activate the site set **WS Quicklinks** (`wapplersystems/quicklinks`) in your
site configuration so the TypoScript is loaded.

## Configuration

Set the storage folder that holds the quicklink records via the constant
`plugin.tx_wsquicklinks.persistence.storagePid` (or the plugin's *Record
Storage Page*). `plugin.tx_wsquicklinks.settings.editPageUid` points the "edit"
link on the list plugin to the page holding the manager plugin.

## Content elements

* **Quicklinks list** – renders the visitor's chosen quicklinks in their stored
  order (all quicklinks if nothing has been personalised yet).
* **Quicklinks manager** – drag & drop UI to choose and reorder quicklinks.

## How ordering is stored

The manager writes the order on every drag:

* **Cookie** `quicklinks_order` (comma-separated uid list, `SameSite=Lax`) – the
  fallback for anonymous visitors.
* **`fe_users.tx_wsquicklinks_order`** – when a frontend user is logged in, the
  order is additionally persisted server-side and preferred over the cookie on
  read.

All plugin actions are registered as non-cacheable (`USER_INT`) because the
output is personalised per visitor.
