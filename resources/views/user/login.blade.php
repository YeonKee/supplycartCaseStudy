@extends('nav')

@section('body')
    <style>
        body {
            overflow: hidden;
        }
    </style>

    <div class="flex h-screen flex-col items-center mt-60">
        <section class="w-2/5 rounded-md bg-gray-100 p-6 shadow-md">
            <h1 class="mb-4 text-2xl font-semibold">Login</h1>

            <form method="POST" action="/users/login">
                @csrf

                <div class="mb-4 flex flex-col">
                    <label for="email" class="mb-2">Email</label>
                    <input type="text" id="email" name="email" placeholder="johndoe@example.com"
                        class="rounded-md border px-2 py-1" />
                    @error('email')
                        <small class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>

                <div class="mb-4 flex flex-col">
                    <label for="password" class="mb-2">Password</label>
                    <input type="password" id="pass" name="pass" placeholder="Password"
                        class="rounded-md border px-2 py-1" />
                    @error('pass')
                        <small class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>

                <div class="flex flex-col items-center justify-center">
                    <button type="submit"
                        class="mt-4 rounded-full rounded-full bg-gray-500 hover:bg-gray-700 px-4 py-2 font-bold text-white">Login</button>
                </div>
            </form>
        </section>
    </div>
@endsection
