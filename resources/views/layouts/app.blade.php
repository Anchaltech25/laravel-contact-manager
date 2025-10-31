<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contact Manager</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* minimal CSS - put in public/css/app.css or inline */
        body{font-family: Arial, sans-serif; margin:0; padding:0; background:#f5f5f5;}
        .container{width:1000px; max-width:95%; margin:30px auto; background:#fff; padding:20px; box-shadow:0 2px 8px rgba(0,0,0,.05);}
        header{display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;}
        nav a{margin-right:10px; text-decoration:none; color:#333;}
        .btn{display:inline-block; padding:6px 12px; border:1px solid #ccc; text-decoration:none; border-radius:4px; background:#f7f7f7;}
        .btn-primary{background:#0b79d0; color:#fff; border-color:#0b79d0;}
        .success{background:#e6ffed; padding:10px; border:1px solid #b7f0c7; margin-bottom:10px;}
        table{width:100%; border-collapse:collapse;}
        table th, table td{padding:8px; border:1px solid #eee; text-align:left;}
        .small{font-size:0.9rem;color:#666;}
        .card{display:flex; gap:12px; align-items:center;}
        .avatar{width:64px;height:64px;border-radius:50%;object-fit:cover;}
        .form-row{margin-bottom:12px;}
        .form-row label{display:block;margin-bottom:4px;}
        input[type="text"], input[type="email"], textarea, select {width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;}
    </style>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
    <div class="container">
        <header>
            <div>
                <h1>Contact Manager</h1>
            </div>
            <nav>
                <a href="{{ route('contacts.index') }}">All Contacts</a>
                @auth
                    <a href="{{ route('contacts.create') }}">Create</a>
                    <a href="{{ route('contacts.trashed') }}">Trash</a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button class="btn" type="submit">Logout ({{ auth()->user()->email }})</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endauth
            </nav>
        </header>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
