<?php

class QueryBuilder
{

    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getPosts()
    {
        $sql = "SELECT * FROM posts";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();

        return $result;
    }

    public function getPost($id)
    {
        $sql = "SELECT * FROM posts where id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":id",$id);
        $statement->execute();
        $result = $statement->fetchAll();

        return $result;
    }

    public function create()
    {
        $sql = "insert into posts (title, author, content,favorite, date) values (:title, :author, :content, 0, sysdate())";
        $statement = $this->pdo->prepare($sql);
        $title = $_POST['title'];
        $author = $_POST['author'];
        $content = $_POST['content'];
        $statement->bindParam(":title", $title);
        $statement->bindParam(":author", $author);
        $statement->bindParam(":content", $content);
        $statement->execute();
    }

    public function changeFavorite($id, $val)
    {
        $sql = "update posts set favorite = :val where id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":id",$id);
        $statement->bindParam(":val",$val);
        $statement->execute();
    }

    public function delete($id)
    {
        $sql = "delete from posts where id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
    }


//    public function user()
//    {
//        $sql = "select * FROM USERS where email like :email and password like :pass";
//        $statement = $this->pdo->prepare($sql);
//        $password = md5($_POST['pass']);
//        $statement->bindParam(":email", $_POST['email']);
//        $statement->bindParam(":pass", $password);
//        $statement->execute();
//        $rezult = $statement->fetchAll();
//
//        return $rezult;
//
//    }
//
//    public function verifyEmail()
//    {
//        $sql = "select email from USERS where email = :email";
//        $statement = $this->pdo->prepare($sql);
//        $statement->bindParam(":email", $_POST['ename']);
//        $statement->execute();
//        $name = $statement->fetchAll();
//        //die(var_dump($name));
//        return $name;
//
//    }
//
//    public function register()
//    {
//
//        $sql = "insert into USERS (username, email, password) values (:username, :email, :password)";
//        $statement = $this->pdo->prepare($sql);
//        $password = md5($_POST['pname']);
//        $statement->bindParam(":username", $_POST['uname']);
//        $statement->bindParam(":email", $_POST['ename']);
//        $statement->bindParam(":password", $password);
//        $statement->execute();
//
//
//    }
//
//    public function loginRegister()
//    {
//        $sql = "select * FROM USERS where email like :email and password like :pass";
//        $statement = $this->pdo->prepare($sql);
//        $password = md5($_POST['pname']);
//        $statement->bindParam(":email", $_POST['ename']);
//        $statement->bindParam(":pass", $password);
//        $statement->execute();
//        $rezult = $statement->fetchAll();
//        return $rezult;
//
//    }
//
////set inactivity to 0
//    public function active($id)
//    {
//        $sql = "update USERS set inactivity = 0 where id = :id";
//        $statement = $this->pdo->prepare($sql);
//        $statement->bindParam(":id",$id);
//        $statement->execute();
//
//    }
//
////admin:
//    public function showUsers()
//    {
//        $sql = "select id,username, email, permission from USERS ";
//        $statement = $this->pdo->prepare($sql);
//        $statement->bindParam(":email", $_POST['ename']);
//        $statement->execute();
//        $name = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//        return $name;
//
//    }
//
////admin: JOIN
//    public function showCars()
//    {
//        $sql = "select CARS.id, name, model, number, username from USERS
//                        JOIN CARS ON CARS.id_user = USERS.id";
//        $statement = $this->pdo->prepare($sql);
//        $statement->execute();
//        $name = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//        return $name;
//
//    }
//
////user:
//    public function showUserCars()
//    {
//        $sql = "select name, model, number from CARS
//                        where id_user like :id";
//        $statement = $this->pdo->prepare($sql);
//        $statement->bindParam(":id", $_SESSION['user'][0][0]);
//        $statement->execute();
//        $name = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//        return $name;
//
//    }
//
////user: JOIN
//    public function showUserRevisions()
//    {
//        $sql = "select CARS.name, CARS.model, CARS.number, REVISIONS.date from REVISIONS
//                        JOIN CARS ON REVISIONS.id_cars = CARS.id
//                        where approve=1 and CARS.id_user = :id
//                        order by date";
//        $statement = $this->pdo->prepare($sql);
//        $statement->bindParam(":id", $_SESSION['user'][0][0]);
//        $statement->execute();
//        $name = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//        return $name;
//
//    }
//
////user: JOIN
//    public function showUserRevisionsUncompleted()
//    {
//        $sql = "select CARS.name, CARS.model, CARS.number, REVISIONS.date, REVISIONS.addRevision, REVISIONS.status from REVISIONS
//                        JOIN CARS ON REVISIONS.id_cars = CARS.id
//                        where approve = 0 and CARS.id_user = :id and DATEDIFF(date,sysdate())>=0
//                        order by date";
//        $statement = $this->pdo->prepare($sql);
//        $statement->bindParam(":id", $_SESSION['user'][0][0]);
//        $statement->execute();
//        $name = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//        return $name;
//
//    }
//
////employee:
//    public function showEmpRevisions()
//    {
//        $sql = "select id, id_cars, DATE_FORMAT(date, '%H:%i:%s') hour, status from REVISIONS
//                        where DATE_FORMAT(date, '%Y %M %D')=DATE_FORMAT(sysdate(), '%Y %M %D') and addRevision=1
//                        order by date";
//        $statement = $this->pdo->prepare($sql);
//        $statement->execute();
//        $name = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//        return $name;
//
//    }
//
////admin: JOIN
//    public function showAdminRevisions()
//    {
//        $sql = "select REVISIONS.id, CARS.name, CARS.model, CARS.number, USERS.username, REVISIONS.date, REVISIONS.status, REVISIONS.approve from REVISIONS
//                        JOIN CARS ON REVISIONS.id_cars = CARS.id
//                        JOIN USERS ON CARS.id_user = USERS.id
//                        where addRevision = 1
//                        order by date";
//        $statement = $this->pdo->prepare($sql);
//        $statement->execute();
//        $name = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//        return $name;
//
//    }
//
////admin: JOIN
//    public function showContainer()
//    {
//        $sql = "select REVISIONS.id, CARS.name, CARS.model, CARS.number, USERS.username, REVISIONS.date, REVISIONS.status, REVISIONS.approve from REVISIONS
//                        JOIN CARS ON REVISIONS.id_cars = CARS.id
//                        JOIN USERS ON CARS.id_user = USERS.id
//                        where addRevision = 0 and DATEDIFF(date,sysdate())>=0
//                        order by date";
//        $statement = $this->pdo->prepare($sql);
//        $statement->execute();
//        $name = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//        return $name;
//
//    }
//
////admin:
//    public function showNrRevision()
//    {
//        $sql = "select USERS.id, USERS.username, USERS.email, count(REVISIONS.id) nr_revision from USERS
//                      JOIN REVISIONS ON USERS.id = REVISIONS.employee_id
//                      where DATE_FORMAT(date, '%Y %M')=DATE_FORMAT(sysdate(), '%Y %M')";
//        $statement = $this->pdo->prepare($sql);
//        $statement->execute();
//        $name = $statement->fetchAll();
//        //die(var_dump($name));
//        return $name;
//    }
//
////user:
//    public function addCar()
//    {
//        $sql = "insert into CARS (name, model, number, id_user) values (:name, :model, :number, :id_user)";
//        $statement = $this->pdo->prepare($sql);
//        // die(var_dump($_SESSION['user'][0][0]));
//        $statement->bindParam(":name", $_POST['carname']);
//        $statement->bindParam(":model", $_POST['carmodel']);
//        $statement->bindParam(":number", $_POST['carnumber']);
//        $statement->bindParam(":id_user", $_SESSION['user'][0][0]);
//        $statement->execute();
//
//    }
//
////verify cars for this->user
//    public function verifycars()
//    {
//
//        $sql = "select * from CARS
//                        where name = :name and model = :model and number=:number and id_user = :id";
//
//        $n = substr($_POST['revisionname'], 0, strpos($_POST['revisionname'], ' '));
//        $m = substr($_POST['revisionname'], strpos($_POST['revisionname'], ' ')+strlen(' '));
//
//        //die(var_dump($_POST['revisionnumber']));
//
//        $statement = $this->pdo->prepare($sql);
//        $statement->bindParam(":name", $n);
//        $statement->bindParam(":model", $m);
//        $statement->bindParam(":number", $_POST['revisionnumber']);
//        $statement->bindParam(":id", $_SESSION['user'][0][0]);
//        $statement->execute();
//        $name = $statement->fetchAll();
//
////        die(var_dump($name));
//
//        return $name;
//
//    }
//
////user:
//    public function getNameModelCar()
//    {
//        $sql = "select id, name, model from CARS
//                        where  id_user like :id";
//        $statement = $this->pdo->prepare($sql);
//        $statement->bindParam(":id", $_SESSION['user'][0][0]);
//        $statement->execute();
//        $name = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//        return $name;
//
//    }
//
////user:
//    public function getNumberCar($id)
//    {
//        $sql="select number from CARS where name=:name and model = :model";
//
//        $name = substr($id, 0, strpos($id, ' '));
//        $model = substr($id, strpos($id, ' ')+strlen(' '));
//
//        $statement = $this->pdo->prepare($sql);
//        $statement->bindParam(":name", $name);
//        $statement->bindParam(":model", $model);
//        $statement->execute();
//        $name = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//        return $name;
//    }
//
////user:
//    public function addRevision()
//    {
//        $sql = "insert into REVISIONS (id_cars, date) values (:id_cars, :date)";
//        $statement = $this->pdo->prepare($sql);
//        $_POST['cardate'].=" ";
//        $_POST['cardate'].=$_POST['hour_revision'];
//        $statement->bindParam(":id_cars", $_SESSION['idcar']);
//        $statement->bindParam(":date", $_POST['cardate']);
//        $statement->execute();
//
//    }
//
////user:
//    public function nrEmployee()
//    {
//        $sql = "select count(id) nr_emp from USERS
//                        where permission = 2";
//        $statement = $this->pdo->prepare($sql);
//        $statement->execute();
//        $name = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//        return $name;
//    }
//
////user:
//    public function revisionHour($id,$hour)
//    {
//        $sql = "select DATE_FORMAT(date, '%H:%i:%s') hour , COUNT(distinct(id)) nr_revision FROM REVISIONS
//                       WHERE DATE_FORMAT(date, '%Y %M %D')=DATE_FORMAT(:date, '%Y %M %D') and DATE_FORMAT(date, '%H:%i:%s') = :hour ";
//        $statement= $this->pdo->prepare($sql);
//        $statement->bindParam(":date",$id);
//        $statement->bindParam(":hour",$hour);
//        $statement->execute();
//        $name = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//        //die(var_dump($name));
//
//        return $name;
//    }
//
////admin:
//    public function approveAddRevision($id)
//    {
//
//        $sql = "update REVISIONS set addRevision = 1
//                        where id = :id";
//        $statement = $this->pdo->prepare($sql);
//        $statement->bindParam(":id", $id);
//        $statement->execute();
//
//    }
//
////admin
//    public function statusRevision($id)
//    {
//        $sql = "select status from REVISIONS
//                        where id = :id";
//        $statement = $this->pdo->prepare($sql);
//        $statement->bindParam(":id", $id);
//        $statement->execute();
//        $name = $statement->fetchAll();
//
//        return $name;
//
//    }
//
////employee:
//    public function finishRevisions($id)
//    {
//        $sql = "update REVISIONS set status = 1, employee_id = :emp
//                        where id = :id";
//        $statement = $this->pdo->prepare($sql);
//        //die(var_dump("sdjhbcfdshbv"));
//        $statement->bindParam(":id", $id);
//        $statement->bindParam(":emp", $_SESSION['id_current_user']);
//        $statement->execute();
//
//    }
//
////admin:
//    public function approveRevision($id)
//    {
//        $sql = "update REVISIONS set approve = 1
//                        where status = 1 and id = :id";
//        $statement = $this->pdo->prepare($sql);
//        $statement->bindParam(":id", $id);
//        $statement->execute();
//
//    }
//
////admin:
//    public function showstatus($id)
//    {
//        $sql = "select status FROM REVISIONS
//                        where id = :id";
//        $statement = $this->pdo->prepare($sql);
//        $statement->bindParam(":id", $id);
//        $statement->execute();
//        $rezult = $statement->fetchAll();
//        return $rezult;
//    }
//
////admin:
//    public function selectUser($id)
//    {
//        $sql = "select id, username, email, permission FROM USERS
//                        where id like :id";
//        $statement = $this->pdo->prepare($sql);
//        $statement->bindParam(":id", $id);
//        $statement->execute();
//        $rezult = $statement->fetchAll();
//        return $rezult;
//
//    }
//
////admin:
//    public function verifyEmailEdit($id)
//    {
//        $sql = "select * FROM USERS where email = :email and id = :id";
//        $statement = $this->pdo->prepare($sql);
//        $statement->bindParam(":email", $_POST['edit_email']);
//        $statement->bindParam(":id", $id);
//        $statement->execute();
//        $rezult = $statement->fetchAll();
//        return $rezult;
//
//    }
//
////admin:
//    public function changeUser($id)
//    {
//        $sql="update USERS set username = :username, email = :email, permission = :permission where id = :id";
//        $statement=$this->pdo->prepare($sql);
//        if($_POST['edit_permission'] == "Admin")
//        {
//            $_POST['edit_permission']=1;
//        }
//        elseif($_POST['edit_permission'] == "Angajat")
//        {$_POST['edit_permission']=2;
//        }
//        else{
//            $_POST['edit_permission']=3;
//        }
//        $statement->bindParam(":username", $_POST['edit_username']);
//        $statement->bindParam(":email", $_POST['edit_email']);
//        $statement->bindParam(":permission", $_POST['edit_permission']);
//        $statement->bindParam(":id", $id);
//        $statement->execute();
//
//    }
//
////send email 7 days: JOIN
//    public function email7days()
//    {
//        $sql = "select USERS.email  from REVISIONS
//                        JOIN CARS ON REVISIONS.id_cars = CARS.id
//                        JOIN USERS ON CARS.id_user = USERS.id
//                        where  DATEDIFF(date,sysdate())=7";
//        $statement = $this->pdo->prepare($sql);
//        $statement->execute();
//        $name = $statement->fetchAll();
//        return $name;
//
//    }
//
////send email 1 day: JOIN
//    public function email1day()
//    {
//        $sql = "select USERS.email  from REVISIONS
//                        JOIN CARS ON REVISIONS.id_cars = CARS.id
//                        JOIN USERS ON CARS.id_user = USERS.id
//                        where  DATEDIFF(date,sysdate())=1";
//        $statement = $this->pdo->prepare($sql);
//        $statement->execute();
//        $name = $statement->fetchAll();
//
//        return $name;
//
//    }
//
////send email inactivity 90
//    public function inactivity90()
//    {
//        $sql="select email from USERS where inactivity = 90";
//        $statement = $this->pdo->prepare($sql);
//        $statement->execute();
//        $name = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//        return $name;
//    }
//
////delete account inactivity 100
//    public function inactivity100()
//    {
//        $sql="delete from USERS where inactivity >= 100";
//        $statement = $this->pdo->prepare($sql);
//        $statement->execute();
//
//    }
//
////increase inactivity
//    public function increaseInactivity()
//    {
//        $sql="update USERS set inactivity = inactivity+1";
//        $statement = $this->pdo->prepare($sql);
//        $statement->execute();
//
//    }

}