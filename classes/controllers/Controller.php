<?php

namespace controllers;

use Base;
use data\Security;

class Controller
{
    /**
     * @var Base
     */
    public $f3;

    /**
     * @var \MongoDB
     */
    public $m;

    public $contentType = 'text/html';

    public $layout = 'html/layout.html';

    public function beforeroute(\Base $f3)
    {
        $this->f3 = $f3;
        $this->m = $f3->get('MONGO');
        $f3->set('scripts', []);
        $f3->set('styles', []);
        $f3->set('head', []);
        Security::startSession();
        if ($_SERVER['HTTPS']) {
            header('Access-Control-Allow-Origin: http://' . MAIN_URL);
        }

        if ($f3->get('VERB') == 'HEAD') {
            exit;
        }
    }

    //! HTTP route post-processor
    public function afterroute(\Base $f3)
    {
        if ($this->layout == 'json') {
            header('Content-type: application/json');
            echo json_encode($this->result);
            return;
        }
        if ($this->layout == 'php') {
            echo \View::instance()->render($this->f3->get('content'));
            return;
        }
        // Render HTML layout
        if ($this->layout) {
            $out = \Template::instance()->render($this->layout, $this->contentType);
            echo $out;

        }
    }
}
