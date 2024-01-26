@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4 text-center">Match Tunggal</h3>
    <hr>
    <div class="d-flex justify-content-end mb-2">
        @if ($matchIndividu->count() == 0)
            <a href="{{ route('match.individu.make') }}" class="btn btn-primary">Buat Match</a>
        @endif 
        @if ($matchIndividu->count() > 0)
            <a href="{{ route('match.individu.reset') }}" class="btn btn-danger">Reset</a>
        @endif
    </div>
    @if ($m = Session::get('info'))
        <div class="alert alert-info alert-dismissible fade show p-2" role="alert">
            <strong>{{ $m }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
    @foreach ($matchIndividu as $item => $data)
    <div class="card mb-2 bg-dark ">
        <div class="card-title text-center mt-4 text-white"><h4>Match {{ $item }}</h4></div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="row">
                    @foreach ($data as $item2 => $data1)
                        @if ($item2 == 1)
                            <div class="col-lg-4">
                                <div class="card" id="team{{ $item2 }}{{$item}}" onclick="menang({{ $item2 }}{{$item}})">
                                    <div class="card-header">Team {{ $item2 }}</div>
                                    <div class="card-body">
                                        <ul>
                                            @foreach ($data1 as $item3)
                                                <li>{{ ucfirst($item3->member->nama) }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($item2 == 2)
                        <div class="col-lg-4 d-flex align-self-center justify-content-center text-white"><h4>VS</h4></div>
                        <div class="col-lg-4">
                            <div class="card" id="team{{ $item2 }}{{$item}}" onclick="menang({{ $item2 }}{{$item}})">
                                <div class="card-header">Team {{ $item2 }}</div>
                
                                <div class="card-body">
                                    <ul>
                                        @foreach ($data1 as $item3)
                                            <li>{{ ucfirst($item3->member->nama) }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script>
    function menang(id) {
        var cek = $('.card #team'+id).attr('class');
        if (cek == 'card bg-success text-white') {
            $('.card #team'+id).removeClass('bg-success text-white');
        } else {
            $('.card #team'+id).addClass('bg-success text-white');
        }
    }
</script>
@endsection
