<?php

namespace App\Http\Controllers;

use App\sequentst as sequentst;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
//use LINE\LINEBot\Event;
//use LINE\LINEBot\Event\BaseEvent;
//use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;
class GetMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

    /**
     * @var GetMessageService
     */
    public function index()
    {         
    

            $httpClient = new CurlHTTPClient('eBp/ZVsDsV2fMTqSBYGq4pgOvc+sgaPxxJFeT/rvpT/WTLiyw44BA2co2RBVROiLPVr8EEMrdiJ2I5cKWBe+j+GhNrHu6FUEHyol1dGf8DM/ZykdR84RgfTU2p+3U9NnhjqhWkDrN0tQT56rf23TxQdB04t89/1O/w1cDnyilFU=');
            $bot = new LINEBot($httpClient, array('channelSecret' => 'f571a88a60d19bb28d06383cdd7af631'));
            // คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
            $content = file_get_contents('php://input');
            // แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array
            $events = json_decode($content, true);
            if(!is_null($events)){
            // ถ้ามีค่า สร้างตัวแปรเก็บ replyToken ไว้ใช้งาน
                $replyToken = $events['events'][0]['replyToken'];
            }
            // ส่วนของคำสั่งจัดเตียมรูปแบบข้อความสำหรับส่ง
            $textMessageBuilder = new TextMessageBuilder(json_encode($events));
            //l ส่วนของคำสั่งตอบกลับข้อความ
            $response = $bot->replyMessage($replyToken,$textMessageBuilder);
            if ($response->isSucceeded()) {
                echo 'Succeeded!';
                return;
            }
            // Failed
            echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
            $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('omL/jl2l8TFJaYFsOI2FaZipCYhBl6fnCf3da/PEvFG1e5ADvMJaILasgLY7jhcwrR2qOr2ClpTLmveDOrTBuHNPAIz2fzbNMGr7Wwrvkz08+ZQKyQ3lUfI5RK/NVozfMhLLAgcUPY7m4UtwVwqQKwdB04t89/1O/w1cDnyilFU=');
            $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'f571a88a60d19bb28d06383cdd7af631']);
            // $response = $bot->replyText($replyToken, 'hello!');




      // แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array
    $events = json_decode($content, true);
    if(!is_null($events)){
    // ถ้ามีค่า สร้างตัวแปรเก็บ replyToken ไว้ใช้งาน
         $replyToken  = $events['events'][0]['replyToken'];
         $typeMessage = $events['events'][0]['message']['type'];
         $userMessage = $events['events'][0]['message']['text'];
         $userMessage = strtolower($userMessage);
         $user = $events['events'][0]['source']['userId'];


         $seqcode = DB::table('sequentsteps')
                     ->select('seqcode')
                     ->where('sender_id', $user)
                     ->first();

        
   
       

  if (strpos($userMessage, 'hello') !== false || strpos($userMessage, 'สวัสดี') !== false || strpos($userMessage, 'ต้องการผู้ช่วย') !== false) {
                  $textReplyMessage = "สวัสดีค่ะ ดิฉันเป็นหุ่นยนต์อัตโนมัติที่ถูกสร้างเพื่อว่าที่คุณแม่นะคะ";
                  $textMessage1 = new TextMessageBuilder($textReplyMessage);
                  $textReplyMessage = "ดิฉันสามารถให้ข้อมูลโภชนาการและติดตามไลฟ์สไตล์ของคุณได้ตลอดช่วงการตั้งครรภ์นะคะ";
                  $textMessage2 = new TextMessageBuilder($textReplyMessage);
                  $textReplyMessage = "เนื่องจากดิฉันยังเรียนรู้ภาษาอยู่ จึงอาจไม่เข้าใจภาษาดีพอนะคะ ต้องขออภัยล่วงหน้าด้วยค่ะ";
                  $textMessage3 = new TextMessageBuilder($textReplyMessage);
                  $textMessage4 = new TemplateMessageBuilder('Confirm Template', new 
                   ConfirmTemplateBuilder('หากคุณสนใจให้ดิฉันเป็นผู้ช่วยอัตโนมัติของคุณ โปรดกดยืนยันด้างล่างด้วยนะคะ',
                                array(
                                    new MessageTemplateActionBuilder(
                                        'สนใจ',
                                        'สนใจ'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่สนใจ',
                                        'ไม่สนใจ'
                                    )
                                )
                        )
                    );

                  $multiMessage =     new MultiMessageBuilder;
                  $multiMessage->add($textMessage1);
                  $multiMessage->add($textMessage2);
                  $multiMessage->add($textMessage3);
                  $multiMessage->add($textMessage4);
                  $replyData = $multiMessage; 
                  
                  $sequentsteps = DB::table('sequentsteps')->insert(['sender_id'=>$user,'seqcode' => '0004','answer' => 'NULL','nextseqcode' =>'0005','status'=>'0','created_at'=>NOW() , 'updated_at'=>NOW()]);

    }elseif( $userMessage == 'สนใจ' && $seqcode->seqcode == '0004' ){
                    $textReplyMessage = "ก่อนอื่น ดิฉันขอทราบชื่อและนามสกุลของว่าที่คุณแม่หน่อยนะคะ";
                    $replyData = new TextMessageBuilder($textReplyMessage);
                    DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0005','nextseqcode' => '0006']);
    }elseif ($userMessage == 'ไม่สนใจ' ) {
                    $textReplyMessage = 'ไว้โอกาสหน้าให้เราได้เป็นผู้ช่วยของคุณนะคะ:) หากคุณสนใจในภายหลังให้พิมพ์ว่า "ต้องการผู้ช่วย" ';
                    $replyData = new TextMessageBuilder($textReplyMessage);
                  
  
    }elseif ($userMessage == 'ไม่ถูกต้อง' ) {
                    $textReplyMessage = 'กรุณาพิมพ์ใหม่นะคะ ';
                    $replyData = new TextMessageBuilder($textReplyMessage);
            
    
    }elseif ($userMessage == 'ชื่อถูกต้อง' && $seqcode->seqcode == '0005' ) {
                    $textReplyMessage = 'ขอทราบอายุของคุณหน่อยค่ะ';
                    $replyData = new TextMessageBuilder($textReplyMessage);

                    $answer = DB::table('sequentsteps')
                     ->select('answer')
                     ->where('sender_id', $user)
                     ->first();
                    $answer = $answer->answer;

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0007','nextseqcode' => '0008']);
                    $users_register= DB::table('users_register')->insert(['user_id'=>$user,'user_name' => $answer ,'status' => '1','user_age'=>'0','user_height'=>'0','user_Pre_weight'=>'0','user_weight'=>'0','preg_week'=>'0', 'phone_number'=>'NULL','email' =>'NULL','hospital_name'=>'NULL','hospital_number'=>'NULL','history_medicine'=>'NULL', 'history_food'=>'NULL','active_lifestyle'=>'0','updated_at' =>NOW()]);

    }elseif(is_string($userMessage) !== false && $seqcode->seqcode  == '0005' ){

                     $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder('ชื่อของคุณคือ'.$userMessage.'ใช่ไหมคะ?',
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'ชื่อถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    );

                    DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0005','answer' => $userMessage ,'nextseqcode' => '0006']);

   
    }elseif(is_numeric($userMessage) !== false && $seqcode->seqcode  == '0007' ){

                     $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( 'คุณอายุ '.$userMessage.'ปี ใช่ไหมคะ',
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'อายุถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    );

                    DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0007','answer' => $userMessage ,'nextseqcode' => '0009']);

    }elseif ($userMessage == 'อายุถูกต้อง' && $seqcode->seqcode == '0007') {
                    $textReplyMessage = 'ขอทราบส่วนสูงปัจจุบันของคุณค่ะ (กรุณาตอบเป็นตัวเลขในหน่วยเซ็นติเมตร เช่น 160)';
                    $replyData = new TextMessageBuilder($textReplyMessage);

                    $answer = DB::table('sequentsteps')
                     ->select('answer')
                     ->where('sender_id', $user)
                     ->first();
                    $answer = $answer->answer;

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0008','nextseqcode' => '0010']);
                    $users_register = DB::table('users_register')
                       ->where('user_id', $user)
                       ->update(['user_age' => $answer ]);

    }elseif(is_numeric($userMessage) !== false && $seqcode->seqcode  == '0008' ){

                     $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( 'ส่วนสูงปัจจุบันของคุณคือ'.$userMessage.'เซ็นติเมตร ใช่ไหมคะ',
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'ส่วนสูงถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    );

                    DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'008','answer' => $userMessage ,'nextseqcode' => '0011']);

    }elseif ($userMessage == 'ส่วนสูงถูกต้อง' && $seqcode->seqcode == '0008' ) {
                    $textReplyMessage = 'ขอทราบน้ำหนักปกติก่อนตั้งครรภ์ค่ะ (กรุณาตอบเป็นตัวเลขในหน่วยกิโลกรัม เช่น 55)';
                    $replyData = new TextMessageBuilder($textReplyMessage);

                    $answer = DB::table('sequentsteps')
                     ->select('answer')
                     ->where('sender_id', $user)
                     ->first();
                    $answer = $answer->answer;

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'00011','nextseqcode' => '0012']);
                    $users_register = DB::table('users_register')
                       ->where('user_id', $user)
                       ->update(['user_height' => $answer ]);

    
    }elseif(is_numeric($userMessage) !== false && $seqcode->seqcode  == '0011' ){

                     $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( 'ก่อนตั้งครรภ์คุณมีน้ำหนัก'.$userMessage.'กิโลกรัมใช่ไหมคะ',
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'น้ำหนักก่อนตั้งครรภ์ถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    );

                    DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0011','answer' => $userMessage ,'nextseqcode' => '0013']);

    }elseif ($userMessage == 'น้ำหนักก่อนตั้งครรภ์ถูกต้อง' && $seqcode->seqcode == '0011' ) {
                    $textReplyMessage = 'ขอทราบน้ำหนักปัจจุบันของคุณค่ะ (กรุณาตอบเป็นตัวเลขในหน่วยกิโลกรัม เช่น 59)';
                    $replyData = new TextMessageBuilder($textReplyMessage);

                    $answer = DB::table('sequentsteps')
                     ->select('answer')
                     ->where('sender_id', $user)
                     ->first();
                    $answer = $answer->answer;

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'00013','nextseqcode' => '0014']);
                    $users_register = DB::table('users_register')
                       ->where('user_id', $user)
                       ->update(['user_Pre_weight' => $answer ]);

    
    }elseif(is_numeric($userMessage) !== false && $seqcode->seqcode  == '0013' ){

                     $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( 'น้ำหนักปัจจุบันของคุณคือ'.$userMessage.'กิโลกรัมใช่ไหมคะ',
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'น้ำหนักปัจจุบันถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    );

                    DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0013','answer' => $userMessage ,'nextseqcode' => '0015']);

    }elseif ($userMessage == 'น้ำหนักปัจจุบันถูกต้อง' && $seqcode->seqcode == '0013' ) {
                     $actionBuilder = array(
                                          new MessageTemplateActionBuilder(
                                          'ครั้งสุดท้ายที่มีประจำเดือน',// ข้อความแสดงในปุ่ม
                                          'ครั้งสุดท้ายที่มีประจำเดือน' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                          ),
                                           new MessageTemplateActionBuilder(
                                          'กำหนดการคลอด',// ข้อความแสดงในปุ่ม
                                          'กำหนดการคลอด' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                          ) 
                                         );

                     $imageUrl = 'https://www.mywebsite.com/imgsrc/photos/w/simpleflower';
                     $replyData = new TemplateMessageBuilder('Button Template',
                     new ButtonTemplateBuilder(
                              'คุณมีอายุครรภ์กี่สัปดาห์คะ?', // กำหนดหัวเรื่อง
                              'กรุณาเลือกตอบข้อใดข้อหนึ่งเพื่อให้ทางเราคำนวณอายุครรภ์ค่ะ', // กำหนดรายละเอียด
                               $imageUrl, // กำหนด url รุปภาพ
                               $actionBuilder  // กำหนด action object
                         )
                      );              


                    $answer = DB::table('sequentsteps')
                     ->select('answer')
                     ->where('sender_id', $user)
                     ->first();
                    $answer = $answer->answer;

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0015','nextseqcode' => '0016']);
                    $users_register = DB::table('users_register')
                       ->where('user_id', $user)
                       ->update(['user_weight' => $answer ]);

    
     }elseif ($userMessage == 'ครั้งสุดท้ายที่มีประจำเดือน' && $seqcode->seqcode == '0015' ) {
                    $textReplyMessage = 'ขอทราบครั้งสุดท้ายที่คุณมีประจำเดือนเพื่อคำนวณอายุครรภ์ค่ะ (กรุณาตอบวันที่และเดือนเป็นตัวเลขนะคะ เช่น 17 04 คือ วันที่ 17 เมษายน)';
                    $replyData = new TextMessageBuilder($textReplyMessage);

                    $answer = DB::table('sequentsteps')
                     ->select('answer')
                     ->where('sender_id', $user)
                     ->first();
                    $answer = $answer->answer;

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'1015','nextseqcode' => '0017']);
                    // $users_register = DB::table('users_register')
                    //    ->where('user_id', $user)
                    //    ->update(['user_Pre_weight' => $answer ]);

     }elseif ($userMessage == 'กำหนดการคลอด' && $seqcode->seqcode == '0015' ) {
                    $textReplyMessage = 'ขอทราบกำหนดการคลอดของคุณหน่อยค่ะ (กรุณาตอบวันที่และเดือนเป็นตัวเลขนะคะ เช่น 17 04 คือ วันที่ 17 เมษายน)';
                    $replyData = new TextMessageBuilder($textReplyMessage);

                    $answer = DB::table('sequentsteps')
                     ->select('answer')
                     ->where('sender_id', $user)
                     ->first();
                    $answer = $answer->answer;

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'2015','nextseqcode' => '0017']);
                    // $users_register = DB::table('users_register')
                    //    ->where('user_id', $user)
                    //    ->update(['user_Pre_weight' => $answer ]);

    
    }elseif (strlen($userMessage) == 5  && $seqcode->seqcode == '1015') {
                    //   $textReplyMessage = 'cc';
                    // $replyData = new TextMessageBuilder($textReplyMessage);

        $pieces = explode(" ", $userMessage);
        $date   = str_replace("","",$pieces[0]);
        $month  = str_replace("","",$pieces[1]);
            $today_years= date("Y") ;
            $today_month= date("m") ;
            $today_day  = date("d") ;
          
            if(($month>$today_month&& $month<=12 && $date<=31) || ($month==$today_month && $date>$today_day)  ){
                $years = $today_years-1;
                $strDate1 = $years."-".$month."-".$date;
                $strDate2=date("Y-m-d");
                
                $date_pre =  (strtotime($strDate2) - strtotime($strDate1))/( 60 * 60 * 24 );
                $week = $date_pre/7;
                $week_preg = number_format($week);
                $day = $date_pre%7;
                $day_preg = number_format($day);
                // $age_pre = 'คุณมีอายุครรภ์'. $week_preg .'สัปดาห์'.  $day_preg .'วัน' ;
                      $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( 'คุณมีอายุครรภ์'. $week_preg .'สัปดาห์'.  $day_preg .'วัน' ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'อายุครรภ์ถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    );  
                   
                    DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'1015','answer' => $week_preg ,'nextseqcode' => '0018']);
                   

            }elseif($month<$today_month && $month<=12 && $date<=31){
                $strDate1 = $today_years."-".$month."-".$date;
                $strDate2=date("Y-m-d");
                $date_pre =  (strtotime($strDate2) - strtotime($strDate1))/( 60 * 60 * 24 );;
                $week = $date_pre/7;
                $week_preg = number_format($week);
                $day = $date_pre%7;
                $day_preg = number_format($day);
                // $age_pre = 'คุณมีอายุครรภ์'. $week_preg .'สัปดาห์'.  $day_preg .'วัน' ;

                     $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( 'คุณมีอายุครรภ์'. $week_preg .'สัปดาห์'.  $day_preg .'วัน' ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'อายุครรภ์ถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    );  
                    
                    DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'1015','answer' =>$week_preg ,'nextseqcode' => '0018']);
                   
            }else{

                $textReplyMessage = 'ดูเหมือนคุณจะพิมพ์ไม่ถูกต้อง';
                $replyData = new TextMessageBuilder($textReplyMessage);
              
            }
  

    }elseif (strlen($userMessage) == 5  && $seqcode->seqcode == '2015') {
              
                 $pieces = explode(" ", $userMessage);
                 $date   = str_replace("","",$pieces[0]);
                 $month  = str_replace("","",$pieces[1]);
                 $today_years= date("Y") ;
                 $today_month= date("m") ;
                 $today_day  = date("d") ;


                 if( $month < $today_month && $month<=12 && $date<=31){
                 $years = $today_years+1;
                 $strDate1 = $years."-".$month."-".$date;
                 $strDate2=date("Y-m-d");
                
                 $date_pre =  (strtotime($strDate1) - strtotime($strDate2))/( 60 * 60 * 24 );
                 $week = $date_pre/7;
                 $week_preg =floor($week);
                 $day = $date_pre%7;
                 $day_preg = number_format($day);
                 $m = 39-$week_preg  ;
                 $d = 7-$day_preg;

                

                 switch ($d){
                 case '7':
                  $w_preg = $m + 1;
                  $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( 'คุณมีอายุครรภ์'.  $w_preg  .'สัปดาห์' ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'อายุครรภ์ถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    );  
                  DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'2015','answer' =>$w_preg ,'nextseqcode' => '0018']);
                  break;
                 default:
                  $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( 'คุณมีอายุครรภ์'. $m .'สัปดาห์'.  $d .'วัน' ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'อายุครรภ์ถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    );  
                  DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'2015','answer' =>$m ,'nextseqcode' => '0018']);
                  break;
                  }

                 }elseif($month > $today_month && $month<=12 && $date<=31){
                 $years = $today_years;
                 $strDate1 = $years."-".$month."-".$date;
                 $strDate2=date("Y-m-d");
                
                 $date_pre =  (strtotime($strDate1) - strtotime($strDate2))/( 60 * 60 * 24 );
                 $week = $date_pre/7;
                 $week_preg =floor($week);
                 $day = $date_pre%7;
                 $day_preg = number_format($day);
                 $m = 39-$week_preg  ;
                 $d = 7-$day_preg;
              
                  switch ($d){
                 case '7':
                  $w_preg = $m + 1;
                  $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( 'คุณมีอายุครรภ์'.  $w_preg  .'สัปดาห์' ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'อายุครรภ์ถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    ); 
                     DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'2015','answer' =>$w_preg ,'nextseqcode' => '0018']);
 
                  break;
                 default:
                  $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( 'คุณมีอายุครรภ์'. $m .'สัปดาห์'.  $d .'วัน' ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'อายุครรภ์ถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    );  
                   DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'2015','answer' =>$m ,'nextseqcode' => '0018']);

                  break;
                  }

                 }
               

    }elseif ($userMessage == 'อายุครรภ์ถูกต้อง' && $seqcode->seqcode == '1015' ||  $seqcode->seqcode == '2015' ) {
                    $textReplyMessage = 'ขอทราบเบอร์โทรศัพท์ของคุณหน่อยค่ะ';
                    $replyData = new TextMessageBuilder($textReplyMessage);

                    $answer = DB::table('sequentsteps')
                     ->select('answer')
                     ->where('sender_id', $user)
                     ->first();
                    $answer = $answer->answer;

                    $weight = DB::table('users_register')
                     ->select('user_weight')
                     ->where('user_id', $user)
                     ->first();
                    $user_weight = $weight->user_weight;

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0018','nextseqcode' => '0019']);
                    $users_register = DB::table('users_register')
                       ->where('user_id', $user)
                       ->update(['preg_week' => $answer ]);

                    $recordofpregnancy = DB::table('RecordOfPregnancy')->insert(['user_id'=>$user, 'preg_week'=>$answer, 'preg_weight'=> $user_weight  , 'updated_at'=>NOW()]);

    }elseif (strlen($userMessage) == 10  && $seqcode->seqcode == '0018') {

                   $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( 'เบอร์โทรศัพท์ของคุณคือ'.$userMessage.'ใช่ไหมคะ',
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'เบอร์โทรศัพท์ถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    );

                    DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0018','answer' => $userMessage ,'nextseqcode' => '0020']);
    }elseif($userMessage == 'เบอร์โทรศัพท์ถูกต้อง' && $seqcode->seqcode == '0018' ) {
                    $textReplyMessage = 'ขอทราบ E-mail ของคุณหน่อยค่ะ';
                    $replyData = new TextMessageBuilder($textReplyMessage);

                    $answer = DB::table('sequentsteps')
                     ->select('answer')
                     ->where('sender_id', $user)
                     ->first();
                    $answer = $answer->answer;

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0020','nextseqcode' => '0021']);
                    $users_register = DB::table('users_register')
                       ->where('user_id', $user)
                       ->update(['phone_number' => $answer ]);

    }elseif($userMessage == 'อีเมลถูกต้อง' && $seqcode->seqcode == '0020' ) {

                    $textReplyMessage = 'ขอทราบชื่อโรงพยาบาลที่คุณแม่ไปฝากครรภ์หน่อยค่ะ';
                    $replyData = new TextMessageBuilder($textReplyMessage);

                    $answer = DB::table('sequentsteps')
                     ->select('answer')
                     ->where('sender_id', $user)
                     ->first();
                    $answer = $answer->answer;

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0022','nextseqcode' => '0023']);
                    $users_register = DB::table('users_register')
                       ->where('user_id', $user)
                       ->update(['email' => $answer ]);

   
    }elseif (is_string($userMessage) !== false && $seqcode->seqcode == '0020') {

                   $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( 'Emailของคุณคือ'.$userMessage.'ใช่ไหมคะ',
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'อีเมลถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    );

                    DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0020','answer' => $userMessage ,'nextseqcode' => '0022']);
    }elseif($userMessage == 'ชื่อโรงพยาบาลถูกต้อง' && $seqcode->seqcode == '0022' ) {
                    $textReplyMessage = 'ขอทราบเลขประจำตัวผู้ป่วยของคุณหน่อยค่ะ';
                    $replyData = new TextMessageBuilder($textReplyMessage);

                    $answer = DB::table('sequentsteps')
                     ->select('answer')
                     ->where('sender_id', $user)
                     ->first();
                    $answer = $answer->answer;

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0024','nextseqcode' => '0025']);
                    $users_register = DB::table('users_register')
                       ->where('user_id', $user)
                       ->update(['hospital_name' => $answer ]);

     
    }elseif (is_string($userMessage) !== false && $seqcode->seqcode == '0022') {

                   $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( 'ชื่อโรงพยาบาลที่คุณแม่ไปฝากครรภ์คือ'.$userMessage.'ใช่ไหมคะ',
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'ชื่อโรงพยาบาลถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    );

                    DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0022','answer' => $userMessage ,'nextseqcode' => '0024']);
    }elseif($userMessage == 'เลขประจำตัวผู้ป่วยของถูกต้อง' && $seqcode->seqcode == '0024' ) {
                     $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( "คุณมีประวัติการแพ้ยาไหมคะ?",
                                array(
                                    new MessageTemplateActionBuilder(
                                        'มี',
                                        'แพ้ยา'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่มี',
                                        'ไม่แพ้ยา'
                                    )
                                )
                        )
                    );
                    $answer = DB::table('sequentsteps')
                     ->select('answer')
                     ->where('sender_id', $user)
                     ->first();
                    $answer = $answer->answer;

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'1024','nextseqcode' => '0027']);
                    $users_register = DB::table('users_register')
                       ->where('user_id', $user)
                       ->update(['hospital_number' => $answer ]);

    
    
    }elseif (is_string($userMessage) !== false && $seqcode->seqcode == '0024') {

                   $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( 'เลขประจำตัวผู้ป่วยของคุณคือ'.$userMessage.'ใช่ไหมคะ',
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'เลขประจำตัวผู้ป่วยของถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    );

                    DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0024','answer' => $userMessage ,'nextseqcode' => '0027']);
    
    }elseif($userMessage == 'แพ้ยา' && $seqcode->seqcode == '1024' ) {
                    $textReplyMessage = 'คุณแพ้ยาอะไรคะ?';
                    $replyData = new TextMessageBuilder($textReplyMessage);

                    // $answer = DB::table('sequentsteps')
                    //  ->select('answer')
                    //  ->where('sender_id', $user)
                    //  ->first();
                    // $answer = $answer->answer;

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'2024','nextseqcode' => '0025']);
                    // $users_register = DB::table('users_register')
                    //    ->where('user_id', $user)
                    //    ->update(['history_medicine' => $answer ]);

    }elseif (is_string($userMessage) !== false && $seqcode->seqcode == '2024' ) {

                    $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( "คุณมีประวัติการแพ้อาหารไหมคะ?",
                                array(
                                    new MessageTemplateActionBuilder(
                                        'มี',
                                        'แพ้อาหาร'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่มี',
                                        'ไม่แพ้อาหาร'
                                    )
                                )
                        )
                    );
                    // $answer = DB::table('sequentsteps')
                    //  ->select('answer')
                    //  ->where('sender_id', $user)
                    //  ->first();
                    // $answer = $answer->answer;

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0027','nextseqcode' => '0028']);
                    $users_register = DB::table('users_register')
                       ->where('user_id', $user)
                       ->update(['history_medicine' => $userMessage]);

                   
    }elseif($userMessage == 'แพ้อาหาร' && $seqcode->seqcode == '0027' ) {
                    $textReplyMessage = 'คุณแพ้แพ้อาหารอะไรคะ?';
                    $replyData = new TextMessageBuilder($textReplyMessage);

                    // $answer = DB::table('sequentsteps')
                    //  ->select('answer')
                    //  ->where('sender_id', $user)
                    //  ->first();
                    // $answer = $answer->answer;

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'1027','nextseqcode' => '0028']);
                    // $users_register = DB::table('users_register')
                    //    ->where('user_id', $user)
                    //    ->update(['history_medicine' => $answer ]);


     }elseif($userMessage == 'ไม่แพ้ยา'){
    
                    $replyData = new TemplateMessageBuilder('Confirm Template', new ConfirmTemplateBuilder( "คุณมีประวัติการแพ้อาหารไหมคะ?",
                                array(
                                    new MessageTemplateActionBuilder(
                                        'มี',
                                        'แพ้อาหาร'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่มี',
                                        'ไม่แพ้อาหาร'
                                    )
                                )
                        )
                    );
                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0027','nextseqcode' => '0028']);
                    $users_register = DB::table('users_register')
                       ->where('user_id', $user)
                       ->update(['history_medicine' => $userMessage]);


    }elseif (is_string($userMessage) !== false && $seqcode->seqcode == '1027' ) {

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0028','nextseqcode' => '0029']);
                    $users_register = DB::table('users_register')
                       ->where('user_id', $user)
                       ->update(['history_food' => $userMessage]);
        
                  $textReplyMessage = "ช่วงระหว่างการตั้งครรภ์คุณออกกำลังกายในระดับไหน?";
                  $textMessage1 = new TextMessageBuilder($textReplyMessage);
                  $textReplyMessage = "รายละเอียดของระดับ". "\n".
                "เบา -  วิถีชีวิตทั่วไป ไม่มีการออกกำลังกาย หรือมีการออกกำลังกายน้อย". "\n".
                "ปานกลาง - วิถีชีวิตกระฉับกระเฉง หรือ มีการออกกำลังกายสม่ำเสมอ". "\n".
                "หนัก - วิถีชีวิตมีการใช้แรงงานหนัก ออกกำลังกายหนักเป็นประจำ". "\n";
                  $textMessage2 = new TextMessageBuilder($textReplyMessage);
                  $actionBuilder = array(
                                          new MessageTemplateActionBuilder(
                                          'เบา',// ข้อความแสดงในปุ่ม
                                          'เบา' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                          ),
                                           new MessageTemplateActionBuilder(
                                          'ปานกลาง',// ข้อความแสดงในปุ่ม
                                          'ปานกลาง' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                          ),
                                           new MessageTemplateActionBuilder(
                                          'หนัก',// ข้อความแสดงในปุ่ม
                                          'หนัก' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                          ) 
                                         );

                     $imageUrl = 'https://www.mywebsite.com/imgsrc/photos/w/simpleflower';
                    $textMessage3 = new TemplateMessageBuilder('Button Template',
                     new ButtonTemplateBuilder(
                              'ระดับของการออกกำลังกาย', // กำหนดหัวเรื่อง
                              'เลือกระดับด้านล่างได้เลยค่ะ', // กำหนดรายละเอียด
                               $imageUrl, // กำหนด url รุปภาพ
                               $actionBuilder  // กำหนด action object
                         )
                      );                            

                  $multiMessage =     new MultiMessageBuilder;
                  $multiMessage->add($textMessage1);
                  $multiMessage->add($textMessage2);
                  $multiMessage->add($textMessage3);
                  $replyData = $multiMessage; 
            


    
   }elseif($userMessage == 'ไม่แพ้อาหาร' ){
                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0027','nextseqcode' => '0028']);
                    $users_register = DB::table('users_register')
                       ->where('user_id', $user)
                       ->update(['history_food' => $userMessage]);

                    $sequentsteps = DB::table('sequentsteps')
                       ->where('sender_id', $user)
                       ->update(['seqcode' =>'0028','nextseqcode' => '0029']);
                    $users_register = DB::table('users_register')
                       ->where('user_id', $user)
                       ->update(['history_food' => $userMessage]);
        
                  $textReplyMessage = "ช่วงระหว่างการตั้งครรภ์คุณออกกำลังกายในระดับไหน?";
                  $textMessage1 = new TextMessageBuilder($textReplyMessage);
                  $textReplyMessage = "รายละเอียดของระดับ". "\n".
                "เบา -  วิถีชีวิตทั่วไป ไม่มีการออกกำลังกาย หรือมีการออกกำลังกายน้อย". "\n".
                "ปานกลาง - วิถีชีวิตกระฉับกระเฉง หรือ มีการออกกำลังกายสม่ำเสมอ". "\n".
                "หนัก - วิถีชีวิตมีการใช้แรงงานหนัก ออกกำลังกายหนักเป็นประจำ". "\n";
                  $textMessage2 = new TextMessageBuilder($textReplyMessage);
                  $actionBuilder = array(
                                          new MessageTemplateActionBuilder(
                                          'เบา',// ข้อความแสดงในปุ่ม
                                          'เบา' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                          ),
                                           new MessageTemplateActionBuilder(
                                          'ปานกลาง',// ข้อความแสดงในปุ่ม
                                          'ปานกลาง' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                          ),
                                           new MessageTemplateActionBuilder(
                                          'หนัก',// ข้อความแสดงในปุ่ม
                                          'หนัก' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                          ) 
                                         );

                     $imageUrl = 'https://www.mywebsite.com/imgsrc/photos/w/simpleflower';
                    $textMessage3 = new TemplateMessageBuilder('Button Template',
                     new ButtonTemplateBuilder(
                              'ระดับของการออกกำลังกาย', // กำหนดหัวเรื่อง
                              'เลือกระดับด้านล่างได้เลยค่ะ', // กำหนดรายละเอียด
                               $imageUrl, // กำหนด url รุปภาพ
                               $actionBuilder  // กำหนด action object
                         )
                      );                            

                  $multiMessage =     new MultiMessageBuilder;
                  $multiMessage->add($textMessage1);
                  $multiMessage->add($textMessage2);
                  $multiMessage->add($textMessage3);
                  $replyData = $multiMessage; 
            
   }elseif($userMessage == 'เบา' || $userMessage == 'หนัก'  ||$userMessage == 'ปานกลาง' ){
   
                $users = DB::table('users_register')
                     ->select('user_weight','user_height','preg_week','user_age')
                     ->where('user_id', $user)
                     ->first();
                $user_weight = $users->user_weight;
                $user_height = $users->user_height;             
                $preg_week   = $users->preg_week;
                $user_age    = $users->user_age;


                $height = $user_height*0.01;
                $bmi = $user_weight/($height*$height);
                $bmi = number_format($bmi, 2, '.', '');
                    if ($bmi<18.5) {
                      $result="Underweight";
                    } elseif ($bmi>=18.5 && $bmi<24.9) {
                      $result="Nomal weight";
                    } elseif ($bmi>=24.9 && $bmi<=29.9) {
                      $result="Overweight";
                    }else{
                      $result="Obese";
                    }


       if ( $user_age>=10 && $user_age<18) {
          $cal=(13.384*$user_weight )+692.6;
        }elseif ($user_age>18 && $user_age<31) {
          $cal=(14.818*$user_weight )+486.6;
        }else{
          $cal=(8.126*$user_weight )+845.6;
        }


        if ($userMessage=='หนัก'  ) {
          $total = $cal*2.0;
          $num = 3;
        }elseif($userMessage=='ปานกลาง') {
          $total = $cal*1.7;
           $num = 2;
        }else{
          $total = $cal*1.4;
           $num = 1;
        }

        $format = number_format($total);


                if ($bmi>=24.9 ) {
                  $actionBuilder = array(
                        new UriTemplateActionBuilder(
                            'กราฟ', // ข้อความแสดงในปุ่ม
                            'https://peat.none.codes/'
                        ),
                        new MessageTemplateActionBuilder(
                            'ทารกในครรภ์',// ข้อความแสดงในปุ่ม
                            'ทารกในครรภ์' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                        ), 
                    );
                    $imageUrl = 'https://peat.none.codes/week/'.$preg_week.'.jpg';
                    $textMessage1 = new TemplateMessageBuilder('Button Template',
                        new ButtonTemplateBuilder(
                                'ขณะนี้คุณมีอายุครรภ์'.$preg_week.'สัปดาห์', // กำหนดหัวเรื่อง
                                'ค่าดัชนีมวลกายของคุณคือ'.$bmi.'อยู่ในเกณฑ์'. $result, // กำหนดรายละเอียด
                                $imageUrl, // กำหนด url รุปภาพ
                                $actionBuilder  // กำหนด action object
                        )
                    );   

                $textReplyMessage = 'น้ำหนักของคุณเกินเกณฑ์ ลองปรับการรับประทานอาหารหรือออกกำลังกายดูไหมคะ'."\n".
                       'หากคุณแม่ไม่ทราบว่าจะทานอะไรดีหรือออกกำลังกายแบบไหนดีสามารถกดที่เมนูกิจกรรมด้านล่างได้เลยนะคะ';
                $textMessage2 = new TextMessageBuilder($textReplyMessage); 

               
            
                }else{
                    $actionBuilder = array(
                        new UriTemplateActionBuilder(
                            'กราฟ', // ข้อความแสดงในปุ่ม
                            'https://peat.none.codes/'
                        ),
                        new MessageTemplateActionBuilder(
                            'ทารกในครรภ์',// ข้อความแสดงในปุ่ม
                            'ทารกในครรภ์' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                        ), 
                    );
                    $imageUrl = 'https://peat.none.codes/week/'.$preg_week.'.jpg';
                    $textMessage1 = new TemplateMessageBuilder('Button Template',
                        new ButtonTemplateBuilder(
                                'ขณะนี้คุณมีอายุครรภ์'.$preg_week.'สัปดาห์', // กำหนดหัวเรื่อง
                                'ค่าดัชนีมวลกายของคุณคือ'.$bmi.'อยู่ในเกณฑ์'. $result, // กำหนดรายละเอียด
                                $imageUrl, // กำหนด url รุปภาพ
                                $actionBuilder  // กำหนด action object
                        )
                    );   

   $textReplyMessage = 'หากคุณแม่ไม่ทราบว่าจะทานอะไรดีหรือออกกำลังกายแบบไหนดีสามารถกดที่เมนูกิจกรรมด้านล่างได้เลยนะคะ';
                $textMessage2 = new TextMessageBuilder($textReplyMessage); 
                }
             
    if ($preg_week >=13 && $preg_week<=40) {
                  $a = $total+300;
                  $format2 = number_format($a);  

                   $actionBuilder = array(
                        new UriTemplateActionBuilder(
                            'ไปยังลิงค์', // ข้อความแสดงในปุ่ม
                            'http://www.raipoong.com/content/detail.php?section=12&category=26&id=467'
                        ),
                        new MessageTemplateActionBuilder(
                            'ข้อมูลโภชนาการ',// ข้อความแสดงในปุ่ม
                            'ข้อมูลโภชนาการ' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                        ), 
                    );
                    $imageUrl = 'https://www.mywebsite.com/imgsrc/photos/w/simpleflower';
                    $textMessage3 = new TemplateMessageBuilder('Button Template',
                        new ButtonTemplateBuilder(
                                'จำนวนแคลอรี่ที่คุณต้องการต่อวันคือ '.$format2, // กำหนดหัวเรื่อง
                                'รายละเอียดการรับประทานอาหารสามารถกดปุ่มด้านล่างได้เลยค่ะ'. $result, // กำหนดรายละเอียด
                                $imageUrl, // กำหนด url รุปภาพ
                                $actionBuilder  // กำหนด action object
                        )
                    );   


    }else{

                $actionBuilder = array(
                        new UriTemplateActionBuilder(
                            'ไปยังลิงค์', // ข้อความแสดงในปุ่ม
                            'http://www.raipoong.com/content/detail.php?section=12&category=26&id=467'
                        ),
                        new MessageTemplateActionBuilder(
                            'Nutrition',// ข้อความแสดงในปุ่ม
                            'Nutrition' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                        ), 
                    );
                    $imageUrl = 'https://www.mywebsite.com/imgsrc/photos/w/simpleflower';
                    $textMessage3 = new TemplateMessageBuilder('Button Template',
                        new ButtonTemplateBuilder(
                                'จำนวนแคลอรี่ที่คุณต้องการต่อวันคือ '.$format, // กำหนดหัวเรื่อง
                                'รายละเอียดการรับประทานอาหารสามารถกดปุ่มด้านล่างได้เลยค่ะ'.$result, // กำหนดรายละเอียด
                                $imageUrl, // กำหนด url รุปภาพ
                                $actionBuilder  // กำหนด action object
                        )
                    );   
    }  

    $ReplyMessage = new TextMessageBuilder($textReplyMessage); 
                  $multiMessage = new MultiMessageBuilder;
                  $multiMessage->add($textMessage1);
                  $multiMessage->add($textMessage3);
                  $multiMessage->add($textMessage2);
                  $replyData = $multiMessage; 

   $users_register = DB::table('users_register')
                       ->where('user_id', $user)
                       ->update(['active_lifestyle' => $num]);

      
}elseif($userMessage == 'ทารกในครรภ์'){

        $users = DB::table('users_register')
                     ->select('preg_week')
                     ->where('user_id', $user)
                     ->first();

        $preg_week   = $users->preg_week; 

        $pregnants = DB::table('pregnants')
                     ->select('descript')
                     ->where('week', $preg_week)
                     ->first();

        $descript = $pregnants->descript;
        $replyData = new TextMessageBuilder($descript);

}elseif($userMessage == 'ข้อมูลโภชนาการ'){

                $users = DB::table('users_register')
                     ->select('user_weight','user_height','preg_week','user_age','active_lifestyle')
                     ->where('user_id', $user)
                     ->first();
                $user_weight = $users->user_weight;
                $user_height = $users->user_height;             
                $preg_week   = $users->preg_week;
                $user_age    = $users->user_age;
                $active_lifestyle = $users->active_lifestyle;

  if ( $user_age>=10 && $user_age<18) {
          $cal=(13.384*$user_weight )+692.6;
        }elseif ($user_age>18 && $user_age<31) {
          $cal=(14.818*$user_weight )+486.6;
        }else{
          $cal=(8.126*$user_weight )+845.6;
        }


        if ($active_lifestyle == '3' ) {
          $total = $cal*2.0;

        }elseif($active_lifestyle == '2') {
          $total = $cal*1.7;
      
        }else{
          $total = $cal*1.4;
  
        }

        // $format = number_format($total);

       if ($preg_week >=13 && $preg_week<=40) {
                $format = $total+300;
               // $format = number_format($semester);
       }else{
               $format = $total;
       }

        // $meal_planing = DB::table('meal_planing')
        //              ->select('starches' ,'vegetables', 'fruits', 'meats', 'fats', 'lf_milk', 'c', 'p', 'f', 'g_protein')
        //              ->where('caloric_level','<=', $total)
        //              ->first();

        //         $starches    = $meal_planing->starches;
        //         $vegetables  = $meal_planing->vegetables;
        //         $fruits      = $meal_planing->fruits;
        //         $meats       = $meal_planing->meats;
        //         $fats        = $meal_planing->fats;
        //         $lf_milk     = $meal_planing->lf_milk;
        //         $c           = $meal_planing->c;
        //         $p           = $meal_planing->p;
        //         $f           = $meal_planing->f;
        //         $g_protein   = $meal_planing->g_protein;

            // $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
            //               '-ข้าววันละ'. $starches .'ทัพพี'. "\n".
            //               '-ผักวันละ'. $vegetables. 'ทัพพี'."\n".
            //               '-ผลไม้วันละ'.$fruits.'ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
            //               '-เนื้อวันละ'.$meats. 'ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
            //               '-ไขมันวันละ' .$fats. 'ช้อนชา'."\n".
            //               '-นมไขมันต่ำวันละ' .$lf_milk. 'แก้ว';

             // if ($total < 1601) {
             //      $aaa=$Nutrition;
             //    } elseif ($total > 1600 && $total<1701) {
             //      $aaa=$Nutrition;
             //    }elseif ($total >1700 && $total<1801) {
             //      $aaa=$Nutrition;
             //    }elseif ($total >1800 && $total<1901) {
             //     $aaa=$Nutrition;
             //    }elseif ($total >1900 && $total<2001) {
             //      $aaa=$Nutrition;
             //    }elseif ($total >2000 && $total<2101 ) {
             //      $aaa=$Nutrition;
             //    }elseif ($total > 2100 && $total<2201) {
             //      $aaa=$Nutrition;
             //    }elseif ($total > 2200 && $total <2301) {
             //      $aaa=$Nutrition;
             //    }elseif ($total > 2300 && $total <2401) {
             //      $aaa=$Nutrition;
             //    }elseif ($total > 2400 && $total <2501) {
             //     $aaa=$Nutrition;
             //    }else {
             //      $aaa=$Nutrition;
             //    }

                if ($format < 1601) {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '-ข้าววันละ 8 ทัพพี'. "\n".
                                      '-ผักวันละ 3 ทัพพี'."\n".
                                      '-ผลไม้วันละ 2 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '-เนื้อวันละ 5 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '-ไขมันวันละ 6 ช้อนชา'."\n".
                                      '-นมไขมันต่ำวันละ 2 แก้ว';
                } elseif ($format > 1600 && $format <1701) {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '-ข้าววันละ 9 ทัพพี'. "\n".
                                      '-ผักวันละ 3 ทัพพี'."\n".
                                      '-ผลไม้วันละ 2 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '-เนื้อวันละ 5 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '-ไขมันวันละ 6 ช้อนชา'."\n".
                                      '-นมไขมันต่ำวันละ 2 แก้ว';
                }elseif ($format >1700 && $format <1801) {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '-ข้าววันละ 9 ทัพพี'. "\n".
                                      '-ผักวันละ 3 ทัพพี'."\n".
                                      '-ผลไม้วันละ 3 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '-เนื้อวันละ 6 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '-ไขมันวันละ 6 ช้อนชา'."\n".
                                      '-นมไขมันต่ำวันละ 2 แก้ว';
                }elseif ($format >1800 && $format<1901) {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '-ข้าววันละ 9 ทัพพี'. "\n".
                                      '-ผักวันละ 3 ทัพพี'."\n".
                                      '-ผลไม้วันละ 3 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '-เนื้อวันละ 6 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '-ไขมันวันละ 8 ช้อนชา'."\n".
                                      '-นมไขมันต่ำวันละ 2 แก้ว';
                }elseif ($format >1900 && $format<2001) {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '-ข้าววันละ 10 ทัพพี'. "\n".
                                      '-ผักวันละ 3 ทัพพี'."\n".
                                      '-ผลไม้วันละ 3 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '-เนื้อวันละ 7 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '-ไขมันวันละ 8 ช้อนชา'."\n".
                                      '-นมไขมันต่ำวันละ 2 แก้ว';
                }elseif ($format >2000 && $format<2101 ) {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '-ข้าววันละ 11 ทัพพี'. "\n".
                                      '-ผักวันละ 3 ทัพพี'."\n".
                                      '-ผลไม้วันละ 3 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '-เนื้อวันละ 7 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '-ไขมันวันละ 8 ช้อนชา'."\n".
                                      '-นมไขมันต่ำวันละ 2 แก้ว';
                }elseif ($format > 2100 && $format<2201) {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '-ข้าววันละ 11 ทัพพี'. "\n".
                                      '-ผักวันละ 3 ทัพพี'."\n".
                                      '-ผลไม้วันละ 3 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '-เนื้อวันละ 7 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '-ไขมันวันละ 8 ช้อนชา'."\n".
                                      '-นมไขมันต่ำวันละ 3 แก้ว';
                }elseif ($format > 2200 && $format < 2301) {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '-ข้าววันละ 11 ทัพพี'. "\n".
                                      '-ผักวันละ 3 ทัพพี'."\n".
                                      '-ผลไม้วันละ 3 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '-เนื้อวันละ 7 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '-ไขมันวันละ 9 ช้อนชา'."\n".
                                      '-นมไขมันต่ำวันละ 3 แก้ว';
                }elseif ($format > 2300 && $format <2401) {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '-ข้าววันละ 12 ทัพพี'. "\n".
                                      '-ผักวันละ 3 ทัพพี'."\n".
                                      '-ผลไม้วันละ 3 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '-เนื้อวันละ 7 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '-ไขมันวันละ 10 ช้อนชา'."\n".
                                      '-นมไขมันต่ำวันละ 3 แก้ว';
                }elseif ($format > 2400 && $format <2501) {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '-ข้าววันละ 12 ทัพพี'. "\n".
                                      '-ผักวันละ 3 ทัพพี'."\n".
                                      '-ผลไม้วันละ 4 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '-เนื้อวันละ 8 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '-ไขมันวันละ 10 ช้อนชา'."\n".
                                      '-นมไขมันต่ำวันละ 3 แก้ว';
                }else {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '-ข้าววันละ 12 ทัพพี'. "\n".
                                      '-ผักวันละ 3 ทัพพี'."\n".
                                      '-ผลไม้วันละ 4 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '-เนื้อวันละ 9 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '-ไขมันวันละ 11 ช้อนชา'."\n".
                                      '-นมไขมันต่ำวันละ 3 แก้ว';
                }






                // $textReplyMessage = 'ดูเหมือนคุณจะพิมพ์ไม่ถูกต้อง';
                $replyData = new TextMessageBuilder($Nutrition);





            // $textReplyMessage = 'ดิฉันไม่เข้าใจค่ะ กรุณาพิมพ์ใหม่อีกครั้งนะคะ';
            // $textMessage1 = new TextMessageBuilder( $aaa );

            // $textReplyMessage = 'หากคุณแม่ไม่ทราบว่าจะทานอะไรดีสามารถกดที่เมนูกิจกรรมด้านล่างได้เลยนะคะ';
            // $textMessage2 = new TextMessageBuilder($textReplyMessage);
            //     $ReplyMessage = new TextMessageBuilder($textReplyMessage); 
            //       $multiMessage = new MultiMessageBuilder;
            //       $multiMessage->add($textMessage1);
            //       $multiMessage->add($textMessage2);
            //       $replyData = $multiMessage; 

}else{
         $textReplyMessage = 'ดิฉันไม่เข้าใจค่ะ กรุณาพิมพ์ใหม่อีกครั้งนะคะ';
         $replyData = new TextMessageBuilder($textReplyMessage);
                  
}
    $response = $bot->replyMessage($replyToken,$replyData);

}}}


