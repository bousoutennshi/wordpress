<?php
/*
Template Name: archives
*/
?>

<?php

// 定数設定
define('CUSTOM_NAME1', 'イベント開始日');
define('CUSTOM_NAME2', 'イベント終了日');

// 投稿タイプ取得指定
$post_type = isset($_REQUEST['post_type']) ? $_REQUEST['post_type'] : 'post';
// 最新の取得件数指定
$numberposts = isset($_REQUEST['results']) ? $_REQUEST['results'] : 30;
// 取得開始位置取得
$offset = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
// 指定カテゴリ取得
$category = isset($_REQUEST['category']) ? $_REQUEST['category'] : '';
// 検索キーワード取得
$s = isset($_REQUEST['s']) ? $_REQUEST['s'] : '';
// 指定投稿日時取得
$m = isset($_REQUEST['m']) ? $_REQUEST['m'] : '';
// 指定ソート対象取得
$orderby = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : 'post_date';
// 指定ソート順取得
$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : 'DESC';
// カスタムフィールド検索条件取得
$relation = isset($_REQUEST['relation']) ? $_REQUEST['relation'] : 'AND';

// 投稿の取得条件を作成
$args = array(
    'post_type'         => $post_type,              // 投稿タイプ指定
    'numberposts'       => intval($numberposts),    // 最大の取得件数指定(最新から)
    'offset'            => intval($offset),         // 取得開始位置指定
    'category_name'     => $category,               // カテゴリ指定
    's'                 => $s,                      // 検索キーワード指定
    'm'                 => $m,                      // 投稿日時指定 YYYYMMDD
    'orderby'           => $orderby,                // ソート対象
    'order'             => $order,                  // ソート順
    'meta_query'        => array(  // カスタムフィールド指定
        'relation'  => $relation
    )
);

// 指定イベント日取得
$event_start = isset($_REQUEST['event_start']) ? $_REQUEST['event_start'] : '';
$event_end = isset($_REQUEST['event_end']) ? $_REQUEST['event_end'] : '';

if( $event_start !== '' && $event_end !== '' ){
    // 指定イベント開始日設定
    $start = array(
        'key'       => CUSTOM_NAME1,
        'value'     => array( intval($event_start), intval($event_end) ),
        'compare'   => 'BETWEEN',
        'type'      => 'NUMERIC'
    );
    array_push($args['meta_query'],$start);

    // 指定イベント終了日設定
    $end = array(
        'key'       => CUSTOM_NAME2,
        'value'     => array( intval($event_start), intval($event_end) ),
        'compare'   => 'BETWEEN',
        'type'      => 'NUMERIC'
    );
    array_push($args['meta_query'],$end);
}else{
    if( $event_start !== '' ){
        $start = array(
            'key'       => CUSTOM_NAME1,
            'value'     => intval($event_start),
            'compare'   => '==',
            'type'      => 'NUMERIC'
        );
        array_push($args['meta_query'],$start);
    }
    if( $event_end !== '' ){
        $end = array(
            'key'       => CUSTOM_NAME2,
            'value'     => intval($event_end),
            'compare'   => '==',
            'type'      => 'NUMRIC'
        );
        array_push($args['meta_query'],$end);
    }
}

// 条件にマッチした記事を取得
$results = get_posts($args);

// domの作成と初期化
$dom = new DOMDocument();
$dom->encoding = 'UTF-8';
$dom->formatOutput = true;

// Rootタグの作成
$Results = $dom->appendChild($dom->createElement('Results'));

// 記事をxmlで形成
foreach( $results as $result ){
    $Post = $Results->appendChild($dom->createElement('Post'));
    // ID作成
    $PostId = $Post->appendChild($dom->createElement('PostId'));
    $PostId->appendChild($dom->createTextNode($result->ID));
    // タイトル作成
    $PostTitle = $Post->appendChild($dom->createElement('PostTitle'));
    $PostTitle->appendChild($dom->createCDATASection($result->post_title));
    // コンテンツ作成
    $PostContent = $Post->appendChild($dom->createElement('PostContent'));
    $PostContent->appendChild($dom->createCDATASection(htmlspecialchars($result->post_content)));
    // 投稿日時作成
    $PostDate = $Post->appendChild($dom->createElement('PostDate'));
    $PostDate->appendChild($dom->createTextNode($result->post_date));
    // URL作成
    $PostUrl = $Post->appendChild($dom->createElement('PostUrl'));
    $PostUrl->appendChild($dom->createTextNode($result->guid));
    // カテゴリ作成
    $categorys = get_the_category($result->ID);
    foreach( $categorys as $category ){
        $category_names[] = $category->name;
    }
    $category_name = implode(',',$category_names);
    unset($category_names);
    $PostCategory = $Post->appendChild($dom->createElement('PostCategory'));
    $PostCategory->appendChild($dom->createTextNode($category_name));
    // イベント開始日作成
    $EventStart = $Post->appendChild($dom->createElement('EventStartDate'));
    $EventStart->appendChild($dom->createTextNode($result->{CUSTOM_NAME1}));
    // イベント終了日作成
    $EventEnd = $Post->appendChild($dom->createElement('EventEndDate'));
    $EventEnd->appendChild($dom->createTextNode($result->{CUSTOM_NAME2}));
}

// xml出力
echo $dom->saveXML();

// デバック用
function _debug( $data ){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

?>
