# データベース設計図

## d_purchase

|項目名|型|PK|NN|FK|
|-----|--|--|--|--|
|order_id|bigint(20)|○|○||
|sports-id|varchar(30)||○|○|
|customer_code|varchar(50)||○|○|
|purchase_date|date||○||
|total_price|int(11)||○||

## d_purchase_detail

|項目名|型|PK|NN|FK|
|-----|--|--|--|--|
|detail_id|bigint(20)|○|○||
|order_id|bigint(20) |○|○|○|
|sports-id|varchar(30)||○|○|
|item_code|int(11)||○||
|price|int(11)||○||
|num|int(11)||○||

## m_customers

|項目名|型|PK|NN|FK|
|-----|--|--|--|--|
|customer_code|varchar(50)|○|○||
|pass|varchar(50)||○||
|name|varchar(20)||○||
|address|varchar(100)||○||
|tel|varchar(20)||○||
|mail|varchar(100)||○||
|rank|varchar(10)|○|○||
|del_flag|int(1)||||
|reg_date|date||○||

## m_rank

|項目名|型|PK|NN|FK|
|-----|--|--|--|--|
|rank|varchar(10)|○|○||
|name|varchar(20)||○||
|reg_date|date||○||

## m_items

|項目名|型|PK|NN|FK|
|-----|--|--|--|--|
|item_code|int(11)|○|○||
|item_name|varchar(50)||○||
|sports-id|varchar(30)||○|○|
|price|int(11)||○||
|image|varchar(200)||○||
|detail|varchar(500)||||
|del_flag|int(11)||||
|reg_date|date||○||
