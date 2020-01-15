
<?php
/**
 * 模型为控制器做底层数据操作
 *
 */
class Comment_Model
{

    private $tb = 'comment';

    public function __construct()
    {

    }

    /**
     * 获取列表
     */
    public function get_list($search_para=array())
    {
        $db = new Dt();
        $sql = "select $this->tb.*,users.Name as username from ".$this->tb." inner join users on ".$this->tb.".user_id = users.id  where 1=1".$this->set_condition($search_para);

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

    public function derogatory($pArr, $i)
    {
        $db = new Dt();
        $key = array(
            'status' => $pArr['status'],
        );

        if($i > 0) {
            $res = $db->update($this->tb, $key, "id={$i}");
        }
        return $res;
    }

    /**
     * 操作数据，根据id是否大于0进行新增或更新
     */
    public function set_info($pArr)
    {
        $db = new Dt();
        $key = array(
            'article_id' => $pArr['article_id'],
            'user_id' => $_SESSION[SESSION_USER]['id'],
            'content' => $pArr['content'],
            'is_flag' => 0,
            'parent_id' => $pArr['parent_id'],
            'publication_date' => date('Y-m-d H:i:s')
        );

        //is_flag
        $curse_model = new Curseword_Model;
        $curse_list=$curse_model->get_list();
        foreach ($curse_list as $k=>$v)
        {
            if (strpos($key['content'], $v['name']) !== false) {
                $key['is_flag'] = 1;
                break;
            }
        }

        $res = $db->insert($this->tb, $key);

        $article_model = new Article_Model;
        $article_info = $article_model->get_detail($pArr['article_id']);

        $billing_model = new BillingOrder_Model;
        $key = array(
            'price' => 10,
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
        if(!empty($search_para['article_id'])) {
            $con = $con." and article_id = ".$search_para['article_id'];
        }
        if(!empty($search_para['is_flag'])) {
            $con = $con." and is_flag = ".$search_para['is_flag'];
        }

        if(!empty($search_para['derogatory']) && $search_para['derogatory'] == 'NO')
        {
            $con = $con." and (status is NULL or status='NO')";
        }
        else if(!empty($search_para['derogatory']) && $search_para['derogatory'] == 'NULL')
        {
            $con = $con." and (status is NULL)";
        }

        return $con;
    }

}
?>