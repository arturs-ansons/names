<?php
namespace Names;

class ApiDataProcessor
{
    private NamesCollection $namesCollection;

    public function __construct(NamesCollection $namesCollection)
    {
        $this->namesCollection = $namesCollection;
    }

    public function processApiData(string $apiData): void
    {
        $data = json_decode($apiData, true); // Decode JSON as an associative array

        if (is_array($data)) {
            $count = $data['count'] ?? '0';
            $name = $data['name'] ?? 'Name Not Available';
            $countryData = $data['country'] ?? [];
            $email = ''; // Add the email parameter

            $countries = [];
            foreach ($countryData as $countryInfo) {
                $countryId = $countryInfo['country_id'] ?? 'Country ID Not Available';
                $probability = $countryInfo['probability'] ?? '0.0';
                $countries[] = ['country_id' => $countryId, 'probability' => $probability];
            }

            $nameObj = new Name($count, $name, $countries, $email);
            $this->namesCollection->addName($nameObj);
        }
    }
}
