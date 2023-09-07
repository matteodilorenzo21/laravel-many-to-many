@if ($errors->any())
    <div class="alert bg-danger bg-opacity-50 px-0 pb-0">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
