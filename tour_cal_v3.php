<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META name="viewport"  content="width=device-width, initial-scale=1">
<title>巡演計算結果</title>
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

echo "<p>巡演碎鑽計算結果：</p>";

/*post*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {      
	$gift = $_POST['gift']; 
	$date_end = $_POST['date_end'];
	$time_end = $_POST['time_end'];
	$pt_now = $_POST['pt_now'];
	$pt_target = $_POST['pt_target']; 
	$score_three = $_POST['score_three']; 
	$score_four = $_POST['score_four']; 
	$bp_use_3 = $_POST['bp_use_3']; 
	$bp_use_4 = $_POST['bp_use_4'];  
	$fever = $_POST['fever'];  
	$add = $_POST['add'];  
	$level_now = $_POST['level_now']; 
	$exp_need = $_POST['exp_need']; 
	$bp_now = $_POST['bp_now'];
	$loudspeaker_now = $_POST['loudspeaker_now'];
	$whistle_now = $_POST['whistle_now'];
	$double_now = $_POST['double_now'];
	$work_now = $_POST['work_now']; 
	$work_max = $_POST['work_max']; 
	$work_time = $_POST['work_time']; 
	$work_event = $_POST['work_event'];
	$bp_waste = $_POST['bp_waste'];
	$work_waste = $_POST['work_waste'];
	$stage_complete = $_POST['stage_complete'];
	$month_big = $_POST['month_big'];	
	$day_mission = $_POST['day_mission'];	
	$day_draw = $_POST['day_draw'];	
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
$taiwan_end = $unix_end - 8*60*60;		/*8小時失蹤了(⊙o⊙)*/
//echo "時間轉換（台灣時區）:".$taiwan_end."<br>";
$minute_total = ($taiwan_end-$time_now)/60;

/*時間最大值*/
if ( $minute_total > 202*60){
	$minute_total = 202*60;
}else{
	$minute_total = $minute_total;
}

