
<?php

 class Comment_Controller{

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
            case "derogatory":
                $this->derogatory();
                break;
            case "flag_list":
                $this->flag_list($getVars);
                break;
            default:
                echo "404";
        }

     }

     private function derogatory()
     {
         $model = new Comment_Model;
         $edit = $model->derogatory($_POST, $_POST['id']);
         var_dump($edit);
     }

     private function set_info($getVars) {
                
        $model = new Comment_Model;

         $article_id = !empty($getVars['article_id'])? $getVars['article_id'] : 0;
         $parent_id = !empty($getVars['parent_id'])? $getVars['parent_id'] : 0;

        if(!isset($_POST["submit"])) {

            //创建一个视图，并传入该控制器的template变量 
            $view = new View_Model('show/comment_add');
            
            //把数据赋给视图模板
            $view->assign('article_id' , $article_id);
            $view->assign('parent_id' , $parent_id);
        }

        else {
        	$edit = $model->set_info($_POST);
        	var_dump($edit);
        }
     }


     private function flag_list($getVars) {
         /*
             获取所有查询参数
         */
         $search_para = array(
             'article_id' => !empty($getVars['article_id'])? $getVars['article_id'] : 0,
             'is_flag' => 1,
             'derogatory' => 'NULL'
         );

         $model = new Comment_Model;
         $list = $model->get_list($search_para);

         //创建一个视图，并传入该控制器的template变量
         $view = new View_Model('show/comment_list_flag');

         //把数据赋给视图模板
         $view->assign('list' , $list);
         $view->assign('search_para' , $search_para);
     }
     
}