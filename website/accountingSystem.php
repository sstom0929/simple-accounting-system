<!DOCTYPE html>
<html>
<head>
	<title>Accounting System</title>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<style type="text/css">
		body{
			background: #e0f2f1;
		}
		caption{
			font-weight: bolder;
		}
	</style>
	<?php
		include('dbConnect.php');
		if(isset($_POST['submitCompany'])){
			if(!isset($_POST['companyName']) || chop($_POST['companyName']) == ''){
				echo '<script>alert("請輸入公司名稱")</script>';
			}
			else if(!isset($_POST['initialAssets']) || $_POST['initialAssets'] < 0){
				echo '<script>alert("請輸入正確資產")</script>';
			}
			else if(!isset($_POST['initialLiabilities']) || $_POST['initialLiabilities'] < 0){
				echo '<script>alert("請輸入正確債務")</script>';
			}
			else{
				$query = 'INSERT INTO company (name, initialAsset, initialLiability) VALUES ("'.$_POST['companyName'].'", "'.$_POST['initialAssets'].'", "'.$_POST['initialLiabilities'].'")';
				mysqli_query($db, $query);
			}
		}
		if(isset($_POST['submitReceivable'])){
			if(!isset($_POST['companyIdReceivable']) || $_POST['companyIdReceivable'] == ''){
				echo '<script>alert("請選擇公司")</script>';
			}
			else if(!isset($_POST['recordDateReceivable']) || chop($_POST['recordDateReceivable']) == ''){
				echo '<script>alert("請輸入紀錄日期")</script>';
			}
			else if(!isset($_POST['nameReceivable']) || chop($_POST['nameReceivable']) == ''){
				echo '<script>alert("請輸入名稱")</script>';
			}
			else if(!isset($_POST['numberReceivable']) || $_POST['numberReceivable'] < 0){
				echo '<script>alert("請輸入正確數量")</script>';
			}
			else if(!isset($_POST['pricePerUnitReceivable']) || $_POST['pricePerUnitReceivable'] < 0){
				echo '<script>alert("請輸入正確每單位價格")</script>';
			}
			else{
				$query = 'INSERT INTO receivable (companyId, name, num, pricePerUnit, recordDate) VALUES ("'.$_POST['companyIdReceivable'].'", "'.$_POST['nameReceivable'].'", "'.$_POST['numberReceivable'].'", "'.$_POST['pricePerUnitReceivable'].'", "'.$_POST['recordDateReceivable'].'")';
				mysqli_query($db, $query);
			}			
		}
		if(isset($_POST['submitPayable'])){
			if(!isset($_POST['companyIdPayable']) || $_POST['companyIdPayable'] == ''){
				echo '<script>alert("請選擇公司")</script>';
			}
			else if(!isset($_POST['recordDatePayable']) || chop($_POST['recordDatePayable']) == ''){
				echo '<script>alert("請輸入紀錄日期")</script>';
			}
			else if(!isset($_POST['namePayable']) || chop($_POST['namePayable']) == ''){
				echo '<script>alert("請輸入名稱")</script>';
			}
			else if(!isset($_POST['numberPayable']) || $_POST['numberPayable'] < 0){
				echo '<script>alert("請輸入正確數量")</script>';
			}
			else if(!isset($_POST['pricePerUnitPayable']) || $_POST['pricePerUnitPayable'] < 0){
				echo '<script>alert("請輸入正確每單位價格")</script>';
			}
			else{
				$query = 'INSERT INTO payable (companyId, name, num, pricePerUnit, recordDate) VALUES ("'.$_POST['companyIdPayable'].'", "'.$_POST['namePayable'].'", "'.$_POST['numberPayable'].'", "'.$_POST['pricePerUnitPayable'].'", "'.$_POST['recordDatePayable'].'")';
				mysqli_query($db, $query);
			}
		}
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('select').formSelect();
			$('.collapsible').collapsible();
			$('.datepicker').datepicker();
			$('.modal').modal();
		});
	</script>
