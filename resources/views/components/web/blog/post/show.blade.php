
{{-- <div {{ $attributes->merge(['class'=>'my-5']) }}> --}}
<div {{ $attributes->class(['my-5']) }}>
    <h1>{{$post->title}}</h1>
    <p>{{$post->created_at}}</p>
    <p>{{$post->content}}</p>
</div>