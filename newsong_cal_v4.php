<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META name="viewport"  content="width=device-width, initial-scale=1">
<title>新曲計算結果</title>
<style>
html{
	font-family: "Microsoft soft","Times";
	line-height: 1.15;
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust: 100%;
	-ms-overflow-style: scrollbar;
	-webkit-tap-highlight-color: transparent;
	height : auto;
	padding : 0.2rem;
	background-color: steelblue ;
	
}

p {
	font-size: 2.5rem;
	position: relative;
	font-family :"Microsoft soft","Times";
	text-align: center;
	font-weight: normal;
	color : midnightblue;
	background-color : steelblue;
	height: 2.5rem;
	margin : .25rem;
	padding : .25rem;
	font-weight : bold;
	
}

h1{
	font-size: 2rem;
	position: relative;
	font-family :"Microsoft soft","Times";
	text-align: center;
	font-weight: normal;
	color : midnightblue;
	background-color : lightblue;
	height: 2rem;
	margin : .75rem;
	padding : .75rem;
	
}


@media only screen and (max-device-width: 600px) {
	
html{
	font-family: "Microsoft soft","Times";
	line-height: 1.15;
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust: 100%;
	-ms-overflow-style: scrollbar;
	height : auto;
	padding : 0.2rem;
	background-color: steelblue ;
	
}	

body {
    background-color: steelblue	;

}

p {
	font-size: 1.5rem;
	position: relative;
	font-family :"Microsoft soft","Times";
	text-align: center;
	font-weight: normal;
	color : midnightblue;
	background-color : steelblue;
	height: 1.5rem;
	margin : .25rem;
	padding : .25rem;
	font-weight : bold;
	
}


h1{
	font-size: 1rem;
	position: relative;
	font-family :"Microsoft soft","Times";
	text-align: center;
	font-weight: normal;
	color : midnightblue;
	background-color : lightblue;
	height: 1rem;
	margin : .25rem;
	padding : .25rem;
	
}




}
</style>


<body>

		



<?php 


echo "<p>洗牌or箱活碎鑽計算結果：</p>";

/*post*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {      
	$gift = $_POST['gift']; 
	$date_end = $_POST['date_end'];
	$time_end = $_POST['time_end'];
	$pt_now = $_POST['pt_now'];
	$pt_target = $_POST['pt_target']; 
	$score_normal = $_POST['score_normal']; 
	$score_event = $_POST['score_event']; 
	$bp_use = $_POST['bp_use']; 
	$pass_use = $_POST['pass_use'];  
	$add = $_POST['add'];  
	$level_now = $_POST['level_now']; 
	$exp_need = $_POST['exp_need']; 
	$bp_now = $_POST['bp_now'];
	$loudspeaker_now = $_POST['loudspeaker_now'];
	$whistle_now = $_POST['whistle_now'];
	$double_now = $_POST['double_now'];
	$work_now = $_POST['work_now']; 
	$pass_now = $_POST['pass_now'];
	$work_max = $_POST['work_max']; 
	$work_time = $_POST['work_time']; 
	$work_event = $_POST['work_event'];
	$bp_waste = $_POST['bp_waste'];
	$work_waste = $_POST['work_waste'];
	$stage_complete = $_POST['stage_complete'];
	$month_big = $_POST['month_big'];	
	$day_mission = $_POST['day_mission'];	
	$day_draw = $_POST['day_draw'];	
	$ability = $_POST['ability'];	
	
} 
	else if ($_SERVER['REQUEST_METHOD']=='GET') {	
		}

/*時間計算過程*/
$time_now = time();
//echo "現在時間:".$date_end." ".$time_end."<br>";
$event_end = $date_end.$time_end; 
//echo "結束時間文字:".$event_end."<br>";
$unix_end = strtotime($event_end);
//echo "結束時間unix時間:".$unix_end."<br>";
$taiwan_end = $unix_end-8*60*60;		/*8小時失蹤了(⊙o⊙)*/
//echo "時間轉換（台灣時區）:".$taiwan_end."<br>";
$minute_total = ($taiwan_end-$time_now)/60;


