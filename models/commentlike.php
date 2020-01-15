
<?php
/**
 * 模型为控制器做底层数据操作
 *
 */
class CommentLike_Model
{

    private $tb = 'commentlike';

    public function __construct()
    {

    }

    /**
     * 获取列表
     */
    public function get_list($search_para=array())
    {
        $db = new Dt();
        $sql = "select * from ".$this->tb." where 1=1".$this->set_condition($search_para);

        $sql = $sql . " order by id desc";

        $list = $db->fetchAll($sql);

        return $list;
    }

    /**
     * 获取总数
     */
    public function get_list_count($search_para)
    {
        $db = new Dt();
        $sql = "select id from ".$this->tb." where 1=1".$this->set_condition($search_para);

        $count = $db->getResultNum($sql);
        return $count;
    }

    /**
     * 获取详情
     */
    public function get_detail($id)
    {
    	$db = new Dt();
    	$sql = "select * from ".$this->tb." where id=$id"; 	
    	$row = $db->fetchOne($sql);
    	return $row;
    }

    /**
     * 操作数据，根据id是否大于0进行新增或更新
     */
    public function set_info($pArr)
    {
        $db = new Dt();
        $key = array(
            'comment_id' => $pArr['comment_id'],
            'user_id' => $_SESSION[SESSION_USER]['id'],
            'status' => $pArr['status'],
            'publication_date' => date('Y-m-d H:i:s')
        );

        $res = $db->insert($this->tb, $key);

        $comment_model = new Comment_Model();
        $comment_info = $comment_model->get_detail($pArr['comment_id']);

        $article_model = new Article_Model;
        $article_info = $article_model->get_detail($comment_info['article_id']);

        $billing_model = new BillingOrder_Model;
        $key = array(
            'price' => 5,
            'customer_id' => $article_info['author_id'],
            'created_date' => date('Y-m-d H:i:s')
        );
        $bill = $billing_model->set_info($key);

        return $bill;
    }

    public function open($i)
    {
        $db = new Dt();
        $key = array(
            'open_comment' => 1
        );

        if($i > 0) {
            $res = $db->update($this->tb, $key, "id={$i}");
        }
        return $res;
    }
    
    /**
     * 删除数据
     */
    public function del_info($i)
    {
    	$db = new Dt();
    	$res = $db->delete($this->tb, "id={$i}");
    	return $res;
    }

    private function set_condition($search_para)
    {
        $con = "";
        if(!empty($search_para['comment_id'])) {
            $con = $con." and comment_id = ".$search_para['comment_id'];
        }
        if(!empty($search_para['user_id'])) {
            $con = $con." and user_id = ".$search_para['user_id'];
        }

        return $con;
    }

}
?>