<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/logo_s.png" type="image">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>A Movy | Masuk</title>
</head>

<body
    class="bg-[url('../../public/img/bg-login.jpg')] bg-center bg-cover bg-no-repeat h-[100vh] w-screen relative flex items-center">
    <div class="w-screen h-[100vh] bg-black opacity-45 absolute top-0 left-0"></div>
    <div class="block relative mx-auto px-4 lg:w-[30%] w-[100%] py-6 -translate-y-5">
        <img src="img/logo.png" alt="" width="200" class="mx-auto mb-4">
        <form action="/login" method="POST"
            class="text-white text-center flex flex-col gap-4 border-2 rounded-md px-4 py-6 shadow-xl shadow-purple-600">
            @csrf
            <h1 class="text-2xl uppercase font-semibold">Halaman Masuk</h1>
            <div class="flex flex-col gap-2 w-[70%] mx-auto">
                <label class="text-xl font-semibold text-left" for="email">Email</label>
                <input
                    class="outline-none px-4 py-2 rounded-full bg-transparent border-2 text-white focus:border-purple-400 transition duration-300 ease-in-out"
                    type="email" name="email" id="email" placeholder="email_kamu@gmail.com">
            </div>
            <div class="flex flex-col gap-2 w-[70%] mx-auto">
                <label class="text-xl font-semibold text-left" for="password">Password</label>
                <input
                    class="outline-none px-4 py-2 rounded-full bg-transparent border-2 text-white focus:border-purple-400 transition duration-300 ease-in-out"
                    type="password" name="password" id="password" placeholder="password_kamu">
            </div>
            @if (Session::has('status'))
                <span class="text-center text-red-600 font-semibold">{{ Session::get('message') }}</span>
            @endif
            <button type="submit"
                class="mt-2 mb-1 bg-purple-600 px-4 py-2 rounded-lg text-xl w-[200px] mx-auto hover:bg-transparent hover:border-purple-300 border-2 border-purple-400 transition duration-300 ease-in-out">Masuk
            </button>
        </form>
    </div>
</body>

</html>
