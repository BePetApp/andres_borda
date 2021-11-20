<?php
include_once 'Models/UserModel.php';
include_once 'Models/SessionModel.php';

class Views
{
  public static function View()
  {
    $value = isset($_GET['page']) ? $_GET['page'] : 'Home';

    $view = new Views;
    $view->__call($value);
  }

  public function LogOut()
  {
    UserSession::closeSession();
    header('Location: index.php');
  }


  public function Home()
  {
    session_start();
    if (isset($_POST['Log_Enter']) && !isset($_SESSION['status'])){
      $userSession_ = new UserSession($_POST['Log_Nick'], $_POST['Log_Pass']);
      $userSession_->startSession();
      header('Location: index.php');
    }

    $navBar = UserSession::homeSessionNav();

    include_once 'Views/html/home.php';
  }


  public function Crud()
  {
    $datas = Users::showUsers();
    
    include_once 'Views/html/crud.php';
  }


  public function CrudEdit()
  {
    $datas = Users::showUsers();
    
    include_once 'Views/html/crud.php';
  }


  public function CrudDel()
  {    
    $delUser = new DataBase;
    $delUser->table = 'users';

    $delUser = $delUser->preSelect(['name', 'last_name', 'email'])->where('id', '=' ,$_GET['Id'])->runQuery();
    $delUser = $delUser->fetch_object();

    include_once 'Views/html/crudDelete/delete.php';
  }


  public function CrudDelCon()
  { 
    $del = new Users;
    $del->id = $_GET['Id'];
    
    if ($del->deleteUser() !== false)
      $mess = 'Se eliminó el registro correctamente';
    else
      $mess = 'Hubo un fallo en la eliminación';

    header("Location: index.php?page=Crud&mes=$mess");
  }


  public function CrudAdd()
  {
    $av = new DataBase;
    $av->table = 'avatars';

    $av = $av->preSelect()->runQuery();

    include_once 'Views/html/register.php';
  }

  function __call($name, $arguments = [])
  {
    if (!method_exists($this, $name)) {
      $name = 'Home';
    }
    return $this->$name(...$arguments);
  }
}

