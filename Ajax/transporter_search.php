<?php
include '../DB-config/db-config.php';

if(!empty($_GET['word'])){
    $word = $_GET['word'];
    $selectBy = $_GET['selectBy'];

    if($selectBy == 'county'){
        $sql = "SELECT * FROM transporter WHERE county LIKE '$word%'";

        $run = mysqli_query($connection, $sql);
        $rows = mysqli_num_rows($run);

        echo '<table>
        <tr>
            <th>Name</th>
            <th>County</th>
            <th>Route</th>
            <th>Vehicle type</th>
            <th>Action</th>
            </tr>';

        if($rows > 0){
            while( $rowt = mysqli_fetch_assoc($run)){
               echo ' <tr>
                <td>'. $rowt['name'].'</td>
                <td>'.$rowt['county'].'</td>
                <td>'.$rowt['route'].'</td>
                <td>'.$rowt['vehicle'].'</td>
                <td><a href="tel:'.$rowt['phone'].'" class="btn">Call</a></td>
                </tr>';
         }
        }
        else{
            echo '<h6>No transporter available in that county<h6> </table>';
        }
    }
    else{
        $sql = "SELECT * FROM transporter WHERE route LIKE '$word%'";

        $run = mysqli_query($connection, $sql);
        $rows = mysqli_num_rows($run);

        echo '<table>
        <tr>
            <th>Name</th>
            <th>County</th>
            <th>Route</th>
            <th>Vehicle type</th>
            <th>Action</th>
            </tr>';

        if($rows > 0){
            while( $rowt = mysqli_fetch_assoc($run)){
                echo ' <tr>
                <td>'. $rowt['name'].'</td>
                <td>'.$rowt['county'].'</td>
                <td>'.$rowt['route'].'</td>
                <td>'.$rowt['vehicle'].'</td>
                <td><a href="tel:'.$rowt['phone'].'" class="btn">Call</a></td>
                </tr>';
            }
        }
        else{
            echo '<h6>No transporter available in that route<h6></table>';
        }
    }
}
else{
    $sql = "SELECT * FROM transporter";

    $run = mysqli_query($connection, $sql);
    $rows = mysqli_num_rows($run);

    echo '<table>
        <tr>
            <th>Name</th>
            <th>County</th>
            <th>Route</th>
            <th>Vehicle type</th>
            <th>Action</th>
            </tr>';

    while( $rowt = mysqli_fetch_assoc($run)){
        echo ' <tr>
                <td>'. $rowt['name'].'</td>
                <td>'.$rowt['county'].'</td>
                <td>'.$rowt['route'].'</td>
                <td>'.$rowt['vehicle'].'</td>
                <td><a href="tel:'.$rowt['phone'].'" class="btn">Call</a></td>
                </tr>';
    }
}
?>