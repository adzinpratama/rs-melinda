<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocterRequest;
use App\Http\Requests\UpdateDocterRequest;
use App\Models\Docter;
use App\Models\Proficiency;
use Illuminate\Support\Str;

class DocterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docters = Docter::all();
        return view('docters.index', compact('docters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profeciencies = Proficiency::all();
        return view('docters.form', compact('profeciencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocterRequest $request)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['image'] = $this->saveImage($data['image']);
        }
        Docter::create($data);

        return redirect()->back()->with('success', 'Docter Added');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Docter  $docter
     * @return \Illuminate\Http\Response
     */
    public function edit(Docter $docter)
    {
        $profeciencies = Proficiency::all();
        return view('docters.form', compact('docter', 'profeciencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocterRequest  $request
     * @param  \App\Models\Docter  $docter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocterRequest $request, Docter $docter)
    {
        $data = $request->validated();
        $docter->update($data);
        return redirect()->back()->with('success', 'Docter Edit Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Docter  $docter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docter $docter)
    {
        $docter->delete();
        return redirect()->route('docter.index')->with('success', 'Docter Remove');
    }

    public function saveImage($image)
    {
        $file = Str::random(16) . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('uploads/profil', $file, 'public');
        return '/storage/' . $path;
    }
}
