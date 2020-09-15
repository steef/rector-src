<?php

declare(strict_types=1);

namespace Rector\DowngradePhp74\Rector\Property;

use PhpParser\Node\Stmt\Property;
use Rector\Core\RectorDefinition\ConfiguredCodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;

/**
 * @see \Rector\DowngradePhp74\Tests\Rector\Property\DowngradeTypedPropertyRector\DowngradeTypedPropertyRectorTest
 * @see \Rector\DowngradePhp74\Tests\Rector\Property\NoDocBlockDowngradeTypedPropertyRector\DowngradeTypedPropertyRectorTest
 */
final class DowngradeTypedPropertyRector extends AbstractDowngradeTypedPropertyRector
{
    public function getDefinition(): RectorDefinition
    {
        return new RectorDefinition('Changes property type definition from type definitions to `@var` annotations.', [
            new ConfiguredCodeSample(
                <<<'CODE_SAMPLE'
class SomeClass
{
    private string $property;
}
CODE_SAMPLE
,
                <<<'CODE_SAMPLE'
class SomeClass
{
    /**
    * @var string
    */
    private $property;
}
CODE_SAMPLE
,
                [
                    self::ADD_DOC_BLOCK => true,
                ]
            ),
        ]);
    }

    /**
     * @return string[]
     */
    public function getNodeTypes(): array
    {
        return [Property::class];
    }

    public function shouldRemoveProperty(Property $property): bool
    {
        return true;
    }
}
