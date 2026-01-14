<?php
$title = $_POST['news_title'];
$content = $_POST['news_content'];
$poster = $_POST['news_poster'];
$created = $_POST['news_created'];

// 宣告使用台北時間來當日期的計算
    date_default_timezone_set("Asia/Taipei");
    // 利用日期產生不會重複的檔案名稱
    $num = date('YmdHis');
    
    // 設定可允許的檔案類型陣列
    $allow = ['jpg','jpeg','gif','png','webp'];
    if(!empty($_FILES['news_img'])){
        if($_FILES['news_img']['error']>0){
            echo '檔案錯誤：'.$_FILES['news_img']['error'];
        }else{
            echo '有檔案：'.$_FILES['news_img']['name'].
                 '('.$_FILES['news_img']['tmp_name'].')'.
                 $_FILES["news_img"]["type"];
            // 取得原始檔案的副檔名
            $ext = pathinfo($_FILES['news_img']['name'], PATHINFO_EXTENSION);
            // 判斷副檔名是否為允許的檔案類型
            if(in_array($ext, $allow)){
                // 使用日期組合出不重覆的檔案名稱(存進 news_img 的資料為 $filename
                $filename = $num.'.'.$ext;
                // 檔上傳至暫存目錄的檔案移至網站指定的目錄內並更換為指定檔案名稱
                move_uploaded_file($_FILES['news_img']['tmp_name'],'upload/news/'.$filename);
            }else{
                // 強制結束 exit 以下所有PHP程式及網頁內容
                exit;
            }
        }
    }   
    echo '<br>';
    echo $title.'<br>';
    echo $content.'<br>';
    echo $poster.'<br>';
    echo $created.'<br>';
    echo $filename;

$host = 'localhost';        // 主機名稱
$db   = 'Vin';              // 資料庫名稱
$db_user = 'Vin';           // 帳號
$db_pw = '1234';            // 密碼

// 設定連線字串
$conn = mysqli_connect($host, $db_user, $db_pw, $db);

if($conn){
    // 建立 INSERT INTO資料表的 SQL 指令
    $sql = "INSERT INTO news (news_title, news_img, news_content, news_poster, news_created) VALUES ('222', '2222.jpg', '222222', 'Vin', '2026-01-12 21:28:10');";
    // 向資料庫下指令並取回資料
    $datas = mysqli_query($conn, $sql);
}
?>