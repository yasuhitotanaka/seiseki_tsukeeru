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
                        <div>
                        <a href="#">
                            <p>1位: {{ $item->first_number }} 2位: {{ $item->second_number }} 
                            3位: {{ $item->third_number }} 4位: {{ $item->fourth_number }} </p>
                            <p>収支: {{ $item->income }}</p>
                            <p>最終更新日: {{ $item->modified_at }}</p>
                        </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
