WordPress rop Archive Search API
=========

WordPress rop Archive Search API


パラメータの解説
----------------

post_type :
    投稿タイプを指定します。
    デフォルトはpostとなります。

results :
    取得件数を指定します。
    デフォルトは30件となります。

start :
    取得開始位置を指定します。
    デフォルトは0となります。これはデータの先頭を表します。

category:
    カテゴリを指定します。
    デフォルトは空となり、全てのカテゴリに属するデータを取得します。

s :
    検索キーワードを指定します。

m :
    投稿日を指定します。
    指定フォーマットはYYYYMMDDとなります。

orderby :
    ソートに使う項目を指定します。
    デフォルトはpost_dateとなります。

order :
    ソート順を指定します。
    デフォルトはDESCとなります。昇順にしたい場合はASCを指定します。

relation :
    カスタムフィールドの条件検索を指定します。
    デフォルトはANDとなります。ORを指定する事も可能です。

event_start :
    イベント開始日を指定します。
    指定フォーマットはYYYYMMDDとなります。

event_end :
    イベント終了日を指定します。
    指定フォーマットはYYYYMMDDとなります。

event_startとevent_endの仕様について :
    event_startおよびevent_endのどちらかを指定した場合はその日のイベント一覧を取得します。
    event_startとevent_endの両方を指定した場合はその間のイベント一覧を取得します。


使い方
----------------

リクエスト例 :
http://redonepress.heteml.jp/rop/archives/?category=news
http://redonepress.heteml.jp/rop/archives/?event_start=20130101&event_end=20130228


レスポンス仕様
----------------

<?xml version="1.0" encoding="UTF-8"?>
<Results>
  <Post>
    <PostId>37</PostId>
    <PostTitle><![CDATA[SHOHEI Interview Movie]]></PostTitle>
    <PostContent><![CDATA[彼の作品が純日本的表現を踏襲しているにも係わらず国籍問わず受け入れられる理由が説明されていて...]]></PostContent>
    <PostDate>2013-02-13 17:16:28</PostDate>
    <PostUrl>http://redonepress.heteml.jp/rop/?p=37</PostUrl>
    <PostCategory>event,news</PostCategory>
    <EventStartDate>20130209</EventStartDate>
    <EventEndDate>20130228</EventEndDate>
  </Post>
  .
  .
  .
</Results>
