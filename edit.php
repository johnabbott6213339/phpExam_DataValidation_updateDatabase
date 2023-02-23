<?php 
//Database Connection
include('dbconnection.php');
function duplicatecode($newcode, $con)
{
    $query = "SELECT (code)  FROM course where code='$newcode';";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 0) {
        return 0;
    } else {
        return 1;
    }
}


$code_err = $title_err = $semester_err = $year_err = $credits_err = $teachers_err = "";

$code = $title = $sesmester = $year = $credits = $teachers = "";
$login_err = "";



if(isset($_POST['submit'])) {
   // $oldid=$_GET['editid'];
    //Getting Post Values
    //echo "editid=" . $code = $_GET['editid'];

    $oldcode = $_GET['editid'];



    //get data from database
    $title = $_POST['title'];
    $semester = $_POST['semester'];

    $year = $_POST['year'];
    $credits = $_POST['credits'];
    $teachers = $_POST['teachers'];



    if (empty(trim($_POST["teachers"]))) {
        $teachers_err = "Please enter teachers.";
    } elseif (!preg_match('/^[A-Z][a-z]*(\s[A-Z][a-z]*)*$/', trim($_POST["teachers"]))) {
        $teachers_err = "Please input right teacher to meet regex ";
    } else {
        $teachers = trim($_POST["teachers"]);
    }

//333333333333333333333333333
    if (empty(trim($_POST["code"]))) {
        $code_err = "Please enter code.";
    } elseif (!preg_match('/[0-9]+/', trim($_POST["code"]))) {
        $code_err = "Please input right code to meet regex ";

    }
    elseif (duplicatecode($code, $con)==1) {
        $code_err = "Database code duplicated, Please change another code ";
    }
    else {
        $code = trim($_POST["code"]);
    }


    if (empty(trim($_POST["title"]))) {
        $title_err = "Please enter title .";
    } elseif (!preg_match('/^[a-zA-Z0-9]{1,20}/', trim($_POST["title"]))) {
        $title_err = "Please input right  title to meet regex ";
    } else {
        $surname = trim($_POST["title"]);
    }

    if (empty(trim($_POST["title"]))) {
        $title_err = "Please enter title .";
    } elseif (!preg_match('/^[a-zA-Z0-9]{1,20}/', trim($_POST["title"]))) {
        $title_err = "Please input right  title to meet regex ";
    } else {
        $surname = trim($_POST["title"]);
    }


    if ((empty($code_err)) && (empty($title_err)) && empty($teachers_err)) {


        //Query for data updation
        $query = mysqli_query($con, "update course set code='$code', title='$title',semester='$semester', year='$year', credits='$credits', teachers='$teachers' where code='$oldcode'");

        if ($query) {
            echo "<script>alert('You have successfully update the data');</script>";
            echo "<script type='text/javascript'> document.location ='index.php'; </script>";
        } else {
            echo "<script>alert('Something Went Wrong. Please try again');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>PHP Crud Operation!!</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	color: #fff;
	background: #63738a;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	height: 40px;
	box-shadow: none;
	color: #969fa4;
}
.form-control:focus {
	border-color: #5cb85c;
}
.form-control, .btn {        
	border-radius: 3px;
}
.signup-form {
	width: 450px;
	margin: 0 auto;
	padding: 30px 0;
  	font-size: 15px;
}
.signup-form h2 {
	color: #636363;
	margin: 0 0 15px;
	position: relative;
	text-align: center;
}
.signup-form h2:before, .signup-form h2:after {
	content: "";
	height: 2px;
	width: 30%;
	background: #d4d4d4;
	position: absolute;
	top: 50%;
	z-index: 2;
}	
.signup-form h2:before {
	left: 0;
}
.signup-form h2:after {
	right: 0;
}
.signup-form .hint-text {
	color: #999;
	margin-bottom: 30px;
	text-align: center;
}
.signup-form form {
	color: #999;
	border-radius: 3px;
	margin-bottom: 15px;
	background: #f2f3f7;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form input[type="checkbox"] {
	margin-top: 3px;
}
.signup-form .btn {        
	font-size: 16px;
	font-weight: bold;		
	min-width: 140px;
	outline: none !important;
}
.signup-form .row div:first-child {
	padding-right: 10px;
}
.signup-form .row div:last-child {
	padding-left: 10px;
}    	
.signup-form a {
	color: #fff;
	text-decoration: underline;
}
.signup-form a:hover {
	text-decoration: none;
}
.signup-form form a {
	color: #5cb85c;
	text-decoration: none;
}	
.signup-form form a:hover {
	text-decoration: underline;
}  
</style>
</head>
<body>
<div class="signup-form">
    <form  method="POST">
 <?php
$oldid=$_GET['editid'];
$ret=mysqli_query($con,"select * from course where code='$oldid'");
while ($row=mysqli_fetch_array($ret)) {
 echo "code".$row['code']."<br>";
 echo "title".$row['title']."<br>";

 echo "semester".$row['semester']."<br>";
 echo "year".$row['year']."<br>";
 echo "credits".$row['credits']."<br>";

 echo "teachers".$row['teachers']."<br>";


?>
		<h2>Update </h2>
		<p class="hint-text">Update your info.</p>

    <div class="form-group">
        <div class="row">
            <label> Code</label>
            <input type="text" name="code"
                   class="form-control <?php echo (!empty($code_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $row['code']? $row['code']: $code; ?>" />
            <span class="invalid-feedback"><?php echo $code_err; ?></span>

        </div>
    </div>
        <div class="form-group">
            <div class="row">
            <label> Title</label>
            <input type="text" name="title"
                   class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $row['title']? $row['title']: $code; ?>" />
            <span class="invalid-feedback"><?php echo $title_err; ?></span>
        </div>
        </div>

        <div class="form-group">
            <div class="row">
                <?php
                $season['fall']=$season['winter']=$season['summer']="";
                $semester_value=$row['semester'];
                $season["$semester_value"]="checked";
                ?>

                <label>
                    <input type="radio" name="semester" value="fall" <?php echo $season['fall']; ?> >
                    Fall
                </label>
                <label>
                    <input type="radio" name="semester" value="winter"  <?php echo $season['winter']; ?> >
                    Winter
                </label>
                <label>
                    <input type="radio" name="semester" value="summer"  <?php echo $season['summer']; ?> >
                    Summer
                </label>


                <!--maxlength="10" pattern="[0-9]+"> -->
            </div>
        </div>
        <div class="form-group">
            <?php
            $season['2021']=$season['2022']=$season['2023']="";
            $year_value=$row['year'];
            $season["$year_value"]="selected";
            ?>




            <label for="year">Year: </label>
            <select name="year" id="year">
                <option value="2021" <?php echo $season['2021']?>>2021</option>
                <option value="2022" <?php echo $season['2022']?>>2022</option>
                <option value="2023" <?php echo $season['2023']?>>2023</option>
            </select>


        </div>

        <div class="form-group">

            <label for="credits">Credits：</label>
            <select name="credits" id="credits">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>

        </div>


        <div class="row">
            <label> Teacher</label>
            <input type="text" name="teachers"
                   class="form-control <?php echo (!empty($teachers_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $row['teachers']? $row['teachers']: $teachers; ?>" />
            <span class="invalid-feedback"><?php echo $teachers_err; ?></span>

        </div>


<hr>



        <div class="form-group">
      <?php 
}?>
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Update</button>
        </div>
    </form>

</div>
</body>
</html>