<?php
namespace Names;

class Application
{
    public function run(): void
    {
        // Initialize your NamesCollection and ApiDataProcessor
        $namesCollection = new NamesCollection();
        $apiDataRetriever = new ApiDataRetriever();
        $apiDataProcessor = new ApiDataProcessor($namesCollection);

        // Prompt the user to enter a name to search for
        $searchName = readline("Enter a name: ");
        $apiUrl = 'https://api.nationalize.io/?name=' . urlencode($searchName);

        // Retrieve the API data
        $apiData = $apiDataRetriever->retrieveApiData($apiUrl);

        // Process the API data
        $apiDataProcessor->processApiData($apiData);

        // Get the populated names
        $names = $namesCollection->getNames();

        $filteredNames = $this->filterNamesByName($names, $searchName);

        if (count($filteredNames) > 0) {
            foreach ($filteredNames as $name) {
                /** @var Name $name */
                echo "Count: " . $name->getCount() . "\n";
                echo "Name: " . $name->getName() . "\n";
                echo "Send us an email: " . $name->getEmail() . "\n";
                echo "Countries:\n";
                echo "------------------------\n";
                foreach ($name->getCountries() as $country) {
                    echo "Country ID: " . $country['country_id'] . "\n";
                    echo "Probability: " . $country['probability'] . "\n";
                    echo "\n";
                }
                echo "------------------------\n";
            }
        } else {
            echo "No data found for the name: $searchName\n";
        }
    }

    private function filterNamesByName(array $names, string $searchName): array
    {
        $filteredNames = [];
        foreach ($names as $name) {
            if (strtolower($name->getName()) === strtolower($searchName)) {
                $filteredNames[] = $name;
            }
        }
        return $filteredNames;
    }
}
