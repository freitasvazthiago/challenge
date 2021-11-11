<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Gate;
use App\Rules\NotContainShit;
use App\Events\DailyLogCreated;
use Illuminate\Support\Facades\Event;

class DailyLogController extends Controller
{
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'log' => ['required', 'string', new NotContainShit],
        'day' => 'required|date',
      ]);
      
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
      }

      $dailyLog = DailyLog::create(
        [
          'log' => $request->log,
          'user_id' => auth()->user()->id,
          'day' => $request->day
        ]
      );
    
      event(new DailyLogCreated(auth()->user()));
      
      return back();
    }

    public function update($id): RedirectResponse
    {
        $log = DailyLog::findOrFail($id);

        $log->update(request()->only('log'));

        return back();
    }

    public function destroy($id): RedirectResponse
    {
      $log = DailyLog::findOrFail($id);

      if (Gate::denies('delete', $log)) {
        abort(403);
      }

      $log->delete();

      return back();
    }
}
