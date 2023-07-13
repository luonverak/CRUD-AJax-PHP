<!DOCTYPE html>
<?php include('get_data.php') ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid bg-dark float-end p-3">
        <h1 class="text-light m-0">CRUD AJax</h1>
        <button id="openAdd" type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#myModal">
        <i class="fa-solid fa-plus"></i> Add Employee
        </button>
    </div>
    <table class="table table-dark table-hover align-middle" style="table-layout: fixed;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Position</th>
                <th>Salary</th>
                <th>OT</th>
                <th>Income</th>
                <th>Profile</th>
                <th>Create At</th>
                <th>Update At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php getDetail(); ?>
        </tbody>
    </table>
    <!-- The Modal Delete -->
    <div class="modal" id="myModal1">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Are you Sur?</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
           <form action="" method="post">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            <button id="btn_delete" type="button" class="btn btn-primary" data-bs-dismiss="modal">Yes, Delete</button>
        </form>
        </div>
        </div>
    </div>
    </div>
    <!-- The Modal Add -->
    <div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Modal Heading</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
           <form action="" method="post" enctype="multipart/form-data">
            <label for="">Name</label>
            <input type="text" class="form-control" id="name">
            <label for="">Gender</label>
            <select class="form-select" id="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <label for="">Position</label>
            <input type="text" class="form-control" id="position">
            <label for="">Salary</label>
            <input type="text" class="form-control" id="salary">
            <label for="">Work OT</label>
            <input type="text" class="form-control" id="work_ot">
            <label for="">Profile</label> <br>
            <input type="file" class="d-none" id="profile" name="profile">
            <img src="image/upload.webp" width="120" height="120" style="object-fit: cover;" id="thumbnail">
            <!-- Hidden profile -->
            <input type="hidden" id="profile1">
            <!-- Hidde ID -->
            <input type="hidden" id="id">
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="btn_save" type="button" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                <button id="btn_update" type="button" class="btn btn-success" data-bs-dismiss="modal">Update</button>
            </div>
        </form>
        </div>
        </div>
    </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $("#openAdd").click(function(){
            $("#btn_save").show();
            $("#btn_update").hide();
        })
        // choose profile
        $("#thumbnail").click(function(){
            $("#profile").click();
        })
        $("#profile").change(function(){
            var form_data = new FormData();
            var file = $("#profile")[0].files;
            form_data.append('profile',file[0]);
            $.ajax({
                url    : 'move_image.php',
                method : 'post',
                data   : form_data,
                cache  : false,
                contentType :false,
                processData :false,
                success:function(respone){
                    $("#thumbnail").attr('src','image/'+respone);
                    $("#profile1").val(respone);
                }
            })
        })
        // insert
        $("#btn_save").click(function(){
            let name     = $("#name").val();
            let gender   = $("#gender").val();
            let position = $("#position").val();
            let salary   = $("#salary").val();
            let work     = $("#work_ot").val();
            let profile  = $("#profile1").val();
            $.ajax({
                url : 'insert_data.php',
                method : 'post',
                data : {
                    emp_name :name,
                    emp_gender :gender,
                    emp_position :position,
                    emp_salary   :salary,
                    emp_work     :work,
                    emp_profile  :profile
                },
                cache :false,
                success :function(respone){
                    if(respone){
                        var rowData=`
                            ${respone}
                        `;
                        $('tbody').append(rowData);
                    }
                }
            })
        })
        //Delete
        var row='';
        var rowIndex='';
        $('body').on('click','#openDelete',function(){
            var id = $(this).parents('tr').find('td').eq(0).text();
            rowIndex=$(this).parents('tr').index();
            $('#btn_delete').click(function(){
                row=$('body').find('tbody').find('tr');
                row.eq(rowIndex).remove();
                $.ajax({
                    url : 'delete_data.php',
                    method : 'post',
                    data :{
                        remove_id :id
                    },
                    cache :false,
                    success :function(respone){
                        if(respone=='ok'){
                            alert('success');
                        }else{
                            alert('error');
                        }
                    }
                })
            })
        })
        //Update
        $('body').on('click','#openUpdate',function(){
            $("#btn_save").hide();
            $("#btn_success").show();

            rowIndex  = $(this).parents('tr').index();

            var id       = $(this).parents('tr').find('td').eq(0).text();
            var name     = $(this).parents('tr').find('td').eq(1).text();
            var gender   = $(this).parents('tr').find('td').eq(2).text();
            var position = $(this).parents('tr').find('td').eq(3).text();
            var salary   = $(this).parents('tr').find('td').eq(4).text();
            var work     = $(this).parents('tr').find('td').eq(5).text();
            var profile  = $(this).parents('tr').find('td:eq(7) img').attr('alt');

            $('#id').val(id);
            $("#name").val(name);
            $("#gender").val(gender);
            $("#position").val(position);
            $("#salary").val(salary);
            $("#work_ot").val(work);
            $("#thumbnail").attr('src','./image/'+profile);
            $("#profile1").val(profile);

            $("#btn_update").click(function(){
                row=$('body').find('tbody').find('tr');
                let id       = $("#id").val();
                let name     = $("#name").val();
                let gender   = $("#gender").val();
                let position = $("#position").val();
                let salary   = $("#salary").val();
                let work     = $("#work_ot").val();
                let profile  = $("#profile1").val();
                $.ajax({
                    url : 'update_data.php',
                    method : 'post',
                    data : {
                        emp_id   :id,
                        emp_name :name,
                        emp_gender :gender,
                        emp_position :position,
                        emp_salary   :salary,
                        emp_work     :work,
                        emp_profile  :profile
                    },
                    cache :false,
                    success :function(respone){
                        if(respone){
                            var data = `${respone}`;
                        }
                        row.eq(rowIndex).html(data);
                    }
                })
            })

        })
    })
</script>
</html>