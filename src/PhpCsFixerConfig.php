<?php

namespace Sourceability\CodingStandard;

use PhpCsFixer\Config;
use PhpCsFixer\ConfigInterface;

class PhpCsFixerConfig extends Config
{
    public static function create(): ConfigInterface
    {
        return (new Config())->setRules([
            '@Symfony' => true,
            '@Symfony:risky' => true,

            '@DoctrineAnnotation' => true,

            '@PHP71Migration' => true,
            '@PHP71Migration:risky' => true,
            'declare_strict_types' => false,

            '@PHPUnit60Migration:risky' => true,

            'array_indentation' => true,
            'array_syntax' => [
                'syntax' => 'short'
            ],

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
            'phpdoc_order' => true,
            'return_assignment' => true,

            'native_function_invocation' => false,

            'class_definition' => [
                'single_line' => false,
            ],

            'ordered_imports' => [
                'imports_order' => ['class', 'const', 'function'],
            ],

            'single_line_throw' => false,
            'phpdoc_trim_consecutive_blank_line_separation' => false,
        ]);
    }
}
