<?php
// 前後１ヶ月を取得
date_default_timezone_set('Asia/Tokyo');
$last_month = date("Ymd",strtotime("-1 month")); // YYYYMMDD
$next_month = date("Ymd",strtotime("+1 month")); // YYYYMMDD

// 範囲内の開催中イベントデータ取得
$ch = curl_init();
$url = "http://redonepress.com/archives/?event_start=$last_month&event_end=$next_month";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$results = curl_exec($ch);
curl_close($ch);

// 改行削除
$results = str_replace(array("\n"), '', $results);

// Xml Objectにパース
$xml_list = simplexml_load_string($results, 'SimpleXMLElement', LIBXML_NOCDATA);

// イベント期間取得
$sec = 60 * 60 * 24; // 1日後に移動用
$event_days = array();
foreach( $xml_list as $node ){
    $start = mktime(0,0,0,
        substr($node->EventStartDate,4,2),
        substr($node->EventStartDate,6,2),
        substr($node->EventStartDate,0,4)
    );
    $end = mktime(0,0,0,
        substr($node->EventEndDate,4,2),
        substr($node->EventEndDate,6,2),
        substr($node->EventEndDate,0,4)
    );
    for( $i = $start; $i <= $end; $i += $sec ){
        $event_days[] = date("Ymd",$i);
    }
}

// 同じイベント日を削除
$event_days = array_unique($event_days);

// イベント日を昇順にソート
asort($event_days);
?>

<div class="ropTopMdCalendar">

<div class="ropCmnMdLbl typeCalendar decMB30">
  <p class="ptsTtl">CALENDAR</p>
</div>

<script type="text/javascript"><!--
<?php
// 開催中のイベント日挿入
foreach( $event_days as $event_day ){
    echo "clndrLink[\"X$event_day\"] = \"href='./event/?event_date=$event_day'\";";
}
?>
calendar_print(); // -->
</script>

</div>
<!-- /.ropTopMdCalendar -->
