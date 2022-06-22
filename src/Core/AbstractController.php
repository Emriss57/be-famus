<?php

abstract class AbstractController
{
    
    public array $ctx;

    protected function setContext(array $context): void
    {
        $this->ctx = $context;
    }

    protected function getViewFolderName(): string
    {
        $moduleName = substr(get_class($this), 0, 0 - strlen("Controller")); 

        return strtolower($moduleName);
    }

    protected function render(string $viewName, array $context = []): void
    {
        $this->setContext($context);
        
        $folderName = $this->getViewFolderName();   
        
        $path = __DIR__ . '/../Views/' . $folderName . '/' . $viewName . '.view.php';
        include_once $path;
    }

}