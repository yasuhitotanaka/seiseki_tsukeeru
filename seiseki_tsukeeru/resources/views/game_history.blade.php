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
                        <div class='history_item'>
                            <a href="/{{ $item->janso_id }}/{{ $item->id }}/modify_history">
                            <ul>
                                <li>1位: {{ $item->first_number }}</li>
                                <li>2位: {{ $item->second_number }}</li>
                                <li>3位: {{ $item->third_number }}</li>
                                <li>4位: {{ $item->fourth_number }}</li>
                                <li>収支: {{ $item->income }}</li>
                                <li>最終更新日: {{ $item->modified_at }}</li>
                            </ul>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
