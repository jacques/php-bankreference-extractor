<?php declare(strict_types=1);
/**
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2020-2022 Jacques Marneweck.  All rights strictly reserved.
 */

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    // define sets of rules
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_74,
        PHPUnitSetList::PHPUNIT_91,
        PHPUnitSetList::PHPUNIT_CODE_QUALITY,
        PHPUnitSetList::PHPUNIT_SPECIFIC_METHOD,
        PHPUnitSetList::PHPUNIT_YIELD_DATA_PROVIDER,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::DEAD_CODE,
        SetList::EARLY_RETURN,
        SetList::PHP_74,
        SetList::PRIVATIZATION,
        SetList::PSR_4,
        SetList::TYPE_DECLARATION,
        SetList::TYPE_DECLARATION_STRICT,
    ]);
};
