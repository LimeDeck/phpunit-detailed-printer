<?php

$fixers = [
    '@Symfony' => true,
    '@PSR1'    => true,
    '@PSR2'    => true,

    'array_syntax'                    => ['syntax' => 'short'],
    'combine_consecutive_issets'      => true,
    'combine_consecutive_unsets'      => true,
    'increment_style'                 => false,
    'explicit_indirect_variable'      => true,
    'explicit_string_variable'        => true,
    'linebreak_after_opening_tag'     => true,
    'list_syntax'                     => ['syntax' => 'long'],
    'no_extra_blank_lines'            => ['tokens' => ['break', 'continue', 'extra', 'return', 'throw', 'use', 'parenthesis_brace_block', 'square_brace_block', 'curly_brace_block']],
    'no_leading_import_slash'         => true,
    'echo_tag_syntax'                 => ['format' => 'long'],
    'no_superfluous_elseif'           => true,
    'no_trailing_comma_in_singleline' => true,
    'no_unreachable_default_argument_value' => true,
    'no_unused_imports'               => true,
    'no_useless_else'                 => true,
    'no_useless_return'               => true,
    'ordered_class_elements'          => false,
    'ordered_imports'                 => ['sort_algorithm' => 'length'],
    'protected_to_private'            => false,
    'semicolon_after_instruction'     => true,
    'short_scalar_cast'               => true,
    'ternary_to_null_coalescing'      => true,
    'trailing_comma_in_multiline'     => ['elements' => ['arrays']],
    'yoda_style'                      => false,

    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_align'                        => true,
    'phpdoc_indent'                       => true,
    'general_phpdoc_tag_rename'           => true,
    'phpdoc_inline_tag_normalizer'        => true,
    'phpdoc_tag_type'                     => true,
    'phpdoc_no_empty_return'              => false,
    'phpdoc_no_package'                   => false,
    'phpdoc_order'                        => true,
    'phpdoc_scalar'                       => true,
    'phpdoc_separation'                   => true,
    'phpdoc_trim'                         => true,
    'phpdoc_types'                        => true,
    'phpdoc_var_without_name'             => true,

    'no_empty_comment'   => false,
    'no_empty_phpdoc'    => false,
    'no_empty_statement' => false,

    'single_line_comment_style' => true,

    'align_multiline_comment' => true,
    'binary_operator_spaces'  => [
        'default'   => 'align_single_space_minimal',
        'operators' => [
            '+=' => 'single_space',
        ],
    ],
    'concat_space'                      => ['spacing' => 'none'],
    'method_argument_space'             => true,
    'method_chaining_indentation'       => true,
    'not_operator_with_successor_space' => true,
    'no_spaces_around_offset'           => [
        'positions' => ['outside'],
    ],
    'trim_array_spaces' => true,

    'php_unit_method_casing'              => false,
    'php_unit_strict'                     => true,
    'php_unit_test_class_requires_covers' => false,
    'general_phpdoc_annotation_remove'    => ['annotations' => ['expectedException', 'expectedExceptionMessage', 'expectedExceptionMessageRegExp']],
];

$excludeDirs = [];

$excludeFiles = [];

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude($excludeDirs)
    ->ignoreDotFiles(true)->ignoreVCS(true)
    ->filter(function (SplFileInfo $file) use ($excludeFiles) {
        return ! in_array($file->getRelativePathName(), $excludeFiles);
    })
;

return (new PhpCsFixer\Config())
    ->setRules($fixers)->setFinder($finder)
    ->setUsingCache(false)->setRiskyAllowed(true)
;
