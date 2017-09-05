<?php
/**
 * Bank Reference Extractor Test
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2016-2017 Jacques Marneweck.  All rights strictly reserved.
 */

namespace Jacques\BankReference\Extractor\Tests\Unit;

use Jacques\BankReference\Extractor;

/**
 * Tests for Jacques\BankReference\Extractor
 */
class ExtractorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testExtractReferenceWithBankNameFirst()
    {
        /**
         * ABSA BANK
         */
        $response = Extractor::extract('ABSA BANK Joe Soap');
        $expected = [
            'status' => 'ok',
            'type' => 'bank_name_regex',
            'matches' => [
                0   => [
                    0 => 'ABSA BANK Joe Soap',
                    1 => 0,
                ],
                'bankame' => [
                    0 => 'ABSA BANK',
                    1 => 0,
                ],
                1 => [
                    0 => 'ABSA BANK',
                    1 => 0,
                ],
                2 => [
                    0 => 'ABSA BANK',
                    1 => 0,
                ],
                'account_number' => [
                    0 => '',
                    1 => -1,
                ],
                3 => [
                    0 => '',
                    1 => -1,
                ],
                'reference' => [
                    0 => 'Joe Soap',
                    1 => 10,
                ],
                4 => [
                    0 => 'Joe Soap',
                    1 => 10,
                ],
            ],
        ];
        self::assertEquals($expected, $response);

        /**
         * ABSA BANK
         */
        $response = Extractor::extract('ABSA BANK 53211234567 Joe Soap');
        $expected = [
            'status' => 'ok',
            'type' => 'bank_name_regex',
            'matches' => [
                0   => [
                    0 => 'ABSA BANK 53211234567 Joe Soap',
                    1 => 0,
                ],
                'bankame' => [
                    0 => 'ABSA BANK',
                    1 => 0,
                ],
                1 => [
                    0 => 'ABSA BANK',
                    1 => 0,
                ],
                2 => [
                    0 => 'ABSA BANK',
                    1 => 0,
                ],
                'account_number' => [
                    0 => '53211234567',
                    1 => 10,
                ],
                3 => [
                    0 => '53211234567',
                    1 => 10,
                ],
                'reference' => [
                    0 => 'Joe Soap',
                    1 => 22,
                ],
                4 => [
                    0 => 'Joe Soap',
                    1 => 22,
                ],
            ],
        ];
        self::assertEquals($expected, $response);

        /**
         * CAPITEC BANK
         */
        $response = Extractor::extract('CAPITEC 53211234567 Joe Soap');
        $expected = [
            'status' => 'ok',
            'type' => 'bank_name_regex',
            'matches' => [
                0   => [
                    0 => 'CAPITEC 53211234567 Joe Soap',
                    1 => 0,
                ],
                'bankame' => [
                    0 => 'CAPITEC',
                    1 => 0,
                ],
                1 => [
                    0 => 'CAPITEC',
                    1 => 0,
                ],
                2 => [
                    0 => 'CAPITEC',
                    1 => 0,
                ],
                'account_number' => [
                    0 => '53211234567',
                    1 => 8,
                ],
                3 => [
                    0 => '53211234567',
                    1 => 8,
                ],
                'reference' => [
                    0 => 'Joe Soap',
                    1 => 20,
                ],
                4 => [
                    0 => 'Joe Soap',
                    1 => 20,
                ],
            ],
        ];
        self::assertEquals($expected, $response);

        /**
         * CITIBANK
         */
        $response = Extractor::extract('CITIBANK  22025522FDMSMCV0601C');
        $expected = [
            'status' => 'ok',
            'type' => 'bank_name_regex',
            'matches' => [
                0   => [
                    0 => 'CITIBANK  22025522FDMSMCV0601C',
                    1 => 0,
                ],
                'bankame' => [
                    0 => 'CITIBANK',
                    1 => 0,
                ],
                1 => [
                    0 => 'CITIBANK',
                    1 => 0,
                ],
                2 => [
                    0 => 'CITIBANK',
                    1 => 0,
                ],
                'account_number' => [
                    0 => '',
                    1 => -1,
                ],
                3 => [
                    0 => '',
                    1 => -1,
                ],
                'reference' => [
                    0 => '22025522FDMSMCV0601C',
                    1 => 10,
                ],
                4 => [
                    0 => '22025522FDMSMCV0601C',
                    1 => 10,
                ],
            ],
        ];
        self::assertEquals($expected, $response);

        /**
         * INVESTECPB
         */
        $response = Extractor::extract('INVESTECPBJOESOAP');
        $expected = [
            'status' => 'ok',
            'type' => 'bank_name_regex',
            'matches' => [
                0   => [
                    0 => 'INVESTECPBJOESOAP',
                    1 => 0,
                ],
                'bankame' => [
                    0 => 'INVESTECPB',
                    1 => 0,
                ],
                1 => [
                    0 => 'INVESTECPB',
                    1 => 0,
                ],
                2 => [
                    0 => 'INVESTECPB',
                    1 => 0,
                ],
                'account_number' => [
                    0 => '',
                    1 => -1,
                ],
                3 => [
                    0 => '',
                    1 => -1,
                ],
                'reference' => [
                    0 => 'JOESOAP',
                    1 => 10,
                ],
                4 => [
                    0 => 'JOESOAP',
                    1 => 10,
                ],
            ],
        ];
        self::assertEquals($expected, $response);
    }

    public function testExtractReferenceWithNoBankNameWithAccountNumberFirst()
    {
        /**
         * ABSA BANK
         */
        $response = Extractor::extract('53211234567');
        $expected = [
            'status' => 'ok',
            'type' => 'bank_name_regex',
            'matches' => [
                0   => [
                    0 => '53211234567',
                    1 => 0,
                ],
                'bankame' => [
                    0 => '',
                    1 => -1,
                ],
                1 => [
                    0 => '',
                    1 => -1,
                ],
                2 => [
                    0 => '',
                    1 => -1,
                ],
                'account_number' => [
                    0 => '53211234567',
                    1 => 0,
                ],
                3 => [
                    0 => '53211234567',
                    1 => 0,
                ],
                'reference' => [
                    0 => '',
                    1 => 11,
                ],
                4 => [
                    0 => '',
                    1 => 11,
                ],
            ],
        ];
        self::assertEquals($expected, $response);
    }

    public function testExtractJustReferences()
    {

        /**
         * MOBILE NUMBER
         */
        $response = Extractor::extract('0761234567');
        $expected = [
            'status' => 'ok',
            'type' => 'bank_name_regex',
            'matches' => [
                0   => [
                    0 => '0761234567',
                    1 => 0,
                ],
                'bankame' => [
                    0 => '',
                    1 => -1,
                ],
                1 => [
                    0 => '',
                    1 => -1,
                ],
                2 => [
                    0 => '',
                    1 => -1,
                ],
                'account_number' => [
                    0 => '',
                    1 => -1,
                ],
                3 => [
                    0 => '',
                    1 => -1,
                ],
                'reference' => [
                    0 => '0761234567',
                    1 => 0,
                ],
                4 => [
                    0 => '0761234567',
                    1 => 0,
                ],
            ],
        ];
        self::assertEquals($expected, $response);

        /**
         * MOBILE NUMBER
         */
        $response = Extractor::extract('27761234567');
        $expected = [
            'status' => 'ok',
            'type' => 'bank_name_regex',
            'matches' => [
                0   => [
                    0 => '27761234567',
                    1 => 0,
                ],
                'bankame' => [
                    0 => '',
                    1 => -1,
                ],
                1 => [
                    0 => '',
                    1 => -1,
                ],
                2 => [
                    0 => '',
                    1 => -1,
                ],
                'account_number' => [
                    0 => '',
                    1 => -1,
                ],
                3 => [
                    0 => '',
                    1 => -1,
                ],
                'reference' => [
                    0 => '27761234567',
                    1 => 0,
                ],
                4 => [
                    0 => '27761234567',
                    1 => 0,
                ],
            ],
        ];
        self::assertEquals($expected, $response);

        /**
         * SALARY/WAGES
         */
        $response = Extractor::extract('SALARY/WAGES');
        $expected = [
            'status' => 'ok',
            'type' => 'bank_name_regex',
            'matches' => [
                0   => [
                    0 => 'SALARY/WAGES',
                    1 => 0,
                ],
                'bankame' => [
                    0 => '',
                    1 => -1,
                ],
                1 => [
                    0 => '',
                    1 => -1,
                ],
                2 => [
                    0 => '',
                    1 => -1,
                ],
                'account_number' => [
                    0 => '',
                    1 => -1,
                ],
                3 => [
                    0 => '',
                    1 => -1,
                ],
                'reference' => [
                    0 => 'SALARY/WAGES',
                    1 => 0,
                ],
                4 => [
                    0 => 'SALARY/WAGES',
                    1 => 0,
                ],
            ],
        ];
        self::assertEquals($expected, $response);
    }
}
