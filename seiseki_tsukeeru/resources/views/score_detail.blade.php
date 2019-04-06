@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">いままでの成績</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>雀荘</h3>
                    <p>{{ $score[0] }}</p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
