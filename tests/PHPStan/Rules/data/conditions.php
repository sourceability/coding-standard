<?php

$getBoolean = function ($a) {
    return (bool) ($boolean ?? false);
};

// valid
if ($getBoolean(1)) {
    echo 'instanceof StdClass';
}

// valid
if (!$getBoolean(2)) {
    echo 'not instanceof StdClass';
}

// invalid
if (true === $getBoolean(3)) {
    echo 'instanceof StdClass';
}

// invalid
if ($getBoolean(4) === true) {
    echo 'instanceof StdClass';
}

// invalid
if (false === $getBoolean(5)) {
    echo 'not instanceof StdClass';
}

// invalid
if ($getBoolean(6) === false) {
    echo 'not instanceof StdClass';
}

// invalid
if (true !== $getBoolean(7)) {
    echo 'not instanceof StdClass';
}

// invalid
if ($getBoolean(8) !== true) {
    echo 'not instanceof StdClass';
}

// invalid
if (false !== $getBoolean(9)) {
    echo 'instanceof StdClass';
}

// invalid
if ($getBoolean(10) !== false) {
    echo 'instanceof StdClass';
}
