<?php

declare(strict_types=1);

/**
 * Bank Reference Extractor.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2022 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\BankReference;

use Composer\Pcre\Preg;

final class Extractor
{
    /**
     * Parse the trasaction narrative on the bank transaction.
     *
     * @param string $reference     Reference from the bank transactions
     * @param string $prefix        Account Number Regex
     * @param string $msidnprefixes MSISDN prefixes in local number format
     *
     * @return array
     */
    public static function extract(string $reference, string $prefix, string $msidnprefixes): array
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
            'FIRSTRAND',
            'FNDS',
            'INVESTECPB',
            'NEDCOR',
            'NETCASH',
            'OLYMPUSMB',
            'PAYACCSYS',
            'SAGEPAY',
            'STANCOM',
        ]);

        Preg::matchWithOffsets(
            '/\A(?P<bankame>('.$bank_prefixes.'))?\s?(?P<account_number>'.$prefix.')?\s?(?P<msisdn>('.$msidnprefixes.'))?\s?(?P<reference>.*)?\z/ixs',
            $reference,
            $matches,
        );

        return [
            'status'  => 'ok',
            'type'    => 'bank_name_regex',
            'matches' => $matches,
        ];
    }
}
