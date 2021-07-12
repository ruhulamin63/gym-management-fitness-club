<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>view page</title>
</head>
<body>
	<table border="1" align="center">
		<tr>
			<td>Ename</td>
		</tr>

		<?php 
			require_once('../models/UserModel.php');

			$result=getAllData();
			
			while ($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) {
			    echo "<tr>\n";
			    foreach ($row as $value) {
			        echo "<td>".$value."</td>\n";
			    }
			    echo "</tr>\n";	
			}
			oci_free_statement($result);
			//oci_close($conn);
		?>
	</table>
</body>
</html>