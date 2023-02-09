<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>LARAVEL POLL REGISTER</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="loginBody ">

<div class="container mx-auto p-8  h-full w-full grid  h-screen place-items-center">

    <div class="mx-auto my-auto max-w-md sm:min-w-[32rem]  ">

        <div class="bg-white   border rounded-xl shadow-lg shadow-gray-500">

            <div class="border-b py-7 font-semibold text-black bg-[#f5f5f5] text-center text-2xl">
                <span>LARAVEL POLL REGISTER</span>
            </div>

            @if ( session()->has('errors') )
                <div class="error-div py-4 px-6  border-b">
                    @foreach($errors->all() as $error)
                        <p class="w-full text-red-600  text-[0.91rem] leading-7">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form class="bg-grey-lightest p-5 " action="{{ route('register') }}" method="POST">

                @csrf

                <div class="mb-5">
                    <label class="text-black text-md font-semibold" for="name">Name:</label>
                    <input class="border rounded-md w-full p-3" id="name" name="name" type="text" placeholder="Type your Name"
                           required>
                </div>

                <div class="mb-5">
                    <label class="text-black text-md font-semibold" for="email">Email:</label>
                    <input class="border rounded-md w-full p-3" id="email" name="email" type="text" placeholder="Type your email"
                           value="ufuk@mail.com" required>
                </div>

                <div class="mb-6">
                    <label class="text-black text-md font-semibold" for="password">Password:</label>
                    <input class="border rounded-md w-full p-3" name="password" type="password" placeholder="Type your password"
                           value="password" autocomplete="off" required>
                </div>

                <div class="mb-6">
                    <label class="text-black  font-semibold" for="password_confirmation">Confirm Password:</label>
                    <input class="border rounded-md w-full p-3" name="password_confirmation" type="password" placeholder="Type your password again"
                           value="password" autocomplete="off" required>
                </div>

                <div class="flex justify-between items-center">
                    <button class="bg-primary hover:bg-primary-dark w-2/5 py-2.5 px-10 rounded text-[17px] text-white  font-semibold ">
                        Register
                    </button>
                    <a href="{{ route('login') }}" class="font-semibold text-md text-primary hover:text-primary-dark no-underline">Login</a>

                </div>
            </form>


        </div>

    </div>

</div> <!-- #container -->
</body>
</html>
