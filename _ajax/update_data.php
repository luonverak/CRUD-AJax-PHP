<?php
    include('connection_db.php');
    include('get_income.php');

    $id       = $_POST['emp_id'];
    $name     = $_POST['emp_name'];
    $gender   = $_POST['emp_gender'];
    $position = $_POST['emp_position'];
    $salary   = $_POST['emp_salary'];
    $work     = $_POST['emp_work'];
    $profile  = $_POST['emp_profile'];

    if(!empty($name) && !empty($gender) && !empty($position) && !empty($salary) && !empty($work) && !empty($profile)){
        $income = getIncome($position,$salary,$work);
        $update_at = date('d/M/Y');
        $sql = "UPDATE `employee`
                SET `name`='$name',`gender`='$gender',`position`='$position',`salary`='$salary',`work_hour`='$work',`income`='$income',`profile`='$profile',`update_at`='$update_at'
                WHERE id='$id'";
        $rs  = $con->query($sql);
        if($rs){
            function getDetail(){
                global $con;
                global $id;
                $sql = "SELECT * FROM `employee` WHERE id ='$id'";
                $rs  = $con->query($sql);
                $row = mysqli_fetch_assoc($rs);
                echo '
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
                    ';
            }
            echo getDetail();
        }
    }
?>