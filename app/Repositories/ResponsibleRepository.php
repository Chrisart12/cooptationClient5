<?php

namespace App\Repositories;


use App\Model\Responsible;

/**
 * [Description CandidatRepository]
 */
class ResponsibleRepository implements ResponsibleInterface
{
    /**
     * @var [type]
     */
    protected $responsible;

	
	/**
	 * @param Responsible $responsible
	 */
	public function __construct(Responsible $responsible)
	{
		$this->responsible = $responsible;
    }

    
    /**
     * @return [Responsible]
     */
    public function getByResponsible()
    {
        $responsibles = Responsible::select('*')
                                    ->orderBy('label')
                                    ->get();
        return $responsibles;
    }
    
}