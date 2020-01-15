
<?php

 class CommentLike_Controller{

    /**
     * 此方法为route.php默认调用
     * 
     * @param array $getVars 传入到index.php的GET变量数组 
     */ 
     public function main($getVars) {
        switch ($getVars['a'])
        {
            case "add":
                $this->set_info($getVars);
                break;
            default:
                echo "404";
        }

     }

     private function set_info($getVars) {
                
        $model = new CommentLike_Model;

         $comment_id= !empty($getVars['comment_id'])? $getVars['comment_id'] : 0;

        if(!isset($_POST["submit"])) {

            //创建一个视图，并传入该控制器的template变量 
            $view = new View_Model('show/comment_add');
            
            //把数据赋给视图模板
            $view->assign('comment_id' , $comment_id);
        }

        else {
        	$edit = $model->set_info($_POST);
        	var_dump($edit);
        }
     }
     
}