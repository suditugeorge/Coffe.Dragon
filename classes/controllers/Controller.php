<?php

namespace controllers;

use Base;

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

    public $isBot = false;

    public function beforeroute(\Base $f3)
    {
        $this->f3 = $f3;
        $this->db = $this->f3->get('DB');
        $this->m  = $f3->get('MONGO');
        $f3->set('scripts', []);
        $f3->set('styles', []);
        $f3->set('head', []);

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
            $out = \BeTemplate::instance()->render($this->layout, $this->contentType);
            echo $out;

        }
    }
/*
public static function generateMenu()
{
$f3 = \Base::instance();
$cache = \Cache::instance();
$m = $f3->get('MONGO');
if (!$cache->exists('products_menu', $html)) {
/*
$heading = ['id' => 'cont', 'title' => 'Cont'];
$cont = Account::menu();
$entries = [];
foreach($cont as $account){
$entries[] = ['title' => $account['label'], 'url' => $account['url']];
}
if(Security::isAuthenticated()){
$entries[] = ['title' => 'Log out', 'url' => '/logout'];
}

$heading['entries'] = $entries;
$menu[] = $heading;
$menu[] = ['id' => '-'];
$entries = [];
$heading = ['id' => 'liste', 'title' => 'Liste'];

$lists = Account::listsMenu();
foreach($lists as $list){
$entries[] = ['title' => $list['label'], 'url' => $list['url']];
}
$heading['entries'] = $entries;
$menu[] = $heading;
$menu[] = ['id' => '-'];

foreach (Subjects::$categories as $c) {
$bics = $m->products->bic->find(['code' => ['$regex' => '^(' . $c['entries'] . ')$']])->sort(['name' => 1]);
$heading = ['id' => $c['id'], 'title' => \util\I18N::category($c['id'])];
$entries = [];
foreach ($bics as $bic) {
//TODO: Subject title in English
$entries[] = ['title' => $bic['name'], 'id' => $bic['type'] . '.' . $bic['code'], 'url' => Subjects::url('b', $bic['code'], $bic['name'])];
}
$heading['entries'] = $entries;
$menu[] = $heading;
}
$menu[] = ['id' => '-'];
$heading = ['id' => 'altele', 'title' => _('Alte Produse'), 'entries' => []];
foreach (\data\catalogue\Subjects::getTypes() as $k => $a) {
if ($k == 'b' || $k == 'e' || $k == 'x') {
continue;
}
$heading['entries'][] = ['title' => $a['name'], 'id' => $a['slug'], 'url' => Subjects::typeURL($k)];
}
$menu[] = $heading;

/*
$heading = ['id' => 'cadouri', 'title' => _('Cadouri')];
$tags = $m->products->tags->find(['_id' => ['$regex' => '^G.$']])->sort(['_id' => 1]);
$heading['entries'] = array_map(
function ($a) {
return ['title' => $a['name'], 'id' => $a['_id'], 'url' => Tags::url($a['_id'], $a['name'])];
},
iterator_to_array($tags)
);

$menu[] = $heading;

$f3->set('products_menu_entries', $menu);
$html = \BeTemplate::instance()->render('layout/menu.html', false);
$cache->set('products_menu', $html);
}
return $html;
}

public function generatePager($url, $page, $total, $limit = PRODUCTS_PER_PAGE)
{
$pager = [];
$pages = ceil($total / $limit);
if ($pages <= 1) {
return;
}
$p = ['text' => _('<i class="fa fa-left-open"></i>')];
if ($page > 1) {
$p['url'] = str_replace('$', $page - 1, $url);
$p['role'] = 'prev';
$p['page'] = $page - 1;
}
$pager[] = $p;
if ($pages <= 7) {
for ($i = 1; $i <= $pages; ++$i) {
if ($i == $page) {
$pager[] = ['text' => $page, 'current' => true];
} else {
$pager[] = ['text' => $i, 'url' => str_replace('$', $i, $url), 'page' => $i];
}
}
} else {
if ($page == 1) {
$pager[] = ['text' => 1, 'current' => true];
$pager[] = ['text' => 2, 'url' => str_replace('$', 2, $url), 'page' => 2];
if ($pages >= 3) {
$pager[] = ['text' => 3, 'url' => str_replace('$', 3, $url), 'page' => 3];
}
} elseif ($page <= 4) {
$pager[] = ['text' => 1, 'url' => str_replace('$', 1, $url), 'page' => 1];
$max = min($page + 1, $pages);
for ($i = 2; $i <= $max; ++$i) {
if ($i == $page) {
$pager[] = ['text' => $i, 'current' => true];
} else {
$pager[] = ['text' => $i, 'url' => str_replace('$', $i, $url), 'page' => $i];
}
}
} else {
$pager[] = ['text' => 1, 'url' => str_replace('$', 1, $url), 'page' => 1];
$pager[] = ['text' => '.'];
}
$last = count($pager) - 1;
if ($page < $pages - 3) {
if ($pager[$last]['text'] == '.') {
$pager[] = ['text' => $page - 1, 'url' => str_replace('$', $page - 1, $url), 'page' => $page - 1];
$pager[] = ['text' => $page, 'current' => true];
$pager[] = ['text' => $page + 1, 'url' => str_replace('$', $page + 1, $url), 'page' => $page + 1];
}
$pager[] = ['text' => '.', 'role' => 'dots'];
$pager[] = ['text' => $pages];
} else {
$min = $page - 1;
for ($i = $min; $i <= $pages; ++$i) {
if ($i == $page) {
$pager[] = ['text' => $i, 'current' => true];
} else {
$pager[] = ['text' => $i, 'url' => str_replace('$', $i, $url), 'page' => $i];
}
}
}
}

$p = ['text' => _('<i class="fa fa-right-open"></i>')];
if ($page < $pages) {
$p['url'] = str_replace('$', $page + 1, $url);
$p['page'] = $page + 1;
$p['role'] = 'next';
}
$pager[] = $p;

$rel = [];
if ($page - 1 > 0) {
$rel['prev'] = str_replace('$', $page - 1, $url);
}
if ($page + 1 <= $pages) {
$rel['next'] = str_replace('$', $page + 1, $url);
}

return ['pages' => $pager, 'current' => $page, 'total' => $pages, 'rel' => $rel];
}

/**
 * Return the filtered parameters
 * @param  array $names The name of the parameters to be returned
 * @return array        The filtered parameters

public function getFilteredParams($names)
{
$verb = $this->f3->get('VERB');
$source = [];
if ($verb == 'POST') {
if ($_SERVER["CONTENT_TYPE"] == 'application/json') {
$source = json_decode($this->f3->get('BODY'), true);
} else {
$source = $this->f3->get('POST');
}
} elseif ($verb == 'PUT') {
$source = json_decode($this->f3->get('BODY'), true);
}
$params = [];
foreach ($names as $name) {
if (array_key_exists($name, $source)) {
if (is_string($source[$name])) {
$params[$name] = html_entity_decode($source[$name]);
} else {
$params[$name] = $source[$name];
}

}
}
return $params;
}

public function getListParams()
{
$params = [];
if ($this->f3->exists('GET.p', $v)) {
$params['page'] = $v;
} else {
$params['page'] = 1;
}
if ($this->f3->exists('GET.o', $v)) {
$params['sort'] = $v;
} else {
$params['sort'] = 'r';
}

if ($this->f3->exists('GET.s', $v)) {
$params['subject'] = $v;
}
if ($this->f3->exists('GET.l', $v)) {
$params['language'] = $v;
}
if ($this->f3->exists('GET.f', $v)) {
$params['form'] = $v;
}
if ($this->f3->exists('GET.n', $v)) {
$params['new'] = $v;
}
if ($this->f3->exists('GET.a', $v)) {
$params['age'] = $v;
}
if ($this->f3->exists('GET.c', $v)) {
$params['contributor'] = $v;
}
if ($this->f3->exists('GET.u', $v)) {
$params['publisher'] = $v;
}
if ($this->f3->exists('GET.t', $v) && !empty($v)) {
$params['type'] = $v;
}
if ($this->f3->exists('GET.d', $v) && !empty($v)) {
$params['date'] = $v;
}
return $params;
}

public function listParamsQuery($params)
{
$ret = [];
if (array_key_exists('sort', $params) && $params['sort'] != 'r') {
$ret[] = 'o=' . $params['sort'];
}
if (array_key_exists('page', $params) && $params['page'] != 1) {
$ret[] = 'p=' . $params['page'];
}
if (array_key_exists('subject', $params) && !empty($params['subject'])) {
$ret[] = 's=' . $params['subject'];
}
if (array_key_exists('language', $params) && !empty($params['language'])) {
$ret[] = 'l=' . $params['language'];
}
if (array_key_exists('form', $params) && !empty($params['form'])) {
$ret[] = 'f=' . $params['form'];
}
if (array_key_exists('new', $params) && !empty($params['new'])) {
$ret[] = 'n=' . $params['new'];
}
if (array_key_exists('age', $params) && !empty($params['age'])) {
$ret[] = 'a=' . $params['age'];
}
if (array_key_exists('contributor', $params) && !empty($params['contributor'])) {
$ret[] = 'c=' . $params['contributor'];
}
if (array_key_exists('publisher', $params) && !empty($params['publisher'])) {
$ret[] = 'u=' . $params['publisher'];
}
if (array_key_exists('type', $params) && !empty($params['type'])) {
$ret[] = 't=' . $params['type'];
}
if (array_key_exists('date', $params) && !empty($params['date'])) {
$ret[] = 'd=' . $params['date'];
}
return implode('&', $ret);
}

public static function prepareResultSmall($res)
{
return self::prepareResult($res, 's');
}

public static function prepareResult($res, $size = 't')
{
if (array_key_exists('best', $res)) {
$b = $res['best'];
$is_multi = true;
} else {
$b = $res;
$is_multi = false;
}
$express = null;
if (@$b['price_avail']['exp']['price'] > 0 && @$b['price_avail']['price'] > 0) {
$express = $b['price_avail']['exp']['price'] - $b['price_avail']['price'];
}
$entry = ['ean13' => $b['product']['ean13'], 'title' => $b['full_title'],
'url' => Products::url($b), 'lang' => isset($b['language']) ? \util\I18N::languageByCode($b['language']) : null, 'can_order' => @$b['price_avail']['can_order'],
'avail' => @$b['price_avail']['avail'], 'shipping' => (@is_array($b['shipping']) ? Products::shippingText($b['shipping'], Products::SHIPPING_TEXT_MEDIUM, @$b['price_avail']['avail'], $express) : null)];

if ($is_multi) {
$entry['idx'] = $res['idx'];
}

if (array_key_exists('form', $b)) {
$entry['form'] = $b['form'];
$entry['form_id'] = $b['product']['form_id'];
}
if (is_array(@$b['contributors'])) {
$entry['contributors'] = $b['contributors'];
}
if (array_key_exists('publication_date', $b['product'])) {
$entry['publication_date'] = $b['product']['publication_date'];
}
if (@$b['has_image']) {
$img = \util\ImageUtil::getThumbSize($b, $size);
$img['url'] = str_replace('/b' . $size . '/', '/$/', Products::image($b, null, $size));
$entry['img'] = $img;
}
if (is_array(@$b['age'])) {
$entry['age'] = $b['age'];
}
if (@is_array(@$b['shipping']) && @$b['price_avail']['price'] > 0) {
$entry['price'] = $b['price_avail']['price'];
if (@$b['price_avail']['discount'] && @$b['price_avail']['old_price'] > 0) {
$entry['old_price'] = $b['price_avail']['old_price'];
$entry['discount'] = $b['price_avail']['discount'];
}
}
if (is_array(@$b['awards']) && count($b['awards']) > 0) {
$entry['awards'] = $b['awards'];
}
$entry['is_book'] = $b['type'] == 'b' || $b['type'] == 'a';
$entry['rank'] = @$res['rank'];
$entry['weight'] = @$res['weight'];
$entry['avail_text'] = @\util\I18N::availability($b['price_avail']['avail']);
$entry['avail_color'] = @Products::availabilityColor($b['price_avail']['avail']);

if ($is_multi) {
$entry['variants'] = count($res['others']) + 1;
}

return $entry;
}

 */
}
