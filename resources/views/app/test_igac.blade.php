@extends('layouts.app')
 
@section('title', 'Test IGAC')
 
@section('content')
    @isset($lines)
        <ul>
            @php $i = 1 @endphp
            @foreach ($lines as $line)
                <li><pre>@php print_r($line); @endphp</pre></li>
            @endforeach
        </ul>
    @else
        <form action="{{ route('api.igac') }}" enctype="multipart/form-data" method="post">
            <label for="igac">Select IGAC file...</label>
            <input id="igac" name="igac" accept="application/text" type="file" />
            <button name="submit" type="submit">Upload</button>
        </form>
    @endisset
@endsection
