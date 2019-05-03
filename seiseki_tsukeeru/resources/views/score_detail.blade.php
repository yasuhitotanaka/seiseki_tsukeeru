@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>いままでの成績</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4>雀荘</h4>
                    <ul class='janso-info'>
                        <li>雀荘名: {{ $janso->name }}</li>
                        <li>場所: {{ $janso->location }}</li>
                    </ul>
                    <h4>成績</h4>
                    <ul class='score-info'>
                        <li>平均順位: {{ $score[0]['average_score'] }}</li>
                        <li>半荘数: {{ $score[0]['all_number'] }}</li>
                    </ul>
                    <p>
                        <ul class='score-info'>
                            <li>1位率:  {{ round($score[0]['total_first_number'] * 100 / $score[0]['all_number'], 1) }}</li>
                            <li>2位率:  {{ round($score[0]['total_second_number'] * 100 / $score[0]['all_number'], 1) }}</li>
                            <li>3位率:  {{ round($score[0]['total_third_number'] * 100 / $score[0]['all_number'], 1) }}</li>
                            <li>4位率:  {{ round($score[0]['total_fourth_number'] * 100 / $score[0]['all_number'], 1) }}</li>
                        </ul>
                    </p>
                    <p><a href='/{{ $janso->id }}/history'>履歴を見る</a></p>
                    <a href='/{{ $janso->id }}/score_registration'><button class='register-button'>成績を追加する</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
