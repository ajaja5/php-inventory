<html>
<head>
<meta charset="utf-8">
<title>TANENT 재고관리 프로그램</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="./css/scm_css.css" rel="stylesheet" /> 
</head>
<style>
	td{border-spacing: 0px; padding: 0px;}
	</style>
<body>
<form action="TANGENT_SCM.php" method="post">	
<table width="100%" height="100vh" border="0" style="border-spacing: 0px; padding: 0px;"  >
  <tbody>
   <tr>
      <td width="100%" height="30vh">
		  <table width="100%" height="100%" border="0">
  			<tbody><tr>
				<?php $serverName = "183.102.137.146"; //serverName\instanceName $serverName = "locslhost"가능 
			$connectionInfo = array( "Database"=>"testdb","CharacterSet" => "UTF-8","UID"=>"test", "PWD"=>"22208678");
			$conn = sqlsrv_connect( $serverName, $connectionInfo);
			$categori = $_POST['categori'];
			$goods = $_POST['goods'];
			$subcnt = $_POST['subcnt'];
			$inven = $_POST['inven'];
			$precnt = $_POST['precnt'];	
			if( $conn ) {
     		//echo "Connection established.<br/>";
			}else{
     		echo "Connection could not be established.<br/>";
     		die( print_r( sqlsrv_errors(), true));}
			$query = "SELECT CATEGORI FROM TANGENTSCM";
			$query2 = "SELECT GOODS FROM TANGENTSCM";
			$query3 = "SELECT CNT FROM TANGENTSCM WHERE CATEGORI = '$categori' AND GOODS = '$goods'";
			$result = sqlsrv_query($conn, $query); 
			$result2 = sqlsrv_query($conn, $query2);
			$result3 = sqlsrv_query($conn, $query3); 
			if($inven == 'input'){ 
				$query4 = "UPDATE TANGENTSCM SET CNT=CNT+'$subcnt' WHERE CATEGORI='$categori'";
				$result4 = sqlsrv_query($conn, $query4);
				sqlsrv_fetch_array($result4, SQLSRV_FETCH_ASSOC);
				$query3 = "SELECT CNT FROM TANGENTSCM WHERE CATEGORI = '$categori' AND GOODS = '$goods'";
				$result3 = sqlsrv_query($conn, $query3); }
			else{if($subcnt <= $precnt){ 
				$query5 = "UPDATE TANGENTSCM SET CNT=CNT-'$subcnt' WHERE CATEGORI='$categori'";
				$result5 = sqlsrv_query($conn, $query5);
				sqlsrv_fetch_array($result5, SQLSRV_FETCH_ASSOC);
				$query3 = "SELECT CNT FROM TANGENTSCM WHERE CATEGORI = '$categori' AND GOODS = '$goods'";
				$result3 = sqlsrv_query($conn, $query3);}} ?>
				<td width="30%">
			    	<select name="categori">
					<?php while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){?>
					<option value="<?php echo $row['CATEGORI'] ?>" <?php if($row['CATEGORI'] == $categori) echo "selected"; ?>>
					<?php echo $row['CATEGORI'] ?></option>
						<?php } ?>
					</select>
				</td><td width="30%">
				<select name="goods" onchange="this.form.submit()">
				<?php while($row = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)){?>
					<option value="<?php echo $row['GOODS'] ?>" <?php if($row['GOODS'] == $goods) echo "selected"; ?>>
						<?php echo $row['GOODS'] ?></option>
						<?php } ?>
				</select></td>
				<td width="20%"><select name="etc"><option>기타</option><option>text1</option>
	   				<option>text2</option><option>text3</option></select></td>
				<td width="20%">현재수량</td>
				</tr></tbody>
				</table>
			</td>
    	</tr>
    <tr>
      <td height="70vh">
		  <?php while($row = sqlsrv_fetch_array($result3, SQLSRV_FETCH_ASSOC)){ ?>
			<input type="text" class="selectList_text" id="select_cnt" name="precnt" value="<?php echo $row['CNT']; ?>">
		  <?php } ?>
		 </td>
    </tr>
	<tr><td height="90vh"><input type="text" name="subcnt" id="countbox_css" value=0></td></tr>
    <tr>
      <td height="150vh" style="background-color: blueviolet"><table width="100%" height="100%" border="0">
  <tbody>
    <tr>
      <td width="20%"><input class="btn_count" type="button" name="num" value='0' onclick="textarea_num(0)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num" value="1" onclick="textarea_num(1)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num" value="2" onclick="textarea_num(2)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num" value='3' onclick="textarea_num(3)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num" value='4' onclick="textarea_num(4)"></td>
    </tr>
    <tr>
      <td width="20%"><input class="btn_count" type="button" name="num" value='5' onclick="textarea_num(5)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num" value='6' onclick="textarea_num(6)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num" value='7' onclick="textarea_num(7)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num" value='8' onclick="textarea_num(8)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num" value='9' onclick="textarea_num(9)"></td>
    </tr>
    <tr>
      <td width="20%"><input class="btn_count" type="button" name="num" value='000' onclick="textarea_num(10)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num" value='reset' onclick="textarea_num(23)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num" value='←' onclick="textarea_num(24)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num1" value='+' onclick="textarea_num(11)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num1" value='-' onclick="textarea_num(17)"></td>
    </tr>
  </tbody>
</table>
</td></tr>
    <tr><td height="100vh" style="background-color: black"><table width="100%" height="100%" border="0">
  <tbody><tr>
      <td width="20%"><input class="btn_count" type="button" name="num1" value='+10' onclick="textarea_num(12)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num1" value='+100' onclick="textarea_num(13)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num1" value='+500' onclick="textarea_num(14)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num1" value='+1,000' onclick="textarea_num(15)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num1" value='+10,000' onclick="textarea_num(16)"></td></tr>
    <tr><td width="20%"><input class="btn_count" type="button" name="num1" value='-10' onclick="textarea_num(18)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num1" value='-100' onclick="textarea_num(19)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num1" value='-500' onclick="textarea_num(20)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num1" value='-1,000' onclick="textarea_num(21)"></td>
      <td width="20%"><input class="btn_count" type="button" name="num1" value='-10,000' onclick="textarea_num(22)"></td>
    </tr></tbody>
</table>
</td>
    </tr>
    <tr>
      <td height="45vh"><table width="100%" height="100%" border="0">
  <tbody>
    <tr><td width="50%"><button class="in_btn" type="submit" name="inven" value="input">입고</button></td>
	<td width="50%"><button class="out_btn" type="submit" name="inven" value="output">출고</button></td></tr>
  </tbody>
</table>
</td></tr></tbody>
</table>

</form>
</body>
<script src=./js/scm_js.js>

</script>
</html>
