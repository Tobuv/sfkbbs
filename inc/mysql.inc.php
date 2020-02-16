<?php
/* 
数据库连接 
*/
function connect($host=DB_HOST,$user=DB_USER,$password=DB_PASSWORD,$database=DB_DATABASE,$port=DB_PORT){
    $link=@mysqli_connect($host,$user,$password,$database,$port);
    if(mysqli_connect_errno()){
        exit(mysqli_connect_error());
    }
    mysqli_set_charset($link,'uft8');
    return $link;
}
/* 
执行一条SQL语句，返回结果对象集或布尔值
 */
function execute($link,$query){
    $result=mysqli_query($link,$query);
    if(mysqli_errno($link)){
        exit(mysqli_error($link));
    }
    return $result;
}
/* 
执行一条SQL语句，只返回布尔值 
*/
function execute_bool($link,$query){
    $bool=mysqli_real_query($link,$query);
    if(mysqli_errno($link)){
        exit(mysqli_error($link));
    }
    return $bool;
}

/* 
一次性执行多条SQL语句
implode( string $glue, array $pieces)--用 glue 将一维数组的值连接为一个字符串;
mysqli_multi_query — 执行一个 SQL 语句，或者多个使用分号分隔的 SQL 语句;
mysqli_store_result — 转移上一次查询返回的结果集
mysqli_fetch_all — Fetches all result rows as an associative array, a numeric array, or both
mysqli_more_results — 检查批量查询中是否还有查询结果 
mysqli_next_result — 为读取 multi_query 执行之后的下一个结果集做准备
*/
function execute_muti($link,$arr_sqls,&$error){
    $sqls=implode(';',$arr_sqls).';';
    if(mysqli_multi_query($link,$sqls)){
        $data=array();
        $i=0;//计数
        do{
            if($result=mysqli_store_result($link)){
                $data[$i]=mysqli_fetch_all($result);
                mysqli_free_result($result);
            }else{
                $data[$i]=null;
            }
            $i++;
            if(!mysqli_more_results($link)) break;
        }while(mysqli_next_result($link));
        if(count($arr_sqls)==$i){
            return $data;
        }else{
            $error="sql语句执行失败：<br>&nbsp；数据下表为{$i}的语句：{$arr_sqls[$i]}执行错误<br>&nbsp；错误原因：".mysqli_error($link);
            return false;
        }
    }else{
        $error='执行失败！请检查首条语句是否正确！<br />可能的错误原因：'.mysqli_error($link);
        return false;
    }
}
/* 
获取记录数
 */
function num($link,$sql_count){
    $result=execute($link,$sql_count);
    $count=mysqli_fetch_row($result);
    return $count[0];
}
/* 
数据入库之前进行转移，确保正确入库
mysqli_real_escape_string — 根据当前连接的字符集，对于 SQL 语句中的特殊字符进行转义
 */
function escape($link,$data){
    if(is_string($data)){
        return mysqli_real_escape_string($link,$data);
    }
    if(is_array($data)){
        foreach ($data as $key => $value) {
            $data[$key]=escape($link,$value);
        }
        
    }
    return $data;
}
/* 
关闭数据库连接
在我们的PHP里面如果向函数里面传递的是对象，那么并不是把对象复制一份传给函数，而是直接传递的这个对象本身
 */
function close(&$link){
    mysqli_close($link);
}
?>