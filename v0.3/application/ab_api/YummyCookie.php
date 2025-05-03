<?php
//加密函数，使用AES-256-CBC加密
function encrypt($data, $key) {
    $method = 'AES-256-CBC';
    $ivlen = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext= openssl_encrypt($data, $method, $key,0, $iv);
    $encryptedData = base64_encode($iv . $ciphertext);
    return $encryptedData;
}
function decrypt($data, $key) {
    $data = base64_decode($data);
    $method = 'AES-256-CBC';
// 提取 IV 和密文
    $ivLength = openssl_cipher_iv_length($method);
    $iv = substr($data, 0, $ivLength);
    $ciphertext = substr($data, $ivLength);

// 执行解密
    $decryptedText = openssl_decrypt($ciphertext, $method, $key, 0, $iv);

    return $decryptedText;
}
function add_Sec_To_DtTmString($dateString, $secondsToAdd) {
    // 替换字符串中的 '-' 为 ' '，因为 DateTime::createFromFormat 不支持 '-' 作为时间分隔符
    $formattedDateString = str_replace('-',' ',$dateString);
    $formattedDateString = str_replace(':',' ',$formattedDateString);
    // 定义日期时间格式，注意这里的时间部分用空格分隔
    $format = 'Y m d H i s';
    
    // 创建 DateTime 对象
    $dateTime = DateTime::createFromFormat($format, $formattedDateString);
    // 检查 DateTime 对象是否创建成功
    if (!$dateTime) {
        throw new Exception("Invalid date string: $dateString");
    }
    
    // 添加指定的秒数
    $dateTime->modify("+{$secondsToAdd} seconds");
    // 格式化回原格式的字符串，注意这里又要把空格换回 '-'
    $resultString = $dateTime->format('Y-m-d H:i:s');
//$resultString = str_replace(' ', '-', $resultString);
    
    return $resultString;
}
class YUMMY{
    function buy_cookie($uname,$uid,$snindttm)
    {
        setcookie('user_auth','',time()-3600,'/','codecraft.czlj.net',true,true);

        // 生成密钥：时间戳+~30天~60s
        $secretKey =add_Sec_To_DtTmString($snindttm,86400);
//(30 * 86400); // 30天的秒数
        $lastLoginTimestamp =$snindttm; // 格式为 Y-m-d H:i:s
        // 数据拼接为字符串
        $dataToEncrypt = json_encode(['username' => encrypt($uname,$secretKey), 'userId' => $uid, 'lastLoginTimestamp' => encrypt($lastLoginTimestamp,$secretKey)]);
        // 加密数据$encryptedData = encrypt($dataToEncrypt, $secretKey);

        // 设置cookie，过期时间为30天
        $cookieName = 'user_auth';
        $cookieValue = $dataToEncrypt;
        $cookieExpire = time() +86400; // 30天 (30 * 86400)
        setcookie($cookieName, $cookieValue, $cookieExpire, '/', 'codecraft.czlj.net', true, true); // HttpOnly 和 Secure

        //echo 'Cookie has been set.'.'<br>'.'cookieName:'.$cookieName.'<br>'.'cookieValue:'.$cookieValue.'<br>'.'cookieExpire:'.$cookieExpire.'<br>';
    }

    function taste_cookie(){
        // 尝试从cookie中获取数据
        if(isset($_COOKIE['user_auth'])) {
            $cookieValue = $_COOKIE['user_auth'];
            $data = json_decode($cookieValue, true);
            $userId = $data['userId'];
            include("db.php");
            // 在这里可以继续处理验证通过后的逻辑，例如设置会话变量等
            $stmt = $conn->prepare("SELECT username,sign_in_datetime FROM users WHERE id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $uinfo = $result->fetch_assoc();
            if(!$uinfo){echo 'No cookie found.';return;}
            $snindttm=$uinfo['sign_in_datetime'];
         // 生成密钥：当前时间戳+30天（假设用户登录时间在30天内有效）

            $secretKey = add_Sec_To_DtTmString($snindttm,86400);

            // 解密数据

            $data['username']=decrypt($data['username'], $secretKey);
            $data['lastLoginTimestamp']=decrypt($data['lastLoginTimestamp'], $secretKey);
//$data['username'], $data['userId'], $data['lastLoginTimestamp']
            if(isset($data['username'], $data['userId'], $data['lastLoginTimestamp'])) {
                $username = $data['username'];
                $lastLoginTimestamp = $data['lastLoginTimestamp'];
                // 在这里可以继续处理验证通过后的逻辑，例如设置会话变量等
                if($uinfo['sign_in_datetime']==$lastLoginTimestamp && $uinfo['username']==$username){
                    echo '身份验证成功！'.'<br>用户<b>'.$username.'<br>UID:'.$userId.'</b><br><i>Welcome!</i>';
                }
                //echo "uinfo_get:".$uinfo."   Cookie valid: Username - $username, User ID - $userId, Last Login - $lastLoginTimestamp";
            }
            else {
                // 数据不完整，清空cookie
                setcookie('user_auth', '', time() - 3600, '/', null, true, true); // 过期时间设为过去
                echo "Cookie data incomplete. Cookie has been cleared.";
            }/*
            else {
                // 解密失败，清空cookie
                setcookie('user_auth', '', time() - 3600, '/', null, true, true); // 过期时间设为过去
                echo "Cookie decryption failed. Cookie has been cleared.";
            }*/
        }
        else {
            echo "No cookie found.";
        }
    }
}
?>