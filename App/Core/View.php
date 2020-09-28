<?php
declare(strict_types=1);

namespace App\Core;

class View
{
    public const view_path = BP . DIRECTORY_SEPARATOR . 'View';

    public function render(string $template, $args=[] ?? null)
    {
        $templateFileName = $this->getTemplateFileName($template);
        extract($args,EXTR_SKIP);
        include $templateFileName;
        return $args;
    }


    protected function getTemplateFileName(string $template): string
    {
        return self::view_path . DIRECTORY_SEPARATOR . $template . '.phtml';
    }

}

