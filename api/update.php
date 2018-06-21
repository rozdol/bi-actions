<?php 
$table=$this->html->readRQs('table');

if(!$GLOBALS["access"]["edit_$table"]){
    echo json_encode(['error'=>'No access']);exit;
}
$id=$this->html->readRQn('id');
$vals=$this->html->readRQj('values');


if($this->data->field_exists($table,'user_id')){
	unset($vals[user_id]);
	$user_id=$this->db->getval("SELECT user_id from $table where user_id=$GLOBALS[uid] and id=$id")*1;
	if($user_id==0){echo json_encode(['error'=>"No access"]);exit;}
}

$orig_vals=$this->data->get_row($table,$id);

$this->db->update_DB($table,$id,$vals);
$new_vals=$this->data->get_row($table,$id);

foreach ($vals as $key => $value) {
	$changed[$key]=['old'=>$orig_vals[$key],'new'=>$new_vals[$key]];

}

$JSONData=[
	'user_id'=>$GLOBALS[uid],
	'table'=>$table,
	'id'=>$id,
	'changed'=>$changed
];