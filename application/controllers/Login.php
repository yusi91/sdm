<?php
  class Login extends CI_Controller{
    public function __construct(){
      parent::__construct();
      $this->loader();
    }
    //PUBLIC PROPERTY
    public $data;

    //PUBLIC FUNCTION SECTION
    public function index(){
      if($this->input->post("btnSubmit") == "Login" || $this->input->post("flag_firstview") == 1){
        if($this->doLogin()){
          return redirect(base_url()."Home");
        }
        $this->session->set_flashdata("err_msg","Username atau Password Salah.");
      }

      $this->load->view("Login/index",$this->data);
    }

    public function logout(){
      $this->M_Login->setLogoutTime($_SESSION["userinfo"]["username"], $_SESSION["session_id"]);
      $this->session->unset_userdata("userinfo");
      return redirect(base_url());
    }

    public function forgetPassword(){
      $email = $this->input->post("email");
      return redirect("http://app.semenbaturaja.co.id/Mailer/ForgotPasswordCDS.php?email=".$email);
    }

    public function infoForgetPassword(){
      $err_code = $this->input->get("err");
      $this->data["err_code"] = $err_code;
      $this->errMsgForgetPassword($err_code);
      // die();
      $this->load->view("Login/InfoForgetPassword", $this->data);
    }

    //PRIVATE FUNCTION SECTION
    //
    private function doLogin(){
      $data["username"] = $this->input->post("username");
      $data["password"] = $this->input->post("password");

      return $this->M_Login->checkLogin($data);
    }

    private function errMsgForgetPassword($code_error){
      // List Err Message :
      // 0 = Email Berhasil Diganti.
      // 1 = Email Belum Diisi.
      // 2 = Format Email Tidak Valid.
      // 3 = Email Tidak Ditemukan.
      // 4 = Pengiriman Email Gagal.
      $this->data["err_msg"] = "";
      switch ($code_error) {
        case '1':
          $this->data["err_msg"] = "Silahkan Mengisi Email pada Field yang Disediakan.";
          break;
        case '2':
          $this->data["err_msg"] = "Format Email yang Anda Isikan Tidak Valid.";
          break;
        case '3':
          $this->data["err_msg"] = "Email Anda Tidak Terdaftar.";
          break;
        case '4':
          $this->data["err_msg"] = "Maaf, Pengiriman Email Gagal. Silahkan Hubungi Pihak PT Semen Baturaja (Persero) Tbk.";
          break;
        case '5':
          $this->data["err_msg"] = "Password Baru Telah Dikirimkan ke Alamat Email Anda.";
          break;
        default:
          $this->data["err_msg"] = "-";
          break;
      }
    }

    private function loader(){
      $this->load->model("M_Login");
    }
  }
?>
