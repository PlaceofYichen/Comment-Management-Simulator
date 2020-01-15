
<?php
/**
 * 模型为控制器做底层数据操作
 *
 */
class Statistic_Model
{
    public function __construct()
    {

    }

    /**
     * 获取列表
     */
    public function get_1()
    {
        $db = new Dt();
        $sql = "SELECT users.id,users.name,a.count FROM (SELECT user_id ,COUNT(0) as count FROM comment WHERE parent_id =0 GROUP BY user_id) a INNER JOIN users on a.user_id = users.id ORDER BY count desc,users.id DESC LIMIT 0,20";
        $list = $db->fetchAll($sql);

        return $list;
    }

    public function get_2()
    {
        $db = new Dt();
        $sql = "SELECT users.id,users.name,a.count FROM (SELECT user_id ,COUNT(0) as count FROM comment WHERE parent_id >0 GROUP BY user_id) a INNER JOIN users on a.user_id = users.id ORDER BY count desc,users.id DESC LIMIT 0,20";

        $list = $db->fetchAll($sql);

        return $list;
    }

    public function get_3()
    {
        $db = new Dt();
        $sql = "SELECT users.name,a.count FROM (SELECT user_id ,COUNT(0) as count FROM commentlike GROUP BY user_id) a INNER JOIN users on a.user_id = users.id ORDER BY count DESC,users.id DESC LIMIT 0,20";

        $list = $db->fetchAll($sql);

        return $list;
    }

    public function get_4()
    {
        $db = new Dt();
        $sql = "SELECT customer.name,a.count FROM (SELECT author_id ,COUNT(0) as count FROM (SELECT comment.*,article.author_id FROM `comment` inner JOIN article on comment.article_id = article.id) view_comment GROUP BY author_id) a INNER JOIN customer on a.author_id = customer.id  ORDER BY count DESC LIMIT 0,10";

        $list = $db->fetchAll($sql);

        return $list;
    }

    public function get_5()
    {
        $db = new Dt();
        $sql = "SELECT customer.name,a.count FROM customer INNER JOIN (SELECT customer_id,COUNT(0) as count FROM `billingorder` WHERE date_sub(curdate(), interval 7 day)<=date(created_date) group by customer_id) a on a.customer_id = customer.id  ORDER BY count DESC LIMIT 0,10";

        $list = $db->fetchAll($sql);

        return $list;
    }

    public function get_6()
    {
        $db = new Dt();
        $sql = "SELECT customer.name,a.count FROM customer INNER JOIN (SELECT customer_id,COUNT(0) as count FROM `billingorder` WHERE date_format(created_date, '%y%m') = date_format(curdate( ) , '%y%m' ) group by customer_id) a on a.customer_id = customer.id ORDER BY count DESC LIMIT 0,10";

        $list = $db->fetchAll($sql);

        return $list;
    }

    public function get_7()
    {
        $db = new Dt();
        $sql = "SELECT customer.name,a.count FROM customer INNER JOIN (SELECT customer_id,COUNT(0) as count FROM `billingorder` WHERE date_format(created_date, '%y') = date_format(curdate( ) , '%y' ) group by customer_id) a on a.customer_id = customer.id ORDER BY count DESC LIMIT 0,10";

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