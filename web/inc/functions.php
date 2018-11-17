<?php

/**
 * isset and not empty
 *
 * @param $var
 *
 * @return bool
 */
function isSNE ($var) {
    if (isset($var)) {
        if (!empty($var) or (is_string($var) and $var != '')) {
            return true;
        }
    }
    return false;
}

/**
 * trim value if is a string
 * @param  mixed $var value to be checked
 * @return mixed
 */
function trim_if_string ($var) {
    return is_string($var) ? trim($var) : $var;
}

/**
 * @param string $value to convert to CamelCase
 *
 * @return string
 */
function camelize (string $value) {
    $chunks    = explode(' ', $value);
    $ucfirsted = array_map(function($s) { return ucfirst($s); }, $chunks);
    return lcfirst(implode('', $ucfirsted));
}

function startsWith($haystack, $needle) {
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}
