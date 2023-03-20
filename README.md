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

# API

取得店家及餐點的API

## Get list of stores

### Request

`GET /api/v1/stores`

### Response 200 (application/json)

    {
        "success": true,
        "data": [
            {
                "id": 1,
                "name": "店家1名稱",
                "phone": "店家1電話",
                "business_time": "店家1營業時間",
                "lat": "店家1緯度",
                "lng": "店家1經度"
            }, {
                "id": 2,
                "name": "店家2名稱",
                "phone": "店家2電話",
                "business_time": "店家2營業時間",
                "lat": "店家2緯度",
                "lng": "店家2經度"
            }, {
                "id": 3,
                "name": "店家3名稱",
                "phone": "店家3電話",
                "business_time": "店家3營業時間",
                "lat": "店家3緯度",
                "lng": "店家3經度"
            }
        ]
    }

## Create a new store

### Request

`POST /api/v1/store`

    {
        "name": "新店家名稱",
        "phone": "新店家電話",
        "business_time": "新店家營業時間",
        "lat": "新店家緯度",
        "lng": "新店家經度"
    }

### Response 200 (application/json)

    {
        "success": true,
        "data": {
            "id": 4,
            "name": "新店家名稱",
            "phone": "新店家電話",
            "business_time": "新店家營業時間",
            "lat": "新店家緯度",
            "lng": "新店家經度"
        }
    }

## Get a specific store

### Request

`GET /api/v1/store/:store_id`

### Response 200 (application/json)

    {
        "success": true,
        "data": {
            "id": 1,
            "name": "店家1名稱",
            "phone": "店家1電話",
            "business_time": "店家1營業時間",
            "lat": "店家1緯度",
            "lng": "店家1經度"
        }
    }

## Change a specific store

### Request

`PUT /api/v1/store/:store_id`

    {
        "name": "店家1新名稱",
        "phone": "店家1新電話",
        "business_time": "店家1新營業時間",
        "lat": "店家1新緯度",
        "lng": "店家1新經度"
    }

### Response 200 (application/json)

    {
        "success": true,
        "data": {
            "id": 1,
            "name": "店家1新名稱",
            "phone": "店家1新電話",
            "business_time": "店家1新營業時間",
            "lat": "店家1新緯度",
            "lng": "店家1新經度"
        }
    }   

## Delete a specific store

### Request

`DELETE /api/v1/store/:store_id`

### Response 200 (application/json)

    {
        "success": true,
        "data": "刪除成功"
    }     

## Get list of foods

### Request

`GET /api/v1/store/:store_id/foods`

### Response 200 (application/json)

    {
        "success": true,
        "data": [
            {
                "id": 1,
                "name": "餐點1名稱",
                "unit_price": "餐點1價格",
                "desc": "餐點1備註"
            }, {
                "id": 2,
                "name": "餐點2名稱",
                "unit_price": "餐點2價格",
                "desc": "餐點2備註"
            }, {
                "id": 3,
                "name": "餐點3名稱",
                "unit_price": "餐點3價格",
                "desc": "餐點3備註"
            }
        ]
    }

## Create a new food

### Request

`POST /api/v1/store/:store_id/food`

    {
        "name": "新餐點名稱",
        "unit_price": "新餐點價格",
        "desc": "新餐點備註"
    }

### Response 200 (application/json)

    {
        "success": true,
        "data": {
            "id": 4,
            "name": "新餐點名稱",
            "unit_price": "新餐點價格",
            "desc": "新餐點備註"
        }
    }

## Get a specific food

### Request

`GET /api/v1/store/:store_id/food/:food_id`

### Response 200 (application/json)

    {
        "success": true,
        "data": {
            "id": 1,
            "name": "餐點1名稱",
            "unit_price": "餐點1價格",
            "desc": "餐點1備註"
        }
    }

## Change a specific food

### Request

`PUT /api/v1/store/:store_id/food/:food_id`

    {
        "name": "餐點1新名稱",
        "unit_price": "餐點1新價格",
        "desc": "餐點1新備註"
    }

### Response 200 (application/json)

    {
        "success": true,
        "data": {
            "id": 1,
            "name": "餐點1新名稱",
            "unit_price": "餐點1新價格",
            "desc": "餐點1新備註"
        }
    }   

## Delete a specific store

### Request

`DELETE /api/v1/store/:store_id/food/:food_id`

### Response 200 (application/json)

    {
        "success": true,
        "data": "刪除成功"
    }  
