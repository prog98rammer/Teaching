<html>
<head>
    <title>New Student</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script>
        var xmlhttp=new XMLHttpRequest();
        var url='index.php';
        xmlhttp.open('POST',url,true);
        xmlhttp.send();
    </script>
</head>
<body>
<form method="post">
<input type="text" class="form-group" name="student" placeholder="اسم الطالب"><br>
<input type="text" class="form-group" name="stage" placeholder="المرحلة "><br>
<input type="text" class="form-group" name="lesson" placeholder="المادة"><br>
<input type="text" class="form-group" name="teacher" placeholder="اسم المدرس"><br>
<button type="submit" name="sub" class="btn-secondary">حفــظ</button>
</form>


    <?php
        require_once "includs/Classes.php";
        if (isset($_POST['sub']))
        {
            $setStudent=new setStudents($_POST['student'],$_POST['stage'],$_POST['lesson'],$_POST['teacher']);
        }
        $mange=new mangeStudents();
        if (isset($_POST['del']))
        {
            $mange->DeleteStudent($_POST['id']);
        }
    ?>
<form method="post">
    <input type="text" class="form-group" name="stagese" placeholder="المرحلة "><br>
    <input type="text" class="form-group" name="lessonse" placeholder="المادة"><br>
    <input type="text" class="form-group" name="teacherse" placeholder="اسم المدرس"><br>
    <button type="submit" name="submit" class="btn-secondary">بحث</button>
</form>
<?php
if (isset($_POST['submit']))
{
    $se=new Search($_POST['lessonse'],$_POST['stagese'],$_POST['teacherse']);
}
?>
</body>
</html>
