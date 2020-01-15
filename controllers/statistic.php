
<?php

 class Statistic_Controller{
 	
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

     private function get_index($getVars)
     {
         //创建一个视图，并传入该控制器的template变量
         $view = new View_Model('show/statistic_list');

         $model = new Statistic_Model;
         $list_1 = $model->get_1();
         $list_2 = $model->get_2();
         $list_3 = $model->get_3();
         $list_4 = $model->get_4();
         $list_5 = $model->get_5();
         $list_6 = $model->get_6();
         $list_7 = $model->get_7();

         //把数据赋给视图模板
         $view->assign('list_1', $list_1);
         $view->assign('list_2', $list_2);
         $view->assign('list_3', $list_3);
         $view->assign('list_4', $list_4);
         $view->assign('list_5', $list_5);
         $view->assign('list_6', $list_6);
         $view->assign('list_7', $list_7);
     }
     

     private function get_about() {
     	//创建一个视图，并传入该控制器的template变量
     	$view = new View_Model('show/about');
     
     	//把数据赋给视图模板
     	$view->assign('is_login' , CheckUserLogin());
     }
     
}

?>