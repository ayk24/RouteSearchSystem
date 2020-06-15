# RouteSearchSystem

## Database Structure
#### users <User's Registration Information>
user_id  : ユーザを判別するための一意のID   
username : ユーザ登録の際に設定したユーザ名  
email    : ユーザ登録の際に設定したメールアドレス  
password : ユーザ登録の際に設定したパスワードをハッシュ化したもの  

#### history <keeps a history of searched routes>  
history_id   : 履歴を判別するための一意のID  
user_id      : ユーザを判別するための一意のID(外部キー)  
share        : 共有を許可するかどうかを示すboolean型の変数( 1:許可, 0:不許可 )  
origin       : 出発地の情報  
destination  : 目的地の情報  
travelmode   : 利用する交通機関の情報  
time         : かかる時間の情報  
distance     : かかる距離の情報   

## Usage
1. Register a user in signup.php, or log in with login.php  
2. Once you're logged in, redirect to home.php.  
   Enter your starting point in the "From" form and your destination in the "To" form.  
3. The route is drawn on the map and the guide to the destination is shown at the right part of the page.
4. If you switch to the navigation bar of "History", you can see your (the logged-in user) search history.  
   If you check the checkbox, you can share your route history with others.  

 RouteSearchSystem   
　├ core  
　│　└ config.php : データベースのログイン情報  
　│  
　├ css : bootstrap や 自作したCSS が入っている.  
　│  
　├ img : 画像が入っている.  
　│  
　├ js : bootstrap や map生成を行うプログラムが入っている.  
　│　└ googlemap.js    : 最初のmap生成, ルート検索, 検索履歴の登録の処理の一部を行う.  
　│  
　├ checked.php 　     : 共有の許可, 不許可の処理を行った際のデータベース側での処理  
　├ dbconnect.php      : データベースへの接続を行う.  
　├ home.php           : 検索したいルートの情報の入力を行ったり, 結果を表示する.  
　├ insert_history.php : 検索した履歴をデータベースに保存する処理.  
　├ login.php          : ユーザ認証を行う.  
　├ logout.php         : クリックするとログインページにリダイレクトする.  
　├ show_history.php   : 自分の検索履歴を表示する.(他人のものは見えない)  
　├ show_shareinfo.php : 共有が許可されているルートの履歴を閲覧する.  
　└ signup.php         : ユーザの登録を行う.  
