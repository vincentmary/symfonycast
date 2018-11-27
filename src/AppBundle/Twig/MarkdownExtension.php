<?php
/**
 * Created by PhpStorm.
 * User: vmary
 * Date: 27/11/2018
 * Time: 15:18
 */

namespace AppBundle\Twig;


use AppBundle\Service\MarkDownTransformer;

class MarkdownExtension extends \Twig_Extension
{

    private $markDownTransformer;

    public  function __construct(MarkDownTransformer $markDownTransformer)
    {
        $this->markDownTransformer = $markDownTransformer;
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('markdownify', [
                $this,
                'parseMarkdown'
            ])
        ];
    }

    public function parseMarkdown($str)
    {
        return $this->markDownTransformer->parse($str);
    }

    public function getName()
    {
        return 'app_markdown';
    }

}