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

class UserController extends Controller
{

  public function __construct()
  {
    $this->middleware(['auth', 'verified']);
  }

  public function create()
  {
    return view('user.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'department' => 'required',
    ]);

    $iprs = auth()->user()->todo()->Create([
      'vat' => $request->VAT, 'currency' => $request->currency, 'department' => $request->department,
      'date_initiated' => $request->initiatedDate, 'initiator' => auth()->user()->name, 'initiator_site' => $request->site, 'leadT' => $request->leadT,
      'explanation' => $request->urgencyE, 'email' => auth()->user()->email, 'slmM' => auth()->user()->email, 'reviewer' => $request->site_inspector
    ]);

    if ($request->itemN) {
      foreach ($request->itemN as $key => $itemN) {
        $itemD = $request->itemD[$key];
        $UOM = $request->UOM[$key];
        $quantityR = $request->quantityR[$key];
        $unitP = $request->unitP[$key];
        $answer = $request->answer[$key];
        $budget = $request->budget[$key];
        $iprs->step()->Create([
          'step' => $itemN, 'description' => $itemD, 'uom' => $UOM, 'quantityR' => $quantityR,
          'unitP' => $unitP, 'totalP' => $answer, 'budget' => $budget
        ]);
      }
    }
    if ($request->hasfile('image')) {
      foreach ($request->file('image') as $key => $filename) {
        $filename = $request->image[$key]->getClientOriginalName();
        $path = $request->image[$key]->storeAs('public/images/', $filename);
        $iprs->image()->Create(['image' => $filename]);
      }
    }

    if ($request->type == 'normal') {
      $reviewer = $request->reviewer;
      Notification::route('mail', $reviewer)
        ->notify(new IPR(auth()->user(), $iprs));
    } elseif($request->type == 'construction') {
      $iprs->update(['status' => 'building IPR']);
      $data = [
        'intro'  => 'Dear MD,',
        'content'   => auth()->user()->name . ' has submitted a construction IPR Ref No. ' . $iprs->id . ' for review.',
        'name' => 'DFO',
        'email' => 'lawrence@betterglobeforestry.com',
        'cc' => 'jpd@betterglobeforestry.com',
        'subject'  => 'New Construction IPR ' . $iprs->id
      ];
      Mail::send('todos.mail', $data, function ($message) use ($data) {
        $message->to($data['email'], $data['name'])
          ->cc($data['cc'])
          ->subject($data['subject']);
      });
    }else{
      $iprs->update(['status' => 'software','department' => 'IT']);
      $data = [
        'intro'  => 'Dear HOD IT,',
        'content'   => auth()->user()->name . ' has submitted a software/License IPR Ref No. ' . $iprs->id . ' for review.',
        'name' => 'HOD IT',
        'email' => 'jpd@betterglobeforestry.com',
        'subject'  => 'New software/license IPR ' . $iprs->id
      ];
      Mail::send('todos.mail', $data, function ($message) use ($data) {
        $message->to($data['email'], $data['name'])
          ->subject($data['subject']);
      });
    }

    Alert::success('All good', 'IPR Created Successfullly');
    return redirect()->route('home');
  }

  public function show($id)
  {
    $todos = todo::find($id);
    return view('user.show')->with(['todos' => $todos]);
  }

  public function update(Request $request, $id)
  {
    $todos = todo::find($id);
    abort_if($todos->status == "SLM approved" || $todos->status == "SLO approved"
      || $todos->status == "HOD approved"  || $todos->status == "MD approved"
      || $todos->status == "DFO approved" ||  $todos->status == "OP approved", 403, 'Not allowed to edit');

    $todos->update([
      'currency' => $request->currency, 'vat' => $request->VAT, 'status' => 'pending',
      'leadT' => $request->leadT, 'explanation' => $request->urgencyE
    ]);
    if ($request->stepName) {
      foreach ($request->stepName as $key => $value) {
        $id = $request->stepId[$key];
        $step = step::find($id);
        $itemD = $request->itemD2[$key];
        $UOM = $request->UOM2[$key];
        $quantityR = $request->quantityR2[$key];
        $unitP = $request->unitP2[$key];
        $answer = $request->answer2[$key];
        $budget = $request->budget2[$key];
        $step->update([
          'step' => $value, 'description' => $itemD, 'uom' => $UOM, 'quantityR' => $quantityR,
          'unitP' => $unitP, 'totalP' => $answer, 'budget' => $budget
        ]);
      }
    }

    if ($request->itemN) {
      foreach ($request->itemN as $key => $itemN) {
        $itemD = $request->itemD[$key];
        $UOM = $request->UOM[$key];
        $quantityR = $request->quantityR[$key];
        $unitP = $request->unitP[$key];
        $answer = $request->answer[$key];
        $budget = $request->budget[$key];
        $todos->step()->Create([
          'step' => $itemN, 'description' => $itemD, 'uom' => $UOM, 'quantityR' => $quantityR,
          'unitP' => $unitP, 'totalP' => $answer, 'budget' => $budget
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
    if ($request->type == 'construction') {
      $todos->update(['status' => 'building IPR']);
      $data = [
        'intro'  => 'Dear DFO/MD,',
        'content'   => 'Amended construction IPR Ref No. ' . $todos->id . ' has been submitted for review.',
        'name' => 'DFO',
        'email' => 'jpd@betterglobeforestry.com',
        'cc' => 'jpd@betterglobeforestry.com',
        'subject'  => 'New Construction IPR ' . $todos->id
      ];
      Mail::send('todos.mail', $data, function ($message) use ($data) {
        $message->to($data['email'], $data['name'])
          ->cc($data['cc'])
          ->subject($data['subject']);
      });
    }elseif ($request->type == 'softwares') {
      $todos->update(['status' => 'softwares','department'=>'IT']);
      $data = [
        'intro'  => 'Dear HOD IT,',
        'content'   => 'Amended software/License IPR Ref No. ' . $todos->id . ' has been submitted for review.',
        'name' => 'HOD IT',
        'email' => 'jpd@betterglobeforestry.com',
        'subject'  => 'New Software/License IPR ' . $todos->id
      ];
      Mail::send('todos.mail', $data, function ($message) use ($data) {
        $message->to($data['email'], $data['name'])
          ->subject($data['subject']);
      });
    }else{
      $reviewer = $request->reviewer;
      Notification::route('mail', $reviewer)
        ->notify(new IPR(auth()->user(), $todos));
    }

    Alert::success('All good', 'IPR Created Successfullly');
    return redirect()->route('home');
  }

  public function updateProfile(Request $request)
  {
    $data = $request->validate([
      'name' => 'required',
      'email' => 'required',
      'site' => 'required',
      'department' => 'required',
      'supervisor' => 'required',
    ]);

    User::findOrFail(auth()->id())->update($data);
    return redirect()->back()->with('message', 'Updated successfully');
  }

  public function destroy($id)
  {
    $ipr = todo::findOrFail($id);
    abort_unless($ipr->status == 'SLO declined' || $ipr->status == 'SLM declined'
      || $ipr->status == 'HOD declined' && $ipr->owner->site == 'Head Office', 403);

    $ipr->step()->delete();
    foreach ($ipr->image as $attachment) {
      $filename = $attachment->image;
      $path = storage_path('app/public/images/' . $filename);
      if ($path) {
        unlink($path);
      }
      $attachment->delete();
    }

    $ipr->delete();

    Alert::success('Great', 'IPR Deleted');
    return redirect()->back();
  }
}
