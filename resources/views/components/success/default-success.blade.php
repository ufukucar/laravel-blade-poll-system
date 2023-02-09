@if ( session()->has('success') )
    <div class="mb-5 success px-7 py-5 w-full mb-5 bg-gray-50  ">
        <ul>
            <li class="text-green-600 font-bold leading-6 text-sm ">{{ session()->get('message') }}</li>
        </ul>
    </div>
@endif
