<?php

namespace App\Http\Controllers;

use App\Janso;
use App\Scores;
use App\GameHistory;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\ScoreRegisterForm;
use App\Forms\ModifyHistoryForm;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Collection;


class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param int $janso_id
     * @return \Illuminate\Http\Response
     */
    public function index($janso_id)
    {
        $query = Scores::query();
        $query->where('janso_id',$janso_id); 
        $query->where('user_id',Auth::id());

        if($query->get()->isEmpty()){
            return redirect()->route('score_registration', ['janso_id' => $janso_id]);
        }

        $janso = Janso::find($janso_id);
        $score = $query->get();
        return view('score_detail', ['janso' => $janso, 'score' => $score]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param    $janso_id
     * @return \Illuminate\Http\Response
     */
    public function create(formBuilder $formBuilder, $janso_id)
    {
        $form = $formBuilder->create(ScoreRegisterForm::class, [
            'method' => 'POST',
            'url' => route('score_registration', ['janso_id' => $janso_id]),
        ]);

        return view('score_registration', compact('form'));
    }

    public function get_all_numbers($first_number, 
                                    $second_number, 
                                    $third_number,
                                    $fourth_number) {
        $collection = collect([
                        $first_number,
                        $second_number,
                        $third_number,
                        $fourth_number,
                        ]);
        return $collection->sum();
    }


    public function get_average_number($first_number, 
                                    $second_number, 
                                    $third_number,
                                    $fourth_number,
                                    $all_number) {
        $collection_for_average_number = collect([
            $first_number,
            $second_number * 2,
            $third_number * 3,
            $fourth_number * 4,
        ]);
        $average_numbers = $collection_for_average_number
        ->map(function($value) use ($all_number) {
            return $value / $all_number;
        });

        return $average_numbers->sum();
    }

    public function get_savings($first_number, 
                                $fourth_number) {
        return $first_number - $fourth_number;
    }

    public function get_average_savings($savings, 
                                        $all_number) {
        return $savings / ($all_number / 10);
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $janso_id, formBuilder $formBuilder)
    {
        $form = $formBuilder->create(ScoreRegisterForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $score_history = GameHistory::create([
                    'user_id' => Auth::id(),
                    'janso_id' => $janso_id,
                    'first_number' => $request->first_number,
                    'second_number' => $request->second_number,
                    'third_number' => $request->third_number,
                    'fourth_number' => $request->fourth_number,
                    'income' => $request->income,
                    'created_at' => Carbon::now(),
                    'modified_at' => Carbon::now(),
                ]);
        
        $query = Scores::where('janso_id', (int)$janso_id)->where('user_id', Auth::id())->get();

        if($query->isEmpty()){

            $all_number = $this->get_all_numbers(
                $request->first_number,
                $request->second_number,
                $request->third_number,
                $request->fourth_number,
            );
            $average_number = $this->get_average_number(
                            $request->first_number,
                            $request->second_number,
                            $request->third_number,
                            $request->fourth_number,
                            $all_number,
                        );
            $savings = $this->get_savings($request->first_number, $request->fourth_number);
            $average_savings = $this->get_average_savings($savings, $all_number);

            $total_score = Scores::create([
                'user_id' => Auth::id(),
                'janso_id' => $janso_id,
                'total_first_number' => $request->first_number,
                'total_second_number' => $request->second_number,
                'total_third_number' => $request->third_number,
                'total_fourth_number' => $request->fourth_number,
                'all_number' => $all_number,
                'total_income' => $request->income,
                'average_score' => $average_number,
                'savings' => $savings,
                'average_savings' => $average_savings,
                'created_at' => Carbon::now(),
                'modified_at' => Carbon::now(),
            ]);
            return redirect()->route('score_detail', ['janso_id' => $janso_id]);
        }
        
        $score_data = $query->toArray()[0];
        $total_first_number = $score_data['total_first_number'] + $request->first_number;
        $total_second_number = $score_data['total_second_number'] + $request->second_number;
        $total_third_number = $score_data['total_third_number'] + $request->third_number;
        $total_fourth_number = $score_data['total_fourth_number']  + $request->fourth_number;
        $total_income = $score_data['total_income']  + $request->income;

        $all_number = $this->get_all_numbers(
            $total_first_number,
            $total_second_number,
            $total_third_number,
            $total_fourth_number,
        );
        $average_number = $this->get_average_number(
            $total_first_number,
            $total_second_number,
            $total_third_number,
            $total_fourth_number,
            $all_number,
        );
        $savings = $this->get_savings($total_first_number, $total_fourth_number);
        $average_savings = $this->get_average_savings($savings, $all_number); 


        $total_score = Scores::where('user_id', Auth::id())
                            ->where('janso_id', $janso_id)
                            ->update([
                                'total_first_number' => $total_first_number,
                                'total_second_number' => $total_second_number,
                                'total_third_number' => $total_third_number,
                                'total_fourth_number' => $total_fourth_number,
                                'all_number' => $all_number,
                                'total_income' => $total_income,
                                'average_score' => $average_number,
                                'savings' => $savings,
                                'average_savings' => $average_savings,
                                'modified_at' => Carbon::now(),
                            ]);
        
        return redirect()->route('score_detail', ['janso_id' => $janso_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Janso  $janso_id
     * @return \Illuminate\Http\Response
     */
    public function show($janso_id)
    {
        $game_history = GameHistory::where('user_id', Auth::id())
                                    ->where('janso_id', $janso_id)
                                    ->orderBy('modified_at')
                                    ->get()
                                    ->all();
        return view('game_history')->with('game_history', $game_history);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Janso  $janso_id
     * @param  \App\GameHistory  $history_id
     * @return \Illuminate\Http\Response
     */
    public function edit($janso_id, $history_id, formBuilder $formBuilder)
    {
        $game_history = GameHistory::find($history_id); 
        $model = [
          'first_number' => $game_history->first_number,
          'second_number' => $game_history->second_number,
          'third_number' => $game_history->third_number,
          'fourth_number' => $game_history->fourth_number,
          'income' => $game_history->income            
        ];
        $form = $formBuilder->create(ModifyHistoryForm::class, [
            'method' => 'POST',
            'model' => $model,
            'url' => route('modify_history', ['janso_id' => $janso_id, 'history_id' => $history_id]),
        ]);

        return view('modify_history', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Janso  $janso_id
     * @param  \App\History  $history_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $janso_id, $history_id, formBuilder $formBuilder)
    {
        $form = $formBuilder->create(ModifyHistoryForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $score_history = GameHistory::where('id', $history_id)
                                    ->where('user_id', Auth::id())
                                    ->where('janso_id', $janso_id)
                                    ->update([
                                    'first_number' => $request->first_number,
                                    'second_number' => $request->second_number,
                                    'third_number' => $request->third_number,
                                    'fourth_number' => $request->fourth_number,
                                    'income' => $request->income,
                                    'modified_at' => Carbon::now(),
                                ]);
        return redirect()->route('game_history', ['janso_id' => $janso_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Scores  $scores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scores $scores)
    {
        //
    }
}