if ( $minute_total > 202*60){
	$minute_total = 202*60;
}else{
	$minute_total = $minute_total;
}

$hour_left = floor($minute_total/60);
$minute_left = floor($minute_total%60);
echo "<h1>活動剩餘時間：".$hour_left."小時".$minute_left."分鐘</h1>";

/*剩餘天數*/
$day_left  = ceil(($minute_total-60*22)/(60*24));
//echo "剩餘".$day_left."天<br>";

/*自回bp&work計算*/
$bp_recovory = floor($minute_total/30-($bp_waste*$day_left));
$work_recovory = floor($minute_total/$work_time)-($work_waste*$day_left);
//echo "自回bp數：".$bp_recovory."<br>";
//echo "自回work數：".$work_recovory."<br>";

$work_pt = 0;
if ($work_event == 1 ){
	$work_pt = 375;
}else{
	$work_pt = 250;
}

 

/*道具*/
/*大月卡*/
if ($month_big == 1 ){
	$whistle_package = $day_left*5;
	$double_package = $day_left*5;
}
else{
	$whistle_package = 0;
	$double_package = 0;
}
//echo "未領大月哨子數：".$whistle_package."哨子<br>";
//echo "未領大月翻倍數：".$double_package."翻倍<br>";

/*whitstle_pt*/
if ($pt_target < 6000) {
    $whitstle_pt = 0 ;
}
else if ($pt_target < 40000){
    $whitstle_pt = 3;
}
else if ($pt_target < 90000){
	$whitstle_pt = 6;
}
else if ($pt_target < 140000){
    $whitstle_pt = 9;
}
else if ($pt_target < 260000){
    $whitstle_pt = 12;
}
else if ($pt_target < 360000){
    $whitstle_pt = 15;
}
else if ($pt_target < 420000){
	$whitstle_pt = 20;
}
else if ($pt_target < 540000){
    $whitstle_pt = 25;
}
else {    
	$whitstle_pt = 30;
}

if ($pt_now < 6000) {
    $whitstle_pt = $whitstle_pt - 0 ;
}
else if ($pt_now < 40000){
    $whitstle_pt = $whitstle_pt - 3 ;
}
else if ($pt_now < 90000){
	$whitstle_pt = $whitstle_pt - 6 ;
}
else if ($pt_now < 140000){
    $whitstle_pt = $whitstle_pt - 9;
}
else if ($pt_now < 260000){
    $whitstle_pt = $whitstle_pt - 12;
}
else if ($pt_now < 360000){
    $whitstle_pt = $whitstle_pt - 15;
}
else if ($pt_now < 420000){
	$whitstle_pt = $whitstle_pt - 20;
}
else if ($pt_now < 540000){
    $whitstle_pt = $whitstle_pt - 25;
}
else {    
	$whitstle_pt = $whitstle_pt - 30;
}
//echo "pt獎勵哨子：".$whitstle_pt."<br>";


/*$day_draw*/
if($day_draw == 1){
	$whitstle_draw = $day_left*3;
}
else{
	$whitstle_draw = 0;
}
//echo "未領每日付費抽卡送哨：".$whitstle_draw."<br>";


/*loudspeaker_pt*/
if ($pt_target < 1050000){
	$loudspeaker_pt = 0;
}
else if ($pt_target < 2550000){
    $loudspeaker_pt = 1;
}
else if ($pt_target < 3000000){
    $loudspeaker_pt = 2;
}
else{
	$loudspeaker_pt = 3;
}

if ($pt_now < 1050000){
	$loudspeaker_pt = $loudspeaker_pt - 0;
}
else if ($pt_now < 2550000){
    $loudspeaker_pt = $loudspeaker_pt - 1;
}
else if ($pt_now < 3000000){
    $loudspeaker_pt = $loudspeaker_pt - 2;
}
else {
	$loudspeaker_pt = $loudspeaker_pt - 3;
}
//echo "pt獎勵獎勵擴音器：".$loudspeaker_pt."<br>";


