<?php

declare(strict_types=1);

namespace Tsh\Babelsheet\DataFetcher;

use GuzzleHttp\Client;
use Tsh\Babelsheet\Exceptions\WrongFormatOfFetchedDataException;

class TranslationFromApiFetcher implements TranslationsDataFetcher
{
    private const API_URL = 'http://localhost:3000/translations';

    private $client;
    private $depth = 512;

    public function __construct(Client $client)
    {
        $this->client = $client;
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
