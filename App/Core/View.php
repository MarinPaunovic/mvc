<?php
declare(strict_types=1);

namespace App\Core;

class View
{
    public const view_path = BP . DIRECTORY_SEPARATOR . 'View';

    public function render(string $template)
    {
        $templateFileName = $this->getTemplateFileName($template);

        return include $templateFileName;
    }


    protected function getTemplateFileName(string $template): string
    {
        return self::view_path . DIRECTORY_SEPARATOR . $template . '.phtml';
    }

}

