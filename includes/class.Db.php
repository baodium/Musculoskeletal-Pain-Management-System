<?php
require_once'config.php';
class Db {
	public $handle;
	public $fileType;
	
	public function __construct() {
	
		if (!$this->handle = mysql_connect(SERVER, USERNAME, PASSWORD)) {
      		exit('Error: Could not establish  connection to database using ' . USERNAME . '@' . SERVER);
    	}

    	if (!mysql_select_db(DATABASE, $this->handle)) {
      		exit('Error: Could not connect to database ' . DATABASE);
    	}
		
		mysql_query("SET NAMES 'utf8'", $this->handle);
		mysql_query("SET CHARACTER SET utf8", $this->handle);
  	}
		
  	private function query($sql) {
	$result=array();
	$resource=mysql_query($sql);
	if(@mysql_num_rows($resource)>0){
	 while($value=mysql_fetch_assoc($resource)){
	 $result[]=$value;
	 }
	 return $result;
	 }
	else return NULL;	
  	}
	
	 private function update($squel) {
	    if(mysql_query($squel))
	    return true;
	    return false;	
  	}
	
	function delete($id,$tableName){
	if($tableName=="routes"){
	$sql= "DELETE FROM {$tableName} WHERE route_id='{$id}' ";
	}else if($tableName=="users"){
	$sql= "DELETE FROM {$tableName} WHERE id='{$id}' ";
	}
	return $this->update($sql);
	}


function search($term){
$sql="SELECT route_name, route_id FROM routes WHERE route_name LIKE '%$term%'";
return $this->query($sql);
}	

 
	function add_route($param){
	$squl="SELECT * FROM  routes  WHERE route_name='{$param['route_name']}' ";
    if($this->query($squl)!=NULL)
	return false;
	$sql_keys='';
	$sql_val='';
	foreach($param as $key=>$value){
	$sql_keys.=$key.',';
	$sql_val.="'".$value."',";
	}
	$sql_keys=rtrim($sql_keys, ",");
	$sql_val=rtrim($sql_val, ",");
	$sql="INSERT INTO routes (".$sql_keys.") VALUES (".$sql_val.")";
    return $this->update($sql);
	}
	
	function load_routes($page,$startpoint=null,$limit=null){
	$sql="SELECT * FROM routes";
	$count=count($this->query($sql));
	$return['count']=$count;
$return['result']=($this->query($sql))?array_slice($this->query($sql),$startpoint,$limit):null;
$return['pagination']=$this->pagination($this->query($sql),$limit,$page);
return $return;
	//return $this->query($sql)?(array_slice($this->query($sql),$startpoint,$limit)!=null)?array_slice($this->query($sql),$startpoint,$limit):$this->query($sql):null;
//$this->query($sql);
	}
	
	function loadRoute($id){
	$sql="SELECT * FROM routes WHERE route_id='$id'";
	return $this->query($sql);
	}
	
	function updateRoute($param){
	$sql_keys='';
	$id=$param['route_id'];
	unset($param['route_id']);
	foreach($param as $key=>$value){
	$sql_keys.=$key."='".$value."',";
	
	}
	$sql_keys=rtrim($sql_keys, ",");
	$sql="UPDATE routes  SET ".$sql_keys." WHERE route_id='{$id}'";
    return $this->update($sql);
	}
	
	function add_user($param){
	unset($param['password2']);
	$squl="SELECT * FROM  users WHERE username='{$param['username']}' ";
    if($this->query($squl)!=NULL)
	return false;
	$sql_keys='';
	$sql_val='';
	foreach($param as $key=>$value){
	$sql_keys.=$key.',';
	$sql_val.="'".$value."',";
	}
	$sql_keys=rtrim($sql_keys, ",");
	$sql_val=rtrim($sql_val, ",");
	$sql="INSERT INTO users (".$sql_keys.") VALUES (".$sql_val.")";
    return $this->update($sql);
	}
	
