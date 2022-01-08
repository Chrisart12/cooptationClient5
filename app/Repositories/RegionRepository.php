<?php

namespace App\Repositories;

use DB;
use App\Model\Region;

/**
 * [Description CandidatRepository]
 */
class RegionRepository implements RegionInterface
{
    /**
     * @var [type]
     */
    protected $region;

	
	/**
	 * @param Region $region
	 */
	public function __construct(Region $region)
	{
		$this->region = $region;
    }

    /**
     * @return [Region]
     */
    public function getByRegion()
    {
        $regions = Region::select('*')
                            ->orderBy('label')
                            ->get();
        return $regions;
    }
    
}