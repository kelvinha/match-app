@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4 text-center">Match Team</h3>
    <hr>
    <div class="d-flex justify-content-end mb-2">
        @if ($matchTeam->count() == 0)
            <button class="btn btn-primary" data-toggle="modal" data-target="#buatMatch">Pilih tipe Match</button>
        @endif
        @if ($matchTeam->count() > 0)
            <a href="{{ route('match.team.reset') }}" class="btn btn-danger">Reset</a>
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
    @foreach ($matchTeam as $item => $data)
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
                                                <li> {{ ucfirst($item3->member->nama) }} </li>
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
  <!-- Modal -->
  <div class="modal fade" id="buatMatch" tabindex="-1" role="dialog"aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark pt-2 text-white">
          <h5 class="modal-title" id="exampleModalLongTitle">Pilih tipe</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('match.team.make') }}">
                @csrf
                <div class="form-group">
                    <label for="">Type:</label>
                        <div class="form-check pr-2">
                        <input class="form-check-input" type="radio" name="tipe" required id="type1" value="1">
                        <label class="form-check-label" for="type1">
                            Ganda Campuran
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipe" required id="type2" value="2">
                        <label class="form-check-label" for="type2">
                            Ganda Pasangan
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Buat Match</button>
            </div>
        </form>
      </div>
    </div>
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
