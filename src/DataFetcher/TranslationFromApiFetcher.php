<?php

declare(strict_types=1);

namespace Tsh\Babelsheet\DataFetcher;

use GuzzleHttp\Client;
use Tsh\Babelsheet\Exceptions\WrongFormatOfFetchedDataException;

class TranslationFromApiFetcher implements TranslationsDataFetcher
{
    private $client;
    private $depth = 512;
    private $apiUrl;

    public function __construct(Client $client, ?string $apiUrl)
    {
        $this->client = $client;
        $this->apiUrl = $apiUrl;
    }

    public function fetchTranslation(): array
    {
        $data = $this->fetchDataFromApi();
        $translations = $this->decodeData($data);
        if (!is_array($translations)) {
            throw new WrongFormatOfFetchedDataException();
        }
        return $translations;
    }

    private function fetchDataFromApi(): string
    {
        return $this->client->get(self::API_URL)->getBody()->getContents();
    }

    private function decodeData(string $data)
    {
        return json_decode(
            $data,
            true,
            $this->depth,
            JSON_THROW_ON_ERROR
        );
    }
}
