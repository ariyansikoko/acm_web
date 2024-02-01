@extends('layouts.main')

@section('body')
    <h1 class="mb-4">List Recipient</h1>

    @foreach ($recipient as $post)
        <ul>
            <li>
                <h3><a href="/pengeluaran?recipient={{ $post->slug }}" class="text-decoration-none">{{ $post->name }}</a>
                </h3>
            </li>
        </ul>
    @endforeach
@endsection
