
<?php
/**
 * 模型为控制器做底层数据操作
 *
 */
class Curseword_Model
{

    private $tb = 'curseword';

    public function __construct()
    {

    }

    /**
     * 获取列表
     */
    public function get_list($search_para=array())
    {
        $db = new Dt();
        $sql = "select * from ".$this->tb;

        $sql = $sql . " order by id desc";

        $list = $db->fetchAll($sql);

        return $list;
    }
}