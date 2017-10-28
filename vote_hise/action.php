<?php

require_once "functions.php";

function offToggle(){
	$pdo = connectDb();
	$sql = "update toggle set toggle=0";
	$rw = $pdo -> exec($sql);
	if ($rw > 0) {
		return true;
	} else {
		return false;
	}
}


function onToggle(){
	$pdo = connectDb();
	$sql = "update toggle set toggle=1";
	$rw = $pdo -> exec($sql);
	if ($rw > 0) {
		return true;
	} else {
		return false;
	}
}


function getToggle(){
	$pdo = connectDb();
	$sql = "select * from toggle";
	$rs = $pdo -> query($sql);
	//返回影响了多少行数据
	$arrData = $rs -> fetch(PDO::FETCH_ASSOC);
	//获取找到的数据
	if($arrData['toggle']=='0'){
		return FALSE;
	}
	else{
		return TRUE;
	}
}


function getRecord($tableName, $recordName, $condition) {
	$pdo = connectDb();
	$sql = "select * from $tableName where $recordName=$condition";
	$rs = $pdo -> query($sql);
	//返回影响了多少行数据
	$arrData = $rs -> fetch(PDO::FETCH_ASSOC);
	//获取找到的数据

	if ($rs -> rowCount() > 0) {
		return $arrData;
	} else {
		return 0;
	}
}


function isVote($stu_num){
	$pdo = connectDb();
	$sql = "select * from vote_record where vote_num='{$stu_num}'";
	$rs = $pdo -> query($sql);
	//返回影响了多少行数据
	$arrData = $rs -> fetch(PDO::FETCH_ASSOC);
	//获取找到的数据

	if ($rs -> rowCount() > 0) {
		return true;
	} else {
		return false;
	}
}


function insertVote($vote_name,$vote_num,$vote_record){
	$pdo = connectDb();
	if(!isVote($vote_num)){
			$sql2 = "insert into vote_record values(null,'{$vote_name}','{$vote_num}','{$vote_record}',0)";
			$rw = $pdo -> exec($sql2);
			if ($rw > 0) {
				return true;
			} else {
				return false;
			}
	}
	else{
		echo '您已经投票，每人仅有一次机会。';
		return false;
	}
}


function updateRecordToTuanwei($name){
	$pdo = connectDb();
	$sql = "update vote_tw set v_score=v_score+1 where v_name='{$name}'";
	$rw = $pdo -> exec($sql);
	if ($rw > 0) {
		return true;
	} else {
		return false;
	}
}
function updateRecordToXueshenghui($name){
	$pdo = connectDb();
	$sql = "update vote_xsh set v_score=v_score+1 where v_name='{$name}'";
	$rw = $pdo -> exec($sql);
	if ($rw > 0) {
		return true;
	} else {
		return false;
	}
}

function iniVoteRecord(){
	$pdo = connectDb();
	$sql = "delete from vote_record where 1=1;";
	$rw = $pdo -> exec($sql);
	if ($rw > 0) {
		return true;
	} else {
		return false;
	}
}


function iniVoteTuanweiNum(){
	$pdo = connectDb();
	$sql = "update vote_tw set v_score=0";
	$rw = $pdo -> exec($sql);
	if ($rw > 0) {
		return true;
	} else {
		return false;
	}
}




if (!isset($_GET["action"]) || empty($_GET["action"])) {
	echo "参数错误";
	return;
}

if (!empty($_GET["action"])) {
	$pdo = connectDb();
	switch ($_GET["action"]) {
		case 'iniVoteData':
			iniVoteRecord();
			iniVoteTuanweiNum();
			echo '初始化成功';
			break;
		case 'toggle':
			if(getToggle()){
				offToggle();
				echo '关闭';
			}
			else{
				onToggle();
				echo '开启';
			}
			break;
		case 'confirmIdentify' :
			$stu_name = $_POST['stu_name'];
			$stu_num = $_POST['stu_num'];

			$arr = getRecord('vote_person_info', 'vote_stu', $stu_num);

			if ($arr == 0) {
				$datainfo = array('code' => '0', 'msg' => '对不起，只能本校学生投票。非本校学生，请勿投票。');
				echo json_encode($datainfo, JSON_UNESCAPED_UNICODE);
			} else {
				if ($arr['vote_name'] == $stu_name) {
					if(!getToggle()){
						$datainfo = array('code' => '-1', 'msg' => '投票还未开始，请稍等~', 'stu_num' => $arr['vote_stu']);
						echo json_encode($datainfo, JSON_UNESCAPED_UNICODE);
					}else{
						$datainfo = array('code' => '1', 'msg' => 'Hi~"' . $arr['vote_name'] . '"信息验证成功，点击确认跳转到投票页面。', 'stu_num' => $arr['vote_stu']);
						echo json_encode($datainfo, JSON_UNESCAPED_UNICODE);
					}
				} else {
					if (strlen($arr['vote_name']) > 10) {
						$datainfo = array('code' => '1', 'msg' => 'Hi~' . $arr['vote_name'] . '信息验证成功，点击确认跳转到投票页面。', 'stu_num' => $arr['vote_stu']);
						echo json_encode($datainfo, JSON_UNESCAPED_UNICODE);
					} else {
						$datainfo = array('code' => '-1', 'msg' => '你的学号正确，但姓名输入错误，若正确输入仍无法进去，请联系管理员');
						echo json_encode($datainfo, JSON_UNESCAPED_UNICODE);
					}
				}
			}
			break;
		
		case 'test':
			offToggle();
			break;
		case 'addvote' :
			if(!getToggle()){
				exit('投票已经结束');
			}
			$tw_name=$_POST['teacher_name'];
			$stu_num=$_POST['stu_num'];
			$stu_name=getRecord("vote_person_info", "vote_stu", $stu_num)['vote_name'];
			$tw_name = substr($tw_name,0,strlen($tw_name)-1);
			
			if(!isVote($stu_num)){

				$tw_arr = explode(',', $tw_name);
				for($i=0;$i<count($tw_arr);$i++){
					$r1=updateRecordToTuanwei($tw_arr[$i]);
				}
				
				$r3=insertVote($stu_name, $stu_num, "[老师]:".$tw_name);
				
				if($r1&&$r3){
					echo '投票成功';
					
				}
				else{
					echo '投票失败';
					echo $r3;
					echo $stu_name;
		
				}
			}
			else{
				echo '您已经投票，不可再次投票';
			}
			break;
	}
} else {
	echo "非法操作";
}
