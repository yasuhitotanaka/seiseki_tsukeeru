<?php

namespace App\Http\Controllers;

use App\Janso;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\JansoCreateForm;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class JansoController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(JansoCreateForm::class, [
            'method' => 'POST',
            'url' => route('janso_registration'),
        ]);

        return view('janso_registration', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(JansoCreateForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $janso = Janso::create([
                    'name' => $request->name,
                    'location' => $request->location,
                    'user_id' => Auth::id(),
                    'created_at' => Carbon::now(),
                    'modified_at' => Carbon::now(),
                ]);
        
        return redirect()->route('janso_list');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Janso  $janso
     * @return \Illuminate\Http\Response
     */
    public function show(Janso $janso)
    {
        return view('janso_list')->with('jansos', Janso::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Janso  $janso
     * @return \Illuminate\Http\Response
     */
    public function edit(Janso $janso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Janso  $janso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Janso $janso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Janso  $janso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Janso $janso)
    {
        //
    }
}
