<?php

	require_once "functions.php";
	
	if (!isset($_GET['stu_num']) || empty($_GET['stu_num'])) {
		echo "<script>alert('非法进入，请先验证你的信息！');window.location='confirm.html'</script>";
	}
	else{
		if(getToggle()){
			echo "<script>alert('投票已经开始，请为你喜爱的候选人投上宝贵的一票吧！');</script>";
		}
		else{
			echo "<script>alert('投票暂未开始，请稍等');window.location='confirm.html'</script>";
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
	


?>

<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>投票页面</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<style type="text/css">
			
		</style>
	</head>
	
	
	 <?php

    //数据库连接
    require_once "functions.php";
    $pdo = connectDb();


    ?>
	
	<body>
		<div class="container" style="margin-top: 20px;">
				<div class="form-group" >
					
					
					<div class="panel panel-info" id="tuanwei">
						<div class="panel-heading">
							<legend class="text-center">
								最受学生欢迎老师网上投票
								<span class="badge" id="select_tuanwei">
									已经选择：0人
								</span>
							</legend>
							<div class="text-center">
								<span class="">说明：您最多只可以投3票，但至少需要投出1票</span>
							</div>
						</div>
						<!--<div class="panel-body">-->
						<table class="table table-bordered">
							<tbody style="width: 80%;">
								<?php
								    $sql = "select * from vote_tw";
   									$arr = $pdo->query($sql);
									$id_1=0;
									foreach ($arr as $row) {
											if($id_1%4==0){
											echo '<tr>';
										}
										$id_1++;
										echo '<td>';
										echo '<label class="checkbox-inline" style=";padding:5px;margin-left:20px;">';
										echo "<input onclick='doCheck(this);' name='tuanwei_checkbox' type='checkbox' id='inlineCheckbox1' value='{$row["v_name"]}'> ";
										echo $row['v_name'];
										echo '</label>';
										echo '</td>';
										if($id_1%4==0){
											echo '<tr>';
										}
									}
								?>
								</tr>
							</tbody>
						</table>
						<!--</div>-->
					</div>
					
					
							
				</div>
								<input id="submitvote" type="button"  name="stu_class" value="提交信息" class="btn btn-success" style="width: 100%;" onclick="return check()">
			<div class="text-center" style="margin-top: 20px;">
				CopyRight @ 2010-2017 点石社团程序组版权所有
			</div>
		
		</div>

		<script type="text/javascript">


			
			var c = 0, limit = 3;
	        function doCheck(obj) {
	            obj.checked ? c++ : c--;
	            if (c > limit) {
	                obj.checked = false;
	                alert("您最多只可以投三票！但最少投一票");
	                c--;
	            }
				document.getElementById("select_tuanwei").innerText = "已经选择："+c+"人";
				
	        }
	        
	        

	        function getQueryString(name) { 
				var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
				var r = window.location.search.substr(1).match(reg); 
				if (r != null) return unescape(r[2]); return null; 
			} 
	        document.getElementById("submitvote").onclick = function() {
				if(check()){
					var request = new XMLHttpRequest();
					request.open("POST", "action.php?action=addvote");
					
					var data = "teacher_name=" + getCheckString('tuanwei_checkbox')+"&stu_num="+getQueryString('stu_num');
					request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					request.send(data);
					request.onreadystatechange = function() {
						if (request.readyState === 4) {
							if (request.status === 200) {
								

								if(request.responseText=='您已经投票，每人仅有一次机会'){
									window.location.href='warning.html';
								}
								else{
									
									if(request.responseText=='投票已经结束'){
										alert(request.responseText);
										window.location.href='error.html';
									}
									else{
										alert(request.responseText);
										window.location.href='success.html';
									}
									
								}
								
							} else {
								alert("失败");
							}
						}
					}
				}

			}
	        
	        function check(){
	        	if(c==0){
	        		if(c==0){
	        			alert('您至少需要投出一票');
	        			return false;
	        		}
	        		else{
	        			alert('您至少需要投出一票');
	        			return false;
	        		}
	        	}
	        	else{
	        		//可以成功执行
	        		if(confirm("是否确认提交？")){
	        			return true;
	        		}
	        		
	        	}

	        	return false;
	        }
	        
	        
	        function getCheckString(checkBoxName){
	        	var obj = document.getElementsByName(checkBoxName);//选择所有name="interest"的对象，返回数组    
            	var s='';//如果这样定义var s;变量s中会默认被赋个null值
            	for(var i=0;i<obj.length;i++){
            		if(obj[i].checked) //取到对象数组后，我们来循环检测它是不是被选中
            		s+=obj[i].value+',';   //如果选中，将value添加到变量s中    
            	}
    			return s;
	        }


    		
    		
		</script>


		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</body>
</html>