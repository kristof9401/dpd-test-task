<?php

/** 
 * The TemplateManager class is responsikble for loding html templates.
 * 
 * @author Molnár Kristóf <molnarkristof0@gmail.com>
 */

namespace DTT\Managers;

class TemplateManager
{
    /**
     * It contains the path of template directory.
     * 
     * @var string
     */
    private $templateRoot;

    public function __construct()
    {
        $this->templateRoot = DTT_SRC_ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'template';
    }

    /**
     * It loads the form-page template.
     * 
     * @param arrray $data 
     * @return mixed 
     */
    public function loadForm(array $data)
    {
        return require_once $this->templateRoot . DIRECTORY_SEPARATOR . 'form-page.php';
    }
}