/*登入獎勵*/
$whistle_gift = 0;
$pass_gift = 0;

if ($day_left < 1 ){
    $pass_gift = 0;
}
else if ($day_left < 2 ){
    $pass_gift = 50;
}
else if ($day_left < 3 ){
    $pass_gift = 100;
}
else if ($day_left < 4 ){
    $pass_gift = 150;
}
else if ($day_left < 5 ){
    $pass_gift = 200;
}
else if ($day_left < 6 ){
    $pass_gift = 250;
}
else if ($day_left < 7 ){

    $pass_gift = 300;
}
else if ($day_left < 8 ){
    if($gift == 100){
        $pass_gift = 400;
    }else {
        $pass_gif = 350;
    }
}
else {
    if($gift == 100){
        $pass_gift = 400;
        $whistle_gift = 100;
    }else {
        $pass_gif = 450;
    }

}
//echo "官方送但還未領pass數：".$pass_gift."<br>";
//echo "官方送但還未領哨子數：".$whistle_gift."<br>";

/*daily mission*/
if ($day_mission == 1 ){
	$pass_mission = $day_left * 50;		
}
else{
	$pass_mission = 0;
}
//echo "未領每日任務pass：".$pass_mission."<br>";


/*星光次數*/
if ($stage_complete == 1){
	$stage_event = $day_left*3;
}
else{
	$stage_event = 0;	
}
//echo "預計還有星光次數：".$stage_event."<br>";

if ($stage_complete == 1){
	$time_stage = (9-$day_left)*3;
}
else{
	$time_stage = 0;	
}
//echo "已進行星光次數：".$time_stage."<br>";



/*exp1計算*/
$exp_bp = 0;
if ($bp_use == 1){
	$exp_bp = 100*(floor($bp_recovory+$whistle_gift+$whistle_now+$whistle_package+$whitstle_draw+$whitstle_pt)+10*($loudspeaker_now+$loudspeaker_pt)+floor($double_now+$double_package));
}
else if ($bp_use == 2){
	$exp_bp = 160*(floor(($bp_recovory+$whistle_gift+$whistle_now+$whistle_package+$whitstle_draw+$whitstle_pt)+10*($loudspeaker_now+$loudspeaker_pt)+floor($double_now+$double_package))/2);
	
}
else if ($bp_use == 3){
	$exp_bp = 200*(floor(($bp_recovory+$whistle_gift+$whistle_now+$whistle_package+$whitstle_draw+$whitstle_pt)+10*($loudspeaker_now+$loudspeaker_pt)+floor($double_now+$double_package))/3);

}
else if ($bp_use == 6){
	$exp_bp = 300*(floor(($bp_recovory+$whistle_gift+$whistle_now+$whistle_package+$whitstle_draw+$whitstle_pt)+10*($loudspeaker_now+$loudspeaker_pt)+floor($double_now+$double_package))/6);
}
else{
	$exp_bp = 400*(floor(($bp_recovory+$whistle_gift+$whistle_now+$whistle_package+$whitstle_draw+$whitstle_pt)+10*($loudspeaker_now+$loudspeaker_pt)+floor($double_now+$double_package))/10);
}

/*無計入星光時的20*/
$exp_other = 20*($work_recovory);
$exp_gain = $exp_bp + $exp_other;
//echo "一共獲得 ".$exp_bp."+".$exp_other."共".$exp_gain." 經驗值<br>";




/*exp2計算*/
$level_mid = 0;
for ($level_mid = $level_now; $exp_gain >= $exp_need; $level_mid++){
	$exp_gain = $exp_gain - $exp_need;
	$exp_need = $level_mid*100+2500;
	//echo "剩餘exp:".$exp_gain."<br>";
}

