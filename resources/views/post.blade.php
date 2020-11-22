@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Post') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($data as $post)
                        
                    <div id="data_{{ $post->id}}" class="edit"> 
                        {{ $post->description }}
                    </div>
                        {{-- {!! $post->description !!} --}}
                        
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var htmlToRtf = window.htmlToRtf;
    // var html = document.getElementById('data_1');.val();
    // htmlToRtf.saveRtfInFile('<Path>/<FileName>.rtf', htmlToRtf.convertHtmlToRtf(html));
    
        


</script>
@endsection


