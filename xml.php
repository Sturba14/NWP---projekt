<?php
// URL ECB API-ja za dohvaćanje tečajne liste
$xml_url = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';

// Funkcija za dohvaćanje tečajne liste putem ECB API-ja
function fetchExchangeRatesFromECB($xml_url) {
    // Dohvaćanje XML sadržaja sa ECB API-ja
    $xml_content = file_get_contents($xml_url);
    
    // Ako nije moguće dohvatiti XML sadržaj, javite grešku
    if ($xml_content === FALSE) {
        return "Greška prilikom dohvaćanja XML-a s ECB API-ja";
    }

    // Pretvaranje XML sadržaja u SimpleXMLElement objekt
    $xml = simplexml_load_string($xml_content);

    // Inicijalizacija praznog niza za pohranu tečajnih lista
    $exchange_rates = array();

    // Iteriranje kroz svaku valutu u XML-u
    foreach ($xml->Cube->Cube->Cube as $valuta) {
        $currency = (string)$valuta['currency']; // Oznaka valute
        $rate = (float)$valuta['rate']; // Tečaj

        // Dodavanje valute i tečaja u niz
        $exchange_rates[$currency] = $rate;
    }

    return $exchange_rates;
}

// Poziv funkcije za dohvaćanje tečajne liste
$exchange_rates = fetchExchangeRatesFromECB($xml_url);

// Provjera je li rezultat dohvaćanja tečajne liste greška
if (is_string($exchange_rates)) {
    // Prikaz greške ako je došlo do problema prilikom dohvaćanja XML-a
    echo $exchange_rates;
} else {
    // Prikaz tečajne liste na stranici
    print '
    <h1>Tečajna lista prema Europskoj središnjoj banci</h1>
    <div class="table-container">
        <table>

            <caption><p>Tečajna lista se ažurira svaki dan u 16:00h</p></caption>
            <tr>
                <th>Valuta</th>
                <th>Tečaj</th>
            </tr>';
    
    foreach ($exchange_rates as $currency => $rate) {
        print '
            <tr>
                <td>' . $currency . '</td>
                <td>' . $rate . '</td>
            </tr>';
    }
    
    print '
        </table>
    </div>
    ';
}
?>