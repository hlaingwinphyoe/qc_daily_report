<?php
// common start
function old($inputName){
    if (isset($_POST[$inputName])){
        return $_POST[$inputName];
    }else{
        return "";
    }
}

function alert($data,$color="danger"){
    return "<p class='alert alert-$color'>$data</p>";
}

function redirect($l){
    echo "<script>location.href = '$l'</script>";
}

function textFilter($text){
    $text = strip_tags($text);
    $text = htmlentities($text,ENT_QUOTES);
    $text = stripslashes($text);

    return $text;
}

function setError($inputName,$message){
    $_SESSION['error'][$inputName] = $message;
}


function getError($inputName){
    if (isset($_SESSION['error'][$inputName])){
        return $_SESSION['error'][$inputName];
    }else{
        return "";
    }
}

function clearError(){
    $_SESSION['error']= [];
}

function runQuery($sql){
    $con = con();
    if(mysqli_query($con,$sql)){
        return true;
    }else{
        die("Query Fail : ".mysqli_error($con));
    }
}

function fetch($sql){
    $query = mysqli_query(con(),$sql);
    $row = mysqli_fetch_assoc($query);
    return $row;
}

function fetchAll($sql){
    $query = mysqli_query(con(),$sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($query)){
        array_push($rows,$row);
    }
    return $rows;
}

function showTime($timestamp,$format = "j M, Y"){
    return date($format,strtotime($timestamp));
}


// common end

// auth start

function register(){

    $errorStatus = 0;
    $name = "";
    $email = "";
    $phone = "";

    if(empty($_POST['name'])){
        setError("name","Name is required!");
        $errorStatus=1;
    }else{
        if(strlen($_POST['name']) < 5){
            setError("name","Name is too short!");
            $errorStatus=1;
        }else{
            if(strlen($_POST['name']) > 20){
                setError("name","Name is too long!");
                $errorStatus=1;
            }else{
                if (!preg_match("/^[a-zA-Z 0-9' ]*$/",$_POST['name'])) {
                    setError('name',"Only letters and white space allowed!");
                    $errorStatus=1;
                }else{
                    $name = textFilter($_POST['name']);
                }
            }
        }
    }

    if(empty($_POST['email'])){
        setError("email","Email is required");
        $errorStatus=1;
    }else{
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            setError("email","Email format incorrect");
            $errorStatus=1;
        }else{
            $email = textFilter($_POST['email']);
        }
    }

    if (empty($_POST['phone'])){
        setError("phone","Phone Number is required!");
        $errorStatus=1;
    }else{
        if (!preg_match("/^[0-9 ]*$/",$_POST['phone'])) {
            setError('phone',"Only numbers allowed!");
            $errorStatus=1;
        }else{
            $phone = textFilter($_POST['phone']);
        }
    }

    if (empty($_POST['password'])){
        setError("password","Password is required!");
        $errorStatus=1;
    }else{
        $sPass = password_hash($_POST['password'],PASSWORD_DEFAULT);
    }

    if (!$errorStatus){
        $sql = "INSERT INTO users (name,email,phone,password) VALUES ('$name','$email','$phone','$sPass')";
        if (runQuery($sql)){
            redirect("users");
        }
    }

}

function login(){
    $errorStatus =0;
    $email = "";

    if(empty($_POST['email'])){
        setError("email","Email is required");
        $errorStatus=1;
    }else{
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            setError("email","Email format incorrect");
            $errorStatus=1;
        }else{
            $email = textFilter($_POST['email']);
        }
    }

    if (empty($_POST['password'])){
        setError("password","Password is required!");
        $errorStatus=1;
    }else {
        $password = textFilter($_POST['password']);

    }

    if (!$errorStatus){
        $sql = "SELECT * FROM users WHERE email='$email'";
        $query = mysqli_query(con(),$sql);
        $row = mysqli_fetch_assoc($query);

        if (!$row){
            echo alert("Email or Password don't match");
        }else{
            if(!password_verify($password,$row['password'])){

                return alert("Email or Password don't match");

            }else{
                session_start();
                $_SESSION['user'] = $row;
                redirect("index.php");

            }
        }
    }

}

// auth end

// user start

function user($id){
    $sql = "SELECT * FROM users WHERE id = $id";
    return fetch($sql);
}

function users(){
    $sql = "SELECT * FROM users";
    return fetchAll($sql);
}

function userDelete($id){
    $sql = "DELETE FROM users WHERE id=$id";
    return runQuery($sql);
}

// user end

// department start

function addDepartment(){
    $errorStatus = 0;
    $department = "";

    if (empty($_POST['department'])) {
        setError("department", "Department name is required!");
        $errorStatus = 1;
    } else {
        $department = textFilter(strip_tags($_POST['department']));
    }

    if (!$errorStatus){
        $user_id = $_SESSION['user']['id'];

        $sql = "INSERT INTO departments (dept_name,user_id) VALUES ('$department','$user_id')";

        $_SESSION['dept_create'] = "
            <div class='alert alert-success alert-dismissible fade show'>
            <i class='fa fa-check me-2'></i>
            Department Created Successfully
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            redirect("createDepartment");
    }

}

function department($id){
    $sql = "SELECT * FROM departments WHERE id=$id";
    return fetch($sql);
}

function departments(){
    $sql = "SELECT * FROM departments";
    return fetchAll($sql);
}

