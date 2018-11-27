<?php
/**
 * Created by PhpStorm.
 * User: vmary
 * Date: 27/11/2018
 * Time: 14:18
 */

namespace AppBundle\Service;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Doctrine\Common\Cache;

class MarkDownTransformer
{

    private $markdownParser;

    /**
     * @var Cache
     */
    private $cache;

    public function __construct(MarkdownParserInterface $markdownParser, Cache\CacheProvider $cache)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
    }

    public function parse($str)
    {
        $key = md5($str);
        if ($this->cache->contains($key)) {
            return $this->cache->fetch($key);
        }

        sleep(1);
        $str = $this->markdownParser
            ->transformMarkdown($str);
        $this->cache->save($key, $str);
        return $str;
    }
}