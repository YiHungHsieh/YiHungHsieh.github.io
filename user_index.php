
<!DOCTYPE html>
<html>
<head>
	<title>一般員工</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../view/indexStyle.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="fullcalendar_drag/css/fullcalendar.css">
<link rel="stylesheet" type="text/css" href="fullcalendar_drag/css/fancybox.css">
<link rel="stylesheet" type="text/css" href="fullcalendar_drag/css/jquery-ui.css">
<style type="text/css">
#calendar{width:85%; margin:50px auto 10px auto}
.fancy{width:450px; height:auto}
.fancy h3{height:30px; line-height:30px; border-bottom:1px solid #d3d3d3; font-size:14px}
.fancy form{padding:10px}
.fancy p{height:28px; line-height:28px; padding:4px; color:#999}
.input{height:20px; line-height:20px; padding:2px; border:1px solid #d3d3d3; width:100px}
.btn{-webkit-border-radius: 3px;-moz-border-radius:3px;padding:5px 12px; cursor:pointer}
.btn_ok{background: rgb(54, 135, 255);border: 1px solid #390;color:#fff}
.btn_cancel{background:#f0f0f0;border: 1px solid #d3d3d3; color:#666 }
.btn_del{background:#f90;border: 1px solid #f80; color:#fff }
.sub_btn{height:32px; line-height:32px; padding-top:6px; border-top:1px solid #f0f0f0; text-align:right; position:relative}
.sub_btn .del{position:absolute; left:2px}
td:hover{
	background-color:#FFEFD5;
}
th{
  border-bottom: solid 1px #CCC;
}
}
</style>
<script src='http://code.jquery.com/jquery-1.9.1.js'></script>
<script src="../js/notyf.min.js" type="text/javascript"></script>
<script src='http://code.jquery.com/ui/1.10.3/jquery-ui.js'></script>
<script src='fullcalendar_drag/js/fullcalendar.min.js'></script>
<script src='fullcalendar_drag/js/jquery.fancybox-1.3.1.pack.js'></script>
<script src='fullcalendar_drag/js/jquery.form.min.js'></script>
<link rel="stylesheet" type="text/css" href="../css/notyf.min.css">
<script language="JavaScript">
function notyf(){
<?php include "test.php" ?>
var notyf = new Notyf({delay:5000});

if("<?php echo $row['businessMsg']?>" !=""){
notyf.confirm("<?php echo $row['businessMsg']?>");
}
if("<?php echo $row['overTimeMsg']?>" !=""){
notyf.confirm("<?php echo $row['overTimeMsg']?>");
}
if("<?php echo $row['leaveMsg']?>" !=""){
notyf.confirm("<?php echo $row['leaveMsg']?>");
}
if("<?php echo $row['returnBusinessMsg']?>" !=""){
notyf.alert("<?php echo $row['returnBusinessMsg']?>");
}
if("<?php echo $row['returnOvertimeMsg']?>" !=""){
notyf.alert("<?php echo $row['returnOvertimeMsg']?>");
}
if("<?php echo $row['returnLeaveMsg']?>" !=""){
notyf.alert("<?php echo $row['returnLeaveMsg']?>");
}
setTimeout("<?php include '../Controller/refreshMsg.php' ?>",50000);
}
</script>

<script type="text/javascript">
$(function() {
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next,today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		editable: true,
		dragOpacity: {
			agenda: .5,
			'':.6
		},
		eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
			$.post("fullcalendar_drag/do.php?action=drag",{id:event.id,daydiff:dayDelta,minudiff:minuteDelta,allday:allDay},function(msg){
				if(msg!=1){
					alert(msg);
					revertFunc();
				}
			});
    	},
		 eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
			$.post("fullcalendar_drag/do.php?action=resize",{id:event.id,daydiff:dayDelta,minudiff:minuteDelta},function(msg){
				if(msg!=1){
					alert(msg);
					revertFunc();
				}
			});
    	},
		selectable: true,
		select: function( startDate, endDate, allDay, jsEvent, view ){
			var start =$.fullCalendar.formatDate(startDate,'yyyy-MM-dd');
			var end =$.fullCalendar.formatDate(endDate,'yyyy-MM-dd');
			$.fancybox({
				'type':'ajax',
				'href':'fullcalendar_drag/event.php?action=add&date='+start+'&end='+end
			});
		},
		events: 'fullcalendar_drag/json.php',
		dayClick: function(date, allDay, jsEvent, view) {
			var selDate =$.fullCalendar.formatDate(date,'yyyy-MM-dd');
			$.fancybox({
				'type':'ajax',
				'href':'fullcalendar_drag/event.php?action=add&date='+selDate
			});
    	},
		eventClick: function(calEvent, jsEvent, view) {
			$.fancybox({
				'type':'ajax',
				'href':'fullcalendar_drag/event.php?action=edit&id='+calEvent.id
			});
		}
	});
});
</script>
</head>
<body >
	<script>notyf();</script>
	
	<div class="top">
			<img class="titleImg" src="https://cdn.unwire.hk/wp-content/uploads/2014/10/facebook-user.jpg" width="70" height="50">
		<a href="../Controller/log_logout.php">
			<i id="topIcon" class="material-icons" >exit_to_app</i>
		</a>
		<a href="#">
			<i id="topIcon" class="material-icons">notifications</i>
		</a>
    <?php
    if ($_SESSION['root'] == 'admin'){?>
		    <a href="../admin-Model/admin_index.php">
			    <i id="topIcon" class="material-icons">https</i>
		    </a><?php }
    ?>
	</div>
<!--    上欄 TOP 結束        -->
	<div class="down">
<!--     左欄 LEFT 開始     -->
		<div class="left">
			<div class="left-top">
				<p class="left-top-title">一般員工</p>
			</div>
<!--    左上欄 LEFT-TOP 結束    -->
			<div class="left-bottom">
				<div class="left-title" >
					<a href="user_profile.php" style="margin:auto 20px">個人資料</a>
				</div>
				<div class="left-title" >
					<a href="user_introduction.php" style="margin:auto 20px">歡迎使用</a>
				</div>
				<div class="left-title" style="background-color:#FFDDAA">
					<p style="margin:auto 20px">行事曆</p>
				</div>
				<div class="left-title">
					<a href="user_news.php" style="margin:auto 20px">公佈欄</a>
				</div>
				<div class="left-title">
					<a href="#" style="margin:auto 20px">打卡資訊</a>
				</div>
				<div class="left-title">
					<p style="margin:auto 20px">表單申請</p>
				</div>
					<div  class="left-list">
						<a href="user_leave.php" style="margin:auto 35px">請假申請</a>
					</div>
					<div class="left-list">
						<a href="user_bTrip.php" style="margin:auto 35px">出差申請</a>
					</div>
					<div class="left-list">
						<a href="user_overtime.php" style="margin:auto 35px">加班申請</a>
					</div>
					<div class="left-list">
						<a href="user_bTrip_list.php" style="margin:auto 35px">差勤明細</a>
					</div>
				<div class="left-title">
					<a href="#" style="margin:auto 20px">員工訓練</a>
				</div>
        <div class="left-title">
          <a href="#" style="margin:auto 20px">更改密碼</a>
        </div>
			</div><!--左下 LEFT-BOTTOM 結束 -->
		</div><!--左 LEFT 結束 -->
<!--    右欄 RIGHT 開始     -->
		<div class="right">
			<div class="right-top">
				<p class="right-top-title">行事曆</p>
			</div>
<!--    右上欄 RIGHT-TOP 結束    -->
			<div class="right-bottom" id="main">
        <div id="calendar" >
			  </div>
			</div><!--  右下欄 RIGHT-BOTTOM 結束    -->

		</div><!--   右欄 RIGHT 結束    -->
	</div><!--    下欄 DOWN 結束    -->


</body>
</html>