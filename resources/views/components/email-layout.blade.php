<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 20px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            color: #333333;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            display: inline-block;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .footer {
            font-size: 12px;
            color: #777777;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="items-center mx-auto w-80">
            <img src="https://itacademy.fpvucm.sk/UCM_FPV_logo_RGB_00_logo%20skra%CC%81tene%CC%81_FPV%20eucalyptus.png" alt="logo">
        </div>
        <div class="content">
            {{ $slot }}
            <div class="footer">
                {{ $footer ?? '' }}
                <p>Univerzita sv. Cyrila a Metoda v Trnave</p>
                <p>[telefónne číslo]</p>
                <p>[emailová adresa]</p>
                <p><a href="http://fpv.ucm.sk/sk/">Navštívte našu webstránku</a></p>
            </div>
        </div>
    </div>
</body>

</html>
