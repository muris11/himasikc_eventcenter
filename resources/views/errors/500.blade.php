<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error | HIMA-SIKC Event Center</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,900" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 50%, #fbbf24 100%);
            padding: 20px;
        }

        .container {
            text-align: center;
            max-width: 500px;
        }

        .error-code {
            font-size: clamp(100px, 20vw, 180px);
            font-weight: 900;
            background: linear-gradient(135deg, #ca8332 0%, #a16207 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 10px;
            text-shadow: 0 10px 30px rgba(202, 131, 50, 0.3);
        }

        .title {
            font-size: clamp(20px, 4vw, 28px);
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 16px;
        }

        .description {
            font-size: clamp(14px, 2.5vw, 16px);
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            background: linear-gradient(135deg, #ca8332 0%, #a16207 100%);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(202, 131, 50, 0.4);
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(202, 131, 50, 0.5);
        }

        .icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
        }
    </style>
</head>

<body>
    <div class="container">
        <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12 8V12M12 16H12.01M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                stroke="#ca8332" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <div class="error-code">500</div>

        <h1 class="title">Server Error</h1>

        <p class="description">
            Maaf, terjadi kesalahan pada server kami. Tim teknis sedang bekerja untuk memperbaikinya.
            Silakan coba beberapa saat lagi.
        </p>

        <a href="/" class="button">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            Kembali ke Beranda
        </a>
    </div>
</body>

</html>
