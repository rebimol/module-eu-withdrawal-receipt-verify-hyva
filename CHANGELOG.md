## 1.0.5

- Fix: The verification page explains the hash check correctly and no longer calls the receipt signed.
- Fix: Returned items show the product name next to the SKU.
- Fix: Guests get "Continue Shopping" instead of "Back to my account".
* Change: Requires Receipt Verification 1.0.4.

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
