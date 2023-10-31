<?php
include '../DB-config/db-config.php';

if(!empty($_GET['searchby'])){
    $searchby = $_GET['searchby'];
    $word = $_GET['word'];

    if($searchby == 'county'){
        $sql = "SELECT * FROM prices WHERE county like '$word%' ORDER BY county";
        $run = mysqli_query($connection, $sql);
        $rows = mysqli_num_rows($run);

        echo '<table>
        <tr>
            <th>Product Name</th>
            <th>County</th>
            <th>Market Name</th>
            <th>Retail (Ksh/kg)</th>
            <th>Wholesale (Ksh/kg)</th>
        </tr>';

        if($rows > 0){
            while( $details = mysqli_fetch_assoc($run)){
                echo ' <tr>
                 <td>'.$details['product_name'].'</td>
                 <td>'.$details['county'].'</td>
                 <td>'.$details['market_name'].'</td>
                 <td>'.$details['retail_price'].'</td>
                 <td>'.$details['wholesale_price'].'</td>
                 </tr>';
            }
        }
        else{
            echo '<h6>That county is not present<h6></table';
        }
    }
    else if($searchby == 'product'){
        $sql = "SELECT * FROM prices WHERE product_name like '$word%' ORDER BY product_name";
        $run = mysqli_query($connection, $sql);
        $rows = mysqli_num_rows($run);

        echo '<table>
        <tr>
            <th>Product Name</th>
            <th>County</th>
            <th>Market Name</th>
            <th>Retail (Ksh/kg)</th>
            <th>Wholesale (Ksh/kg)</th>
        </tr>';

        if($rows > 0){
            while( $details = mysqli_fetch_assoc($run)){
                echo ' <tr>
                 <td>'.$details['product_name'].'</td>
                 <td>'.$details['county'].'</td>
                 <td>'.$details['market_name'].'</td>
                 <td>'.$details['retail_price'].'</td>
                 <td>'.$details['wholesale_price'].'</td>
                 </tr>';
            }
        }
        else{
            echo '<h6>That product is not present<h6></table';
        }
    }
    else if($searchby == 'market'){
        $sql = "SELECT * FROM prices WHERE market_name like '$word%' ORDER BY market_name";
        $run = mysqli_query($connection, $sql);
        $rows = mysqli_num_rows($run);

        echo '<table>
        <tr>
            <th>Product Name</th>
            <th>County</th>
            <th>Market Name</th>
            <th>Retail (Ksh/kg)</th>
            <th>Wholesale (Ksh/kg)</th>
        </tr>';

        if($rows > 0){
            while( $details = mysqli_fetch_assoc($run)){
                echo ' <tr>
                 <td>'.$details['product_name'].'</td>
                 <td>'.$details['county'].'</td>
                 <td>'.$details['market_name'].'</td>
                 <td>'.$details['retail_price'].'</td>
                 <td>'.$details['wholesale_price'].'</td>
                 </tr>';
            }
        }
        else{
            echo '<h6>That market is not present<h6></table';
        }
    }
}