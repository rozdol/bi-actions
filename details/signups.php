<?php
//Details signups
$res=$this->db->GetRow("select * from $what where id=$id");
$partner=$this->data->detalize('partners', $res[partner_id]);
$date=$this->html->readRQd('date',1);
$out.= "<h1>$res[name]</h1>";
$out.=$this->data->details_bar($what,$id);

$out.= "<table class='table table-morecondensed table-notfull'>";$out.="<tr><td class='mr'><b>Id: </b></td><td class='mt'>$res[id]</td></tr>";
$out.="<tr><td class='mr'><b>Name: </b></td><td class='mt'>$res[name]</td></tr>";
$out.="<tr><td class='mr'><b>Surname: </b></td><td class='mt'>$res[surname]</td></tr>";
$out.="<tr><td class='mr'><b>Email: </b></td><td class='mt'>$res[email]</td></tr>";
$out.="<tr><td class='mr'><b>Reg date: </b></td><td class='mt'>$res[reg_date]</td></tr>";
$out.="<tr><td class='mr'><b>Rev date: </b></td><td class='mt'>$res[rev_date]</td></tr>";
$out.="<tr><td class='mr'><b>Exp date: </b></td><td class='mt'>$res[exp_date]</td></tr>";
$out.="<tr><td class='mr'><b>Active: </b></td><td class='mt'>$res[active]</td></tr>";
$out.="<tr><td class='mr'><b>Verified: </b></td><td class='mt'>$res[verified]</td></tr>";
$out.="<tr><td class='mr'><b>Verification code: </b></td><td class='mt'>$res[verification_code]</td></tr>";
$out.="<tr><td class='mr'><b>Password hash: </b></td><td class='mt'>$res[password_hash]</td></tr>";
$out.="<tr><td class='mr'><b>User id: </b></td><td class='mt'>$res[user_id]</td></tr>";
$out.="<tr><td class='mr'><b>Entity id: </b></td><td class='mt'>$res[entity_id]</td></tr>";
$out.="<tr><td class='mr'><b>Ip: </b></td><td class='mt'>$res[ip]</td></tr>";
$out.="<tr><td class='mr'><b>Descr: </b></td><td class='mt'>$res[descr]</td></tr>";
$out.="</table>";

if($res[descr])$out.= "Description:<br><pre>$res[descr]</pre>";

$dname=$this->data->docs2obj($id,$what);
$out.="<b>Documents:</b> $dname<br>";
$out.=$this->show_docs2obj($id, $what);

$_POST[tablename]=$what;
$_POST[refid]=$id;
$_POST[reffinfo]="&tablename=$what&refid=$id";
$out.=$this->show('schedules');
$out.=$this->show('comments');
$out.=$this->report('posts');
$out.=$this->report('db_changes');
$body.=$out;
