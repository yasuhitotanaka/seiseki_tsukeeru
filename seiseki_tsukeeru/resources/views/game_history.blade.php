@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">成績の履歴</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($game_history as $item)
                    <a href="/{{ $item->janso_id }}/{{ $item->id }}/modify_history">
                        <div class='history-item'>
                            <ul class='score-info'>
                                <li>作成日: {{ str_replace('-','/',substr($item->created_at,0,10)) }}</li>
                                <li>1位の数: {{ $item->first_number }}</li>
                                <li>2位の数: {{ $item->second_number }}</li>
                                <li>3位の数: {{ $item->third_number }}</li>
                                <li>4位の数: {{ $item->fourth_number }}</li>
                                <li>当日の収支: {{ $item->income }}</li>
                            </ul>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
