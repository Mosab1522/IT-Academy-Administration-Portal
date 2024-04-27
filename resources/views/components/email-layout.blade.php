<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;  }
    .email-container { max-width: 600px; margin: auto; background: #ffffff; padding: 20px; }
    .logo { text-align: center; margin-bottom: 20px; }
    .content { color: #333333; }
     .button-container { text-align: center; margin-top: 20px; } /* Container for centering the button */
    .button {
        background-color: #4CAF50; color: white; padding: 10px 20px;
        text-align: center; display: inline-block; border-radius: 5px;
        text-decoration: none; margin-bottom: 20px;
    }
    .footer { font-size: 12px; color: #777777; text-align: center; margin-top: 40px; }
</style>
</head>
<body>
<div class="email-container">
    <div class="items-center mx-auto w-80">
        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 971.54 483.43"><defs><style>.cls-1{fill:#3d3935;}</style></defs><path class="cls-1" d="M163.41,197.25V168.08c5.55-1.11,12.68-2.06,20.14-2.85v13c5.86-.95,13-1.59,19.81-2.06V164.28c4.12,0,6.82-.16,10.15-.16,3.64,0,8.08.16,10.93.16v11.89c7,.47,14.11,1.11,20,2.06v-13c6.5.63,13.63,1.58,20.13,2.85v29.17c-9-2.06-29-5.07-51-5.07C192.42,192.18,172.45,195.19,163.41,197.25Zm27,98V206.13a123.94,123.94,0,0,0-27,3.17V314.4c8.09,1,27,4.91,50.1,4.91,23,0,43-4,51-4.91V209.3c-6-1.11-15.06-3.17-27.11-3.17v89.09a149.61,149.61,0,0,1-23.93,2.06A141,141,0,0,1,190.36,295.22Zm92.1-32.82c0-16.17,3.17-39.15,6-52.15a323.56,323.56,0,0,1,50.88-4.12c23.15,0,40.27,3.17,44.23,4.12v22c-4-1.11-21.87-4-40.1-4a213.53,213.53,0,0,0-30.92,1.9,156.05,156.05,0,0,0-3,32.18c0,17,2.06,27.9,3,31.87,5.87,2.06,17,3,30.92,3,18.23,0,36.14-4,40.1-4.92v22a194.29,194.29,0,0,1-44.23,4.91,290.73,290.73,0,0,1-50.88-4.91C285.63,302.35,282.46,279.36,282.46,262.4Zm119.21,55V210.25c8.88-.95,41.06-4.12,66.11-4.12,23.94,0,56,3.17,65,4.12V317.41H505.83V229.27c-5.24,0-17-1-25.05-1v89.09H453.67V228.32c-8.08,0-20,1-25.05,1v88.14Z"/><path class="cls-1" d="M622.66,209.3v5.23h-61V262.4h51.21v5.08H561.62v49.93h-6V209.3Z"/><path class="cls-1" d="M637.56,209.3h31.7c24.1,0,36.3,4.91,36.3,29.64v6.34c0,24.89-12.2,29.81-36.3,29.81H643.58v42.32h-6Zm31.54,60.55c20.77,0,30.28-3.33,30.28-24.57v-6.34c0-21.24-9.51-24.41-30.28-24.41H643.58v55.32Z"/><path class="cls-1" d="M719.35,209.3l41.06,101.45L801.47,209.3h6.66L764.06,317.41h-7.13L712.86,209.3Z"/></svg> <!-- Customize your logo src -->
    </div>
    <div class="content">
        {{$slot}}

        <div class="footer">
           {{$footer ?? ''}}
            <p>Univerzita sv. Cyrila a Metoda v Trnave</p>
            <p>[telefónne číslo]</p>
            <p>[emailová adresa]</p>
            <p><a href="http://fpv.ucm.sk/sk/">Navštívte našu webstránku</a></p>
        </div>
    </div>
</div>
</body>
</html>


