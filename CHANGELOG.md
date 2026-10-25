## 1.0.5

- Fix: The note under the hash on the verification page now says what the check does: the store keeps the hash with the receipt and compares it with the receipt's content.
- Fix: The verification page no longer says the receipt is cryptographically signed; it says the receipt matches its SHA-256 fingerprint.
- Fix: Returned items on the receipt verification page show the product name next to the SKU.
- Fix: Visitors who are not signed in get a "Continue Shopping" link on the verification page instead of "Back to my account".
* Change: Requires EU Withdrawal Receipt Verification 1.0.4 or later, which provides the product names, the guest link and the texts of this page.

## 1.0.4

- Fix: On a theme still built with the previous Tailwind generation the receipt-verification page rendered unstyled, because this module's template was left out when the theme's bundle was built.

## 1.0.3

* Other: The tax row on the guest receipt-verification page is now labelled "Of which VAT", matching the withdrawal form.

## 1.0.2

- Fix: The guest receipt-verification page no longer errors when the base receipt-verify module is on an older version; it now requires version 1.0.2 or newer.

## 1.0.1

* Other: The verification result now shows the receipt's creation date.

## 1.0.0

+ New: First public release. Hyva theme compatibility for the public receipt verify page, rebuilt with Tailwind.