	function add_accident($param){
	$route=$this->loadRoute($param['route_id']);
	$route=$route[0];
	$length=$route['route_length'];
	$carriage_width=$route['carriage_width'];
	$pot_holes=$route['pot_holes'];
	$surface=$route['surface'];
	$junctions=$route['junctions'];
	$bends=$route['bends'];
	$failed_segment=$route['failed_segment'];
	$sql_keys='';
	$sql_val='';
	foreach($param as $key=>$value){
	if($key=="date"){
	$value=explode("/",$value);
$value=$value['2'].'-'.$value['0'].'-'.$value[1];
$vlue=strtotime($value);
	}
	$sql_keys.=$key.',';
	$sql_val.="'".$value."',";
	}
	//$sql_keys=rtrim($sql_keys, ",");
	$sql_keys.='route_length, carriage_width,pot_holes,surface, junctions, bends,failed_segment';
	//$sql_val=rtrim($sql_val, ",");
	$sql_val.="'".$length."',"."'".$carriage_width."',"."'".$pot_holes."',"."'".$surface."',"."'".$junctions."',"."'".$bends."',"."'".$failed_segment."'";
	
	$sql="INSERT INTO accidents (".$sql_keys.") VALUES (".$sql_val.")";
	//var_dump($sql); exit;
	$done=$this->update($sql);
	if($done){
	$sql2="SELECT * FROM accidents WHERE route_id ='{$param['route_id']}' ";
	$results=$this->query($sql2);
	$total=0; 
	$fatality=0; 
	$casualty=0;
	foreach($results as $result){
	$fatality+=$result['number_of_dead'];
	$casualty+=$result['number_injured']+$result['number_of_dead'];
	$total+=1;
	}
	$injured=$casualty-$fatality;
	$fatality_rate=round(($fatality/$casualty)*(100),3);
	$fatality_density=round(($fatality/$total),3);
	$casualty_density=round(($casualty/$total),3);
	$sq="UPDATE routes SET fatality_rate='$fatality_rate',fatality_density='$fatality_density',casualty_density='$casualty_density', total_accidents='$total', dead='$fatality', injured='$injured', casualty='$casualty' WHERE route_id='{$param['route_id']}' ";
	return $this->update($sq);
	//var_dump($fatality."<br/>".$casualty."<br/>".$total);exit;
 //}
	}else{
	return false;
	}
	}
	function load_accidents(){
	$sql="SELECT * FROM accidents ORDER BY id DESC";
	return $this->query($sql);
	}
	
	
	function load_an_accident($id){
	$sql="SELECT accidents.*, routes.route_name FROM accidents, routes WHERE id='$id' AND accidents.route_id=routes.route_id ";
	return $this->query($sql);
	}
	
	function load_accident($id){
	$sql="SELECT routes.route_name, accidents.* FROM accidents, routes WHERE accidents.route_id='$id' AND routes.route_id='$id' ";
	return $this->query($sql);
	}
	
	function load_users(){
	$sql="SELECT * FROM users";
	return $this->query($sql);
	}
	
	
	function change($param,$id, $table){

	$sql="SELECT * FROM {$table} WHERE id= '$id' ";
	//var_dump($sql); exit;
	$ret=$this->query($sql);
	if($ret[0]['password'] != $param['oldpassword']){
	return false;
	}else{
	$sql="UPDATE {$table} SET password='{$param['newpassword']}' WHERE id='$id' ";
	return $this->update($sql);
	}
	var_dump($ret); exit;
	}
	
	function pagination($result, $per_page ,$page, $url = '?'){  
    
    	//$query = "SELECT COUNT(*) as 'num' FROM books WHERE {$query}";
    	//$row = mysql_fetch_array(mysql_query($query));
		//var_dump($result);exit;
    	$total = count($result);
		//var_dump($total); exit;
        $adjacents = "2"; 
        //$per_page=2;
    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
		//var_dump($per_page);exit;
        $lastpage = ceil($total/$per_page);
    	$lpm1 = $lastpage - 1;
    	
    	$pagination = "";
    	if($lastpage > 1)
    	{	
    		$pagination .= "<ul class='pagination'>";
                    $pagination .= "<li class='details'>Page $page of $lastpage</li>";
    		if ($lastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $lastpage; $counter++)
    			{
    				if ($counter == $page)
    					$pagination.= "<li><a class='current'>$counter</a></li>";
    				else
    					$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    			}
    		}
    		elseif($lastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>...</li>";
    				$pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";		
    			}
    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
    				$pagination.= "<li class='dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>..</li>";
    				$pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";		
    			}
    			else
    			{
    				$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
    				$pagination.= "<li class='dot'>..</li>";
    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$pagination.= "<li><a href='{$url}page=$next'>Next</a></li>";
                $pagination.= "<li><a href='{$url}page=$lastpage'>Last</a></li>";
    		}else{
    			$pagination.= "<li><a class='current'>Next</a></li>";
                $pagination.= "<li><a class='current'>Last</a></li>";
            }
    		$pagination.= "</ul>\n";		
    	}
    
    
        return $pagination;
    } 
	
	public function __destruct() {
	mysql_close($this->handle);
	}
	
	function loadRoutes(){
	$sql="SELECT * FROM routes";
	return $this->query($sql);
	}
	function get_routes(){
	$sql="SELECT * FROM routes";
	return $this->query($sql);
	}
	
	function download_accidents($from,$to){

	
$from=explode("/",$from);
$from=$from['2'].'-'.$from['0'].'-'.$from[1];
$from=date($from);

$to=explode("/",$to);
$to=$to['2'].'-'.$to['0'].'-'.$to[1];
$to=date($to);
//var_dump($from); exit;

	$sql="SELECT * FROM accidents WHERE accidents.date >= '$from' AND accidents.date <='$to' ";
	return $this->query($sql);

	}
	
	
