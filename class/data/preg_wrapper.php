<?php

	/**
	 * https://github.com/lastwhitebird/preg_replace_e
	 */

function is_evaled_preg($str)
{
    if (!preg_match('~([a-z]+)$~i', $str, $ext))
	return false;
    $matched = $ext[1];
    if (strpos($matched, "e") === false)
	return false;
    $str = substr($str, 0, strlen($str) - strlen($matched));
    $matched = str_replace('e', '', $matched);
    return $str . $matched;
}

$lwb_compiled_regexes = [];

function my_compile_regex($replacement)
{
    global $lwb_compiled_regexes;
    $replacement = preg_replace_callback('~[\\$\\\\](\d+)~', function ($m)
    {
	return '$m[' . $m[1] . ']';
    }, $replacement);
    $replacement = str_replace('\\\\', '\\', $replacement);
    $replacement="return $replacement;";
    $ret = create_function('$m', $replacement);
    $lwb_compiled_regexes[$replacement] = $ret;
    return $ret;
}

function my_preg_replace_internal($pattern, $replacement, $subject)
{
    global $lwb_compiled_regexes;
    $func = $lwb_compiled_regexes[$replacement] ?? my_compile_regex($replacement);
    return preg_replace_callback($pattern, $func, $subject);
}

function my_preg_replace($pattern, $replacement, $subject)
{
    if (!is_array($pattern))
    {
	$pattern = (array) $pattern;
	$replacement = (array) $replacement;
    }

    $pattern_out = [
	    0 => [],
	    1 => []
    ];

    $replacement_out = [
	    0 => [],
	    1 => []
    ];

    foreach ($pattern as $k => $p)
    {
	$is = is_evaled_preg($p);
	$ind = (int) (bool) $is;
	$pattern_out[$ind][] = $is ?: $p;
	$replacement_out[$ind][] = $replacement[$k];
    }
    if (count($pattern_out[0]))
	$subject = preg_replace($pattern_out[0], $replacement_out[0], $subject);

    foreach ($pattern_out[1] as $k => $p)
	$subject = my_preg_replace_internal($pattern_out[1][$k], $replacement_out[1][$k], $subject);

    return $subject;
}
