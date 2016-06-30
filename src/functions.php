<?php

namespace MyTarget;

use Doctrine\Instantiator\InstantiatorInterface as Instantiator;
use MyTarget\Exception\JsonDecodingException;
use MyTarget\Util\DataAccess\SomeData;

/**
 * @param string $string
 * @return \DateTime
 */
function dateFromString($string)
{
    return \DateTime::createFromFormat("Y-m-d H:i:s", $string);
}

/**
 * @param \DateTime $date
 * @return string
 */
function stringFromDate(\DateTime $date)
{
    return $date->format("Y-m-d H:i:s");
}

/**
 * @param callable $callable
 * @return \Closure callable(array): array
 */
function applyToAll(callable $callable)
{
    return function (array $list) use ($callable) {
        return array_map($callable, $list);
    };
}

/**
 * @param array $left
 * @param array $right
 * @return array
 */
function arraySubtract(array $left, array $right)
{
    $result = [];

    foreach ($left as $key => $element) {
        if ( ! isset($right[$key])) {
            $result[$key] = $element;
        } elseif (is_array($element)) {
            if ( ! is_array($right[$key]) || leftArrayIsNewer($element, $right[$key])) {
                $result[$key] = $element;
            }
        } elseif ($element !== $right[$key]) {
            $result[$key] = $element;
        }
    }

    return $result;
}

/**
 * @param array $left
 * @param array $right
 *
 * @return bool
 */
function leftArrayIsNewer(array $left, array $right)
{
    if (count($left) !== count($right)) {
        return true;
    }

    if (key($left) === 0) { // list
        sort($left);
        sort($right);
    }

    foreach ($left as $idx => $element) {
        $rElement = isset($right[$idx]) ? $right[$idx] : null;

        if (gettype($element) !== gettype($rElement)) {
            return true;
        }
        if (is_array($element)) {
            if (leftArrayIsNewer($element, $rElement)) {
                return true;
            }
        } elseif ($element !== $rElement) {
            return true;
        }
    }

    return false;
}

function json_decode($json)
{
    $decoded = @\json_decode($json, true);

    if ($decoded === null && null !== ($error = json_last_error_msg())) {
        throw new JsonDecodingException($error);
    }

    return $decoded;
}
