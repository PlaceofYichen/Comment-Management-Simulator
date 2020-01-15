
<?php

 class Customer_Controller{ 

    /**
     * 此方法为route.php默认调用
     * 
     * @param array $getVars 传入到index.php的GET变量数组 
     */ 
     public function main($getVars) {
         include ('lib/common_user.php');
        switch ($getVars['a'])
        {
            case "login":
                $this->check_user($getVars);
                break;
            case "logout":
            	$this->quit();
            	break;
            case "articles":
                $this->get_list($getVars);
                break;
            default:
                echo "404";
        }

     }

     private function check_user($getVars) {

        if(!isset($_POST["submit"])) {
            $view = new View_Model('show/customer_login');
            $view->assign('is_login' , CheckCustomerLogin());
        }

        else {
            $model = new Customer_Model();
           
            $name = $_POST['n'];
            $pwd = $_POST['p'];

            if (empty($name) || empty($pwd)) {
                $aid = 0;
            } else {
                $rows = $model->get_login($name, $pwd);

                if (empty($rows)) {
                    $aid = 0;
                } else {
                    $aid = $rows['id'];
                    $_SESSION[SESSION_CUSTOMER] = $rows;
                }
            }
        
            echo $aid;
        }
     }
     
	private function quit() {
     
		/*
		session_destroy();      //第一步：删除服务器端   
		setcookie(session_name(), '', time()-3600);     //第二步：删除实际的session    
		$_SESSION = array();          //第三步：删除$_SESSION全部变量数组
     	*/

        unset($_SESSION[SESSION_ADMIN]);

		header("Location: index.php?c=admin&a=login");
	}

     private function get_list($getVars) {
         $model = new Article_Model;
         $search_para = array(
             'author_id' => $_SESSION[SESSION_CUSTOMER]['id'],
         );
         $list = $model->get_list($search_para);

         //创建一个视图，并传入该控制器的template变量
         $view = new View_Model('show/customer_article');

         $is_login = CheckCustomerLogin();
         if(!$is_login) {
             header('Location: index.php?c=customer&a=login');
             exit;
         }
         $view->assign('is_login' , $is_login);

         //把数据赋给视图模板
         $view->assign('list' , $list);
         $view->assign('search_para' , $search_para);
     }
}

