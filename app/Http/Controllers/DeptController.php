<?php

namespace App\Http\Controllers;

use App\step;
use App\todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class DeptController extends Controller
{
    public function __construct()
    {
      $this->middleware(['auth', 'verified']);
    }

    //HOD
  public function forestry()
  {
    abort_if(!auth()->user()->hod,403,'unauthorized access');
    $todos = todo::where([
      ['department', '=', 'Forestry'],
      ['status', '=', 'SLM approved']
    ])
      ->orWhere([
        ['department', '=', 'Forestry'],
        ['status', '=', 'SLO approved']
      ])
      ->orWhere([
        ['department', '=', 'Forestry'],
        ['status', '=', 'OP declined'],
      ])
      ->orWhere([
        ['department', '=', 'Forestry'],
        ['status', '=', 'pending'],
        ['initiator_site', '=', 'Head Office'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();

    return view('hod.hodT')->with(['todos' => $todos]);
  }

  public function operation()
  {
    abort_if(!auth()->user()->hod,403,'unauthorized access');
    $todos = todo::where([
      ['department', '=', 'Operations'],
      ['status', '=', 'pending'],
      ['initiator_site', '=', 'Head Office'],
    ])
      ->orWhere([
        ['department', '=', 'Operations'],
        ['status', '=', 'pending'],
        ['initiator_site', '=', 'Kampala'],
      ])
      ->orWhere([
        ['department', '=', 'Operations'],
        ['status', '=', 'SLM approved'],
      ])
      ->orWhere([
        ['department', '=', 'Operations'],
        ['status', '=', 'SLO approved'],
      ])
      ->orWhere([
        ['department', '=', 'Operations'],
        ['status', '=', 'OP declined'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('hod.hodT')->with(['todos' => $todos]);
  }

  public function communication()
  {
    abort_if(!auth()->user()->hod,403,'unauthorized access');
    $todos = todo::where([
      ['initiator_site', '=', 'Head Office'],
      ['status', '=', 'pending'],
      ['department', '=', 'Communications'],
    ])
      ->orWhere([
        ['initiator_site', '=', 'Head Office'],
        ['department', '=', 'Communications'],
        ['status', '=', 'OP declined'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('hod.hodT')->with(['todos' => $todos]);
  }

  public function ME()
  {
    abort_if(!auth()->user()->hod,403,'unauthorized access');
    $todos = todo::where([
      ['initiator_site', '=', 'Head Office'],
      ['status', '=', 'pending'],
      ['department', '=', 'M&E'],
    ])
      ->orWhere([
        ['initiator_site', '=', 'Kampala'],
        ['status', '=', 'pending'],
        ['department', '=', 'M&E'],
      ])
      ->orWhere([
        ['department', '=', 'M&E'],
        ['status', '=', 'SLM approved'],
      ])
      ->orWhere([
        ['department', '=', 'M&E'],
        ['status', '=', 'SLO approved'],
      ])
      ->orWhere([
        ['initiator_site', '=', 'Head Office'],
        ['department', '=', 'M&E'],
        ['status', '=', 'OP declined'],
      ])
      ->orWhere([
        ['initiator_site', '=', 'Kampala'],
        ['department', '=', 'M&E'],
        ['status', '=', 'OP declined'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('hod.hodT')->with(['todos' => $todos]);
  }

  public function it()
  {
    abort_if(!auth()->user()->hod,403,'unauthorized access');
    $todos = todo::where([
      ['initiator_site', '=', 'Head Office'],
      ['status', '=', 'pending'],
      ['department', '=', 'IT'],
    ])
      ->orWhere([
        ['initiator_site', '=', 'Head Office'],
        ['status', '=', 'OP declined'],
        ['department', '=', 'IT'],
      ])
      ->orWhere([
        ['status', '=', 'software'],
        ['department', '=', 'IT'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('hod.hodT')->with(['todos' => $todos]);
  }

  public function hr()
  {
    abort_if(!auth()->user()->hod,403,'unauthorized access');
    $todos = todo::where([
      ['initiator_site', '=', 'Head Office'],
      ['status', '=', 'pending'],
      ['department', '=', 'HR'],
    ])
      ->orWhere([
        ['initiator_site', '=', 'Head Office'],
        ['status', '=', 'OP declined'],
        ['department', '=', 'HR'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('hod.hodT')->with(['todos' => $todos]);
  }

  public function miti()
  {
    abort_if(!auth()->user()->hod,403,'unauthorized access');
    $todos = todo::where([
      ['initiator_site', '=', 'Head Office'],
      ['status', '=', 'pending'],
      ['department', '=', 'Miti Magazines'],
    ])
      ->orWhere([
        ['status', '=', 'OP declined'],
        ['department', '=', 'Miti Magazines'],
      ])
      ->orWhere([
        ['initiator_site', '=', 'Tanzania'],
        ['status', '=', 'pending'],
        ['department', '=', 'Miti Magazines'],
      ])
      ->orWhere([
        ['initiator_site', '=', 'Kampala'],
        ['status', '=', 'pending'],
        ['department', '=', 'Miti Magazines'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('hod.hodT')->with(['todos' => $todos]);
  }

  public function account()
  {
    abort_if(!auth()->user()->hod,403,'unauthorized access');
    $todos = todo::where([
      ['initiator_site', '=', 'Head Office'],
      ['status', '=', 'pending'],
      ['department', '=', 'Accounts'],
    ])
      ->orWhere([
        ['status', '=', 'OP declined'],
        ['department', '=', 'Accounts'],
      ])
      ->orWhere([
        ['initiator_site', '=', 'Kampala'],
        ['status', '=', 'pending'],
        ['department', '=', 'Accounts'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('hod.hodT')->with(['todos' => $todos]);
  }

  public function showHOD($id)
  {
    $user = auth()->user();
    $todos = todo::find($id);
    return view('hod.showHOD')->with(['todos' => $todos, 'user' => $user]);
  }

  public function updateHOD(Request $request, $id)
  {
    $todos = todo::find($id);

    $current_status = $todos->status;

    $todos->update([
      'status' => $request->status, 'hodN' => $request->hodN, 'hodM' => auth()->user()->email,
      'hodD' => $request->hodD, 'hodC' => $request->hodC
    ]);


    if ($current_status == 'software') {
      $todos->update(['type' => 'software']);
    } 
    
    if ($request->stepId) {
      foreach ($request->stepId as $key => $value) {
        $id = $request->stepId[$key];
        $step = step::find($id);
        $decision = $request->decision[$key];
        $step->update(['decision' => $decision]);
      }
    }
    if ($request->hasfile('image')) {
      foreach ($request->file('image') as $key => $filename) {
        $filename = $request->image[$key]->getClientOriginalName();
        $path = $request->image[$key]->storeAs('public/images/', $filename);
        $todos->image()->Create(['image' => $filename]);
      }
    }
    if ($request->status == 'HOD declined') {
      $data = [
        'intro'  => 'Dear ' . $todos->owner->name . ',',
        'content'   => 'Your IPR with reference No. ' . $todos->id . ' has been rejected at HOD review Stage. Reason: ' . $request->hodC,
        'name' => $todos->owner->name,
        'email' => $todos->owner->email,
        'slmM' => $todos->slmM,
        'subject'  => 'Rejected IPR Ref No. ' . $todos->id
      ];
      Mail::send('todos.mail', $data, function ($message) use ($data) {
        $message->to($data['email'], $data['name'])
        ->cc($data['slmM'])
        ->subject($data['subject']);
      });
    }
    Alert::success('All good', 'IPR Reviewed Successfullly')->toToast();
    return redirect('home');
  }

}
