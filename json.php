<?php
// Funkcija za dohvaćanje cijene Bitcoina
function getBitcoinPrice() {
    $apiUrl = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd";

    // Dohvaćanje podataka iz API-ja
    $response = file_get_contents($apiUrl);

    // Dekodiranje JSON odgovora
    $data = json_decode($response, true);

    // Provjera jesu li podaci uspješno dohvaćeni
    if ($data && isset($data['bitcoin']['usd'])) {
        // Izvlačenje cijene Bitcoina
        $price = $data['bitcoin']['usd'];
        return $price;
    } else {
        return "Unable to retrieve Bitcoin price.";
    }
}

// Funkcija za dohvaćanje cijene Ethereuma
function getEthereumPrice() {
    $apiUrl = "https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=usd";

    // Dohvaćanje podataka iz API-ja
    $response = file_get_contents($apiUrl);

    // Dekodiranje JSON odgovora
    $data = json_decode($response, true);

    // Provjera jesu li podaci uspješno dohvaćeni
    if ($data && isset($data['ethereum']['usd'])) {
        // Izvlačenje cijene Ethereuma
        $price = $data['ethereum']['usd'];
        return $price;
    } else {
        return "Unable to retrieve Ethereum price.";
    }
}

// Funkcija za dohvaćanje tržišne kapitalizacije Bitcoina
function getBitcoinMarketCap() {
    $apiUrl = "https://api.coingecko.com/api/v3/coins/bitcoin";

    // Dohvaćanje podataka iz API-ja
    $response = file_get_contents($apiUrl);

    // Dekodiranje JSON odgovora
    $data = json_decode($response, true);

    // Provjera jesu li podaci uspješno dohvaćeni
    if ($data && isset($data['market_data']['market_cap']['usd'])) {
        // Izvlačenje tržišne kapitalizacije Bitcoina
        $marketCap = $data['market_data']['market_cap']['usd'];
        return $marketCap;
    } else {
        return "Unable to retrieve Bitcoin market cap.";
    }
}

// Funkcija za dohvaćanje tržišne kapitalizacije Ethereuma
function getEthereumMarketCap() {
    $apiUrl = "https://api.coingecko.com/api/v3/coins/ethereum";

    // Dohvaćanje podataka iz API-ja
    $response = file_get_contents($apiUrl);

    // Dekodiranje JSON odgovora
    $data = json_decode($response, true);

    // Provjera jesu li podaci uspješno dohvaćeni
    if ($data && isset($data['market_data']['market_cap']['usd'])) {
        // Izvlačenje tržišne kapitalizacije Ethereuma
        $marketCap = $data['market_data']['market_cap']['usd'];
        return $marketCap;
    } else {
        return "Unable to retrieve Ethereum market cap.";
    }
}

// Poziv funkcija za dohvaćanje podataka i prikaz rezultata
$bitcoinPrice = getBitcoinPrice();
$ethereumPrice = getEthereumPrice();
$bitcoinMarketCap = getBitcoinMarketCap();
$ethereumMarketCap = getEthereumMarketCap();
?>
<h1>Trenutne cijene Kriptovaluta</h1>
<table class="crypto-table">
    <tr><td>Bitcoin price: <?php echo $bitcoinPrice; ?> USD</td></tr>
    <tr><td>Ethereum Price: <?php echo $ethereumPrice; ?> USD</td></tr>
    <tr><td>Bitcoin Market Cap: <?php echo $bitcoinMarketCap; ?> USD</td></tr>
    <tr><td>Ethereum Market Cap: <?php echo $ethereumMarketCap; ?> USD</td></tr>
</table>