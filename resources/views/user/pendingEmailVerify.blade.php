@extends('nav')

@section('body')
    <style>
        body {
            overflow: hidden;
        }
    </style>

    <div class="flex h-screen flex-col items-center mt-32">
        <section class="w-2/5 rounded-md bg-gray-100 p-6 shadow-md">
            <div class="flex flex-col items-center justify-center">
                <h1 class="mb-4 text-2xl font-semibold">Please verify your email!</h1>
                <img src="/img/verifyEmail.png" width=170 height=170 class="mb-4">
                <p class="px-12 mb-4 text-center inline-block">You're almost there! We had sent an email to <br /><span class="text-bold">{{ $email }}</span></p>
                <p class="px-12 mb-4 text-center">Just click on the link in the email to complete your signup. If you don't see it, you may need to
                    <b>check
                        your spam</b> folder.</p>
                <p class="px-12 text-center mb-4">Can't find the email?</p>
                <a href="#" class="inline-block px-6 py-2 text-white bg-gray-500 hover:bg-gray-700 rounded" onclick="sendVerificationEmail(event, '{{ $email }}', '{{ $userID }}')">Resend Email</a>
                <p id="successMessage" class="px-12 hidden mt-4">Email sent successfully!</p>
            </div>
        </section>
    </div>

    <script>
        function sendVerificationEmail(event, email, userID) {
            event.preventDefault();

            // Show loading cursor
            document.body.style.cursor = 'wait';

            var url = "{{ route('verifyEmail', ['email' => ':email', 'userID' => ':userID']) }}";
            url = url.replace(':email', email);
            url = url.replace(':userID', userID);

            var xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var successMessage = document.getElementById('successMessage');
                    successMessage.style.display = 'block';
                    // Revert to normal cursor
                    document.body.style.cursor = 'default';
                } else {
                    console.error('There was a problem sending the email.');
                    // Revert to normal cursor in case of an error
                    document.body.style.cursor = 'default';
                }
            };

            xhr.onerror = function() {
                console.error('Request failed.');
                // Revert to normal cursor in case of an error
                document.body.style.cursor = 'default';
            };

            xhr.send();
        }
    </script>
@endsection
