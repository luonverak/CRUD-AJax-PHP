<?php
    include('connection_db.php');
    function getDetail(){
        global $con;
        $sql = "SELECT * FROM `employee`";
        $rs  = $con->query($sql);
        while($row = mysqli_fetch_assoc($rs)){
            echo '
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['gender'].'</td>
                <td>'.$row['position'].'</td>
                <td>'.$row['salary'].'</td>
                <td>'.$row['work_hour'].'</td>
                <td>'.$row['income'].'</td>
                <td>
                <img src="./image/'.$row['profile'].'" width="120" height="120" style="object-fit: cover;" alt="'.$row['profile'].'" >
                </td>
                <td>'.$row['create_at'].'</td>
                <td>'.$row['update_at'].'</td>
                <td>
                    <div class="d-flex">
                    <button id="openUpdate" class="btn btn-warning me-1"  data-bs-toggle="modal" data-bs-target="#myModal" >Update</button>
                    <button id="openDelete" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal1"  >Delete</button>
                    </div>
                </td>
            </tr>
            ';
        }

    }
?>