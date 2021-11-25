<?php
include_once 'Models/UserModel.php';
include_once 'Models/SessionModel.php';
include_once 'Controllers/MessageController.php';
include_once 'Models/AvatarModel.php';

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


  public function home()
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


// ---------------------------- Crud y sus depensencias ----------------------------------

  public function crud()
  {
    session_start();
    if (UserSession::validateSession() === false){
      header('Location: index.php');
    }

    $datas = Users::showUsers();
    
    include_once 'Views/html/crud.php';
    Messages::showMessage();
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
    $udUser->table = 'users';

    $udUser= $udUser->preSelect(['name', 'last_name', 'email', 'nickname'])->where('id', '=', $_GET['Id'])->runQuery();
    $udUser = $udUser->fetch_object();
    
    include_once 'Views/html/crudUpdate/edit.php';
  }


  public function crudEditCon()
  {
    $edit = new Users;

    $edit->id= $_POST['Id'];
    $edit->name = $_POST['name'];
    $edit->last_name= $_POST['lastname'];
    $edit->nickname= $_POST['nick'];
    $edit->email= $_POST['email'];

    if ($edit->updateUser() === true) {
      $mess = 3300;
    } else {
      $mess = 3399;
    }
    header("Location: index.php?page=Crud&mess=$mess");
  }


  public function crudDel()
  {
    $delUser = new DataBase;
    $delUser->table = 'users';

    $delUser = $delUser->preSelect(['name', 'last_name', 'email'])->where('id', '=' ,$_GET['Id'])->runQuery();
    $delUser = $delUser->fetch_object();

    include_once 'Views/html/crudDelete/delete.php';
  }


  public function crudDelCon()
  { 
    $del = new Users;
    $del->id = $_GET['Id'];
    
    if ($del->deleteUser() !== false)
      $mess = 2200;
    else
      $mess = 2299;

    header("Location: index.php?page=Crud&mess=$mess");
  }


  public function crudAdd()
  {
    $av = new DataBase;
    $av->table = 'avatars';

    $av = $av->preSelect()->runQuery();

    include_once 'Views/html/crudCreate/register.php';
    Messages::showMessage();
  }

  public function crudAddCon()
  {
    if ($_POST['Reg_Pass'] === $_POST['Reg_Pass_1']){
      $user = new Users;

      $user->name = $_POST['Reg_name'];
      $user->last_name = $_POST['Reg_apl'];
      $user->nickname = $_POST['Reg_Nick'];
      $user->email = $_POST['Reg_Email'];
      $user->pass = $_POST['Reg_Pass'];
      $user->avatars_id = $_POST['Reg_av'];

      $mess = $user->createUser();
      header("Location: index.php?page=crudAdd&mess=$mess");
    } else {
      header("Location: index.php?page=crudAdd&mess=1111");
    }
  }


  public function crudAv()
  {
    $avatars = Avatars::showAvatars();

    include_once 'Views/html/crudCreate/avatar.php';
    Messages::showMessage();
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
