
<?php

 class User_Controller{ 

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
            case "index":
                $this->index();
                break;
            case "logout":
            	$this->quit();
            	break;
            case "register":
            	$this->add_user($getVars);
            	break;
            case "update":
            	$this->update_user($getVars);
            	break;
            default:
                echo "404";
        }

     }

     private function index() {
         $info = $_SESSION[SESSION_USER];

         /*
       	 获取所有查询参数
        */
         $search_para = array(
             //'fn' => !empty($getVars['fn'])? $getVars['fn'] : ""
         );

         $model = new Article_Model;
         $list = $model->get_list($search_para);

         //创建一个视图，并传入该控制器的template变量
         $view = new View_Model('show/user_index');

         //把数据赋给视图模板
         $view->assign('list' , $list);
         $view->assign('search_para' , $search_para);
         $view->assign('login_info' , $info);

     }

     private function check_user($getVars) {

        if(!isset($_POST["submit"])) {
            $view = new View_Model('show/user_login');
            $view->assign('is_login' , CheckUserLogin());
        }

        else {
            $model = new User_Model;
           
            $name = $_POST['n'];
            $pwd = $_POST['p'];

            if (empty($name) || empty($pwd)) {
                $uid = 0;
            } else {
                $row = $model->get_login($name, $pwd);

                if (empty($row)) {
                    $uid = 0;
                } else {
                	$uid = $row['id'];
                    $_SESSION[SESSION_USER] = $row;
                }
            }
        
            echo $uid;
        }
     }
     
     private function add_user($getVars) {
     
     	if(!isset($_POST["submit"])) {
     		$view = new View_Model('show/register');
     		$view->assign('is_login' , CheckUserLogin());
     	}
     
     	else {
	     	$model = new User_Model;
	        
	        $i = !empty($getVars['i'])? $getVars['i'] : 0;
	        
        	$info = $model->get_detail(array('n_e' => $_POST["n"]));
        	//判断用户名是否已被注册
        	if($info != null) {	
        		echo '-1';
        		return;
        	}
        	
        	$_POST['p'] = md5($_POST['p']);
        	$edit = $model->set_info($_POST, $i);
        	var_dump($edit);

     	}
     }
     
     private function update_user($getVars) {

     	$i = $_SESSION[SESSION_USER]['id'];
     	$model = new User_Model;
     	$info = $model->get_detail(array('i' => $i));
     	
     	if(!isset($_POST["submit"])) {
     		$view = new View_Model('show/update');
            $view->assign('info' , $info);
     		$view->assign('is_login' , CheckUserLogin());
     	}
     	 
     	else {    		
     		$post = $_POST;
     		if(empty($post['p'])) {
     			$post['p'] = $info['u_pwd'];
     		}
     		else {
     			$post['p'] = md5($post['p']);
     		}

     		$post['n'] = $info['u_name'];
     		$edit = $model->set_info($post, $i);
     		var_dump($edit);
     
     	}
     }
     
	private function quit() {
		 
		unset($_SESSION[SESSION_USER]);   
		header("Location: /");
	}
     
}

?>