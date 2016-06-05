<?php
// Kickstart the framework
$f3 = require 'lib/base.php';
require_once '/config.php';
$f3->set('DEBUG', 1);
if ((float) PCRE_VERSION < 7.9) {
    trigger_error('PCRE version is out of date');
}

// Load configuration
$f3->config('config.ini');

$f3->route('GET|HEAD /', 'controllers\Main->home');

$f3->set('ONERROR', function ($f3) {
    $error = $f3->get('ERROR');
    die(print_r($error, 1));
    $html = format_error($f3, $error['code'], $error['text'], $error['trace']);
    echo $html;

});

function format_error($f3, $code, $text, array $trace, $debug = 3)
{

    $trace = array_filter(
        $trace,
        function ($frame) use ($debug) {
            return $debug && isset($frame['file']) &&
                ($frame['file'] != __FILE__ || $debug > 1) &&
                (empty($frame['function']) ||
                !preg_match('/^(?:(?:trigger|user)_error|' .
                    '__call|call_user_func)/', $frame['function']));
        }
    );
    $req = $f3->get('VERB') . ' <a href="' . $f3->get('REALM') . '">' . $f3->get('REALM') . '</a>';
    $out = '';
    $eol = "\n";
    // Analyze stack trace
    foreach ($trace as $frame) {
        $line = '';
        if (isset($frame['class'])) {
            $line .= $frame['class'] . $frame['type'];
        }

        if (isset($frame['function'])) {
            $line .= $frame['function'] . '(' .
                ($debug > 2 && isset($frame['args']) ?
                print_r($frame['args'], true) : '') . ')';
        }

        $src = $f3->fixslashes($frame['file']) . ':' . $frame['line'] . ' ';
        $out .= '<b>' . $f3->highlight($src) . '</b>' . "\n" . ($line) . '<br />' . $eol;
    }

    return '<!DOCTYPE html>' . $eol .
    '<html>' . $eol .
    '<head>' .
    '<title>' . $code . ' Error</title>' .
    '</head>' . $eol .
    '<body>' . $eol .
    '<h2>' . $f3->encode($text) . '</h2>' . $eol .
        '<code>' . $req . '</code>' . $eol .
        ('<pre>' . $out . '</pre>' . $eol) .
        '</body>' . $eol .
        '</html>';
}

$f3->run();