$level_up= floor($level_mid-$level_now);
//echo "一共升級:".$level_up."等<br>";


/*pt平均計算*//* normal:1bp ; event:100pass */
$pt_normal = floor(floor(2000+($score_normal/5000))*(1+$add/100));
$pt_event = floor(floor(10000+($score_event/5000))*(1+$add/100));


/*平刷數據1*/
$free_bp = $bp_now + $bp_recovory + 10*$level_up ;
$free_work = $work_now + $work_recovory + $work_max*$level_up;
$free_whistle = $whistle_now + $whistle_gift + $whitstle_pt + $whistle_package + $whitstle_draw;
$free_loudspeaker = $loudspeaker_now + $loudspeaker_pt;
$free_double = $double_now + $double_package;
$free_ability = $ability*$day_left;
//echo "合計可用bp數：".$free_bp."<br>";
//echo "合計可用work數：".$free_work."<br>";
//echo "合計可用哨子數：".$free_whistle."<br>";
//echo "合計可用擴音器數：".$free_loudspeaker."<br>";
//echo "合計可用翻倍數：".$free_double."<br>";
//echo "合計製作人能力：".$free_ability."<br>";


/*pass計算1*/
$free_pass =  10*$bp_now + $work_now + $whistle_now*10 + $double_now*10 + $pass_gift + 10*($whistle_package + $double_package) + 10*$bp_recovory + $work_recovory + 10*10*$level_up + $work_max*$level_up + 10*$whitstle_pt + 10*10*$loudspeaker_pt + $pass_mission + $pass_now ;
//echo "打個打工pass數：". 10*$bp_now + $work_now + $whistle_now*10 + $double_now*10 ."<br>";
//echo "禮包pass數：". 10*($whistle_package + $double_package)."<br>";
//echo "自回pass數：".$bp_recovory*10 + $work_recovory ."<br>";
//echo "升級pass數：". $level_up*10*10 + $work_max*$level_up."<br>";
//echo "pt獎勵pass數：". 10*$whitstle_pt + 10*10*$loudspeaker_pt."<br>";
//echo "日常任務pass數：". $pass_mission ."<br>";
//echo "持有pass數：".$pass_now."<br>";
//echo "官方送pass數：".$pass_gift."<br>";
//echo "合計可用pass數：".$free_pass."<br>";


/*一般曲餘數*/
$bp_transfer = $free_bp + $free_whistle + 10*$free_loudspeaker;
$remain_normal = 0 ;
$bp_remain = ($bp_transfer) % $bp_use;

if ($bp_remain == 9){
	$remain_normal = $remain_normal + 2;
	$bp_remain = 0;
}
else if ($bp_remain == 8){
	$remain_normal = $remain_normal + 2;
	$bp_remain = 0;
}
else if ($bp_remain == 7){
	$remain_normal = $remain_normal + 2;
	$bp_remain = 0;
}
else if ($bp_remain == 6){
	$remain_normal = $remain_normal + 1;
	$bp_remain = 0;
}
else if ($bp_remain == 5){
	$remain_normal = $remain_normal + 2;
	$bp_remain = 0;
}
else if ($bp_remain == 4){
	$remain_normal = $remain_normal + 2;
	$bp_remain = 0;
}
else if ($bp_remain == 3){
	$remain_normal = $remain_normal + 1;
	$bp_remain = 0;
}
else if ($bp_remain == 2){
	$remain_normal = $remain_normal + 1;
	$bp_remain = 0;
}
else {
	$remain_normal = $remain_normal + 1;
	$bp_remain = 0;
}

//echo "一般曲整數：".floor( $bp_transfer / $bp_use)."<br>";
//echo "一般曲餘數：".$bp_remain."<br>";

/*一般曲計算*/	
$time_normal = floor( $bp_transfer / $bp_use) + $remain_normal;
//echo "平刷一般曲次數：".$time_normal."<br>";

