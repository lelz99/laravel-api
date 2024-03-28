@session('message')
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{$value}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endsession

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
        <h5>Alcuni campi inseriti non sono validi.</h5>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif