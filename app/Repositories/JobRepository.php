<?php

namespace App\Repositories;

use DB;
use App\Model\Job;

/**
 * [Description CandidatRepository]
 */
class JobRepository implements JobInterface
{
    /**
     * @var [type]
     */
    protected $job;

	
	/**
	 * @param Job $job
	 */
	public function __construct(Job $job)
	{
		$this->job = $job;
    }

    /**
     * @param mixed $request
     * 
     * @return [type]
     */
    public function create($request)
    {
        $job = new $this->job;

        $job->user_id = $request->input('userId');
        $job->categorie_id = 1;
        $job->step_id = 1;
        $job->title = $request->input('title');
        $job->location = $request->input('location');
        $job->reference = $request->input('reference');
        $job->vaccancy_id = $request->input('jobId');
        $job->url = $request->input('jobUrl');
        
        $job->save();

        return $job;
    }
    
}