/*活動曲餘數*/
$remain_event = 0;
$pass_remain = $free_pass % $pass_use;
if ($pass_remain == 900){
	$remain_event = $remain_event + 5;
	$pass_remain = 0;
}
else if ($pass_remain == 800){
	$remain_event = $remain_event + 4;
	$pass_remain = 0;
}
else if ($pass_remain == 700){
	$remain_event = $remain_event + 3;
	$pass_remain = 0;
}
else if ($pass_remain == 600){
	$remain_event = $remain_event + 2;
	$pass_remain = 0;
}
else if ($pass_remain == 500){
	$remain_event = $remain_event + 1;
	$pass_remain = 0;
}
else if ($pass_remain == 400){
	$remain_event = $remain_event + 4;
	$pass_remain = 0;
}
else if ($pass_remain == 300){
	$remain_event = $remain_event + 3;
	$pass_remain = 0;
}
else if ($pass_remain == 200){
	$remain_event = $remain_event + 1;
	$pass_remain = 0;
}
else {
	$remain_event = $remain_event + 1;
	$pass_remain = 0;
}

//echo "活動曲整數：".floor($free_pass / $pass_use)."<br>";
//echo "活動曲餘數：".$pass_remain."<br>";

/*活動曲計算*/
$time_event = floor( $free_pass / $pass_use) + $remain_event;
//echo "平刷活動曲次數：".$time_event."<br>";

/*free_pt_count*/
$free_bp_pt = $pt_normal*$free_bp;
$free_work_pt = $work_pt*$free_work;
$free_whistle_pt = $pt_normal*$free_whistle;
$free_loudspeaker_pt = $pt_normal*10*$free_loudspeaker;
$free_double_pt = $pt_normal*$free_double;
$free_stage_pt = 5000*($time_stage + $stage_event);
$free_pass_pt = floor($pt_event * $free_pass / 100);
//$free_pt_total = $free_bp_pt + $free_work_pt + $free_whistle_pt + $free_loudspeaker_pt + $free_double_pt + ($stage_event*5000) + $free_pass_pt + $pt_now ;
$free_pt_total_test = $free_bp_pt + $free_work_pt + $free_whistle_pt + $free_loudspeaker_pt + $free_double_pt + ($stage_event*5000) + $free_pass_pt + $pt_now +$free_ability;
//echo "可用bp數獲得pt：".$free_bp_pt."<br>";
//echo "可用work數獲得pt：".$free_work_pt."<br>";
//echo "可用哨子數獲得pt：".$free_whistle_pt."<br>";
//echo "可用擴音器數獲得pt：".$free_loudspeaker_pt."<br>";
//echo "可用翻倍數獲得pt：".$free_double_pt."<br>";
//echo "可用pass獲得pt：".$free_pass_pt."<br>";
//echo "未打星光獲得pt：". 5000*$stage_event."<br>";
//echo "平刷可獲得縂pt：".$free_pt_total."<br>";
//echo "平刷可獲得縂pt(含製作人)：".$free_pt_total_test."<br>";




/*diamond_pt_count*/
$adv_bp = (10*$pt_normal+$pt_event)/10;
$need_bp = ceil(($pt_target - $free_pt_total_test)/ $adv_bp);
$dia_need = 20*$need_bp;

/*paid_exp_count*/
$paid_exp = 0;
if ($bp_use == 1){
	$paid_exp = 100*$need_bp;
}
else if ($bp_use == 2){
	$paid_exp = 160*floor($need_bp/2);
}
else if ($bp_use == 3){
	$paid_exp = 200*floor($need_bp)/3;
}
else if ($bp_use == 6){
	$paid_exp = 300*floor($need_bp)/6;
}
else{
	$paid_exp = 400*floor($need_bp)/10;
}

$level_final = 0;
for ($level_final = $level_mid; $paid_exp >= $exp_need; $level_final++){
	$paid_exp = $paid_exp - $exp_need;
	$exp_need = $level_final*100+2500;
	//echo "剩餘exp:".$paid_exp."<br>";
}
$paid_level_up = floor($level_final-$level_mid);
//echo "付費升等：".$paid_level_up."<br>";
$final_level_up = $level_up + $paid_level_up;

