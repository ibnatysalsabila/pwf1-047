<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas PWF Pertemuan 1</title>
    <style>
        /* Menggunakan font sistem yang lebih bersih */
        body { 
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; 
            background-color: #0a0a0a; 
            color: #ffffff; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }

        .card { 
            background: #121212; 
            padding: 50px 40px; 
            border-radius: 24px; 
            border: 1px solid #222; 
            text-align: center; 
            width: 360px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Efek interaktif saat card disentuh */
        .card:hover {
            transform: scale(1.02);
            border-color: #444;
            box-shadow: 0 15px 40px rgba(0,0,0,0.7);
        }

        h2 { 
            margin: 0 0 8px 0; 
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        p { 
            color: #666; 
            margin-bottom: 35px; 
            font-size: 1rem;
            font-weight: 400;
        }

        .btn { 
            display: inline-block;
            background: #ffffff; 
            color: #000000; 
            padding: 14px 30px; 
            text-decoration: none; 
            border-radius: 14px; 
            font-weight: 600; 
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .btn:hover { 
            background: #e5e5e5;
            transform: translateY(-2px);
        }

        .btn:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <div class="card">
        <h2>Ibnaty Salsabila Toisutta</h2>
        <p>20230140047</p>
        <a href="#" class="btn">Modul Pertemuan 1</a>
    </div>

</body>
</html>