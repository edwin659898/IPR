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

class OperationController extends Controller
{
    //OP
  public function op()
  {
    abort_if(!auth()->user()->op,403,'unauthorized access');
    $todos = todo::where([
      ['status', '=', 'HOD approved'],
    ])
      ->orWhere([
        ['status', '=', 'MD declined'],
      ])
      ->orWhere([
        ['status', '=', 'DFO declined'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('op.opT')->with(['todos' => $todos]);
  }

  public function showOperation($id)
  {
    $users = User::where('md', true)->get();
    $todos = todo::find($id);
    return view('op.showOP')->with(['todos' => $todos,'users' => $users]);
  }

  public function updateOP(Request $request, $id)
  {
    $todos = todo::find($id);
    switch ($request->input('action')) {
      case 'save':
        $todos->update(['vat' => $request->VAT, 'currency' => $request->currency]);
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
        Alert::success('All good', 'Data saved Successfully')->toToast();
        return redirect()->back();
        break;

      case 'authorize':
        $request->validate(
          [
            'type' => 'required',
            'status' => 'required|min:5',
          ],
          [
            'type.required' => 'Please Choose wether its capex or Opex',
            'status.required' => 'Please choose decision'
          ]
        );

        $todos->update([
          'status' => $request->status, 'type' => $request->type, 'opN' => $request->opN,
          'opD' => $request->opD, 'opC' => $request->opC, 'opM' => auth()->user()->email
        ]);

        if ($request->status == 'OP approved') {
          $reviewer = $request->reviewer;
          Notification::route('mail', $reviewer)
            ->notify(new IPR(auth()->user(), $todos));
        } else {
          $data = [
            'intro'  => 'Dear ' . $todos->owner->name . ',',
            'content'   => 'Your IPR with reference No. ' . $todos->id . ' has been rejected at Operations review Stage. Reason: ' . $request->opC,
            'name' => $todos->owner->name,
            'email' => $todos->owner->email,
            'slmM' => $todos->slmM,
            'hodM' => $todos->hodM,
            'subject'  => 'Rejected IPR Ref No. ' . $todos->id
          ];
          Mail::send('todos.mail', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['name'])
            ->cc($data['slmM'],$data['hodM'])
            ->subject($data['subject']);
          });
        }
        Alert::success('All good', 'Decision Updated Successfully')->toToast();
        return redirect()->route('operation.op');
          break;
  }
   
  }

}
