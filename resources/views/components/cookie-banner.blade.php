<div id="cookie-banner" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #333; color: #fff; padding: 15px; text-align: center; z-index: 1000;">
    <p>
        Nous utilisons des cookies pour stocker votre nom et votre email afin d'améliorer votre expérience sur la BAI. 
        En acceptant, vous consentez au stockage de ces informations. Cf. <a href="{{ route('terms') }}" target="_blank" style="color:#d5d3d2;">Conditions Générales d'Utilisation</a>.
    </p>
    <button onclick="acceptCookies()" style="margin-right: 10px; background-color: #4CAF50; color: white; border: none; padding: 10px 20px; cursor: pointer;">Accepter</button>
    <button onclick="declineCookies()" style="background-color: #f44336; color: white; border: none; padding: 10px 20px; cursor: pointer;">Refuser</button>
</div>

<script>
    function acceptCookies() {
        fetch('/accept-cookies', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content')
            }
        }).then(() => {
            document.getElementById('cookie-banner').style.display = 'none';
        });
    }

    function declineCookies() {
        document.getElementById('cookie-banner').style.display = 'none';
    }
</script>
