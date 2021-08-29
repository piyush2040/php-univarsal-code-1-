<html>  
      <head>  
           <title>full bank detail</title> 
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     <style>
   
   .box
   {
    width:750px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:100px;
   }
  </style>
      </head>  
      <body>  
        <div class="container">
          <h3 align="center">Import JSON File Data into Mysql Database in PHP</h3><br />
          <?php
          $connect = mysqli_connect("localhost", "root", "", "bank"); //Connect PHP to MySQL Database
          $query = '';
          $table_data = '';
          $filename = "banks.json";
          $data = file_get_contents($filename); //Read the JSON file in PHP
          $array = json_decode($data, true); //Convert JSON String into PHP Array
          foreach($array as $row) //Extract the Array Values by using Foreach Loop
          {
           $query = "INSERT INTO bank_full(bank_id,type,ifsc,micr,iin,apbs,ach_credit,ach_debit,nach_debit) VALUES ('".$row["code"]."', '".$row["type"]."','".$row["ifsc"]."','".$row["micr"]."','".$row["iin"]."','".$row["apbs"]."','".$row["ach_credit"]."','".$row["ach_debit"]."','".$row["nach_debit"]."'); ";  // Make Multiple Insert Query 
		$result = mysqli_query($connect,$query);
		$converted_apbs = $row["apbs"] ? 'true' : 'false';
		$converted_ach_credit = $row["ach_credit"] ? 'true' : 'false';
		$converted_ach_debit = $row["ach_debit"] ? 'true' : 'false';
		$converted_nach_debit = $row["nach_debit"] ? 'true' : 'false';
		$converted_bank_ifsc = $row["ifsc"] ? $row["ifsc"] : 'NOT AVAILABLE';
		$converted_bank_inn = $row["iin"] ? $row["iin"] : 'NOT AVAILABLE';
		$converted_bank_micr = $row["micr"] ? $row["micr"] : 'NOT AVAILABLE';

           $table_data .= '
            <tr>
       <td>'.$row["code"].'</td>
       <td>'.$row["type"].'</td>
	<td>'.$converted_bank_ifsc.'</td>
	<td>'.$converted_bank_micr.'</td>
	<td>'.$converted_bank_inn.'</td>
	<td>'.$converted_apbs.'</td>
	<td>'.$converted_ach_credit.'</td>
	<td>'.$converted_ach_debit.'</td>
	<td>'.$converted_nach_debit.'</td>
      </tr>
           '; //Data for display on Web page
          }
         
     echo '<h3>Imported JSON Data</h3><br />';
     echo '
      <table class="table table-bordered">
        <tr>
         <th width="10%">bank_code</th>
         <th width="10%">bank_type</th>
	<th width="10%">bank_ifsc</th>
	<th width="10%">bank_micr</th>
	<th width="10%">bank_iin</th>
	<th width="10%">bank_apbs</th>
	<th width="10%">ach_credit</th>
	<th width="10%">ach_debit</th>
	<th width="10%">nach_credit</th>
        </tr>
     ';
     echo $table_data;  
     echo '</table>';
          




          ?>
     <br />
         </div>  
      </body>  
 </html>  