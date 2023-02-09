@if ( session()->has('errors') )
    <div class=" mb-5 font-semibold px-7 py-5 w-full bg-gray-50 text-lg  ">
        <ul>
            @foreach( $errors->all() as $error )
                <li class="text-red-600 leading-6 text-sm ">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
