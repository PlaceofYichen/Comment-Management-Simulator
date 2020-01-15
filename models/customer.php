
<?php
/**
 * 模型为控制器做底层数据操作
 *
 */
class Customer_Model
{
	private $tb = 'customer';
	
    public function __construct()
    {

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
    public function set_info($pArr, $i)
    {
    	$db = new Dt();
    	$key = array(
    			'a_name' => $pArr['n'],
    			'a_pwd' => $pArr['p']
    	);
    
    	if($i > 0) {
    		$res = $db->update($this->tb, $key, "id={$i}");
    	}
    	else {
    		$res = $db->insert($this->tb, $key);
    	}
    	return $res;
    }

}
