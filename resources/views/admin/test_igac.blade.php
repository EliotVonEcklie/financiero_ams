@extends('layouts.app')
 
@section('title', 'Test IGAC')
 
@section('content')
    @if(session('success'))
        <span>{{ session('success') }}</span>
    @endif
    
    @if(session('errors'))
        <span>{{ session('success') }}</span>
    @endif

    <form action="{{ route('api.igac') }}" enctype="multipart/form-data" method="post">
        <label for="igac_r1">Seleccione archivo IGAC R1...</label>
        <input id="igac_r1" name="igac_r1" type="file" />
        <br>
        <label for="igac_r2">Seleccione archivo IGAC R2...</label>
        <input id="igac_r2" name="igac_r2" type="file" />
        <br>
        <button name="submit" type="submit">Subir</button>
    </form>
@endsection
