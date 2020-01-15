
<?php

 class Article_Controller{

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
            case "open":
                $this->open($getVars);
                break;
            case "comments":
                $this->comment_list($getVars);
                break;
            case "comments_user":
                $this->comment_list_user($getVars);
                break;
            default:
                echo "404";
        }

     }

     private function set_info($getVars) {

         $model = new Article_Model;

         $id = !empty($getVars['id'])? $getVars['id'] : 0;

         if(!isset($_POST["submit"])) {

             //创建一个视图，并传入该控制器的template变量
             $view = new View_Model('show/article_add');

             //把数据赋给视图模板
             $view->assign('id' , $id);
         }

         else {
             $edit = $model->set_info($_POST,$id);
             var_dump($edit);
         }
     }

     private function comment_list($getVars) {
         /*
             获取所有查询参数
         */
         $search_para = array(
             'article_id' => !empty($getVars['article_id'])? $getVars['article_id'] : 0
         );

         $model = new Comment_Model;
         $list = $model->get_list($search_para);

         //创建一个视图，并传入该控制器的template变量
         $view = new View_Model('show/comment_list');

         //把数据赋给视图模板
         $view->assign('list' , $list);
         $view->assign('search_para' , $search_para);
     }

     private function comment_list_user($getVars) {
         /*
             获取所有查询参数
         */
         $search_para = array(
             'article_id' => !empty($getVars['article_id'])? $getVars['article_id'] : 0,
             'derogatory' => 'NO'
         );

         $show_flag=false;
         $info = !empty($_SESSION[SESSION_USER])?$_SESSION[SESSION_USER]:'';
         if($info['role'] == 'senior'){
             $model_article = new Article_Model;
             $article_info =$model_article->get_detail($search_para['article_id']);

             $model_userrelation = new UserRelation_Model;
             $list_relation = $model_userrelation->get_list(
                 array(
                     'user_id' => $info['id'],
                     'customer_id' => $article_info['author_id'],
                 )
             );
             if($list_relation!=null){
                 $show_flag=true;
             }
         }

         $model = new Comment_Model;
         $list = $model->get_list($search_para);

         if(isset($_SESSION[SESSION_USER]))
         {
             $model_like = new CommentLike_Model;
             foreach ($list as $k => $v){
                 $list[$k]['like'] = '';
                 $like = $model_like->get_list(
                     array(
                         'comment_id'=>$v['id'],
                         'user_id' => $_SESSION[SESSION_USER]['id'],
                     )
                 );
                 if($like!=null){
                     $list[$k]['like'] =$like[0]['status'];
                 }
             }
         }

         //创建一个视图，并传入该控制器的template变量
         $view = new View_Model('show/comment_list_user');

         //把数据赋给视图模板
         $view->assign('list' , $list);
         $view->assign('article_id' , $getVars['article_id']);
         $view->assign('search_para' , $search_para);
         $view->assign('show_flag' , $show_flag);
     }

     private function open()
     {
         $model = new Article_Model;
         $i = $_POST['id'];
         $edit = $model->open($i);
     }
     
}