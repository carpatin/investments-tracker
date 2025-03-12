<?php

declare(strict_types=1);

namespace App\GraphQL\Resolvers;

use ArrayAccess;
use Closure;
use Illuminate\Support\Str;
use Nuwave\Lighthouse\Execution\ResolveInfo;

/**
 * Custom GraphQL field resolver that allows camelCase fields to also match
 * against snake_case model attributes.
 * @see https://github.com/nuwave/lighthouse/issues/1561#issuecomment-802096606
 */
class DefaultFieldResolver
{
    /**
     * We perform lookups against both the camelCase and snake_case
     * to support interoperability with case insensitive MySQL columns.
     * This significantly reduces the number of @rename directives developers
     * need to add.
     */
    public static function defaultFieldResolver($objectValue, $args, $context, ResolveInfo $info)
    {
        $fieldName = $info->fieldName;

        $snakeCaseFieldName = Str::snake($info->fieldName);
        $property = null;

        if (is_array($objectValue) || $objectValue instanceof ArrayAccess) {
            if (isset($objectValue[$fieldName])) {
                $property = $objectValue[$fieldName];
            } elseif (isset($objectValue[$snakeCaseFieldName])) {
                $property = $objectValue[$snakeCaseFieldName];
            }
        } elseif (is_object($objectValue)) {
            if (isset($objectValue->{$fieldName})) {
                $property = $objectValue->{$fieldName};
            } elseif (isset($objectValue->{$snakeCaseFieldName})) {
                $property = $objectValue->{$snakeCaseFieldName};
            }
        }

        return $property instanceof Closure
            ? $property($objectValue, $args, $context, $info)
            : $property;
    }
}
