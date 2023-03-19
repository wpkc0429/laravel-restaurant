# Laravel

## 環境版本
  - php 8.1
  - Laravel 9.52.4

## Installation

基本安裝
```sh
$ cp .env.example .env
$ composer install
```

資料庫設定
```sh
$ vim .env
```
| Name | Description |
| ------ | ------ |
| DB_CONNECTION | 連線方式 |
| DB_HOST | Host Or IP |
| DB_PORT | 連線Port |
| DB_DATABASE | 資料庫名稱 |
| DB_USERNAME | 連線帳號 |
| DB_PASSWORD | 連線密碼 |

第一次環境設定
```sh
$ php artisan key:generate
```

# Group Stores

Resources related to stores in the API
## Stores Collection [/stores]
### List All Stores [GET]
+ Response 200 (application/json)

        [
            {
                "success": true,
                "data": [
                    {
                        "id": 1,
                        "name": "店家1名稱",
                        "phone": "店家1電話",
                        "business_time": "店家1營業時間",
                        "lat": "店家1緯度",
                        "lng": "店家1經度",
                    }, {
                        "id": 2,
                        "name": "店家2名稱",
                        "phone": "店家2電話",
                        "business_time": "店家2營業時間",
                        "lat": "店家2緯度",
                        "lng": "店家2經度",
                    }, {
                        "id": 3,
                        "name": "店家3名稱",
                        "phone": "店家3電話",
                        "business_time": "店家3營業時間",
                        "lat": "店家3緯度",
                        "lng": "店家3經度",
                    }
                ]
            }
        ]
