
<?php

 class Home_Controller{ 
 	
    /**
     * 此方法为route.php默认调用
     * 
     * @param array $getVars 传入到index.php的GET变量数组 
     */ 
     public function main($getVars) {
     	include ('lib/common_user.php');
        switch ($getVars['a'])
        {
            case "index":
                $this->get_index($getVars);
                break;
            default:
                echo "404";
        }
     }

     private function get_index($getVars) {
        //创建一个视图，并传入该控制器的template变量
        $view = new View_Model('show/home'); 

        //$model_pro = new Product_Model;
        //$list_pro = $model_pro->get_list(0, 7);
        
        //把数据赋给视图模板
        $view->assign('list_pro' , $list_pro);
        $view->assign('is_login' , CheckUserLogin());
     }
     

     private function get_about() {
     	//创建一个视图，并传入该控制器的template变量
     	$view = new View_Model('show/about');
     
     	//把数据赋给视图模板
     	$view->assign('is_login' , CheckUserLogin());
     }
     
}

?>