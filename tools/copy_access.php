<?php
if ($access['main_admin']){
	$group_id_from=$this->html->readRQn('group_id_from');
	$group_id_to=$this->html->readRQn('group_id_to');
	$group_id_tos=$this->html->readRQcsv('group_id_tos');
	$group_id_tos=explode(',', $group_id_tos);
	if($group_id_to>0)$group_id_tos[]=$group_id_to;
	foreach ($group_id_tos as $group_id_to) {
		$from=$this->data->get_name('groups',$group_id_from);
		$to=$this->data->get_name('groups',$group_id_to);
		$this->livestatus($this->html->tag("Copy access from $from to $to",'h5',''));
		//echo $this->html->tag("Copy access from $from to $to",'h5','');
		$this->db->GetVal("update accesslevel set access=0 where groupid=$group_id_to");
		$sql="select * from accesslevel where groupid=$group_id_from order by accessid" ;
		if (!($cur = pg_query($sql))) {$this->html->SQL_error($sql);}	
		while ($row = pg_fetch_array($cur)) {
			$r++;
			$accessname=$this->data->get_name('accessitems',$row[accessid]);
			$copy=1;
			if (strlen(strstr($accessname,"user"))>0) $copy=0;
			if (strlen(strstr($accessname,"group"))>0) $copy=0;
			if (strlen(strstr($accessname,"admin"))>0) $copy=0;
			if (strlen(strstr($accessname,"access"))>0) $copy=0;
			if (strlen(strstr($accessname,"config"))>0) $copy=0;
			if (strlen(strstr($accessname,"debug"))>0) $copy=0;
			if (strlen(strstr($accessname,"main_access"))>0) $copy=1;

			if($copy>0)$this->db->GetVal("update accesslevel set access=$row[access] where groupid=$group_id_to and accessid=$row[accessid]");
			//echo "$r $accessname ($row[access])<br>";
		}
	}		
	$this->livestatus('');
}