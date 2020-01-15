
<?php
/**
 * 模型为控制器做底层数据操作
 *
 */
class BillingOrder_Model
{

    private $tb = 'billingorder';

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


    /**
     * 操作数据，根据id是否大于0进行新增或更新
     */
    public function set_info($pArr)
    {
        $db = new Dt();
        $key = array(
            'price' => $pArr['price'],
            'customer_id' => $pArr['customer_id'],
            'created_date' => $pArr['created_date']
        );

        $res = $db->insert($this->tb, $key);
        return $res;
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

        if(!empty($search_para['derogatory']) && $search_para['derogatory'] == 'NO')
        {
            $con = $con." and (status is NULL or status='NO')";
        }

        return $con;
    }

}
?>