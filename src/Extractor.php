<?php declare(strict_types=1);
/**
 * Bank Reference Extractor
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2019 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\BankReference;

class Extractor
{
    /**
     * Parse the trasaction narrative on the bank transaction.
     *
     * @param string $reference Reference from the bank transactions
     *
     * @return array
     */
    public static function extract($reference)
    {
        /**
         * Try and extract the reference ignoring the reference banks like ABSA and
         * mutual banks place in the transaction narrative (i.e. ABSA BANK
         */
        preg_match('/\A(?P<bankame>(ABSA\sBANK|CAPITEC|CASHFOCUS|CITIBANK|INVESTECPB|NEDCOR|NETCASH|OLYMPUSMB|PAYACCSYS|SAGEPAY))?\s?(?P<account_number>532[12]\d{7})?\s?(?P<reference>.*)?\z/ixs', $reference, $matches, PREG_OFFSET_CAPTURE, 0);

        return [
            'status' => 'ok',
            'type' => 'bank_name_regex',
            'matches' => $matches,
        ];
    }
}
