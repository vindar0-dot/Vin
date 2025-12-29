<?php
    // 讀取網址上的參數 username
    // 如網址：http://localhost/Vin2/14.php?username=tom&q=vin
    // 將 $name 預設為空值
    $name = '';
    // 判斷網址有參數 username 時，將值寫入 $name 中
    // enpty 判斷變數為空值
    // !empty 判斷變數不為空值
    if(!empty($_GET['username'])){
        $name = $_GET['username'];    // $name = 'tom'
    }
    $q = '';
    if(!empty($_GET['q'])){
        $q = $_GET['q'];              // $q = 'vin'
    }

    // $account = '';
    // if(!empty($_POST['account'])){
    //    $account = $_POST['account'];
    // }

    // 簡化寫法 三元運算子的運用 (類似 if...else... 的判斷式）
    $account = !empty($_POST['account'])?$_POST['account']:'';

    // $pw = '';
    // if(!empty($_POST['pw'])){
    //    $pw = $_POST['pw'];
    //}
    $pw = !empty($_POST['pw'])?$_POST['pw']:'';

    // 判斷帳號與密碼是否正確
    if($account == 'admin' and $pw == '1234'){
        $msg = '<p style="color:green;">登入成功</p>';
    } else{
        $msg = '<b style="color:red;">帳號或密碼錯誤，請重試</b>';
    // <b> 加粗標籤    
    }
    
    // echo $account;
    // echo '<br>';
    // echo $pw;

    // 常數的宣告與使用
    define("URL" , "http://localhost/Vin2/" );
    // echo URL.'14.php';

    // 宣告使用台北時間來當日期的計算
    date_default_timezone_set("Asia/Taipei");
    // 美東時間
    // date_default_timezone_set("America/New_York");

    // 日期物件
    echo date("Y-m-d H:i:s").'<br>';
    // 利用日期產生不會重複的檔案名稱
    $num = date('YmdHis');
    echo $num.'.jpg<br>';

    // 檔案接收
    $upload = '';
    // 設定可允許的檔案陣列
    $allow = ['jpg','jpeg','png','gif'];
    if(!empty($_FILES['upload'])){
        if($_FILES['upload']['error']>0){
            echo '檔案錯誤：'.$_FILES['upload']['error'];
        }else{
            echo '有檔案：'.$_FILES['upload']['name'].'<br>'.
                '('.$_FILES['upload']['tmp_name'].')'.'<br>'.
                $_FILES["upload"]["type"];
            // 取得原始檔案的副檔名
            $ext = pathinfo($_FILES['upload']['name'],PATHINFO_EXTENSION);
            if(in_array($ext, $allow)){
            // 使用日期組合出不重複的檔案名稱
            $filename = $num.'.'.$ext;
            // 將上傳至暫存目錄的檔案移置網站指定的目錄內並換回原始名稱    
            move_uploaded_file($_FILES['upload']['tmp_name'],'upload/'.$filename);
            }else{
                exit;
            }
        }
    }
   

    // 數字遞增，++在後面意味已加過
    // $a = 1;
    // echo $a++.'<br>';
    // echo $a;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><input type="text" name="" id="" value="<?php echo $q; ?>"></p>

    <!-- 會員登入表單 -->
    <form action="" method="post">
        帳號：<input type="text" name="account" id=""><br>
        密碼：<input type="password" name="pw" id=""><br>
        <input type="submit" value="登入">
    </form>

    <p><?php echo $msg; ?></p>
    <p>><a href="<?php echo URL.'resume'; ?>" target="_blank">前往頁面</a></p>

    <!-- 檔案上傳表單 -->
    <form action="" method="post" enctype="multipart/form-data">
        <!-- 透過 accept 設定可選擇上傳的檔案類型 -->
        上傳檔案：<input type="file" name="upload" id="" accept=".jpeg,.jpg,.png,.gif">
        <input type="submit" value="上傳">

    </form>
</body>
</html>


