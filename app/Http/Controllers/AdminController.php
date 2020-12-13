<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Utils\MyUtil;
use App\Models\AdminDAO;
use App\Models\CategoryDAO;
use App\Models\ProductDAO;
use App\Models\COrderDAO;
use App\Models\OrderDetailDAO;
use App\Models\CustomerDAO;
use App\Utils\EmailUtil;

class AdminController extends Controller
{
  public function home()
  {
    if (Session::get('admin') != null) {
      return view('admin/home');
    } else {
      return redirect('admin/login');
    }
  }
  public function login()
  {
    if (isset($_POST['btnSubmit'])) { // POST
      $username = $_POST['txtUsername'];
      $password = $_POST['txtPassword'];
      $admin = AdminDAO::selectByUsername($username);
      if ($admin != null && $admin->Password == $password) {
        Session::put('admin', $admin);
        return redirect('admin/home');
      } else {
        MyUtil::showAlertAndRedirect('SORRY BABY!', 'login');
      }
    } else { // GET
      return view('admin/login');
    }
  }
  public function logout()
  {
    Session::forget('admin');
    return redirect('admin/home');
  }
  public function listcategory()
  {
    $cates = CategoryDAO::selectAll();
    $data = array('cates' => $cates);
    return view('admin/listcategory', $data);
  }
  public function addcategory()
  {
    $name = $_POST['txtName'];
    $cate = (object)['ID' => 0, 'Name' => $name];
    $result = CategoryDAO::insert($cate);
    if ($result) {
      MyUtil::showAlertAndRedirect('OK BABY!', 'listcategory');
    } else {
      MyUtil::showAlertAndRedirect('SORRY BABY!', 'listcategory');
    }
  }
  public function updatecategory()
  {
    $id = $_POST['txtID'];
    $name = $_POST['txtName'];
    $cate = (object)['ID' => $id, 'Name' => $name];
    $result = CategoryDAO::update($cate);
    if ($result) {
      MyUtil::showAlertAndRedirect('OK BABY!', 'listcategory');
    } else {
      MyUtil::showAlertAndRedirect('SORRY BABY!', 'listcategory');
    }
  }
  public function deletecategory()
  {
    $id = $_POST['txtID'];
    $result = CategoryDAO::delete($id);
    if ($result) {
      MyUtil::showAlertAndRedirect('OK BABY!', 'listcategory');
    } else {
      MyUtil::showAlertAndRedirect('SORRY BABY!', 'listcategory');
    }
  }
  public function listproduct()
  {
    $cates = CategoryDAO::selectAll();
    $prods = ProductDAO::selectAll();
    $data = array('cates' => $cates, 'prods' => $prods);
    return view('admin/listproduct', $data);
  }
  public function addproduct()
  {
    $name = $_POST['txtName'];
    $price = $_POST['txtPrice'];
    $catid = $_POST['cmbCategory'];
    $file = $_FILES['fileImage'];
    if ($file['name'] != '') {
      $image = base64_encode(file_get_contents($file['tmp_name']));
      $cdate = round(microtime(true) * 1000); // now in milliseconds
      $prod = (object)['ID' => 0, 'Name' => $name, 'Price' => $price, 'Image' => $image, 'CDate' => $cdate, 'CatID' => $catid];
      $result = ProductDAO::insert($prod);
      if ($result) {
        MyUtil::showAlertAndRedirect('OK BABY!', 'listproduct');
      }
    }
    MyUtil::showAlertAndRedirect('SORRY BABY!', 'listproduct');
  }
  public function updateproduct()
  {
    $id = $_POST['txtID'];
    $name = $_POST['txtName'];
    $price = $_POST['txtPrice'];
    $catid = $_POST['cmbCategory'];
    $file = $_FILES['fileImage'];
    if ($file['name'] != '') {
      $image = base64_encode(file_get_contents($file['tmp_name']));
    } else {
      $dbProd = ProductDAO::selectByID($id);
      $image = $dbProd->Image;
    }
    $cdate = round(microtime(true) * 1000); // now in milliseconds
    $prod = (object)['ID' => $id, 'Name' => $name, 'Price' => $price, 'Image' => $image, 'CDate' => $cdate, 'CatID' => $catid];
    $result = ProductDAO::update($prod);
    if ($result) {
      MyUtil::showAlertAndRedirect('OK BABY!', 'listproduct');
    } else {
      MyUtil::showAlertAndRedirect('SORRY BABY!', 'listproduct');
    }
  }
  public function deleteproduct()
  {
    $id = $_POST['txtID'];
    $result = ProductDAO::delete($id);
    if ($result) {
      MyUtil::showAlertAndRedirect('OK BABY!', 'listproduct');
    } else {
      MyUtil::showAlertAndRedirect('SORRY BABY!', 'listproduct');
    }
  }
  public function listorder() {
    $orders = COrderDAO::selectAll();
    $data = array('orders' => $orders);
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $odetails = OrderDetailDAO::selectByOrderID($id);
      $data += array('odetails' => $odetails);
    }
    return view('admin/listorder', $data);
  }
  public function updatestatus() {
    $id = $_GET['id'];
    $status = $_GET['status'];
    COrderDAO::update($id, $status);
    return redirect('admin/listorder?id=' . $id);
  }
  public function listcustomer() {
    $custs = CustomerDAO::selectAll();
    $data = array('custs' => $custs);
    if (isset($_GET['cid'])) {
      $cid = $_GET['cid'];
      $orders = COrderDAO::selectByCustID($cid);
      $data += array('orders' => $orders);
      if (isset($_GET['oid'])) {
        $oid = $_GET['oid'];
        $odetails = OrderDetailDAO::selectByOrderID($oid);
        $data += array('odetails' => $odetails);
      }
    }
    return view('admin/listcustomer', $data);
  }
  public function deactive() {
    $id = $_GET['id'];
    $token = $_GET['token'];
    $result = CustomerDAO::active($id, $token, 0);
    if ($result) {
      MyUtil::showAlertAndRedirect('OK BABY!', 'listcustomer');
    } else {
      MyUtil::showAlertAndRedirect('SORRY BABY!', 'listcustomer');
    }
  }
  public function sendmail() {
    $id = $_GET['id'];
    $cust = CustomerDAO::selectByID($id);
    if ($cust != null) {
      $subject = 'Signup | Verification';
      $content = 'Thanks for signing up! Please click this link to activate your account:<br/>';
      $content .= 'http://vtam.herokuapp.com/customer/verify?id=' . $cust->ID . '&token=' . $cust->Token;
      $result = EmailUtil::send($cust->Email, $subject, $content);
      if ($result) {
        MyUtil::showAlertAndRedirect('CHECK EMAIL!', 'listcustomer');
      } else {
        MyUtil::showAlertAndRedirect('EMAIL FAILURE!', 'listcustomer');
      }
    } else {
      return redirect('admin/listcustomer');
    }
  }
}
