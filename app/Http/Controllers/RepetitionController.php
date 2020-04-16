<?php

namespace App\Http\Controllers;

use App\Services\RepetitionService;
use Illuminate\Http\Request;

class RepetitionController extends Controller
{
    public RepetitionService $repetitionService;

    public function __construct(RepetitionService $repetitionService)
    {
        $this->repetitionService = $repetitionService;
    }
}
