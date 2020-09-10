<?php 
 
 function fetch_data()
 {
 	$output = '';
 	$conn = mysqli_connect("localhost", "root", "", "student");
 	$sql = "SELECT * FROM payment";
 	$result = mysqli_query($conn, $sql);
 	while($row = mysqli_fetch_array($result))
 	{
 		$output .= '<tr>
 						<td>'.$row["studentname"].'</td>
 						<td>'.$row["email"].'</td>
 						td>'.$row["totalfees"].'</td>
 						td>'.$row["paid"].'</td>
 						td>'.$row["balance"].'</td>
 					</tr>

 			';

 	}
 	return $output;

 }

 if(isset($_POST["generate_pdf"]))
 {
 	require('library/tcpdf.php');
 	$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 	$pdf->SetCreator(PDF_CREATOR);
 	$pdf->SetTitle("Report");
 	$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
 	$pdf->SetHeaderFont(ARRAY(PDF_FONT_NAME_MAIN,'', PDF_FONT_SIZE_MAIN));
 	$pdf->SetFooterFont(ARRAY(PDF_FONT_NAME_DATA,'', PDF_FONT_SIZE_DATA));
 	$pdf->SetDefaultMonospacedFont('helvetica');
 	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 	$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
 	$pdf->SetPrintHeader(false);
 	$pdf->SetPrintFooter(false);
 	$pdf->SetAutopageBreak(TRUE, 10);
 	$pdf->SetFont('helvetica', '', 11);
 	$pdf->AddPage();
 	$content = '';
 	$content .= '

 	<div>
    <img src="img/logo.png" height="100" width="100" align="right">
	</div>

 	<h4 align="center">INVOICE</h4><br>
 	//Date align right
 	//Student align right
 	//Email align right


 	<table border="0" cellspacing="0" cellpadding="3">

 		<tr>
 			<th>Student</th>
 			<th>Email</th>
 			<th>TotalFees</th>
 			<th>Paid</th>
 			<th>Balance</th>
 		</tr> 
 	';

 	$content .= fetch_data();
 	$content .= '</table>';
 	$pdf->writeHTML($content);
 	$pdf->Output('file.pdf', 'I');

 }
 ?>

 <!DOCTYPE html>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Report</title>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 </head>
 <body>

 	<br />
 	<div class="container">
 		<h4 align="center">Report</h4><br>
 		<div class="table-responsive">
 			<div class="col-md-12" align="right">
 				<form method="post">
 					<input type="submit" name="generate_pdf" class="btn btn-success" value="Generate PDF">
 					
 				</form>
 			</div>
 			<br>
 			<br>
 			<table class="table table-bordered">
 				<tr>
 					<th>NAME</th>
 					<th>AUTHOR</th>
 				</tr>

 				<?php 
 				echo fetch_data();
 				?>

 			</table>
 		</div>
 	</div>	
 
 </body>
 </html>