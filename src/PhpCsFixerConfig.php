<?php

namespace Sourceability\CodingStandard;

use PhpCsFixer\Config;

class PhpCsFixerConfig extends Config
{
    public static function create()
    {
        $config = new Config();
        $config->setRules([
                'array_indentation' => true,
                'array_syntax' => ['syntax' => 'short'],
                'class_definition' => [
                    'single_line' => false,
                ],
                'compact_nullable_typehint' => true,
                'declare_strict_types' => false,
                '@DoctrineAnnotation' => true,
                'explicit_indirect_variable' => true,
                'explicit_string_variable' => true,
                'fully_qualified_strict_types' => true,
                'linebreak_after_opening_tag' => true,
                'logical_operators' => true,
                'mb_str_functions' => true,
                'method_chaining_indentation' => true,
                'native_function_invocation' => false,
                'no_alternative_syntax' => true,
                'no_null_property_initialization' => true,
                'no_superfluous_elseif' => true,
                'no_superfluous_phpdoc_tags' => true,
                'no_unset_on_property' => true,
                'no_useless_else' => true,
                'no_useless_return' => true,
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
                'ordered_imports' => [
                    'imports_order' => ['class', 'const', 'function'],
                ],
                '@PHP71Migration:risky' => true,
                '@PHP71Migration' => true,
                'phpdoc_order' => true,
                'phpdoc_trim_consecutive_blank_line_separation' => false,
                '@PHPUnit60Migration:risky' => true,
                'return_assignment' => true,
                'single_line_throw' => false,
                '@Symfony:risky' => true,
                '@Symfony' => true,
            ])
        ;

        return $config;
    }
}
