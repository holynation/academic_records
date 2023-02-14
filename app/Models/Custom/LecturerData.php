<?php 
/**
* This is the class that manages all information and data retrieval needed by the staff section of this application.
*/
namespace App\Models\Custom;

use CodeIgniter\Model;
use App\Models\WebSessionManager;
use App\Models\Mailer;
use CodeIgniter\HTTP\RequestInterface;

class LecturerData extends Model
{
	private $lecturer;
	private $mailer;
	private $webSessionManager;
	protected $db;
	protected $request;

	public function __construct(RequestInterface $request=null)
	{
		helper(['string','array']);
		$this->db = db_connect();
		$this->request = $request;
		$this->webSessionManager = new WebSessionManager;
		$this->mailer = new Mailer;
	}

	public function setLecturer($lecturer)
	{
		$this->lecturer = $lecturer;
	}

	public function loadDashboardInfo()
	{
		// get the iformatin for 
		$result = array();
		$result['countData'] = [
			'children' =>  0,
			'tenant' =>  0,
			'application' =>  0
		];
		$result['applicantDistrix'] = Applicant_allocation::init()->getApplicantDistrix();
		return $result;
	}

}
