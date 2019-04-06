@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">雀荘リスト</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($jansos as $janso)
                        <p><a href='/{{ $janso->id }}/score'>{{ $janso->name }}</a> </p>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