/*剩餘時間*/
$day_left  = ceil(($minute_total-60*22)/(60*24));
//echo "剩餘".$day_left."天<br>";
$hour_left = floor($minute_total/60);
$minute_left = floor($minute_total%60);
echo "<h1>活動剩餘時間：".$hour_left."小時".$minute_left."分鐘</h1>";

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

 
/*things*/
/*big month package*/
/**double & whistle**/
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
/**whistle**/
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
else if ($pt_target < 2950000){
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
else if ($pt_now < 2950000){
    $loudspeaker_pt = $loudspeaker_pt - 2;
}
else {
	$loudspeaker_pt = $loudspeaker_pt - 3;
}
//echo "pt獎勵獎勵擴音器：".$loudspeaker_pt."<br>";


/*log in*/
/**whistle**/
$whistle_gift = 0;

if ($day_left < 1 ){
    $whistle_gift = 0;
}
else if ($day_left < 2 ){
    $whistle_gift = 3;
}
else if ($day_left < 3 ){
    $whistle_gift = 6;
}
else if ($day_left < 4 ){
    $whistle_gift = 9;
}
else if ($day_left < 5 ){
    $whistle_gift = 12;
}
else if ($day_left < 6 ){
    $whistle_gift = 15;
}
else if ($day_left < 7 ){
    $whistle_gift = 18;
}
else if ($day_left < 8 ){
	$whistle_gift = 21;
}
else {
    if($gift == 121){
        $whistle_gift = 121;
    }
    else {
        $whistle_gift = 27;
    }
}
//echo "官方送但還未領哨子數：".$whistle_gift."<br>";

/*daily mission*/
/**whistle**/
if ($day_mission == 1 ){
	$whistle_mission = $day_left * 2;		
}
else{
	$whistle_mission = 0;
}
//echo "未領每日任務哨子：".$whistle_mission."<br>";


/*time concert*/
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


/*days_need to arrive target*/
$free_stage_pt = 5000*( $time_stage + $stage_event);
$free_work_pt = $work_pt*($work_now + $work_recovory);
$free_double_pt = floor(floor(2500+($score_three/5000))*(1+$add/100))*$bp_use_3*floor(($double_now + $double_package)/$bp_use_3);
$days_need = 0;
$three_song_pt = 3*floor(floor(2500+($score_three/5000))*(1+$add/100))*$bp_use_3;
$four_song_pt = floor(floor(2250+($score_four/5000))*(1+$add/100)*(1+$fever/100))*$bp_use_4;
$one_days_pt = $three_song_pt + $four_song_pt;

$days_need = ceil(($pt_target - $free_stage_pt - $free_work_pt - $free_double_pt) / $one_days_pt)  ;
//echo "前三分數：".$three_song_pt."<br>";
//echo "第四天數：".$four_song_pt."<br>";
//echo "需要天數：".$days_need."<br>";

/*exp_count*/
/**exp_song**/
$exp_gain_3 = 0;
$exp_gain_4 = 0;

if ($bp_use_3 == 3){
	$exp_gain_3 = 3*200*$days_need;
} 
else if ( $bp_use_3 == 6 ){
	$exp_gain_3 = 3*300*$days_need;
}
else {
	$exp_gain_3 = 3*400*$days_need;
}

if ($bp_use_4 == 3){
	$exp_gain_4 = 200*$days_need;
} 
else if ( $bp_use_4 == 6 ){
	$exp_gain_4 = 300*$days_need;
}
else {
	$exp_gain_4 = 400*$days_need;
}

/**exp_other**/

$exp_double = 0;
if ($bp_use_3 == 3){
	$exp_double = 200*floor(($double_now + $double_package) / $bp_use_3);
}
else if ($bp_use_3 == 6){
	$exp_double = 300*floor(($double_now + $double_package) / $bp_use_3);
}
else {
	$exp_double = 400*floor(($double_now + $double_package) / $bp_use_3);
}

$exp_other = 20*($work_recovory) + $exp_double + 20*( $time_stage + $stage_event );
$exp_gain = $exp_gain_3 + $exp_gain_4 + $exp_other;
//echo $exp_gain.'<br>';

/**level_up_count**/
$level_final = 0;
$exp_need_2 = $exp_need;
for ($level_final = $level_now; $exp_gain >= $exp_need; $level_final++){
	$exp_gain = $exp_gain - $exp_need;
	$exp_need = $level_final*100+2500;
	//echo "剩餘exp:".$exp_gain."<br>";
}
$level_up= $level_final - $level_now;
//echo "一共升級:".$level_up."等<br>";

//already use exp//
$exp_use_3 = 0;
$exp_use_4 = 0;
$level_add = 0;

//exp_use_3//
if ($bp_use_3 == 3){
	$exp_use_3 = 200;
} 
else if ( $bp_use_3 == 6 ){
	$exp_use_3 = 300;
}
else {
	$exp_use_3 = 400;
}

//exp_use_4//
if ($bp_use_4 == 3){
	$exp_use_4 = 200;
} 
else if ( $bp_use_4 == 6 ){
	$exp_use_4 = 300;
}
else {
	$exp_use_4 = 400;
}

if ($pt_now >= $one_days_pt){
	$days_pass = floor($pt_now / $one_days_pt);
	$exp_use = $exp_use_3*3*$days_pass + $exp_use_4*$days_pass;
	$exp_unused = $exp_gain_3 + $exp_gain_4 + $exp_other - $exp_use;
	//echo $days_pass.'<br>';
	//echo $exp_use.'<br>';
	//echo $exp_unused.'<br>';
	
	$level_unused = 0;
	$level_unsed_total = 0;
	for ($level_unused = $level_now; $exp_unused >= $exp_need_2; $level_unused++){
		$exp_unused = $exp_unused - $exp_need_2;
		$exp_need_2 = $level_unused*100+2500;
		$level_unsed_total = $level_unsed_total + 1;
	}
	$final_lv = $level_now + $level_unsed_total;
	
}

/* free_pt for work(comfirm level up), double */
$free_double_num = $double_now + $double_package;
$free_double_pt = floor(floor(2500+($score_three/5000))*(1+$add/100))*$bp_use_3*floor(($double_now + $double_package)/$bp_use_3);
$free_work_pt = $work_pt*($work_now + $work_recovory + $work_max*$level_unsed_total);


//echo "合計可用work數：".$work_now + $work_recovory + $work_max*$level_up ."<br>";
//echo "合計可用翻倍數：".$free_double_num."<br>";
//echo "翻倍pt數：".$free_double_pt."<br>";

/* free_pt for song */
$free_bp = $bp_now + $bp_recovory + 10*$level_unsed_total;
$free_whistle = $whistle_now + $whistle_gift + $whitstle_pt + $whistle_package + $whitstle_draw + $whistle_mission;
$free_loudspeaker = $loudspeaker_now + $loudspeaker_pt;
$bp_transfer = $free_bp + $free_whistle + 10*$free_loudspeaker;

//echo "合計可用bp數：".$free_bp."<br>";
//echo "合計可用哨子數：".$free_whistle."<br>";
//echo "合計可用擴音器數：".$free_loudspeaker."<br>";
//echo "合計轉換bp：".$bp_transfer."<br>";


/* free day */
$free_day = floor($bp_transfer/($bp_use_3*3 + $bp_use_4));
$free_day_remain = $bp_transfer % ($bp_use_3*3 + $bp_use_4);
$free_day_pt = $free_day*$one_days_pt;

//echo "免費天數：".$free_day."<br>";
//echo "免費天數pt：".$free_day_pt."<br>";

/*free_pt_total (confirm need_bp)*/
$free_pt_total = $free_day_pt + $free_work_pt + $free_double_pt + ($stage_event*5000) + $pt_now;
//echo "平刷可獲得縂pt：".$free_pt_total."<br>";

/*count adv_bp need_bp need_dia need_day */
$pay_pt = $pt_target - $free_pt_total;
$need_day = $days_need - $days_pass; 
$adv_bp = floor( $one_days_pt / ($bp_use_3*3 + $bp_use_4));
//echo "bp可獲得pt：".$adv_bp."<br>";
$need_bp = ceil($pay_pt / $adv_bp) - $free_day_remain;
$pay_dia =  $need_bp*20;

/*print*/
echo "<h1>剩餘自回bp數：".$bp_recovory."</h1>";
echo "<h1>剩餘自回工作券數：".$work_recovory."</h1>";
echo "<h1>平刷可得pt數：".$free_pt_total."</h1>";
echo "<h1>總共能升級：".$level_up."級 （".$final_lv."級）</h1>";
echo "<h1>前3首總共可獲得pt數：".$three_song_pt."</h1>";
echo "<h1>第4首可獲得pt數：".$four_song_pt."</h1>";
echo "<h1>達標還需再刷：".$need_day."天，共".$days_need."天</h1>";
echo "<h1>達標還需bp數：".$need_bp."</h1>";
echo "<h1>需耗鑽數：".$pay_dia."</h1>";

?>

</div>

</body>
</html>