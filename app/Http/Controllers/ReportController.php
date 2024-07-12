<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{

    public function show($reported_id, $type, $id)
    {
        if ($type === 'post') {
            $reportableType = 'App\Models\Post';
            $reportableId = $id;
        } elseif ($type === 'comment') {
            $reportableType = 'App\Models\Comment';
            $reportableId = $id;
        } else {
            abort(404); // Handle invalid type if necessary
        }

        $user = User::where('id', $reported_id)->firstOrFail();

        return view('users.reports', [
            'reportableType' => $reportableType,
            'reportableId' => $reportableId,
            'this_user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'reportable_type' => 'required|string',
            'reportable_id' => 'required|integer',
            'reported_id' => 'required|integer',
            'reason' => 'required|string|max:255',
            'others' => 'nullable|string',
        ]);

        $data['reporter_id'] = auth()->id();

        $report = Report::create([
            'reporter_id' => $data['reporter_id'],
            'reported_id' => $data['reported_id'],
            'reportable_type' => $data['reportable_type'],
            'reportable_id' => $data['reportable_id'],
            'reason' => $data['reason'],
            'for_others' => $data['others'],
        ]);


        return redirect()->route('journals')->with('success', 'Report submitted successfully.');
    }
}
