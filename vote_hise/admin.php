<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			投票管理中心
		</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<style type="text/css">
th{
text-align: center;x
}
*{font-family: "微软雅黑";}
		</style>
		<script>
function doDel(id) {
	if (confirm("确定要删除吗？")) {
		window.location='action.php?action=del&id=' + id;
	}
}
</script>
	</head>
	<body>
		<?php 
		require_once "functions.php";
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
		
		if(getToggle()){
			$tips1 = '开启';
		}
		else{
			$tips1 = '关闭';
		}
		
		?>
		<div class="container" style="margin-top: 20px;">
				<legend class='text-center'>
					2017中国地质大学最受欢迎老师评选投票系统<br/>
					后台管理中心
				</legend>
				<div class="form-group">
					<label>当前投票状态:</label>
					<strong>
						<span id="tips1" style="color:green;">
							<?php echo $tips1 ?>
						</span>
					</strong>
					<input id="toggle" type="button" class="form-control btn btn-default" id="" value='投票开关'/>




				</div>

				
				
				<div class="form-group">
					<label>投票结果数据：</label>
					<strong>
						<span id="tips1" style="color:green;">
						</span>
					</strong>
					<a href="../vote_hise/vote_result.php" target="_blank">投票结果票选</a>
				</div>
				
			
		</div>
		<script src="//code.jquery.com/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script type="text/javascript">
		
		
			
			document.getElementById("toggle").onclick = function() {
				if(confirm("确定要开始投票吗？")){
					var request = new XMLHttpRequest();
				request.open("POST", "action.php?action=toggle");
					var data='';
					request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					request.send(data);
					request.onreadystatechange = function() {
	
						if (request.readyState === 4) {
							if (request.status === 200) {
								alert(request.responseText+'成功');
								document.getElementById("tips1").innerHTML=request.responseText;
							}
							
						}
					}
				}
				
			}
		</script>
	</body>
</html>