<?php

declare(strict_types=1);

/**
 * Bank Reference Extractor.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2020 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\BankReference;

class Extractor
{
    /**
     * Parse the trasaction narrative on the bank transaction.
     *
     * @param string $reference     Reference from the bank transactions
     * @param string $account_regex Account Number Regex
     *
     * @return array
     */
    public static function extract($reference, $prefix): array
    {
        /**
         * Try and extract the reference ignoring the reference banks like ABSA and
         * mutual banks place in the transaction narrative (i.e. ABSA BANK).
         */
        $bank_prefixes = \implode('|', [
            'ABSA\sBANK',
            'BIDVESTCRS\*',
            'CAPITEC',
            'CASHFOCUS',
            'CITIBANK',
            'INVESTECPB',
            'NEDCOR',
            'NETCASH',
            'OLYMPUSMB',
            'PAYACCSYS',
            'SAGEPAY',
            'STANCOM',
        ]);

        \preg_match(
            '/\A(?P<bankame>('.$bank_prefixes.'))?\s?(?P<account_number>'.$prefix.')?\s?(?P<reference>.*)?\z/ixs',
            $reference,
            $matches,
            PREG_OFFSET_CAPTURE,
            0
        );

        return [
            'status'  => 'ok',
            'type'    => 'bank_name_regex',
            'matches' => $matches,
        ];
    }
}
