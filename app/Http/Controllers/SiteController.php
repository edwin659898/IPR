<?php

namespace App\Http\Controllers;

use App\Notifications\IPR;
use App\step;
use App\todo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class SiteController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'verified']);
  }

  //SLO
  public function kiambereSLO()
  {
    abort_if(!auth()->user()->slm, 403, 'unauthorized');
    $todos = todo::where([
      ['initiator_site', '=', 'Kiambere'],
      ['status', '=', 'pending'],
      ['reviewer', '=', 'SLO']
    ])
      ->orWhere([
        ['initiator_site', '=', 'Kiambere'],
        ['status', '=', 'HOD declined'],
        ['reviewer', '=', 'SLO']
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();

    return view('site.siteT')->with(['todos' => $todos]);
  }


  //slm
  public function kiambere()
  {
    abort_if(!auth()->user()->slm, 403, 'unauthorized');
    $todos = todo::where([
      ['initiator_site', '=', 'Kiambere'],
      ['status', '=', 'pending'],
    ])
      ->orWhere([
        ['initiator_site', '=', 'Kiambere'],
        ['status', '=', 'HOD declined'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();

    return view('site.siteT')->with(['todos' => $todos]);
  }

  public function nyongoro()
  {
    abort_if(!auth()->user()->slm, 403, 'unauthorized');
    $todos = todo::where([
      ['initiator_site', '=', 'Nyongoro'],
      ['status', '=', 'pending'],
    ])
      ->orWhere([
        ['initiator_site', '=', 'Nyongoro'],
        ['status', '=', 'HOD declined'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('site.siteT')->with(['todos' => $todos]);
  }

  public function forks()
  {
    abort_if(!auth()->user()->slm, 403, 'unauthorized');
    $todos = todo::where([
      ['initiator_site', '=', '7 Forks'],
      ['status', '=', 'pending'],
    ])
      ->orWhere([
        ['initiator_site', '=', '7 Forks'],
        ['status', '=', 'HOD declined'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('site.siteT')->with(['todos' => $todos]);
  }

  public function dokolo()
  {
    abort_if(!auth()->user()->slm, 403, 'unauthorized');
    $todos = todo::where([
      ['initiator_site', '=', 'dokolo'],
      ['status', '=', 'pending'],
    ])
      ->orWhere([
        ['initiator_site', '=', 'dokolo'],
        ['status', '=', 'HOD declined'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('site.siteT')->with(['todos' => $todos]);
  }

  public function showSLM($id)
  {
    $users = User::where('hod', true)->get();
    $todos = todo::find($id);
    return view('site.showSLM')->with(['todos' => $todos, 'users' => $users]);
  }

  public function updateSLM(Request $request, $id)
  {
    $todos = todo::find($id);

    $todos->update([
      'status' => $request->status, 'vat' => $request->VAT, 'currency' => $request->currency, 'slmN' => $request->slmN,
      'slmD' => $request->slmD, 'slmC' => $request->slmC, 'slmM' => auth()->user()->email
    ]);
    if ($request->stepId) {
      foreach ($request->stepId as $key => $value) {
        $id = $request->stepId[$key];
        $step = step::find($id);
        $quantityR = $request->quantityR[$key];
        $unitP = $request->unitP[$key];
        $answer = $request->answer[$key];
        $budget = $request->budget[$key];
        $decision = $request->decision[$key];
        $supplier = $request->supplier[$key];
        $step->update([
          'quantityR' => $quantityR,
          'unitP' => $unitP, 'totalP' => $answer, 'budget' => $budget, 'decision' => $decision, 'supplier' => $supplier
        ]);
      }
    }
    if ($request->hasfile('image')) {
      foreach ($request->file('image') as $key => $filename) {
        $filename = $request->image[$key]->getClientOriginalName();
        $path = $request->image[$key]->storeAs('public/images/', $filename);
        $todos->image()->Create(['image' => $filename]);
      }
    }

    if ($request->status == 'SLM approved' || $request->status == 'SLO approved') {
      $reviewer = $request->reviewer;
      Notification::route('mail', $reviewer)
        ->notify(new IPR(auth()->user(), $todos));
    } else {
      $data = [
        'intro'  => 'Dear '.$todos->owner->name.',',
        'content'   => 'Your IPR with reference No. '.$todos->id.' has been rejected at SLM Stage. Reason: '.$request->slmC,
        'name' => $todos->owner->name,
        'email' => $todos->owner->email,
        'subject'  => 'Rejected IPR Ref No. '.$todos->id
    ];
    Mail::send('todos.mail', $data, function($message) use ($data) {
        $message->to($data['email'], $data['name'])
                ->subject($data['subject']);
    });
    }
    Alert::success('All good', 'IPR Reviewed Successfullly')->toToast();
    return redirect('home');
  }
}
