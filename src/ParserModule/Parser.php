<?php

namespace App\ParserModule;

/**
 * Парсим urls. В данном конкретном парсере возвращаем количество всех тегов, используемых в каждой url
 */
final class Parser extends AbstractParser
{
    /**
     * списко url для парсинга
     */
    private const URLS = [
        "https://rutracker.org",
        "https://ren.tv",
        "https://www.kommersant.ru/404",
        "https://lenta.ru",
        "https://yandex.ru"

    ];

    /**
     * парсим url
     * @return array
     */
    public function parse(): array {

        foreach(self::URLS as $url) {

            $content = $this->curl->getContent($url);

            if (array_key_exists('content', $content)) {
                $urls[$url] = $this->countTagNames($content['content']);
            }

            else {
                $urls[$url] = $content;
            }
        }

        return $urls;
    }

    /**
     * считаем количество каждого используемого тега
     * @return array
     */
    private function countTagNames(string $content): array {
        if(preg_match_all($this->findTags , $content, $tags)) {
            $countTagNames = array_count_values($tags[1]);
            ksort($countTagNames, SORT_STRING );

            return [
                'tags' => $countTagNames
            ];
        }

        return [
            'error' => 'Cтраница не содержит тегов'
        ];
    }


    }