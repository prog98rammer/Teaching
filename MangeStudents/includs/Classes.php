<?php
require_once "db.php";
abstract class functions
{
    function Filter ($Input)
    {
        if (filter_var($Input,FILTER_VALIDATE_INT) == true)
        {
            $Filterd=filter_var($Input,FILTER_SANITIZE_NUMBER_INT);
            return $Filterd;
        }
        elseif (filter_var($Input,FILTER_VALIDATE_EMAIL) == true)
        {
            $Filterd=filter_var($Input,FILTER_SANITIZE_EMAIL);
            return $Filterd;
        }
        elseif (filter_var($Input,FILTER_VALIDATE_FLOAT) == true)
        {
            $Filterd=filter_var($Input,FILTER_SANITIZE_NUMBER_FLOAT);
            return $Filterd;
        }
        else
        {
            $Filterd=filter_var($Input,FILTER_SANITIZE_STRING);
            return $Filterd;
        }
    }
    function ShowError($Error)
    {
        $e="<p style='color: red'>".$Error."</p>";
        return $e;
    }
    function ShowSec($Sec)
    {
        $s="<p style='color: green'> ".$Sec."</p>";
        return $s;
    }
}
class setStudents extends functions
{

    function __construct($Student_name, $stage, $lesson, $teacher_name)
    {
        $FStudent = $this->Filter($Student_name);
        $Fstage = $this->Filter($stage);
        $Flesson = $this->Filter($lesson);
        $Fteacher = $this->Filter($teacher_name);
        if (!empty($FStudent) && !empty($Fstage) && !empty($Flesson) && !empty($Fteacher)) {
            $db = new Database();
            $con = $db->PDO();
            $q = "SELECT * FROM `student` where `student_name` = '$FStudent' AND `lesson` = '$Flesson'";
            $res = $db->getData($con, $q, [
                $FStudent,
                $Flesson
            ]);
            if (count($res) > 0) {
                echo $this->ShowError("الطالب مسجل في هذه المادة مسبقا");
            } else {
                $q = "INSERT INTO `student`( `student_name`, `stage`, `lesson`, `teacher_name`) VALUES (?,?,?,?)";
                $res = $db->setData($con, $q, [
                    $FStudent,
                    $Fstage,
                    $Flesson,
                    $Fteacher
                ]);
                if (count($res) > 0) {
                    echo $this->ShowSec("تم تسجيل البيانات");
                } else {
                    $this->ShowError("خطا");
                }
            }
        }
    }
}
class mangeStudents extends functions
{
    function __construct()
    {
        $db=new Database();
        $con=$db->PDO();
        $q="SELECT * FROM `student`";
        $res=$db->getData($con,$q);
        if (count($res)>0)
        {
            echo "<table class='table' style='table-layout: auto;border: 2px black solid'>
<tr style='background: yellow;border-collapse: collapse;border: 2px black solid'>
<th>
الطالب
</th>
<th>المرحلة</th>
<th>المادة</th>
<th>اسم المدرس</th>
<th>Action</th>
</tr>";
            foreach ($res as  $value)
            {
                echo "<tr style='background: orangered;column-count: auto'>";
                echo "<td>".$value['student_name']."</td>";
                echo "<td>".$value['stage']."</td>";
                echo "<td>".$value['lesson']."</td>";
                echo "<td>".$value['teacher_name']."</td>";
                $id=$value['id'];
                echo "<td >
<form method='post'>
<input type='hidden' name='id' class='form-group' value='$id'>
<input type='submit' name='del' value='حذف' class='btn-danger'>
<button type='submit'  class='btn-dark'><a style='text-decoration: none' href='edit.php?id=$id'>تعديل المعلومات</a></button>
</form>
</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else
        {
            echo $this->ShowError("لا يوجد طلاب");
        }
    }
    function DeleteStudent ($id)
    {
        $Fid=$this->Filter($id);
        if (!empty($Fid))
        {
            $db=new Database();
            $con=$db->PDO();
            $q="DELETE FROM `student` WHERE `id` = ?";
           $res=$db->setData($con,$q,array($Fid));
           if (count($res)>0)
           {
               echo $this->ShowSec("تم الحذف");
           }
        }else
        {
            echo $this->ShowError("فشل ");
        }
    }
}
class editStudent extends functions
{
    /**
     * editStudent constructor.
     * @param $id
     */
    function __construct ($id)
    {
        $Fid=$this->Filter($id);
        if (!empty($id))
        {
            $db=new Database();
            $conPDO=$db->PDO();
            $sql="SELECT  `student_name`, `stage`, `lesson`, `teacher_name` FROM `student` WHERE `id` = ?";
            $res=$db->getData($conPDO,$sql,array($Fid));
            if (count($res)>0)
            {
                $name=$res[0]['student_name'];
                $stage=$res[0]['stage'];
                $less=$res[0]['lesson'];
                $teacher=$res[0]['teacher_name'];
                echo "<form method='post'>
<input type='text' name='stu' value='$name' class='form-group'><br>
<input type='text' name='stage' value='$stage' class='form-group'><br>
<input type='text' name='lesson' value='$less' class='form-group'><br>
<input type='text' name='teacher' value='$teacher' class='form-group'><br>
<input type='submit' name='sub' class='btn-primary' value='حـــفظ التعديلات'><br>
</form>";
                if (isset($_POST['sub']))
                {
                    $Fname=$this->Filter($_POST['stu']);
                    $Fstage=$this->Filter($_POST['stage']);
                    $Fless=$this->Filter($_POST['lesson']);
                    $Fteacher=$this->Filter($_POST['teacher']);
                    $sql="UPDATE `student` SET `student_name`=?,`stage`=?,`lesson`=?,`teacher_name`=? WHERE `id` = ?";
                    $res=$db->setData($conPDO,$sql,array($Fname,$Fstage,$Fless,$Fteacher,$Fid));
                    if (count($res)>0)
                    {
                        unset($Fname);
                        unset($Fstage);
                        unset($Fless);
                        unset($Fteacher);
                        echo $this->ShowSec("تم تحديث المعلومات");
                    }else
                    {
                        echo $this->ShowError("Failed");
                    }
                }
            }
        }
    }
}
class Search extends functions
{
    function __construct($lesson=null,$stage=null,$teacher=null)
    {
        if ((!empty($this->Filter($lesson))) != null  || (!empty($this->Filter($stage))) != null   || (!empty($this->Filter($teacher))) != null )
        {
         $db=new Database();
         $connectPDO=$db->PDO();
         $stageF=$this->Filter($stage);
         $lessonF=$this->Filter($lesson);
         $teacherF=$this->Filter($teacher);
         $sql="SELECT * FROM `student` WHERE `lesson` LIKE '%$lessonF%' AND `teacher_name` LIKE '%$teacherF%' AND `stage`  LIKE '%$stageF%'";
        $res=$db->getData($connectPDO,$sql,array($lessonF,$teacherF,$stageF));
            if (count($res)>0)
            {
                echo "<table class='table' style='table-layout: auto;border: 2px black solid'>
<tr style='background: yellow;border-collapse: collapse;border: 2px black solid'>
<th>
الطالب
</th>
<th>المرحلة</th>
<th>المادة</th>
<th>اسم المدرس</th>
<th>Action</th>
</tr>";
                foreach ($res as  $value)
                {
                    echo "<tr style='background: orangered;column-count: auto'>";
                    echo "<td>".$value['student_name']."</td>";
                    echo "<td>".$value['stage']."</td>";
                    echo "<td>".$value['lesson']."</td>";
                    echo "<td>".$value['teacher_name']."</td>";
                    $id=$value['id'];
                    echo "<td >
<form method='post'>
<input type='hidden' name='id' class='form-group' value='$id'>
<input type='submit' name='del' value='حذف' class='btn-danger'>
<button type='submit'  class='btn-dark'><a style='text-decoration: none' href='edit.php?id=$id'>تعديل المعلومات</a></button>
</form>
</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }else
            {
                echo $this->ShowError("لايوجد بهكذا معلومات");
            }
        }
    }
}