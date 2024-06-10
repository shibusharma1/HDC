<?php
#just trying to see the datas of database 
#not mandatory to implement in project

    require_once 'connection.php';
    $sql="SELECT * FROM cregister";
    $result = mysqli_query($conn,$sql);

    #Display data in tabular format
    echo "<table border =1 cellpadding=2 cellspacing=0>
            <tr>
            <th>ID</th>
            <th>FName</th>
            <th>LName</th>
            <th>Email</th>
            <th>Country</th>
            <th>Phone</th>
            </tr>";

    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr> 
            <td>".$row['id']."</td>
            <td>".$row['fname']."</td>
            <td>".$row['lname']."</td>
            <td>".$row['email']."</td>
            <td>".$row['country']."</td>
            <td>".$row['phone']."</td>
            </tr>";
        }
    }else{
        echo "<br>";
        echo "Details of Customer not found!!!";
    }
?>