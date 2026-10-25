<?php
/**
 * Copyright © MageMe. All rights reserved.
 * See LICENSE for license terms, or https://mageme.com/license.
 */
declare(strict_types=1);

namespace Hyva\MageMeEUWithdrawalReceiptVerify\Test\Unit;

use Magento\Framework\Component\ComponentRegistrar;
use PHPUnit\Framework\TestCase;

/**
 * The receipt verification page exists twice, for Luma in MageMe_EUWithdrawalReceiptVerify and for
 * Hyvä here. What it says about the receipt's legal basis and its integrity check must read the same
 * in both; this pins it so an edit to one copy cannot leave the other behind.
 */
class LegalTextParityTest extends TestCase
{
    private const LUMA_FORM = '/view/frontend/templates/verify/result.phtml';
    private const HYVA_FORM = '/view/frontend/templates/MageMe_EUWithdrawalReceiptVerify/verify/result.phtml';

    /** The receipt's legal basis (Art. 11a Directive 2011/83/EU) and what its integrity check proves. */
    private const LEGAL_TEXTS = [
        'Public integrity check — Art. 11a Directive 2011/83/EU',
        'Legal basis',
        'Integrity hash (SHA-256)',
        'This receipt matches its SHA-256 fingerprint, which shows it has not been changed since the merchant issued it.',
        'Withdrawal receipt verified',
        'Withdrawal receipt — verification failed',
    ];

    /** A Luma page text carrying one of these is a legal text the Hyvä page must carry too. */
    private const LEGAL_MARKERS = ['Art.', '§', 'SHA-256', 'signature', 'signed'];

    public function testBothPagesCarryTheLegalTexts(): void
    {
        $luma = $this->phrases($this->lumaForm());
        $hyva = $this->phrases($this->hyvaForm());

        foreach (self::LEGAL_TEXTS as $text) {
            self::assertContains($text, $luma, 'Luma page: ' . $text);
            self::assertContains($text, $hyva, 'Hyvä page: ' . $text);
        }
    }

    public function testEveryLegalTextOfTheLumaPageIsInTheHyvaPage(): void
    {
        $hyva = $this->phrases($this->hyvaForm());

        foreach ($this->phrases($this->lumaForm()) as $text) {
            foreach (self::LEGAL_MARKERS as $marker) {
                if (str_contains($text, $marker)) {
                    self::assertContains($text, $hyva, 'Missing on the Hyvä page: ' . $text);
                    break;
                }
            }
        }
    }

    private function lumaForm(): string
    {
        $base = (new ComponentRegistrar())->getPath(ComponentRegistrar::MODULE, 'MageMe_EUWithdrawalReceiptVerify');
        if ($base === null) {
            self::markTestSkipped('MageMe_EUWithdrawalReceiptVerify is not installed.');
        }

        return $this->read($base . self::LUMA_FORM);
    }

    private function hyvaForm(): string
    {
        return $this->read(dirname(__DIR__, 2) . self::HYVA_FORM);
    }

    private function read(string $path): string
    {
        $content = file_get_contents($path);
        self::assertNotFalse($content, $path);

        return $content;
    }

    /**
     * @return string[] the literal texts passed to __() in a template
     */
    private function phrases(string $template): array
    {
        preg_match_all('/__\(\s*(?:\'((?:[^\'\\\\]|\\\\.)*)\'|"((?:[^"\\\\]|\\\\.)*)")/', $template, $matches, PREG_SET_ORDER);

        return array_map(
            static fn (array $m): string => ($m[2] ?? '') !== '' ? stripslashes($m[2]) : stripslashes($m[1]),
            $matches,
        );
    }
}
