{{-- resources/views/register.blade.php --}}

<html lang='en'>
    <head>
        <title>Register</title>
    </head>
    <body>
        <div style="border: 2px solid black; display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <h1>Register for an Account</h1>
            <form action="/register" method="POST">
                @csrf
                <input type="text" name="email" placeholder="Enter your email">
                <input type="text" name="name" placeholder="Enter your name">
                <input type="password" name="password" placeholder="Enter your password">
                <button type="submit">Submit</button>
            </form>
        </div>
    </body>
</html>
