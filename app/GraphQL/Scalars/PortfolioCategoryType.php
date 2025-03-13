<?php

declare(strict_types=1);

namespace App\GraphQL\Scalars;

use GraphQL\Language\AST\Node;
use GraphQL\Type\Definition\ScalarType;
use RuntimeException;

/**
 * Scalar type that represents a category of an investor's portfolio
 */
final class PortfolioCategoryType extends ScalarType
{
    public const BANKS = 'banks';
    public const FUNDS = 'funds';
    public const BONDS = 'bonds';

    public string $name = 'PortfolioCategory';

    /** Serializes an internal value to include in a response. */
    public function serialize(mixed $value): string
    {
        return (string)$value;
    }

    /** Parses an externally provided value (query variable) to use as an input. */
    public function parseValue(mixed $value): string
    {
        // Validate the input value
        $allowedValues = [self::BANKS, self::FUNDS, self::BONDS];
        if (!in_array($value, $allowedValues, true)) {
            throw new RuntimeException("Invalid value for {$this->name} type");
        }

        return $value;
    }

    /** Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input. */
    public function parseLiteral(Node $ast, ?array $variables = null): string
    {
        // Convert GraphQL literals into internal representation
        if ($ast->kind === 'StringValue') {
            return $this->parseValue($ast->value);
        }

        throw new RuntimeException("Invalid AST type for {$this->name} type");
    }
}
