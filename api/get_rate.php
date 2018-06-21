<?php 
//$new_vals=$this->db->getrow("SELECT * from rates order by date desc limit 1");
$date=$this->html->readRQd('date',1);
$sql2="select * from listitems where list_id=6 order by id";
if (!($cur2 = pg_query($sql2))) {$this->html->SQL_error($sql2);}	
while ($row2 = pg_fetch_array($cur2)) {
	$currency=$row2[name];
	$rate=$this->data->get_rate($row2[id],$date);
	$new_vals[$currency]=$rate;
}
$JSONData=$new_vals;