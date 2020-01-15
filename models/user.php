
<?php
/**
 * 模型为控制器做底层数据操作
 *
 */
class User_Model
{

    private $tb = 'users';

    public function __construct()
    {

    }

    /**
     * 获取列表
     */
    public function get_list($start, $end, $search_para=array())
    {
        $db = new Dt();
        $sql = "select * from ".$this->tb." where 1=1".$this->set_condition($search_para);

        $sql = $sql . " order by id desc limit $start,$end";
        
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
    public function get_detail($search_para=array())
    {
    	$db = new Dt();
    	$sql = "select * from ".$this->tb." where 1=1".$this->set_condition($search_para);
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
     * 判断登录
     */
    function get_login($name, $pwd)
    {
    	$db = new Dt();
    	$sql = "select * from ".$this->tb;
    	$sql = $sql . " where account='$name' and password='$pwd'";
    
    	$row = $db->fetchOne($sql);
    	return $row;
    }


    /**
     * 操作数据，根据id是否大于0进行新增或更新
     */
    public function set_info($pArr, $i)
    {
    	$db = new Dt();
		$key = array(
    			'u_name' => $pArr['n'],
    			'u_pwd' => $pArr['p'],
    			'u_firstname' => $pArr['fn'],
    			'u_lastname' => $pArr['ln'],
    			'u_email' => $pArr['e'],	
				'u_address' => $pArr['a']
    	);
		
		if($i > 0) {
			$res = $db->update($this->tb, $key, "id={$i}");
		}
		else {
			$res = $db->insert($this->tb, $key);
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
        if(!empty($search_para['i'])) {
            $con = $con." and id = '".$search_para['i']."'";
        }
        if(!empty($search_para['n_e'])) {
            $con = $con." and u_name = '".$search_para['n_e']."'";
        }

        return $con;
    }

}
?>