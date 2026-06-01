# MageMe EU Withdrawal — Receipt Verify, Hyva companion (Pro)

> Hyva theme compatibility for the public receipt verify page — pure Tailwind, no LESS, no jQuery.

[![Hyva](https://img.shields.io/badge/Hyva-1.3.11%2B-21CFD5.svg?style=flat-square)](https://www.hyva.io)
[![PHP](https://img.shields.io/badge/PHP-8.1%20%7C%208.2%20%7C%208.3%20%7C%208.4%20%7C%208.5-777BB4.svg?style=flat-square)](https://php.net)
[![Tier](https://img.shields.io/badge/tier-Pro-6E56CF.svg?style=flat-square)](https://mageme.com/magento-2-withdrawal-button-extension.html)
[![License](https://img.shields.io/badge/license-MageMe%20EULA-blue.svg?style=flat-square)](https://mageme.com/license/)

Companion to [`mageme/module-eu-withdrawal-receipt-verify`](https://mageme.com/magento-2-withdrawal-button-extension.html) (Pro). Re-renders the public verify page with the Hyva design system. Install it when you run **Receipt Verify (Pro) on a Hyva theme**.

**[Documentation](https://docs.mageme.com)** · **[Get EU Withdrawal Pro](https://mageme.com/magento-2-withdrawal-button-extension.html)**

---

## What it does

Re-renders the public verify page at `/withdraw-contract/verify/…` with Tailwind utility classes instead of the Pro module's LESS bundle, so it matches a Hyva storefront. Same data and the same integrity semantics — only the chrome differs. On Hyva, this avoids leaking base/Pro LESS onto a Tailwind-first storefront.

## Requirements

- **Receipt Verify (Pro)** module (`mageme/module-eu-withdrawal-receipt-verify`, pulled automatically)
- `hyva-themes/magento2-theme-module` **≥ 1.3.11**
- Magento **2.4.4–2.4.9**, **PHP 8.1–8.5**
- A valid **EU Withdrawal Pro** licence

## Install

Pro modules are distributed through the private MageMe Composer repository. Add it once with the credentials from your purchase, then require the package:

```bash
composer config repositories.mageme composer https://repo.mageme.com
composer require mageme/module-eu-withdrawal-receipt-verify-hyva
bin/magento module:enable Hyva_MageMeEUWithdrawalReceiptVerify
bin/magento setup:upgrade
bin/magento cache:flush
```

Recompile the Hyva Tailwind bundle so the classes used by this module are picked up (substitute your child theme's `web/tailwind/` path if applicable):

```bash
cd vendor/hyva-themes/magento2-default-theme/web/tailwind
npm install && npm run build
```

## Custom Magento development

Need a feature an extension doesn't cover, or a bespoke Magento build? MageMe takes on custom extension development and integration work.

→ **[Custom Magento development](https://mageme.com/magento-services/custom-development)**

## Support

- Documentation: [docs.mageme.com](https://docs.mageme.com)

## Legal disclaimer

This is a **technical theme-compatibility shim** — it re-renders the verify page in Tailwind and adds or removes no compliance functionality (the hash algorithm, retention and rate-limit policy are unchanged). The merchant is responsible for verifying it renders correctly under their Hyva theme and version. See the base module's [full disclaimer](https://docs.mageme.com).

## License

Governed by the **MageMe End User License Agreement** ([mageme.com/license](https://mageme.com/license/)). Pro requires a paid commercial licence.

---

**MageMe** builds Magento 2 and Adobe Commerce extensions for B2B merchants — form building, quoting, catalog control, and EU compliance. → [Browse all extensions](https://mageme.com/extensions)
