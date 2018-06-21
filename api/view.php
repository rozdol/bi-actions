<?php 
$table=$this->html->readRQs('table');

if(!$GLOBALS["access"]["view_$table"]){
    echo json_encode(['error'=>'No access']);exit;
}
$id=$this->html->readRQn('id');
$vals=$this->html->readRQj('values');


if($this->data->field_exists($table,'user_id')){
	unset($vals[user_id]);
	$user_id=$this->db->getval("SELECT user_id from $table where user_id=$GLOBALS[uid] and id=$id")*1;
	if($user_id==0){echo json_encode(['error'=>"No access"]);exit;}
}

$new_vals=$this->data->get_row($table,$id);


$JSONData=[
	'user_id'=>$GLOBALS[uid],
	'table'=>$table,
	'id'=>$id,
	'vals'=>$new_vals
];