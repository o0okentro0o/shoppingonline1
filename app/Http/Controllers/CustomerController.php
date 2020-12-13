<?php
namespace App\Http\Controllers;

use App\Models\CategoryDAO;
use App\Models\ProductDAO;
use App\Utils\MyUtil;
use App\Utils\EmailUtil;
use App\Models\CustomerDAO;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\COrderDAO;
use App\Models\OrderDetailDAO;

class CustomerController extends Controller {
  public function home() {
    $cates = CategoryDAO::selectAll();
    $newprods = ProductDAO::selectTopNew(3);
    $hotprods = ProductDAO::selectTopHot(3);
    $data = array('cates' => $cates, 'newprods' => $newprods, 'hotprods' => $hotprods);
    return view('customer/home', $data);
  }
  public function listproduct() {
    $cates = CategoryDAO::selectAll();
    $cateid = $_GET['cateid'];
    $prods = ProductDAO::selectByCateID($cateid);
    $data = array('cates' => $cates, 'prods' => $prods);
    return view('customer/listproduct', $data);
  } 
  public function search() {
    $cates = CategoryDAO::selectAll();
    $keyword = $_POST['txtKeyword'];
    $prods = ProductDAO::selectByKeyword($keyword);
    $data = array('cates' => $cates, 'prods' => $prods);
    return view('customer/listproduct', $data);
  }
  public function details() {
    $id = $_GET['id'];
    $prod = ProductDAO::selectByID($id);
    $data = array('prod' => $prod);
    return view('customer/details', $data);
  }
  public function signup() {
    if (isset($_POST['btnSubmit'])) { // POST
      $username = $_POST['txtUsername'];
      $password = $_POST['txtPassword'];
      $name = $_POST['txtName'];
      $phone = $_POST['txtPhone'];
      $email = $_POST['txtEmail'];
      $dbCust = CustomerDAO::selectByUsernameOrEmail($username, $email);
      if ($dbCust != null) {
        MyUtil::showAlertAndRedirect('EXISTS USERNAME OR EMAIL!', 'signup');
      } else {
        $now = round(microtime(true) * 1000); // now in milliseconds
        $token = md5($now);
        $newCust = (object)['ID' => 0, 'Username' => $username, 'Password' => $password, 'Name' => $name, 'Phone' => $phone, 'Email' => $email, 'Active' => 0, 'Token' => $token];
        $newID = CustomerDAO::insert($newCust);
        if ($newID > 0) {
          $subject = 'Signup | Verification';
          $content = 'Thanks for signing up! Please click this link to activate your account:<br/>';
          $content .= 'http://vtam.herokuapp.com/customer/verify?id=' . $newID . '&token=' . $token;
          $result = EmailUtil::send($email, $subject, $content);
          if ($result) {
            MyUtil::showAlertAndRedirect('CHECK EMAIL!', 'login');
          } else {
            MyUtil::showAlertAndRedirect('EMAIL FAILURE!', 'signup');
          }
        } else {
          MyUtil::showAlertAndRedirect('INSERT FAILURE!', 'signup');
        }
      }
    } else { // GET
      return view('customer/signup');
    }
  }
  public function verify() {
    $id = $_GET['id'];
    $token = $_GET['token'];
    $result = CustomerDAO::active($id, $token, 1);
    if ($result) {
      MyUtil::showAlertAndRedirect('OK BABY!', 'login');
    } else {
      MyUtil::showAlertAndRedirect('SORRY BABY!', 'signup');
    }
  }
  public function login() {
    if (isset($_POST['btnSubmit'])) { // POST
      $username = $_POST['txtUsername'];
      $password = $_POST['txtPassword'];
      $cust = CustomerDAO::selectByUsernameAndPassword($username, $password);
      if ($cust != null && $cust->Active == 1) {
        Session::put('customer', $cust);
        return redirect('customer/home');
      } else {
        MyUtil::showAlertAndRedirect('SORRY BABY!', 'login');
      }
    } else { // GET
      return view('customer/login');
    }
  }
  public function logout() {
    Session::forget('customer');
    return redirect('customer/home');
  }
  public function myprofile() {
    if (isset($_POST['btnSubmit'])) { // POST
      if (Session::get('customer') != null) {
        $curCust = Session::get('customer');
        $username = $_POST['txtUsername'];
        $password = $_POST['txtPassword'];
        $name = $_POST['txtName'];
        $phone = $_POST['txtPhone'];
        $email = $_POST['txtEmail'];
        $newCust = (object)['ID' => $curCust->ID, 'Username' => $username, 'Password' => $password, 'Name' => $name, 'Phone' => $phone, 'Email' => $email, 'Active' => $curCust->Active, 'Token' => $curCust->Token];
        $result = CustomerDAO::update($newCust);
        if ($result) {
          Session::put('customer', $newCust);
          MyUtil::showAlertAndRedirect('OK BABY!', 'home');
        }
      }
      MyUtil::showAlertAndRedirect('SORRY BABY!', 'myprofile');
    } else { // GET
      return view('customer/myprofile');
    }
  }
  public function add2cart() {
    $id = $_POST['txtID'];
    $quantity = $_POST['txtQuantity'];
    $prod = ProductDAO::selectByID($id);
    if ($prod != null) {
      $item = new CartItem($prod, $quantity);
      if (Session::get('mycart') != null) {
        $mycart = Session::get('mycart');
      } else {
        $mycart = new Cart();
      }
      $mycart->addItem($item);
      Session::put('mycart', $mycart);
    }
    return redirect('customer/home');
  }
  public function mycart() {
    if (Session::get('mycart') != null && Session::get('mycart')->getSize() > 0) {
      return view('customer/mycart');
    } else {
      return redirect('customer/home');
    }
  }
  public function remove2cart() {
    $id = $_GET['id'];
    if (Session::get('mycart') != null) {
      $mycart = Session::get('mycart');
      $item = $mycart->getItem($id);
      if ($item != null) {
        $mycart->removeItem($item);
        Session::put('mycart', $mycart);
      }
    }
    return redirect('customer/mycart');
  }
  public function checkout() {
    if (Session::get('customer') != null) {
      $cust = Session::get('customer');
      if (Session::get('mycart') != null) {
        $mycart = Session::get('mycart');
        if ($mycart->getSize() > 0) {
          $now = round(microtime(true) * 1000); // now in milliseconds
          $order = (object)['ID' => 0, 'CDate' => $now, 'Total' => $mycart->getTotal(), 'Status' => 'PENDING', 'CustID' => $cust->ID];
          $orderid = COrderDAO::insert($order);
          if ($orderid > 0) {
            foreach ($mycart->items as $item) {
              $odetail = (object)['OrderID' => $orderid, 'ProdID' => $item->product->ID, 'Quantity' => $item->quantity];
              OrderDetailDAO::insert($odetail);
            }
            Session::forget('mycart');
          }
        }
      }
      MyUtil::showAlertAndRedirect('OK BABY!', 'home');
    } else {
      return redirect('customer/login');
    }
  }
  public function myorders() {
    if (Session::get('customer') != null) {
      $cust = Session::get('customer');
      $orders = COrderDAO::selectByCustID($cust->ID);
      $data = array('orders' => $orders);
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $odetails = OrderDetailDAO::selectByOrderID($id);
        $data += array('odetails' => $odetails);
      }
      return view('customer/myorders', $data);
    } else {
      return redirect('customer/home');
    }
  }
}
?>