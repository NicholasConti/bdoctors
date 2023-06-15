<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
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

        $doc=$request->all();
        $doctor=new Doctor();

        if(isset($doc['image'])){
            $doc['image']=Storage::put('uploads',$doc['image']);
        }
        if(isset($doc['cv'])){
            $doc['cv']=Storage::put('uploads',$doc['cv']);
        }

        $doctor->fill($doc);
        $doctor->save();
        $user = auth()->user();
        $user->doctor_id=$doctor->id;
        $user->update();

        return view('doctor.dashboard',compact('user'));
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
        $doc=Doctor::findOrFail($id);
        $spec=Specialization::all();

        return view('doctor.details',compact('doc','spec'));
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
            /*'image' => 'required|image',
            'cv' => 'required|mimes:pdf'*/
        ]);

        $data=$request->all();
        $doc=Doctor::findOrFail($id);
        $doc->fill($data);
        $doc->update();
        if(isset($data['specialization'])){
            $doc->specializations()->sync($data['specialization']);
        }

        $user=$doc->user;

        return view('doctor.dashboard',compact('user'));
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
