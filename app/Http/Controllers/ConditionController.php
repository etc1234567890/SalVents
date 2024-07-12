<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Condition;

class ConditionController extends Controller
{
    public function index()
    {
        $conditions = Condition::orderBy('con_name')->pluck('con_name');
        return view('health-care.conditions', compact('conditions'));
    }

    public function show($con_name)
    {
        $details = Condition::where('con_name', $con_name)->firstOrFail();
        $conditions = Condition::orderBy('con_name')->pluck('con_name');
        return view('health-care.conditions', compact('details', 'conditions'));
    }
}