/*歌曲次數計算2*/
/*一般曲*/
$paid_normal = floor(($need_bp+10*$paid_level_up)/$bp_use);
$paid_normal_remain = ($need_bp+10*$paid_level_up) % $bp_use;

if ($paid_normal_remain == 9){
	$paid_normal = $paid_normal + 2;
	$paid_normal_remain = 0;
}
else if ($paid_normal_remain == 8){
	$paid_normal = $paid_normal + 2;
	$paid_normal_remain = 0;
}
else if ($paid_normal_remain == 7){
	$paid_normal = $paid_normal + 2;
	$paid_normal_remain = 0;
}
else if ($paid_normal_remain == 6){
	$paid_normal = $paid_normal + 1;
	$paid_normal_remain = 0;
}
else if ($paid_normal_remain == 5){
	$paid_normal = $paid_normal + 2;
	$paid_normal_remain = 0;
}
else if ($paid_normal_remain == 4){
	$paid_normal = $paid_normal + 2;
	$paid_normal_remain = 0;
}
else if ($paid_normal_remain == 3){
	$paid_normal = $paid_normal + 1;
	$paid_normal_remain = 0;
}
else if ($paid_normal_remain == 2){
	$paid_normal = $paid_normal + 1;
	$paid_normal_remain = 0;
}
else {
	$paid_normal = $paid_normal + 1;
	$paid_normal_remain = 0;
}

/*活動曲*/
$paid_event = floor((10*($need_bp+10*$paid_level_up))/$pass_use);
$paid_event_remain = ($need_bp+10*$paid_level_up) % $pass_use;
if ($paid_event_remain == 900){
	$paid_event = $paid_event + 5;
	$paid_event_remain = 0;
}
else if ($paid_event_remain == 800){
	$paid_event = $paid_event + 4;
	$paid_event_remain = 0;
}
else if ($paid_event_remain == 700){
	$paid_event = $paid_event + 3;
	$paid_event_remain = 0;
}
else if ($paid_event_remain == 600){
	$paid_event = $paid_event + 2;
	$paid_event_remain = 0;
}
else if ($paid_event_remain == 500){
	$paid_event = $paid_event + 1;
	$paid_event_remain = 0;
}
else if ($paid_event_remain == 400){
	$paid_event = $paid_event + 4;
	$paid_event_remain = 0;
}
else if ($paid_event_remain == 300){
	$paid_event = $paid_event + 3;
	$paid_event_remain = 0;
}
else if ($paid_event_remain == 200){
	$paid_event = $paid_event + 1;
	$paid_event_remain = 0;
}
else {
	$paid_event = $paid_event + 1;
	$paid_event_remain = 0;
}



$total_normal = $paid_normal + $time_normal ;
$total_event = $paid_event + $time_event ;

$num_bp = $need_bp -10*$paid_level_up;
$num_dia = $dia_need - 20*10*$paid_level_up ;


/*輸出*/

echo "<h1>剩餘自回bp數：".$bp_recovory."</h1>";
echo "<h1>剩餘自回工作券數：".$work_recovory."</h1>";
echo "<h1>平刷可得pt數：".$free_pt_total_test."</h1>";
echo "<h1>總共升級：".$final_level_up."級</h1>";
echo "<h1>普通曲每bp可獲得pt數：".$pt_normal."</h1>";
echo "<h1>活動曲每100pass可獲得pt數：".$pt_event."</h1>";
echo "<h1>一般曲總共要刷：".$total_normal."次</h1>";
echo "<h1>活動曲總共要刷：".$total_event."次</h1>";
echo "<h1>達標還需bp數：".$num_bp."</h1>";
echo "<h1>須耗鑽數：".$num_dia."</h1>";



?>

</div>

</body>
</html>