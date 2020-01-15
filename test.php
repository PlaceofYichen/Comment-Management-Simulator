<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/30
 * Time: 23:14
 */

require_once __DIR__ ."/lib/config.php";
require_once __DIR__ ."/lib/dt.php";
require_once __DIR__ . '/vendor/fzaninotto/faker/src/autoload.php';

header ( "Content-Type: text/html; charset=utf-8" );
date_default_timezone_set ( "PRC" );

$db = new Dt();
/*$sql = "select * from customer where id=1";
$row = $db->fetchOne($sql);
var_dump($row);
return;*/
$faker = Faker\Factory::create();
/*
for($i=0;$i<10;$i++){
    $key = array(
        'name' => $faker->name,
        'account' => $faker->userName,
        'password' => $faker->password(6,20),
        'register_date' => $faker->dateTime()->format('Y-m-d H:i:s'),
    );

    $res = $db->insert('customer', $key);
}

for($i=0;$i<50;$i++){
    $key = array(
        'name' => $faker->word,
        'create_date' => $faker->dateTime()->format('Y-m-d H:i:s'),
    );

    $res = $db->insert('curseword', $key);
}

for($i=0;$i<100;$i++){
    $key = array(
        'title' => $faker->text(50),
        'author_id' => $faker->numberBetween(1,15),
        'publication_date' => $faker->dateTime()->format('Y-m-d H:i:s'),
        'last_updated' => $faker->dateTime()->format('Y-m-d H:i:s'),
        'topic' => $faker->text(50),
    );

    $res = $db->insert('article', $key);
}

for($i=0;$i<100;$i++){
    $key = array(
        'name' => $faker->name,
        'email' => $faker->email,
        'country' => $faker->country,
        'state' => $faker->randomElement($array = array ('Alabama','Alaska','Florida','Georgia','Hawaii','	Kentucky','Kansas','Minnesota')),
        'account' => $faker->userName,
        'password' => $faker->password,
        'avatar' => $faker->numberBetween(1,5).'jpg',
        'register_date' => $faker->dateTime()->format('Y-m-d H:i:s'),
        'role' => 'junior',
    );

    $res = $db->insert('users', $key);
}

for($i=0;$i<100;$i++){
    $key = array(
        'name' => $faker->name,
        'email' => $faker->email,
        'country' => $faker->country,
        'state' => $faker->randomElement($array = array ('Alabama','Alaska','Florida','Georgia','Hawaii','	Kentucky','Kansas','Minnesota')),
        'account' => $faker->userName,
        'password' => $faker->password,
        'avatar' => $faker->numberBetween(1,5).'jpg',
        'register_date' => $faker->dateTime()->format('Y-m-d H:i:s'),
        'role' => 'senior',
    );

    $res = $db->insert('users', $key);
}

for($i=1;$i<15;$i++){
    $user_max=$faker->numberBetween(85,155);
    for($j=85;$j<=$user_max;$j++){
        $key = array(
            'customer_id' => $i,
            'user_id' => $j,
        );

        $res = $db->insert('userrelation', $key);
    }
}

for($i=1;$i<150;$i++) {
    for ($j = 0; $j < 30; $j++) //每篇文章添加30条一级评论
    {
        $key = array(
            'article_id' => $i,
            'user_id' => $faker->numberBetween(1, 100),
            'is_flag' => $faker->numberBetween(1, 100) > 50 ? 1 : 0,
            'parent_id' => 0,
            'content' => $faker->text(100),
            'publication_date' => $faker->dateTime()->format('Y-m-d H:i:s'),
        );
        $parent_comment_id = $db->insert('comment', $key);

        for ($k = 0; $k < $faker->numberBetween(0, 4); $k++) //每篇文章添加70条子级评论
        {
            $key = array(
                'article_id' => $i,
                'user_id' => $faker->numberBetween(1, 100),
                'is_flag' => $faker->numberBetween(1, 100) > 50? 1 : 0,
                'parent_id' => $parent_comment_id,
                'content' => $faker->text(100),
                'publication_date' => $faker->dateTime()->format('Y-m-d H:i:s'),
            );
            $res = $db->insert('comment', $key);
        }
    }
}

$sql='SELECT * FROM comment ORDER BY RAND() LIMIT 120';
$list_comment = $db->fetchAll($sql);

$sql='SELECT * FROM curseword';
$list_curseword = array_column($db->fetchAll($sql),'name');
//var_dump($list_curseword);

foreach($list_comment as $k=>$v){
    $key = array(
        'content' => $v['content'].$faker->randomElement($list_curseword),
        'publication_date' => date('Y-m-d H:i:s'),
    );
    $res = $db->update('comment', $key, "id={$v['id']}");
}

for ($k = 0; $k < 2000; $k++){
    $key = array(
        'comment_id' => $faker->numberBetween(1, 9000),
        'user_id' => $faker->numberBetween(1, 100),
        'status' => $faker->randomElement($array = array ('like','dislike')),
        'publication_date' => date('Y-m-d H:i:s'),
    );
    $res = $db->insert('commentlike', $key);
}

$sql='SELECT comment.*,article.author_id FROM comment inner join article on comment.article_id=article.id';
$list_comment = $db->fetchAll($sql);

foreach($list_comment as $k=>$v){
    $key = array(
        'customer_id' => $v['author_id'],
        'price' => 10,
        'created_date' => date('Y-m-d H:i:s'),
    );
    $res = $db->insert('billingorder', $key);
}


$sql='SELECT article.author_id FROM commentlike inner join comment on commentlike.comment_id=comment.id inner join article on comment.article_id=article.id';
$list_comment = $db->fetchAll($sql);


foreach($list_comment as $k=>$v){
    $key = array(
        'customer_id' => $v['author_id'],
        'price' => 5,
        'created_date' => date('Y-m-d H:i:s'),
    );
    $res = $db->insert('billingorder', $key);
}

for($i=0;$i<100;$i++){
    $key = array(
        'title' => $faker->text(50),
        'author_id' => $faker->numberBetween(1,15),
        'publication_date' => $faker->dateTime()->format('Y-m-d H:i:s'),
        'last_updated' => $faker->dateTime()->format('Y-m-d H:i:s'),
        'topic' => $faker->text(50),
        'open_comment' => 0
    );

    $res = $db->insert('article', $key);
}

for($i=0;$i<=5000;$i++){
    $key = array(
        'created_date' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now')->format('Y-m-d H:i:s'),
    );

    $res = $db->update('billingorder', $key,"id={$i}");
}
*/