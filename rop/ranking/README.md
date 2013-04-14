WordPress rop Google Analitycs Ranking API
=========

WordPress rop Google Analitycs Ranking API


パラメータの解説
----------------

start_date :  
    ランキング指定日の開始日時を指定します。  
    フォーマットはYYYY-MM-DDとなります。  
    デフォルトは前日指定になります。  

end_date :  
    ランキング指定日の終了日を指定します。  
    フォーマットはYYYY-MM-DDとなります。  
    デフォルトは本日指定となります。  

sort :  
    ランキングのソートを指定します。  
    指定出来る値は現在以下の３種類となっています。  
    デフォルトはtimeOnPageとなります。  
    ・timeOnPage  
        滞在時間の多い記事でソートします。  
    ・visitors  
        訪問者の多い記事でソートします。  
    ・pageviews  
        ページビューの多い記事でソートします。  

results :  
    ランキングの記事の取得件数を指定します。  
    デフォルトは5件取得するようになっています。  


使い方
----------------

リクエスト例 :  
http://redonepress.com/ranking/?sort=visitors  
http://redonepress.com/ranking/?results=1  
http://redonepress.com/ranking/?start_date=2013-01-01&end_date=2013-03-31  


レスポンス仕様
----------------

```json
[
    {
        "ga:pageUrl": "http://redonepress.com/news/studio55-gakyouchunen-esow/",
        "ga:pageTitle": "STUDIO55 Presents「画狂中年」 by ESOW",
        "ga:thumbnail": "http://redonepress.heteml.jp/rop/wp-content/uploads/2013/04/gakyouchunen_ic.jpg",
        "ga:icon": "http://redonepress.heteml.jp/rop/wp-content/uploads/2013/04/gakyouchunen_ic-150x132.jpg",
        "ga:timeOnPage": "9129.0",
        "ga:visitors": "122",
        "ga:pageviews": "167"
    },
    {
        "ga:pageUrl": "http://redonepress.com/news/jose-parla-prose/",
        "ga:pageTitle": "José Parlá Exhibition “PROSE”",
        "ga:thumbnail": "http://redonepress.heteml.jp/rop/wp-content/uploads/2013/03/jose_ic.jpg",
        "ga:icon": "http://redonepress.heteml.jp/rop/wp-content/uploads/2013/03/jose_ic-150x132.jpg",
        "ga:timeOnPage": "2779.0",
        "ga:visitors": "28",
        "ga:pageviews": "38"
    },
    {
        "ga:pageUrl": "http://redonepress.com/news/kansuke_akaike-stencil-stories/",
        "ga:pageTitle": "赤池完介 “Stencil Stories”",
        "ga:thumbnail": "http://redonepress.heteml.jp/rop/wp-content/uploads/2013/04/akaike_ic.jpg",
        "ga:icon": "http://redonepress.heteml.jp/rop/wp-content/uploads/2013/04/akaike_ic-150x132.jpg",
        "ga:timeOnPage": "2556.0",
        "ga:visitors": "29",
        "ga:pageviews": "35"
    },
    {
        "ga:pageUrl": "http://redonepress.com/news/reebok-keith-photo-report/",
        "ga:pageTitle": "“Keith Haring Exhibition” Photo Report",
        "ga:thumbnail": "http://redonepress.heteml.jp/rop/wp-content/uploads/2013/04/reeboks.jpg",
        "ga:icon": "http://redonepress.heteml.jp/rop/wp-content/uploads/2013/04/reeboks-150x132.jpg",
        "ga:timeOnPage": "2514.0",
        "ga:visitors": "22",
        "ga:pageviews": "31"
    },
    {
        "ga:pageUrl": "http://redonepress.com/news/hidden-champion-issue28/",
        "ga:pageTitle": "HIDDEN CHAMPION Issue#28 Spring 2013",
        "ga:thumbnail": "http://redonepress.heteml.jp/rop/wp-content/uploads/2013/04/hiddens.jpg",
        "ga:icon": "http://redonepress.heteml.jp/rop/wp-content/uploads/2013/04/hiddens-150x132.jpg",
        "ga:timeOnPage": "2205.0",
        "ga:visitors": "19",
        "ga:pageviews": "20"
    }
]
```