function download_accident($id,$from,$to){
	
	$from=explode("/",$from);
$from=$from['2'].'-'.$from['0'].'-'.$from[1];
$from=date($from);

$to=explode("/",$to);
$to=$to['2'].'-'.$to['0'].'-'.$to[1];
$to=date($to);

	$sql="SELECT routes.route_name, accidents.* FROM accidents, routes WHERE accidents.route_id='$id' AND routes.route_id='$id' AND accidents.date >= '$from' AND accidents.date <='$to'";
	return $this->query($sql);
	}
	
	function time_accidents($time_from,$time_to){
	$sql="SELECT * FROM accidents WHERE accidents.time>='$time_from' AND accidents.time<='$time_to' ORDER BY id DESC";
	return $this->query($sql);
	}
	
	function time_accident($id,$time_from,$time_to){
	$sql="SELECT routes.route_name, accidents.* FROM accidents, routes WHERE accidents.route_id='$id' AND routes.route_id='$id' AND accidents.time>='$time_from' AND accidents.time<='$time_to' ";
	return $this->query($sql);
	}
	
	function loadParts(){
	$sql="SELECT * FROM body_part";
	return $this->query($sql);
	}
	
	
	function loadQuestion($id){
	$sql="SELECT * FROM question WHERE part_id='$id'";
	return $this->query($sql);
	}
	
	function loadDisorder($part_id){
	$sql="SELECT * FROM disorder WHERE part_id='$part_id'";
	return $this->query($sql);	
	}
	
	function loadPart($pid){
	$sql="SELECT * FROM body_part WHERE part_id='$pid'";
	return $this->query($sql);
	}
	
	function addUser($param){
	unset($param['registered']);
	$fullname=strip_tags($param['fullname']);
	$username=strip_tags($param['username']);
	$age=$param['age'];
	$sex=$param['sex'];
	$password=$param['password'];
	$sq="SELECT * FROM users WHERE username='$username'";
	$ret=$this->query($sq);
	//var_dump($ret);exit;
	if($ret!=NULL){
	return false;
	}
	
	$sql="INSERT INTO users (fullname,username,password,sex,age) VALUES('$fullname','$username','$password','$sex','$age')";
	return $this->update($sql);
	}
	
	function login($param){
 $username=htmlspecialchars(strip_tags($param['username']));
 $password=htmlspecialchars(strip_tags($param['password']));
 $sql= "SELECT * FROM users WHERE username='{$username}' AND password= '{$password}' ";
 return $this->query($sql);
}

function addResponse($param){

$disorders=$this->loadDisorder($param['p_id']);
$dis='';
foreach ($disorders as $disorder){
$dis.=$disorder['name'].',';
}
$sq1="SELECT * FROM response WHERE user_id='{$param['user_id']}'";
$res=$this->query($sq1);
//var_dump($res); exit;
if($res!=NULL){
$sq2="UPDATE response SET p_id='{$param['p_id']}', d_id='$dis', date='{$param['date']}', score='{$param['score']}' WHERE user_id='{$param['user_id']}'  ";
return $this->update($sq2);
}else{
//var_dump("here"); exit;
$sql="INSERT INTO response (user_id,p_id,d_id,date,score) VALUES('{$param['user_id']}','{$param['p_id']}','$dis','{$param['date']}','{$param['score']}')";
return $this->update($sql);
}
}

function loadDisorders(){
$sql="SELECT * FROM disorder";
return $this->query($sql);
}

function loadTest(){
$sql="SELECT * FROM response";
return $this->query($sql);
}

function loadBarData(){
$ret=array();
$male=0;
$female=0;
$sql="SELECT * FROM response WHERE score<'4' ";
$result=$this->query($sql);
foreach($result as $inst){
$id=$inst['user_id'];
$sql="SELECT * FROM users where id='$id'";
$val=$this->query($sql);
$ret[]=$val;
}
return $ret;
}

function getDisorder($id){
$sql="SELECT * FROM disorder WHERE d_id='$id' ";
return $this->query($sql);
}
	
}
?>
