<?php
namespace Names;
use Faker\Factory as FakerFactory;
class Name
{

    private string $count;
    private string $name;
    private array $countries;
    private string $email;

    public function __construct(string $count, string $name, array $countries, string $email)
    {
        $this->count = $count;
        $this->name = $name;
        $this->countries = $countries;
        $this->email = $email;

        $faker = FakerFactory::create();
        $this->email = $faker->email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCount(): string
    {
        return $this->count;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountries(): array
    {
        return $this->countries;
    }
}



