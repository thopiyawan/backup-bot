<?php
//database
$conn_string = "host=ec2-54-163-233-201.compute-1.amazonaws.com port=5432 dbname=dchdrsngrf50pd user=njppbbukwreesq password=c6b890bd6e0dccc4a5db3308869ba5e2735fe0e5df7a3f0de6f114cc24752e04";
$dbconn = pg_pconnect($conn_string);
//
$access_token = 'GKg1wAZ/gjMr6yh3dGmPjuq8HnkDQEZsOdPEfyur3h7JmjdT2JihbEBHL6S4BrLnHCuu0Cv2fSbvwv0/xZqYw+TEjmmqW2mjC5NB9BcVGguZq3CIHX+Vt+fvPcNwtcT2ER0LLVXSwhNN4aVJT0Q08QdB04t89/1O/w1cDnyilFU=';
// $content = file_get_contents('php://input');
// Parse JSON
// $events = json_decode($content, true);
// $curr_years = date("Y");
// $curr_y = ($curr_years+ 543);
// $_msg = $events['events'][0]['message']['text'];
// $user = $events['events'][0]['source']['userId'];
// $user_id = pg_escape_string($user);
$seqcode =[];
$s =[];
$check_q = pg_query($dbconn,"SELECT DISTINCT user_id FROM users WHERE status = 1   ");
            while ($row = pg_fetch_assoc($check_q)) {
                  $seqcode[] =  $row['user_id'];
                } 
                
array_push( $s,$seqcode);
print_r($s);
$arrlength = count($s);
for($x = 0; $x <= $arrlength ; $x++) {
       $userid = $s[0][$x];
       $user_id = pg_escape_string($userid);
       $check = pg_query($dbconn,"SELECT preg_week FROM recordofpregnancy WHERE user_id = '{$user_id}' order by updated_at desc limit 1 ");
            while ($row = pg_fetch_row($check)) {
                echo  $p_week =  $row[0]+1;
                } 
        if($p_week>=42){
           $messages1 = [
                        'type' => 'text',
                        'text' => 'ลูกของุณคลอดแล้ว~'
                     ];
                             $url = 'https://api.line.me/v2/bot/message/push';
             $data = [
              'to' => $userid ,
              'messages' => [$messages1],
             ];
             error_log(json_encode($data));
             $post = json_encode($data);
             $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
             $ch = curl_init($url);
             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
             curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
             curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
             $result = curl_exec($ch);
             curl_close($ch);
             echo $result . "\r\n";
        }else{
 
                $messages1 = [
                                'type' => 'text',
                                'text' => 'สัปดาห์นี้คุณมีอายุครรภ์'.$p_week.'สัปดาห์แล้วนะคะ'
                             ];
                $messages2 = [ 'type'=> 'image',
                               'originalContentUrl'=> 'https://bottest14.herokuapp.com/week/'.$p_week.'.jpg',
                               'previewImageUrl'=> 'https://bottest14.herokuapp.com/week/'.$p_week.'.jpg'
                             ];
              
                $des_preg = pg_query($dbconn,"SELECT  descript FROM pregnants WHERE  week = $p_week   ");
                      while ($row = pg_fetch_row($des_preg)) {
                          echo $des = $row[0];
         
                        } 
                $messages3 = [
                                'type' => 'text',
                                'text' =>  $des
                             ];
                $messages4 = [
                                'type' => 'text',
                                'text' => 'สัปดาห์นี้คุณแม่มีน้ำหนักเท่าไรแล้วคะ?'
                             ];
                $q = pg_exec($dbconn, "INSERT INTO sequentsteps(sender_id,seqcode,answer,nextseqcode,status,created_at,updated_at )VALUES('{$user_id}','0017','','0000','0',NOW(),NOW())") or die(pg_errormessage()); 
                // $q2 = pg_exec($dbconn, "INSERT INTO recordofpregnancy(user_id, preg_week, preg_weight,updated_at )VALUES('{$user_id}',$p_week,'0',  NOW()) ") or die(pg_errormessage());        
                     
                 $url = 'https://api.line.me/v2/bot/message/push';
                 $data = [
                  'to' => $userid ,
                  'messages' => [$messages1,$messages2,$messages3,$messages4],
                 ];
                 error_log(json_encode($data));
                 $post = json_encode($data);
                 $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
                 $ch = curl_init($url);
                 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                 curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                 $result = curl_exec($ch);
                 curl_close($ch);
                 echo $result . "\r\n";
        }
}
 
?>