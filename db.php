<?php

// Create connection
// $conn = new PDO("sqlsrv:Server=localhost,1433;Database=myDB","testuser","testuser2018");
// $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// Check connection
/*
 * $pdo = new \PDO(
 * 'sqlsrv:Server=localhost ; DataBase=My_DB',
 * "testuser",
 * "testuser2018"
 * );
 * $extended = new ExtendedPdo($pdo);
 * $stmt = 'Select Top 10 * from tblStudent';
 * $result = $extended->fetchAll($stmt);
 */
$conn_array = array(
    "UID" => "testuser",
    "PWD" => "testuser2018",
    "Database" => "myDB"
);
$conn = sqlsrv_connect('localhost', $conn_array);
$result = sqlsrv_query($conn, "Select Top 10 * from tblStudent");
if ($conn) {
    echo "connected";
    
    // while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
    // var_dump($row);
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $values[] = array(
            'fname' => $row["FirstName"],
            'lname' => $row["LastName"],
            'email' => $row["Email"]
        );
        
        /*
         * echo "Col1: ".$row[0]."\n";
         * echo "Col2: ".$row[1]."\n";
         * echo "Col3: ".$row[2]."<br>\n";
         * echo "-----------------<br>\n";
         */
    }
} else {
    die(print_r(sqlsrv_errors(), true));
}
sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>


<table>
<?php
foreach ($values as $v) {
    echo '
    <tr>
        <td width=55>' . $v['fname'] . '</td>
        <td width=55>' . $v['lname'] . '</td>
        <td width=50>' . $v['email'] . '</td>
    </tr>
    ';
}
?>
</table>