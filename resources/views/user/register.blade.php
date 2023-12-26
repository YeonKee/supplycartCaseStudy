@extends('nav')

@section('body')
    <style>
        body {
            overflow: hidden;
        }
    </style>

    <div class="flex h-screen flex-col items-center mt-24">
        <section class="w-2/5 rounded-md bg-gray-100 p-6 shadow-md">
            <h1 class="mb-4 text-2xl font-semibold">Register Account</h1>

            <form method="POST" action="/users/register" class="">
                @csrf
                <div class="mb-4 flex flex-col">
                    <label for="name" class="mb-2">Name</label>
                    <input type="text" id="name" name="name" placeholder="John Doe"
                        class="w-full rounded-md border px-2 py-1" value="{{ old('name') }}" />
                    @error('name')
                        <small class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>

                <div class="mb-4 flex flex-col">
                    <label for="address" class="mb-2">Delivery Address</label>
                    <input type="text" id="address" name="address" placeholder="Jalan 10, Ampang Park"
                        class="rounded-md border px-2 py-1" value="{{ old('address') }}"/>
                    @error('address')
                        <small class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>

                <div class="mb-4 flex flex-col">
                    <label for="email" class="mb-2">Email</label>
                    <input type="text" id="email" name="email" placeholder="johndoe@example.com"
                        class="rounded-md border px-2 py-1" value="{{ old('email') }}"/>
                    @error('email')
                        <small class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>

                <div class="mb-4 flex flex-col">
                    <label for="password" class="mb-2">Password</label>
                    <input type="password" id="pass" name="pass" placeholder="Password"
                        class="rounded-md border px-2 py-1" value="{{ old('pass') }}" />
                    @error('pass')
                        <small class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>

                <div class="mb-4 flex flex-col">
                    <label for="re-password" class="mb-2">Re-Enter Password</label>
                    <input type="password" id="re-pass" name="re-pass" placeholder="Re-Enter Password"
                        class="rounded-md border px-2 py-1" value="{{ old('re-pass') }}"/>
                    @error('re-pass')
                        <small class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>

                <div class="flex flex-col items-center justify-center">
                    <button type="submit"
                        class="mt-4 rounded-full bg-gray-500 hover:bg-gray-700 px-4 py-2 font-bold text-white">Register</button>
                </div>

            </form>
        </section>
    </div>
@endsection
