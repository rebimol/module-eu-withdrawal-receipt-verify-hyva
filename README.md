# Hyva_MageMeEUWithdrawalReceiptVerify

**Version:** 0.1.0 (initial release)
**Composer:** `mageme/module-eu-withdrawal-receipt-verify-hyva`
**Requires:** `mageme/module-eu-withdrawal-receipt-verify: >=0.1.2 <1.0` (Pro tier) + `hyva-themes/magento2-theme-module: ^1.3.11`
**Tier:** Free — Pro Receipt-Verify companion (Hyva theme compatibility)

Hyva theme compatibility for `MageMe_EUWithdrawalReceiptVerify` (Pro tier). Re-renders the public verify page at `/withdraw-contract/verify/index/request_id/<id>/hash/<hex>/` using **pure Tailwind utility classes** — no LESS, no module-shipped CSS, no jQuery.

## What this module covers

- **Verify page** at `/withdraw-contract/verify/index/...` — Tailwind reskin of the public integrity-check page that confirms a withdrawal receipt has not been tampered with after issuance. Same data surface as the Pro module's Luma version (receipt number, order number, confirmed-at, refund total, item lines, merchant name, integrity hash) — only the chrome differs.

## Why a separate module

`MageMe_EUWithdrawalReceiptVerify` (Pro) ships a Luma-styled phtml + a LESS-compiled CSS bundle for the verify page. On a Hyva theme storefront the LESS still compiles and loads, **but Hyva's design system is Tailwind utility-class first** — letting Lite/Pro LESS leak onto a Hyva page is tech debt. This companion:

1. **Removes** the Pro module's `<css src="MageMe_EUWithdrawalReceiptVerify::css/verify.css"/>` directive on Hyva theme via `<remove>` in the layout XML, so the merchant's Tailwind bundle is the only CSS source.
2. **Overrides** the verify-page phtml with a Tailwind/Alpine variant via `Hyva_CompatModuleFallback` registration.
3. The new template paths get added to Hyva's Tailwind content-scan automatically (Hyva's `compat_module` mechanism walks our `view/frontend/templates/` tree).

The data layer (the `Block\Withdraw\VerifyResult` block) is **shared with the Pro module** — this companion only re-implements the visual layer.

## ⚠️ Disclaimer

This module is provided **AS-IS, WITHOUT WARRANTY OF ANY KIND**. It is a technical theme-compatibility shim for `MageMe_EUWithdrawalReceiptVerify` (Pro). It re-implements the same verify-page data surface in a different rendering runtime — it adds no compliance functionality and removes no compliance functionality.

Specifically, this module does not change:

- The cryptographic hash algorithm (SHA-256) or content canonicalisation
- The 6-year retention period or the rate-limit policy on the public endpoint
- The integrity-check semantics — the verify page still proves receipt-was-not-modified-since-issuance, exactly as the Pro module does on Luma

See the parent module's [README disclaimer](../../MageMe/EUWithdrawalReceiptVerify/README.md) for the full disclaimer.

## Installation

```bash
composer require mageme/module-eu-withdrawal-receipt-verify-hyva
bin/magento module:enable Hyva_MageMeEUWithdrawalReceiptVerify
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento cache:flush
```

After installing, recompile Hyva's Tailwind bundle:

```bash
cd vendor/hyva-themes/magento2-default-theme/web/tailwind
npm install
npm run build
```

(Path differs if your Hyva theme is a child theme — substitute its `web/tailwind/` path.)
