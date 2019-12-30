<?php

declare(strict_types=1);

namespace Tsh\Babelsheet\DataSaver;

use Tsh\Babelsheet\ArrayToStringParser;
use Illuminate\Filesystem\FilesystemAdapter;

class DataIntoFileSaver implements DataSaver
{
    private const TRANSLATIONS_DIRECTORY = 'resources/lang';
    private const FILENAME = 'babelsheet.php';
    private const FILE_CONTENT_FORMAT = '<?php' . PHP_EOL . PHP_EOL . 'return %s;';

    private $parser;
    private $path;
    private $client;

    public function __construct(ArrayToStringParser $parser, FilesystemAdapter $client)
    {
        $this->parser = $parser;
        $this->path = base_path();
        $this->client = $client;
    }

    public function save(array $translations): bool
    {
        $isOk = true;
        foreach ($translations as $lang => $translation) {
            $this->createDirectoryIfNotExists($lang);
            $this->client->put(
                $this->createFilenamePathForLanguage($lang),
                $this->createFileContent($translation)
            );
        }
        return $isOk;
    }

    private function createDirectoryIfNotExists(string $language): void
    {
        $dirPath = $this->createDirectoryPathForLanguage($language);
        if (!$this->client->exists($dirPath)) {
            $this->client->makeDirectory($dirPath);
        }
    }

    private function createDirectoryPathForLanguage(string $language): string
    {
        return '/' . self::TRANSLATIONS_DIRECTORY . '/' . $language;
    }

    private function createFilenamePathForLanguage(string $language): string
    {
        return $this->createDirectoryPathForLanguage($language) . '/' . self::FILENAME;
    }

    private function createFileContent(array $translations): string
    {
        return sprintf(
            self::FILE_CONTENT_FORMAT,
            $this->parser->parse($translations)
        );
    }
}
