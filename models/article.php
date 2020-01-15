
<?php
/**
 * 模型为控制器做底层数据操作
 *
 */
class Article_Model
{

    private $tb = 'article';

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
    
    public function get_detail_empty()
    {
    	return array(
    			'id' => 0,
    			'p_name' => '',
    			'p_faceimg' => '',
    			'p_price' => '',
    			'p_stocknum' => '',
    			'p_detail' => ''			
    	);
    }


    /**
     * 操作数据，根据id是否大于0进行新增或更新
     */
    public function set_info($pArr, $i)
    {
    	$db = new Dt();
		$key = array(
    			'title' => $pArr['title'],
    			'author_id' => $_SESSION[SESSION_CUSTOMER]['id'],
    			'topic' => $pArr['topic'],
            'publication_date' => date('Y-m-d H:i:s'),
            'last_updated' => date('Y-m-d H:i:s'),
            'open_comment' => $pArr['open_comment'],
    	);
		
		if($i > 0) {
			$res = $db->update($this->tb, $key, "id={$i}");
		}
		else {
			$res = $db->insert($this->tb, $key);
		}
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
        if(!empty($search_para['author_id'])) {
            $con = $con." and author_id = ".$search_para['author_id'];
        }

        return $con;
    }

}
?>