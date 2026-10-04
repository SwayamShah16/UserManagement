<?php
    include 'db.php';
    require 'vendor/autoload.php';

    $result = $conn -> query("select * from emp");
    $pdf = new TCPDF();
    $pdf -> AddPage();
    $pdf -> setFont('times','I','14');

    $html='<table>
    <tr>
    <td>Id</td>
    <td>Name</td>
    <td>Salary</td>
    </tr>';

    while($row = $result -> fetch_assoc()){
        $html .= '<tr>
        <td>'.$row["id"].'</td>
        <td>'.$row["name"].'</td>
        <td>'.$row["salary"].'</td>
        </tr>';
    }

    $html .= '</table>';

    $pdf -> writeHtml($html,true,false,true,false,'');
    $pdf -> Output("emp.pdf","D");

?>