</head>
<body>
	<div>
		<ul class="collapsible">
			<li>
				<div class="collapsible-header teal lighten-1 white-text"><b>Create a New Company</b></div>
				<div class="collapsible-body">
					<span>
						<form method="POST">
							<div class="row">
								<div class="input-field col s6">
									<input id="companyName" name="companyName" type="text" class="validate">
									<label for="companyName">Company Name</label>
								</div>
								<div class="input-field col s3">
									<input id="initialAssets" name="initialAssets" type="number" class="validate">
									<label for="initialAssets">Initial Assets</label>
								</div>
								<div class="input-field col s3">
									<input id="initialLiabilities" name="initialLiabilities" type="number" class="validate">
									<label for="initialLiabilities">Initial Liabilities</label>
								</div>
							</div>
							<button class="btn waves-effect waves-light" type="submit" name="submitCompany">Submit</button>
						</form>				
					</span>
				</div>
			</li>
			<li>
				<div class="collapsible-header teal lighten-1 white-text"><b>Create a Receivable Payment</b></div>
				<div class="collapsible-body">
					<span>
						<form method="POST">
							<div class="row">
								<div class="input-field col s6">
									<select name ="companyIdReceivable">
										<option value="" disabled selected>Choose the company</option>
										<?php
											$query = 'SELECT id, name FROM company';
											$result = mysqli_query($db, $query);
											while($row = mysqli_fetch_array($result)){
												echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
											}
										?>
									</select>
									<label>Select a Company</label>
								</div>
								<div class="input-field col s6">
									<input id="recordDatePayable" name="recordDateReceivable" type="text" class="datepicker">
									<label for="initialAssets">Record Date</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s6">
									<input id="namePayable" name="nameReceivable" type="text" class="validate">
									<label for="name">Name</label>
								</div>
								<div class="input-field col s3">
									<input id="numberPayable" name="numberReceivable" type="number" class="validate">
									<label for="number">Number</label>
								</div>
								<div class="input-field col s3">
									<input id="pricePerUnitPayable" name="pricePerUnitReceivable" type="number" class="validate">
									<label for="pricePerUnit">Price Per Unit</label>
								</div>
							</div>
							<button class="btn waves-effect waves-light" type="submit" name="submitReceivable">Submit</button>
						</form>				
					</span>
				</div>
			</li>
			<li>
				<div class="collapsible-header teal lighten-1 white-text"><b>Create a Payable Payment</b></div>
				<div class="collapsible-body">
					<span>
						<form method="POST">
							<div class="row">
								<div class="input-field col s6">
									<select name="companyIdPayable">
										<option value="" disabled selected>Choose the company</option>
										<?php
											$query = 'SELECT id, name FROM company';
											$result = mysqli_query($db, $query);
											while($row = mysqli_fetch_array($result)){
												echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
											}
										?>
									</select>
									<label>Select a Company</label>
								</div>
								<div class="input-field col s6">
									<input id="recordDatePayable" name="recordDatePayable" type="text" class="datepicker">
									<label for="initialAssets">Record Date</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s6">
									<input id="namePayable" name="namePayable" type="text" class="validate">
									<label for="name">Name</label>
								</div>
								<div class="input-field col s3">
									<input id="numberPayable" name="numberPayable" type="number" class="validate">
									<label for="number">Number</label>
								</div>
								<div class="input-field col s3">
									<input id="pricePerUnitPayable" name="pricePerUnitPayable" type="number" class="validate">
									<label for="pricePerUnit">Price Per Unit</label>
								</div>
							</div>
							<button class="btn waves-effect waves-light" type="submit" name="submitPayable">Submit</button>
						</form>			
					</span>
				</div>
			</li>
		</ul>
	</div>
	<?php 
		$query = 'SELECT * FROM company';
		$resultCompany = mysqli_query($db, $query);
		$htmlCollections = '<ul class="collection">';
		while($rowCompany = mysqli_fetch_array($resultCompany)){
			// For Assets
			$currentAsset = $rowCompany['initialAsset'];
			$tableHTMLReceivable = '<tr><th colspan="5">Receivable</th></tr>';
			$tableHTMLReceivable .= '<tr><th>Name</th><th>Record Date</th><th>Number</th><th>PricePerUnit</th><th>Total</th></tr>';
			$query = 'SELECT * FROM receivable WHERE companyId = "'.$rowCompany['id'].'"';
			$resultReceivable = mysqli_query($db, $query);
			while($row = mysqli_fetch_array($resultReceivable)){
				$tableHTMLReceivable .= '<tr>';
				$tableHTMLReceivable .= '<td>'.$row['name'].'</td>';
				$tableHTMLReceivable .= '<td>'.$row['recordDate'].'</td>';
				$tableHTMLReceivable .= '<td>'.$row['num'].'</td>';
				$tableHTMLReceivable .= '<td>$'.$row['pricePerUnit'].'</td>';
				$tableHTMLReceivable .= '<td>$'.($row['num'] * $row['pricePerUnit']).'</td>';
				$tableHTMLReceivable .= '</tr>';
				$currentAsset += ($row['num'] * $row['pricePerUnit']);
			}
			// For Liabilities
			$currentLiability = $rowCompany['initialLiability'];
			$tableHTMLLiability = '<tr><th colspan="5">Payable</th></tr>';
			$tableHTMLLiability .= '<tr><th>Name</th><th>Record Date</th><th>Number</th><th>PricePerUnit</th><th>Total</th></tr>';
			$query = 'SELECT * FROM payable WHERE companyId = "'.$rowCompany['id'].'"';
			$resultPayable = mysqli_query($db, $query);
			while($row = mysqli_fetch_array($resultPayable)){
				$tableHTMLLiability .= '<tr>';
				$tableHTMLLiability .= '<td>'.$row['name'].'</td>';
				$tableHTMLLiability .= '<td>'.$row['recordDate'].'</td>';
				$tableHTMLLiability .= '<td>'.$row['num'].'</td>';
				$tableHTMLLiability .= '<td>$'.$row['pricePerUnit'].'</td>';
				$tableHTMLLiability .= '<td>$'.($row['num'] * $row['pricePerUnit']).'</td>';
				$tableHTMLLiability .= '</tr>';
				$currentLiability += ($row['num'] * $row['pricePerUnit']);
			}
			// For Collection
			$htmlCollections .= '<a class="modal-trigger" href="#modal'.$rowCompany['id'].'">';
			$htmlCollections .= '<li class="collection-item avatar black-text">';
			$htmlCollections .= '<i class="material-icons circle red">assignment</i>';
			$htmlCollections .= '<span class=title">'.$rowCompany['name'].'</span>';
			$htmlCollections .= '<p>Current Assets: $'.$currentAsset.'<br>Current Liabilities: $'.$currentLiability.'</p>';
			$htmlCollections .= '<i class="secondary-content material-icons">keyboard_arrow_right</i>';
			$htmlCollections .= '</li></a>';

			// For Modal
			$tableHTMLCompany = '<table><caption>'.$rowCompany['name'].'</caption><tr><th colspan="5">Information</th></tr>';
			$tableHTMLCompany .= '<tr><th>Initial Assets</th><td>$'.$rowCompany['initialAsset'].'</td><th>Initial Liabilities</th><td>$'.$rowCompany['initialLiability'].'</td></tr>';
			$tableHTMLCompany .= '<tr><th>Currrent Assets</th><td>$'.$currentAsset.'</td><th>Currrent Liabilities</th><td>$'.$currentLiability.'</td></tr>';
			$tableHTMLCompany .= $tableHTMLReceivable;
			$tableHTMLCompany .= $tableHTMLLiability;
			$tableHTMLCompany .= '</table>';

			// For Modal Structure
			$modalStructure = '<div id="modal'.$rowCompany['id'].'" class="modal">';
			$modalStructure .= '<div class="modal-content">';
			$modalStructure .= $tableHTMLCompany;
			$modalStructure .= '</div></div>';
			echo $modalStructure;
			
		}
		$htmlCollections .= '</ul>';
		echo $htmlCollections;
	?>
</body>
</html>
