<?php
namespace App\Entities;

use App\Models\Crud;
class Academic_session extends Crud
{
protected static $tablename='Academic_session';
/* this array contains the field that can be null*/
static $nullArray=array('status' );
static $compositePrimaryKey=array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/
static $uniqueArray=array('session_name' );
static $displayField ='session_name';
/*this is an associative array containing the fieldname and the type of the field*/
static $typeArray = array('session_name'=>'varchar','start_date'=>'date','end_date'=>'date','status'=>'tinyint');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/
static $labelArray=array('ID'=>'','session_name'=>'','start_date'=>'','end_date'=>'','status'=>'');
/*associative array of fields that have default value*/
static $defaultArray = array('status'=>'1');
//populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('filetype','maxsize',foldertosave','preservefilename'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array();//array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.
		
static $relation=array();
static $tableAction=array('enable'=>'getEnabled','delete'=>'delete/academic_session','edit'=>'edit/academic_session');
function __construct($array=array())
{
	parent::__construct($array);
}
function getSession_nameFormField($value=''){
	return "<div class='form-group'>
	<label for='session_name' >Session Name</label>
		<input type='text' name='session_name' id='session_name' value='$value' class='form-control' required />
</div> ";

}
function getStart_dateFormField($value=''){
	return "<div class='form-group'>
	<label for='start_date' >Start Date</label>
	<input type='date' name='start_date' id='start_date' value='$value' class='form-control' required />
</div> ";

}
function getEnd_dateFormField($value=''){
	return "<div class='form-group'>
	<label for='end_date' >End Date</label>
	<input type='date' name='end_date' id='end_date' value='$value' class='form-control' required />
</div> ";

}
function getStatusFormField($value=''){
	return "<div class='form-group'>
	<label class='form-checkbox'>Status</label>
	<select class='form-control' id='status' name='status' >
		<option value='1'>Yes</option>
		<option value='0' selected='selected'>No</option>
	</select>
	</div> ";

}

public function enable($id=null,&$db=null)
{
	//disable all to enable another one, one session must be active at  a time
	if ($id==NULL && !isset($this->array['ID'])) {
		throw new Exception("object does not have id");
	}
	if ($id ==NULL) {
		$id = $this->array["ID"];
	}
	$db=$this->db;
	$db->transBegin();
	$query="update academic_session set status=0";
	if (!$db->query($query)) {
		$db->transRollback();
		return false;
	}
	return $this->setEnabled($id,1,$db);
}

public function getPrevious($session)
{
	$query="select * from academic_session where start_date < (select start_date from academic_session where id=?) order by start_date desc limit 1";
	$result = $this->query($query,array($session));
	if ($result) {
		return $result[0]['ID'];
	}
	return array();
}


}
