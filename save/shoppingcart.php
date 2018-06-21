<?php
$this->utils->altercart($this->html->readRQ('func'));
//$this->html->refreshpage('?act=add&table=processdata',1,"<div class='alert alert-info'>Redirecting</div>");
echo $this->html->refreshpage("?act=add&table=processdata", 1, "Redirecting");
exit;
