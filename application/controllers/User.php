<?php
  class User extends ICT_Controller{
    public function __construct(){
      parent::__construct();
      $this->setupMasterPage();
      $this->loader();
    }
    //PUBLIC PROPERTY
    public $data;

    //PUBLIC FUNCTION SECTION
    public function index(){
      $this->setupMasterPage("UserLog","User Log");
      // BEGIN GET DATA
      // $filter = $this->generateFilter();
      // $this->data["filter"] = $filter;
      // $sort = $this->generateSort();
      $this->data["list_of_data"] = null;
      // END GET DATA
      $this->data["list_of_data"] = $this->M_User->getAllDataUser(null, null);

      //$this->createInputView();
      $this->data["Container"] = $this->load->view("User/index",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    public function form_input()
    {
        $input = $this->bindingData();
        $this->data["objData"] = $input;
        $this->data["Container"] = $this->load->view("User/V_Insert",$this->data, true);
        $this->load->view("Shared/master",$this->data);
    }

    public function insert_user()
    {
      $this->data["objData"] = $this->bindingData();
      if($this->input->post("btnSubmit") == "Submit")
      {
        if($this->validateInput($this->data["objData"]))
        {
          $result = $this->M_User->insertData($this->data["objData"]);
          if($result != null)
          {
            return redirect(base_url()."User/index?nik=".$result);
          }
          else
          {
            $this->data["err_msg"] = $_SESSION["err_msg"];
          }
        }
      }
    } 

    
    public function Profile(){
      $this->data["userinfo"] = $this->M_User->getSingleUserInfo($_SESSION["userinfo"]["username"]);
      if(isset($_SESSION["err_msg"])){
        $this->data["err_msg"] = $_SESSION["err_msg"];
      }

      $this->data["Container"] = $this->load->view("User/Profile",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }
    
    public function UserInfo(){
      $this->data["userinfo"] = $_SESSION["userinfo"];

      $this->data["Container"] = $this->load->view("User/UserInfo",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }
    //==================================================================================================================================================
    public function ChangeProfile(){
      $username = $_SESSION["userinfo"]["username"];

      $input = null;
      $will_update = false;
      if($this->input->post("no_hp") != null && $this->input->post("no_hp") != ""){$input["no_hp"] = $this->input->post("no_hp");$will_update = true;}
      if($this->input->post("email") != null && $this->input->post("email") != ""){$input["email"] = $this->input->post("email");$will_update = true;}
      
      if($will_update){
        $this->M_User->updateUserInfo($username, $input);
        $this->reSessionUserinfo();
      }

      return redirect(base_url()."User/Profile");
    }

    public function ChangeAvatar(){
      $username = $_SESSION["userinfo"]["username"];

      if($this->doUpload()){
        $input["photo"] = $this->data["upload_file_name"];
        $this->M_User->updateUserInfo($username, $input);
        $this->reSessionUserinfo();
      }

      redirect(base_url()."User/Profile");
    }

    public function ChangePassword(){
      $username = $_SESSION["userinfo"]["username"];

      if($this->validateInput()){
        $input["password"] = $this->input->post("new_pass");
        $this->M_User->updateUserInfo($username, $input);
        $this->reSessionUserinfo();
      }

      redirect(base_url()."User/Profile");
    }

    //==================================================================================================================================================

    public function usertes(){
      $this->load->view("User/__user");
    }

    //PRIVATE FUNCTION SECTION

    private function bindingData(){
      $objData["nik"] = $this->input->post("nik");
      $objData["nama"] = $this->input->post("nama");
      $objData["level_jabatan"] = $this->input->post("level_jabatan");
      $objData["nama_jabatan"] = $this->input->post("nama_jabatan");
      $objData["nik_atl"] = $this->input->post("nik_atl");
      $objData["nama_atl"] = $this->input->post("nama_atl");
      $objData["nik_attl"] = $this->input->post("nik_attl");
      $objData["nama_attl"] = $this->input->post("nama_attl");
      $objData["unit_kerja"] = $this->input->post("unit_kerja");

      return $objData;
    }

    private function setupMasterPage(){
      $this->data["HeadMenu"] = "Home";
      $this->data["Menu"] = "";
      $this->data["HeadBreadCrumb"] = "";
      $this->data["Title"] = "Master User";
    }

    private function reSessionUserinfo(){
      $filter["username"] = $_SESSION["userinfo"]["username"];
      $userinfo = $this->M_User->getDataUser($filter);
      $this->session->set_userdata(array("userinfo" => $userinfo));
    }

    private function doUpload(){
      $this->data["upload_file_name"] = null;
      if(empty($_FILES['photo_location']['name'])){
        return true;
      }

      $path = dirname($_SERVER["SCRIPT_FILENAME"])."/upload_path/Avatar/";
      $config['upload_path']          = $path;
      $config['allowed_types']        = 'jpeg|jpg|png';
      $config['max_size']             = 2048;
      $config['max_width']            = 1920;
      $config['max_height']           = 1080;
      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('photo_location')){
        $error = array('error' => $this->upload->display_errors());
        $this->session->set_flashdata("err_msg", $error);
        return false;
      }
      else{
        $data = array('upload_data' => $this->upload->data());
        $this->data["upload_file_name"] = $data["upload_data"]["file_name"];
        return true;
      }
    }

    private function validateInput(){
      $no_error = true;
      $err_msg = null;
      
      if($this->input->post("old_pass") != trim($_SESSION["userinfo"]["password"])){
        $err_msg[] = "Wrong Current Password.";
        $no_error = false;
      }

      if($this->input->post("new_pass") != $this->input->post("conf_pass") ){
        $err_msg[] = "New Password and Confirmation Password is Different.";
        $no_error = false;
      }
      $this->session->set_flashdata("err_msg", $err_msg);
      // $this->data["err_msg"] = $err_msg;
      return $no_error;
    }

    private function loader(){
      $this->load->model("M_User");
    }

    
  }
?>