function departmentDelete($id){
    $sql = "DELETE FROM departments WHERE id=$id";
    return runQuery($sql);
}

function editDepartment(){
    $errorStatus = 0;
    $newDepartment = "";

    if (empty($_POST['department'])) {
        setError("department", "Department name is required!");
        $errorStatus = 1;
    } else {
        $newDepartment = textFilter(strip_tags($_POST['department']));
    }

    if (!$errorStatus){
        $id = $_POST['id'];

        $sql = "UPDATE departments SET dept_name='$newDepartment' WHERE id=$id";

        if(runQuery($sql)){
            $_SESSION['dept_edit'] = "
            <div class='alert alert-success alert-dismissible fade show'>
            <i class='fa fa-check me-2'></i>
            Department Name Updated Successfully!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            redirect("createDepartment");
        }
    }

}

// department end


// test type start

function testCreate(){
    $errorStatus = 0;
    $test = "";

    if (empty($_POST['test'])) {
        setError("test", "Test name is required!");
        $errorStatus = 1;
    } else {
            $test = textFilter(strip_tags($_POST['test']));
    }

    if (empty($_POST['dept_id'])) {
        setError("dept_id", "Department is required!");
        $errorStatus = 1;
    } else {
        $department = textFilter(strip_tags($_POST['dept_id']));
    }

    if (!$errorStatus){
        $user_id = $_SESSION['user']['id'];

        $sql = "INSERT INTO test (test_name,dept_id,user_id) VALUES ('$test','$department','$user_id')";

        if(runQuery($sql)){
            $_SESSION['test_create'] = "
            <div class='alert alert-success alert-dismissible fade show'>
            <i class='fa fa-check me-2'></i>
            Test Name Created Successfully!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            redirect("testCreate");
        }
    }

}

function single_test($id){
    $sql = "SELECT * FROM test WHERE id=$id";
    return fetch($sql);
}

function multiple_test(){
    $sql = "SELECT * FROM test";
    return fetchAll($sql);
}

function testDelete($id){
    $sql = "DELETE FROM test WHERE id=$id";
    return runQuery($sql);
}

function testUpdate(){
    $errorStatus = 0;
    $newTest = "";

    if (empty($_POST['test'])) {
        setError("test", "Test name is required!");
        $errorStatus = 1;
    } else {
        if (!preg_match("/^[a-zA-Z' ]*$/", $_POST['test'])) {
            setError('test', "Only letters and white space allowed!");
            $errorStatus = 1;
        } else {
            $newTest = textFilter(strip_tags($_POST['test']));
        }
    }

    if (!$errorStatus){
        $id = $_POST['id'];
        $sql = "UPDATE test SET test_name='$newTest' WHERE id=$id";

        if(runQuery($sql)){
            $_SESSION['test_edit'] = "
            <div class='alert alert-success alert-dismissible fade show'>
            <i class='fa fa-check me-2'></i>
            Test Name Updated Successfully!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            redirect("testCreate");
        }
    }
}

// test type end

// test value start

function testValueAdd(){
    $errorStatus = 0;
    $amount = "";

    if (empty($_POST['amount'])){
        setError("amount", "Test Value is required!");
        $errorStatus = 1;
    }else{

        $amount = textFilter($_POST['amount']);
    }

    if (empty($_POST['test_id'])){
        setError("test_id", "Test Type is required!");
        $errorStatus = 1;
    }else{
        $test_id = textFilter($_POST['test_id']);
    }

    if (empty($_POST['dept_id'])) {
        setError("dept_id", "Department is required!");
        $errorStatus = 1;
    } else {
        $department = textFilter(strip_tags($_POST['dept_id']));
    }

    if (!$errorStatus){
        $user_id = $_SESSION['user']['id'];

        $sql = "INSERT INTO testvalue (amount,user_id,test_id,dept_id) VALUES ('$amount','$user_id','$test_id','$department')";
//        die($sql);

        if(runQuery($sql)){
            $_SESSION['add_value'] = "
            <div class='alert alert-success alert-dismissible fade show'>
            <i class='fa fa-check me-2'></i>
            Test Value Added Successfully!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            redirect("addValue");
        }
    }

}


function result($id){
    $sql = "SELECT * FROM testvalue WHERE id=$id";
    return fetch($sql);
}

function results(){
    $sql = "SELECT * FROM testvalue";
    return fetchAll($sql);
}

function resultDelete($id){
    $sql = "DELETE FROM testvalue WHERE id=$id";
    return runQuery($sql);
}

function resultUpdate(){
    $errorStatus = 0;
    $newAmount = "";

    if (empty($_POST['amount'])){
        setError("amount", "Test Value is required!");
        $errorStatus = 1;
    }else{

        $newAmount = textFilter($_POST['amount']);
    }

    if (!$errorStatus){
        $id = $_POST['id'];
        $test_id = textFilter($_POST['test_id']);

        $sql = "UPDATE testvalue SET amount='$newAmount',test_id='$test_id' WHERE id=$id";
//        die($sql);

        if(runQuery($sql)){
            $_SESSION['update_value'] = "
            <div class='alert alert-success alert-dismissible fade show'>
            <i class='fa fa-check me-2'></i>
            Test Value Updated Successfully!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            redirect("index.php");
        }
    }
}

// test value end

