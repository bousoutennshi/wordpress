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
    ・timeOnPage  
        滞在時間の多い記事でソートします。  
    ・visitors
        訪問者の多い記事でソートします。  
    ・pageviews
        ページビューの多い記事でソートします。  
    デフォルトはtimeOnPageとなります。  


使い方
----------------

リクエスト例 :  
http://redonepress.com/ranking/?sort=visitors  
http://redonepress.com/ranking/?start_date=2013-01-01&end_date=2013-03-31  


レスポンス仕様
----------------

```json
[
    {
        "ga:pageUrl": "http://redonepress.com/news/studio55-gakyouchunen-esow/",
        "ga:pageTitle": "STUDIO55 Presents「画狂中年」 by ESOW",
        "ga:thumbnail": "http://redonepress.heteml.jp/rop/wp-content/uploads/2013/04/gakyouchunen_ic.jpg",
        "ga:timeOnPage": "11951.0",
        "ga:visitors": "147",
        "ga:pageviews": "197"
    },
    {
        "ga:pageUrl": "http://redonepress.com/news/reebok-keith-photo-report/",
        "ga:pageTitle": "“Keith Haring Exhibition” Photo Report",
        "ga:thumbnail": "http://redonepress.heteml.jp/rop/wp-content/uploads/2013/04/reeboks.jpg",
        "ga:timeOnPage": "11441.0",
        "ga:visitors": "97",
        "ga:pageviews": "136"
    },
    .
    .
    .
    {
        "ga:pageUrl": "http://redonepress.com/search?q=cache:uXUysBeypKMJ:redonepress.com/news/hiro-kurata-home-field-disadvantage/+motus+fort+2013&cd=2&hl=ja&ct=clnk&gl=jp",
        "ga:pageTitle": "Hiro Kurata “Home Field Disadvantage”",
        "ga:thumbnail": "http://redonepress.heteml.jp/rop/wp-content/uploads/2013/03/hiro_ic.jpg",
        "ga:timeOnPage": "0.0",
        "ga:visitors": "1",
        "ga:pageviews": "1"
    }
]
```
