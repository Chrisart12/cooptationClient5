<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\HistoricInterface;


class HistoricController extends Controller
{
    
    /**
     * @var [HistoricInterface]
     */
    protected $historicInterface;

    /**
     * @param HistoricInterface $historic
     */
    public function __construct(HistoricInterface $historicInterface)
    {
        $this->historicInterface = $historicInterface;
    }

    /**
     * @return [Historic] $historics
     */
    public function index()
    {
        
        $historics = $this->historicInterface->getAll();
    
        return view("historic", compact("historics"));
    }
}
