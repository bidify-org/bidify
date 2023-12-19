<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Bidify' }}</title>
    <link rel="icon" type="image/x-icon" href="/bidify_logo/favicon.png">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500;600;700&family=Manrope:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>

<body class="bg-white font-body">
    <x-navbar />
    {{ $slot }}
    <x-footer />
</body>
<script src="/js/script.js"></script>
<script type="text/javascript">
    function triggerCountdown(endsAt, id) {
        const endDateTime = new Date(endsAt).getTime();
        const countdownElement = document.getElementById(id);

        function updateCountdown() {
            const currentTime = new Date().getTime();
            const timeDifference = Math.max(endDateTime - currentTime, 0);

            const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            function leftFillNum(num, targetLength) {
               return num.toString().padStart(targetLength, "0");
            }
            countdownElement.innerText = `${leftFillNum(days, 2)} Days | ${leftFillNum(hours, 2)}:${leftFillNum(minutes, 2)}:${leftFillNum(seconds, 2)}`;
        }

        // Update countdown every second
        setInterval(updateCountdown, 1000);

        // Initial update
        updateCountdown();
    }
@stack('scripts')
</script>

</html>
