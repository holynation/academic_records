<?php 

/**
* The controller that validate forms that should be inserted into a table based on the request url.
each method wil have the structure validate[modelname]Data
*/
namespace App\Models;

use CodeIgniter\Model;
use App\Models\WebSessionManager;
use CodeIgniter\I18n\Time;

class ModelControllerDataValidator extends Model
{
	protected $db;
	private $webSessionManager;
	
	function __construct()
	{
		helper('string');
		$this->db = db_connect();
		$this->webSessionManager = new WebSessionManager;
	}

	public function validateCourse_scoreData(&$data,$type,&$message)
	{
		if (!$data['ca_score'] && !$data['exam_score']) {
			$message = 'empty value  not allowed';
			return false;
		}
		$course_score = loadClass('course_score');
		$_POST['previous']='_,_';
		if ($type=='update') {
			$temp = $course_score->getWhere(array('student_course_registration_id'=>$data['student_course_registration_id']),$c,0,null,false);
			$temp = @$temp[0];
			if ($temp->ca_score==$data['ca_score'] && $temp->exam_score==$data['exam_score']) {
				$message = 'no changes made';
				return false;
			}
		}
		$ca = $data['ca_score'];
		$exam = $data['exam_score'];
		$total = $ca+$exam;
		if ($total > 100) {
			$message="invalid result score, score must not be more than 100";
			return false;
		}
		$data['score'] = $total;
		return true;
	}

}


?>