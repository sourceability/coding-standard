<?php

namespace Sourceability\CodingStandard;

use PhpCsFixer\Config;

class PhpCsFixerConfig extends Config
{
    public static function create()
    {
        return parent::create()
            ->setRules([
                '@Symfony' => true,
                '@Symfony:risky' => true,

                '@DoctrineAnnotation' => true,

                '@PHP71Migration' => true,
                '@PHP71Migration:risky' => true,
                'declare_strict_types' => false,

                '@PHPUnit60Migration:risky' => true,

                'array_indentation' => true,
                'array_syntax' => ['syntax' => 'short'],

                'compact_nullable_typehint' => true,
                'explicit_indirect_variable' => true,
                'explicit_string_variable' => true,
                'fully_qualified_strict_types' => true,
                'linebreak_after_opening_tag' => true,
                'logical_operators' => true,
                'mb_str_functions' => true,
                'method_chaining_indentation' => true,
                'no_alternative_syntax' => true,
                'no_null_property_initialization' => true,
                'no_superfluous_elseif' => true,
                'no_useless_else' => true,
                'no_superfluous_phpdoc_tags' => true,
                'no_unset_on_property' => true,
                'no_useless_return' => true,
                'ordered_imports' => true,
                'phpdoc_order' => true,
                'return_assignment' => true,

                'native_function_invocation' => false,

                'ordered_class_elements' => [
                    'use_trait',
                    'constant_public',
                    'constant_protected',
                    'constant_private',
                    'property_public',
                    'property_protected',
                    'property_private',
                    'construct',
                    'destruct',
                    'magic',
                    'phpunit',
                    'method_public',
                    'method_protected',
                    'method_private',
                ],
            ])
        ;
    }
}
