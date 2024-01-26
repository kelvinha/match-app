@extends('layouts.app')

@section('content')
<div class="container">
    <section>
        <h3>List Members</h3>
        <form action="{{ route('member.store') }}" method="POST">
        <div class="row">
            <div class="col-lg-6">
                @csrf
                <div class="form-group">
                    <label for="">Nama:</label>
                    <input type="text" name="nama" style="text-transform: capitalize" id="nama" class="form-control" required placeholder="masukan nama disini" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Gender:</label>
                    <div class="d-flex flex-row">
                        <div class="form-check pr-2">
                            <input class="form-check-input" type="radio" required name="gender" id="male" value="male">
                            <label class="form-check-label" for="male">
                                Cowo
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" required name="gender" id="female" value="female">
                            <label class="form-check-label" for="female">
                                Cewe
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group" align="end">
                    <button class="btn btn-success" disabled id="submit">Create</button>
                </div>
            </div>
        </div>
    </form>
    </section>
    <section>
        @if ($m = Session::get('msg'))
        <div class="alert alert-success alert-dismissible fade show p-2" role="alert">
            <strong>{{ $m }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
        <hr>
        <div class="d-flex justify-content-between">
        <p> Total Members : {{ $members_total }}</p>
        <a href="{{ route('member.reset') }}" class="btn btn-danger mb-2">Reset Data</a>
        </div>
        Cowo : {{ $members_cowo }} | Cewe : {{ $members_cewe }} 
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">No.</th>
                    <th style="width: 70%">Nama</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @if ($members->count() == 0)
                    <tr>
                        <td colspan="3" class="text-center">Data belum ada</td>
                    </tr>
                @else
                    @foreach ($members as $item)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ ucfirst($item->nama )}}</td>
                            <td>{{ $item->gender == 'male' ? 'Cowo' : 'Cewe' }}</td>
                            <td align="center">
                                <a href="{{ route('member.destroy', ['id' => $item->id]) }}" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {{-- {{ $members->links() }} --}}
    </section>
</div>
<script>
    var checkClick = 0; var checkKeyup = 0;
    $('#nama').on('keyup', function() {
        var total = $(this).val().length;
        checkKeyup = total;
        if (total == 0) {
            $('#submit').attr('disabled', true);
        } else if(checkClick == 0) {
            $('#submit').attr('disabled', true);
        } else {
            $('#submit').attr('disabled', false);
            $('#submit').on('click', function(){
                $(this).css('pointer-events','none').removeClass('btn-success').addClass('btn-secondary').html('Wait a Minute...');
            });
        }
    });
    $('.form-check-input').on('click', function() {
        checkClick = 1;
        if (checkKeyup == 0) {
            $('#submit').attr('disabled', true);
        } else if(checkClick == 0) {
            $('#submit').attr('disabled', true);
        } else {
            $('#submit').attr('disabled', false);
            $('#submit').on('click', function(){
                $(this).css('pointer-events','none').removeClass('btn-success').addClass('btn-secondary').html('Wait a Minute...');
            });
        }
    });
</script>
@endsection
