<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'telephone' => 'required|max:15|string',
            'performance' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|image',
            'cv' => 'required|mimes:pdf'
        ]);
        $user = auth()->user();

        if (!$user->doctor_id){
            $doc = $request->all();
            $doctor = new Doctor();

            if (isset($doc['image'])) {
                $doc['image'] = Storage::put('uploads', $doc['image']);
            }
            if (isset($doc['cv'])) {
                $doc['cv'] = Storage::put('uploads', $doc['cv']);
            }


            $doctor->fill($doc);
            $doctor->save();
            if (isset($doc['specialization'])) {
                $doctor->specializations()->sync($doc['specialization']);
            }
            $user->doctor_id = $doctor->id;
            $user->update();
        }
        $spec=Specialization::all();
        $sponsor=Sponsorship::all();

        $isSponsor=$user->doctor()->with(
            ['sponsorships' => function($item){
                return $item->where('end_date' , '>=', date('Y-m-d'));
            }]
        )->first();
        if (count($isSponsor->sponsorships) > 0) $isSponsor=$isSponsor->sponsorships[0];
        else $isSponsor=null;
        return view('doctor.dashboard', compact('user','spec','sponsor','isSponsor'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doc = Doctor::findOrFail($id);
        $spec = Specialization::all();

        return view('doctor.details', compact('doc', 'spec'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'telephone' => 'required|max:15|string',
            'performance' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'image',
            'cv' => 'mimes:pdf'
        ]);

        $data = $request->all();
        $doc = Doctor::findOrFail($id);

        if (isset($data['image'])) {
            Storage::delete($doc->image);
            $data['image'] = Storage::put('uploads', $data['image']);
        }
        if (isset($data['cv'])) {
            Storage::delete($doc->cv);
            $data['cv'] = Storage::put('uploads', $data['cv']);
        }
        $doc->fill($data);
        $doc->update();

        if (isset($data['specialization'])) {
            $doc->specializations()->sync($data['specialization']);
        } else {
            $doc->specializations()->detach();
        }

        $user = $doc->user;
        $sponsor=Sponsorship::all();
        $isSponsor=$user->doctor()->with(
            ['sponsorships' => function($item){
                return $item->where('end_date' , '>=', date('Y-m-d'));
            }]
        )->first();
        if (count($isSponsor->sponsorships) > 0) $isSponsor=$isSponsor->sponsorships[0];
        else $isSponsor=null;
        return view('doctor.dashboard', compact('user','sponsor','isSponsor'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
