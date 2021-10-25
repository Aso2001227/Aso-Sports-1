```uml
@startuml
title: ログ関係
alt ログアウト
ユーザー ->webサーバー :ログアウトボタンをクリック
webサーバー -> webサーバー :セッションデータを取り消す
webサーバー -> ユーザー :ログアウト成功を表示
end
@enduml
```
