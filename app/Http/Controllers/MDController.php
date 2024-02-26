<?php

namespace App\Http\Controllers;

use App\step;
use App\todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class MDController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    //MD
    public function mdO()
    {
        abort_if(!auth()->user()->md, 403, 'Unauthorized access');
        $todos = todo::where([
            ['status', '=', 'OP approved'],
            ['type', '=', 'opex'],
        ])
            ->orderBy('date_initiated', 'DESC')
            ->get();
        return view('md.mdT')->with(['todos' => $todos]);
    }

    public function mdC()
    {
        abort_if(!auth()->user()->md, 403, 'Unauthorized access');
        $todos = todo::where([
            ['status', '=', 'OP approved'],
            ['type', '=', 'capex'],
        ])
            ->orderBy('date_initiated', 'DESC')
            ->get();
        return view('md.mdT')->with(['todos' => $todos]);
    }

    public function mdConstruction()
    {
        abort_if(!auth()->user()->md, 403, 'Unauthorized access');
        $todos = todo::where(['status' => 'building IPR'])
            ->orderBy('date_initiated', 'DESC')
            ->get();
        return view('md.mdT')->with(['todos' => $todos]);
    }

    public function mdSoftware()
    {
        abort_if(!auth()->user()->md, 403, 'Unauthorized access');
        $todos = todo::where([
            ['status', '=', 'OP approved'],
            ['type', '=', 'software'],
        ])
            ->orderBy('date_initiated', 'DESC')
            ->get();
        return view('md.mdT')->with(['todos' => $todos]);
    }

    public function showMD($id)
    {
        $todos = todo::find($id);
        return view('md.showMD')->with(['todos' => $todos]);
    }

    public function updateMD(Request $request, $id)
    {
        $todos = todo::find($id);
        if ($todos->status == 'building IPR') {
            $todos->update(['status' => $request->status . '-Building IPR', 'mdN' => $request->mdN, 'mdD' => $request->mdD, 'mdC' => $request->mdC]);
        } else {
            $todos->update(['status' => $request->status, 'mdN' => $request->mdN, 'mdD' => $request->mdD, 'mdC' => $request->mdC]);
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
        if ($request->status == 'MD declined' || $request->status == 'DFO declined') {
            $data = [
                'intro'  => 'Dear ' . $todos->owner->name . ',',
                'content'   => 'Your IPR with reference No. ' . $todos->id . ' has been rejected at Final review approval Stage. Reason: ' . $request->mdC,
                'name' => $todos->owner->name,
                'email' => $todos->owner->email,
                'slmM' => $todos->slmM ?? $todos->owner->email,
                'hodM' => $todos->hodM ?? $todos->owner->email,
                'opM' => $todos->opM ?? $todos->owner->email,
                'subject'  => 'Rejected IPR Ref No. ' . $todos->id
            ];
            Mail::send('todos.mail', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])
                    ->cc($data['slmM'], $data['hodM'], $data['opM'])
                    ->subject($data['subject']);
            });
        }
        Alert::success('All good', 'Decision updated successfully')->toToast();
        return redirect('home');
    }
}
