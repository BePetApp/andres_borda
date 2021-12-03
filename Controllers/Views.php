<?php

namespace Controllers;

use Models\Users;
use Models\UserSession;
use Models\DataBase;
use Models\Avatars;

class Views
{
  public static function view()
  {
    $value = isset($_GET['page']) ? $_GET['page'] : 'Home';

    $view = new Views;
    $view->__call($value);
  }


  public function logOut()
  {
    UserSession::closeSession();
    header('Location: index.php');
  }


  public function logIn()
  {
    session_start();
    $userSession_ = new UserSession($_POST['Log_Nick'], $_POST['Log_Pass']);
    $mess = $userSession_->startSession();
    header("Location: index.php?mess=$mess");
  }


  public function home()
  {
    $navBar = UserSession::homeSessionNav();

    include_once 'Views/html/home.php';
  }


// ---------------------------- Crud y sus dependencias ----------------------------------

  public function crud()
  {
    session_start();
    if (UserSession::validateSession() === 0 || UserSession::validateSession() === 1){
      header('Location: index.php');
    }

    $datas = Users::showUsers();
    
    include_once 'Views/html/crud.php';
  }


  public function crudSearch()
  {
    session_start();
    if (UserSession::validateSession() === false){
      header('Location: index.php');
    }
    $query = new Users;

    $datas = $query->showSearchedUsers($_POST['like']);

    include_once 'Views/html/crud.php';
  }

  public function crudEdit()
  {
    $udUser =  new DataBase;
    $udUser->table = 'Users';
    $udUser= $udUser->preSelect(['name', 'lastName', 'email', 'nickName', 'Avatars_id'])->where('id', '=', $_GET['Id'])->runQuery();
    $udUser = $udUser->fetch_object();

    $av = new DataBase;
    $av->table = 'Avatars';
    $av = $av->preSelect()->runQuery();
    
    include_once 'Views/html/crudUpdate/edit.php';
  }


  public function crudEditCon()
  {
    $edit = new Users;

    $edit->id= $_POST['Id'];
    $edit->name = $_POST['name'];
    $edit->lastName = $_POST['lastname'];
    $edit->nickName = $_POST['nick'];
    $edit->email = $_POST['email'];
    $edit->avatars_id = $_POST['avId'];

    if ($edit->updateUser() === true) {
      $mess = "a40";
    } else {
      $mess = "e409";
    }
    header("Location: index.php?page=Crud&mess=$mess");
  }


  public function crudDel()
  {
    $delUser = new DataBase;
    $delUser->table = 'users';

    $delUser = $delUser->preSelect(['name', 'lastName', 'email'])->where('id', '=' ,$_GET['Id'])->runQuery();
    $delUser = $delUser->fetch_object();

    include_once 'Views/html/crudDelete/delete.php';
  }


  public function crudDelCon()
  { 
    $del = new Users;
    $del->id = $_GET['Id'];
    
    if ($del->deleteUser() !== false)
      $mess = "a30";
    else
      $mess = "e309";

    header("Location: index.php?page=Crud&mess=$mess");
  }


  public function crudAdd()
  {
    $av = new DataBase;
    $av->table = 'Avatars';

    $av = $av->preSelect()->runQuery();

    include_once 'Views/html/crudCreate/register.php';
  }

  public function crudAddCon()
  {
    if ($_POST['Reg_Pass'] === $_POST['Reg_Pass_1']){
      $user = new Users;

      $user->name = $_POST['Reg_name'];
      $user->lastName = $_POST['Reg_apl'];
      $user->nickName = $_POST['Reg_Nick'];
      $user->email = $_POST['Reg_Email'];
      $user->pass = $_POST['Reg_Pass'];
      $user->avatars_id = $_POST['Reg_av'];

      $mess = $user->createUser();
      header("Location: index.php?page=crudAdd&mess=$mess");
    } else {
      header("Location: index.php?page=crudAdd&mess=e100");
    }
  }


  public function crudAv()
  {
    $avatars = Avatars::showAvatars();

    include_once 'Views/html/crudCreate/avatar.php';
  }


  public function crudAvAdd()
  {
    $mess = Avatars::addAvatar();
    header("Location: index.php?page=crudAv&mess=$mess");
  }


  public function crudAvDel()
  {
    $removeAvatar = new Avatars;
    $mess = $removeAvatar->deleteAvatar($_POST['idAvatar']);
    header("Location: index.php?page=crudAv&mess=$mess");
  }

  function __call($name, $arguments = [])
  {
    if (!method_exists($this, $name)) {
      $name = 'Home';
    }
    return $this->$name(...$arguments);
  }
}
