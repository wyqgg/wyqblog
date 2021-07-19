<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/7/14
 * Time: 16:23
 */


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendors/phpmailer/phpmailer/src/Exception.php';
require '../../vendors/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendors/phpmailer/phpmailer/src/SMTP.php';

App::uses('Component', 'Controller');

class EmailComponent extends Component
{
    /*
     * 传递参数
     * $params $email 接收邮箱地址
     * $params $content 邮箱内容
     */
    function sendmail($email,$content){
//初始化参数
     $mail = new PHPMailer(true);
     try{
         //服务器配置
         $mail->CharSet ="UTF-8";                     //设定邮件编码
         $mail->SMTPDebug = 0;                        // 调试模式输出
         $mail->isSMTP();                             // 使用SMTP
         $mail->Host = 'smtp.qq.com';                // SMTP服务器
         $mail->SMTPAuth = true;                      // 允许 SMTP 认证
         $mail->Username = '2717719404@qq.com';                // SMTP 用户名  即邮箱的用户名
         $mail->Password = 'tcviesfxvxymdhbh';             // SMTP 密码  部分邮箱是授权码
         $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
         $mail->Port = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

         $mail->setFrom('2717719404@qq.com', 'wyqgg');  //发件人
         $mail->addAddress($email, 'wyq');  // 收件人
         //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
         $mail->addReplyTo('2717719404@qq.com', 'info'); //回复的时候回复给哪个邮箱 建议和发件人一致
         //Content
         $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
         //标题
         $mail->Subject = '登录提示' . time();
         //主体部分
         $mail->Body    = $content . date('Y-m-d H:i:s');
         $mail->AltBody = '如果邮件客户端不支持HTML则显示此内容';

         $mail->send();
         return 1;
     }catch (Exception $e){
         return 0;
     }
 }
}