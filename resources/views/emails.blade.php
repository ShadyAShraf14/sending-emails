<!DOCTYPE html>
<html>
<head>
    <title>Email List</title>
</head>
<body>
    <h1>Email List</h1>

    <!-- Display Success Message -->
    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1">
        <tr>
            <th>Email</th>
        </tr>
        @foreach ($emails as $email)
        <tr>
            <td>{{ $email->email }}</td>
        </tr>
        @endforeach
    </table>

    <h2>Send Email</h2>
    <form method="POST" action="{{ route('emails.send') }}">

        @csrf
        <textarea name="message" required></textarea>
        <button type="submit">Send Emails</button>
    </form>
</body>
</html>
