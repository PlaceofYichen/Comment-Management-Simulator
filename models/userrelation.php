
<?php
/**
 * 模型为控制器做底层数据操作
 *
 */
class UserRelation_Model
{

    private $tb = 'userrelation';

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

    private function set_condition($search_para)
    {
        $con = "";
        if(!empty($search_para['user_id'])) {
            $con = $con." and user_id = ".$search_para['user_id'];
        }
        if(!empty($search_para['customer_id'])) {
            $con = $con." and customer_id = ".$search_para['customer_id'];
        }

        return $con;
    }
}