<?php 
$table=$this->html->readRQs('table');

if(!$GLOBALS["access"]["edit_$table"]){
    echo json_encode(['error'=>'No access']);exit;
}
$id=$this->html->readRQn('id');
$vals=$this->html->readRQj('values');


if($this->data->field_exists($table,'user_id')){
	$vals[user_id]=$GLOBALS[uid];
}

$id=$this->db->insert_DB($table,$vals);
$new_vals=$this->data->get_row($table,$id);

foreach ($vals as $key => $value) {
	$inserted[$key]=['new'=>$new_vals[$key]];
}

$JSONData=[
	'user_id'=>$GLOBALS[uid],
	'table'=>$table,
	'id'=>$id,
	'inserted'=>$inserted
];