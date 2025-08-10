<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shorten URL</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        :root {
            --primary-color: #4A90E2;
            --secondary-color: #50E3C2;
            --text-color: #333;
            --bg-color: #F8F9FA;
            --card-bg: #FFFFFF;
            --border-color: #E0E0E0;
            --shadow-light: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: var(--text-color);
        }

        .container {
            width: 100%;
            max-width: 600px;
            padding: 2rem;
            text-align: center;
        }

        .card {
            background-color: var(--card-bg);
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-light);
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 2rem;
        }

        form {
            display: flex;
            gap: 1rem;
            flex-direction: column;
            align-items: stretch;
        }

        .form-group {
            width: 100%;
            display: flex;
            gap: 0.5rem;
            flex-direction: column;
            align-items: flex-start;
        }

        .input-group {
            display: flex;
            width: 100%;
        }

        input[type="text"] {
            flex: 1;
            padding: 1rem;
            font-size: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        button {
            padding: 1rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            color: var(--card-bg);
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            width: 100%;
        }

        button:hover {
            background-color: #357ABD;
            transform: translateY(-2px);
        }

        .short-url-container {
            margin-top: 2rem;
            background-color: #F0F8FF;
            padding: 1.5rem;
            border-radius: 8px;
            border-left: 4px solid var(--secondary-color);
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            word-wrap: break-word;
        }

        .short-url-container p {
            margin: 0;
            color: var(--text-color);
            font-size: 1rem;
            font-weight: 600;
        }

        .short-url-container a {
            font-size: 1.25rem;
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
        }

        .short-url-container a:hover {
            color: #357ABD;
            text-decoration: underline;
        }
        
        .error-message {
            margin-top: 1.5rem;
            color: #D32F2F;
            background-color: #FFEBEE;
            padding: 1rem;
            border-radius: 8px;
            text-align: left;
        }

        .error-message ul {
            margin: 0;
            padding-left: 1.5rem;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <h1>Link Shortener</h1>
            <p>Paste a long URL below to get a shorter link.</p>

            <form method="POST" action="{{ route('shorten') }}">
                @csrf
                <div class="input-group">
                    <input type="text" id="original_url" name="original_url" placeholder="Paste your long URL here..." required>
                </div>
                <button type="submit">Shorten</button>
            </form>

            @if (isset($short_url))
                <div class="short-url-container">
                    <p>Your shortened URL is:</p>
                    <a href="{{ $short_url }}" target="_blank">{{ $short_url }}</a>
                </div>
            @endif

            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

</body>
</html>