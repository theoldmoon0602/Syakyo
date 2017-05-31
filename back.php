<?php

if (! isset($_GET['word'])) {
    exit;
}

try {
    $w = $_GET['word'];

    function generateSearchURL($word) {
        return sprintf("http://public.dejizo.jp/NetDicV09.asmx/SearchDicItemLite?Dic=EJdict&Word=%s&Scope=HEADWORD&Match=EXACT&Merge=OR&Prof=XHTML&PageSize=10&PageIndex=0", $word);
    }

    function generateGetURL($id) {
        return sprintf("http://public.dejizo.jp/NetDicV09.asmx/GetDicItemLite?Dic=EJdict&Item=%s&Loc=&Prof=XHTML", $id);
    }

    $result = file_get_contents(generateSearchURL($w));
    preg_match("/<ItemID>(.*)<\/ItemID>/", $result, $matches);
    $itemId = $matches[1];

    $result = file_get_contents(generateGetURL($itemId));
    preg_match("/<div>(.*)<\/div>/", $result, $matches);
    $mean = $matches[1];

    echo($mean);
}
catch(Exception $e) {
    exit;
}
